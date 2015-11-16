<? $id=$this->encrypt_status==TRUE?encrypt($data[$this->tbl_idx]):$data[$this->tbl_idx]; ?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title2?><small> Edit </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="admin/link_manager/link_list">Links</a> <span class="divider"></span></li>
			<li><a href="admin/link_manager/category_list">Link Directory</a> <span class="divider"></span></li>
            <li class="active">Edit</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
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
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>category_add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add <?=$this->module_title2?>
                    </a>
                </li>
				<li class="active">
                    <a href="javascript:void(0)">
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_title2?>            
					</a>
                </li>
				<li class="pull-right">
                    <a class="red" onclick="return confirm('Anda yakin akan menghapus data ini?');" href="admin/link_manager/category_delete/<?=$id;?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete <?=$this->module_title2?>                    
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
    <form id="frm" method="post" action="<?php echo $this->module;?>category_edit/<?php echo $data["idx"];?>" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="update"/>
    <!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Category</label>
            <div class="controls">
            	<input type="text" id="category" name="category" class="form-control input-xlarge required" value="<?php echo $data["category"];?>" />
            </div>
        </div><!-- /control-group category-->
     
    <!-- control-group category-->
         <div class="control-group">
        	<label for="description" class="control-label">Description</label>
            <div class="controls">
            	<textarea class="form-control input-xxlarge" id="description" name="description"><?php echo $data["description"]?></textarea>
            </div>
        </div><!-- /control-group description-->
        
        
        <div class="control-group">
        <div style="padding-left:20px;" class="controls">
        	<label class="checkbox">Publish<input type="checkbox" <?=$data["publish"]==1?"checked":""?> id="publish" name="publish" value="1" /></label>
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