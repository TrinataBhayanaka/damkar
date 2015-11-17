<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="Description" CONTENT=" ">
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8" />
<title>SIM-GIS - Ditjen PUM - Kemendagri RI</title>
<base href="<?php echo BASE_URL;?>" />
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
<script src="assets/js/map.js"></script>
<script src="assets/js/module/ddw.js"></script>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Sintony:400,700);
@import url(http://fonts.googleapis.com/css?family=Open+Sans);
body {
	font-family:'Sintony','Open Sans',"Segoe UI";
	font-weight:normal;
}

img { max-width:none; }
li {
    line-height: 14px;
}
.box {
    margin: 0px 0px;
}
.box-header {
    background-color: rgb(250, 250, 250);
    background-image: linear-gradient(to bottom, rgb(250, 250, 250), rgb(239, 239, 239));
    border: 1px solid rgb(221, 221, 221);
    border-radius: 2px 2px 0px 0px;
    box-shadow: none;
    height: 16px;
    font-size: 15px !important;
    margin-bottom: -1px;
    overflow: hidden;
    padding: 8px;
}
.box-content {
    border: 1px solid rgb(221, 221, 221);
    border-radius: 0px 0px 2px 2px;
    margin-top: -1px;
    padding: 10px;
}
.indikator {
	width:600px; border-top:1px solid #ddd; border-left:4px solid #ccc; padding:5px; padding-left:10px; background:#eee
}
.indikator2 {
	width:600px; border-top:1px solid #ddd; border-left:4px solid #ddd; padding:5px; padding-left:10px;
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
</style>

</head>
<body>
<div style="padding:0 15px 0 15px; margin-top:-10px">
    <div class="row-fluid">
        <div class="span7">
            <div class="row-fluid">
                <div class="span12">
                    <h3>&nbsp;Data Satpol PP<small class="pull-right" style="color:grey; line-height:50px"> <i class="icon-tag"></i> Indikator: <strong><?php echo $indikator_title['nama'];?></strong></small></h3>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12" style="padding-top:0">
                    <?php
						$num = count($list);
						$display = ($num>1)?"none":"block";
						
						if (is_array($plist)) {
							foreach($plist as $k=>$v) {
					?>
							<div class="box" style=" position:relative;padding:0px 0px 5px 2px; margin-top:-10px; margin-bottom:10px;">
								<div style="width:9px; height:9px; position:absolute; left:10px; top:10px; background-color:<?php echo $legend;?>"></div>
								<h4 class="box-header" style="padding-left:25px;">
									<strong><?php echo $v['nama_wilayah'];?></strong>
								</h4>
								<div class="box-content" style="background:#f8f8f8;padding-left:50px;margin-bottom:5px">
							 	<div style="font-size:x-large"><?php echo $indikator_title['nama'];?> : <?php echo number_format(doubleval($v[$indikator_aktif]),0,0,".");?>  <?php echo $indikator[$indikator_aktif]['satuan'];?></div>
                                <span><?php echo ($tahun)?"Tahun ".$tahun:"";?></span>
							 		<div style="margin-bottom:5px"><br />
							 			<blockquote>
                                        <?php
										 if (is_array($indikator)) { 
											foreach($indikator as $ik=>$iv) {
										?>
												<h3><?=ucwords($ik)?></h3>
										<?
												foreach($iv as $iik=>$iiv) {
												if ($iiv['colom_nilai']!=$indikator_aktif) {
												if (strlen($iiv['kategori'])>30) {
													$alt = $iiv['kategori'];
													$iiv['kategori']=substr($iiv['kategori'],0,25)."... ";
												}
												if ($iiv['colom_nilai']=='status_color') {
													$val = $v[$iiv['colom_nilai']];
													switch($val) {
														case 'red':
															$value="Kurang ";
															break;
														case 'green':
															$value="Mencukupi ";
															break;
														case 'orange':
															$value="Berlebih ";
															break;
													}
												}
												else {
													$value = number_format(doubleval($v[$iiv['colom_nilai']]),0,0,".");
												}
										 ?>
											<div style="width:120px; display:inline-block" title="<?php echo $alt;?>"><?php echo $iiv['nama'];?></div> <span style="margin-left:5px;border-bottom:1px dotted #999">: <strong><?php echo $value;?></strong>  <?php echo $iiv['satuan'];?></span><br />
										 <?php
										 }}}}
										 ?>
							 			</blockquote>
                                    
                                    <?php if (is_array($plist_wilayah[0])) { ?>
                                    <ul class="inline" style="width:500px; border-left:4px solid #ddd; padding-left:10px">
                                        <li>&bull; Jumlah Penduduk: <?php echo number_format($plist_wilayah[0]['jumlah_penduduk'],0,0,".");?></li>
                             </ul>
                             <?php } ?>
							 	</div>
								<small><em style="color:#666666">Sumber: <?php echo $v['ket_dasar_hukum'];?></em></small>
						 	</div>
						 </div>
							 
					<?php } ?>
					<?php } ?>
                    <!--Child-->
                    <?php
						if (is_array($list)) {
							foreach($list as $k=>$v) {
								$index=0;
								$val = $v[$indikator_aktif];
								for($z=0;$z<count($range);$z++) {
									if ($val>$range[$z]['min'] && $val<=$range[$z]['max']) {
										$index=$z;
										break;
									}
								}
								//pre($val);
								//echo "diff:".$diff.",min:".$min.",val:".$v[$indikator_aktif].",index".$index."<BR>";
								$legend = $color[$index];
					?>
                    		<div class="media " style="background:#fff; border-radius:5px; padding:10px;; border:1px solid #ddd">
                            <div class="pull-left" style="width:30px">
                                <div class="avatar media-object img-polaroid" alt="2013" style=" background:<?php echo $legend;?>;width:10px;height:10px;margin:3px" /></div>
                            </div>   
                            <div class='media-body'>
                                <div class="pull-right" style="color:grey"></div>
                                <div>
                                    <h4 class="media-heading" style="line-height:24px"><?php echo $v['nama_wilayah'];?></h4>
                                    <div style="font-size:large"><?php echo $indikator_title['nama'];?> : <?php echo number_format(doubleval($v[$indikator_aktif]),0,0,".");?></div>                      
                                </div>
                                <br />
                                    <ul class="inline indikator">
                                    <?php
										 if (is_array($indikator)) { 
											foreach($indikator as $ik=>$iv) {
										?>
												<h3><?=ucwords($ik)?></h3>
										<?
												foreach($iv as $iik=>$iiv) {
												if ($iiv['colom_nilai']!=$indikator_aktif) {
												if (strlen($iiv['kategori'])>30) {
													$alt = $iiv['kategori'];
													$iiv['kategori']=substr($iiv['kategori'],0,25)."... ";
												}
												if ($iiv['colom_nilai']=='status_color') {
													$val = $v[$iiv['colom_nilai']];
													switch($val) {
														case 'red':
															$value="Kurang ";
															break;
														case 'green':
															$value="Mencukupi ";
															break;
														case 'orange':
															$value="Berlebih ";
															break;
													}
												}
												else {
													$value = number_format(doubleval($v[$iiv['colom_nilai']]),0,0,".");
												}
										 ?>
											<div style="width:120px; display:inline-block" title="<?php echo $alt;?>"><?php echo $iiv['nama'];?></div> <span style="margin-left:5px;border-bottom:1px dotted #999">: <strong><?php echo $value;?></strong>  <?php echo $iiv['satuan'];?></span><br />
										 <?php
										 }}}}
										 ?>
                                    </ul>
							<?php if (is_array($list_wilayah[$v['kode_wilayah']])) { ?>
                                    <ul class="inline indikator2">
                                        <li>&bull; Jumlah Penduduk: <?php echo number_format(doubleval($list_wilayah[$v['kode_wilayah']]['jumlah_penduduk']),0,0,".");?></li>
                             </ul>
                             <?php } ?>
                                <small><em style="color:#666666">Sumber: <?php echo $v['ket_dasrHukum'];?></em></small>
                            </div>
                         </div>
					<?php } ?>
					<?php } ?>
                </div>
            </div>
        </div>
        <div class="span5">
        	<div class="row-fluid">
                <div class="span12">
                    <h3>&nbsp;Legend</h3>
                    <?php echo $legend_table; ?>
                </div>
            </div>
			<div class="row-fluid">
                <div class="span9">
                    <h3>&nbsp;Tematik</h3>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div id="maped" style="height:300px; border:1px solid #ccc"></div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div id="scaleline-id" style="padding:5px; font-size:xx-small; border:1px solid #eee; border-top:0">
                    	<div id="attribution-id" style="height:inherit; float:right"></div>
                    </div>
                    <div id="ovmid" style="border:1px solid #eee;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
	init();
	var ovwidth = $("#ovmid").width();
	ovControl.size = new OpenLayers.Size(ovwidth,150);
	ovControl.div = document.getElementById('ovmid');
	map.addControl(ovControl);
	//attribution.position =  new OpenLayers.Pixel(10,20);
	
	ppplayer = new OpenLayers.Layer.Vector("Data Dasar Wilayah", {
		styleMap: stylePoly
	,	renderers: ["Canvas", "SVG", "VML"]
	,	rendererOptions: {zIndexing: false}
	,	strategies: [new OpenLayers.Strategy.Fixed()]
	,	protocol: new OpenLayers.Protocol.HTTP({
			url: 'sig/satpolpp/map_json/<?php echo $kode_wilayah;?>/<?php echo $tahun;?>/<?php echo $indikator_aktif;?>',
			params:{},
			format: new OpenLayers.Format.GeoJSON({
				ignoreExtraDims: true,
				keepData: true,
				internalProjection: map.baseLayer.projection,
				externalProjection: proj
			})
		})
	,	eventListeners: {
			"featuresadded": Zoomer
		}
	,	attribution: "All Thematic Layers are Simplified"
	});
	ppplayer.id="ppplayer";
	map.addLayer(ppplayer);
	map.setLayerIndex(ppplayer,0);
	
	highlightCtrl = new OpenLayers.Control.SelectFeature([ppplayer], {
		hover: true,highlightOnly: true, renderIntent: "temporary", callbacks:{
			'over':feature_hover, 'out':feature_out
		}
	});
	map.addControls([highlightCtrl]);
	highlightCtrl.activate();
});
function Zoomer() {
	var f_bounds = ppplayer.getDataExtent();
	map.zoomToExtent(f_bounds);
	if (map.getZoomForExtent(f_bounds)>9) map.zoomTo(10);
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
function feature_out(feature) {
	if (popupTooltip) {
		//map.removePopup(popupTooltip);
		popupTooltip.destroy();
		//popupTooltip.hide();
		popupTooltip = false;
	}
}
$(".dd-basemap").click(function(e){
		$("#dd-basemap-parent span").html($(this).html());
		changeBaseMap($(this).prop("rel"));
		e.preventDefault();
	});
</script>
<style>
.olControlLoader {
	float:left;
	width:136px;
	height:36px;
	padding-left:36px;
	line-height:36px;
	display:none; 
	background: url(public/images/ajax-loader.gif) 10px 10px no-repeat;
}
.olControlLoadingPanel {
	position:absolute; 
	bottom:1px; left:0; 
	width:100%; height:100%; 
	display:none; 
	z-index:1005; 
	border-top:1px solid #ddd; 
	background:#fff url(public/images/ajax-loader.gif) center no-repeat;
	filter: alpha(opacity=0);
	-moz-opacity:0.0;
    -khtml-opacity: 0.0;
    opacity: 0.0;
}
.olControlAttribution {
    font-size: smaller; 
    left: 140px; 
    bottom: 20px; 
    position: absolute; 
    display: block;
}
.olControlScale {
   display: block;
   position: absolute;
   left: 22px;
   bottom: 85px;
   font-size: small;
}
.olControlScaleLine {
   display: block;
   position: absolute;
   left: 20px;
   bottom: 45px;
   font-size: xx-small;
   line-height:12px
}
.olControlOverviewMapContainer {
    position: absolute;
    bottom: -6px;
    right: -2px;
	height: 128px;
	z-index:1;
}
div.olControlZoom {
    position: absolute;
    top: 20px;
    left: 20px;
    background: rgba(255,255,255,0.3);
    border-radius: 4px;
    padding: 1px;
}
div.olControlZoom a {
	background: #ccc; /* fallback for IE - IE6 requires background shorthand*/
    background: rgba(120,120,120, 0.5);
}
div.olControlZoom a:hover {
	background: #aaa; /* fallback for IE - IE6 requires background shorthand*/
    background: rgba(60,60,60, 0.5);
}
.olControlOverviewMapElement {
	margin-top:0px;
    padding: 2px/* 0 8px 8px*/;
    background-color: #fff;
	z-index:1
}
.olControlOverviewMapMinimizeButton {
    left: -1px;
    top: -1px;
    cursor: pointer;
}    
.olControlOverviewMapMaximizeButton {
    right: 1px;
    bottom: 5px;
    cursor: pointer;
}
.olControlOverviewMapExtentRectangle {
    overflow: hidden;
    background-image: url("img/blank.gif");
    cursor: move;
    border: 1px solid red;
}
.olImageLoadError {
    background: transparent/* url(public/images/missing-tile-256x256.png) no-repeat*/ !important;
	border:none !important;
}
.olControlAttribution {
	text-shadow: 1px 1px 1px #fff, -1px 1px 1px #fff, 1px -1px 1px #fff;
}
.olLayerGoogleV3.olLayerGoogleCopyright {
    right: 0 !important;
}
.olLayerGoogleV3.olLayerGooglePoweredBy {
    bottom: 50px !important;
	left:220px !important
}
</style>
</body>
</html>