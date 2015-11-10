<?php //$arrGroup=$this->ion_auth->groups()->result_array(); 
	$arrGroup=$this->conn->GetAll("select * from groups");
?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-user"></i> User <small> Add </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Setting</a></li>
            <li><a href="<?=$this->module?>user_list">Users</a></li>
            <li class="active">Add</li>
        </ol>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<div class="row topbar">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="setting/user/">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li class="active">
                    <a href="#edit" data-toggle="tab">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add
                    </a>
                </li>
                <li>
                    <a href="#message">
                        <span class="block text-center">
                            <i class="icon-refresh"></i> 
                        </span>	
                        Refresh
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="row">
<div class="col-md-6">
	<?php echo message_box();?>
    <form id="frm" method="post" action="<?php echo $this->module;?>user_add/" class="form-horizontal control-label-left">
    	<input type="hidden" name="act" id="act" value="create"/>
   <fieldset>
        
        <!-- control-nama-->
        <div class="form-group">	
        	<label for="username" class="control-label no-padding-right col-md-4">User Name</label>
            <div class="col-md-8">
        	<input type="text" id="username" name="username" class="form-control required" value="" />
            </div>
        </div>
        <!-- /control-group nm_umum-->
        
                        
        <!-- control-group nm_latin-->
        <div class="form-group">	
        	<label for="first_name" class="control-label col-md-4">First Name</label>
            <div class="col-md-8">
        	<input type="text" id="first_name" name="first_name" class="form-control required" value="" />
            </div>
        </div>
        <!-- /control-group nm_latin-->
        
        <!-- control-group hscode-->
        <div class="form-group">	
        	<label for="last_name" class="control-label col-md-4">Last Name</label>
            <div class="col-md-8">
        	<input type="text" id="last_name" name="last_name" class="form-control" value="" />
            </div>
        </div>
        
        <!-- /control-group hscode-->
        
        <div class="form-group">	
        	<label for="email" class="control-label col-md-4">Email</label>
            <div class="col-md-8">
        	<input type="text" id="email" name="email" class="form-control required email" value="" />
            </div>
        </div>
        
        <div class="form-group">	
        	<label for="email" class="control-label col-md-4">Phone</label>
            <div class="col-md-8">
        	<input type="text" id="phone" name="phone" class="input-xlarge" value="" />
            </div>
        </div>
        
         <div class="form-group">	
        	<label for="email" class="control-label col-md-4">Password</label>
            <div class="col-md-8">
        	<input type="text" id="password" name="password" class="form-control required" value="" />
            </div>
        </div>
        
         <div class="form-group">	
        	<label for="email" class="control-label col-md-4">Confirm Password</label>
            <div class="col-md-8">
        	<input type="text" id="confirm_password" equalto="#password" name="confirm_password" class="required form-control" value="" />
            </div>
        </div>
         
         
         <div class="form-group">	
        	<label for="email" class="control-label col-md-4">Groups</label>
            <div class="col-md-8">
           <? 
				$def_group=1;
				//$def_group=$this->config->item('default_group','ion_auth');?>
            <? foreach($arrGroup as $group):?>
            	<div class="checkbox" style="padding-left:20px">
                    
                    <?php $checked="";?>
                    <?php if($group["id"]==$def_group):?>
                        <?php $checked=" checked='checked' ";?>
                    <?php endif;?>
                    <input type="checkbox" name="groups[]" value="<?php echo $group["id"]?>" <?php echo $checked?>> 	<?php echo $group["name"]?>
                    
                </div>
            <? endforeach;?>
          
            </div>
        </div>
                        
        <div class="formSep"></div>
        
        <div class="form-actions">
        	<button class="btn btn-primary hover save"><i class="icon-book"></i> Save Data</button>
        	<button type="reset" class="btn btn-warning">Reset</button>
            <a class="btn btn-default" href="<?php echo $this->agent->referrer()?>" class="btn btn-warning "><i class="icon-refresh"></i> Back To User List</a>
        </div>
        
        
            
        </fieldset>
    </form>
    
</div></div>

<script>
	$(function(){
		$("#frm").validate();
		
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href$='"+act_link+"']").parent("li").addClass("active");
	})
</script>