<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<!--<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="assets/js/plugin/ckeditor4.4.2/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<!-- Place inside the <head> of your HTML -->
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
</style>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Tambah Data <small> Personel </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?php echo $this->module?>" id="refresh">Personel</a> <span class="divider"></span></li>
			<li class="active">Tambah Data</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

                        
<div style="padding:0px">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>" id="refresh">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar 
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input 
                    </a>
                </li>
                <li>
					<a href="<?php echo $this->module?>" id="addData">
						<span class="block text-center">
							<i class="icon-refresh"></i> 
						</span>	
						Refresh
					</a>
				</li>
            </ul>
    	<!--<form class="search_form col-md-3 pull-right" action="<?//=$this->module?>listview" method="get">
        	<?php //$this->load->view("widget/search_box_db"); ?>
        </form>-->
    </div>
</div>
<br>
<div class="row-fluid">
<ul class="nav nav-tabs" id="news-tab">
   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-plus"></i> Tambah Data</a></li>
</ul>
<!--tab content-->
<div class="tab-content">
  
<div id="tab-edit" class="tab-pane active">  
	
	<?php 
		if ($message) {
			echo '<div class="alert alert-warning alert-dismissible" >
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
              </div>';
		}
	?>
	<?php echo form_open("personel/personel/addAjax",'id="fdata"');?>
	<input type="hidden" name="idx" value="<?=$data['id'];?>" />
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  
			  <div class="row">
					<div class="col-md-7">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									
									<label>No Induk Pegawai</label>
									<?php echo form_input($nip,false,'class="form-control required"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									
									<label>Nama Lengkap</label>
									<?php echo form_input($nama,false,'class="form-control required"');?>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Jenis Kelamin :</label>
									<div style="padding-left:20px;" class="radio">
									  <label>
										<input type="radio" value="laki-laki" name="jenisKelamin" checked="checked" />
										Laki-laki
									  </label>
									</div>
									<div style="padding-left:20px;" class="radio">
									  <label>
										<input type="radio" value="perempuan" name="jenisKelamin" />
										perempuan
									  </label>
									</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Gelar Depan </label>
									<?php echo form_input($glrDepan,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Gelar Belakang </label>
									<?php echo form_input($glrBelakang,false,'class="form-control"');?>
									</div>
									</div>
								</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Tempat Lahir</label>
									<?php echo form_input($tempatLahir,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="hidden" id="tglLahir" name="tglLahir" value="<?php echo date("Y-m-d",strtotime($tanggal_lahir['value']));?>" />
									<input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tanggal_lahir['value']));?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>AGAMA</label>
									<select name="agama" class="form-control">
										<option value="Islam">Islam</option>
										<option value="Kristen">Kristen</option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Status Perkawinan</label>
									<select name="statusKawin" class="form-control">
										<option value="Belum Kawin">Belum Kawin</option>
										<option value="Kawin">Kawin</option>
									</select>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Golongan Darah</label>
									<select name="golDarah" class="form-control">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Rhesus</label>
									<?php echo form_input($reshus,false,'class="form-control"');?>
									 </div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control required" rows="3"></textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Provinsi</label>
									<select class="form-control" id="propinsi" name="propinsi" required>
										<option>--Pilih Propinsi--</option>
									<? 
									// pre($m_propinsi);
									foreach ($m_propinsi as $key => $value) {
										$selected="";
										// if($value['kode_prop']=="14"){
										// 	$selected="selected";
										// }
									?>
									<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['kode_prop']?>-<?=$value['nama']?></option>
									<? 
										}


									?>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Kabupaten</label>
									<select class="form-control" id="kabupaten" name="kabupaten">
									<? 
									// pre($m_propinsi);
									foreach ($m_kabupaten as $key => $value) {
										$selected="";
										// if($value['kode_prop']=="14"){
										// 	$selected="selected";
										// }
									?>
									<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['kode_kab']?>-<?=$value['nama']?></option>
									<? 
										}


									?>
									</select></div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Sektor</label>
									<select class="form-control" id="idSektor" name="sektor">
										
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
									<label>Tingkat Kompetensi</label>
									<select class="form-control" id="kompetensi" name="kompetensi">
									<? 
									// pre($m_propinsi);
									foreach ($m_kompetensi as $key => $value) {
										// $selected="";
										// if($value['kode_prop']=="14"){
										// 	$selected="selected";
										// }
									?>
									<option value="<?=$value['id']?>" ><?=$value['kompetensi']?></option>
									<? 
										}


									?>
									</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>TMT PEGAWAI</label>
									<?php echo form_input($tmtPegawai,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>STATUS</label>
									<select name="statusKerja" class="form-control">
										<option value="PNS">PNS</option>
										<option value="Non PNS">Non PNS</option>
									</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Pangkat Golongan</label>
									<select name="pangkat" class="form-control">
										<option value="1A">1A</option>
										<option value="1B">1B</option>
										<option value="1C">1C</option>
										<option value="1D">1D</option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>SK PAngkat</label>
									<?php echo form_input($skPangkat,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Pendidikan Terakahir</label>
									<?php echo form_input($pendidikan,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Pendidikan Pelatihan</label>
									<?php echo form_input($pelatihan,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Keterangan</label>
									<?php echo form_textarea($keterangan,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							
							
							
					</div>  
					

					<!-- span6 -->
					<div class="col-md-4">
						<div id="attachment_frame" class="form-group">
							<span class="help-block" style="display:inline">Lampiran Tanda Pengenal Personel(Max : 200Kb)</span>
							<div id="imgcontainer">
								<div id="preview" style="width:100%; height:180px;" class="img-thumbnail"><?php echo $image_canvas;?></div>
								<div id="btn-change" class="img-btn-change"><span><i class="icon-pencil"></i> &nbsp;Attachment</span></div>
							</div>
							<input id="image_name" type="hidden" name="image_name" />
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

	<div class="container" style="background-color:#F5F5F5;margin-top:20px;margin-bottom:20px;">
	
	<!--tab content-->
	  <br>
		<div class="form-actions">
			<button type="submit" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn">Batal</button>
		</div>
		<br />
	</div>
	<?php echo form_close();?>

</div>
<div id="tab-view" class="tab-pane">    
    <div class="row-fluid">
	    <div class="span9">
            <div class="row-fluid">
                <div class="span12">
                    <h1 id="title-view"></h1>
                    <p>
                    <blockquote id="news_clip-view">
                    
                    </blockquote>
                    </p>
                    <span id="canvas_view" style="float:left;margin:0;"><canvas width=0 height=0></canvas></span>
                    <p id="news_content-view">
                    
                    </p>
                </div>
            </div>
        </div> 
    </div>
    <br />
    <br />
</div>
</div>
<!-- en tab-content-->
</div>
</div>
<script>

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
		
		 $('.ajax-spinner-bars').css("display","block"); 
	    var postData = $(this).serializeArray();
	    var formURL = $(this).attr("action");
	    
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : formURL, // the url where we want to POST
            data        : postData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                $('#dataAjax').html(data.data); 
        		$('.ajax-spinner-bars').css("display","none"); 
        		$.notify({
                  message: "<i class='fa fa-check'></i> Data Berhasil Disimpan "
                },{
                    type: 'success'
                });
                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
	});    
    
});
	//callback handler for form submit
// $('#fdata').submit(function(event) {

//         $('.ajax-spinner-bars').css("display","block"); 
// 	    var postData = $(this).serializeArray();
// 	    var formURL = $(this).attr("action");
	    
//         $.ajax({
//             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
//             url         : formURL, // the url where we want to POST
//             data        : postData, // our data object
//             dataType    : 'json', // what type of data do we expect back from the server
//             encode          : true
//         })
//             // using the done promise callback
//             .done(function(data) {

//                 // log data to the console so we can see
//                 $('#dataAjax').html(data.data); 
//         		$('.ajax-spinner-bars').css("display","none"); 

//                 // here we will handle errors and validation messages
//             });

//         // stop the form from submitting the normal way and refreshing the page
//         event.preventDefault();
//     });
 
 $('#fdata').on('change','#propinsi',function(){

                   var parameter =$('#propinsi').val();
                   // alert(parameter);
                   // var valueparameter =$('#valueparameter').val();

                    $.post(basedomain+urlPageList+'get_lookup_kabupatenAjax/'+parameter , {actionfunction: 'showDataAjax'}, function(data){
                            
                            if (data.status==true) {
                               
                                    $('#kabupaten').html(data.data); 

                                 $('.ajax-spinner-bars').css("display","none"); 
                                
                            }else{
                                   $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

                return false;
                });

  $('#fdata').on('change','#kabupaten',function(){

                   var propinsi =$('#propinsi').val();
                   var kabupaten =$('#kabupaten').val();
                   // alert(propinsi);
                   // var valueparameter =$('#valueparameter').val();

                    $.post(basedomain+urlPageList+'get_lookup_sektorAjax/'+propinsi+'/'+kabupaten , {actionfunction: 'showDataAjax'}, function(data){
                            
                            if (data.status==true) {
                               
                                    $('#idSektor').html(data.data); 

                                 $('.ajax-spinner-bars').css("display","none"); 
                                
                            }else{
                                   $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

                return false;
                });
   
</script>

