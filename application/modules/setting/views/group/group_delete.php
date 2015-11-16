<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-group"></i> Group <small> Delete </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Setting</a></li>
            <li><a href="<?=$this->module?>group_list">Groups</a></li>
            <li class="active">Delete</li>
        </ol>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->


<div class="row topbar">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="setting/group">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li>
                    <a href="setting/group/group_add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add
                    </a>
                </li>
                <li >
                    <a href="setting/group/group_edit/<?=$data["id"]?>" >
                        <span class="block text-center">
                            <i class="icon-edit"></i> 
                        </span>
                        Edit
                    </a>
                </li>
                <li class="active">
                    <a href="#delete" data-toggle="tab">
                        <span class="block text-center">
                            <i class="icon-remove"></i> 
                        </span>	
                        Delete
                    </a>
                </li>
            </ul>
        </div>
    	<form class="search_form col-md-3 pull-right" action="<?=$this->module?>group_list" method="get">
        	<?php $this->load->view("widget/search_box_db"); ?>
        </form>
    </div>
</div>

<div class="row">
<div class="col-sm-12">

    <?php echo message_box();?>
    <form method="post" action="<?php echo $this->module?>group_delete/<?php echo $data["id"]?>"  class="form-horizontal">
    <input type="hidden" name="act"  value="delete" />
    <div class="box">
        <div class="box-header">
            <h2><i class="icon-remove"></i> Delete this data?</h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-sm-6">
                    <!-- control-group category-->
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Group</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["name"];?>
                        </div>
                    </div>
                    <!-- /control-group category-->
                     
                    <!-- control-group category-->
                     <div class="form-group">
                        <label for="description" class="control-label no-padding-right col-md-2 ">Description</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["description"]?>
                        </div>
                    </div>
                    <!-- /control-group description-->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-actions">
                    	<div class="row">
                            <div class="col-md-offset-1 col-md-6">
                                <button class="btn btn-primary save " type="submit"><i class="icon-book icon-white"></i> Yes </button>
                                <button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Tidak </button>
                                <a class="btn" href="<?php echo $this->agent->referrer()?>" class="btn btn-warning "></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  	</form>
</div>
</div>

<script>
	$(function(){
		var act_link="group";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>
