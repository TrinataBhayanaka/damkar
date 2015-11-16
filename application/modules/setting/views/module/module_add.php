<?
	$arrGroupModule=$this->conn->GetAll("select idx,module_name from t_module where is_group=1 order by order_num");
	$arrGroups=$this->conn->GetAll("select * from groups");
	
?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-group"></i> Group <small> Add </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
            <li><a href="../admin">Home</a></li>
            <li><a href="<?=$this->module?>">Account Manager</a></li>
            <li><a href="<?=$this->module?>group_list">Groups</a></li>
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
                            <i class="icon-plus"></i> 
                        </span>
                        Add
                    </a>
                </li>
                <li>
                    <a href="setting/module/module_add/">
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
<div class="col-sm-12">
    <?php echo message_box();?>
    <form id="frm" method="post" action="<?php echo $this->module;?>module_add/" class="form-horizontal control-label-left">
    <input type="hidden" name="act" id="act" value="create"/>
    <div class="box">
        <div class="box-header">
            <h2><i class="icon-plus"></i> Add Module</h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-sm-6">
                    
                     
                  <!--  <button class="btn btn-sm btn-default pull-right" id="auto_fill" type="button" value="">AutoFill</button>	
                    <div class="clearfix"></div> -->
                     <!-- control-group category-->
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-4 ">Nama Module</label>
                        <div class="col-md-8">
                            <input type="text" id="module_name" name="module_name" class="input-sm form-control required" value="<?php echo $data["module_name"];?>" />
                            <p class="help-block">example: Setting - User</p>
                        </div>
                    </div>
                    <!-- /control-group category-->
                    
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-4 ">Alias</label>
                        <div class="col-md-8">
                            <input type="text" id="module_short_name" name="module_short_name" class="input-sm form-control required" value="<?php echo $data["module_short_name"];?>" />
                            <p class="help-block">example: setting_user</p>
                        </div>
                    </div>
                    
                    <div class="formSep"></div>
                    
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-4 ">URL</label>
                        <div class="col-md-8">
                            <input type="text" id="module_url" name="module_url" class="input-sm form-control required" value="<?php echo $data["module_url"];?>" />
                            <p class="help-block">example: setting/user</p>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-4 ">Path</label>
                        <div class="col-md-8">
                            <input type="text" id="module_path" name="module_path" class="input-sm form-control required" value="<?php echo $data["module_path"];?>" />
                             <p class="help-block">example: setting/</p>
                        </div>
                    </div>
                    
                   <div class="formSep"></div>
                    
                    
                    <?php
					  
					  	$arrGroupModule=$this->conn->GetAll("select idx,module_name from t_module where is_group=1 order by order_num");
						
						$data_group=array(""=>"-- Pilih Module --");
						
						if(cek_array($arrGroupModule)):
							foreach($arrGroupModule as $x=>$val):
								$data_group[$val["idx"]]=$val["module_name"];
							endforeach;
						endif;
					?>
                    
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-4 ">Parent Module</label>
                        <div class="col-md-8">
                        	<?=form_dropdown("parent_idx",$data_group,""," id='parent_idx' class='form-control  select required'")?>
                             
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="category" class="control-label no-padding-right col-md-2 ">Active</label>
                        <div class="col-md-8">
                         	<input type="checkbox" name="active" id="active" checked="checked" value="1"  />
                         </div>
                    </div>
                    
                    
                </div>
                
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
                                <td><input type="radio" name="right[<?=$val["id"]?>]" checked="checked" value="0" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]"  value="1" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]"  value="2" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]"  value="3" /></td>
                                <td><input type="radio" name="right[<?=$val["id"]?>]"  value="4" /></td>
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
		$("#auto_fill").click(function(){
			alert("test");
			var str=$("#module_url").val();
			//replace last char of /
			str=str.replace(/\/$/,"");
			
			var str_split=str.split("/");
			var str_name=str.replace(/\_/gi," ");
			str_name=$.trim(str_name.replace(/\//gi," - "));
			str_name= $.ucfirst(str_name);
			
			$("#module_short_name").val(str_split.join("-"));
			$("#module_name").val(str_name);
			
		});
	
		$("#module_url").blur(function(){
			var str=$(this).val();
			
			//replace last char of '/'
			str=str.replace(/\/$/,"");
			
			var str_split=str.split("/");
			
			$("#module_path").val(str_split[0]+"/");
		});
	})
</script>
<script>
	$(function(){
		var act_link="group";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>
