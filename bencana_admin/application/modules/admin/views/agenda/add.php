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
                    <h1>News<small> Add </small></h1>
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
    	<!--<form class="search_form col-md-3 pull-right" action="<?=$this->module?>listview" method="get">
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
  <form id="fdata" action="<?=$module;?>add" method="post" >
    <input type="hidden" name="author" value="<?=$user_name;?>" />
    <div class="row">
	    <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <label>News Title</label>
                    <input type="text" id="title" name="title" class="form-control input-xs required" placeholder="title" value="<?=$data['title'];?>" />
					 <input type="hidden" id="category" name="category" class="" placeholder="" value="5" />
				</div>
                <div class="col-md-4 form-group">
                    <label>Tanggal</label>
						<input type="hidden" id="tgl" name="tgl" value="<?php echo date("Y-m-d");?>" />
						<input type="text" id="tgl_" name="tgl_" class="dp1 form-control" value="<?php echo date("d/m/Y");?>" />
				</div>
            </div>
            <div class="formSep">
                <div class="row-fluid">
                    <div class="span12">
                        <label>News clip </label>
                        <textarea name="news_clip" id="news_clip" class="form-control required" rows="3" placeholder="Enter ..."><?=$data['news_clip'];?></textarea>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label>News Content</label>
                    <textarea name="news_content" id="news_content" cols="10" rows="3" class="ckeditor span11 "><?=$data['news_content'];?></textarea>
                </div>
            </div>
        </div>

	    <div class="col-md-4">
        	<!--<h3 class="heading">Options</h3>-->
        	 <!-- form separator -->
            <div class="formSep">
                <div class="row">
                     <div class="span12">
                        <? $checked=($data['status'])?" checked":""; ?>
                        <label>
                            <input type="checkbox" value="1" name="status"<?=$checked;?> />
                            Publish
                        </label>
                    </div>
                </div>
            </div> <!-- form separator -->
        </div> 
    </div>
    <br />
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn">Cancel</button>
    </div>
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
$(document).ready(function () {
	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#tgl").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$('.dp1').datepicker('hide');
	}).data('datepicker');

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
	/*var config = {
		toolbar:
		  [
			 ['Undo', 'Redo', '-', 'SelectAll'],
			 ['Styles','Format', 'Bold', 'Italic', 'Underline','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			 ['Image','Table'],
			 ['Link', 'Unlink'], 
			 ['Source'],
		  ]
	};
	$('textarea#news_content' ).ckeditor(config);*/
	$('#news-tab a:first').tab('show');
	$('#news-tab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		$("#title-view").html($("#title").val());
		$("#news_clip-view").html($("#news_clip").val());
		$("#news_content-view").html("").html($("textarea#news_content").val());
	});
});

</script>
