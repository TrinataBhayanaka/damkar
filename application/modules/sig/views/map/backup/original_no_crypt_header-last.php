<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIS - BRWA</title>
<base href="<?=BASE_URL;?>" />
<link rel="stylesheet" type="text/css" href="assets/bs-3.3.1/css/bootstrap.css" media="screen">
<link rel="stylesheet" href="assets/fa-4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/rrss.css">
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js2/jquery.layout.latest.js"></script>
<script src="assets/bs-3.3.1/js/bootstrap.min.js"></script>
<!--MAP-->
<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script src="assets/js/OL212/OpenLayers.js"></script>

<script src="assets/js/OL28/TooltipCloud.js"></script>

<!--<script src="assets/js/module/ddw.js"></script>
<script src="assets/js/module/ipm.js"></script>
<script src="assets/js/module/ppp.js"></script>
<script src="assets/js/module/ang.js"></script>-->
<script>
	/**
	 * Class: OpenLayers.Strategy.AttributeCluster
	 * Strategy for vector feature clustering based on feature attributes.
	 *
	 * Inherits from:
	 *  - <OpenLayers.Strategy.Cluster>
	 */
	OpenLayers.Strategy.AttributeCluster = OpenLayers.Class(OpenLayers.Strategy.Cluster, {
		/**
		 * the attribute to use for comparison
		 */
		attribute: null,
		/**
		 * Method: shouldCluster
		 * Determine whether to include a feature in a given cluster.
		 *
		 * Parameters:
		 * cluster - {<OpenLayers.Feature.Vector>} A cluster.
		 * feature - {<OpenLayers.Feature.Vector>} A feature.
		 *
		 * Returns:
		 * {Boolean} The feature should be included in the cluster.
		 */
		shouldCluster: function(cluster, feature) {
			var cc_attrval = cluster.cluster[0].attributes[this.attribute];
			var fc_attrval = feature.attributes[this.attribute];
			var superProto = OpenLayers.Strategy.Cluster.prototype;
			return cc_attrval === fc_attrval && 
				   superProto.shouldCluster.apply(this, arguments);
		},
		CLASS_NAME: "OpenLayers.Strategy.AttributeCluster"
	});

	OpenLayers.Renderer.symbol = {
		"triangle2": [0,5, 0,12, 10,12, 10,5, 5,0, 0,5],
		"triangle3": [0,5, 0,12, 4,15, 5,17, 6,15, 10,12, 10,5, 0,5],
		"triangle": [0,0, 10,0, 5,12, 0,0],
	};

	var map;
	var ext = false;
	var itheme = false;
	var themeObj = null;
	var themeObjCallback = false;
	var selectedFeature = false;
	var selectedWilayah = false;
	var listLayers = [];
	var layersLoading = 0;
	var popupTooltip = popup = false;
	var wa_status = ['In Progres', 'Teregistrasi', 'Terverifikasi', 'Sertifikasi', 'Pengakuan'];
	var size = [50, 40, 30, 25, 20, 15, 10, 6];
	var range = [100, 30, 10, 8, 4, 2, 1, 0];
	var text = ['100+', '30 - 100', '10 - 30', '8 - 10', '4 - 8', '2 - 4', '1 - 2', '0'];
	var colors = ["#800026", "#BD0026", "#E31A1C", "#FC4E2A", "#FD8D3C", "#FEB24C", "#FFD976", "#FFF"];
	var selectCtrl;
	
	var ctheme = 'default';
	var mapbg = false;
	var param = '';
	var gproj = new OpenLayers.Projection("EPSG:900913");
  	var proj = new OpenLayers.Projection("EPSG:4326");
	var themes;
	$.ajax({
		dataType: "jsonp",
		url: '/sim_wilayah/indic?callback',
		success: function(data) {
			themes = data;
			console.log(themes);
		}
	});
	OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {                
		defaultHandlerOptions: {
			'single': true,
			'double': false,
			'pixelTolerance': 0,
			'stopSingle': false,
			'stopDouble': false
		},
	
		initialize: function(options) {
			this.handlerOptions = OpenLayers.Util.extend(
				{}, this.defaultHandlerOptions
			);
			OpenLayers.Control.prototype.initialize.apply(
				this, arguments
			); 
			this.handler = new OpenLayers.Handler.Click(
				this, {
					'click': this.trigger
				}, this.handlerOptions
			);
		}, 
	
		trigger: function(e) {
			mapEvent(e);
		}
	
	});
	function init() {
		map = new OpenLayers.Map({
			div: "maped",
			projection: "EPSG:900913",
			displayProjection:"EPSG:4326",
			paddingForPopups: new OpenLayers.Bounds(450,00,30,50),
			controls:[]
		});
		var scale_holder = document.getElementById("map_attribute");
		scaleline = new OpenLayers.Control.ScaleLine({'maxWidth':200,'geodesic':true,div:scale_holder});
		attribution = new OpenLayers.Control.Attribution();
		map.addControl(scaleline);
		map.addControl(new OpenLayers.Control.KeyboardDefaults());
		map.addControl(new OpenLayers.Control.Navigation({dragPanOptions: {enableKinetic: true}}));
		map.addControl(attribution);
		
		//map.addControl(new OpenLayers.Control.LayerSwitcher({'position': new OpenLayers.Pixel(10,230)}));
		map.addControl(new OpenLayers.Control.Scale());
		//map.addControl(new OpenLayers.Control.MousePosition());
		map.events.register('preaddlayer', map, function(evt) { 
         if (evt.layer) { 
				 evt.layer.events.register('loadstart', this, function() { 
					 layersLoading++; 
					 //$("#s1").append("<li id='layer_"+evt.layer.id+"'>"+evt.layer.id+" > "+layersLoading+"</li>");
					 if (layersLoading > 0) { 
						 $('#loader').show(); 
						 //$("#map_loading_box").height($("#map").height());
						 //$("#map_loading_box").show();	
					 } 
				 }); 
				 evt.layer.events.register('loadend', this, function() { 
					 if (layersLoading > 0) { 
					 	
						 layersLoading--; 
						 //$("#e1").append("<li id='layer_"+evt.layer.id+"'>"+evt.layer.id+" > "+layersLoading+"</li>");
					 } 
					 if (layersLoading == 0) { 
					 	//alert(evt.layer.id);
						 $('#loader').hide(); 
						 //$("#map_loading_box").hide();	
						 //$('#throbber').hide(); 
					 } 
				 }); 
			 } 
		 });
		
		
		layer_wi = new OpenLayers.Layer.XYZ(
			"XYZ Lingkar",
			[
				"http://a.tile.openstreetmap.org/${z}/${x}/${y}.png",
				"http://b.tile.openstreetmap.org/${z}/${x}/${y}.png",
				"http://c.tile.openstreetmap.org/${z}/${x}/${y}.png"
			], {
				attribution: "App & Data &copy; <a href='http://brwa.or.id/'>BRWA</a>. Powered by <a href='http://dinamof.co.id/'>Dinamof</a> (LAT) | " + 
					"Map &copy; <a href='http://www.openstreetmap.org/'>OpenStreetMap</a> " +
					"and contributors, CC-BY-SA",
				buffer: 2,
				numZoomLevels: 16,
				wrapDateLine:true,
				transitionEffect: 'resize'
			}
		);		
		layer_wi.id = 'lokal';
		map.addLayer(layer_wi);
		
		
		ovControl = new OpenLayers.Control.OverviewMap({maximized:true,autoPan:true,size: new OpenLayers.Size(180,110)});
		ovControl.isSuitableOverview = function() {
			return false;
		};
		map.addControl(ovControl);
		
		var click = new OpenLayers.Control.Click();
		map.addControl(click);
		click.activate();
		//changeBaseMap('gmap');	
		
		//if (ext) ext = new OpenLayers.Bounds(ext.split(","));
		//(itheme)?triggerTheme():loadThemes();
		
		var id_bounds = new OpenLayers.Bounds(94,-8,141,6);
		map.zoomToExtent(id_bounds.transform(proj, map.getProjectionObject()));
		
		legendTheme();
		getData();
	}	//POINT
	
	function legendTheme() {
		var ldiv = document.getElementById("map_legend");
		
		for(var i=0;i<(colors.length-1);i++) {
			var dataLegend = document.createElement("i");
			var dataLabel = document.createTextNode(text[i]);
			var dataSpace = document.createElement("br");
			dataLegend.setAttribute('style', 'background:'+colors[i]);
			ldiv.appendChild(dataLegend);
			ldiv.appendChild(dataLabel);
			ldiv.appendChild(dataSpace);
		}
	}
	
	function getData(p,k,s,f,q) {
		if (selectedFeature!=false) onFeatureUnselect(selectedFeature);
		var prop = p?p:'0000';
		
		var mod_base = k?'kabupaten':'propinsi';
		if (k) {
			prop = k;
		}
		var s = (s)?s:'';
		var f = (f)?'?f='+f:'';
		var q = (q)?(f)?'&q='+q:'?q='+q:'';
		
		
		$("#data-list").load('/brwa_services/gis/gis/data_list_by_'+mod_base+'/'+prop+'/'+s+f+q,function(){
			dataShow();
			$("li.media-wa").click(function(){
				var lonlat = new OpenLayers.LonLat($(this).data('lon'),$(this).data('lat'));
				listClick($(this).data('idx'),'over',lonlat.transform(proj, map.getProjectionObject()));
			});
		});
		$("#data-stats").load('/brwa_services/gis/gis/data_stats_by_'+mod_base+'/'+prop+'/'+s+f+q);
		$("#data-stats-total").load('/brwa_services/gis/gis/data_stats2_by_propinsi/0000');
		//alert('/brwa_services/gis/gis/data_'+mod_base+'_point/'+prop+'/'+s+f+q);
		var context = {
			getColor: function(feature) {
				var d = parseInt((feature.attributes.total));
				d = d > 100 ? 0 : d > 30 ?1 : d > 10 ? 2 : d > 8  ? 3 : d > 4   ? 4 : d > 2   ? 5 : d >= 1   ? 6 : 7;
				return colors[d];
			},
			getSize: function(feature) {
				var d = parseInt((feature.attributes.total));
				d = d > 100 ? 0 : d > 30 ?1 : d > 10 ? 2 : d > 8  ? 3 : d > 4   ? 4 : d > 2   ? 5 : d >= 1   ? 6 : 7;
				return size[d];
			}
		};
		var template = {
			pointRadius: "${getSize}", // using context.getSize(feature)
			fillColor: "${getColor}", // using context.getColor(feature)
			strokeWidth: 1,
			fillOpacity: 0.6,
			label: "${total}",
			labelAlign: "center",
			fontFamily: "Arial",
			fontSize: "16px",
			fontColor: "#000",
			labelOutlineWidth: 0,
			labelSelect:true
		};
		var style = new OpenLayers.Style(template, {context: context});
		
		var render=["SVG","VML"];	
		
		if (map.getLayer("polylayer")) {
			polylayer.destroyFeatures();
			map.removeLayer(polylayer);
		}
		polylayer = new OpenLayers.Layer.Vector('TEST', {
			minScale: 7000001,
			maxScale: 2000000,
			//maxScale: 867001,
			//styleMap: new OpenLayers.StyleMap(style)
			styleMap: new OpenLayers.StyleMap({
				"default": style,
				"select": {
					fillOpacity:0.9
				},
				"temporary": {
					fillOpacity:0.8
				}
			})
		,	renderers: render
		,	rendererOptions: {zIndexing: true}
		,	strategies: [new OpenLayers.Strategy.Fixed()]
		,	protocol: new OpenLayers.Protocol.HTTP({
				url: '/brwa_services/gis/gis/data_'+mod_base+'/'+prop+'/'+s+f+q,//themes[stheme]['listUrl'],
				params:{},
				format: new OpenLayers.Format.GeoJSON({
					ignoreExtraDims: true,
					keepData: true,
					internalProjection: gproj,
					externalProjection: proj
				})
			})
		,	eventListeners: {
				"featuresadded":function() {
					Zoomer(polylayer);
				}
			}
		});
		polylayer.id="polylayer";
		map.addLayer(polylayer);
		polylayer.refresh();
		
		/*polyHLCtrl = new OpenLayers.Control.SelectFeature(polylayer, {
			multiple:false ,hover: true, highlightOnly: true, renderIntent: 'temporary'
		});
		map.addControl(polyHLCtrl);
		polyHLCtrl.activate();*/
		
		if (map.getLayer("circlelayer")) {
			circlelayer.destroyFeatures();
			map.removeLayer(circlelayer);
		}
		circlelayer = new OpenLayers.Layer.Vector('TEST', {
			maxScale: 7000001,
			styleMap: new OpenLayers.StyleMap(style)
		,	renderers: render
		,	rendererOptions: {zIndexing: true}
		,	strategies: [new OpenLayers.Strategy.Fixed()]
		,	protocol: new OpenLayers.Protocol.HTTP({
				url: '/brwa_services/gis/gis/data_'+mod_base+'_point/'+prop+'/'+s+f+q,//themes[stheme]['listUrl'],
				params:{},
				format: new OpenLayers.Format.GeoJSON({
					ignoreExtraDims: true,
					keepData: true,
					internalProjection: gproj,
					externalProjection: proj
				})
			})
		});
		circlelayer.id="circlelayer";
		map.addLayer(circlelayer);
		map.setLayerIndex(circlelayer,1);
		circlelayer.refresh();
		
		//cpoly
		var style3 = new OpenLayers.Style({
			pointRadius: "${radius}",
			fillColor: "${color}",//"#3C8DBC",
			strokeColor: "${color}",//"#FFF",
			fillOpacity: "${opacity}",//.4,
			strokeWidth: "${width}",
			strokeOpacity: 1,
			strokeDashstyle: "${dashed}",
			label: "${flabel}",
			fontColor:"#FFF",
			fontSize: "10px",
			//graphicName:"triangle"
		}, {
			context: {
				width: function(feature) {
					return (map.getZoom()>9)?2:1;
				},
				opacity: function(feature) {
					return (feature.attributes.geom)?.4:.7;
				},
				dashed: function(feature) {
					return (feature.attributes.geom)?"dashdot":"solid";
				},
				flabel: function(feature) {
					return (map.getZoom()>9 && feature.attributes.geom)?feature.attributes.satuan:'';
				},
				radius: function(feature) {
					var pix = 2;
					var zr  = map.getZoom();
					
					return zr-2;
				},
				label: function(feature) {
					return feature.attributes.count>1?feature.attributes.count:'';
				},
				color: function(feature) {
					var c = '#ccc';
					var p = parseInt(feature.attributes.wa_status);
					var s = parseInt(feature.attributes.doc_status);
					
					c = p==0 ? 'orange' : p==1 ? '#3C8DBC' : p==2 ? 'green' : 'red';
						
					return c;
				}
			}
		});
		
		if (map.getLayer("cpoly")) {
			cpoly.destroyFeatures();
			map.removeLayer(cpoly);
		}
		cpoly = new OpenLayers.Layer.Vector('WA POLY', {
			//minScale: 867001,
			minScale: 2000001,
			//styleMap: new OpenLayers.StyleMap(style)
			styleMap: new OpenLayers.StyleMap({
				"default": style3,
				"select": {
					fillOpacity:0.6,
					strokeWidth: 2,
					strokeColor: "yellow",
					strokeDashstyle: "solid"
				},
				"temporary": {
					fillOpacity:0.3
				}
			})
		,	renderers: render
		,	rendererOptions: {zIndexing: true}
		,	strategies: [new OpenLayers.Strategy.Fixed()]
		,	protocol: new OpenLayers.Protocol.HTTP({
				url: '/brwa_services/gis/gis/data_wa_'+mod_base+'_poly/'+prop+'/'+s+f+q,//themes[stheme]['listUrl'],
				params:{},
				format: new OpenLayers.Format.GeoJSON({
					ignoreExtraDims: true,
					keepData: true,
					internalProjection: gproj,
					externalProjection: proj
				})
			})
		,	eventListeners: {
				"featuresadded": feature_out
			}
		});
		cpoly.id="cpoly";
		map.addLayer(cpoly);
		map.setLayerIndex(cpoly,1);
		cpoly.refresh();
		
		
		var style2 = new OpenLayers.Style({
			pointRadius: "${radius}",
			fillColor: "${color}",//"#3C8DBC",
			strokeColor: "#FFF",
			fillOpacity: 1,
			strokeWidth: "${width}",
			strokeOpacity: 0.8,
			label: "${label}",
			fontColor:"#FFF",
			//graphicName:"triangle"
		}, {
			context: {
				width: function(feature) {
					return 1;
				},
				radius: function(feature) {
					var pix = 2;
					var zr  = map.getZoom();
					/*if(feature.cluster.length>1) {
						//pix = Math.min(feature.cluster.length+10, 12) + 2;
						pix = pix+feature.cluster.length;
					}*/
					return zr-pix;//pix+zr-5;
				},
				label: function(feature) {
					return feature.attributes.count>1?feature.attributes.count:'';
				},
				color: function(feature) {
					var c = '#ccc';
					//if(feature.attributes.count==1) {
						var p = parseInt(feature.attributes.wa_status);
						var s = parseInt(feature.attributes.doc_status);
						c = p==0 ? 'orange' : p==1 ? '#3C8DBC' : p==2 ? 'green' : 'red';
						
					//}
					return c;
				}
			}
		});
		
		if (map.getLayer("clayer")) {
			clayer.destroyFeatures();
			map.removeLayer(clayer);
		}
		clayer = new OpenLayers.Layer.Vector('CLUSTER', {
			minScale: 7000001,
			maxScale: 2000000,
			//maxScale: 867001,
			styleMap: new OpenLayers.StyleMap({
				"default": style2,
				"select": {
					strokeOpacity:1
				},
				"temporary": {
					strokeOpacity:1
				}
			})
		,	renderers: render
		,	rendererOptions: {zIndexing: true}
		,	strategies: [new OpenLayers.Strategy.Fixed()/*,new OpenLayers.Strategy.AttributeCluster({attribute:'id_propinsi',distance:20})*/]
		,	protocol: new OpenLayers.Protocol.HTTP({
				url: '/brwa_services/gis/gis/data_wa_'+mod_base+'_point/'+prop+'/'+s+f+q,//themes[stheme]['listUrl'],
				params:{},
				format: new OpenLayers.Format.GeoJSON({
					ignoreExtraDims: true,
					keepData: true,
					internalProjection: gproj,
					externalProjection: proj
				})
			})
		,	eventListeners: {
				"featuresadded": feature_out
			}
		});
		clayer.id="clayer";
		map.addLayer(clayer);
		clayer.refresh();
		
		highlightCtrl = new OpenLayers.Control.SelectFeature([clayer], {
				multiple:true, hover: true, highlightOnly: true, renderIntent: "temporary"
		});
		
		popCtrl = new OpenLayers.Control.SelectFeature([clayer,cpoly], {
				multiple:true, hover: true, highlightOnly: false, renderIntent: "temporary", callbacks:{
				'over':feature_hover, 'out':feature_out
			}
		});
		
		selectCtrl = new OpenLayers.Control.SelectFeature([cpoly,clayer,polylayer], {
			onSelect: onFeatureSelect, onUnselect: onFeatureUnselect
		});
		/*selectCtrl2 = new OpenLayers.Control.SelectFeature(polylayer, {
			onSelect: feature_hover_pc, onUnselect: feature_out
		});*/
				
		//map.addControl(selectCtrl2);
		map.addControls([highlightCtrl,selectCtrl,popCtrl/*,selectCtrl2*/]);
		highlightCtrl.activate();
		popCtrl.activate();
		selectCtrl.activate();
		//selectCtrl2.activate();
		
		//map.raiseLayer(polylayer,0);
		map.setLayerIndex(polylayer,0);

	}
	function Zoomer(layer) {
		var bbox = (ext)?ext:layer.getDataExtent();
		
		map.zoomToExtent(bbox,0);
		if (bbox.left) {
			var ll = new OpenLayers.LonLat(bbox.left,bbox.bottom);
			var cp = map.getPixelFromLonLat(ll);
			var dif = 0;
			if (cp.x<400)  dif = 430-cp.x;
			map.pan(-dif,-20,{animate:false});
		}
	}
	function mapEvent(e) {
		var evt = e.type;
		var ext = map.getExtent();
		var zoom = map.zoom;
		
		if (evt=='click') {
			dataHide();
		}
	}
	function dataHide() {
		$("#data-container").slideUp('fast',function(){
			$("#data-list-small").slideDown('fast');
		});
	}
	function dataShow() {
		$("#data-container").slideDown();
		$("#data-list-small").slideUp();
		$("#detil-container").slideUp();
		onPopupClose();
	}
	function detilHide() {
		$("#detil-container").slideUp('fast');
	}
	function detilShow(url) {
		dataHide();
		if (url) {
			$("#detil-container").removeClass("hide");
			$("#data-detil").load(url,function() {
				$("#detil-container").slideDown('fast');
			});
		}
		else {
			$("#detil-container").slideDown('fast');
		}
		$('#myTab li:eq(1) a').tab('show');
	}
	function onPopupClose(evt) {
		selectCtrl.unselectAll();
	}
	function onFeatureSelect(feature) {
		onFeatureUnselect(selectedFeature);
		selectedFeature = feature;
		var lonlat=feature.geometry.getBounds().getCenterLonLat();
		var gid=feature.attributes.gid;
		var url=feature.attributes.url;
		var attr=feature.attributes.attr;
		var fdata = (feature.attributes.count)?feature.cluster[0]['data']:feature.attributes;
		
		if (fdata.total) {
			feature_hover_pc(feature);
			return false;
		}
		onFeatureUnselect(feature);
		selectedWilayah=fdata.idx;
		if (!feature.popup && feature.onScreen() && (feature.attributes.count==1 || !feature.attributes.count)) {
			var label0 = "<div class='pop' style='text-transform:uppercase'><strong>"+fdata.satuan+"</strong></div>";
			var label1 = "<div class='pop pop_label1'></div>";
			var label2 = "<div class='pop pop_label2'>"+wa_status[fdata.wa_status]+"</div>";
			var label3 = "<div class='pop pop_label3'>"+fdata.luas+" Ha</div>";
			var content = "<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+label0+"</td><td align='right' valign='middle'>"+label2+"</td></tr></table></div>"+"<div class='pop-box'>"+label1+"</div>"+label3;
			var content = label0+label2+label1+label3;

			
			var xOffset = 0;
			var yOffset = (feature.attributes.yOffset)?feature.attributes.yOffset:-5;
			var offset={ size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,0)}
			
			popup = new OpenLayers.Popup.FramedCloud("popup_"+gid,lonlat,null,content,offset,false,onPopupClose);
			popup.hide();
			popup.minSize=new OpenLayers.Size(200,100);
			popup.autoSize=true;
			popup.maxSize=new OpenLayers.Size(600,400);
			popup.calculateRelativePosition = function () {
                 return 'tr';
            }
			feature.popup = popup;
			cPopup = popup;
			fPopup = feature;
			map.addPopup(popup,true);
			
			var url = '/brwa_services/gis/gis/data_wa_detil/'+fdata.idx;
			detilShow(url)
		}
		else {
			var p = map.getViewPortPxFromLonLat(lonlat);
			//alert(p);
			var z = map.getZoom();
			map.setCenter(lonlat,z+1);
		}
	}
	function onFeatureUnselect(feature) {
		feature_out(feature);
		if (feature.popup) {
			map.removePopup(feature.popup);
			feature.popup.destroy();
			feature.popup = null;
		}
		detilHide();
		$(".search_item").removeClass("search_item_active");
	}    
	
	function feature_hover(feature) {
		if (!feature.popup && feature.onScreen()) {
			var lonlat=feature.geometry.getBounds().getCenterLonLat();
			//feature.move(lonlat);
			var fdata = (feature.attributes.count)?feature.cluster[0]['data']:feature.attributes;
			
			feature_out();
			if (feature.attributes.count>1) {
				return false
			}
			else {
				var p = parseInt(fdata.wa_status);
				var s = parseInt(fdata.doc_status);
				c = p==0 ? 'In Progress' : p==1 ? 'Teregistrasi' : p==2 ? 'Terverifikasi' : 'Tersertifikasi';
			}
			var tpl = '<div class="media" style="min-width:250px; padding:0;">'
					+ '<div class="media-body" style="padding:0;margin:0">'
					+ '<h4 class="media-heading">'+fdata.satuan+'</h4>'
					+ '<div style="font-size:x-small">'+c+'</div><div style="font-size:small">'+fdata.luas+' Ha</div>'
					+ '</div>'
					+ '<div class="media-right" style="padding:0; position:absolute; right:0px; top:0px">'
					+ '<img src="/brwa_admin/'+fdata.foto+'" style="border:1px solid #ddd; width:94px; height:94px; padding:0" alt="wa foto">'
					+ '</div>'
					+ '</div>'
			var tpl = '<table style="width:100%; height:94px; padding:0; margin:0px; background:#fff;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">'
						+ '<tr>'
							+ '<td><div style="margin:0 10px;">'
								+ '<h4 class="media-heading">'+fdata.satuan+'</h4>'
								+ '<div style="font-size:x-small">'+c+'</div><div style="font-size:small">'+fdata.luas+' Ha</div>'
							+ '</div></td>'
							+ '<td><img src="/brwa_admin/'+fdata.foto+'" style="border:1px solid #ddd; width:94px; height:94px; padding:0" alt="wa foto"></td>'
						+ '</tr>'
					+ '</table>'
			//var content = "<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+label0+"</td><td align='right' valign='middle'>"+label2+"</td></tr></table></div>"+"<div class='pop-box'>"+label1+"</div>"+label3;
			var content = tpl;//label1+" "+label2;
			
			//if (!feature.cluster) {
				var offset={ size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(5,5)}
				popupTooltip = new OpenLayers.Popup.Anchored("popup_tooltip",lonlat,null,content,offset,false,false);
			//}		
			popupTooltip.autoSize=true;
			//popupTooltip.opacity=0.8;
			//popupTooltip.keepInMap=true;
			//popupTooltip.panMapIfOutOfView=false;
			map.addPopup(popupTooltip);
		}
	}
	function feature_hover_pc(feature) {
		if (!feature.popup && feature.onScreen()) {
			var lonlat=feature.geometry.getBounds().getCenterLonLat();
			
			feature_out();
			var tpl = '<div class="media">'
					+ '<div class="media-body" style="width:100%;padding:5px; background:#fff">'
					+ '<h4 class="media-heading">'+feature.attributes.provinsi+'</h4>'
					+ '<span>Total Wilayah Adat: <strong>'+feature.attributes.total+'</strong></span>'
					+ '</div>'
					+ '</div>'
			//var content = "<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+label0+"</td><td align='right' valign='middle'>"+label2+"</td></tr></table></div>"+"<div class='pop-box'>"+label1+"</div>"+label3;
			var content = tpl;//label1+" "+label2;
			var xOffset = 0;
			var yOffset = (feature.attributes.yOffset)?feature.attributes.yOffset:-5;
			
			//if (!feature.cluster) {
				var offset={ size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,0)}
				popupTooltip = new OpenLayers.Popup.Anchored("popup_tooltip",lonlat,null,content,offset,false,false);
			//}		
			popupTooltip.autoSize=true;
			//popupTooltip.opacity=0.8;
			popupTooltip.keepInMap=true;
			popupTooltip.panMapIfOutOfView=false;
			map.addPopup(popupTooltip);
			
			
		}
	}
	function feature_out(feature) {
		if (popupTooltip) {
			//map.removePopup(popupTooltip);
			popupTooltip.destroy();
			//popupTooltip.hide();
			popupTooltip = false;
		}
		
	}
	
	
	
	
	function loadThemes(stheme,addcallback) {
		var stheme=(stheme)?stheme:ctheme;
		ctheme=stheme;

		$("#ttitle").html(themes[stheme]['themeTitle']);
		$("#coords").html(themes[stheme]['themeTitle']);
		$("#theme-top").html(themes[stheme]['themeTitle']);
		
		$("#nav").html(loaddiv);
		$("#data_search").empty();
		$("#map_legend").empty();
		$('#myTab a:first').tab('show');
		clearAllPopups();
		
		$("#nav").load(themes[stheme]['navUrl'],function() {
			//$tabs.tabs("select",0);
			$("#theme").change(function(){
				loadThemes($(this).val());
			});
			themeObj=null;
			//alert(listLayers);
			if (listLayers.length>0) {
				for(var i=0;i<listLayers.length;i++) {
					if (map.getLayer(listLayers[i])) {
						var layer = map.getLayer(listLayers[i]);
						layer.destroyFeatures();
						map.removeLayer(layer);
					}
				}
				listLayers=[];
			}
			//alert("themeObj=themeObj"+themes[stheme]['name']);
			eval("themeObj=themeObj"+themes[stheme]['name']);
			themeObj.init(param);
			if (mapbg) changeBaseMap(mapbg);
			if (param) {
				themeObj.searchData();
				param=false;
			}
			if (themeObjCallback) {
				$('#myTab a:last').tab('show');
				//$tabs.tabs("select",1);
				eval(themeObjCallback);
				themeObjCallback=false;
			};
			
		});
	}
	function triggerTheme() {
		$('a[rel="'+itheme+'"]').trigger('click');
	}
	function listClick(idx,mod,lonlat) {
	//alert(JSON.stringify(clayer.features[0].cluster));
		map.setCenter(lonlat,map.getZoom()>6?map.getZoom():6);
		
		if (map.getLayer("cpoly")) {
			for(var i = 0; i<cpoly.features.length;++i) {
				var gid= cpoly.features[i].attributes.idx;
				if (gid == idx)
				{     
					f = cpoly.features[i];
					//fc=f.clone();
					var lonlat = f.geometry.getBounds().getCenterLonLat();
					
					//prasarana.removeFeatures(f);
					//prasarana.addFeatures(fc);
					map.setCenter(lonlat,map.getZoom()>6?map.getZoom():6);
					selectCtrl.clickFeature(f);
					//onFeatureSelect(f);
					//(mod=='over')?feature_hover(f):feature_out(f);
					break;             
				}
			}
		}
	}
	function polyHoverData(layer_id,id) {
		if (map.getLayer(layer_id)) {
			var layer = map.getLayer(layer_id);
			
			for(var i = 0; i<layer.features.length;++i) {
				var data_id= layer.features[i].attributes.gid;
				if (data_id == id)
				{     
					f = prasarana.features[i];
					//fc=f.clone();
					var lonlat = f.geometry.getBounds().getCenterLonLat();
					//prasarana.removeFeatures(f);
					//prasarana.addFeatures(fc);
					(mod=='over')?feature_hover(f):feature_out(f);
					break;             
				}
			}
		}
	}
	function resetData(){
		themeObj.resetData();
	}
	function clearAllPopups() {
		var pops = map.popups;
		for(var p=0; p<pops.length;p++) {
			map.removePopup(pops[p]);
		}
	}
	function searchData(){
		themeObj.searchData(1);
	}
	function changeBaseMap(base) {
		if (base=='gmap') {
				try {
					if (!map.getLayer("g_street")) {
						gmap = new OpenLayers.Layer.Google("Google Streets", {numZoomLevels: 20});
						gmap.id = "g_street";
						map.addLayer(gmap);
					}
					map.setBaseLayer(gmap);
					//layer_anno.setVisibility(false);
					
				} catch (e) {
					alert("Can't load GoogleMap");
				}
		} else if (base=='ghyb') {
				try {
					if (!map.getLayer("g_hybrid")) {
						ghyb = new OpenLayers.Layer.Google("Google Hybrid", {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 20});
						ghyb.id = "g_hybrid";
						map.addLayer(ghyb);
					}
					map.setBaseLayer(ghyb);
					//layer_anno.setVisibility(false);
				} catch (e) {
					alert("Can't load Google Hybrid");
				}
				
		} else if (base=='osm') {
			map.setBaseLayer(layer_wi);
			//layer_anno.setVisibility(true);
		}
		else {
			//map.setBaseLayer(layer_bako_service);
				//if (map.getLayer("g_hybrid")) map.removeLayer(ghyb);
				//if (map.getLayer("g_street")) map.removeLayer(gmap);
		}	
		mapbg=base;
	}
	var loaddiv = '<div class="olControlLoader" style="display:block">Loading...</div>';
	$(window).load(function(){
		myLayout = $('body').layout({
		   defaults: {contentSelector:".content"}
		   /*,west: {
				 size:400
				,spacing_closed:0
				,spacing_open:0
				,resizable:true
				,onclose:function(){ adjust(); }
				,onopen:function(){ adjust();  }
				,initClosed:true
			}*/
		   //,north: {size:40,resizable:false,closable:false,spacing_closed:0,spacing_open:0}
		   //,south: {size:50,resizable:false,closable:false}
		   //,west__showOverflowOnHover: true
		});
		
		function adjust() {
			map.updateSize();
		}
		$(".data_close").click(function(){
			if (myLayout.state.west.isClosed) {
				myLayout.open('west');
				$(this).css("background","transparent url(assets/images/close-left.png)");
				$(this).attr("title","Close");
			}
			else {
				myLayout.close('west');
				$(this).css("background","transparent url(assets/images/open-left.png)");
				$(this).attr("title","Open");
			}
		});
		
		$(document).on("click","#search_submit", function(e){
			e.preventDefault();
			$("#data_search").html(loaddiv);
			themeObj.searchData();
			$('#myTab a:last').tab('show');
	   });
		
		$("#theme > li > a").click(function(e){
			var id = $(this).attr("rel");
			loadThemes(id);
			if (id) e.preventDefault();
		});
		
		$(".dd-basemap").click(function(e){
			$("#dd-basemap-parent span").html($(this).html());
			changeBaseMap($(this).prop("rel"));
			e.preventDefault();
		});
		$(".dd-basemap-o").click(function(e){
			$("#dd-basemap-o-parent span").html($(this).html());
			document.getElementById('map_detil').contentWindow.changeBaseMap($(this).prop("rel"));
			e.preventDefault();
		});
		$(document).on("click",".search_name,.open_detil", function(e){
			e.preventDefault();
			var kdw = $(this).attr("data-kode");
			var thn = $(this).attr("data-tahun");
			var ind = $(this).attr("data-indikator");
			var url = "wa/view_gis/"+selectedWilayah;//themes[ctheme]['detailUrl']+kdw+"/"+thn+"/"+ind;
	
			$("#map_detil_box").height($("#maped").height()-1);
			$("#map_detil").height($("#maped").height()-36).attr("src",url);
			$("#map_detil_box").show();	
	   });
		$("#detail-close").click(function(e){
			$("#map_detil_box").hide();
			$("#map_detil").attr("src","");
			e.preventDefault();
		})
		$("#detail-back").click(function(e){
			history.back();
			e.preventDefault();
		});
		$("#detail-print").click(function(e){
			e.preventDefault();
			printIframe('map_detil');
		});
		
		$(document).on("change","#propinsi_list", function(e){
			e.preventDefault();
			var option_selected = $(this).find('option:selected');
			if (option_selected.attr("rel")=="change") {
				var url = themes[ctheme]['navUrl']+$(this).val()+"/"+option_selected.attr("kode_dagri");
				$("#nav").load(url);
			}
	   });
		init();
	});
	function printIframe(id)
	{
		var iframe = document.frames ? document.frames[id] : document.getElementById(id);
		var ifWin = iframe.contentWindow || iframe;
		iframe.focus();
		ifWin.print();
		return false;
	}
</script>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300' rel='stylesheet' type='text/css'>
<style>
body {
	background:#ffffff;
	color:#333333;
	font-family:'Open Sans'
}
#map_legend i {
    width: 18px;
    height: 18px;
    float: left;
    margin-right: 8px;
    opacity: 0.9;
}
#map_legend {
	font-size:.95em;
    background: none repeat scroll 0% 0% rgba(255, 255, 255, 0.8);
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    /*border-radius: 5px;*/
    line-height: 18px;
    color: #555;
    padding: 8px;
}

.menu_bar {
	position:absolute; 
	/*background-image: linear-gradient(to bottom, #069, #17A);*/
	background:transparent;
	background-repeat: repeat-x; 
	opacity:.1; 
	height:40px; 
	width:100%; 
	z-index:1001;
	/*box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);*/
}

.nav-tabs > li > a {
    background-color: rgba(100,100,100,0.1);
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    background-color: #f5f5f5;
}
.nav i {
	font-size:16px;
	line-height:20px;
}
#top-layouts .nav-pills > li + li {
    margin-left: 0px;
	border-collapse:collapse;
}
#top-layouts .nav-pills > li > a {
	color:#eee;
	border-radius:0!important;
}
#top-layouts .nav-pills > li > a:hover,#top-layouts .nav-pills > li > a:focus {
	background:#555;
}
.nav a {
	font-size: 14px;
	font-weight: 400;
	color:#fff;
}
.nav a:focus {
    outline: none;
}
.nav-tabs {
    border-bottom: 0px solid #DDD;
}
.form-control {
    border-radius: 0px!important;
    box-shadow: none;
}
.panel-group {
    margin-bottom: 0px;
}
.panel-bodyx {
    padding: 10px;
}
.panel-group .panel {
    border-radius: 0px!important;
	border:none;
	box-shadow:none;
	/*box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);*/
}
.panel-group .panel + .panel {
    margin-top: 0px;
	border-top:1px solid #ddd;
}
.panel-heading {
    padding: 5px 17px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px!important;
    border-top-right-radius: 0px!important;
}
.acctext {
	font-size:.75em;
	font-weight:bold;
	line-height:18px
}
.btn {
	border-radius:0!important
}
.btn:focus {
	outline:none
}
img.desaturate{
	-webkit-filter: grayscale(100%);
	filter: grayscale(100%);
	filter: gray;
	filter: url("data:image/svg+xml;utf8,<svg version='1.1' xmlns='http://www.w3.org/2000/svg' height='0'><filter id='greyscale'><feColorMatrix type='matrix' values='0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0' /></filter></svg>#greyscale");
	opacity:0.5
}
img.desaturate:hover{
	-webkit-filter: grayscale(0%);
	filter: grayscale(0%);
}
</style>
</head>

<body>
<div id="loader" style="position:absolute; left:50%; margin-left:-100px; width:200px; line-height:30px; background:#000; z-index:5001; opacity:0.3; display:none; color:#fff; text-align:center; vertical-align:middle">Loading...</div>