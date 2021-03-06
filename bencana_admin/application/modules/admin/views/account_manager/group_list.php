<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Groups</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list"><?=$this->module_title?></a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/group_list">Groups</a> <span class="divider"></span></li>
            <li class="active">List</li>
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
					<li class="active">
						<a href="<?php echo $this->module?>group_list">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_titless?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>group_add">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_titless?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>group_list">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
				</ul>
			</div>
			<form class="search_form col-md-3 pull-right" action="<?=$this->module?>group_list" method="get">
				<?php $this->load->view("widget/search_box_db"); ?>
			</form>
		</div>
	</div>

<div class="row-fluid">
<div class="span12">
<form id="frm" method="post">
<table class="table table-condensed">
	<thead>
    	<th style="width:80px;"></th>
        <th style="width:300px">Group</th>
        <th>Description</th>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):
					$id=$this->encrypt_status==TRUE?encrypt($val[$this->tbl_idx]):$val[$this->tbl_idx];
			?>
            	<tr>
                	<td class="tc">
                    <!--<div class="btn-group"><a title="edit" class="btn" href="<?php echo $this->module."group_edit/".$id?>"><i class="icon-edit icon-white"></i></a>  <a class="btn" title="delete" href="<?php echo $this->module."group_delete/".$id?>"><i class="icon-trash icon-white"></i></a></div>-->
                    <a href="<?php echo $this->module."group_edit/".$id?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                    <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."group_delete/".$id?>"><i class="icon-remove icon-alert"></i></a> 
                    </td>
                    <td><?php echo $val["name"]?></a></td>
                    <td><?php echo $val["description"]?></td>
                    <!--<td class="tc"><?php //if($val["publish"]==1):?>
							<span class="label label-info">Yes</span>
						<?php //else:?>
							<span class="label label-important">No</span>
						<?php //endif;?>
					</td>
                    <td>
						<?php //if($val["order_num"]>1):?>
                    		<a href="<?//=$this->module?>up/<?//=$val["idx"]?>/"?><i class="icon-arrow-up"></i></i>
						<? //endif;?>
                    </td>
                     
                    <td>
                    	<?php //if($val["order_num"]< count($arrData)):?>
                    		<a href="<?//=$this->module?>down/<?//=$val['idx']?>/"><i class="icon-arrow-down"></i></a>
						<? //endif;?>
                    
                    </td>
                    <td><?php //echo $val["order_num"]?></td>-->
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</form>
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

<script>
	$(function(){
		var act_link="group";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	})
</script>


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
		
	
	});
	
	
	function get_query(){
			var q =$("#q").val()||"";
			var perPage=$("#pp_select option:selected").val();
			$("#pp").val(perPage);
			var pp =$("#pp").val()||"";
			var cat_id =$("#cat_id option:selected").val()||"";
			
			var data=[];
			
			if(q){
				data.push("q="+q);
			}
			if((pp)&&(pp!=25)){
				data.push("pp="+pp);
			}
			var param='';
			if(data){
				param=data.join("&");
				if(param!=""){
					param="?"+param;
				}
			}
			var url=document.URL.split("?")[0];
			location=url+param;
	}
</script>
