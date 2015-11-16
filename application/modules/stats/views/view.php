<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script type="text/javascript" src="assets/js/OL212/OpenLayers.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/jquery.plupload.queue.js"></script>
<script type="text/javascript">
	var map;
	var gproj = new OpenLayers.Projection("EPSG:900913");
  	var proj = new OpenLayers.Projection("EPSG:4326");
	var size, icon; 
	<?
		if ($data['pos_x'] && $data['pos_y']) {
		?>
		var point_coord = new OpenLayers.LonLat(<?=$data['pos_x']?>,<?=$data['pos_y']?>);
		<?
		}
	?>
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
	function init(){
		map = new OpenLayers.Map({
			div: "map",
			projection: "EPSG:900913",
			displayProjection:"EPSG:4326",
			controls:[]
		});
	
		var ol_wms = new OpenLayers.Layer.WMS( "OpenLayers WMS",
			"http://vmap0.tiles.osgeo.org/wms/vmap0?", {layers: 'basic'} );
	
		map.addLayers([ol_wms]);
		map.addControl(new OpenLayers.Control.OverviewMap());
		map.addControl(new OpenLayers.Control.Zoom());
		nav = new OpenLayers.Control.Navigation({'zoomWheelEnabled': false});
		map.addControl(nav);
		//map.addControl(new OpenLayers.Control.LayerSwitcher());
		// map.setCenter(new OpenLayers.LonLat(0, 0), 0);
		map.zoomToMaxExtent();
		
		var click = new OpenLayers.Control.Click();
		map.addControl(click);
		click.activate();
		
		markers = new OpenLayers.Layer.Markers( "Markers" );
		map.addLayer(markers);
		
		changeBaseMap('gphy');
		var id_bounds = new OpenLayers.Bounds(94,-8,141,6);
		
		
		<? if ($data['pos_x'] && $data['pos_y']) { ?>
		displayMarker();
		<? } else { ?>
		map.zoomToExtent(id_bounds.transform(proj, map.getProjectionObject()));
		<? } ?>
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
				
		} 
		else if (base=='gphy') {
			try {
				if (!map.getLayer("g_physical")) {
					gphy = new OpenLayers.Layer.Google("Google Physical", {type: google.maps.MapTypeId.TERRAIN, numZoomLevels: 20});
					gphy.id = "g_physical";
					map.addLayer(gphy);
				}
				map.setBaseLayer(gphy);
				//layer_anno.setVisibility(false);
			} catch (e) {
				alert("Can't load Google Physical");
			}
		}
		else if (base=='lokal') {
			map.setBaseLayer(layer_wi);
			//layer_anno.setVisibility(true);
		}
		else {
			map.setBaseLayer(layer_bako_service);
				//if (map.getLayer("g_hybrid")) map.removeLayer(ghyb);
				//if (map.getLayer("g_street")) map.removeLayer(gmap);
		}	
	}
	
	
	var flag_marker=false;
	var icon_marker = 'map-point2.png';
	var icon_w = 29;
	var icon_h = 44;
	var cmarker=null;
	function displayMarker() {
		point_coord.transform(proj, map.getProjectionObject());
		map.moveTo(point_coord,7);
		var size = new OpenLayers.Size(icon_w,icon_h);
		var offset=new OpenLayers.Pixel(-size.w/2,-size.h);
		
		var iconDefault = new OpenLayers.Icon("assets/image/"+icon_marker,size,offset);
		cmarker=new OpenLayers.Marker(point_coord,iconDefault);
		markers.addMarker(cmarker);
	}
	function mapEvent(e) {
		var evt = e.type;
		var ext = map.getExtent();
		var zoom = map.zoom;
		
		if (evt=='click') {
			var point_click = map.getLonLatFromViewPortPx(e.xy);
			var point_new = new OpenLayers.LonLat(point_click.lon,point_click.lat);
			setCoord(point_click,point_new);
		}
	}
	function setCoord(point_click,point_new) {
		if (!flag_marker) {
			var size = new OpenLayers.Size(icon_w,icon_h);
			var offset=new OpenLayers.Pixel(-size.w/2,-size.h);
			
			var iconDefault = new OpenLayers.Icon("assets/image/"+icon_marker,size,offset);
			marker=new OpenLayers.Marker(point_click,iconDefault);
			markers.addMarker(marker);
			flag_marker=true;
		}
		else {
			var point_new_pos=map.getLayerPxFromLonLat(point_new);
			if(marker.map==null){
				markers.addMarker(marker);	
			}
			marker.moveTo(point_new_pos);
		}
		if (cmarker) cmarker.setOpacity(0.5);
		
		point_click.transform(map.getProjectionObject(),proj);
		$("#koordinat_bujur").val(Math.round(point_click.lat * 1000000.)/1000000);
		$("#koordinat_lintang").val(Math.round(point_click.lon * 1000000.)/1000000);
		$("#koordinat_div").html(point_click.lon+','+point_click.lat);
		//$("#new_koord").html("(New)");
		//displayCoordinate(lonlat);
	}
</script>
<style>
#imgcontainer .img-btn-change {
	position:absolute;
	width:100%;
	height:160px;
	line-height:160px;
	top:0;
	padding:5px;
	color:transparent;
	text-align:center;
	background:transparent;
	margin:1px;
	z-index:100;
	cursor:pointer
}
#imgcontainer .img-btn-change:hover {
	display:block;
	color:#eee;
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
}
.smallmap {
    width: 100%;
    height: 350px;
    border: 1px solid #ccc;
}
#tags {
    display: none;
}

#docs p {
    margin-bottom: 0.5em;
}
#table_batas_wilayah td{
	vertical-align:middle!important;
}
</style>
<!-- Carousel
================================================== -->
<div class="subhead">
  <div class="container">
    <div class="subhead-caption" style="max-width:800px">
      <h1>Wilayah Adat</h1>
      <p class="lead"><?=$data["nama_kewilayahan"]?></p>
    </div>
  </div>
</div>
<?php $this->load->view('wa_menu',array("active"=>"wa/view/".encrypt($data['idx']),"idx"=>encrypt($data['idx'])))?>
<?php echo form_open("user/register",'id="fdata"');?>
<input type="hidden" name="idx" value="<?=$data['id'];?>" />
<div class="container">
    <div class="row">
    	<div class="col-md-12">
          
          <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>No Registrasi: <?=$data["no_registrasi"]?></h3>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:50%">Nama Kewilayahan</td>
                                <td><?=$data["nama_kewilayahan"]?></td>
                            </tr>
                            <?php
                                $arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
                            ?>
                            <tr>
                                <td style="width:50%">Propinsi</td>
                                <td><?=$arrPropinsi[$data["id_propinsi"]]?></td>
                            </tr>
                            <?php
                                $arrKabupaten=m_lookup("kabupaten_kota","kode_bps","nama");
                            ?>
                            <tr>
                                <td style="width:50%">Kabupaten/Kota</td>
                                <td><?=$arrKabupaten[$data["id_kabupaten"]]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Kecamatan</td>
                                <td><?=$data["kecamatan"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Desa</td>
                                <td><?=$data["desa"]?></td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                    <div>
                                		<span class="help-block" style="display:inline">Peta Lokasi Wilayah Adat</span>
                                        <span class="help-block" style="display:inline; float:right; margin:0; cursor:pointer" id="zoommouse"><i class="fa fa-square"></i> Perbesaran dengan <em>Mousescroll</em></span>
                                        <div id="map" class="smallmap"></div>
                                        <input id="zoomscroll" type="checkbox" class="hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        <!--Wilayah Adat -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Kewilayah Adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:50%">Luas</td>
                                <td><?=number_format($data["luas"],0,'','.')?> Ha</td>
                            </tr>
                            <tr>
                                <td style="width:50%">Satuan</td>
                                <td><?=$data["satuan"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Kondisi Fisik</td>
                                <td>
									<?php 	
										$kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 	$as = explode(',', $data['kondisi_fisik'] );
										foreach($as as $key => $val){
											foreach($kfisik as $k=>$v) {
												if($val == $k){
													$x[] = $v;
												}
											}	
										}
										echo implode(",", $x);
									?>
								</td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Batas Wilayah</label>
                            	<table id="table_batas_wilayah" class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:50%">Batas Barat</td>
                                <td><?=$data["batas_barat"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Batas Selatan</td>
                                <td><?=$data["batas_selatan"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Batas Timur</td>
                                <td><?=$data["batas_timur"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Batas Utara</td>
                                <td><?=$data["batas_utara"]?></td>
                            </tr>
                            </tbody>
                            </table>
                                </div>
                            </div>
                        </div>

                        <!--Kependudukan -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Kependudukan</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:50%">Jumlah KK</td>
                                <td><?=$data["kepala_keluarga"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Jumlah Laki-laki</td>
                                <td><?=$data["laki_laki"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Jumlah Perempuan</td>
                                <td><?=$data["perempuan"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Mata Pencaharian utama</td>
                                <td><?=$data["mata_pencaharian"]?></td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Sejarah Singkat Masyarakat adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["sejarah_singkat"]?></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!--Hak atas tanah -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Hak atas tanah dan pengelolaan Wilayah</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Pembagian ruang menurut adat</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["pembagian_ruang"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Penggunaan & Pengelolaan Wilayah</label>
                            	<table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["penggunaan"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        
                        <!--Kelembagaan Adat -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Kelembagaan Adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td style="width:50%">Nama</td>
                                    <td><?=$data["nama_lembaga_adat"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Struktur</td>
                                    <td><?=$data["struktur"]?></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Tujuan & fungsi para pemangku adat</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["tugas_dan_fungsi"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Mekanisme Pengambilan keputusan</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["mekanisme_pengambilan_keputusan"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        
                        <!--Hukum Adat -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Hukum Adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Aturan adat terkait pengelolaan Sumber daya alam</label>
                                <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><?=$data["aturan_adat"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Wilayah dan Sumber daya alam</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["wilayah_dan_sda"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Aturan Adat terkait Pranata Sosial</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["aturan_pranata_sosial"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Contoh Keputusan dari penerapan Hukum Adat</label>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td><?=$data["contoh_keputusan"]?>&nbsp;</td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>

                        
                        <!--Keanekaragaman Hayati-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Keanekaragaman Hayati</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<?php
									$arrLookupGroup=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												
									//pre($data['kondisi_fisik']);
								?>
                                <table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td style="width:50%">Jenis Ekosistem</td>
                                    <td><?=$arrLookupGroup[$data["id_jenis_ekosistem"]]?></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<?php
									$arrLookupGroup=m_lookup("wa_potensi_hayati","id_potensi_hayati","nama_potensi_hayati",""," order by idx asc "); 												
								?>
                                <table id="table_potensi_hayati" class="table table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="width:50%">Sumber</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (cek_array($data_potensi_hayati)) {
                                        foreach($data_potensi_hayati as $k=>$v) {
                                ?>
                                <tr>
                                    <td><?=$v['nama_potensi_hayati']?></td>
                                    <td><?=$v['keterangan']?></td>
                                </tr>
                                <? }} ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                        
                </div> <!-- span6 -->
                <div class="col-md-5">
                    <!--Data Pemohon -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Data Pemohon</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        	<table class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:50%">Nama Lengkap</td>
                                <td><?=$data["nama_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Jabatan</td>
                                <td><?=$data["jabatan_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Alamat Surat/menyurat</td>
                                <td><?=$data["alamat_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Telp</td>
                                <td><?=$data["telp_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">HP</td>
                                <td><?=$data["hp_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Fax</td>
                                <td><?=$data["fax_pemohon"]?></td>
                            </tr>
                            <tr>
                                <td style="width:50%">Email</td>
                                <td><?=$data["email_pemohon"]?></td>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!--Penanda Tangan Kontrak -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Penanda Tangan Kontrak</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<table class="table table-bordered" style="width:100%">
                                <tbody>
                                <tr>
                                    <td style="width:50%">Nama Lengkap</td>
                                    <td><?=$data["nama_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Jabatan</td>
                                    <td><?=$data["jabatan_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Alamat Surat/menyurat</td>
                                    <td><?=$data["alamat_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Telp</td>
                                    <td><?=$data["telp_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">HP</td>
                                    <td><?=$data["hp_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Fax</td>
                                    <td><?=$data["fax_tt"]?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Email</td>
                                    <td><?=$data["email_tt"]?></td>
                                </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            
    	</div>
	</div>
</div>

<div class="container" style="margin-bottom:20px;">
<?php 
	if ($message) {
		echo '<div class="row"><div class="col-md-12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div></div>';
	}
?>
<!--tab content-->
  
    <br />
    <br />
</div>
<?php echo form_close();?>



<script>
var pekerjaan_change = <?=$pekerjaan_select['value']?'true':'false'?>;
$(document).ready(function () {
	init();
	$(".required").each(function(i){
		$(this).closest("div").find(".asterix").remove();
		$(this).closest("div").find("label").append("<span class='asterix'>&nbsp;*</span>");
   });
   
   $("#zoommouse").on("click",function(){
   		 $("#zoomscroll").trigger("click");
   });
   $("#zoomscroll").on("click",function(){
   		if ($(this).is(":checked")) {
			$("#zoommouse").find("i").removeClass("fa-square").addClass("fa-check-square");
			nav.enableZoomWheel();
		}
		else {
			$("#zoommouse").find("i").removeClass("fa-check-square").addClass("fa-square");
			nav.disableZoomWheel();
		}
   });
   
});
</script>


