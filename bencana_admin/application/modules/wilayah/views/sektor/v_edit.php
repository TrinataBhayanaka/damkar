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
    <small>Edit Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-globe"></i> Home</a></li>
    <li><a href="wilayah/wilayah"> <?=$this->module_title?></a></li>
    <li class="active">Edit Data Sektor</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-xs-12">

			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="daftar">
				<i class="fa fa-bars"></i> Daftar Wilayah
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>add_sektor" id="addData">
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
			<?php echo form_open("wilayah/sektor/edit_sektor".$id,'id="fdata"');?>
			<input type="hidden" name="id" value="<?=$idd;?>" />
			<div class="box box-default">
				<div class="box-header with-border">
	              <h3 class="box-title">Edit Data</h3>
	              <div class="box-tools pull-right">
	                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	              </div>
	            </div><!-- /.box-header -->
	            <div class="box-body">

	            <div class="row">
					<div class="col-md-12">
					  
					  <div class="row">
							<div class="col-md-8">
									<div class="row">
										
										<div class="col-md-6">
											<div class="form-group">
											
											<label>Nama Sektor </label>
											<?php echo form_input($namaSektor,false,'class="form-control"');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											
											<label>SKPD </label>
											<?php echo form_input($skpd,false,'class="form-control required"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											
											<label>Provinsi </label>
											<?//=form_dropdown("propinsi",$m_propinsi,$propinsi['value'],"id='propinsi' class='form-control required'");?>
											<select class="form-control" id="propinsi" name="propinsi">
											<?php 
											// pre($m_propinsi);
											foreach ($m_propinsi as $key => $value) {
												$selected="";
												if($value['kode_prop']==$propinsi['value']){
													$selected="selected = selected";
												}
											?>
											<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
											<?php 
												}
											?>
											</select>	
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											
											<label>Kabupaten</label>
											<?php// echo form_input($kabupaten,false,'class="form-control"');?>
											<select class="form-control" id="kabupaten" name="kabupaten">
												<? 
												foreach ($m_kabupaten as $key => $value) {
													$selected="";
													if($value['kode_kab'] == $kabupaten['value']){
														$selected="selected = selected";
													}
												?>
												<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
												<? 
													}


												?>
											</select>
											</div>
										</div>
									</div>
									
							</div> <!-- span6 -->
							<?php
								// pre($img);
								if ($img) {
									//$image_image = '<img src="assets/image/news/'.$data['image'].'" style="float:left; margin:2px 10px 10px 2px" />';
									$image_image = '<span id="canvas_view" style="float:left;margin:2px 10px 10px 2px; " class="img-polaroid"><img width="200" height="200" src="assets/image/members/'.$img.'" /></span>';
									$image_canvas = '<canvas id="myCanvas" style="height:170px; background-image:url(assets/image/members/'.$img.');background-size: 100%;"></canvas>';
									$input_image = '<input id="image_name_old" type="hidden" name="image_name_old" value="'.$img.'" />';
									$image_data = "block";
								}
								else {
									$image_image = '<span id="canvas_view" style="float:left;margin:0; " class="img-polaroid"><canvas width=0 height=0></canvas></span>';			
									$image_data = "none";
								}
							?>
										
							<div class="col-md-4">
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
	            <div class="box-footer">
	             	<div class="form-actions">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="reset" class="btn">Batal</button>
					</div>
	             </div>
	        </div>

			<?php echo form_close();?>
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
	</div>

</section>

<script>
//js here
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
			x = true;
			//alert('Lampiran tanda pengenal wajib ada.');
		}
		//	alert('You must at least upload one file.');
	
		if (!x) return false;
	});    
	
	$('#fdata').on('change','#propinsi',function(){
		var basedomain = '<?=base_url()?>';
 		var parameter =$('#propinsi').val();
		var urlPageList = 'wilayah/wilayah/';
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
