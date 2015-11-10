<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-group"></i> Module <small> Delete </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
            <li><a href="../admin">Home</a></li>
            <li><a href="<?=$this->module?>">Account Manager</a></li>
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
                    <a href="setting/module">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:void(0)" data-toggle="tab">
                        <span class="block text-center">
                            <i class="icon-remove"></i> 
                        </span>	
                        Delete
                    </a>
                </li>
            </ul>
        </div>
    	
    </div>
</div>

<div class="row">
<div class="col-sm-12">

    <?php echo message_box();?>
    <form method="post" action="<?php echo $this->module?>module_delete/<?php echo $data["idx"]?>"  class="form-horizontal">
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
                        <label for="category" class="control-label no-padding-right col-md-2 ">Name</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["module_name"];?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Short Name</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["module_short_name"];?>
                        </div>
                    </div>
                    <!-- /control-group category-->
                     
                    <!-- control-group category-->
                     <div class="form-group">
                        <label for="description" class="control-label no-padding-right col-md-2 ">PATH</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["module_path"]?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="control-label no-padding-right col-md-2 ">URL</label>
                        <div class="col-md-8 field-data">
                            <?php echo $data["module_url"]?>
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
