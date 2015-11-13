<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Users Edit</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/"><?=$this->module_title?></a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/">Users</a> <span class="divider"></span></li>
            <li class="active">Edit</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
<div style="padding:0px">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_titles?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>user_add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add <?=$this->module_titles?>
                    </a>
                </li>
				<li class="active">
                    <a href="javascript:void(0)">
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_titles?>            
					</a>
                </li>
				<li class="pull-right">
                    <a class="red" onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."user_delete/".$data["id"]?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete <?=$this->module_titles?>                    
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
    <?php //echo message_box();?>
    <form id="frm" method="post" action="<?php echo $this->module;?>user_edit/<?php echo $data["id"];?>" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="update"/>
    	<fieldset>
    		

		 <!-- control-group nm_umum-->
         <div class="control-group">
        	<label for="nm_umum" class="control-label">Username</label>
            <div class="controls">
            	<input type="text" id="username" name="username" class="form-control input-xlarge required" value="<?php echo $data["username"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_umum-->
        
        
                        
        <!-- control-group nm_latin-->
         <div class="control-group">
        	<label for="nm_latin" class="control-label">Firstname</label>
            <div class="controls">
            	<input type="text" id="first_name" name="first_name" class="form-control input-xlarge required" value="<?php echo $data["first_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_latin-->
        
        
                        
        <!-- control-group hscode-->
         <div class="control-group">
        	<label for="hscode" class="control-label">Lastname</label>
            <div class="controls">
            	<input type="text" id="last_name" name="last_name" class="form-control input-xlarge" value="<?php echo $data["last_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
        <!-- control-group hscode-->
        <div class="control-group">	
        	<label for="nomor_induk" class="control-label">N.I.K.</label>
            <div class="controls">
        	<input type="text" id="nomor_induk" name="nomor_induk" class="form-control input-xlarge" value="<?php echo $data["nomor_induk"];?>" />
            </div>
        </div>
         <!-- control-group hscode-->
         <div class="control-group">
        	<label for="email" class="control-label">Email</label>
            <div class="controls">
            	<input type="text" id="email" name="email" class="form-control input-xlarge" value="<?php echo $data["email"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
        
         <div class="control-group">	
        	<label for="password" class="control-label">Password (if change password)</label>
            <div class="controls">
        	<input type="password" id="password" name="password" class="form-control input-xlarge" value="" />
            </div>
        </div>
        
         <div class="control-group">	
        	<label for="confirm_password" class="control-label">Confirm Password (if change password)</label>
            <div class="controls">
        	<input type="password" id="confirm_password" equalto="#password" name="confirm_password" class="form-control input-xlarge" value="" />
            </div>
        </div>
        <input type="hidden" value="<?=$data["group_brwa"];?>" id="getID">
        
        <div class="control-group">	
        	<label for="email" class="control-label">Groups</label>
            <div style="padding-left:30px;" class="controls">
			<?php $a=1;
			foreach ($group_brwa as $group):
			if($a == 3):
			 $h=" ";
			endif;
			?>
            <label class="radio">
            <?php
                $gID=$group['id'];
                $checked = null;
                $item = null;
				if ($gID == $data["group_brwa"]) {
					$checked= ' checked="checked"';
				}

            ?>
            <input class="group<?=$a;?>" type="radio" name="groups" data-org="<?php echo $group['use_organization'];?>" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
            <?php echo $group['name'].$h;?>
            </label>	
            <?php $a++; endforeach;?>
            </div>
        </div>
		
		<div class="control-group">	
        	<label for="propinsi" class="control-label">Propinsi</label>
            <div class="controls">
				<?php 
					$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
					$arrPropinsi1=array(""=>"--Pilih Propinsi--")+$arrPropinsi;
				?>
				<?=form_dropdown("id_propinsi",$arrPropinsi1,0,"id='id_propinsi_h' disabled class='form-control required'");?>

				<?php 
				$b=1;
				foreach ($group_brwa as $group):
				if($b == 3):
				?>
				<div id="id_h" >	
					<?php
						$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
						$arrPropinsi1=array(""=>"--Pilih Propinsi--")+$arrPropinsi;
						$data_propinsi=$data["id_propinsi"];
					?>
					<?=form_dropdown("id_propinsi",$arrPropinsi1,$data["id_propinsi"],"id='id_propinsi' class='form-control required'");?>
									
				</div>
				<?php endif; ?>
				<? $b++; endforeach;?>
			</div>
        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- <div class="control-group">	
        	<label for="username" class="control-label">SKPA-P</label>
            <div class="controls">
            <?//=form_dropdown("company",$m_skpa,$data['company'],"id='company' class='input-xlarge '");?>
            </div>
        </div>-->
        <br>               
        <div class="form-actions">
        	<button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn">Cancel</button>
        </div>
        </fieldset>
        
    </form>
</div></div>
<script type="text/javascript">
	 $(document).ready(function () {
		var id = $('#getID').val();
		if(id == 8){
			 $('#id_h').show('fast');
			 $('#id_propinsi_h').hide('fast');
		}else{
			$('#id_h').hide('fast');
			$('#id_propinsi_h').show('fast');
		}
		$('.group1').click(function () {
		   $('#id_h').hide('fast');
		   $('#id_propinsi_h').show('fast');
		   $('#id_propinsi option:eq(0)').attr('selected','selected');
		});
		$('.group2').click(function () {
			  $('#id_h').hide('fast');
			  $('#id_propinsi_h').show('fast');
			  $('#id_propinsi option:eq(0)').attr('selected','selected');
		 });
		 $('.group3').click(function () {
			  $('#id_h').show('fast');
			  $('#id_propinsi_h').hide('fast');
		 });
		 $('.group4').click(function () {
			  $('#id_h').hide('fast');
			  $('#id_propinsi_h').show('fast');
			  $('#id_propinsi option:eq(0)').attr('selected','selected');
		 });
   });
</script>

<script>
	$(function(){
		$("#frm").validate();
		
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href$='"+act_link+"']").parent("li").addClass("active");
		
		$(".group").click(function(){
			//$("#company").prop("disabled",$(this).data('org')==1 ? false: true);
			var use_org = $(this).data('org');
			$("#company").val(use_org);
			$("#company option").show();
			$("#company option").each(function(){
				if (!use_org) {
					$(this).val()!=0?$(this).hide():$(this).show();
				}
				else {
					$(this).val()!=0?$(this).show():$(this).hide();
				}
			});
		});
	})
</script>