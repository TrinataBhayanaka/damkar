<?//=$img;exit;?>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<!--<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="assets/js/plugin/ckeditor4.4.2/ckeditor.js"></script>
<script type="text/javascript" src="assets/js/plugin/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<!-- Place inside the <head> of your HTML -->
<style>
#imgcontainer .img-btn-change {
	position:absolute;
	width:100%;
	height:180px;
	line-height:180px;
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
<?php $id=$this->encrypt_status==TRUE?encrypt($idd):$idd;?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>User<small> Edit </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Content</a> <span class="divider"></span></li>
			<li><a href="<?=$this->folder?>"><?=$this->module_title?></a> <span class="divider"></span></li>
            <li class="active">Edit</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
             
<div style="padding:0px">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add <?=$this->module_title?>
                    </a>
                </li>
				<li class="active">
                    <a href="javascript:void(0)">
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_title?>            
					</a>
                </li>
				<li class="pull-right">
                    <a class="red" onclick="return confirm('Anda yakin akan menghapus data ini?');" href="register/register/delete/<?=$id;?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete User                    
					</a>
                </li>
            </ul>
    	<!--<form class="search_form col-md-3 pull-right" action="<?=$this->module?>listview" method="get">
        	<?php //$this->load->view("widget/search_box_db"); ?>
        </form>-->
    </div>
</div>
<?php echo message_box();?>
<div class="row-fluid">
	<ul class="nav nav-tabs" id="news-tab">
	   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-edit"></i> Edit</a></li>
	</ul>
	<!--tab content-->
<div class="tab-content">
	<div id="tab-edit" class="tab-pane active">    
		<?php echo form_open("register/edit/$id",'id="fdata"');?>
		<input type="hidden" name="id" value="<?=$idd;?>" />
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				  <?php
					//pre($propinsi['value']);				  
					//pre($m_propinsi);				  
					if ($message) {
						echo '<div class="row"><div class="col-md-12 alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div></div>';
					}
				  ?>
					  <div class="row">
							<div class="col-md-7">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Nama Lengkap</label>
											<?php echo form_input($first_name,false,'class="form-control required"');?>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Jenis Kelamin</label>
											<div style="padding-left:20px;" class="radio">
											  <label>
												<input type="radio" value="laki-laki" name="jenis_kelamin" <?php if ($jk == 'laki-laki') echo 'checked';?> />
												Laki-laki
											  </label>
											</div>
											<div style="padding-left:20px;" class="radio">
											  <label>
												<input type="radio" value="perempuan" name="jenis_kelamin" <?php if ($jk == 'perempuan') echo 'checked';?> />
												perempuan
											  </label>
											</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label>Tempat Lahir</label>
											<?php echo form_input($tempat_lahir,false,'class="form-control"');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											<label>Tanggal Lahir</label>
											<input type="hidden" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo date("Y-m-d",strtotime($tanggal_lahir['value']));?>" />
											<input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tanggal_lahir['value']));?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label>Telephone</label>
											<?php echo form_input($phone,false,'class="form-control required"');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											<label>Handphone</label>
											<?php echo form_input($handphone,false,'class="form-control"');?>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											<label>Pekerjaan</label>
											<? array_push($m_pekerjaan,"Lainnya...");?>
											<?
												
												if (in_array($pekerjaan_select['value'],$m_pekerjaan)) {
													$selected_pekerjaan = $pekerjaan_select['value'];
													$display_pekerjaan = "";
													$disabled='disabled="disabled"';
												}
												else {
													$selected_pekerjaan = 0;
													$display_pekerjaan = $pekerjaan_select['value'];
													$disabled="";
												}
											?>
											<?=form_dropdown("pekerjaan_select",$m_pekerjaan,$selected_pekerjaan,"id='pekerjaan' class='form-control'");?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											<label>&nbsp;</label>
											<input type="text" id="pekerjaan_text" name="pekerjaan_text" class='form-control' <?=$disabled?> value="<?=$display_pekerjaan?>" />
											 <input type="hidden" id="pekerjaan_text2" name="pekerjaan" class='form-control' value="<?=$pekerjaan['value']?>"  />
											 </div>
										</div>
									</div>
								
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Alamat</label>
											<textarea name="alamat" class="form-control required" rows="3"><?=$alm;?></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Kode Pos</label>
											<?php echo form_input($kode_pos,false,'class="form-control"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Kab/Kota</label>
											<?php echo form_input($kabupaten_kota,false,'class="form-control"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
											<label>Propinsi</label>
											<?=form_dropdown("propinsi",$m_propinsi,$propinsi['value'],"id='propinsi' class='form-control required'");?>
											</div>
										</div>
									</div>
									
									
							</div> <!-- span6 -->
							<div class="col-md-5">
								<!--<div class="row">
									<div class="col-md-12">
										<label><?php echo lang('create_user_name_label', 'username');?></label>
										<?php echo form_input($username,false,'class="form-control required"');?>
									</div>
								</div>-->
								
								<!--<div class="row">
									<div class="col-md-12">
										<label><?php echo lang('create_user_lname_label', 'last_name');?></label>
										<?php echo form_input($last_name,false,'class="form-control required"');?>
									</div>
								</div>-->
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										<label>Tanda Pengenal</label>
										<?=form_dropdown("tanda_pengenal",$m_tanda_pengenal,$tanda_pengenal['value'],"id='tanda_pengenal' class='form-control '");?>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
										<label>Nomor</label>
										<?php echo form_input($username,false,'class="form-control required"');?>
										</div>
									</div>
								</div>
								<?php			
									pre($img);
									// exit;
									if ($img) {
										//$image_image = '<img src="assets/image/news/'.$data['image'].'" style="float:left; margin:2px 10px 10px 2px" />';
										$image_image = '<span id="canvas_view" style="float:left;margin:2px 10px 10px 2px; " class="img-polaroid"><img width="200" height="200" src="assets/image/members/901024210333.jpg" /></span>';
										$image_canvas = '<canvas id="myCanvas" style="height:170px; background-image:url(assets/image/members/901024210333.jpg);background-size: 100%;"></canvas>';
										$input_image = '<input id="image_name_old" type="hidden" name="image_name_old" value="901024210333.jpg" />';
										$image_data = "block";
									}
									else {
										$image_image = '<span id="canvas_view" style="float:left;margin:0; " class="img-polaroid"><canvas width=0 height=0></canvas></span>';			
										$image_data = "none";
									}
								?>
								
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
								
								<br />
								<div class="alert alert-warning alert-dismissible" role="alert">
								  <strong>Warning!</strong> isikan field dibawah untuk mengganti Password.
								</div>
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
			<br />
			<div class="container" style="margin-bottom:20px;">
			<!--tab content-->
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn">Cancel</button>
				</div>
				<br />
			</div>
			<?php echo form_close();?>
	</div>
</div>
<!-- en tab-content-->
</div>
</div>
<script>

</script>
<script>
var pekerjaan_change = <?=$pekerjaan_select['value']?'true':'false'?>;
$(document).ready(function () {
	/*$('#dp1').datepicker().on('changeDate', function(ev){
		$('#dp1').datepicker('hide');
	});*/
	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#tanggal_lahir").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$('.dp1').datepicker('hide');
	}).data('datepicker');
	
	$('.dp1').on("keyup",function(){
		setValDate(tgl_lahir,"#tanggal_lahir");
	});
	
	function setValDate(dp,target,sender) {
		if (sender) {
			if ($(sender).val().length<8) {
				$(target).val("");
				return;
			}
		}
		var newDate = new Date(dp.date);
		$(target).val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
	};
	$(".required").each(function(i){
		$(this).closest("div").find(".asterix").remove();
		$(this).closest("div").find("label").append("<span class='asterix'>&nbsp;*</span>");
   });
   
   /*if (pekerjaan_change) {
   		$("#pekerjaan_text2").val($("#pekerjaan option:selected").text());
		$("#pekerjaan_text").val("");	
	}
	else {
		$("#pekerjaan_text").prop("disabled",$("#pekerjaan option:selected").val()!='0'?true:false);	
	}*/
   $("#pekerjaan").change(function(){
		$("#pekerjaan_text").prop("disabled",$(this).val()!='0'?true:false).val("").focus();
		$("#pekerjaan_text2").val($("#pekerjaan option:selected").text());
	});
	$("#pekerjaan_text").blur(function(){
		$("#pekerjaan_text2").val($(this).val());
	});

});

//Uploader
$(function(){
	var w_image = $("#attachment_frame").width()-10;
	$("#myCanvas").width(w_image)
	var ufile=false;
	var dfile=<?=($user->image)?"true":"false";?>;
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
