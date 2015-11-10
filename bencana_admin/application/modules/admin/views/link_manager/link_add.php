<?php
	$category=isset($category)?$category:"";
?>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Add </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="admin/link_manager/link_list">Links</a> <span class="divider"></span></li>
			<li><a href="admin/link_manager/link_list">Link Directory</a> <span class="divider"></span></li>
            <li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
<!-- div for positioning -->
<div style="padding:0px;">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>link_list">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>link_add">
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
<div class="row">
<div class="col-md-6">
    
    <form id="frm" method="post" action="<?php echo $this->module;?>link_add" enctype="multipart/form-data" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="create"/>
        <!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Category/Group</label>
            <div class="controls">
            	<?=form_dropdown("category",$this->arr_category,$category,"id='category' class='form-control input-xlarge required'");?>
            </div>
        </div><!-- /control-group category-->
    	<!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Name</label>
            <div class="controls">
            	<input type="text" id="name" name="name" class="form-control input-xlarge required" value="" />
            </div>
        </div><!-- /control-group category-->
     
     	<div class="control-group">
        	<label for="description" class="control-label">URL</label>
            <div class="controls">
            	<input type="text" id="link_url" name="link_url" class="form-control input-xxlarge required url" value="" />
            </div>
        </div>
       
        <div class="control-group">
        	<label for="description" class="control-label">Description</label>
            <div class="controls">
            	<textarea class="form-control input-xxlarge" id="description" name="description"></textarea>
            </div>
        </div>
        
        <div class="control-group">
        	<label for="description" class="control-label">Image</label>
            <div class="controls">
            	<div id="imgcontainer">
            	<div id="preview" style="border:1px solid grey;width:80px; height:80px;" class="img-polaroid"></div>
                            [ <a href id="pickfiles">Browse</a> ]
            	<input id="image_name" type="hidden" name="image" />
                </div>
            </div>
        </div>
        
        <div class="control-group">
			<div style="padding-left:20px;" class="controls">
				<label class="checkbox">Publish<input type="checkbox" checked="checked" id="publish" name="publish" value="1" /></label>
				<!--<label class="checkbox">Active<input type="checkbox"  checked="checked"  id="active" name="active" value="1" /></label>    -->     
			</div>
        </div>
        <br>
         <div class="form-actions">
        	<button type="submit" class="btn btn-primary">Save changes</button>
			<button type="reset" class="btn">Cancel</button>
		</div>
    </form>
    
</div></div>
</div>
<script>
		$(function(){
			$("#frm").validate();
			
			$(".btn.save").click(function(e){
				e.preventDefault();
				$("#frm").submit();
			});
		});
</script>

<script>
	$(function(){
		var act_link="<?=$this->module?>link";	
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>

<script>
$(function(){
	var ufile=false;
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickfiles',
		container: 'imgcontainer',
		multi_selection: false,
		url: "<?=base_url()?>test.php",
		max_file_size : '100kb',
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
					width: 80,
					height: 80,
					crop: true
				});
				$('#canvas_view').css({margin:"2px 10px 10px 2px",width:80,height:80}).addClass("img-polaroid");
				$('#image_data').show();
				this.embed($('#canvas_view').get(0), {
					width: 80,
					height: 80,
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
			$('#frm').submit();
		//}
	});
	$('#frm').submit(function(e) {
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