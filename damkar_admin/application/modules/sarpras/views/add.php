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
                    <h1>User<small> Add JOnedADD</small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>register/register"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Content</a> <span class="divider"></span></li>
			<li><a href="<?=$this->folder?>"><?=$this->module_title?></a> <span class="divider"></span></li>
            <li class="active">Add</li>
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
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
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
   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-plus"></i> Add</a></li>
</ul>
<!--tab content-->
<div class="tab-content">
  
<div id="tab-edit" class="tab-pane active">  
	<?php 
		if ($message) {
			echo '<div class="row"><div class="col-md-12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div></div>';
		}
	?>
	<?php echo form_open("register/add",'id="fdata"');?>
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
									<?php echo form_input($first_name,false,'class="form-control required"');?>
									</div>
								</div>
							</div>
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
									<label>Jenis Kelamin :</label>
									<div style="padding-left:20px;" class="radio">
									  <label>
										<input type="radio" value="laki-laki" name="jenis_kelamin" checked="checked" />
										Laki-laki
									  </label>
									</div>
									<div style="padding-left:20px;" class="radio">
									  <label>
										<input type="radio" value="perempuan" name="jenis_kelamin" />
										perempuan
									  </label>
									</div>
									</div>
								</div>
							</div><div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Gelar Depan </label>
									<?php echo form_input($tempat_lahir,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Gelar Belakang</label>
									<input type="hidden" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo date("Y-m-d",strtotime($tanggal_lahir['value']));?>" />
									<input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tanggal_lahir['value']));?>" />
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
									<label>AGAMA</label>
									<?php echo form_input($phone,false,'class="form-control required"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Status Perkawinan</label>
									<?php echo form_input($handphone,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Golongan Darah</label>
									<? array_push($m_pekerjaan,"Lainnya...");?>
									<?=form_dropdown("pekerjaan_select",$m_pekerjaan,$pekerjaan_select['value'],"id='pekerjaan' class='form-control'");?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>Rhesus</label>
									<input type="text" id="pekerjaan_text" name="pekerjaan_text" class='form-control' disabled="disabled" value="<?=$pekerjaan['value']?>" />
									 <input type="hidden" id="pekerjaan_text2" name="pekerjaan" class='form-control' value="<?=$pekerjaan['value']?>"  />
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
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									<label>Kabupaten</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									<label>Sektor</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>TMT PEGAWAI</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>STATUS</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Pangkat Golongan</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									<label>SK PAngkat</label>
									<?php echo form_input($kode_pos,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									<label>Pendidikan Terakahir</label>
									<?php echo form_input($kabupaten_kota,false,'class="form-control"');?>
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
						</div>--><!-- 
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
								<label>Tanda Pengenal</label>
								<?=form_dropdown("tanda_pengenal",$m_tanda_pengenal,$tanda_pengenal['value'],"id='tanda_pengenal' class='form-control required'");?>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
								<label>Nomor</label>
								<?php echo form_input($username,false,'class="form-control required"');?>
								</div>
							</div>
						</div> -->
						
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

	<div class="container" style="margin-bottom:20px;">
	
	<!--tab content-->
	  <br>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Submit</button>
			<button type="reset" class="btn">Cancel</button>
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
	// $(function(){
	// 	$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
	// 	$(".comments_add").click(function(e){
	// 		e.preventDefault();
	// 		$("#add_comments").load("<?=$this->module?>comments_add/<?=$data["id"]?>/<?=$data["category"];?>");
	// 	});
		
	// 	$("#com_add_save").live("click",function(e){
	// 		e.preventDefault();
	// 		var url="<?=$this->module?>comments_add_save/";
	// 		var data=$("#frm_comment").serialize();
	// 		$.post(url,data,function(ret){
	// 			if(ret=="ok"){
	// 				$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
	// 				Alert("Message","OK");
	// 			}else{
	// 				Alert("Message","not OK");
	// 			}
	// 		})
	// 	});
		
	// 	$(".comments_reply").live("click",function(e){
	// 		e.preventDefault();
	// 		var url=$(this).attr("rel");
	// 		$("#add_comments").load(url);
	// 	});
		
	// 	$("#com_reply_save").live("click",function(e){
	// 		e.preventDefault();
	// 		var url="<?=$this->module?>comments_reply_save/";
	// 		var data=$("#frm_comment_reply").serialize();
	// 		$.post(url,data,function(ret){
	// 			if(ret=="ok"){
	// 				$("#comment_list").load("<?=$this->module?>comments_list/<?=$data["id"]?>/<?=$data["category"];?>");
	// 				Alert("Message","OK");
	// 			}else{
	// 				Alert("Message","not OK");
	// 			}
	// 		})
	// 	});
		
	// });
</script>
