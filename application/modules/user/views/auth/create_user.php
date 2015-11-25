<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="assets/js/plugin/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/jquery.plupload.queue.js"></script>
<link href="assets/bootstrap/css/datepicker.css" rel="stylesheet">	
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
<!-- Carousel
================================================== -->
<section class="page-header">
  <div class="container">

    <h1>Pendaftaran</h1>
    <span>Pendaftaran user baru untuk login portal kebencanaan</span>

    <!-- breadcrumbs -->
    <ol class="breadcrumb">
          <li><a href="<?=base_url()?>">Beranda</a></li>
          <li class="active">Pendftaran</li>
    </ol><!-- /breadcrumbs -->

  </div>
</section>

<section>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php echo form_open("user/register",'id="fdata"');?>
                <input type="hidden" name="idx" value="<?=$data['id'];?>" />

                <div class="row">
                    <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <?php echo lang('create_user_fname_label', 'first_name');?>
                                    <?php echo form_input($first_name,false,'class="form-control required"');?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <?php echo lang('create_user_gender_label', 'gender');?>
                                        <label class="radio">
                                            <input type="radio" name="radio-btn" value="laki-laki" name="jenis_kelamin" checked="checked">
                                            <i></i> Laki-laki
                                        </label>

                                         <label class="radio">
                                            <input type="radio" name="radio-btn" value="perempuan" name="jenis_kelamin">
                                            <i></i> perempuan
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php echo lang('create_user_place_of_birth_label', 'tempat_lahir');?>
                                    <?php echo form_input($tempat_lahir,false,'class="form-control"');?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php echo lang('create_user_date_of_birth_label', 'tanggal_lahir');?>
                                    <input type="hidden" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo date("Y-m-d",strtotime($tanggal_lahir['value']));?>" />
                                    <input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tanggal_lahir['value']));?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php echo lang('create_user_phone_label', 'phone');?>
                                    <?php echo form_input($phone,false,'class="form-control required"');?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php echo lang('create_user_handphone_label', 'handphone');?>
                                    <?php echo form_input($handphone,false,'class="form-control"');?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Fax</label>
                                    <?php echo form_input($fax,false,'class="form-control"');?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php echo lang('create_user_work_label', 'Pekerjaan');?>
                                    <? array_push($m_pekerjaan,"Lainnya...");?>
                                    <?=form_dropdown("pekerjaan_select",$m_pekerjaan,$pekerjaan_select['value'],"id='pekerjaan' class='form-control'");?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="text" id="pekerjaan_text" name="pekerjaan_text" class='form-control' disabled="disabled" value="<?=$pekerjaan['value']?>" />
                                     <input type="hidden" id="pekerjaan_text2" name="pekerjaan" class='form-control' value="<?=$pekerjaan['value']?>"  />
                                     </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <?php echo lang('create_user_address_label', 'alamat');?>
                                    <textarea name="alamat" class="form-control required" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <?php echo lang('create_user_postcode_label', 'postcode');?>
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
                                <?=form_dropdown("tanda_pengenal",$m_tanda_pengenal,$tanda_pengenal['value'],"id='tanda_pengenal' class='form-control required'");?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <label>Nomor</label>
                                <?php echo form_input($username,false,'class="form-control required"');?>
                                </div>
                            </div>
                        </div>
                        
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
                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <?php echo lang('create_user_email_label', 'email');?>
                                <?php echo form_input($email,false,'class="form-control required"');?>
                                </div>
                            </div>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label><?=$cap_img;?></label>
                                <input class="form-control" type="text" name="captcha" placeholder="Captcha"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php 
                        if ($message) {
                            echo '<div class="row"><div class="col-md-12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div></div>';
                        }
                    ?>
                    <!--tab content-->
                      
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </div>
                        <br />
                        <br />
                </div>
                    <?php echo form_close();?>

            </div>
        </div>

    </div>
</section>



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
