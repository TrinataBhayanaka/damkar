<?php 
	$groups=$this->ion_auth->groups()->result_array(); 
	$currentGroups = $this->ion_auth->get_users_groups($data["id"])->result_array();
?>
<script>
	$(document).ready(function(){
	    $("#frm").validate();
	   
	    $(".a_edit").click(function(e){
			e.preventDefault();
			var id=$("#id").val();
			var url="<?php echo base_url();?><?php echo $this->module;?>user_edit/"+id;
			location=url;
		});
		
		$(".a_view").click(function(e){
			e.preventDefault();
			var id=$("#id").val();
			var url="<?php echo base_url();?><?php echo $this->module;?>user_view/"+id;
			location=url;
		});
	   
	    $(".save").live("click",function(e){
			e.preventDefault();
			var url="<?php echo base_url();?><?php echo $this->module;?>user_edit_save";
			var dataString=$("#frm").serialize()+"&time="+(new Date).getTime();
			
			if($("#frm").valid()==false){
				return false;
			}
			
			$.ajax({
				   type: "POST",
				   url: url,
				   data: dataString,
				   success: function(msg){
				   		if($.trim(msg)=="ok"){
							$.sticky("<b>Konfirmasi</b><p>Data Telah Tersimpan</p>",stickyoptions,function(response){
								var time=parseFloat(response.timedelay);
								setTimeout(function(){
									location="<?php echo base_url();?><?php echo $this->module;?>";
								},time);
							});
							
						}else{
							Alert("Warning","Proses penyimpanan tidak berhasil,kontak Admin!")
						}	
				   }
			});
			
		
		});
		
	});
</script>
<div id="breadcrumbs" class="breadcrumbs-fixed">
<ul class="breadcrumb">
        <li><a href="admin/dashboard">Home</a> <span class="divider">/</span></li>
        <li><a href="admin/account_manager/">Account Manager</a> <span class="divider">/</span></li>
        <li><a href="admin/account_manager/">Users</a> <span class="divider">/</span></li>
        <li class="active">Edit</li>
    </ul>
</div>
<br>    
<div style="padding:40px 25px">

<div class="row-fluid">
<div class="span12">

    <ul class="nav nav-tabs">
               <li><a href="/view" class="a_view"><i class="icon-eye-open"></i> View</a></li>
               <li class="active"><a href="/edit" class="a_view"><i class="icon-edit"></i> Edit</a></li>
            </ul>
<?php //echo portlet_simple_start();?>

<div id="div_edit">
	<div class="fields"> 
    	<h4 class="title">Data User</h4>
		<form id="frm" method="post" class="form-horizontal">
        <input type="hidden" name="method" id="method" value="edit_save" />
        <input type="hidden" name="id" id="id" value="<?=$data["id"]?>" />
        
    	<fieldset>
    		

		 <!-- control-group nm_umum-->
         <div class="control-group">
        	<label for="nm_umum" class="control-label">User Name</label>
            <div class="controls">
            	<input type="text" id="username" name="username" class="input-xlarge required" value="<?php echo $data["username"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_umum-->
        
        
                        
        <!-- control-group nm_latin-->
         <div class="control-group">
        	<label for="nm_latin" class="control-label">First Name</label>
            <div class="controls">
            	<input type="text" id="first_name" name="first_name" class="input-xlarge required" value="<?php echo $data["first_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group nm_latin-->
        
        
                        
        <!-- control-group hscode-->
         <div class="control-group">
        	<label for="hscode" class="control-label">Last Name</label>
            <div class="controls">
            	<input type="text" id="last_name" name="last_name" class="input-xlarge" value="<?php echo $data["last_name"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
         <!-- control-group hscode-->
         <div class="control-group">
        	<label for="email" class="control-label">Email</label>
            <div class="controls">
            	<input type="text" id="email" name="email" class="input-xlarge" value="<?php echo $data["email"];?>" />
                
            </div><!-- /control -->
        </div><!-- /control-group hscode-->
        
        
         <div class="control-group">	
        	<label for="password" class="control-label">Password (if change password)</label>
            <div class="controls">
        	<input type="password" id="password" name="password" class="input-xlarge" value="" />
            </div>
        </div>
        
         <div class="control-group">	
        	<label for="confirm_password" class="control-label">Confirm Password (if change password)</label>
            <div class="controls">
        	<input type="password" id="confirm_password" equalto="#password" name="confirm_password" class="input-xlarge" value="" />
            </div>
        </div>
        
        
        <div class="control-group">	
        	<label for="email" class="control-label">Groups</label>
            <div class="controls">
			<?php foreach ($groups as $group):?>
            <label class="checkbox">
            <?php
                $gID=$group['id'];
                $checked = null;
                $item = null;
                foreach($currentGroups as $grp) {
                    if ($gID == $grp["id"]) {
                        $checked= ' checked="checked"';
                    break;
                    }
                }
            ?>
            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
            <?php echo $group['name'];?>
            </label>
            <?php endforeach?>
          
            </div>
        </div>
        
                        
        <div class="form-actions">
        	<button class="btn btn-primary save "><i class="icon-book icon-white"></i> Save </button>
        	<button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
        </div>
        
        </fieldset>
        </form>
	</div><!-- end fields user -->
    </div><!--end div edit-->
    <?php //echo portlet_simple_end();?>
  </div><!-- end gridcolumn6 -->
</div><!-- end gridrow--> 

</div>

   
