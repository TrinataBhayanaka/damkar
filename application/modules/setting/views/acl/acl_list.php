<?php
	if(cek_array($arrGroup2Modules)):
		foreach($arrGroup2Modules as $x=>$val):
			$dataACL[$val["group_id"]][$val["module_id"]]=$val["rights"];
		endforeach;
	endif;
	
?>
<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-lock"></i> ACL <small> List </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
           <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Setting</a></li>
            <li><a href="<?=$this->module?>acl_list">ACL</a></li>
            <li class="active">List</li>
        </ol>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<!--<div id="breadcrumbs" class="breadcrumbs-fixed">
    <ul class="breadcrumb">
    <li><i class="icon-home bc-icon"></i> <a href="#">Home</a> <span class="divider">\</span></li>
    <li><a href="<?=$this->module?>acl_list">Module ACL</a> <span class="divider">\</span></li>
    <li class="active">List</li>
    </ul>
</div>

<div style="padding:40px 25px">
<div class="page-header">
	<h1>ACL<small>&bull; Access Control List </small></h1>
</div>-->

<div class="row">
<div class="col-md-12">
<? if(!$this->cms->has_admin($this->module)):?>
<div class="alert alert-warning">Anda tidak berhak mengakses halaman ini!!! Hak akses minimal adalah admin!!!</div>
<? endif;?>
<?=message_box();?>
<div class="toolbar box_shadow well well-sm">
        	<div class="pull-left">
            <div class="btn-group">
        	<a href="#" class="acl_save btn btn-small btn-info right_write"><i class="icon-book"></i> Save</a>
            </div></div>
            <div class="clearfix" style="height:30px"></div>
        </div>
<div class="box">
<div class="box-content">
<form id="frm" method="post" action="<?php echo $this->module?>acl_save/">
<table class="table table-condensed table-bordered">
<thead class="well well-sm box_shadow right_full">
	<tr>
    	<th>Group</th>
    	<th>ACL</th>
    </tr>
</thead>
<? foreach($arrGroups as $group):?>
	<tr>
    	<td class="box_shadow simple_box"><h3><?=$group["description"]?></h3></td>
        <td>
        	<table class="table table-condensed">
            	<thead class="box_quote">
                	<tr><th>Module</th>
                    	<? if(cek_array($arrRights)):?>
                		<? foreach($arrRights as $right):?>
                    		<th><label class="radio inline"><input type="radio" name="rb_all[<?=$group["id"]?>]" data-right='<?=$right["right_id"]?>' data-group='<?=$group["id"]?>' class="rb inline all right_full"> <?=$right["description"]?></label></th>
                		<? endforeach;?>
                        <? endif;?>
                    </tr>
                </thead>
                <? if(cek_array($arrModules)):?>
            	<? foreach($arrModules as $module):?>
                	<tr class="right_full">
                    	<td><? if($module["is_group"]):?>
								<b><?php echo $module["module_name"]?><b>
                        	<? else:?>
                            	<span style="padding-left:20px"><?php echo $module["module_name"]?></span>
                            <? endif;?>    
                        </td>
                        
                    	<? foreach($arrRights as $right):?>
                        <td>
                        <?php 
							$checked="";
							if(isset($dataACL[$group["id"]][$module["idx"]])):
								$dataACLRight=$dataACL[$group["id"]][$module["idx"]];
								if($right["right_id"]==$dataACLRight):
									$checked="checked='checked'";
								endif;
							endif;
						?>
                        <input type="radio" name="rb[<?=$group["id"]?>][<?=$module["idx"]?>]" class="right_full rb inline g_<?=$group["id"]?> m_<?=$module["idx"]?> r_<?=$right['right_id']?>" data-group='<?=$group["id"]?>' data-module='<?=$module["idx"]?>' data-right='<?=$right["right_id"]?>'  value="<?=$right["right_id"]?>"  <?php echo $checked?>> </td>
                        <? endforeach;?>
                    </tr>
                <? endforeach;?>
                <? endif;?>
            </table>
        </td>
    </tr>
<? endforeach;?>
</table>
</form>
</div></div><!-- end box-->
</div></div>
</div>

<script>
	//komeng added
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
		$(".acl_save").click(function(e){
			e.preventDefault();
			$("#frm").submit();
		});
	
		$(".rb.all").click(function(){
			var group=$(this).data("group");
			var right=$(this).data("right");
			$(".g_"+group+".r_"+right).attr("checked","checked");
		});	
		
	});
	
	
	
	
</script>