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
    <li><a href="admin/dashboard"><i class="fa fa-desktop"></i> Home</a></li>
    <li><a href="agenda"> <?=$this->module_title?></a></li>
    <li class="active">Input Agenda</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">

            <a class="btn btn-app bg-purple" href="<?php echo $this->module?>">
                <i class="fa fa-bars"></i> Daftar Agenda
            </a>
            <a class="btn btn-app bg-purple" href="<?php echo $this->module?>add" id="addData">
                <i class="fa fa-plus"></i> Input Agenda
            </a>
            <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
                <i class="fa fa-refresh"></i> Refresh
            </a>


            <form id="fdata" action="<?=$module;?>edit" method="post" enctype="multipart/form-data">
                

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
                            <div class="col-md-8">
                                  <div class="row">
                                    <div class="col-md-12">
                                        <label>Judul Album</label>
                                        <input type="text" id="title" name="title" class="form-control input-xs required" placeholder="title" value="<?=$data['title'];?>" />
                                         <input type="hidden" name="idx" value="<?=$data['idx'];?>" />
                                    </div>
                                   </div>
									
                                  <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Tanggal</label>
                                            <input type="hidden" id="tgl" name="tgl" value="<?php echo date("Y-m-d",strtotime($data['created']));?>" />
                                            <input type="text" id="tgl_" name="tgl_" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($data['created']));?>" />
									</div>
                                </div>
                                  <div class="row">
                                    <div class="col-md-7 form-group">
								  <? $checked=($data['status'])?" checked":""; ?>
                                            <label>
                                                <input type="checkbox" value="1" name="status"<?=$checked;?> />
                                                Publish
                                            </label>
									</div>
								</div>
                               
                            </div>
							<?php
									$img = $data['image'] ;
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
                                <!--<h3 class="heading">Options</h3>-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="attachment_frame" class="form-group">
												<span class="help-block" style="display:inline">Cover Album</span>
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

            </form>

        </div>
    </div>

</section>
<script>  


	
$(function(){

	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#tgl").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
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
		} 
		else {
			x = true;
			// alert('Lampiran tanda pengenal wajib ada.');
		}
			// alert('You must at least upload one file.');
	
		if (!x) return false;
	});   
});
</script>
