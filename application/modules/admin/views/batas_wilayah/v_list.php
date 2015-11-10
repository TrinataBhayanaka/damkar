<?php
	$arrCategory=$this->arr_category;
	$arrCategory[""]="All";
	
?>
<style>

.table .table-preview img {
  width: 50px;
  height:50px;
  margin-right: 10px;
  margin-top:2px;
  float: left;
}
.table .identitas{
	float:left;
}
.table .table-preview .name {
  font-weight: bold;
  margin-top: 5px;
  display: block;
}
</style>
<?php
//$this->load->view("page_header");
?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Batas Wilayah Propinsi<small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Batas Wilayah</a> <span class="divider"></span></li>
            <li class="active"><?=$this->module_title?></li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<div class="row">
<div class="col-md-12 col-lg-12">
<?php echo message_box();?>
<? //$this->load->view("toolbar_std");?>
<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li class="active">
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->module?>listview">
                        <span class="block text-center">
                            <i class="icon-refresh"></i> 
                        </span>	
                        Refresh
                    </a>
                </li>
            </ul>
        </div>
    	<form class="search_form col-md-3 pull-right" action="<?=$this->module?>listview" method="get">
        	<?php $this->load->view("widget/search_box_db"); ?>
        </form>
    </div>
</div>

<div class="table-responsive">
<table class="table table-hover small-font table-bordered table-condensed">
	<thead>
    	<tr>
        <th style="width:10px">No</th>
        <th style="width:40px">#</th>
        <th width="210px">No SK</th>
        <th style="width:130px">Tanggal SK</th>
        <th>Perbatasan Propinsi</th>
        <th style="width:230px">UU Pembentukan</th>
        <th width="80px">Peta</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):?>
            	<?
            	$head=array("kabupaten_1","kabupaten_2");
				$head_uu=array("idx","no_peraturan","tentang");
				$head_file=array("id","file_name","file_path");
				$head_file_peta=array("id","file_name","file_path");
				
				$detail_kabupaten=$val["kabupaten"];
				$detail_kabupaten_arr=preg_split("/\;/",$detail_kabupaten);
				$data_kab_detail=array();
				foreach($detail_kabupaten_arr as $xx=>$valx):
					$data_kab_tmp=preg_split("/\|/",$valx);
					if($data_kab_tmp[0]==''):
							continue;
						endif;
					$data_kab_detail[]=array_combine($head,$data_kab_tmp);
				endforeach;
				
				
				
				$detail_uu=$val["detail_uu"];
				$data_uu_detail=array();
				$detail_uu_arr=preg_split("/\;/",$detail_uu);
				foreach($detail_uu_arr as $xx=>$valx):
					$data_uu_tmp=preg_split("/\|/",$valx);
					if($data_uu_tmp[0]==''):
							continue;
						endif;
					$data_uu_detail[]=array_combine($head_uu,$data_uu_tmp);
				endforeach;
				
				$detail_file=$val["detail_file"];
				$data_file_detail=array();
				$detail_file_arr=preg_split("/\;/",$detail_file);
				if(cek_array($detail_file_arr)):
					foreach($detail_file_arr as $xx=>$valx):
						$data_file_tmp=preg_split("/\|/",$valx);
						if($data_file_tmp[0]==''):
							continue;
						endif;
						$data_file_detail[]=array_combine($head_file,$data_file_tmp);
					endforeach;
				endif;
				
				$detail_peta=$val["detail_file_peta"];
				$data_peta_detail=array();
				
				$detail_peta_arr=preg_split("/\;/",$detail_peta);
				if(cek_array($detail_peta_arr)):
					foreach($detail_peta_arr as $xx=>$valx):
						$data_peta_tmp=preg_split("/\|/",$valx);
						if($data_peta_tmp[0]==''):
							continue;
						endif;
						$data_peta_detail[]=array_combine($head_file_peta,$data_peta_tmp);
					endforeach;
				endif;
			?>
            	
            
            	<? 
					
					$id=$this->encrypt_status==TRUE?encrypt($val[$this->tbl_idx]):$val[$this->tbl_idx];
				?>	
            	<tr >
                	<td><?=$this->pagination->cur_page+$x+1; ?></td>
                    <td class="tc">
                    <div class="btn-group"><a title="profile" class="btn btn-xs btn-info" href="<?php echo $this->module."view/".$id?>"><i class="icon-search icon-white"></i></a></div></td>
                	<td valign="top"><?php echo $val["no_sk"]?></td>
                    <td valign="top"><?php echo date2indo($val["tanggal_terbit_sk"])?></td>
                    <td valign="top"><?php echo "<b>".strtoupper($val["propinsi_1"]." - ".$val["propinsi_2"])."</b>"?>
                    	<br>
                     	<? if(cek_array($data_kab_detail)):?>
                    	<ol style="padding-left:1em">
                    	<? foreach($data_kab_detail as $xx=>$valx): ?>
                            <li><?=$valx["kabupaten_1"]?> - <?=$valx["kabupaten_2"]?></li>
                        <? endforeach;?>
                        </ol>
						<? endif;?>
					</td>
                   
                    <td>
                    	<? if(cek_array($data_uu_detail)):?>
                        <ol style="padding-left:15px">
                        <? foreach($data_uu_detail as $xx=>$valx): ?>
                            <li style="padding:0"><?=$valx["no_peraturan"]." Tentang ".$valx["tentang"]?></li>
                        <? endforeach;?>
                        </ol>
                        <? endif;?>
                    </td>
                     <td>
                    	<?=cek_array($data_peta_detail)?"Ada":"Tidak Ada";?>
                    </td>
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</div>

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

</div><!-- end span 6-->
<div class="clearfix" style="height:24px"></div>

</div><!-- end class well -->

</div><!-- end row pagination-->
</div></div><!-- end row span-->
</div><!-- end div positioning -->
<br><br>
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
<script>
	$(function(){
		var act_link="<?=substr(trim($this->module), 0, -1);?>";	
		$(".menu-bar").find("li.active").removeClass("active");
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").addClass("active");
	});
</script>

