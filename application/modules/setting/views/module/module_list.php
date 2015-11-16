<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-table"></i> Module <small> List </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
          <li><a href="../admin">Home</a></li>
            <li><a href="<?=$this->module?>">Module Manager</a></li>
            <li><a href="<?=$this->module?>module_list">Groups</a></li>
            <li class="active">List</li>
        </ol>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<!-- Start: CONTENT -->
<div class="row topbar">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li class="active">
                    <a href="setting/module">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li> 
                    <a href="setting/module/module_add" class="right_full">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Add
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="block text-center">
                            <i class="icon-refresh"></i> 
                        </span>	
                        Refresh
                    </a>
                </li>
            </ul>
        </div>
    	<form class="search_form col-md-3 pull-right" action="<?=$this->module?>module_list" method="get">
        	<?php $this->load->view("widget/search_box_db"); ?>
        </form>
    </div>
</div>

<?=message_box();?>

    <form id="frm" method="post">
    <table class="table table-hover table-box table-striped ">
        <thead>
            <th style="width:80px;text-align:center">Action</th>
            <th style="width:300px">Name</th>
            <th style="width:300px">Short Name</th>
            <th>Path</th>
            <th>URL</th>
            </thead>
        <tbody>
            <?php if(cek_array($arrData)):?>
                <?php foreach($arrData as $x=>$val):?>
                    <tr>
                        <td class="tc">
                        <div class="btn-toolbar" role="toolbar" style="margin-left:10px;">
                          <div class="btn-group btn-group-xs">
                            <a title="edit" class="btn btn-primary right_write" href="<?php echo $this->module."module_edit/".$val["idx"]?>"><i class="icon-pencil icon-white"></i></a>
                          </div>
                          <div class="btn-group btn-group-xs">
                            <a class="btn btn-danger right_full" title="delete" href="<?php echo $this->module."module_delete/".$val["idx"]?>"><i class="icon-remove icon-white"></i></a>
                          </div>
                        </div>
                        </td>
                        <td><? if($val["is_group"]):?>
								<b><?php echo $val["module_name"]?><b>
                        	<? else:?>
                            	<span style="padding-left:20px"><?php echo $val["module_name"]?></span>
                            <? endif;?>    
                        </td>
                        <td><?php echo $val["module_short_name"]?></td>
                        <td><?php echo $val["module_path"]?></td>
                        <td><?php echo $val["module_url"]?></td>
                        <!--<td class="tc"><?php if($val["publish"]==1):?>
                                <span class="label label-info">Yes</span>
                            <?php else:?>
                                <span class="label label-important">No</span>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($val["order_num"]>1):?>
                                <a href="<?=$this->module?>up/<?=$val["idx"]?>/"?><i class="icon-arrow-up"></i></i>
                            <? endif;?>
                        </td>
                         
                        <td>
                            <?php if($val["order_num"]< count($arrData)):?>
                                <a href="<?=$this->module?>down/<?=$val['idx']?>/"><i class="icon-arrow-down"></i></a>
                            <? endif;?>
                        
                        </td>
                        <td><?php echo $val["order_num"]?></td>-->
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
    </form>
	<?php $page_link=$this->pagination->create_links(); ?>
<div class="rows well well-sm">
    <div class="col-md-6">
        <div>
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
                        $this->pagination->total_rows." entries";		
            endif;		
        ?>
            
        </div>
    </div><!-- end span 6-->
    <div class="span6">
        <span class="pull-right">
        <?php echo $page_link; ?>
        </span>
        <span class="pull-right">
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
        Rows/page: <?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select'")?>	
        </span>
    
    </div><!-- end span 6-->
	<div class="clearfix"></div>
</div><!-- end row pagination-->
</div><!-- end row span-->
</div>
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

<? $this->load->view("active_menu");?>
