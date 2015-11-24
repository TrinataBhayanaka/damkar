<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> Users List</small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/"><?=$this->module_title?></a> <span class="divider"></span></li>
			<li><a href="admin/account_manager/">Users</a> <span class="divider"></span></li>
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
						<a href="<?php echo $this->module?>">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_titles?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>user_add">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_titles?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
					<!-- INI -->
					<!-- <a href="#" class="print-pdf" data-url="" title="Data Pendaftar"><i class="fam-page_white_acrobat"></i> PDF</a> -->
					<!-- END INI -->

				</ul>
			</div>
			
			<form class="search_form col-md-3 pull-right" action="<?=$this->module?>" method="get">
				<?php $this->load->view("widget/search_box_db"); ?>
			</form>
		</div>
	</div>
	
<div class="row-fluid">
<div class="span12">

<!-- INI -->
<div id="print_this">
<!-- END INI -->

<form id="frm" method="post">
<table class="table table-condensed">
	<thead>
    	<th style="width:80;"></th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Groups</th>
        <th>Status</th>
        </thead>
    <tbody>
    	<?php if(cek_array($arrData)):?>
        	<?php foreach($arrData as $x=>$value):
					$id=$this->encrypt_status==TRUE?encrypt($value[$this->tbl_idx]):$value[$this->tbl_idx];
			?>
            	<tr>
                	<td class="tc">
                    <!--<div class="btn-group"><a title="edit" class="btn" href="<?php //echo $this->module."user_edit/".$value["id"]?>"><i class="icon-edit icon-white"></i></a>  <a class="btn" title="delete" href="<?php echo $this->module."user_delete/".$value["id"]?>"><i class="icon-trash icon-white"></i></a>-->
					<a href="<?php echo $this->module."user_edit/".$id?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                    <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?php echo $this->module."user_delete/".$id?>"><i class="icon-remove icon-alert"></i></a> 
                    </div>
                    </td>
                    <td><?php echo $value["username"]?></td>
                    <td><?php echo $value["first_name"]?></td>
                    <td><?php echo $value["last_name"]?></td>
                    <td><?php echo $value["email"]?></td>
                    <td>
                    <?php //foreach ($value["groups"] as $group):?>
                            <?php //echo anchor("admin/auth/edit_group/".$group["id"], $group["name"]) ;?>
                    <?php //endforeach;?>
					<?php foreach($group_brwa as $rows){
							  $id = $rows['id'];  
							  if($id == $value['group_brwa']){
							   echo $rows['name'];
							  }
						  }
					?>
                     </td>
                    <td>
                    <? if($value["active"]):?>
                    <a href="admin/auth/deactivate/<?php echo $value["id"]?>"><span class="label label-info"><?php echo lang('index_active_link')?></span></a>		<? else:?>
                    <a href="admin/auth/activate/<?php echo $value["id"]?>"><span class="label label-info"><?php echo lang('index_inactive_link')?></span></a>	
                    <? endif;?>
                 
                </tr>
            <?php endforeach;?>
		<?php endif;?>
    </tbody>
</table>
</form>
</div>
<?php $page_link=$this->pagination->create_links(); ?>

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


</div></div><!-- end row span-->

<!-- INI -->
<script>
	// var alm = "<?=$arrAlamat['value'];?>";
	// var eml = "<?=$arrEmail['value'];?>";
	// var ktk = "<?=$arrKontak['value'];?>";
	// $(function(){
	// 	var style = "<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>";
	// 	var hd = '<htmlpageheader name=\'myHeader1\'><div style=\'text-align: right; border-bottom: 1px solid #000000; font-size: 10pt;\'><table cellspacing=\'0\' cellpadding=\'4\' width=\'100%\'><tr><td style=\'padding-left:25px;\'><img src=\'assets/image/logo-blank.png\' style=\'height:45px;\' /></td><td style=\'font-size:12px;\'><center><b>Badan Registrasi Wilayah Adat (BRWA)</b></center><p align=\'center\'>'+alm+'<br>Telp/Fax: '+ktk+' | Email: <span style=\'color:blue;text-decoration:underline;\'>'+eml+'</span> | Websie: <span style=\'color:blue;text-decoration:underline;\'>http://brwa.or.id</span></p></td></tr></table></div></htmlpageheader>';
	// 	var footer = "<htmlpagefooter name='myfooter1'><table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt;color: #000000; font-weight: bold; font-style: italic;'><tr><td width='33%'><span style='font-weight: bold; font-style: italic;'>Sumber : http://brwa.or.id</span></td><td width='33%' align='center' style='font-weight: bold; font-style: italic;'>{PAGENO}/{nbpg}</td><td width='33%' style='text-align: right; '>{DATE j-m-Y}</td></tr></table></htmlpagefooter>";
	// 	$("a.print-pdf").click(function(e){
	// 		e.preventDefault();
	// 		var base_url="<?=base_url()?>";
	// 		var html=style+hd+footer+$("div#print_this").html();
	// 		var file="wilayah_adat<?="_".date("YmdHis").".csv";?>";
	// 		UrlSubmit(base_url+"export/csv/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70,target:"_blank"});
	// 	});
	// });
</script>
<!-- END INI -->

<script>
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href$='"+act_link+"']").parent("li").addClass("active");
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
