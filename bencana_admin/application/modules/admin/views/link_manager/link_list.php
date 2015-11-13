<?php
	$arrCategory=$this->arr_category;
	$arrCategory[""]="All";
?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> List</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="admin/link_manager/link_list">Links</a> <span class="divider"></span></li>
			<li><a href="admin/link_manager/link_list">Link Directory</a> <span class="divider"></span></li>
            <li class="active">List</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->
<?php echo message_box();?>
<!-- div for positioning -->
<div style="padding:0px">
	<div class="row topbar box_shadow">
		<div class="col-md-12">
			<div class="pull-left">
				<ul class="tab-bar grey-tab">
					<li class="active">
						<a href="<?php echo $this->module?>link_list">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_title?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>link_add">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_title?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>link_list">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
					<div class="pull-left" style="margin-left:5px;margin-top:7px;">
						<?php echo form_dropdown("cat_id",$arrCategory,$this->input->get_post("cat_id"),"id='cat_id' class='input-xlarge select2' style='width:300px'");?>
					</div>
				</ul>
			</div>
			<?php //echo form_dropdown("cat_id",$arrCategory,$this->input->get_post("cat_id"),"id='cat_id' class='input-xlarge select2' style='width:300px'");?>
			<form class="search_form col-md-3 pull-right" action="<?=$this->module?>link_list" method="get">
				<?php $this->load->view("widget/search_box_db"); ?>
			</form>
		</div>
	</div>
<div class="row-fluid">
<div class="span12">


<table class="table table-condensed">
	<thead>
    	<th style="width:60px;text-align:center"></th>
        <th style="width:300px">Name</th>
        <th style="width:300px">URL</th>
        <th>Description</th>
        <th>Category</th>
        <th class="tc">Publish?</th>
        
        
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):
					$id=$this->encrypt_status==TRUE?encrypt($val[$this->tbl_idx]):$val[$this->tbl_idx];
			?>
            	<tr>
                	<td class="tc">
					<a href="<?php echo $this->module."link_edit/".$id?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                    <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."link_delete/".$id?>"><i class="icon-remove icon-alert"></i></a>    
					</td>
                    <td><?php echo $val["name"]?></td>
                    <td><a href="<?php echo $val["link_url"]?>" target="_blank"><?php echo $val["link_url"]?></a></td>
                    <td><?php echo $val["description"]?></td>
                    <td><?php echo $val["category_name"]?></td>
                    <td class="tc"><?php if($val["publish"]==1):?>
							<span class="label label-info">Yes</span>
						<?php elseif($val["publish"]==0):?>
							<span class="label label-danger">No</span>
						<?php endif;?>
					</td>
                    
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>


<?php $page_link=$this->pagination->create_links(); ?>
<!--<div class="row pagination_bar box_quote">-->
<div class="rows well well-sm" >
<div class="col-md-8">
	<div style="vertical-align:middle;line-height:25px">
    <?php 
        $to_page=$this->pagination->cur_page * $this->pagination->per_page;
        $from_page=($to_page-$this->pagination->per_page+1);
		if($from_page>$to_page):
			$from_page=1;
			$to_page=$from_page;
		endif;
        $total_rows=$this->pagination->total_rows;
		if($to_page>1):
    		echo "Displaying : ".$from_page." - ".$to_page." of ". 
					$this->pagination->total_rows." entries";
		endif;
		if($to_page<=1):
			echo "Displaying : 1 of ". 
					$this->pagination->total_rows." entries, ";		
		endif;		
	?>
	<?php
	$arrPerPageSelect=array(
			3=>3,
			10=>10,
			25=>25,
			50=>50,
			-1=>"All"
		);
		$pp=$perPage;
	?>
	Rows/page: &nbsp;<?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select' class='input-mini'")?>	
	<input type="hidden" id="pp" name="pp" value="" />
	</div>
</div><!-- end span 6-->
<div class="col-md-4">
	<span class="pull-right">
		<div style="margin-top:-23px; margin-right:10px">
		<?php echo $page_link; ?>
		</div>
	</span>
</div><!-- end span 6-->
<div class="clearfix" style="height:24px"></div>

</div><!-- end class well -->
</div><!-- end row pagination-->

</div>
</div><!-- end row span-->

</div><!-- end div positioning -->


<script>
	$(function(){
		$(".pagination .active a").click(function(e){
			e.preventDefault();
		});
		
		$("#pp_select").change(function(){
			var pp=parseInt($(this).find("option:selected").val());
			
			if(pp<0){
				location=document.URL.split("?")[0];
				return false;
			}
			get_query();
		});
		
		$("#frm-search").submit(function(e){
			e.preventDefault();
			get_query();
		});
		
		$("#cat_id").change(function(){
			get_query();
		});
			
	
	});
	
	
	function get_query(){
			var q =$("#q").val()||"";
			var perPage=$("#pp_select option:selected").val();
			$("#pp").val(perPage);
			var pp =$("#pp").val()||"";
			
			var cat_id =$("#cat_id option:selected").val()||"";
			
			var data=[];
			if(cat_id){
				data.push("cat_id="+cat_id);
			}
			if(q){
				data.push("q="+q);
			}
			
			if((pp)&&(pp!=25)){
				data.push("pp="+pp);
			}
			var param='';
			if(data){
				param="?"+data.join("&");
			}
			var url=document.URL.split("?")[0];
			location=url+param;
	}
</script>
<?php echo css_asset("plugin/select2.css");?>
<?php echo js_asset("plugin/select2.js");?>
<script>
	$(function(){
		$(".select2").select2();
	});
</script>

<script>
	$(function(){
		var act_link="<?=$this->module?>link";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>