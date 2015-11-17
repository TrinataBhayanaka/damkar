<style>
	.tbl-link td{
		border-bottom:1px #DDDDE2 solid;
		padding-bottom:4px;
		padding-top:10px;
		padding-left:5px;
		
	}
	.link-title{
		font-size:1.1em;
		font-weight:bold;
	}
	.link-description{
		padding-top:3px;
		padding-bottom:5px;
	}
	.link-url{
		font-size:0.9em;
	}
	.link-title a{
		text-decoration:underline;
	}
	.link-info{
		font-size:0.8em;
	}
	.link-info span{
		padding-right:15px;
	}
	
</style>
<div class="subheader">
    <div class="container subheader-inner">
        <ul class="breadcrumb pull-right" style="margin-top:10px;margin-left:0px; width:270px; border-bottom:1px solid #ccc">
            <li><a href="#">Home</a> <span class="divider">\</span></li>
            <li><a href="linkdir">Links</a> <span class="divider">\</span></li>
            <li class="active">Index</li>
        </ul>
    	<h1>Links <small style="display:block">Link, Shorcut, Directory</small></h1>
    </div>
</div>
<br>
<div class="container" style="margin-bottom:20px">
<div class="row-fluid">
<div class="span12">
	<h4 class="heading">Category
    
    </h4>
     
    <?php echo $category_list;?>
</div>
</div>

<div class="row-fluid">
<div class="span12">
	<h4 class="heading">Link Index  :: <small> <?=join(" >>> ",$arrLinkIndex);?></small>
    <div class="pull-right" style="margin-top:-8px">
             <form id="frm-search" action="<?=$this->module?>link_list" method="get">
               <?
                	//load search box
					$this->load->view("widget/search_box_db_wo_reset");
				?>
                </form>
            </div>
    
    </h4>
   <input type="hidden" id="cat_id" name="cat_id" value="<?=$this->input->get_post("cat_id");?>">
   <input type="hidden" id="pp" name="pp" value="<?=$this->input->get_post("pp");?>">
 <table class="tbl-link" width="100%" cellspacing="0" style="border-collapse:collapse" cellpadding="0" border="0">
 	<thead class="well" style="line-height:20px">
    	<tr>
        	<th></th>
        	<th style="text-align:left">Description</th>
            <th style="text-align:right;width:100px;padding-right:10px;">Visits</th>
        </tr>
    </thead>
	<tbody>
	<?php foreach($arrData as $x=>$val):?>
	<tr valign="top">
    	<td width="10px"><i class="icon-globe icon-white"></i></td>
        <td style="padding-left:10px">
        	<span class="link-title">
            	<a href="<?=$this->module?>get_link/<?=$val["idx"]?>" target="_blank"><?=$val["name"]?></a></span>
            <div class="link-url">
            	<?=$val["link_url"];?>
            </div>    
            <div class="link-description">
			<?=$val["description"]?>
            </div>
            <div class="link-info">
            	<span class="time ">Created: <?=date("d M Y",strtotime($val["created"]))?></span>
                <span class="owner ">Owner: <?=$val["creator"]?$val["creator"]:"Administrator"?></span>
            </div>
            
        </td>
        <td style="text-align:right;padding-right:10px">
        	<?php echo $val["click_count"]?$val["click_count"]:0;?>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<br>
<?php $page_link=$this->pagination->create_links(); ?>
<div class="rows-fluid pagination_bar box_quote">

<div class="span4">
	<div style="vertical-align:bottom;line-height:30px">
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
<div class="span8">
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
Rows/page:<?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select' class='input-mini'")?>	
</span>

</div><!-- end span 6-->
<div class="clearfix" style="height:30px"></div>
</div><!-- end row pagination-->
</div></div>
</div>

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
			var cat_id =$("#cat_id").val()||"";
			
			var data=[];
			if(q){
				data.push("q="+q);
			}
			if(cat_id){
				data.push("cat_id="+cat_id);
			}
			if((pp)&&(pp!=10)){
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