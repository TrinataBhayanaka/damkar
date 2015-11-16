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
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                <!--<li class="">
                    <a href="<?php //echo $this->module?>add_dok/<?//=$arrdata['id'];?>">
                        <span class="block text-center">
                            <i class="icon-file"></i> 
                        </span>
                        Input Dokumen <?//=$this->module_title?>
                    </a>
                </li>-->
            </ul>
        </div>
        <form class="search_form col-md-3 pull-right" action="<?=$this->module?>listuser" method="get">
        	<?php $this->load->view("widget/search_box_db"); ?>
        </form>
    </div>
</div>



    <ul class="nav nav-tabs">
 		<li class="active"><a href="javascript:;"><span class="fa fa-user"></span>  Pilih User (Step 1)</a></li>
		<li><a href="#" class="hide"><span class="fa fa-file"></span> Input Form (Step 2)</a></li>
    </ul>


<div class="table-responsive">
<?php echo message_box();?>
<table class="table table-hover small-font">
	<thead>
    	 <tr>
        <th width="20">No.</th>
        <th width="20">&nbsp;</th>
        <th class="forder" width="100" rel="date">Nama</th>
        <th class="forder" width="300" rel="title">Email</th>
        <th>Tanda Pengenal</th>
		<th>Nomor Pengenal</th>
        </tr>
    </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$val):?>
            	<? 
					
					$id=$this->encrypt_status==TRUE?encrypt($val["id"]):$val["id"];
				?>	
            	<tr >
                	<td><?=$this->pagination->cur_page+$x+1; ?></td>
                    <td></td>
                    <td rel="date_col" width="150"><a href="<?=$this->module?>add/<?=$id?>"><?=$val['nama'];?></a></td>
                    <td rel="title_col"><?=$val['email'];?></td>
                    <td><?=$val['tanda_pengenal'];?></td>
					<td><?=$val['nomor_pengenal'];?></td>
                   
                    
                	
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
		var spl=act_link.split("/");
		if(spl[0]==spl[1]){
			act_link=spl[0];
		}
		$(".menu-bar").find("li.active").removeClass("active");
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").addClass("active");
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	});
</script>

<? //$this->load->view("active_menu");?>