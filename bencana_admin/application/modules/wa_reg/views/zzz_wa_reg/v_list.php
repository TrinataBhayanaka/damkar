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
.simplecolorpicker{
		border:thin solid #DADADA !important;
	}
</style>

<?php
	$arrLookupGroup=m_lookup("event_categories","id_name","name",""," order by order_num asc "); 
	
									$arrColor=
													array(
													"#3a87ad"=>"#3a87ad",	
													"#ac725e"=>"#ac725e",
													"#d06b64"=>"#d06b64",
													"#f83a22"=>"#f83a22",
													"#fa573c"=>"#fa573c",
													"#ff7537"=>"#ff7537",
													"#ffad46"=>"#ffad46",
													"#42d692"=>"#42d692",
													"#16a765"=>"#16a765",
													"#7bd148"=>"#7bd148",
													"#b3dc6c"=>"#b3dc6c",
													"#fbe983"=>"#fbe983",
													"#fad165"=>"#fad165",
													"#92e1c0"=>"#92e1c0",
													"#9fe1e7"=>"#9fe1e7",
													"#9fc6e7"=>"#9fc6e7",
													"#4986e7"=>"#4986e7",
													"#9a9cff"=>"#9a9cff",
													"#b99aff"=>"#b99aff",
													"#c2c2c2"=>"#c2c2c2",
													"#cabdbf"=>"#cabdbf",
													"#cca6ac"=>"#cca6ac",
													"#f691b2"=>"#f691b2",
													"#cd74e6"=>"#cd74e6",
													"#a47ae2"=>"#a47ae2",
													"#ffffff"=>"#ffffff",
													"#000000"=>"#000000"
													);
												
?>
<?php
//$this->load->view("page_header");
?>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Event Group<small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Master Data</a> <span class="divider"></span></li>
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
                <!--<li>
                    <a href="<?php //echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?//=$this->module_title?>
                    </a>
                </li>-->
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
<table class="table table-hover small-font">
	<thead>
    	<tr>
        <th style="width:10px">No</th>
        <th style="width:40px">#</th>
        <th>Nama Kewilayahan</th>
        
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
                    <td valign="top"><?php echo $val["nama_kewilayahan"]?></td>
                	
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

<link rel="stylesheet" href="assets/js/plugin/jquery-colorpicker/jquery.simplecolorpicker.css">
<link rel="stylesheet" href="assets/js/plugin/jquery-colorpicker/jquery.simplecolorpicker-regularfont.css"/>
<link rel="stylesheet" href="assets/js/plugin/jquery-colorpicker/jquery.simplecolorpicker-glyphicons.css"/>
<script src="assets/js/plugin/jquery-colorpicker/jquery.simplecolorpicker.js"></script>


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