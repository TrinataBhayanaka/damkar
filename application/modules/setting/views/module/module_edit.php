<?
	$arrGroupModule=$this->conn->GetAll("select idx,module_name from t_module where is_group=1 order by order_num");
	$arrGroupRights=$this->conn->GetAll("select b.*,a.* from groups_2_module a left join groups b on a.group_id=b.id where module_id=".$data["idx"]);
	$arrGroups=$this->conn->GetAll("select * from groups");
	
	if(cek_array($arrGroupRights)):
		foreach($arrGroupRights as $x=>$val):
			$dataRights[$val["group_id"]]=$val["rights"];
		endforeach;
	endif;
	
?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-group"></i> Group <small> Edit </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
            <li><a href="../admin">Home</a></li>
            <li><a href="<?=$this->module?>">Account Manager</a></li>
            <li><a href="<?=$this->module?>group_list">Groups</a></li>
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
                    <a href="setting/module">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li>
                    <a href="setting/module/module_add" class="right_write">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add
                    </a>
                </li>
                <li class="active">
                    <a href="#edit" data-toggle="tab">
                        <span class="block text-center">
                            <i class="icon-edit"></i> 
                        </span>
                        Edit
                    </a>
                </li>
                <li>
                     <a href="setting/module/module_delete/<?=$data["id"]?>" class="right_full" >
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
    <form id="frm" method="post" action="<?php echo $this->module;?>module_edit/<?php echo $data["idx"];?>" class="form-horizontal">
    <div class="box">
        <div class="box-header">
            <h2><i class="icon-pencil"></i> Edit Group</h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" name="act" id="act" value="update"/>
                    <!-- control-group category-->
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Module Name</label>
                        <div class="col-md-8">
                            <input type="text" id="module_name" name="module_name" class="input-sm form-control required" value="<?php echo $data["module_name"];?>" />
                        </div>
                    </div>
                    <!-- /control-group category-->
                    
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Short Name</label>
                        <div class="col-md-8">
                            <input type="text" id="module_short_name" name="module_short_name" class="input-sm form-control required" value="<?php echo $data["module_short_name"];?>" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Path</label>
                        <div class="col-md-8">
                            <input type="text" id="module_path" name="module_path" class="input-sm form-control required" value="<?php echo $data["module_path"];?>" />
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">URL</label>
                        <div class="col-md-8">
                            <input type="text" id="module_url" name="module_url" class="input-sm form-control required" value="<?php echo $data["module_url"];?>" />
                        </div>
                    </div>
                    
                    <? 
						
						
						if(cek_array($arrGroupModule)):
							foreach($arrGroupModule as $x=>$val):
								$data_group[$val["idx"]]=$val["module_name"];
							endforeach;
						endif;
					?>
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Group Module</label>
                        <div class="col-md-8">
                        	<?=form_dropdown("parent_idx",$data_group,$data["parent_idx"]," id='parent_idx' class='form_control input-md required'")?>
                        </div>
                    </div>
                    
                    
                    
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Active</label>
                        <div class="col-md-8">
                        	<? $checked=$data["active"]==1?"checked='checked'":'';?>
                         	<input type="checkbox" name="active" id="active" <?=$checked?> value="1"  />
                         </div>
                    </div>
                    
                    
                     
                    <!-- control-group category-->
                     <!--<div class="form-group">
                        <label for="description" class="control-label no-padding-right col-md-2 ">Description</label>
                        <div class="col-md-8">
                            <textarea class="input-sm form-control" id="description" name="description" rows="3"><?php echo $data["description"]?></textarea>
                        </div>
                    </div>-->
                    <!-- /control-group description-->
                </div>
            <!-- ACL -->
            <div class="col-sm-6">
            	<table class="table table-condensed table-bordered">
                	<thead>
                	<tr>
                     	<th>Group</th>
                        <th>None</th>
                        <th>View</th>
                        <th>Read</th>
                        <th>Write</th>
                        <th>Full</th>
                    </tr>
                    </thead>
                    <tbody>
                    	<? foreach($arrGroups as $x=>$val):?>
                        	<tr>
                            	<td><?=$val["description"];//group name?></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]" <?=$dataRights[$val["id"]]==0?"checked='checked'":"";?> value="0" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]" <?=$dataRights[$val["id"]]==1?"checked='checked'":""?> value="1" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]" <?=$dataRights[$val["id"]]==2?"checked='checked'":""?> value="2" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]" <?=$dataRights[$val["id"]]==3?"checked='checked'":""?> value="3" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]" <?=$dataRights[$val["id"]]==4?"checked='checked'":""?> value="4" /></td>
                            </tr>
                        <? endforeach;?>
                    </tbody>
                </table>
            
            </div><!-- END ACL -->
            
            </div>
            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-actions">
                    	<div class="row">
                            <div class="col-md-offset-1 col-md-6">
                                <button class="btn btn-primary save " type="submit"><i class="icon-book icon-white"></i> Save </button>
                                <button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
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