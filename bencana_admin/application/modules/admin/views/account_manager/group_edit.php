<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Groups Edit</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list"><?=$this->module_title?></a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list">Groups</a> <span class="divider"></span></li>
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
                    <a href="<?php echo $this->module?>group_list">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_titless?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>user_add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add <?=$this->module_titless?>
                    </a>
                </li>
				<li class="active">
                    <a href="javascript:void(0)">
                        <span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_titless?>            
					</a>
                </li>
				<li class="pull-right">
                    <a class="red" onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."group_delete/".$data["id"]?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete <?=$this->module_titless?>                    
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
    <form id="frm" method="post" action="<?php echo $this->module;?>group_edit/<?php echo $data["id"];?>" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="update"/>
    <!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Group</label>
            <div class="controls">
            	<input type="text" id="name" name="name" class="form-control input-xlarge required" value="<?php echo $data["name"];?>" />
            </div>
        </div><!-- /control-group category-->
     
    <!-- control-group category-->
         <div class="control-group">
        	<label for="description" class="control-label">Description</label>
            <div class="controls">
            	<textarea class="form-control input-xlarge" id="description" name="description"><?php echo $data["description"]?></textarea>
            </div>
        </div><!-- /control-group description-->
		<?php
		$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
		$idp = explode(',', $data["id_propinsi"]);
		foreach($idp as $vx):
			foreach($arrPropinsi as $k => $vs):
				$hhh[$k]=$vs;
				if($vx == $k):
					$hj[] = $vs;
				endif;
			endforeach;
		endforeach;
		?>
		 <div class="control-group">
        	<div class="formSep"></div>
			<label for="tbh" class="control-label">Propinsi yang telah dipilih : </label>
			<p><?php echo implode(", ", $hj);?></p>
			
			<div class="formSep"></div>
        </div><!-- /control-group description-->
        <div class="control-group">
        	<label for="propinsi" class="control-label">Propinsi (diisi jika merubah propinsi)</label>
            <div class="controls">	
				<?php 
					$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
					$arrPropinsi1=$arrPropinsi;
				?>
				
				<?=form_dropdown("id_propinsi[]",$arrPropinsi1,0,"id='id_propinsi' class='select2 form-control ' multiple='multiple' ");?>
			
			</div>
        </div><!-- /control-group category-->
       <!-- <div class="control-group">
        <div class="controls">
        	<label class="checkbox">Publish<input type="checkbox" <?=$data["publish"]==1?"checked":""?> id="publish" name="publish" value="1" /></label>
   		</div>
        </div>-->
        <br>
         <div class="form-actions">
        		<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="reset" class="btn">Cancel</button>
        </div>
    </form>
    
</div></div>
<?=loadFunction("select2");?>

<script>
	$(function(){
		$("#id_propinsi").select2({'placeholder':"--Pilih Propinsi --"});
		var act_link="group";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>