<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<!--<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="assets/js/plugin/ckeditor4.4.2/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<!-- Place inside the <head> of your HTML -->

<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Articles<small> Add </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
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
<div class="row-fluid">
<ul class="nav nav-tabs" id="news-tab">
   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-plus"></i> Add</a></li>
   <!--<li><a href="#tab-view" class="a_view"><i class="icon-eye-open"></i> View</a></li>-->
</ul>
<!--tab content-->
<div class="tab-content">
    
<div id="tab-edit" class="tab-pane active">    
  <form id="fdata" action="<?php echo $this->module?>add" method="post" enctype="multipart/form-data" >
    <input type="hidden" name="author" value="<?=$user_name;?>" />
    <input type="hidden" name="category" value="1" />
    <div class="row">
	    <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <label>Author</label>
                    <input type="text" id="title" name="author2" class="form-control" placeholder="title" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Title</label>
                    <input type="text" id="title" name="title" class="form-control" class="span12 required" value="" />
                </div>
            </div>
            <div class="formSep">
                <div class="row">
                    <div class="col-md-12">
                        <label>Clip </label>
                        <textarea name="clip" id="clip" cols="10" rows="3" class="form-control required"><?=$data['news_clip'];?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Content</label>
                    <textarea name="content" id="news_content" cols="10" rows="3" class="ckeditor span11 required"><?=$data['content'];?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Reference/Source</label>
                    <input type="text" id="title" name="ref" class="form-control" value="" />
                </div>
            </div>
        </div>

	    <div class="col-md-3">
        	<!--<h3 class="heading">Options</h3>-->
        	<div class="formSep">
                <div class="row">
                    <div class="span12">
                    	<div id="imgcontainer">
                        	<label>Image <span class="help-block" style="display:inline">(Max filesize: 500kb)</span></label>
                            <!--<div id="runtime">No runtime found.</div>-->
                            <div id="preview" style="border:1px solid grey; width:200px; height:200px;" class="img-polaroid"></div>
                            [ <a href id="pickfiles">Browse</a> ]
							<div id="image_data" style="display:<?=$image_data;?>">
                                <label>Image Title</label>
                                <input class="form-control" id="image_title" type="text" name="news_image_title" value="<?=$data['image_title'];?>" style="width:200px;" />
                                <label>Source</label>
                                <input  class="form-control"id="image_src" type="text" name="news_image_src" value="<?=$data['image_src'];?>" style="width:200px;" />
                            </div>
                        </div>
                        <input id="image_name" type="hidden" name="image_name" />
                	</div>
                </div>
            </div><!-- form separator -->
            <div class="formSep">
                <div class="row">
                     <div class="span12">
                        <? $checked=($data['status'])?" checked":""; ?>
                        <label class="">
                            <input type="checkbox" value="1" name="status"<?=$checked;?> />
                            Publish
                        </label>
                    </div>
                </div>
            </div> <!-- form separator -->
        </div> 
    </div>
    <br>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn">Cancel</button>
    </div>
    <br />
    <br />
  </form>
</div>



<div id="tab-view" class="tab-pane">    
    <div class="row-fluid">
	    <div class="span9">
            <div class="row-fluid">
                <div class="span12">
                    <h1 id="title-view"></h1>
                    <p>
                    <blockquote id="clip-view">
                    
                    </blockquote>
                    </p>
                    <span id="canvas_view" style="float:left;margin:0;"><canvas width=0 height=0></canvas></span>
                    <p id="content-view">
                    
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
$(document).ready(function () {
	var act_link="<?=$this->module?>";		
	$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
	$("#fdata").validate({ignore:[]});
	$(".f_req").remove();
	$(".required").each(function(i){
		$(this).parent().find("label:first-child").append(" <span class='f_req'>*</span>");
	});
	
	$("#button_submit").click(function(e){
		$("#fdata").submit();
		e.preventDefault();
	});
	var config = {
		toolbar:
		  [
			 ['Undo', 'Redo', '-', 'SelectAll'],
			 ['Styles','Format', 'Bold', 'Italic', 'Underline','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			 ['Image','Table'],
			 ['Link', 'Unlink'], 
			 ['Source'],
		  ]
	};
	//$('textarea#content' ).ckeditor(config);
	$('#news-tab a:first').tab('show');
	$('#news-tab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		$("#title-view").html($("#title").val());
		$("#clip-view").html($("#clip").val());
		$("#content-view").html("").html($("textarea#content").val());
	});
});

$(function(){
	var ufile=false;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickfiles',
		container: 'imgcontainer',
		multi_selection: false,
		url: "<?=base_url()?>test.php",
		max_file_size : '500kb',
		resize: {
			width: 200,
			height: 200,
			crop: true
		},
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
					width: 200,
					height: 200,
					crop: true
				});
				$('#canvas_view').css({margin:"2px 10px 10px 2px",width:200,height:200}).addClass("img-polaroid");
				this.embed($('#canvas_view').get(0), {
					width: 200,
					height: 200,
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
		}
		//	alert('You must at least upload one file.');
	
		if (!x) return false;
	});    
    
});
</script>
