	<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script type="text/javascript" src="assets/js/OL212/OpenLayers.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/jquery.plupload.queue.js"></script>
<!--
<script type="text/javascript" src="assets/js/plugins/jquery.validate/jquery.validate.min.js"></script>
<script src="assets/js/plugins/jquery.validate/jquery.validate.bootstrap3.js"></script>
-->
<script src="assets/js/jquery.tooltipsy.min.js"></script>
<script type="text/javascript">
	var map,nav;
	var gproj = new OpenLayers.Projection("EPSG:900913");
  	var proj = new OpenLayers.Projection("EPSG:4326");
	var size, icon; 
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
		
		changeBaseMap('gmap');
		var id_bounds = new OpenLayers.Bounds(94,-8,141,6);
		map.zoomToExtent(id_bounds.transform(proj, map.getProjectionObject()));
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
		var size = new OpenLayers.Size(icon_w,icon_h);
		var offset=new OpenLayers.Pixel(-size.w/2,-size.h);
		
		var iconDefault = new OpenLayers.Icon("assets/image/"+icon_marker,size,offset);
		cmarker=new OpenLayers.Marker(point_coord,iconDefault);
		markers.addMarker(cmarker);
		Zoomer();
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
		$("#koordinat_bujur").val(Math.round(point_click.lon * 1000000.)/1000000);
		$("#koordinat_lintang").val(Math.round(point_click.lat * 1000000.)/1000000);
		$("#koordinat_div").html(point_click.lon+','+point_click.lat);
		//$("#new_koord").html("(New)");
		//displayCoordinate(lonlat);
	}
	$(window).scroll(function(){
		//map.
	});
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
    height: 500px;
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
.frm h3{
	border-bottom:1px solid #999;
	padding:5px 0 ;
	font-size:16px;
	font-weight:bold
}
.frm label {
	font-weight:normal!important;
}
.del-row {
	color:red;
}
.frmtip {
	cursor:pointer;
	color:#aaa;
	margin-left:10px
}
.frmtip:hover {
	color:#555;
}
label.error {  font-weight: bold;color: red;padding: 2px 8px;margin-top: 5px; font-size:11px}
</style>
<!-- Carousel
================================================== -->
<div class="subhead">
  <div class="container">
    <div class="subhead-caption" style="max-width:800px">
      <h1>Pendaftaran Wilayah adat</h1>
      <p class="lead">Isi form Pendaftaran</p>
    </div>
  </div>
</div>
<? $required=" required"; ?>
<?php $this->load->view('dok_menu',array("active"=>"user/wa"))?>
<?php $this->load->view('user/wa/menu',array("active"=>"reg"))?>
<?php echo form_open("user/wa/register",'id="fdata"');?>
<input type="hidden" name="id_user" value="<?=$user['id'];?>" />
<input type="hidden" name="add" value="tbh" />
<div class="container">
    <div class="row">
    	<div class="col-md-12 frm">
        	<div class="row">
                <div class="col-md-6">
                	<div class="row">
                        <div class="col-md-6">
                            <h3>1. Nama Komunitas<i class="fa fa-question-circle frmtip" title="<?=$tooltip['1']?>"></i></h3>
                        </div>
                        <div class="col-md-6">
                            <h3> Nama Satuan Wilayah Adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['4_c']?>"></i></h3>
                        </div>
                    </div>
                     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <?php echo form_input('nama_kewilayahan',false,'class="form-control required"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <?php echo form_input('satuan',false,'class="form-control"');?>
                        </div>
                     </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>2. Bahasa<i class="fa fa-question-circle frmtip" title="<?=$tooltip['2']?>"></i></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <?php echo form_input('bahasa',false,'class="form-control required"');?>
                            </div>
                        </div>
                    </div>
              	</div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>3. Kewilayahan<i class="fa fa-question-circle frmtip" title="<?=$tooltip['3']?>"></i></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <?php
                                $arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
                                $arrPropinsi1=array(""=>"--Pilih Propinsi--")+$arrPropinsi;
                            ?>
                            <div class="form-group">
                            <label>Propinsi</label>
                            <?=form_dropdown("id_propinsi",$arrPropinsi1,0,"id='id_propinsi' class='form-control required'");?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Kabupaten</label>
                            <span id="id_kabupaten_holder">
                            <?=form_dropdown("id_kabupaten",$m_pekerjaan,0,"id='id_kabupaten' class='form-control required'");?>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Kecamatan</label>
                            <?php echo form_input('kecamatan',false,'class="form-control required"');?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>Desa</label>
                            <?php echo form_input('desa',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                </div>
          </div>
          
          <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            <span class="help-block" style="display:inline">Jika Kecamatan/Desa lebih dari satu , tulis dengan dibatasi tanda koma (,) per kecamatan/desa<br />Contoh: Duren Sawit,Pondok Kopi,Klender</span>
                        </div>
                    </div>
                </div>
          </div>
          
            <!--Wilayah Adat -->
            <div class="row">
                <div class="col-md-12">
                    <h3>4. Kewilayahan Adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['4']?>"></i></h3>
                </div>
            </div>
          <div class="row">
          		<div class="col-md-9">
                	
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Batas Wilayah<i class="fa fa-question-circle frmtip" title="<?=$tooltip['4_b']?>"></i></label>
                            <table id="table_batas_wilayah" class="table table-bordered" style="width:100%">
                            <tbody>
                            <tr>
                                <td style="width:30%">Batas Barat</td>
                                <!-- <td><?php echo form_input('batas_barat',false,'class="form-control"');?></td> -->
                                <td><textarea name="batas_barat" class="form-control" rows="2"></textarea></td>
                                
                            </tr>
                            <tr>
                                <td style="width:30%">Batas Selatan</td>
                                <!-- <td><?php echo form_input('batas_selatan',false,'class="form-control"');?></td> -->
                                <td><textarea name="batas_selatan" class="form-control" rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td style="width:30%">Batas Timur</td>
                                <!-- <td><?php echo form_input('batas_timur',false,'class="form-control"');?></td>  -->
                                <td><textarea name="batas_timur" class="form-control" rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td style="width:30%">Batas Utara</td>
                                <td><?php echo form_input('batas_utara',false,'class="form-control"');?></td>
                                <!-- <td><textarea name="batas_utara" class="form-control" rows="2"></textarea></td> -->
                            </tr>
                            <!--<tr>
                                <td><a id="add_batas_wilayah" class="btn btn-info" title=" Tambah Batas"><i class="fa fa-plus"></i>&nbsp; Tambah Batas</a></td>
                                <td></td>
                            </tr>-->
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-3">
                	<div class="row">
                        <div class="col-md-12">
                        
                        	<div class="row">
		                        <div class="col-md-12">
		                            <div class="form-group">
		                            <label>Luas (Ha)<i class="fa fa-question-circle frmtip" title="<?=$tooltip['4_a']?>"></i></label>
		                            <?php echo form_input('luas',false,'class="form-control number"');?>
		                            </div>
		                        </div>
		                       
		                    </div>
		                	
                            <div class="form-group">
                            <label>Kondisi Fisik<i class="fa fa-question-circle frmtip" title="<?=$tooltip['4_d']?>"></i></label>
                            <?php 	
                                $kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												
								//$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
                            	foreach($kfisik as $k=>$v) {
							?>
                            <div class="checkbox">
                              <label>
                                <input name="list_kondisi_fisik[]" type="checkbox" value="<?=$k;?>">
                                <?=$v;?>
                              </label>
                            </div>
                            <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-4">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Deskripsi Kondisi Fisik</label>
                            <textarea name="kondisi_fisik" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>-->
          </div>
			
            <!--Kependudukan -->
            <div class="row">
                <div class="col-md-12">
                    <h3>5. Kependudukan<i class="fa fa-question-circle frmtip" title="<?=$tooltip['5']?>"></i></h3>
                </div>
            </div>
          <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Jumlah KK</label>
                            <?php echo form_input('kepala_keluarga',false,'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Jumlah Laki-laki</label>
                            <?php echo form_input('laki_laki',false,'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Jumlah Perempuan</label>
                            <?php echo form_input('perempuan',false,'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Mata Pencaharian utama<i class="fa fa-question-circle frmtip" title="<?=$tooltip['5_d']?>"></i></label>
                            <?php echo form_input('mata_pencaharian',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          
          <div class="row">
                <div class="col-md-12">
                	<!--Confirm-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>6. Sejarah singkat Masyarakat Adat (Sejarah asal-usul, suku)<i class="fa fa-question-circle frmtip" title="<?=$tooltip['6']?>"></i></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                            	<textarea name="sejarah_singkat" class="form-control required" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
          </div>
          
            <!--Hak atas tanah -->
            <div class="row">
                <div class="col-md-12">
                    <h3>7. Hak atas tanah dan pengelolaan Wilayah<i class="fa fa-question-circle frmtip" title="<?=$tooltip['7']?>"></i></h3>
                </div>
            </div>
          <div class="row">
                <div class="col-md-6">
                      <div class="form-group">
                            <label>Pembagian ruang menurut adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['7_a']?>"></i></label>
                             <textarea name="wa_hak_pembagian_ruang" class="form-control" rows="5"></textarea>
                            <!--<table id="table_pembagian_ruang" class="table table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width:50%">istilah/nama lokal</th>
                                <th>Penjelasan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" name="ruang[]" class="form-control" /></td>
                                <td><input type="text" name="ruang_val[]" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td><a id="add_pembagian_ruang" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp; Tambah baris</button></td>
                                <td></td>
                            </tr>
                            </tbody>
                            </table>-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Sistem Penguasaan & Pengelolaan Wilayah<i class="fa fa-question-circle frmtip" title="<?=$tooltip['7_b']?>"></i></label>
                     <textarea name="tugas_dan_fungsi" class="form-control" rows="5"></textarea>
                    <!--<table id="table_sppw" class="table table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th style="width:50%">Penguasaan & pengelolaan</th>
                            <th>Penjelasan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" name="sppw[]" class="form-control" /></td>
                            <td><input type="text" name="sppw_val[]" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td><a id="add_sppw" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp; Tambah baris</button></td>
                            <td></td>
                        </tr>
                        </tbody>
                        </table>-->
                    </div>
                </div>
          </div>
          
          
          
            <!--Kelembagaan Adat -->
            <div class="row">
                <div class="col-md-12">
                    <h3>8. Kelembagaan Adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['8']?>"></i></h3>
                </div>
            </div>
          <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Nama<i class="fa fa-question-circle frmtip" title="<?=$tooltip['8_a']?>"></i></label>
                            <?php echo form_input('nama_lembaga_adat',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Struktur<i class="fa fa-question-circle frmtip" title="<?=$tooltip['8_b']?>"></i></label>
                            <?php echo form_input('struktur',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Tugas & fungsi para pemangku adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['8_c']?>"></i></label>
                            <textarea name="tugas_dan_fungsi" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Mekanisme Pengambilan keputusan<i class="fa fa-question-circle frmtip" title="<?=$tooltip['8_d']?>"></i></label>
                            <textarea name="mekanisme_pengambilan_keputusan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          
            <!--Hukum Adat -->
            <div class="row">
                <div class="col-md-12">
                    <h3>9. Hukum Adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['9']?>"></i></h3>
                </div>
            </div>
          <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Aturan adat terkait pengelolaan Sumber daya alam<i class="fa fa-question-circle frmtip" title="<?=$tooltip['9_a']?>"></i></label>
                            <textarea name="aturan_adat" class="form-control " rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Wilayah dan Sumber daya alam<i class="fa fa-question-circle frmtip" title="<?//=$tooltip['9_b']?>"></i></label>
                            <textarea name="wilayah_dan_sda" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-md-6">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Aturan Adat terkait Pranata Sosial<i class="fa fa-question-circle frmtip" title="<?=$tooltip['9_b']?>"></i></label>
                            <textarea name="aturan_pranata_sosial" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-6">
                	
                	<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Contoh Keputusan dari penerapan Hukum Adat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['9_c']?>"></i></label>
                            <textarea name="contoh_keputusan" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
          </div>

            <!--Keanekaragaman Hayati-->
            <div class="row">
                <div class="col-md-12">
                    <h3>10. Keanekaragaman Hayati</h3>
                </div>
            </div>
          <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <?php
                                $arrLookupGroup=m_lookup("wa_jenis_ekosistem","id_jenis_ekosistem","jenis_ekosistem",""," order by order_num asc "); 												
                                //$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
                            ?>
                            <!--<div class="form-group">
                            <label>Jenis Ekosistem<i class="fa fa-question-circle frmtip" title="<?=$tooltip['10_a']?>"></i></label>
                            <?=form_dropdown("id_jenis_ekosistem",$arrLookupGroup,0,"id='jenis_ekosistem' class='form-control'");?>
                            </div>-->
                            <div class="form-group">
                            <label>Jenis Ekosistem<i class="fa fa-question-circle frmtip" title="<?=$tooltip['10_a']?>"></i></label>
                            <?php 	
                                //$arrLookupGroup=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												
								//$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
                            	foreach($arrLookupGroup as $k=>$v) {
							?>
                            <div class="checkbox">
                              <label>
                                <input name="list_jenis_ekosistem[]" type="checkbox" value="<?=$k;?>">
                                <?=$v;?>
                              </label>
                            </div>
                            <? } ?>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Potensi & Manfaat Keanekaragaman Hayati</label>
                                    <table id="table_potensi_hayati" class="table table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th style="width:30%">Sumber</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$arrLookupGroup=m_lookup("wa_potensi_hayati","id_potensi_hayati","nama_potensi_hayati",""," order by idx asc "); 												
										if (cek_array($arrLookupGroup)) {
											foreach($arrLookupGroup as $k=>$v) {
									?>
                                    <tr>
                                        <td><?=$v?><input type="hidden" class="form-control" value="<?php echo $k;?>" name="id_potensi[]">
                                        <input type="hidden" class="form-control" value="<?php echo $v?>" name="potensi[]"></td>
                                        <!-- <td><input type="text" class="form-control" value="" name="potensi_val[]"></td> -->
                                        <td><textarea name="potensi_val[]" class="form-control" rows="2"></textarea></td>
                                    </tr>
                                    <? }} ?>
                                    <!--<tr>
                                        <td><a id="add_potensi_hayati" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp; Tambah baris</button></td>
                                        <td></td>
                                    </tr>-->
                                    </tbody>
                                    </table>
                                    
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<!--col right-->
                </div>
          </div>


          <!--peta wilayah adat -->
            <div class="row">
                <div class="col-md-12">
                	<!--Confirm-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>11. Peta Wilayah Adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                    <div>
                                        <span class="help-block" style="display:inline"><?=$tooltip['11_a']?></span>
                                        <span class="help-block" style="display:inline; float:right; margin:0; cursor:pointer" id="zoommouse"><i class="fa fa-square"></i> Perbesaran dengan <em>Mousescroll</em></span>
                                        <div id="map" class="smallmap"></div>
                                        <input id="zoomscroll" type="checkbox" class="hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Bujur</label>
                                        <?php echo form_input('pos_x',false,'id="koordinat_bujur" class="form-control required"');?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Lintang</label>
                                        <?php echo form_input('pos_y',false,'id="koordinat_lintang" class="form-control required"');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                <label>Lampiran file Peta</label>   <span class="i" style="font-size:11px; color:#F00">[ file max : 3250 KB ]</span>
                                <?php echo form_input('file_peta',false,'id="lampiran_peta" class="form-control required"');?>
                                </div>
                            </div>
                            <div class="col-md-1">
                            	<div class="form-group" id="uppeta">
                            		<label>&nbsp;</label>
                                	<a id="pickpeta" class='form-control btn btn-info'>Browse</a>
                                 </div>
                            </div>
                        </div>
                </div>
          </div>
          <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            <span class="help-block" style="display:inline"><?=$tooltip['11_b']?></span>
                        </div>
                    </div>
                </div>
          </div>
          
          
          <div class="row">
                <div class="col-md-12">
                	<!--Confirm-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>12. Apakah Registrasi Wilayah Adat sudah di Musyawarahkan?<i class="fa fa-question-circle frmtip" title="<?=$tooltip['12']?>"></i></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<?
									$arr = array("1"=>"Ya, Sudah","0"=>"Belum");
								?>
                            	<div class="form-group">
                            	<?=form_dropdown("wa_musyawarah",$arr,1,"id='wa_musyawarah' class='form-control'");?>
                                </div>
                            </div>
                        </div>
                </div>
          </div>
          
          <div class="row">
                <div class="col-md-6">
                	<!--Data Pemohon -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>13. Data Pemohon<i class="fa fa-question-circle frmtip" title="<?=$tooltip['13']?>"></i></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Nama Lengkap<i class="fa fa-question-circle frmtip" title="<?=$tooltip['13_a']?>"></i></label>
                            <?php echo form_input('nama_pemohon',$user['nama'],'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Jabatan<i class="fa fa-question-circle frmtip" title="<?=$tooltip['13_b']?>"></i></label>
                            <?php echo form_input('jabatan_pemohon',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Alamat Surat/menyurat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['13_c']?>"></i></label>
                            <textarea name="alamat_pemohon" class="form-control" rows="2"><?=$user['alamat'];?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Telp</label>
                            <?php echo form_input('telp_pemohon',$user['phone'],'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>HP</label>
                            <?php echo form_input('hp_pemohon',$user['handphone'],'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Fax</label>
                            <?php echo form_input('fax_pemohon',$user['fax'],'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Email</label>
                            <?php echo form_input('email_pemohon',$user['email'],'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                </div> <!-- span6 -->
                <div class="col-md-6">
                    <!--Penanda Tangan Kontrak -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>14. Penanda Tangan Kerjasama<i class="fa fa-question-circle frmtip" title="<?=$tooltip['14']?>"></i></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Nama Lengkap<i class="fa fa-question-circle frmtip" title="<?=$tooltip['14_a']?>"></i></label>
                                <?php echo form_input('nama_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Jabatan<i class="fa fa-question-circle frmtip" title="<?=$tooltip['14_b']?>"></i></label>
                                <?php echo form_input('jabatan_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Alamat Surat/menyurat<i class="fa fa-question-circle frmtip" title="<?=$tooltip['14_c']?>"></i></label>
                                <textarea name="alamat_tt" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Telp</label>
                            	<?php echo form_input('telp_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>HP</label>
                            	<?php echo form_input('hp_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Fax</label>
                            	<?php echo form_input('fax_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Email</label>
                            	<?php echo form_input('email_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
            
            <!--Surat Kuasa-->
            <!--Hukum Adat -->
            <div class="row">
                <div class="col-md-12">
                    <h3>Surat Kuasa</h3>
                </div>
            </div>
          <div class="row"> 
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Lampiran Surat Kuasa (Jika dikuasakan) <span class="i" style="font-size:11px; color:#F00">[ file max : 3250 KB ]</span></label>
                                <?php echo form_input('surat_kuasa',false,'id="surat_kuasa" class="form-control"');?>
                                </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group" id="upsk">
                                <label>&nbsp;</label>
                                <a id="picksk" class='form-control btn btn-info'>Browse</a>
                             </div>
                        </div>
                    </div>
                </div>
          </div>
          
          <!--file pendukung-->
            <!--Hukum Adat -->
            <div class="row">
                <div class="col-md-12">
                    <h3>Dokumen Pendukung <span class="i" style="font-size:11px; color:#F00; font-weight:500">[ file max : 3250 KB ]</span></h3>
                </div>
            </div>
          <div class="row"> 
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="uploader">
                            <label>Lampiran Dokumen</label>
                            <span class="help-block" style="display:inline">, <?=$tooltip['fp']?></span>
                            <table id="file_list" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%">Keterangan</th>
                                    <th>Filename</th>
                                    <th width="80">Size</th>
                                </tr>
                            </thead>
                            <tbody>        
                            <tr>
                             <td><a id="pickfiles" class="btn btn-info"><i class="fa fa-plus"></i>&nbsp; Browse</button></td>
                             <td></td>
                            </tr>                        
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
            
            <!-- konfirm password-->
            <div class="row">
                <div class="col-md-12">
                    <h3 id="konfirm">Konfirmasi</h3>
                </div>
            </div>
            <!-- dummy submitter -->
            <div id="submitter1" class="row hide">
                <div class="col-md-6">
                    <table class="table">
                    	<tr>
                        	<td>File Peta</td><td><div class="plupload_progress_bar_0"></div></td><td><div class="plupload_progress_text_0"></div></td>
                        </tr>
                        <tr>
                        	<td>Surat Kuasa</td><td><div class="plupload_progress_bar_2"></div></td><td><div class="plupload_progress_text_2"></div></td>
                        </tr>
                        <tr>
                        	<td>Dok. Pendukung</td><td><div class="plupload_progress_bar_1"></div></td><td><div class="plupload_progress_text_1"></div></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- end dummy submitter -->
            <div class="submitter row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-footer">
                    	<span class="checkbox">
                            <label>
                              <input type="checkbox"> "Dengan ini, menyatakan persetujuan untuk memberikan hak publikasi data yang sudah di unggah di laman ini kepada BRWA, sebagai upaya penyebaran informasi kepada publik untuk mewujudkan pengakuan wilayah adat bagi masyarakat adat di Indonesia"
                            </label>
                          </span>
                      </div>
                    </div>
                </div>
            </div>
            <div class="submitter row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                            <?php echo lang('create_user_password_label', 'password');?>
                            <?php echo form_input($password,false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                            <?php echo form_input($password_confirm,false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="form-group">
                        <label>&nbsp;</label><br />
                        <button type="submit" class="btn btn-primary">Kirim </button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </div>
          </div>
    	</div>
	</div>
</div>

<?php echo form_close();?>



<script>
var pekerjaan_change = <?=$pekerjaan_select['value']?'true':'false'?>;
$(document).ready(function () {
	init();
	
	$('.frmtip').tooltipsy({
		offset: [10, 0],
		css: {
			'padding': '10px',
			'max-width': '500px',
			'font-size':'0.9em',
			'color': '#303030',
			'background-color': '#f5f5b5',
			'border': '1px solid #deca7e',
			'-moz-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
			'-webkit-box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
			'box-shadow': '0 0 10px rgba(0, 0, 0, .5)',
			'text-shadow': 'none'
		}
	});
	$("#fdata").validate({
	  invalidHandler: function(event, validator) {
		var errors = validator.numberOfInvalids();
		if (errors) {
			$(".submitter").removeClass("hide");
			$("#submitter1").addClass("hide");
		}
		else {
			$(".submitter").addClass("hide");
			$("#submitter1").removeClass("hide");
		}
	  }
	});
	$(".required").each(function(i){
		$(this).closest("div").find(".asterix").remove();
		$(this).closest("div").find("label").append("<span class='asterix'>&nbsp;*</span>");
   });
   
   $("#id_propinsi").change(function(){
   		var id_propinsi = $(this).val();
		var nm_propinsi = $("#id_propinsi option:selected").text();
		$("#id_kabupaten_holder").load("<?=$this->module;?>wa/get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
			getgeoCode(nm_propinsi);
			$("#id_kabupaten").change(function(){
				var nm_address = nm_propinsi+" "+$("#id_kabupaten option:selected").text();
				getgeoCode(nm_address);
		   });
		});
   });
   
   $("#add_pembagian_ruang").click(function(){
   		var rows = $('#table_pembagian_ruang tr').size();
		if (rows<11) {
				$('#table_pembagian_ruang tr:last').before('<tr><td><div class="input-group"><input type="text" class="form-control" name="ruang[]" placeholder="Istilah/nama lokal"><a class="input-group-addon btn del-row"><i class="fa fa-times-circle"></i></a></div></td><td><input type="text" name="ruang_val[]" class="form-control"></td></tr>');
				$('#table_pembagian_ruang tr:last').prev('tr').find("input").first().focus();
		}
		else {
			alert("Max 10 batas");
		}
   });
   $("#add_sppw").click(function(){
   		var rows = $('#table_sppw tr').size();
		if (rows<11) {
				$('#table_sppw tr:last').before('<tr><td><div class="input-group"><input type="text" class="form-control" name="ruang[]" placeholder="Penguasaan & Pengelolaan"><a class="input-group-addon btn del-row"><i class="fa fa-times-circle"></i></a></div></td><td><input type="text" name="ruang_val[]" class="form-control"></td></tr>');
				$('#table_sppw tr:last').prev('tr').find("input").first().focus();
		}
		else {
			alert("Max 10 batas");
		}
   });
   $("#add_potensi_hayati").click(function(){
   		var rows = $('#table_potensi_hayati tr').size();
		if (rows<11) {
				$('#table_potensi_hayati tr:last').before('<tr><td><div class="input-group"><input type="text" class="form-control" name="potensi_hayati[]" placeholder="Sumber"><a class="input-group-addon btn del-row"><i class="fa fa-times-circle"></i></a></div></td><td><input type="text" name="potensi_hayati_val[]" class="form-control"></td></tr>');
				$('#table_potensi_hayati tr:last').prev('tr').find("input").first().focus();
		}
		else {
			alert("Max 10 batas");
		}
   });
   $("#add_batas_wilayah").click(function(){
   		var rows = $('#table_batas_wilayah tr').size();
		if (rows<11) {
				$('#table_batas_wilayah tr:last').before('<tr><td><div class="input-group"><input type="text" class="form-control" name="batas[]" placeholder="Batas"><a class="input-group-addon btn del-row"><i class="fa fa-times-circle"></i></a></div></td><td><input type="text" name="batas_val[]" class="form-control"></td></tr>');
				$('#table_batas_wilayah tr:last').prev('tr').find("input").first().focus();
		}
		else {
			alert("Max 10 batas");
		}
   });
   $(document).on("click",".del-row", function(e){
   		e.preventDefault();
		$(this).parents("tr").remove();
   });
   
   $("#add_batas_wilayahs").click(function(){
   		var rows = $('#table_batas_wilayah tr').size();
   		var batas = $("#batas_lain").val();
		var value = $("#batas_lain_val").val();
		if (rows<11) {
			if (batas && value) {
				$('#table_batas_wilayah tr:last').after('<tr><td>'+batas+'<a href="#" class="del-row-bw pull-right"><i class="fa fa-times-circle"></i></a></td><td><input type="text" name="batas[]" value="'+value+'" class="form-control"></td></tr>');
				$("#batas_lain").val('');
				$("#batas_lain_val").val('');
				$(".del-row-bw").on("click",function(e){
					e.preventDefault();
					$(this).parents("tr").remove();
				});
			}
			else {
				alert("Tidak boleh kosong");
			}
		}
		else {
			alert("Max 10 batas");
		}
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
   var geocoder = new google.maps.Geocoder();
   $("#map_search").on("blur",function(){
		var address = $(this).val();
		getgeoCode(address);
   })
   
   function getgeoCode(address) {
   		geocoder.geocode({ 'address': address }, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				//alert(JSON.stringify(results[0].geometry.bounds));     
				
				var bex = new Array();
				var tex = results[0].geometry.bounds;
				for (var key in tex) {
				   if (tex.hasOwnProperty(key)) {
					  var obj = tex[key];
					  for (var prop in obj) {
						 if (obj.hasOwnProperty(prop)) {
							//alert(prop + " = " + obj[prop]);
							bex.push(obj[prop]);
						 }
					  }
				   }
				}
				var w = bex[2];//results[0].geometry.bounds.ua.j;
				var s = bex[0];//results[0].geometry.bounds.Ba.k;
				var e = bex[3];//results[0].geometry.bounds.ua.k;
				var n = bex[1];//results[0].geometry.bounds.Ba.j;
				
				var b = new OpenLayers.Bounds(w,s,e,n);
				b.transform(proj,map.getProjectionObject());
				map.zoomToExtent(b);
				//alert(results[0].geometry.bounds.va.j);   
				//var point_new = new OpenLayers.LonLat(results[0].geometry.location.B,results[0].geometry.location.k);
				//point_new.transform(proj,map.getProjectionObject());
				//map.setCenter(point_new,z||false);
				return results[0].geometry.location    ;             
			}
			else {
				alert("Geocoding failed: " + status);                            
			}
		});
   }
   if (pekerjaan_change) {
   		$("#pekerjaan_text2").val($("#pekerjaan option:selected").text());
		$("#pekerjaan_text").val("");	
	}
	else {
		$("#pekerjaan_text").prop("disabled",$("#pekerjaan option:selected").val()!='0'?true:false);	
	}
   $("#pekerjaan").change(function(){
		$("#pekerjaan_text").prop("disabled",$(this).val()!='0'?true:false).val("").focus();
		$("#pekerjaan_text2").val($("#pekerjaan option:selected").text());
	});
	$("#pekerjaan_text").keyup(function(){
		$("#pekerjaan_text2").val($(this).val());
	});
});
//Uploader
$(function(){
	var ufile=false;
	var x = false; 
	var y = false;
	var z = false;
	var maxfiles = 3;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickfiles',
		container: 'uploader',
		multi_selection: false,
		url: "http://brwa.or.id/test.php",
		max_file_size : '3250kb',
		filters : [
			//{title : "Image files", extensions : "jpg,gif,png"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
	var uppeta = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickpeta',
		container: 'uppeta',
		multi_selection: false,
		url: "http://brwa.or.id/test.php",
		max_file_size : '3250kb',
		filters : [
			{extensions : "jpg,gif,png,zip,kml,kmz"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
    var upsk = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'picksk',
		container: 'upsk',
		multi_selection: false,
		url: "http://brwa.or.id/test.php",
		max_file_size : '3250kb',
		filters : [
			{extensions : "jpg,gif,png,doc,docx,pdf"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
	
	uploader.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		var z=0;
		$.each(files, function(i,file){
			if (z > maxfiles) {
				up.removeFile(file);
			}
			else {
				var list_col = '<tr id="trf_'+file.id+'"><td><input type="text" name="file_keterangan[]" class="form-control"></td><td>'+file.name+'</td><td>'+plupload.formatSize(file.size)+'</td><td><a href="#" id="' + file.id + '" class="removeFile"><i class="fa fa-times-circle"></i></a></tr><input type="hidden" name="file_pendukung[]" value="'+file.name+'"';
				$("#file_list tr:last").before(list_col);
			}
		});
		 if (up.files.length >= maxfiles) {
			$('#pickfiles').hide("slow");
		}
	});
	uploader.bind('FilesRemoved', function(up, files) {
		 if (up.files.length < maxfiles) {
			$('#pickfiles').fadeIn("slow");
		}
	});
	uploader.bind('Error', function(up, err) {
		alert("Error: File yang anda masukkan lebih dari batas maksimal 3MB");
		up.refresh();
	});
	
	$(document).on("click","a.removeFile", function(e){
		uploader.removeFile(uploader.getFile(this.id));
		$('#trf_'+this.id).remove();
		e.preventDefault();
	});
	
	uploader.bind('FileUploaded', function(upldr, file, object) {
		var myData;
		try {
			myData = eval(object.response);
		} catch(err) {
			myData = eval('(' + object.response + ')');
		}
		//alert('uploader'+"::"+myData.result);
		if (
			uploader.files.length === (uploader.total.uploaded + uploader.total.failed) && 
			uppeta.files.length === (uppeta.total.uploaded + uppeta.total.failed) && 
			upsk.files.length === (upsk.total.uploaded + upsk.total.failed)
			) {
			x=true;
			$('#fdata').submit();
		}
	});
	uploader.bind('UploadProgress', function(up, file) {
		//var  $fileWrapper = $('#' + file.id);
		//$fileWrapper.find(".plupload_progress").show();
		//$(".plupload_progress_bar").attr("style", "width:"+ file.percent + "%");
		var col="blue";
		$(".plupload_progress_bar_1").attr("style", "width:"+ file.percent + "px; height:10px; float:left; margin-top:5px; background:"+col+"; display:inline-block");
		$(".plupload_progress_text_1").text(file.percent + "%");
		//if (file.percent>=100) { x=true; };
		//$fileWrapper.find(".percentComplete").html(file.percent+"%");
		//$fileWrapper.find('#cancel'+file.id).remove();
	});
	
	//peta upload
	
	uppeta.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	uppeta.init();

	uppeta.bind('FilesAdded', function(up, files) {
		var z=0;
		$.each(files, function(i,file){
			$("#lampiran_peta").val(file.name);
		});
	});
	uppeta.bind('Error', function(up, err) {
		alert("Error: File yang anda masukkan lebih dari batas maksimal 3MB");
		up.refresh();
	});
	
	uppeta.bind('FileUploaded', function(upldr, file, object) {
		var myData;
		try {
			myData = eval(object.response);
		} catch(err) {
			myData = eval('(' + object.response + ')');
		}
		//alert('uppeta'+"::"+myData.result);
		if (
			uploader.files.length === (uploader.total.uploaded + uploader.total.failed) && 
			uppeta.files.length === (uppeta.total.uploaded + uppeta.total.failed) && 
			upsk.files.length === (upsk.total.uploaded + upsk.total.failed)
			) {
			y=true;
			$('#fdata').submit();
		}
	});
	uppeta.bind('UploadProgress', function(up, file) {
		var col="blue";
		$(".plupload_progress_bar_0").attr("style", "width:"+ file.percent + "px; height:10px; float:left; margin-top:5px; background:"+col+"; display:inline-block");
		$(".plupload_progress_text_0").text(file.percent + "%");
	});
	//end peta upload
	
	//upload sk
	upsk.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	upsk.init();

	upsk.bind('FilesAdded', function(up, files) {
		var z=0;
		$.each(files, function(i,file){
			$("#surat_kuasa").val(file.name);
		});
	});
	upsk.bind('Error', function(up, err) {
		alert("Error: File yang anda masukkan lebih dari batas maksimal 3MB ");
		up.refresh();
	});
	
	upsk.bind('FileUploaded', function(upldr, file, object) {
		var myData;
		try {
			myData = eval(object.response);
		} catch(err) {
			myData = eval('(' + object.response + ')');
		}
		//alert('uppeta'+"::"+myData.result);
		if (
			uploader.files.length === (uploader.total.uploaded + uploader.total.failed) && 
			uppeta.files.length === (uppeta.total.uploaded + uppeta.total.failed) && 
			upsk.files.length === (upsk.total.uploaded + upsk.total.failed)
			) {
			z=true;
			$('#fdata').submit();
		}
	});
	upsk.bind('UploadProgress', function(up, file) {
		var col="blue";
		$(".plupload_progress_bar_2").attr("style", "width:"+ file.percent + "px; height:10px; float:left; margin-top:5px; background:"+col+"; display:inline-block");
		$(".plupload_progress_text_2").text(file.percent + "%");
	});
	//end sk
	/*$("#btn-upload").click(function(){
		var err = 0;
		$(".required").each(function(){
			if ($(this).val().length==0) {
				err++;
			}
		});
		if (err==0) {
			
			if (uploader.files.length > 0) {
				uploader.start();
			} else {
				x = true;
				$('#fdata').submit()
			}
		}
		else {
			alert("ERROR"); 
			return false;
		}
	});*/
	$('#fdata').submit(function(e) {
		
		// Files in queue upload them first
		if (uploader.files.length > 0 || uppeta.files.length > 0 || upsk.files.length > 0) {
			uploader.start();
			uppeta.start();
			upsk.start();
		}
		else {
			x = true; y=true; z = true;
		}
		$("#konfirm").html((!x && !y && !z)?"Uploading Data...Please Wait":"Submitting Data...");
		//return false;
		//alert(x+":"+y);
		//alert('You must at least upload one file.');
		//return false;
		return (!x && !y && !z)? false:true;
	});    
    
});
</script>
<script>
$().ready(function() {
	$( "#fdata" ).validate({
	  rules: {
		nama_kewilayahan: {
		  required: true,
		  maxlength: 75
		},
		bahasa: {
		  required: true,
		  maxlength: 50
			},
		kecamatan: {
		  required: true,
		  maxlength: 255
			},
		desa: {
		  required: true,
		  maxlength: 255
			},
		luas: {
		  required: false,
		  maxlength: 15
			},
		kepala_keluarga: {
		  required: false,
		  maxlength: 11
			},
		laki_laki: {
		  required: false,
		  maxlength: 11
			},
		perempuan: {
		  required: false,
		  maxlength: 11
			},
		nama_pemohon: {
		  required: false,
		  maxlength: 50
			},
		jabatan_pemohon: {
		  required: false,
		  maxlength: 50
			},
		telp_pemohon: {
		  required: false,
		  maxlength: 50
			},
		hp_pemohon: {
		  required: false,
		  maxlength: 50
			},
		fax_pemohon: {
		  required: false,
		  maxlength: 50
			},
		email_pemohon: {
		  required: false,
		  maxlength: 100,
		  email: true
			},
		nama_tt: {
		  required: false,
		  maxlength: 50
			},
		jabatan_tt: {
		  required: false,
		  maxlength: 50
			},
		telp_tt: {
		  required: false,
		  maxlength: 50
			},
		hp_tt: {
		  required: false,
		  maxlength: 50
			},
		fax_tt: {
		  required: false,
		  maxlength: 50
			},
		email_tt: {
		  required: false,
		  maxlength: 100,
		  email: true
			},
		mata_pencaharian: {
		  required: false,
		  maxlength: 100
			}
			
	  },
	  messages: {
		nama_kewilayahan: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 75",
			required:"Tak boleh kosong"
			},
		bahasa: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50",
			required:"Tak boleh kosong"
			},
		kecamatan: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 255"
			},
		desa: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 255"
			},
		luas: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 15"
			},
		kepala_keluarga: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 11"
			},
		laki_laki: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 11"
			},
		perempuan: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 11"
			},
		nama_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		jabatan_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		telp_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		hp_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		fax_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		email_pemohon: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 100"
			},
		nama_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		jabatan_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		telp_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		hp_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		fax_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 50"
			},
		email_tt: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 100"
			},
		mata_pencaharian: {
			maxlength:"Karakter yang anda Masukkan Lebih Dari 100"
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('error');
		  },
		  
	});
	});
</script>


