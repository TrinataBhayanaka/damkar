<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title2?><small> Add </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="admin/link_manager/link_list">Link Directory</a> <span class="divider"></span></li>
			<li><a href="admin/link_manager/category_list">Category</a> <span class="divider"></span></li>
            <li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

<!-- div for positioning -->
<div style="padding:0px">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>category_list">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title2?>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>category_add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title2?>
                    </a>
                </li>
            </ul>
    	<!--<form class="search_form col-md-3 pull-right" action="<?//=$this->module?>listview" method="get">
        	<?php //$this->load->view("widget/search_box_db"); ?>
        </form>-->
    </div>
</div>
    <?php echo message_box();?>
<div class="row">
<div class="col-md-6">
    <form id="frm" method="post" action="<?php echo $this->module;?>category_add/" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="create"/>
    <!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Category</label>
            <div class="controls">
            	<input type="text" id="category" name="category" class="form-control input-xlarge required" value="" />
            </div>
        </div><!-- /control-group category-->
     
    <!-- control-group category-->
         <div class="control-group">
        	<label for="description" class="control-label">Description</label>
            <div class="controls">
            	<textarea class="form-control input-xlarge" id="description" name="description"></textarea>
            </div>
        </div><!-- /control-group description-->
        
         <div class="control-group">
        <div style="padding-left:20px;" class="controls">
        	<label class="checkbox">Publish<input type="checkbox" checked="checked" id="publish" name="publish" value="1" /></label>
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
		var act_link="<?=$this->module?>category";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>
