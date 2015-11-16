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
    <div class="scol-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> </small></h1>
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
        <th style="width:40px" class="fixed-column">#</th>
        <th style="width:220px">No SK</th>
        <th style="width:130px">Tanggal SK</th>
        <th style="width:200px">Kabupaten/Kota</th>
        <th style="">Berbatasan dengan:</th>
         <th style="width:230px">UU Pembentukan</th>
        
        </tr>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):?>
            	
            	
            	<? 
					
					$id=$this->encrypt_status==TRUE?encrypt($val[$this->tbl_idx]):$val[$this->tbl_idx];
				?>	
            	<tr >
                	<td><?=$this->pagination->cur_page+$x+1; ?></td>
                    <td class="tc">
                    <div class="btn-group"><a title="profile" class="btn btn-xs btn-info" href="<?php echo $this->module."view/".$id?>"><i class="icon-search icon-white"></i></a></div></td>
                	<td valign="top"><?php echo $val["no_sk"]?></td>
                    <td valign="top"><?php echo date2indo($val["tanggal_terbit_sk"])?></td>
					<td valign="top"><?php echo $val["kabupaten_1"]?><br><?php echo " (<b>".strtoupper($val["propinsi_1"])."</b>)"?></td>
                    
                    <td><? 
						$arrPropinsi=m_lookup("propinsi","kode_bps","nama");
						$arr=$this->conn->GetAll("select * from tb_batas_kabupaten_detail where id_parent=".$val["idx"]);
						$data_kabupaten=array();
						if(cek_array($arr)):
							foreach($arr as $xx=>$valx):
								$data_kabupaten[$valx["id_propinsi_2"]][]=$valx;
							endforeach;
						endif;
						
						if(cek_array($data_kabupaten[$val["id_propinsi_1"]])):
							echo "<ol style='padding-left:1em'>";
							foreach($data_kabupaten[$val["id_propinsi_1"]] as $kab):
								echo "<li>{$kab['kabupaten_2']}</li>";
							endforeach;
							echo "</ol>";
						endif;
						
						unset ($data_kabupaten[$val["id_propinsi_1"]]);
					?>
                    <? if(cek_array($data_kabupaten)):?>
                    	<? foreach($data_kabupaten as $xx=>$val_prop):?>
                        	
                        	<ol style="padding-left:1em"><?php echo "<b>".strtoupper($arrPropinsi[$xx])."</b>:<br>";?>
                            	<? foreach($val_prop as $val_kab):?>	
									<li><?=$val_kab["kabupaten_2"]."<br>"; ?></li>
								<? endforeach; ?>
                                </ol>
                        <? endforeach;?>
					<? endif;?>
                    </td>
                    
                    <td>
                    	<? if(cek_var($dataUU[$val["idx"]])):?>
                        	 <? $data_uu=$dataUU[$val["idx"]]["data_uu"];
							 	$data_id=$dataUU[$val["idx"]]["id_uu"];
								$data_uu_arr=preg_split("/\;/",str_replace("|"," Tentang ",$data_uu));
							 ?>
                             <? if(cek_array($data_uu_arr)):?>
                             	<ol style="padding-left:1em">
								<? foreach($data_uu_arr as $xx=>$valx):?>
                                	<li><?=$valx?></li>
								<? endforeach;?>
							 	</ol>
							 <? endif;?>
						<? endif;?>
                    </td>
                    
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</div><!-- end:table responsive -->

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

<? //$this->load->view("active_menu");?>