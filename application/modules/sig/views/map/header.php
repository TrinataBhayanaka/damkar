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
	function init(){map=new OpenLayers.Map({div:"maped",projection:"EPSG:900913",displayProjection:"EPSG:4326",paddingForPopups:new OpenLayers.Bounds(450,0,30,50),controls:[]})
var e=document.getElementById("map_attribute")
scaleline=new OpenLayers.Control.ScaleLine({maxWidth:200,geodesic:!0,div:e}),attribution=new OpenLayers.Control.Attribution,map.addControl(scaleline),map.addControl(new OpenLayers.Control.KeyboardDefaults),map.addControl(new OpenLayers.Control.Navigation({dragPanOptions:{enableKinetic:!0}})),map.addControl(attribution),map.addControl(new OpenLayers.Control.Scale),map.events.register("preaddlayer",map,function(e){e.layer&&(e.layer.events.register("loadstart",this,function(){layersLoading++,layersLoading>0&&$("#loader").show()}),e.layer.events.register("loadend",this,function(){layersLoading>0&&layersLoading--,0==layersLoading&&$("#loader").hide()}))}),layer_wi=new OpenLayers.Layer.XYZ("XYZ Lingkar",["http://a.tile.openstreetmap.org/${z}/${x}/${y}.png","http://b.tile.openstreetmap.org/${z}/${x}/${y}.png","http://c.tile.openstreetmap.org/${z}/${x}/${y}.png"],{attribution:"App & Data &copy; <a href='http://brwa.or.id/'>BRWA</a>. Powered by <a href='http://dinamof.co.id/'>Dinamof</a> (LAT) | Map &copy; <a href='http://www.openstreetmap.org/'>OpenStreetMap</a> and contributors, CC-BY-SA",buffer:2,numZoomLevels:16,wrapDateLine:!0,transitionEffect:"resize"}),layer_wi.id="lokal",map.addLayer(layer_wi),ovControl=new OpenLayers.Control.OverviewMap({maximized:!0,autoPan:!0,size:new OpenLayers.Size(180,110)}),ovControl.isSuitableOverview=function(){return!1},map.addControl(ovControl)
var t=new OpenLayers.Control.Click
map.addControl(t),t.activate()
var a=new OpenLayers.Bounds(94,-8,141,6)
map.zoomToExtent(a.transform(proj,map.getProjectionObject())),legendTheme(),getData()}function legendTheme(){for(var e=document.getElementById("map_legend"),t=0;t<colors.length-1;t++){var a=document.createElement("i"),r=document.createTextNode(text[t]),o=document.createElement("br")
a.setAttribute("style","background:"+colors[t]),e.appendChild(a),e.appendChild(r),e.appendChild(o)}}function getData(e,t,a,r,o){0!=selectedFeature&&onFeatureUnselect(selectedFeature)
var n=e?e:"0000",i=t?"kabupaten":"propinsi"
t&&(n=t)
var a=a?a:"",r=r?"?f="+r:"",o=o?r?"&q="+o:"?q="+o:""
$("#data-list").load("/brwa_services/gis/gis/data_list_by_"+i+"/"+n+"/"+a+r+o,function(){dataShow(),$("li.media-wa").click(function(){var e=new OpenLayers.LonLat($(this).data("lon"),$(this).data("lat"))
listClick($(this).data("idx"),"over",e.transform(proj,map.getProjectionObject()))})}),$("#data-stats").load("/brwa_services/gis/gis/data_stats_by_"+i+"/"+n+"/"+a+r+o),$("#data-stats-total").load("/brwa_services/gis/gis/data_stats2_by_propinsi/0000")
var l={getColor:function(e){var t=parseInt(e.attributes.total)
return t=t>100?0:t>30?1:t>10?2:t>8?3:t>4?4:t>2?5:t>=1?6:7,colors[t]},getSize:function(e){var t=parseInt(e.attributes.total)
return t=t>100?0:t>30?1:t>10?2:t>8?3:t>4?4:t>2?5:t>=1?6:7,size[t]}},s={pointRadius:"${getSize}",fillColor:"${getColor}",strokeWidth:1,fillOpacity:.6,label:"${total}",labelAlign:"center",fontFamily:"Arial",fontSize:"16px",fontColor:"#000",labelOutlineWidth:0,labelSelect:!0},p=new OpenLayers.Style(s,{context:l}),d=["SVG","VML"]
map.getLayer("polylayer")&&(polylayer.destroyFeatures(),map.removeLayer(polylayer)),polylayer=new OpenLayers.Layer.Vector("TEST",{minScale:7000001,maxScale:2e6,styleMap:new OpenLayers.StyleMap({"default":p,select:{fillOpacity:.9},temporary:{fillOpacity:.8}}),renderers:d,rendererOptions:{zIndexing:!0},strategies:[new OpenLayers.Strategy.Fixed],protocol:new OpenLayers.Protocol.HTTP({url:"/brwa_services/gis/gis/data_"+i+"/"+n+"/"+a+r+o,params:{},format:new OpenLayers.Format.GeoJSON({ignoreExtraDims:!0,keepData:!0,internalProjection:gproj,externalProjection:proj})}),eventListeners:{featuresadded:function(){Zoomer(polylayer)}}}),polylayer.id="polylayer",map.addLayer(polylayer),polylayer.refresh(),map.getLayer("circlelayer")&&(circlelayer.destroyFeatures(),map.removeLayer(circlelayer)),circlelayer=new OpenLayers.Layer.Vector("TEST",{maxScale:7000001,styleMap:new OpenLayers.StyleMap(p),renderers:d,rendererOptions:{zIndexing:!0},strategies:[new OpenLayers.Strategy.Fixed],protocol:new OpenLayers.Protocol.HTTP({url:"/brwa_services/gis/gis/data_"+i+"_point/"+n+"/"+a+r+o,params:{},format:new OpenLayers.Format.GeoJSON({ignoreExtraDims:!0,keepData:!0,internalProjection:gproj,externalProjection:proj})})}),circlelayer.id="circlelayer",map.addLayer(circlelayer),map.setLayerIndex(circlelayer,1),circlelayer.refresh()
var c=new OpenLayers.Style({pointRadius:"${radius}",fillColor:"${color}",strokeColor:"${color}",fillOpacity:"${opacity}",strokeWidth:"${width}",strokeOpacity:1,strokeDashstyle:"${dashed}",label:"${flabel}",fontColor:"#FFF",fontSize:"10px"},{context:{width:function(){return map.getZoom()>9?2:1},opacity:function(e){return e.attributes.geom?.4:.7},dashed:function(e){return e.attributes.geom?"dashdot":"solid"},flabel:function(e){return map.getZoom()>9&&e.attributes.geom?e.attributes.satuan:""},radius:function(){var e=map.getZoom()
return e-2},label:function(e){return e.attributes.count>1?e.attributes.count:""},color:function(e){{var t="#ccc",a=parseInt(e.attributes.wa_status)
parseInt(e.attributes.doc_status)}return t=0==a?"orange":1==a?"#3C8DBC":2==a?"green":"red"}}})
map.getLayer("cpoly")&&(cpoly.destroyFeatures(),map.removeLayer(cpoly)),cpoly=new OpenLayers.Layer.Vector("WA POLY",{minScale:2000001,styleMap:new OpenLayers.StyleMap({"default":c,select:{fillOpacity:.6,strokeWidth:2,strokeColor:"yellow",strokeDashstyle:"solid"},temporary:{fillOpacity:.3}}),renderers:d,rendererOptions:{zIndexing:!0},strategies:[new OpenLayers.Strategy.Fixed],protocol:new OpenLayers.Protocol.HTTP({url:"/brwa_services/gis/gis/data_wa_"+i+"_poly/"+n+"/"+a+r+o,params:{},format:new OpenLayers.Format.GeoJSON({ignoreExtraDims:!0,keepData:!0,internalProjection:gproj,externalProjection:proj})}),eventListeners:{featuresadded:feature_out}}),cpoly.id="cpoly",map.addLayer(cpoly),map.setLayerIndex(cpoly,1),cpoly.refresh()
var u=new OpenLayers.Style({pointRadius:"${radius}",fillColor:"${color}",strokeColor:"#FFF",fillOpacity:1,strokeWidth:"${width}",strokeOpacity:.8,label:"${label}",fontColor:"#FFF"},{context:{width:function(){return 1},radius:function(){var e=2,t=map.getZoom()
return t-e},label:function(e){return e.attributes.count>1?e.attributes.count:""},color:function(e){{var t="#ccc",a=parseInt(e.attributes.wa_status)
parseInt(e.attributes.doc_status)}return t=0==a?"orange":1==a?"#3C8DBC":2==a?"green":"red"}}})
map.getLayer("clayer")&&(clayer.destroyFeatures(),map.removeLayer(clayer)),clayer=new OpenLayers.Layer.Vector("CLUSTER",{minScale:7000001,maxScale:2e6,styleMap:new OpenLayers.StyleMap({"default":u,select:{strokeOpacity:1},temporary:{strokeOpacity:1}}),renderers:d,rendererOptions:{zIndexing:!0},strategies:[new OpenLayers.Strategy.Fixed],protocol:new OpenLayers.Protocol.HTTP({url:"/brwa_services/gis/gis/data_wa_"+i+"_point/"+n+"/"+a+r+o,params:{},format:new OpenLayers.Format.GeoJSON({ignoreExtraDims:!0,keepData:!0,internalProjection:gproj,externalProjection:proj})}),eventListeners:{featuresadded:feature_out}}),clayer.id="clayer",map.addLayer(clayer),clayer.refresh(),highlightCtrl=new OpenLayers.Control.SelectFeature([clayer],{multiple:!0,hover:!0,highlightOnly:!0,renderIntent:"temporary"}),popCtrl=new OpenLayers.Control.SelectFeature([clayer,cpoly],{multiple:!0,hover:!0,highlightOnly:!1,renderIntent:"temporary",callbacks:{over:feature_hover,out:feature_out}}),selectCtrl=new OpenLayers.Control.SelectFeature([cpoly,clayer,polylayer],{onSelect:onFeatureSelect,onUnselect:onFeatureUnselect}),map.addControls([highlightCtrl,selectCtrl,popCtrl]),highlightCtrl.activate(),popCtrl.activate(),selectCtrl.activate(),map.setLayerIndex(polylayer,0)}function Zoomer(e){var t=ext?ext:e.getDataExtent()
if(map.zoomToExtent(t,0),t.left){var a=new OpenLayers.LonLat(t.left,t.bottom),r=map.getPixelFromLonLat(a),o=0
r.x<400&&(o=430-r.x),map.pan(-o,-20,{animate:!1})}}function mapEvent(e){{var t=e.type
map.getExtent(),map.zoom}"click"==t&&dataHide()}function dataHide(){$("#data-container").slideUp("fast",function(){$("#data-list-small").slideDown("fast")})}function dataShow(){$("#data-container").slideDown(),$("#data-list-small").slideUp(),$("#detil-container").slideUp(),onPopupClose()}function detilHide(){$("#detil-container").slideUp("fast")}function detilShow(e){dataHide(),e?($("#detil-container").removeClass("hide"),$("#data-detil").load(e,function(){$("#detil-container").slideDown("fast")})):$("#detil-container").slideDown("fast"),$("#myTab li:eq(1) a").tab("show")}function onPopupClose(){selectCtrl.unselectAll()}function onFeatureSelect(e){onFeatureUnselect(selectedFeature),selectedFeature=e
var t=e.geometry.getBounds().getCenterLonLat(),a=e.attributes.gid,r=e.attributes.url,o=(e.attributes.attr,e.attributes.count?e.cluster[0].data:e.attributes)
if(o.total)return feature_hover_pc(e),!1
if(onFeatureUnselect(e),selectedWilayah=o.idx,e.popup||!e.onScreen()||1!=e.attributes.count&&e.attributes.count){var n=(map.getViewPortPxFromLonLat(t),map.getZoom())
map.setCenter(t,n+1)}else{var i="<div class='pop' style='text-transform:uppercase'><strong>"+o.satuan+"</strong></div>",l="<div class='pop pop_label1'></div>",s="<div class='pop pop_label2'>"+wa_status[o.wa_status]+"</div>",p="<div class='pop pop_label3'>"+o.luas+" Ha</div>",d="<div class='pop-box'><table><tr><td class='pop_label0' valign='middle'>"+i+"</td><td align='right' valign='middle'>"+s+"</td></tr></table></div><div class='pop-box'>"+l+"</div>"+p,d=i+s+l+p,c=(e.attributes.yOffset?e.attributes.yOffset:-5,{size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,0)})
popup=new OpenLayers.Popup.FramedCloud("popup_"+a,t,null,d,c,!1,onPopupClose),popup.hide(),popup.minSize=new OpenLayers.Size(200,100),popup.autoSize=!0,popup.maxSize=new OpenLayers.Size(600,400),popup.calculateRelativePosition=function(){return"tr"},e.popup=popup,cPopup=popup,fPopup=e,map.addPopup(popup,!0)
var r="/brwa_services/gis/gis/data_wa_detil/"+o.idx
detilShow(r)}}function onFeatureUnselect(e){feature_out(e),e.popup&&(map.removePopup(e.popup),e.popup.destroy(),e.popup=null),detilHide(),$(".search_item").removeClass("search_item_active")}function feature_hover(e){if(!e.popup&&e.onScreen()){var t=e.geometry.getBounds().getCenterLonLat(),a=e.attributes.count?e.cluster[0].data:e.attributes
if(feature_out(),e.attributes.count>1)return!1
{var r=parseInt(a.wa_status)
parseInt(a.doc_status)}c=0==r?"In Progress":1==r?"Teregistrasi":2==r?"Terverifikasi":"Tersertifikasi"
var o='<div class="media" style="min-width:250px; padding:0;"><div class="media-body" style="padding:0;margin:0"><h4 class="media-heading">'+a.satuan+'</h4><div style="font-size:x-small">'+c+'</div><div style="font-size:small">'+a.luas+' Ha</div></div><div class="media-right" style="padding:0; position:absolute; right:0px; top:0px"><img src="/brwa_admin/'+a.foto+'" style="border:1px solid #ddd; width:94px; height:94px; padding:0" alt="wa foto"></div></div>',o='<table style="width:100%; height:94px; padding:0; margin:0px; background:#fff;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);"><tr><td><div style="margin:0 10px;"><h4 class="media-heading">'+a.satuan+'</h4><div style="font-size:x-small">'+c+'</div><div style="font-size:small">'+a.luas+' Ha</div></div></td><td><img src="/brwa_admin/'+a.foto+'" style="border:1px solid #ddd; width:94px; height:94px; padding:0" alt="wa foto"></td></tr></table>',n=o,i={size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(5,5)}
popupTooltip=new OpenLayers.Popup.Anchored("popup_tooltip",t,null,n,i,!1,!1),popupTooltip.autoSize=!0,map.addPopup(popupTooltip)}}function feature_hover_pc(e){if(!e.popup&&e.onScreen()){var t=e.geometry.getBounds().getCenterLonLat()
feature_out()
var a='<div class="media"><div class="media-body" style="width:100%;padding:5px; background:#fff"><h4 class="media-heading">'+e.attributes.provinsi+"</h4><span>Total Wilayah Adat: <strong>"+e.attributes.total+"</strong></span></div></div>",r=a,o=(e.attributes.yOffset?e.attributes.yOffset:-5,{size:new OpenLayers.Size(0,0),offset:new OpenLayers.Pixel(0,0)})
popupTooltip=new OpenLayers.Popup.Anchored("popup_tooltip",t,null,r,o,!1,!1),popupTooltip.autoSize=!0,popupTooltip.keepInMap=!0,popupTooltip.panMapIfOutOfView=!1,map.addPopup(popupTooltip)}}function feature_out(){popupTooltip&&(popupTooltip.destroy(),popupTooltip=!1)}function loadThemes(stheme,addcallback){var stheme=stheme?stheme:ctheme
ctheme=stheme,$("#ttitle").html(themes[stheme].themeTitle),$("#coords").html(themes[stheme].themeTitle),$("#theme-top").html(themes[stheme].themeTitle),$("#nav").html(loaddiv),$("#data_search").empty(),$("#map_legend").empty(),$("#myTab a:first").tab("show"),clearAllPopups(),$("#nav").load(themes[stheme].navUrl,function(){if($("#theme").change(function(){loadThemes($(this).val())}),themeObj=null,listLayers.length>0){for(var i=0;i<listLayers.length;i++)if(map.getLayer(listLayers[i])){var layer=map.getLayer(listLayers[i])
layer.destroyFeatures(),map.removeLayer(layer)}listLayers=[]}eval("themeObj=themeObj"+themes[stheme].name),themeObj.init(param),mapbg&&changeBaseMap(mapbg),param&&(themeObj.searchData(),param=!1),themeObjCallback&&($("#myTab a:last").tab("show"),eval(themeObjCallback),themeObjCallback=!1)})}function triggerTheme(){$('a[rel="'+itheme+'"]').trigger("click")}function listClick(e,t,a){if(map.setCenter(a,map.getZoom()>6?map.getZoom():6),map.getLayer("cpoly"))for(var r=0;r<cpoly.features.length;++r){var o=cpoly.features[r].attributes.idx
if(o==e){f=cpoly.features[r]
var a=f.geometry.getBounds().getCenterLonLat()
map.setCenter(a,map.getZoom()>6?map.getZoom():6),selectCtrl.clickFeature(f)
break}}}function polyHoverData(e,t){if(map.getLayer(e))for(var a=map.getLayer(e),r=0;r<a.features.length;++r){var o=a.features[r].attributes.gid
if(o==t){f=prasarana.features[r]
{f.geometry.getBounds().getCenterLonLat()}"over"==mod?feature_hover(f):feature_out(f)
break}}}function resetData(){themeObj.resetData()}function clearAllPopups(){for(var e=map.popups,t=0;t<e.length;t++)map.removePopup(e[t])}function searchData(){themeObj.searchData(1)}function changeBaseMap(e){if("gmap"==e)try{map.getLayer("g_street")||(gmap=new OpenLayers.Layer.Google("Google Streets",{numZoomLevels:20}),gmap.id="g_street",map.addLayer(gmap)),map.setBaseLayer(gmap)}catch(t){alert("Can't load GoogleMap")}else if("ghyb"==e)try{map.getLayer("g_hybrid")||(ghyb=new OpenLayers.Layer.Google("Google Hybrid",{type:google.maps.MapTypeId.HYBRID,numZoomLevels:20}),ghyb.id="g_hybrid",map.addLayer(ghyb)),map.setBaseLayer(ghyb)}catch(t){alert("Can't load Google Hybrid")}else"osm"==e&&map.setBaseLayer(layer_wi)
mapbg=e}function printIframe(e){var t=document.frames?document.frames[e]:document.getElementById(e),a=t.contentWindow||t
return t.focus(),a.print(),!1}OpenLayers.Strategy.AttributeCluster=OpenLayers.Class(OpenLayers.Strategy.Cluster,{attribute:null,shouldCluster:function(e,t){var a=e.cluster[0].attributes[this.attribute],r=t.attributes[this.attribute],o=OpenLayers.Strategy.Cluster.prototype
return a===r&&o.shouldCluster.apply(this,arguments)},CLASS_NAME:"OpenLayers.Strategy.AttributeCluster"}),OpenLayers.Renderer.symbol={triangle2:[0,5,0,12,10,12,10,5,5,0,0,5],triangle3:[0,5,0,12,4,15,5,17,6,15,10,12,10,5,0,5],triangle:[0,0,10,0,5,12,0,0]}
var map,ext=!1,itheme=!1,themeObj=null,themeObjCallback=!1,selectedFeature=!1,selectedWilayah=!1,listLayers=[],layersLoading=0,popupTooltip=popup=!1,wa_status=["In Progres","Teregistrasi","Terverifikasi","Sertifikasi","Pengakuan"],size=[50,40,30,25,20,15,10,6],range=[100,30,10,8,4,2,1,0],text=["100+","30 - 100","10 - 30","8 - 10","4 - 8","2 - 4","1 - 2","0"],colors=["#800026","#BD0026","#E31A1C","#FC4E2A","#FD8D3C","#FEB24C","#FFD976","#FFF"],selectCtrl,ctheme="default",mapbg=!1,param="",gproj=new OpenLayers.Projection("EPSG:900913"),proj=new OpenLayers.Projection("EPSG:4326"),themes
$.ajax({dataType:"jsonp",url:"/sim_wilayah/indic?callback",success:function(e){themes=e,console.log(themes)}}),OpenLayers.Control.Click=OpenLayers.Class(OpenLayers.Control,{defaultHandlerOptions:{single:!0,"double":!1,pixelTolerance:0,stopSingle:!1,stopDouble:!1},initialize:function(){this.handlerOptions=OpenLayers.Util.extend({},this.defaultHandlerOptions),OpenLayers.Control.prototype.initialize.apply(this,arguments),this.handler=new OpenLayers.Handler.Click(this,{click:this.trigger},this.handlerOptions)},trigger:function(e){mapEvent(e)}})
var loaddiv='<div class="olControlLoader" style="display:block">Loading...</div>'
$(window).load(function(){myLayout=$("body").layout({defaults:{contentSelector:".content"}}),$(".data_close").click(function(){myLayout.state.west.isClosed?(myLayout.open("west"),$(this).css("background","transparent url(assets/images/close-left.png)"),$(this).attr("title","Close")):(myLayout.close("west"),$(this).css("background","transparent url(assets/images/open-left.png)"),$(this).attr("title","Open"))}),$(document).on("click","#search_submit",function(e){e.preventDefault(),$("#data_search").html(loaddiv),themeObj.searchData(),$("#myTab a:last").tab("show")}),$("#theme > li > a").click(function(e){var t=$(this).attr("rel")
loadThemes(t),t&&e.preventDefault()}),$(".dd-basemap").click(function(e){$("#dd-basemap-parent span").html($(this).html()),changeBaseMap($(this).prop("rel")),e.preventDefault()}),$(".dd-basemap-o").click(function(e){$("#dd-basemap-o-parent span").html($(this).html()),document.getElementById("map_detil").contentWindow.changeBaseMap($(this).prop("rel")),e.preventDefault()}),$(document).on("click",".search_name,.open_detil",function(e){e.preventDefault()
var t=($(this).attr("data-kode"),$(this).attr("data-tahun"),$(this).attr("data-indikator"),"wa/view_gis/"+selectedWilayah)
$("#map_detil_box").height($("#maped").height()-1),$("#map_detil").height($("#maped").height()-36).attr("src",t),$("#map_detil_box").show()}),$("#detail-close").click(function(e){$("#map_detil_box").hide(),$("#map_detil").attr("src",""),e.preventDefault()}),$("#detail-back").click(function(e){history.back(),e.preventDefault()}),$("#detail-print").click(function(e){e.preventDefault(),printIframe("map_detil")}),$(document).on("change","#propinsi_list",function(e){e.preventDefault()
var t=$(this).find("option:selected")
if("change"==t.attr("rel")){var a=themes[ctheme].navUrl+$(this).val()+"/"+t.attr("kode_dagri")
$("#nav").load(a)}}),init()})
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