<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="Description" CONTENT=" ">
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8" />
<title>SIM-GIS - Ditjen PUM - Kemendagri RI</title>
<base href="<?=BASE_URL;?>" />
<link rel="shortcut icon" href="assets/image/favicon.ico" />
<link rel="stylesheet" type="text/css" href="assets/js/bootstrap/css/bootstrap.css" media="screen">
<link rel="stylesheet" href="assets/css/fa/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/js/bootstrap/css/lat.css" media="screen">
<script src="assets/js/1.7.2/jquery.min.js"></script>
<script src="assets/js/jquery.layout.latest.js"></script>
<script src="assets/js/bootstrap/js/bootstrap.min.js"></script>
<!--MAP-->
<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script src="assets/js/OL212/OpenLayers.js"></script>
<script src="assets/js/oloverride/FramedCloud.js"></script>
<script src="assets/js/oplyr28/Tooltip.js"></script>
<script src="assets/js/module/ddw.js"></script>
<script src="assets/js/module/ipm.js"></script>
<script src="assets/js/module/ppp.js"></script>
<script src="assets/js/module/ang.js"></script>
<script>
	OpenLayers.Renderer.symbol = {
		"triangle2": [0,5, 0,12, 10,12, 10,5, 5,0, 0,5],
		"triangle": [0,5, 0,12, 4,15, 5,17, 6,15, 10,12, 10,5, 0,5]
	};

	var map;
	var ext = false;
	var itheme = false;
	var themeObj = null;
	var themeObjCallback = false;
	var selectedFeature = false;
	var listLayers = [];
	var layersLoading = 0;
	//var ctheme = 'default';
	
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
	var themes = {
		"default": {
			themeTitle: "Data Dasar Wilayah",
			listUrl: "sig/wilayah/map_json/",
			legendUrl: "sig/wilayah/map_legend/",
			searchUrl: "sig/wilayah/map_search/",
			detailUrl: "sig/wilayah/map_detail/",
			tahunUrl: "sig/wilayah/list_tahun/",
			navUrl: "sig/wilayah/map_filter/",
			name: "Ddw"
		},
		"ipm": {
			themeTitle: "Indeks Pembangunan Manusia (IPM)",
			listUrl: "sig/ipm/map_json/",
			legendUrl: "sig/ipm/map_legend/",
			searchUrl: "sig/ipm/map_search/",
			detailUrl: "sig/ipm/map_detail/",
			tahunUrl: "sig/ipm/list_tahun/",
			navUrl: "sig/ipm/map_filter/",
			name: "Ipm"
		},
		"ppp": {
			themeTitle: "Data Personil Pol PP dan Linmas",
			listUrl: "sig/satpolpp/map_json/",
			legendUrl: "sig/satpolpp/map_legend/",
			searchUrl: "sig/satpolpp/map_search/",
			detailUrl: "sig/satpolpp/map_detail/",
			tahunUrl: "sig/satpolpp/list_tahun/",
			navUrl: "sig/satpolpp/map_filter/",
			name: "Ppp"
		},
		"anggaran": {
			themeTitle: "Data Sebaran Anggaran Wilayah",
			listUrl: "sig/anggaran/map_json/",
			legendUrl: "sig/anggaran/map_legend/",
			searchUrl: "sig/anggaran/map_search/",
			detailUrl: "sig/anggaran/map_detail/",
			tahunUrl: "sig/anggaran/list_tahun/",
			navUrl: "sig/anggaran/map_filter/",
			name: "Ang"
		}
	};
	
function init() {
		map = new OpenLayers.Map({
			div: "maped",
			projection: "EPSG:900913",
			displayProjection:"EPSG:4326",
			paddingForPopups: new OpenLayers.Bounds(30,50,30,50)
			//controls:[]
		});
		var scale_holder = document.getElementById("map_attribute");
		scaleline = new OpenLayers.Control.ScaleLine({'maxWidth':140,'geodesic':true,div:scale_holder});
		attribution = new OpenLayers.Control.Attribution();
		map.addControl(scaleline);
		map.addControl(new OpenLayers.Control.KeyboardDefaults());
		map.addControl(new OpenLayers.Control.Navigation({dragPanOptions: {enableKinetic: true}}));
		map.addControl(attribution);
		
		//map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false,'position': new OpenLayers.Pixel(10,30)}));
		//map.addControl(new OpenLayers.Control.Scale());
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
				"http://a.tile.lingkar.co.id/w0/${z}/${x}/${y}.gif",
				"http://b.tile.lingkar.co.id/w0/${z}/${x}/${y}.gif",
				"http://c.tile.lingkar.co.id/w0/${z}/${x}/${y}.gif",
			], {
				attribution: "Tiles &copy; <a href='http://lingkar.co.id/'>Lingkar</a> | " + 
					"Data &copy; <a href='http://www.openstreetmap.org/'>OpenStreetMap</a> " +
					"and contributors, CC-BY-SA",
				buffer: 2,
				numZoomLevels: 16,
				wrapDateLine:true,
				transitionEffect: 'resize'
			}
		);		layer_wi.id = 'lokal';
		map.addLayer(layer_wi);
		
		ovControl = new OpenLayers.Control.OverviewMap({minRatio: 7, maxRatio: 8,maximized:true,autoPan:true,size: new OpenLayers.Size(153,120)});
		ovControl.isSuitableOverview = function() {
			return false;
		};
		map.addControl(ovControl);
			
		
		if (ext) ext = new OpenLayers.Bounds(ext.split(","));
		(itheme)?triggerTheme():loadThemes();
		
		var id_bounds = new OpenLayers.Bounds(94,-8,141,6);
		map.zoomToExtent(id_bounds.transform(proj, map.getProjectionObject()));
	}	//POINT
	var stylePrasarana=new OpenLayers.StyleMap(
	{
		"default": {
			cursor: "pointer",
			externalGraphic: "${extimage}",
			graphicWidth: "${gW}",
			graphicHeight: "${gH}",
			graphicXOffset: "${xOffset}",
			graphicYOffset: "${yOffset}",
			/*backgroundGraphic:"public/images/map_icon/marker_shadow.png",*/
			backgroundXOffset: 0,
			backgroundYOffset: -7,
			backgroundGraphicZIndex:0,
			graphicZIndex: 1
		}
		,"select": {
			cursor: "pointer",
			graphicZIndex: 2
		}
		,"temporary": {
			cursor: "pointer",
			label: "${label_hover}"
		}

	});
	//POLYGON
	var stylePoly=new OpenLayers.StyleMap(
	{
		"default": {
			cursor: "pointer",
			fillColor:"${color}",
			strokeColor:"#ffffff",
			strokeWidth:0.5,
			fillOpacity: 0.6,
			//label:"${kode_wilayah}",
			labelAlign: "cc",
			fontColor: "${strokecolor}",
			fontFamily: "Arial",
			fontSize: 11,
			labelOutlineColor: "${color}",
			labelOutlineWidth: 3,
			labelSelect:true
		}
		,"select": {
			cursor: "pointer",
			fillOpacity: 0.8
		}
		,"temporary": {
			cursor: "pointer",
			label: "${label_hover}",
			fillColor:"${hlcolor}"
		}

	});
	function onPopupClose(evt) {
		selectCtrl.unselectAll();
		$(".search_item").removeClass("search_item_active");
	}
	function onFeatureSelect(feature) {
		selectedFeature = feature;
		var lonlat=feature.geometry.getBounds().getCenterLonLat();
		var gid=feature.attributes.gid;
		var url=feature.attributes.url;
		var attr=feature.attributes.attr;
		onFeatureUnselect(feature)
		if (!feature.popup && feature.onScreen()) {
			var label0 = "<div class='pop '>"+feature.attributes.label0+"</div>";
			var label1 = "<div class='pop pop_label1'>"+feature.attributes.label1+"</div>";
			var label2 = "<div class='pop pop_label2'>"+feature.attributes.label2+"</div>";
			var label3 = "<div class='pop pop_label3'>"+feature.attributes.label3+"</div>";
			var content = "<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+label0+"</td><td align='right' valign='middle'>"+label2+"</td></tr></table></div>"+"<div class='pop-box'>"+label1+"</div>"+label3;

			
			var xOffset = 0;
			var yOffset = (feature.attributes.yOffset)?feature.attributes.yOffset:-5;
			var offset={ size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,-3)}
			
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
		}
	}
	function onFeatureUnselect(feature) {
		if (feature.popup) {
			map.removePopup(feature.popup);
			feature.popup.destroy();
			feature.popup = null;
		}
		$(".search_item").removeClass("search_item_active");
	}    
	function feature_hover(feature) {
		if (!feature.popup && feature.onScreen()) {
			var lonlat=feature.geometry.getBounds().getCenterLonLat();
			feature.move(lonlat);
			var label = (feature.cluster) ?feature.attributes.count:feature.attributes.label;
			var label_kat = (feature.cluster) ?"Zoom untuk melihat":feature.attributes.label_kat;
			//var content = "<div style='font-size:.8em;width:auto;padding:2px;font-weight:bold'>"+label+"<br><span style='font-size:0.9em; font-weight:normal'>"+label_kat+"</span></div>";
			//<span style='font-size:0.9em; font-weight:normal'>"+feature.attributes.label2+"</span><br>
			//var content = "<div style='font-size:1em;width:auto;padding:5px;font-weight:bold'>"+feature.attributes.label1+"<br><span style='font-size:0.9em; font-weight:normal'>"+feature.attributes.label3+"</span></div>";
			
			var label1 = "<div class='hov_label1'>"+feature.attributes.label1+"</div>";
			var label2 = "<div class='hov_label3'>"+feature.attributes.label_pop+"</div>";
			//var content = "<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+label0+"</td><td align='right' valign='middle'>"+label2+"</td></tr></table></div>"+"<div class='pop-box'>"+label1+"</div>"+label3;
			var content = "<div class='hov-box'>"+label1+"</div>"+label2;
			var xOffset = 0;
			var yOffset = (feature.attributes.yOffset)?feature.attributes.yOffset:-5;
			
			//if (!feature.cluster) {
				var offset={ size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,-3)}
				popupTooltip = new OpenLayers.Popup.Tooltip("popup_tooltip",lonlat,null,content,offset,false,false);
			//}		
			popupTooltip.maxSize=new OpenLayers.Size(550,350);
			popupTooltip.opacity=0.8;
			popupTooltip.backgroundColor='transparent';
			popupTooltip.contentDisplayClass='map_anchored';
			popupTooltip.keepInMap=false;
			popupTooltip.panMapIfOutOfView=false;
			map.addPopup(popupTooltip);
		}
	}
	function feature_outs(feature) {
		if (popupTooltip) {
			map.removePopup(popupTooltip);
			popupTooltip.destroy();
			popupTooltip = false;
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
	function hoverData(gid,mod) {
		for(var i = 0; i<prasarana.features.length;++i) {
			var data_gid= prasarana.features[i].attributes.gid;
			if (data_gid == gid)
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
	function hpikDetail(id) {
		if (ctheme!='pemantauan') {
			$('a[rel="pemantauan"]').trigger('click');
			themeObjCallback = 'themeObj.searchData("'+id+'")';
		}
		else {
			clearAllPopups();
			themeObj.searchData(id)
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
				
		} else if (base=='local') {
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
		   ,west: {
				 size:360
				,spacing_closed:0
				,spacing_open:0
				,resizable:true
				,onclose:function(){ adjust(); }
				,onopen:function(){ adjust();  }
				//,initClosed:true
			}
		   ,north: {size:47,resizable:false,closable:false,spacing_closed:0,spacing_open:0}
		   ,south: {size:50,resizable:false,closable:false}
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
		$("#search_submit").live("click",function(){
			$("#data_search").html(loaddiv);
			themeObj.searchData();
			$('#myTab a:last').tab('show');
			//$tabs.tabs("select",1);
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
		$(".search_name,.open_detil").live("click",function(e){
			var kdw = $(this).attr("data-kode");
			var thn = $(this).attr("data-tahun");
			var ind = $(this).attr("data-indikator");
			var url = themes[ctheme]['detailUrl']+kdw+"/"+thn+"/"+ind;
	
			$("#map_detil_box").height($("#maped").height()-1);
			$("#map_detil").height($("#maped").height()-36).attr("src",url);
			$("#map_detil_box").show();	
			e.preventDefault();
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
		
		$("#propinsi_list").live("change",function(e){
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
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,200' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Monda:400,700);
@import url(http://fonts.googleapis.com/css?family=Open+Sans);
body {
	font-family:'Sintony','Titillium Web','Monda','Open Sans',"Segoe UI";
	font-weight:normal;
}
img { max-width:none; }
li {
    line-height: 14px;
}
.navbar-inverse .nav > li > a {
    color: #eee;
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
	text-transform:uppercase;
	font-weight:normal;
}
blockquote {
  border-left: 5px solid #cccccc;
}
.search-item {
	position:relative;padding:5px 10px 10px 25px; margin-bottom:10px; border-bottom:0px dotted #ccc
}
.search-item:hover {
	background-color:#f5f5f5;
}
.subheader {
	font-weight: 600
}
.subheader small {
	font-weight: lighter
}
.pop {
	padding:5px 10px;
}
.pop-box {
	padding:0; margin-bottom:5px;
	min-width:250px
}
.pop_label0 {
	font-size:.9em;width:auto; vertical-align:middle; height:40px; padding:0;
	text-transform:uppercase;
}
.pop-box table {
	border:0;
	width:100%;
}
.pop_label1 {
	font-size:large;width:auto;font-weight:bold;
	background:#eee;
}
.hov-box {
	padding:5px;
	min-width:250px
}
.hov_label1 {
	font-size:medium;font-weight:bold;
	border-bottom:1px solid #ccc;
}
.hov_label3 {
	font-size:0.8em; font-weight:normal
}
.hov-legend {
	display:inline-block; width:10px; height:10px; margin:0 5px; 
	border:1px solid #ddd
}
.pop_label2 {
	font-size:24px;
	color:#aaa;
	width:auto;
	font-weight: lighter;
	float:right;
	border-left:1px solid #ddd;
	line-height:40px;
	height:40px
}
.pop_label3 {
	font-size:0.9em; font-weight:normal
}

.nav-tabs {
  border-bottom: 1px solid #bbb;
}
.nav-tabs > li > a {
	line-height:16px;
	border-radius:0
}
.nav-tabs > .active > a,
.nav-tabs > .active > a:hover,
.nav-tabs > .active > a:focus {
  color: #555;
  background-color: #ddd;
  border: 1px solid #bbb;
  border-bottom-color: transparent;
  cursor: default;
}
.nav-tabs > li > a:hover,
.nav-tabs > li > a:focus {
  border-color: #ccc #ccc #bbb;
}
.nav > li > a:hover,
.nav > li > a:focus {
  text-decoration: none;
  background-color: #eee;
}
</style>
</head>

<body>
  <div id="top-layout" class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">GIS Demografi</a>
            <ul class="nav lat-nav">
              <li><a href="#">Home</a></li>
              <li><a href="CMS_GIS_3"><i class="icon-user icon-white"></i> Login</a></li>
            </ul>
            <ul class="nav lat-nav pull-right">
              <li><a><?=date("d/m/Y");?></a></li>
            </ul>
        </div>
      </div><!-- /navbar-inner -->
    </div><!-- /navbar -->
  </div>
