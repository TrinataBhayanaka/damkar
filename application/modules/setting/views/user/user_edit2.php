<?php 
	//$groups=$this->ion_auth->groups()->result_array(); 
	$groups=$this->conn->GetAll("select * from groups");
	//$currentGroups = $this->ion_auth->get_users_groups($data["id"])->result_array();
	/*
	$currentGroupsAll=$this->conn->GetAll("select * from users_groups where user_id=".$data["id"]);
	if(cek_array($currentGroupsAll)):
		foreach($currentGroupsAll as $x=>$val):
			$currentGroups[]=$val["group_id"];
		endforeach;
	endif;
	pre($currentGroups);
	*/
	$currentGroups=$this->conn->GetAll("select * from users_groups where user_id=".$data["id"]);
	
?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-user"></i> User <small> Edit </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Account Manager</a></li>
            <li><a href="<?=$this->module?>user_list">Users</a></li>
            <li class="active">Edit</li>
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
                <li>
                    <a href="setting/user/user_add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add User
                    </a>
                </li>
                <li class="active">
                    <a href="#edit" data-toggle="tab">
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit User
                    </a>
                </li>
                 <li class="pull-right">
                    <a class='red' onclick="return confirm('Anda yakin akan menghapus data ini?');" href="setting/user/user_delete/<?=$data["id"]?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete User
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</div>


<!--<div id="breadcrumbs" class="breadcrumbs-fixed">
<ul class="breadcrumb">
        <li><a href="admin/">Home</a> <span class="divider">/</span></li>
       <li><a href="<?=$this->module?>">Account Manager</a> <span class="divider">/</span></li>
        <li><a href="<?=$this->module?>user_list">Users</a> <span class="divider">/</span></li>
        <li class="active">Edit</li>
    </ul>
</div>-->

<!--<div style="padding:40px 25px">
<div class="page-header">
	<h1>User <small> Edit </small></h1>
</div>
<br>-->

<div class="row">
<div class="col-md-6">
    <?php echo message_box();?>
    <form id="frm" method="post" action="<?php echo $this->module;?>user_edit/<?php echo $data["id"];?>" class="form-horizontal control-label-left">
    	<input type="hidden" name="act" id="act" value="update"/>
    	<fieldset>
    	
		<!-- control-group nm_umum-->
         <div class="form-group">
        	<label for="nm_umum" class="control-label no-padding-right col-md-4">User Name</label>
            <div class="col-md-8">
            	<input type="text" id="username" name="username" readonly="readonly" disabled="disabled" class="form-control required" value="<?php echo $data["username"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_umum-->
        
        
                        
        <!-- control-group nm_latin-->
         <div class="form-group">
        	<label for="nm_latin" class="control-label no-padding-right col-md-4">First Name</label>
            <div class="col-md-8">
            	<input type="text" id="first_name" name="first_name" class="form-control required" value="<?php echo $data["first_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_latin-->
        
        
                        
        <!-- control-group hscode-->
         <div class="form-group">
        	<label for="hscode" class="control-label no-padding-right col-md-4">Last Name</label>
            <div class="col-md-8">
            	<input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $data["last_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
         <!-- control-group hscode-->
         <div class="form-group">
        	<label for="email" class="control-label no-padding-right col-md-4">Email</label>
            <div class="col-md-8">
            	<input type="text" id="email" name="email" class="form-control" value="<?php echo $data["email"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
        
         <div class="form-group">	
        	<label for="password" class="control-label no-padding-right col-md-4">Password (if change password)</label>
            <div class="col-md-8">
        	<input type="password" id="password" name="password" class="form-control" value="" />
            </div>
        </div>
        
         <div class="form-group">	
        	<label for="confirm_password" class="control-label no-padding-right col-md-4">Confirm Password (if change password)</label>
            <div class="col-md-8">
        	<input type="password" id="confirm_password" equalto="#password" name="confirm_password" class="form-control" value="" />
            </div>
        </div>
        
        
        <div class="form-group">	
        	<label for="email" class="control-label no-padding-right col-md-4">Groups</label>
            <div class="col-md-8">
			<?php foreach ($groups as $group):?>
           <div class="checkbox" style="padding-left:20px">
            <?php
                $gID=$group['id'];
				$checked = null;
                $item = null;
                
				foreach($currentGroups as $grp) {
                    if ($gID == $grp["group_id"]) {
                        $checked= ' checked="checked"';
                    break;
                    }
                }
            ?>
            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
            <?php echo $group['name'];?>
            </div>
            <?php endforeach?>
          
            </div>
        </div>
        
                        
        <div class="form-actions">
        	<button class="btn btn-primary save "><i class="icon-book icon-white"></i> Save </button>
        	<button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
            <a class="btn btn-default" href="<?php echo $this->agent->referrer()?>" class="btn btn-warning "><i class="icon-refresh"></i> Back To User List</a>
        </div>
        </fieldset>
        
    </form>
    <br><br>
</div></div>

<script>
	$(function(){
		$("#frm").validate();
		
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href$='"+act_link+"']").parent("li").addClass("active");
	})
</script>