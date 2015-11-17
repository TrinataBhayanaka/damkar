<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script type="text/javascript" src="assets/js2/OL212/OpenLayers.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/jquery.plupload.queue.js"></script>
<script type="text/javascript">
	var map;
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
		map.addControl(new OpenLayers.Control.Navigation());
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
		$("#koordinat_bujur").val(Math.round(point_click.lat * 1000000.)/1000000);
		$("#koordinat_lintang").val(Math.round(point_click.lon * 1000000.)/1000000);
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
    height: 256px;
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
      <h1>Pendaftaran Wilayah adat</h1>
      <p class="lead">Agar dapat melakukan registrasi wilayah adat, anda harus terdaftar</p>
    </div>
  </div>
</div>
<?php echo form_open("user/register",'id="fdata"');?>
<input type="hidden" name="idx" value="<?=$data['id'];?>" />
<div class="container">
    <div class="row">
    	<div class="col-md-12">
          
          <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Form Pendaftaran</h3>
                        </div>
                    </div>
                    	<div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Nama Kewilayahan</label>
                                <?php echo form_input('nama_kewilayahan',false,'class="form-control required"');?>
                                </div>
                            </div>
                        </div>
                		
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Kewilayahan</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<?php
									$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
									$arrPropinsi1=array(""=>"--Pilih Propinsi--")+$arrPropinsi;
								?>
                            	<div class="form-group">
                                <label>Propinsi</label>
                                <?=form_dropdown("id_propinsi",$arrPropinsi1,0,"id='id_propinsi' class='form-control required'");?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Kabupaten</label>
                                <div id="id_kabupaten_holder">
                            	<?=form_dropdown("id_kabupaten",$m_pekerjaan,0,"id='id_kabupaten' class='form-control'");?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Kecamatan</label>
                                <?php echo form_input('kecamatan',false,'class="form-control required"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Desa</label>
                                <?php echo form_input('desa',false,'class="form-control required"');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                    <div>
                                		<span class="help-block" style="display:inline">Peta Lokasi Wilayah Adat</span>
                                        <div id="map" class="smallmap"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>latitude</label>
                                <?php echo form_input('lat',false,'id="koordinat_bujur" class="form-control required"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Longitude</label>
                                <?php echo form_input('lon',false,'id="koordinat_lintang" class="form-control required"');?>
                                </div>
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
                                    <td><?php echo form_input('batas_barat',false,'class="form-control"');?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Batas Selatan</td>
                                    <td><?php echo form_input('batas_selatan',false,'class="form-control"');?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Batas Timur</td>
                                    <td><?php echo form_input('batas_timur',false,'class="form-control"');?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%">Batas Utara</td>
                                    <td><?php echo form_input('batas_utara',false,'class="form-control"');?></td>
                                </tr>
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Batas lainnya</label>
                                <input type="text" id="batas_lain" class='form-control' />
                                </div>
                            </div>
                            <div class="col-md-5">
                            	<div class="form-group">
                            	<label>&nbsp;</label>
                                <input type="text" id="batas_lain_val" class='form-control' />
                                 </div>
                            </div>
                            <div class="col-md-1">
                            	<div class="form-group">
                            		<label>&nbsp;</label>
                                	<button id="add_batas_wilayah" type="button" class='form-control'>+</button>
                                 </div>
                            </div>
                        </div>
                        
                        <!--Wilayah Adat -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Wilayah Adat</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Luas (Ha)</label>
                                <?php echo form_input('luas',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Satuan</label>
                            	<?=form_dropdown("satuan",$m_pekerjaan,$pekerjaan_select['value'],"id='pekerjaan' class='form-control'");?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<?php 	
									$arrLookupGroup=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
								?>
                            	<div class="form-group">
                                <label>Kondisi Fisik</label>
                                <?=form_dropdown("id_kondisi_fisik",$arrLookupGroup,0,"id='kondisi_fisik' class='form-control'");?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Sejarah Singkat Masyarakat adat</label>
                                <textarea name="sejarah_singkat" class="form-control " rows="3"></textarea>
                                </div>
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
                                <textarea name="pembagian_ruang" class="form-control " rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Penggunaan & Pengelolaan Wilayah</label>
                            	<textarea name="sistem_penguasaan" class="form-control " rows="2"></textarea>
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
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Nama</label>
                                <?php echo form_input('nama_lembaga_adat',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Struktur</label>
                            	<?=form_dropdown("struktur",$m_pekerjaan,$pekerjaan_select['value'],"id='pekerjaan' class='form-control'");?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Tujuan & fungsi para pemangku adat</label>
                                <textarea name="tugas_dan_fungsi" class="form-control required" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Mekanisme Pengambilan keputusan</label>
                                <textarea name="mekanisme_pengambilan_keputusan" class="form-control required" rows="2"></textarea>
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
                                <textarea name="aturan_adat" class="form-control " rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Wilayah dan Sumber daya alam</label>
                                <textarea name="wilayah_dan_sda" class="form-control " rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Aturan Adat terkait Pranata Sosial</label>
                                <textarea name="aturan_pranata_sosial" class="form-control required" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Contoh Keputusan dari penerapan Hukum Adat</label>
                                <textarea name="contoh_keputusan" class="form-control required" rows="2"></textarea>
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
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Kepala Keluarga</label>
                                <?php echo form_input('kepala_keluarga',false,'class="form-control"');?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Laki-laki</label>
                                <?php echo form_input('laki-laki',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Perempuan</label>
                                <?php echo form_input('perempuan',false,'class="form-control"');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Mata Pencaharian utama</label>
                            	<?=form_dropdown("mata_pencaharian",$m_pekerjaan,$pekerjaan_select['value'],"id='pekerjaan' class='form-control'");?>
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
                            <div class="col-md-6">
                            	<?php
									$arrLookupGroup=m_lookup("wa_jenis_ekosistem","id_jenis_ekosistem","jenis_ekosistem",""," order by order_num asc "); 												
									$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
								?>
                            	<div class="form-group">
                                <label>Jenis Ekosistem</label>
                            	<?=form_dropdown("id_jenis_ekosistem",$arrLookupGroup,0,"id='jenis_ekosistem' class='form-control'");?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<?php
									$arrLookupGroup=m_lookup("wa_potensi_hayati","id_potensi_hayati","nama_potensi_hayati",""," order by idx asc "); 												
									$arrLookupGroup=array(""=>"-- Pilih Potensi --")+$arrLookupGroup;
								?>
                            	<div class="form-group">
                                <label>Potensi dan Manfaat Keanekaragaman Hayati</label>
                                <?=form_dropdown("id_potensi_hayati",$arrLookupGroup,0,"id='potensi_hayati' class='form-control'");?>
                                </div>
                            </div>
                            <div class="col-md-5">
                            	<div class="form-group">
                            	<label>&nbsp;</label>
                                <input type="text" id="pekerjaan_text" name="pekerjaan_text" class='form-control' disabled="disabled" value="<?=$pekerjaan['value']?>" />
                                 <input type="hidden" id="pekerjaan_text2" name="pekerjaan" class='form-control' value="<?=$pekerjaan['value']?>"  />
                                 </div>
                            </div>
                            <div class="col-md-1">
                            	<div class="form-group">
                            		<label>&nbsp;</label>
                                	<button type="button" class='form-control'>+</button>
                                 </div>
                            </div>
                        </div>
                        <!--Keanekaragaman Hayati-->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Apakah Registrasi Wilayah Adat sudah di Musyawarahkan?</h3>
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
                        
                        
                        
                        
                </div> <!-- span6 -->
                <div class="col-md-5">
                    <!--Data Pemohon -->
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Data Pemohon</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Nama Lengkap</label>
                            <?php echo form_input('nama_pemohon',$user['nama'],'class="form-control"');?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Jabatan</label>
                            <?php echo form_input('jabatan_pemohon',false,'class="form-control"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Alamat Surat/menyurat</label>
                            <textarea name="alamat_pemohon" class="form-control required" rows="2"><?=$user['alamat'];?></textarea>
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
                    
                    <!--Penanda Tangan Kontrak -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Penanda Tangan Kontrak</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Nama Lengkap</label>
                                <?php echo form_input('nama_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            	<div class="form-group">
                                <label>Jabatan</label>
                                <?php echo form_input('jabatan_tt',false,'class="form-control"');?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            	<div class="form-group">
                                <label>Alamat Surat/menyurat</label>
                                <textarea name="alamat_tt" class="form-control required" rows="2"></textarea>
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
                    <!-- konfirm password-->
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                            <?php echo lang('create_user_password_label', 'password');?>
                            <?php echo form_input($password,false,'class="form-control required"');?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="form-group">
                            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                            <?php echo form_input($password_confirm,false,'class="form-control required"');?>
                            </div>
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
  
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn">Cancel</button>
    </div>
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
   
   $("#id_propinsi").change(function(){
   		var id_propinsi = $(this).val();
		$("#id_kabupaten_holder").load("<?=$this->module;?>wa/get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime());
   });
   
   $("#add_batas_wilayah").click(function(){
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
	var w_image = $("#attachment_frame").width()-10;
	var ufile=false;
	var dfile=<?=($data['image'])?"true":"false";?>;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'btn-change',
		container: 'imgcontainer',
		multi_selection: false,
		url: "<?=base_url()?>test.php",
		max_file_size : '500kb',
		/*resize: {
			width: 200,
			height: 150,
			crop: true
		},*/
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
	
	uploader.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		if (dfile) {
			$('#preview').html("");
			$('#canvas_view').html("");
		}
		if (ufile) {
			uploader.removeFile(ufile);
			$('#preview').html("");
			$('#canvas_view').html("");
		}
		$.each(files, function(i,file){
			ufile = file.id;
			$("#image_name").val(file.name);
			var img = new mOxie.Image();
	
			img.onload = function() {
				this.embed($('#preview').get(0), {
					width: w_image,
					height: 170,
					crop: true
				});
				$('#canvas_view').css({margin:"2px 10px 10px 2px"});
				$('#canvas_view').css({width:w_image,height:170});
				this.embed($('#canvas_view').get(0), {
					width: w_image,
					height: 170,
					crop: true
				});
			};
	
			img.onembedded = function() {
				this.destroy();
			};
	
			img.onerror = function() {
				this.destroy();
			};
	
			img.load(this.getSource());        
			
		});
	});
	uploader.bind('Error', function(up, err) {
		alert("Error: " + err.code + " -" + err.message/* +  (err.file ? ", File: " + err.file.name : "")*/);
		up.refresh(); // Reposition Flash/Silverlight
	});
	var x = false;
	uploader.bind('FileUploaded', function() {
		//if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
			x=true;
			$('#fdata').submit();
		//}
	});
	$('#fdata').submit(function(e) {
		// Files in queue upload them first
		if (uploader.files.length > 0) {
			uploader.start();
		} else {
			//x = true;
			alert('Lampiran tanda pengenal wajib ada.');
		}
		//	alert('You must at least upload one file.');
	
		if (!x) return false;
	});    
    
});
</script>


<script>
	$(function(){
		$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
		$(".comments_add").click(function(e){
			e.preventDefault();
			$("#add_comments").load("<?=$this->module?>comments_add/<?=$data["id"]?>/<?=$data["category"];?>");
		});
		
		$("#com_add_save").live("click",function(e){
			e.preventDefault();
			var url="<?=$this->module?>comments_add_save/";
			var data=$("#frm_comment").serialize();
			$.post(url,data,function(ret){
				if(ret=="ok"){
					$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
					Alert("Message","OK");
				}else{
					Alert("Message","not OK");
				}
			})
		});
		
		$(".comments_reply").live("click",function(e){
			e.preventDefault();
			var url=$(this).attr("rel");
			$("#add_comments").load(url);
		});
		
		$("#com_reply_save").live("click",function(e){
			e.preventDefault();
			var url="<?=$this->module?>comments_reply_save/";
			var data=$("#frm_comment_reply").serialize();
			$.post(url,data,function(ret){
				if(ret=="ok"){
					$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
					Alert("Message","OK");
				}else{
					Alert("Message","not OK");
				}
			})
		});
		
	});
</script>
