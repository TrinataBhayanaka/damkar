<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script type="text/javascript" src="assets/js2/OL212/OpenLayers.js"></script>
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
    height: 300px;
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
	color:#aaa;
	background:#eee;
	padding:5px;
	border-radius:3px
}

#ul_gallery,#ul_gallery li{
	list-style:none;
}

#ul_gallery
{
	 padding:0 0 0 0;
     margin:0 0 0 0;
}


</style>
<style>
	.simplecolorpicker{
		border:thin solid #DADADA !important;
	}
</style>
<?php
	$category=isset($category)?$category:"";
?>
<?php
$this->module_small_title="&bull; Add";
?>
<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                <!--<li class="">
                    <a href="<?php //echo $this->module?>add_dok/<?//=$arrdata['id'];?>">
                        <span class="block text-center">
                            <i class="icon-file"></i> 
                        </span>
                        Input Dokumen <?//=$this->module_title?>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
</div>



     <ul class="nav nav-tabs">
 		<li><a href="<?=$this->module?>listuser"><span class="fa fa-user"></span>  Pilih User (Step 1)</a></li>
		<li class="active"><a href="javascript:;"><span class="fa fa-file"></span> Input Form (Step 2)</a></li>
    </ul>



<div class="row">
	<div class="col-md-12 col-lg-12">
	<?php echo message_box();?>
	<!--<div class="row-fluid">-->
		<!--<ul class="nav nav-tabs" id="news-tab">
		   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-plus"></i> Add</a></li>
		</ul>-->
		<!--tab content-->
		<!--<div class="tab-content">-->
			
		<!--<div id="tab-edit" class="tab-pane active"> -->
		<?php echo form_open("wa_reg/add",'id="frm"');?>
		<input type="hidden" name="id_user" value="<?=$arrdata['id'];?>" />
		<input type="hidden" name="act" id="act" value="create"/>
			<div class="row">
				<div class="col-md-12 frm">
					<div class="row">
						<div class="col-md-12">
							<h3>Kewilayahan</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<label>Tanggal Pendaftaran</label>
									<input name="tanggal_pendaftaran" id="tanggal_pendaftaran" class="form-control input-date required" placeholder="yyyy-mm-dd" type="text">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Nama Komunitas</label> <i class="fa fa-question-circle frmtip" title="<?=$tooltip['1']?>"></i>
									<?php echo form_input('nama_kewilayahan',false,'class="form-control required"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Bahasa</label>
									<?php echo form_input('bahasa',false,'class="form-control required"');?>
									</div>
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
									<?=form_dropdown("id_kabupaten_1",$m_pekerjaan,0,"id='id_kabupaten_1' class='form-control'");?>
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
									<span style="display:inline;font-size:11px;color:grey;">Jika Kecamatan/Desa lebih dari satu , tulis dengan dibatasi tanda koma (,) per kecamatan/desa<br>Contoh: Duren Sawit,Pondok Kopi,Klender</span>
								</div>
								
							</div>
							<div class="row">
								<!-- batas wilayah adat dulunya  -->
							</div>
							
							<!--<div class="row">
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
							</div>-->
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div>
									<label>Peta Lokasi Wilayah Adat </label>
									<!--<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<input type="text" id="map_search" class="form-control" placeholder="Search Lokasi" />
											</div>
										</div>
									</div>-->
									<span class="help-block" style="display:inline">(Titik Lokasi Wajib diisi/dipilih)</span>
									<div id="map" class="smallmap"></div>
									<div style="padding-left:20px;" class="checkbox">
										<label>
										  <input id="zoomscroll" type="checkbox"> Mouse Wheel Zoom
										</label>
									  </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>latitude</label>
									<?php echo form_input('pos_x',false,'id="koordinat_bujur" class="form-control required"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Longitude</label>
									<?php echo form_input('pos_y',false,'id="koordinat_lintang" class="form-control required"');?>
									</div>
								</div>
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
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Luas (Ha)</label>
									<?php echo form_input('luas',false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Nama Satuan Wilayah Adat</label>
                                    <?php echo form_input('satuan',false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12"><div class="formSep"></div>
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
							
								<!-- 
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Sejarah Singkat Masyarakat adat</label>
											<textarea name="sejarah_singkat" class="form-control " rows="3"></textarea>
											</div>
										</div>
									</div>
								</div>
								 -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label>Kondisi Fisik</label>
							<?php 	
								$kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												
								foreach($kfisik as $k=>$v) {
							?>
							<div class="checkbox" style="padding-left:20px;">
                              <label>
                                <input name="list_kondisi_fisik[]" type="checkbox" value="<?=$k;?>">
                                <?=$v;?>
                              </label>
                            </div>
							<? } ?>
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
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
									<label>Kepala Keluarga</label>
									<?php echo form_input('kepala_keluarga',false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Laki-laki</label>
									<?php echo form_input('laki_laki',false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Perempuan</label>
									<?php echo form_input('perempuan',false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Mata Pencaharian utama</label>
									<textarea name="mata_pencaharian" class="form-control" rows="2"><?=$data["mata_pencaharian"]?></textarea>
									</div>
								</div>
							</div>
						</div>
				  </div>
					<!--Sejarah Wilayah Adat -->
					<div class="row">
						<div class="col-md-12">
							<h3>Sejarah Masyarakat adat</h3>
						</div>
					</div>
					<div class="row">
					<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Sejarah Singkat Masyarakat adat</label>
											<textarea name="sejarah_singkat" class="form-control " rows="10"></textarea>
											</div>
										</div>
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
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Pembagian ruang menurut aturan adat</label>
									<textarea name="wa_hak_pembagian_ruang" class="form-control" rows="2"></textarea>
									<!--<table id="table_ruang" class="table table-bordered" style="width:100%">
									<thead>
                                    <tr>
                                    	<th colspan="2">Pemanfaatan Kawasan</th><th>Luas (Ha)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>-->
									</div>
								</div>
							</div>
                            
                            <!--<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>&nbsp;</label>
									<input type="text" id="ruang" class='form-control' />
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
									<label>&nbsp;</label>
									<input type="text" id="ruang_val" class='form-control' />
									 </div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label>&nbsp;</label>
										<button id="add_ruang" type="button" class='form-control'>+</button>
									 </div>
								</div>
							</div>-->
                            
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Sistem Penguasaan & Pengelolaan Wilayah</label>
									<textarea name="sistem_penguasaan" class="form-control " rows="2"></textarea>
									</div>
								</div>
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
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Nama Lembaga Adat</label>
									<?php echo form_input('nama_lembaga_adat',false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Struktur Lembaga Adat</label>
									 <textarea name="struktur" class="form-control required" rows="2"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Tugas & fungsi para pemangku adat</label>
									<textarea name="tugas_dan_fungsi" class="form-control required" rows="2"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Mekanisme Pengambilan keputusan</label>
									<textarea name="mekanisme_pengambilan_keputusan" class="form-control required" rows="2"></textarea>
									</div>
								</div>
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
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Aturan adat terkait pengelolaan Wilayah dan Sumber daya alam</label>
									<textarea name="aturan_adat" class="form-control " rows="2"></textarea>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Wilayah dan Sumber daya alam</label>
									<textarea name="wilayah_dan_sda" class="form-control " rows="2"></textarea>
									</div>
								</div>
							</div>
							 -->
							 <div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Aturan Adat terkait Pranata Sosial</label>
									<textarea name="aturan_pranata_sosial" class="form-control" rows="2"></textarea>
									</div>
								</div>
							</div>
							
						</div>
						<div class="col-md-6">
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Contoh Keputusan dari penerapan Hukum Adat</label>
									<textarea name="contoh_keputusan" class="form-control required" rows="6"></textarea>
									</div>
								</div>
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
									?>
									<div class="form-group">
									<label>Potensi & Manfaat Keanekaragaman Hayati</label>
									 <table id="table_potensi" class="table table-bordered" style="width:100%">
									<thead>
                                    </thead>
                                    <tbody>
                                    <?php foreach($arrLookupGroup as $id_potensi => $nama_potensi):?>
                                    	<tr><td><?php echo $nama_potensi?><input type="hidden" class="form-control" value="<?php echo $id_potensi;?>" name="id_potensi[]"><input type="hidden" class="form-control" value="<?php echo $nama_potensi?>" name="potensi[]"></td><td><input type="text" class="form-control" value="<?php echo $potensi[$id_potensi]["keterangan"]?>" name="potensi_val[]"></td><td>&nbsp;</td></tr>
									<?php endforeach;?>
                                    </tbody>
                                    </table>
									</div>
                                    
                                    
                            <!--<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>&nbsp;</label>
									<input type="text" id="potensi" class='form-control' />
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
									<label>&nbsp;</label>
									<input type="text" id="potensi_val" class='form-control' />
									 </div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label>&nbsp;</label>
										<button id="add_potensi" type="button" class='form-control'>+</button>
									 </div>
								</div>
							</div>-->
                                    
                                    
								</div>
								<div class="col-md-6">
									
								</div>
								
							</div>
						</div>
						<div class="col-md-6">
							<!--col right-->
						</div>
				  </div>
				  
				  <div class="row">
						<div class="col-md-12">
							<!--Confirm-->
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
						</div>
				  </div>
				  
				  <div class="row">
						<div class="col-md-6">
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
									<?php echo form_input('nama_pemohon',$arrdata['nama'],'class="form-control"');?>
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
									<textarea name="alamat_pemohon" class="form-control required" rows="2"><?=$arrdata['alamat'];?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Telp</label>
									<?php echo form_input('telp_pemohon',$arrdata['phone'],'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>HP</label>
									<?php echo form_input('hp_pemohon',$arrdata['handphone'],'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Fax</label>
									<?php echo form_input('fax_pemohon',$arrdata['fax'],'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Email</label>
									<?php echo form_input('email_pemohon',$arrdata['email'],'class="form-control"');?>
									</div>
								</div>
							</div>
						</div> <!-- span6 -->
						<div class="col-md-6">
							<!--Penanda Tangan Kontrak -->
								<div class="row">
									<div class="col-md-12">
										<h3>Penanda Tangan Surat Perjanjian Kerjasama</h3>
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
						</div>
						
						<div class="col-md-6">
								
						</div>
					</div>
                    
                    <div class="row">
						<div class="col-md-12">
							<h3>File Pendukung</h3>
						</div>
					</div>	
                    
                    <div class="row">
                    		<div class="col-md-6">
                            <!-- File pendukung -->
                            <div class="box box-success">
            <div class="box-body">
             <h5 class="heading">Upload Document</h5>
             <div class="form-group">
                <div class="col-md-12"  >
                    <?php
										$arrLookupGroup=m_lookup("wa_jenis_document","id_doc","nama_doc",""," order by order_num asc "); 												
										//$arrLookupGroup=array(""=>"-- Pilih Potensi --")+$arrLookupGroup;
									?>
									<div class="form-group">
									<? //=form_dropdown("id_potensi_hayati",$arrLookupGroup,$data['id_potensi_hayati'],"id='potensi_hayati' class='form-control'");?>
									
                                    <table id="table_file" class="table table-bordered" style="width:100%">
									<thead>
                                    </thead>
                                    <tbody>
                                    <?php $no=1;?>
                                    <?php foreach($arrLookupGroup as $id_doc => $nama_doc):?>
                                    	<tr id="<?=$id_doc?>"><td width="5"><?php echo $no++;?></td><td width="200"><?php echo $nama_doc?></td><td class="file_pendukung <?=$id_doc?>" id="<?="data_".$id_doc?>">
                                     <a class="btn browse_doc  btn-xs btn-primary" id="browse_doc_<?=$id_doc?>" data-id_doc="<?=$id_doc?>" href="javascript:;">[+] File</a> 
                    <a data-id_doc="<?=$id_doc?>" class="btn browse_doc_upload btn-xs btn-primary hide" href="javascript:;">[Start Upload]</a>    
                    				<ul class="filelist"></ul>
                                    
                                    <table id="table_file_<?=$id_doc?>" class="table table-condensed file_list table-bordered">
                                    <thead>
                                        <tr><th width="10px">#</th><th>File</th><th width="10px">#</th></tr>
                                    </thead>
                                    <tbody>
                                    <? if(cek_array($data_file2[$id_doc])):?>
                                    	<? foreach($data_file2[$id_doc] as $x=>$file):?>
										<tr class='file_row' id="file_upload_<?=$file["id_file"]?>" data-file_id="<?=$file["id_file"]?>">
        <td><input type="hidden" name="upload_file_id[]" value="<?=$file["id_file"]?>"/><input type="hidden" name="id_jenis_doc[]" value="<?=$file["id_jenis_doc"]?>"/><a href="./<?=$file["file_path"]?>" class='file_open' target='_blank'><i class="icon-search"></i> </a></td>
        <td>
        <label style='height:auto;'><?=$file["file_name"]?></label></td>
        <td><a href="" class='upload_file_remove red'><i class="icon-remove"></i> </a></td>
        	</tr>
                                        <? endforeach;?>
									<? endif; ?>
                                    </tbody>
                               </table>
                                    
                                    
                    				</td></tr>
									<?php endforeach;?>
                                    </tbody>
                                    </table>
            						</div>
                    
                </div>
            </div>
            <div class="clearfix"></div>
        	</div></div><!-- end box-->
            <!-- end file pendukung-->
                            </div>
                            
                            <div class="col-md-6">
                            <div class="box box-success" >
                            <div class="box-body">    
                            <h5 class="heading">Upload Peta</h5>
                             <div class="form-group">
                                <div class="col-md-12">
                                    <a id="browse" class="btn btn-xs btn-primary" href="javascript:;">[+] Peta</a> 
                                    <a id="start-upload" class="btn btn-xs btn-primary hide" href="javascript:;">[Start Upload]</a>
                                    <br>
                                    <ul id="filelist"></ul>
                                     <div class="table-responsive" style="overflow-y:hidden;overflow-x:auto">
                                    <table id="table_file_peta" class="table table-condensed file_list table-bordered">
                                        <thead>
                                            <tr><td width="10px">#</td><td>File</td><td width="10px">#</td></tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            </div></div><!-- end box -->
                            
                            </div></div><!-- end row-->
                            
                            
                            
                             <div class="row">
                            	<div class="col-md-12">
                                <h3>Upload Picture</h3>
                                <a id="browse_pic" class="btn btn-xs btn-primary" href="javascript:;">[+] Image</a> 
                                <ul id="imagelist"></ul>
                                <div class="gallery">
                                	<ul id="ul_gallery" class="row">
                                    </ul>
                                </div>
                                	
                                </div>
                            </div>
                    
                    <div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>&nbsp;</label><br />
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="reset" class="btn">Cancel</button>
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
		<!--</div>
	</div>-->
    <!--<form id="frm" method="post" action="<?php //echo $this->module;?>add/" class="form-horizontal control-label-left" role="form">
    	<input type="hidden" name="act" id="act" value="create"/>
		<input type="hidden" name="id" id="id"/>
        <div class="row">
			<div class="col-md-6">
				<h5 class="heading">Data Wilayah Adat</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Nama Kewilayahan</label>
					<div class="col-md-9">
						<input type="text" id="nama_kewilayahan" name="nama_kewilayahan" class="form-control input-xs required" style="width:100%" placeholder="Nama Kewilayahan" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading">Kewilayahan</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Propinsi</label>
					<div class="col-md-9">
						<?php
							//$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
							//$arrPropinsi1=array(""=>"--Pilih Propinsi--")+$arrPropinsi;
						?>
						<? //echo form_dropdown("id_propinsi",$arrPropinsi1,"","id='id_propinsi' class='select2' style='width:100%'");?>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="description" class="control-label no-padding-right col-md-3 ">Kabupaten</label>
					<div class="col-md-9">
						<div id="div_kabupaten">
								<span class="red">* Pilih Propinsi terlebih dahulu..</span>
								<? //echo form_dropdown("id_kabupaten_1",array(),"","id='id_kabupaten_1' class='select2' placeholder='--Pilih Kabupaten--' style='width:100%'");?>              	
						</div>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div>		
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Kecamatan</label>
					<div class="col-md-9">
						<input type="text" id="kecamatan" name="kecamatan" class="form-control input-xs required" style="width:100%" placeholder="Kecamatan" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Desa</label>
					<div class="col-md-9">
						<input type="text" id="desa" name="desa" class="form-control input-xs required" style="width:100%" placeholder="Desa" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Lokasi (Long/Lat)</label>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<input type="text" id="pos_x" name="pos_x" class="form-control input-xs required" placeholder="Long" value="" />
							</div>
							<div class="col-md-6">
								<input type="text" id="pos_y" name="pos_y" class="form-control  input-xs required" placeholder="Lat" value="" />
							</div>
						</div>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading">Wilayah Adat</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Luas</label>
					<div class="col-md-9">
						<input type="text" id="luas" name="luas" class="form-control input-xs required" style="width:100%" placeholder="(Ha)" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->	
			    <!--<div class="form-group">
					<label for="description" class="control-label no-padding-right col-md-3 ">Kondisi Fisik</label>
					<div class="col-md-9">
					    <?php 	
							//$arrLookupGroup=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 												$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
						?>
						<? //echo form_dropdown("id_kondisi_fisik",$arrLookupGroup,"","id='id_kondisi_fisik' class='select2 form-control required' style='width:100%;' ");?>
					    <span class="help-block"></span>
					    <div class="formSep"></div>
					</div>
				</div> 
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Satuan</label>
					<div class="col-md-9">
						<input type="text" id="satuan" name="satuan" class="form-control input-xs required" style="width:100%" placeholder="(Kampung,Balai,dll)" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading">Kependudukan</h5>  
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Kepala Keluarga</label>
					<div class="col-md-9">
						<input type="text" id="kepala_keluarga" name="kepala_keluarga" class="form-control input-xs required" style="width:100%" placeholder="Jumlah Kepala Keluarga" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Laki-laki</label>
					<div class="col-md-9">
						<input type="text" id="laki_laki" name="laki_laki" class="form-control input-xs required" style="width:100%" placeholder="Jumlah Laki-laki" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Perempuan</label>
					<div class="col-md-9">
						<input type="text" id="perempuan" name="perempuan" class="form-control input-xs required" style="width:100%" placeholder="Jumlah Perempuan" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Mata Pencaharian Utama</label>
					<div class="col-md-9">
						<input type="text" id="mata_pencaharian" name="mata_pencaharian" class="form-control input-xs required" style="width:100%" placeholder="Mata pencaharian utama" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading">Sejarah Singkat Masyarakat Adat (Sejarah asal-usul, suku)</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Deskripsi</label>
					<div class="col-md-9">
						<textarea id="sejarah_singkat" name="sejarah_singkat" placeholder="sejara singkat" class="required form-control"></textarea>
						
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading"> Hak atas Tanah dan Pengelolaan Wilayah</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Pembagian Ruang Menurut Adat</label>
					<div class="col-md-9">
						<textarea id="pembagian_ruang" name="pembagian_ruang" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Sistem penguasaan dan pengelolaan wilayah</label>
					<div class="col-md-9">
						<textarea id="sistem_penguasaan" name="sistem_penguasaan" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading"> Kelembagaan Wilayah Adat</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Nama</label>
					<div class="col-md-9">
						<input type="text" id="nama_lembaga_adat" name="nama_lembaga_adat" class="form-control input-xs required" style="width:100%" placeholder="Nama Lembaga Adat" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Struktur</label>
					<div class="col-md-9">
						<input type="text" id="struktur" name="struktur" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				 <!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Tugas dan Fungsi para pemangku adat</label>
					<div class="col-md-9">
						<textarea id="tugas_dan_fungsi" name="tugas_dan_fungsi" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Mekanisme Pengambilan Keputusan</label>
					<div class="col-md-9">
						<textarea id="mekanisme_pengambilan_keputusan" name="mekanisme_pengambilan_keputusan" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
			<!--</div>
        
        
			<div class="col-md-6">
				<h5 class="heading"> Hukum Adat</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Aturan adat terkait pengelolaan sumber daya alam</label>
					<div class="col-md-9">
						<textarea id="aturan_adat" name="aturan_adat" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Wilayah dan Sumber daya alam</label>
					<div class="col-md-9">
						<textarea id="wilayah_dan_sda" name="wilayah_dan_sda" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Aturan adat terkait Pranata sosial</label>
					<div class="col-md-9">
						<textarea id="aturan_pranata_sosial" name="aturan_pranata_sosial" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Contoh Keputusan dari penerapan hukum adat</label>
					<div class="col-md-9">
						<textarea id="contoh_keputusan" name="contoh_keputusan" placeholder="Uraian Singkat" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading"> Keaneka ragaman Hayati</h5>
				<div class="form-group">
					<label for="description" class="control-label no-padding-right col-md-3 ">Jenis Ekosistem</label>
					<div class="col-md-9">
						<?php 	
							//$arrLookupGroup=m_lookup("wa_jenis_ekosistem","id_jenis_ekosistem","jenis_ekosistem",""," order by order_num asc "); 												
							//$arrLookupGroup=array(""=>"-- Pilih Kondisi --")+$arrLookupGroup;
						?>
						<? //echo form_dropdown("id_jenis_ekosistem",$arrLookupGroup,"","id='id_jenis_ekosistem' class='select2 form-control required' style='width:100%;' ");?>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div> 
        
				<h5 class="heading"> Kontak</h5>
				<h5 class="heading"> Pemohon</h5>
				 <div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Nama</label>
					<div class="col-md-9">
						<input type="text" id="nama_pemohon" name="nama_pemohon" class="form-control input-xs required" style="width:100%" placeholder="Nama Pemohon" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Jabatan</label>
					<div class="col-md-9">
						<input type="text" id="jabatan_pemohon" name="jabatan_pemohon" class="form-control input-xs required" style="width:100%" placeholder="Jabatan" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Alamat</label>
					<div class="col-md-9">
						<textarea id="alamat_pemohon" name="alamat_pemohon" placeholder="" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Telp</label>
					<div class="col-md-9">
						<input type="text" id="telp_pemohon" name="telp_pemohon" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">HP</label>
					<div class="col-md-9">
						<input type="text" id="hp_pemohon" name="hp_pemohon" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Fax</label>
					<div class="col-md-9">
						<input type="text" id="fax_pemohon" name="fax_pemohon" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Email</label>
					<div class="col-md-9">
						<input type="email" id="email_pemohon" name="email_pemohon" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<h5 class="heading"> Penanda tangan</h5>
				<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Nama</label>
					<div class="col-md-9">
						<input type="text" id="nama_tt" name="nama_tt" class="form-control input-xs required" style="width:100%" placeholder="Nama" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Jabatan</label>
					<div class="col-md-9">
						<input type="text" id="jabatan_tt" name="jabatan_tt" class="form-control input-xs required" style="width:100%" placeholder="Jabatan" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Alamat</label>
					<div class="col-md-9">
						<textarea id="alamat_tt" name="alamat_tt" placeholder="" class="required form-control"></textarea>
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Telp</label>
					<div class="col-md-9">
						<input type="text" id="telp_tt" name="telp_tt" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">HP</label>
					<div class="col-md-9">
						<input type="text" id="hp_tt" name="hp_tt" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Fax</label>
					<div class="col-md-9">
						<input type="text" id="fax_tt" name="fax_tt" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
				<!--<div class="form-group">
					<label for="category" class="control-label no-padding-right col-md-3">Email</label>
					<div class="col-md-9">
						<input type="email" id="email_tt" name="email_tt" class="form-control input-xs required" style="width:100%" placeholder="" value="" />
						<span class="help-block"></span>
						<div class="formSep"></div>
					</div>
				</div><!-- /control-group category-->
			<!--</div>
        </div>
        <div class="formSep"></div>
        <div class="row">
			<div class="col-md-12">
				<div class="form-actions col-md-12">
					<button class="btn btn-primary save" type="submit"><i class="icon-book icon-white"></i> Save </button>
					<button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
				</div>
			</div>
        </div>
    </form>-->	
    </div>
</div>

<? loadFunction("json");?>
<?php echo js_asset("jquery.tmpl.min.js");?>
<?php echo js_asset("jquery.tmplPlus.min.js");?>

<script id="tmp_file" type="text/x-jquery-tmpl">
	<tr id="file_${idx}" data-file_id="${idx}" class='file_row'>
	<td><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a><input type="hidden" name="file_id[]" value="${idx}"/></a><input type="hidden" name="tipe_doc[]" value="${tipe_doc}"/></td><td><input name='dasar_surat[]' value="${file_name}" type="hidden" style='width:300px' class="form-control input-sm"/><label style='height:auto;'>${file_name}</td><td><a href="" class='file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>


<script id="tmp_file_peta" type="text/x-jquery-tmpl">
	<tr class='file_row' id="file_peta_${idx}" data-file_id="${idx}">
	<td><input type="hidden" name="peta_file_id[]" value="${idx}"/><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<label style='height:auto;'>${file_name}</label></td><td><a href="" class='peta_file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>

<script id="tmp_file_upload" type="text/x-jquery-tmpl">
	<tr class='file_row' id="file_upload_${idx}" data-file_id="${idx}">
	<td><input type="hidden" name="upload_file_id[]" value="${idx}"/><a href="./${relative_path}" class='file_open' target='_blank'><i class="icon-search"></i> </a></td><td>
	<input type="hidden" name="id_jenis_doc[]" value="${id_jenis_doc}"/>
	<label style='height:auto;'>${file_name}</label></td><td><a href="" class='upload_file_remove red'><i class="icon-remove"></i> </a></td></tr>
</script>

<script id="tmp_image" type="text/x-jquery-tmpl">
	<li data-file_id="${idx}" id="img_upload_${idx}" class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><input type="hidden" name="image_file_id[]" value="${idx}"/><img src="${file_path_view}" class='img-responsive'/><a href="" style="margin-top:0px;z-index:10;position:absolute;right:0;top:0;" class='img_remove red'><i class="icon-remove"></i></a></li>
</script>

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
		var nm_propinsi = $("#id_propinsi option:selected").text();
		$("#id_kabupaten_holder").load("<?=$this->module;?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
			getgeoCode(nm_propinsi);
			$("#id_kabupaten").change(function(){
				var nm_address = nm_propinsi+" "+$("#id_kabupaten option:selected").text();
				getgeoCode(nm_address);
		   });
		});
   });
   
   $(document).on("click",".del-row-bw",function(e){
		e.preventDefault();
		$(this).closest("tr").remove();
    });
				
   $("#add_batas_wilayah").click(function(){
   		var rows = $('#table_batas_wilayah tr').size();
   		var batas = $("#batas_lain").val();
		var value = $("#batas_lain_val").val();
		if (rows<11) {
			if (batas && value) {
				$('#table_batas_wilayah tr:last').after('<tr><td>'+batas+'<a href="#" class="del-row-bw pull-right"><i class="fa fa-times-circle"></i></a></td><td><input type="hidden" name="batas[]" value="'+batas+'" class="form-control"><input type="text" name="batas_val[]" value="'+value+'" class="form-control"/></td></tr>');
				$("#batas_lain").val('');
				$("#batas_lain_val").val('');
				
			}
			else {
				alert("Tidak boleh kosong");
			}
		}
		else {
			alert("Max 10 batas");
		}
   });
   
   
   $("#add_ruang").click(function(){
   		var rows = $('#table_ruang tr').size();
   		var batas = $("#ruang").val();
		var value = $("#ruang_val").val();
		if (rows<11) {
			if (batas && value) {
				$('#table_ruang tbody').append('<tr><td><input type="text" name="ruang[]" value="'+batas+'" class="form-control"/></td><td width="5"><a href="#" class="del-row-bw pull-right"><i class="fa fa-times-circle"></i></a></td><td><input type="text" name="ruang_val[]" value="'+value+'" class="form-control"/></td></tr>');
				$("#ruang").val('');
				$("#ruang_val").val('');
			}
			else {
				alert("Tidak boleh kosong");
			}
		}
		else {
			alert("Max 10 batas");
		}
   });
   
   $("#add_potensi").click(function(){
   		var rows = $('#table_potensi tr').size();
   		var potensi= $("#potensi").val();
		var value = $("#potensi_val").val();
		if (rows<11) {
			if (potensi && value) {
				$('#table_potensi tbody').append('<tr><td><input type="text" name="potensi_lain[]" value="'+potensi+'" class="form-control"/></td><td><input type="text" name="potensi_lain_val[]" value="'+value+'" class="form-control"/></td><td width="5"><a href="#" class="del-row-bw pull-right"><i class="fa fa-times-circle"></i></a></td></tr>');
				$("#potensi").val('');
				$("#potensi_val").val('');
			}
			else {
				alert("Tidak boleh kosong");
			}
		}
		else {
			alert("Max 10 batas");
		}
   });
   
   $("#zoomscroll").on("click",function(){
   		$(this).is(":checked")?nav.enableZoomWheel():nav.disableZoomWheel();
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


<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script>
	//test plupload
	$(function(){
	var uploader = new plupload.Uploader({
		  browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		 
		uploader.init();
		
		uploader.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#"+file.id).hide().remove();
				var data=response.data_file;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_file_peta";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				$('#table_file_peta tbody').append($("#"+tmpFile).tmpl(data));
				//console.log(data);
			}
		}); 
		 
		uploader.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  document.getElementById('filelist').innerHTML += html;
		  uploader.start();
		});
		 
		uploader.bind('UploadProgress', function(up, file) {
		  document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		});
		 
		uploader.bind('Error', function(up, err) {
		  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		});
		 
		 $("#start-upload").click(function(){
		 	uploader.start();
		 });
		
		
		$("#filelist").on("click",".a_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var li=that.closest("li");
			var file_id=li.attr("id");
			uploader.removeFile(uploader.getFile(file_id));
			li.remove();
		});
	})
	
	$(function(){
		$(document).on("click","a.peta_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var id=that.closest("tr").data("file_id");
			$.post("<?=base_url()?><?=$this->module?>delete_peta_file/"+id,function(ret){
				if(ret=="ok"){
					that.closest("tr").slideUp().remove();
				}
			}); //end ajax
			
		});
	
	})
	
</script>


<script>
	//test plupload
	$(function(){
	var uploader2 = new plupload.Uploader({
		  browse_button: 'browse2', // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		
		uploader2.init();
		
		uploader2.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#f_"+file.id).hide().remove();
				var data=response.data_file;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_file_upload";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				$('#table_file_upload tbody').append($("#"+tmpFile).tmpl(data));
				//console.log(data);
			}
		}); 
		 
		uploader2.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="f_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  document.getElementById('filelist2').innerHTML += html;
		});
		 
		uploader2.bind('UploadProgress', function(up, file) {
		  document.getElementById("f_"+file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		  //$("#filelist2").find("#"+file.id).find("b").html("<span>" + file.percent + "%</span>");
		});
		 
		uploader2.bind('Error', function(up, err) {
		  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		});
		 
		
		$("#start-upload2").click(function(){
		 	uploader2.start();
		 });
		
		
		
		$("#filelist2").on("click",".a_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var li=that.closest("li");
			var file_id=li.attr("id").replace("f_","");
			uploader2.removeFile(uploader2.getFile(file_id));
			li.remove();
		});
	})
	
	
	$(function(){
		$(document).on("click","a.upload_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var id=that.closest("tr").data("file_id");
			$.post("<?=base_url()?><?=$this->module?>delete_upload_file/"+id,function(ret){
				if(ret=="ok"){
					that.closest("tr").slideUp().remove();
				}
			}); //end ajax
			
		});
	});
	
</script>


<script>
	$(function(){

		$(".browse_doc").each(function(){
			var id=$(this).data("id_doc");
			initUploader(id);
		});
		
		
		function initUploader(id){
		
		//var first_id=
		//alert(first_id);
		var uploader3 = new plupload.Uploader({
		  browse_button: "browse_doc_"+id, // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		
		uploader3.init();
		
		//$('#browse_doc_'+id).click(function()
		//{
			//alert("test");
			//alert($(this).data("id_doc"));
			//uploader3.settings.browse_button = $(this).attr('id'); //Assign the ID of the pickfiles button to pluploads browse_button
			//id= $(this).data("id_doc");
			//uploader3.refresh();
			
		//});
		
		
		uploader3.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#f_"+file.id).hide().remove();
				var data=response.data_file;
				data.id_jenis_doc=id;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_file_upload";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				//$('#table_file_'+id+' tbody').append($("#"+tmpFile).tmpl(data));
				
				$("tr#"+id).find("#table_file_"+id+" tbody").append($("#"+tmpFile).tmpl(data));
				console.log(data);
			}
		}); 
		 
		uploader3.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="f_' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  
		  	$("tr#"+id).find(".filelist").append(html);
		  
		  	//document.getElementById('filelist2').innerHTML += html;
			//alert(html);
				//$("#data_"+id).find(".filelist").append(html);
				//$("#data_"+id).html(html);
				uploader3.start();
			});
		 
			uploader3.bind('UploadProgress', function(up, file) {
			
		  		/*document.getElementById("f_"+file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";*/
				$("#f_"+file.id).find("b").html("<span>" + file.percent + "%</span>");
			});
		 
			uploader3.bind('Error', function(up, err) {
		  		document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
			});
		 
			 /*
			document.getElementById('start-upload2').onclick = function() {
			  uploader3.start();
			};
			*/
			$("#browse_doc_upload_"+id).click(function(e){
				e.preventDefault();
				uploader3.start();
			});
		
		}
		
	})
</script>



<script>
	//test plupload
	$(function(){
	var uploader_image = new plupload.Uploader({
		  browse_button: 'browse_pic', // this can be an id of a DOM element or the DOM element itself
		  url: '<?=base_url()?>upload/all/',
		  flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf',
		  file_data_name:'userfile'
		});
		 
		uploader_image.init();
		
		uploader_image.bind("FileUploaded",function(up,file,info){
			var response=JSON.parse(info.response);
			//console.log(response);
			if(response.status=='ok'){
				$("#"+file.id).hide().remove();
				var data=response.data_file;
				console.log(data);
				//data["data_str"]=JSON.stringify(data);
				var tmpFile="tmp_image";
				//$("#"+tmpFile).tmpl(data).appendTo('#table_file_peta tbody');
				//$('#table_file_peta tbody').append($("#"+tmpFile).tmpl(data));
				console.log(data);
				$("#ul_gallery").append($("#"+tmpFile).tmpl(data));
			}
		}); 
		 
		uploader_image.bind('FilesAdded', function(up, files) {
		  //alert(JSON.stringify(up));
		  //alert(JSON.stringify(files));
		  
		  var html = '';
		  plupload.each(files, function(file) {
			html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b><a href="#" class="a_file_remove red"><i class="icon-remove"></i></a></li>';
		  });
		  document.getElementById('imagelist').innerHTML += html;
		  uploader_image.start();
		});
		 
		uploader_image.bind('UploadProgress', function(up, file) {
		  document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		});
		 
		uploader_image.bind('Error', function(up, err) {
		  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		});
		 
		 /*
		 $("#start-upload").click(function(){
		 	uploader.start();
		 });
		*/
		/*
		$("#filelist").on("click",".a_file_remove",function(e){
			e.preventDefault();
			var that=$(this);
			var li=that.closest("li");
			var file_id=li.attr("id");
			uploader.removeFile(uploader.getFile(file_id));
			li.remove();
		});
		*/
	})
	
	$(function(){
		
		$(document).on("click","a.img_remove",function(e){
			alert("test");
			e.preventDefault();
			var that=$(this);
			var id=that.closest("li").data("file_id");
			$.post("<?=base_url()?><?=$this->module?>delete_image/"+id,function(ret){
				if(ret=="ok"){
					that.closest("li").slideUp().remove();
				}
			}); //end ajax
			
		});
		
	
	})
	
</script>