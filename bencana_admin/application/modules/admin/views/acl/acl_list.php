<?php
	if(cek_array($arrGroup2Modules)):
		foreach($arrGroup2Modules as $x=>$val):
			$dataACL[$val["group_id"]][$val["module_id"]]=$val["rights"];
		endforeach;
	endif;
	
?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Groups<small> Access Control List </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=base_url()?>admin/acl">Account Manager</a> <span class="divider"></span></li>
			<li><a href="<?=base_url()?>admin/acl"><?=$this->module_title?></a> <span class="divider"></span></li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

<div style="padding:0px">
<div class="row">
<div class="col-md-12">
<?=message_box();?>
<div class="toolbar">
        	<div class="pull-left">
				<div class="btn-group">
				<a href="#" class="acl_save btn btn-primary">Save changes</a>
				</div>
			</div>
            <div class="clearfix" style="height:30px"></div>
        </div>
<br>
<form id="frm" method="post" action="<?php echo $this->module?>acl_save/">
<div class="box box-solid">
	<div class="box-body">
		<div class="box-group" id="accordion">
			<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
<? foreach($arrGroups as $group):?>
			
			<div class="panel box">
				<div class="box-header">
					<h4 class="box-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?=$group["id"]?>">
							<?=$group["name"]?>
						</a>
					</h4>
				</div>
				<div <?=$group["id"] != 1?"style=height: 0px;":""; ?> id="<?=$group["id"]?>" class="panel-collapse collapse <?=$group["id"] == 1?"in":""; ?>">
					<div class="box-body">
						<table class="table table-condensed">
							<thead class="box_quote">
								<tr><th>Module</th>
									<? foreach($arrRights as $right):?>
										<th><label class="radio inline"><input type="radio" name="rb_all[<?=$group["id"]?>]" data-right='<?=$right["right_id"]?>' data-group='<?=$group["id"]?>' class="rb inline all"> <?=$right["description"]?></label></th>
									<? endforeach;?>
								</tr>
							</thead>
							<? foreach($arrModules as $module):?>
								<tr>
									<td><?=$module["module_name"]?></td>
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
									<input type="radio" name="rb[<?=$group["id"]?>][<?=$module["idx"]?>]" class="rb inline g_<?=$group["id"]?> m_<?=$module["idx"]?> r_<?=$right['right_id']?>" data-group='<?=$group["id"]?>' data-module='<?=$module["idx"]?>' data-right='<?=$right["right_id"]?>'  value="<?=$right["right_id"]?>"  <?php echo $checked?>> </td>
									<? endforeach;?>
								</tr>
							<? endforeach;?>
						</table>
					</div>
				</div>
			</div>
<? endforeach;?>
		</div>
	</div><!-- /.box-body -->
</div>
</form>


<!--<form id="frm" method="post" action="<?php //echo $this->module?>acl_save/">
<table class="table table-condensed">
<thead>
	<tr>
    	<th>Group</th>
    	<th>ACL</th>
    </tr>
</thead>
<? //foreach($arrGroups as $group):?>
	<tr>
    	<td style="background:#f4f4f4"><h3><?//=$group["name"]?></h3></td>
        <td>
        	<table class="table table-condensed">
            	<thead class="box_quote">
                	<tr><th>Module</th>
                		<? //foreach($arrRights as $right):?>
                    		<th><label class="radio inline"><input type="radio" name="rb_all[<?=$group["id"]?>]" data-right='<?=$right["right_id"]?>' data-group='<?=$group["id"]?>' class="rb inline all"> <?=$right["description"]?></label></th>
                		<? //endforeach;?>
                    </tr>
                </thead>
            	<? //foreach($arrModules as $module):?>
                	<tr>
                    	<td><?//=$module["module_name"]?></td>
                    	<? //foreach($arrRights as $right):?>
                        <td>
                        <?php 
							// $checked="";
							// if(isset($dataACL[$group["id"]][$module["idx"]])):
								// $dataACLRight=$dataACL[$group["id"]][$module["idx"]];
								// if($right["right_id"]==$dataACLRight):
									// $checked="checked='checked'";
								// endif;
							// endif;
						?>
                        <input type="radio" name="rb[<?//=$group["id"]?>][<?//=$module["idx"]?>]" class="rb inline g_<?//=$group["id"]?> m_<?//=$module["idx"]?> r_<?//=$right['right_id']?>" data-group='<?//=$group["id"]?>' data-module='<?//=$module["idx"]?>' data-right='<?//=$right["right_id"]?>'  value="<?//=$right["right_id"]?>"  <?php //echo $checked?>> </td>
                        <? //endforeach;?>
                    </tr>
                <? //endforeach;?>
            </table>
        </td>
    </tr>
<? //endforeach;?>
</table>
</form>
</div></div>
</div>
-->
<script>
	//komeng added
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	});
	
	$(".acl_save").click(function(e){
		e.preventDefault();
		$("#frm").submit();
	});
	
	$(".rb.all").click(function(){
		var group=$(this).data("group");
		var right=$(this).data("right");
		$(".g_"+group+".r_"+right).attr("checked","checked");
	});
</script>