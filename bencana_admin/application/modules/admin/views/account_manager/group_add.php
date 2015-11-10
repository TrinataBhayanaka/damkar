
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Groups Add</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list"><?=$this->module_title?></a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list">Groups</a> <span class="divider"></span></li>
            <li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
<div style="padding:0px">
<div class="row topbar box_shadow">
		<div class="col-md-12">
			<div class="pull-left">
				<ul class="tab-bar grey-tab">
					<li>
						<a href="<?php echo $this->module?>group_list">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_titless?>
						</a>
					</li>
					<li class="active">
						<a href="<?php echo $this->module?>group_add">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_titless?>
						</a>
					</li>
				</ul>
			</div>
			<!--<form class="search_form col-md-3 pull-right" action="<?//=$this->module?>" method="get">
				<?php //$this->load->view("widget/search_box_db"); ?>
			</form>-->
		</div>
	</div>

<div class="row">
<div class="col-md-6">
	
    <form id="frm" method="post" action="<?php echo $this->module;?>group_add/" class="form-horizontal">
    	<input type="hidden" name="act" id="act" value="create"/>
    <!-- control-group category-->
         <div class="control-group">
        	<label for="category" class="control-label">Name</label>
            <div class="controls">
            	<input type="text" id="name" name="name" class="form-control input-xlarge required" value="" />
            </div>
        </div><!-- /control-group category-->
     
    <!-- control-group category-->
         <div class="control-group">
        	<label for="description" class="control-label">Description</label>
            <div class="controls">
            	<textarea class="form-control input-xlarge" id="description" name="description"></textarea>
            </div>
        </div><!-- /control-group description-->
		<div class="control-group">
        	<label for="propinsi" class="control-label">Propinsi</label>
            <div class="controls">	
				<?php 
					$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
					$arrPropinsi1=$arrPropinsi;
				?>
				
				<?=form_dropdown("id_propinsi[]",$arrPropinsi1,0,"id='id_propinsi' class='select2 form-control' multiple='multiple' ");?>
			
			</div>
        </div><!-- /control-group category-->
        <!-- <div class="control-group">
        <div class="controls">
        	<label class="checkbox">Publish<input type="checkbox" checked="checked" id="publish" name="publish" value="1" /></label>
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