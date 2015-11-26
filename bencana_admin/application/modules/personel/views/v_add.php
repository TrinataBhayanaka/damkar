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

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?=$this->module_title?>
    <small>Input Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-globe"></i> Home</a></li>
    <li><a href="wilayah/wilayah"> <?=$this->module_title?></a></li>
    <li class="active">Input Data Personel</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-xs-12">

			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="daftar">
            	<i class="fa fa-bars"></i> Daftar Wilayah
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>add_personel" id="addData">
				<i class="fa fa-plus"></i> Input Wilayah
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
				<i class="fa fa-refresh"></i> Refresh
			</a>

			<?php 
				if ($message) {
					echo '<div class="alert alert-warning alert-dismissible" >
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
		              </div>';
				}
			?>

			<?php echo form_open("personel/add_personel",'id="fdata"');?>

			<div class="box box-default">
		   		<div class="box-header with-border">
		          <h3 class="box-title">Tambah Data</h3>
		          <div class="box-tools pull-right">
		            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
		          </div>
		        </div><!-- /.box-header -->
		        <div class="box-body">

		        	<div class="row">
						<div class="col-md-12">
						  
						  <div class="row">
								<div class="col-md-7">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
												
												<label>No Induk Pegawai</label>
												<?php echo form_input($nip,false,'class="form-control  IsInteger"');?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
												
												<label>Nama Lengkap</label>
												<?php echo form_input($nama,false,'class="form-control"');?>
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
												<input type="hidden" id="tglLahir" name="tglLahir" value="<?php echo date("Y-m-d",$tglLahir['value']);?>" />
												<input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="" />
												
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label>AGAMA</label>
												<?php echo form_input($agama,false,'class="form-control required"');?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
												<label>Status Perkawinan</label>
												<?php echo form_input($statusKawin,false,'class="form-control"');?>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label>Golongan Darah</label>
												<?php echo form_input($golDarah,false,'class="form-control"');?>
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
											<div class="col-md-4">
												<div class="form-group">
												<label>Provinsi</label>
												<?//=form_dropdown("propinsi",$m_propinsi,$propinsi['value'],"id='propinsi' class='form-control required'");?>
												<select class="form-control" id="propinsi" name="propinsi">
													<?php 
													// pre($m_propinsi);
													foreach ($m_propinsi as $key => $value) {
														$selected="";
													?>
													<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
													<?php 
														}

													?>
												</select>	
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												<label>Kabupaten</label>
												<?php// echo form_input($kabupaten,false,'class="form-control"');?>
												<select class="form-control" id="kabupaten" name="kabupaten">
													<?php 
													// pre($m_propinsi);
													foreach ($m_kabupaten as $key => $value) {
														$selected="";
													?>
													<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
													<?php 
														}

													?>
												</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												<label>Sektor</label>
												<?php echo form_input($sektor,false,'class="form-control"');?>
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
												<?php echo form_input($statusKerja,false,'class="form-control"');?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label>Pangkat Golongan</label>
												<?php echo form_input($pangkat,false,'class="form-control"');?>
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
												<?php echo form_input($keterangan,false,'class="form-control"');?>
												</div>
											</div>
										</div>
										
										
										
								</div> <!-- span6 -->
								<div class="col-md-5">
									
									<div class="row">
											<div class="col-md-12">
												<div id="attachment_frame" class="form-group">
												<span class="help-block" style="display:inline">Lampiran Tanda Pengenal (Max : 200Kb)</span>
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
							
						</div>

		        </div>
		        <div class="box-footer">
	             	<div class="form-actions">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="reset" class="btn">Batal</button>
					</div>
	             </div>
		    </div>

			<?php echo form_close();?>

		</div>
	</div>

</section>


<script>
//js here
//Uploader
$(function(){

	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#tglLahir").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$('.dp1').datepicker('hide');
	}).data('datepicker');
	
	$('.dp1').on("keyup",function(){
		setValDate(tgl_lahir,"#tglLahir");
	});
	
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

	$('.IsInteger').keypress(function (e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31
    && (charCode < 48 || charCode > 57))
        return false;
});
    

	$('#fdata').on('change','#propinsi',function(){
		var basedomain = '<?=base_url()?>';
 		var parameter =$('#propinsi').val();
		var urlPageList = 'personel/';
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

});
</script>

