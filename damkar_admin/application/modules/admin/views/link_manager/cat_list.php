<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title2?><small> List</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>link_list">Link Directory</a> <span class="divider"></span></li>
			<li><a href="<?=$this->module?>category_list">Category</a> <span class="divider"></span></li>
            <li class="active">List</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
<!-- div for positioning -->
<div style="padding:0px">
<!-- end Komeng Prepend -->
	<div class="row topbar box_shadow">
		<div class="col-md-12">
			<div class="pull-left">
				<ul class="tab-bar grey-tab">
					<li class="active">
						<a href="<?php echo $this->module?>category_list">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_title2?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>category_add">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_title2?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>category_list">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
				</ul>
			</div>
			<?php //echo form_dropdown("cat_id",$arrCategory,$this->input->get_post("cat_id"),"id='cat_id' class='input-xlarge select2' style='width:300px'");?>
			<!--<form class="search_form col-md-3 pull-right" action="<?//=$this->module?>link_list" method="get">
				<?php //$this->load->view("widget/search_box_db"); ?>
			</form>-->
		</div>
	</div>


<div class="toolbar">

<table class="table table-condensed">
	<thead class="">
    	<th style="width:60px;text-align:center"></th>
        <th style="width:300px">Category</th>
        <th>Description</th>
        <th class="tc">Publish ?</th>
        <th width="30px" class="tc">Up</th>
        <th width="30px" class="tc">Down</th>
        <th width="40px" class="tc">Order</th>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):
					$id=$this->encrypt_status==TRUE?encrypt($val[$this->tbl_idx]):$val[$this->tbl_idx];
			?>
            	<tr>
                	<td class="tc">
                    <a href="<?php echo $this->module."category_edit/".$id?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                    <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."category_delete/".$id?>"><i class="icon-remove icon-alert"></i></a>    
                    </td>
                    <td><?php echo $val["category"]?></a></td>
                    <td><?php echo $val["description"]?></td>
                    <td class="tc"><?php if($val["publish"]==1):?>
							<span class="label label-info">Yes</span>
						<?php else:?>
							<span class="label label-danger">No</span>
						<?php endif;?>
					</td>
                    
                    <td class="tc">
						<?php if($val["order_num"]>1):?>
                    		<a href="<?=$this->module?>up/<?=$id?>"?><i class="icon-arrow-up"></i></i>
						<? endif;?>
                    </td>
                     
                    <td class="tc">
                    	<?php if($val["order_num"]< count($arrData)):?>
                    		<a href="<?=$this->module?>down/<?=$id?>"><i class="icon-arrow-down"></i></a>
						<? endif;?>
                    
                    </td>
                    <td><?php echo $val["order_num"]?></td>
                    
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</div>

<script>
	$(function(){
		var act_link="<?=$this->module?>category";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>