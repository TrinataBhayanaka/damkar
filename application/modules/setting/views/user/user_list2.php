<div class="row">
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><i class="icon-user"></i> User <small> List </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
        <ol class="breadcrumb">
           <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Setting</a></li>
            <li><a href="<?=$this->module?>user_list">User</a></li>
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
                    <a href="javascript:void(0)">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        List
                    </a>
                </li>
                <li>
                    <a href="setting/user/user_add" class="right_write">
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
    	<form class="search_form col-md-3 pull-right" action="<?=$this->module?>user_list" method="get">
        	<?php $this->load->view("widget/search_box_db"); ?>
        </form>
    </div>
</div>


<div class="row">
<div class="col-md-12">
<?php echo message_box();?>

<form id="frm" method="post">
 <table class="table table-hover table-box table-striped ">
 <thead>
    	<th style="width:80px;text-align:center">Action</th>
        <th width="200px">User Name</th>
        <th width="200px">First Name</th>
        <th width="200px">Last Name</th>
        <th>Email</th>
        <th>Groups</th>
        <th>Active</th>
        </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$value):?>
            	<tr>
                	<td class="tc">
                    <div class="btn-toolbar" role="toolbar" style="margin-left:10px;">
                          <div class="btn-group btn-group-xs">
                            <a title="edit" class="btn btn-primary right_write" href="<?php echo $this->module."user_edit/".$value["id"]?>"><i class="icon-pencil icon-white"></i></a>
                          </div>
                          <div class="btn-group btn-group-xs">
                            <a class="btn btn-danger right_full" title="delete" href="<?php echo $this->module."user_delete/".$value["id"]?>"><i class="icon-remove icon-white"></i></a>
                          </div>
                        </div>
                    </td>
                    <td><?php echo $value["username"]?></td>
                    <td><?php echo $value["first_name"]?></td>
                    <td><?php echo $value["last_name"]?></td>
                    <td><?php echo $value["email"]?></td>
                    <td>
                    <?php if(cek_array($value["groups"])):?>
                    <?php foreach ($value["groups"] as $group):?>
                    		<?php echo anchor("setting/group/group_edit/".$group["id"], $group["name"],array('class' => 'right_write')) ;?><br />
                    <?php endforeach;?>
                    <?php endif;?>
                     </td>
                    <td>
                    <? if($value["active"]):?>
                    <a href="<?=$this->module?>deactivate/<?php echo $value["id"]?>" class="btn right_write"><span class="label label-info"><?php echo lang('index_active_link')?></span></a>		<? else:?>
                    <a href="<?=$this->module?>activate/<?php echo $value["id"]?>" class="btn right_write"><span class="label label-info"><?php echo lang('index_inactive_link')?></span></a>	
                    <? endif;?>
                 
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</form>
<?php $page_link=$this->pagination->create_links(); ?>

<!--<div class="row pagination_bar box_quote">-->
<div class="rows well well-sm">
    <div class="col-md-4 col-lg-4">
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
                            $this->pagination->total_rows." entries";		
                endif;		
            ?>
             </div>
    </div><!-- end span 6-->
    
    
    <div class="col-md-8 col-lg-8">

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
        Rows/page:<?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select' class='input-mini'")?>	
        <input type="hidden" id="pp" name="pp" value="" />
        </span>

        <span class="pull-right">
            <div style="margin-top:-23px; margin-right:10px">
            <?php echo $page_link; ?>
            </div>
        </span>

	</div><!-- end span 8-->
<div class="clearfix" style="height:24px"></div>
</div><!-- end class well -->



<script>
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
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
			
			
			var data=[];
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


<? $this->load->view("active_menu");?>

