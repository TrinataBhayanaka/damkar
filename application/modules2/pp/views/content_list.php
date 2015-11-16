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
    	<h1>Regulations <small style="display:block">Peraturan dan Perundangan</small></h1>
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
	<h4 class="heading">Regulation Type  :: <small> <?=join(" >>> ",$arrLinkIndex);?></small>
    <div class="pull-right" style="margin-top:-8px">
             <form id="frm-search" action="<?=$this->module?>link_list" method="get">
               <?
                	//load search box
					$this->load->view("widget/search_box_db");
				?>
                </form>
            </div>
    
    </h4>
   <input type="hidden" id="cat_id" name="cat_id" value="<?=$this->input->get_post("cat_id");?>">
   <input type="hidden" id="pp" name="pp" value="<?=$this->input->get_post("pp");?>">
  <table class="table table-condensed">
	<thead class="box_quote">
    	<th style="width:50px">Tahun</th>
        <th style="width:200px">No Peraturan</th>
        <th >Tentang</th>
        <th style="width:100px">Penetapan</th>
        <th style="width:100px">Berlaku</th>
        <th style="width:20px">File</th>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):?>
            	<tr>
                	<td><?php echo date("Y",strtotime($val["tgl_penetapan"]))?></td>
                    <td><?php echo $val["no_pp"]?></td>
                    <td><?php echo $val["about"]?></a></td>
                    <td><?php echo $val["tgl_penetapan"]?></a></td>
                    <td><?php echo empty($val["tgl_berlaku"])?$val["tgl_penetapan"]:$val["tgl_berlaku"]?></a></td>
                    
                    
                    <td><a href="<?=$this->module?>get_link/<?=$val["idx"]?>" target="_blank"><i class="icon-download icon-white"></i></a></td>
                    </tr>
            <?php endforeach;?>
         <? else: ?>
         <tr><td colspan="6"><span class="label label-warning">Belum ada data!!!</span></td></tr>   
		<?php endif;?>
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