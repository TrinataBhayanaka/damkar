<script language="JavaScript">
	function onDelete(){
		if(confirm('Do you want to delete ?')==true){
			return true;
		}else{
			return false;
		}
	}
</script>
<style>
#fdatalist th,table{
    border:1px solid #F0F0F0;
}
</style>
<div class="row">
    <div class="col-sm-12 col-lg-12">
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
             <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=base_url()?>/register/register">Content</a> <span class="divider"></span></li>
            <li class="active"><?=$this->module_title?></li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

<div style="padding:0px;">
	<div class="row topbar box_shadow">
		<div class="col-md-12">
			<div class="pull-left">
				<ul class="tab-bar grey-tab">
					<li class="active">
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_title?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>add_bencana" id="addData">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_title?>
						</a>
					</li>
                    <!--<li>
                        <a href="<?php echo $this->module?>kejadian/importData">
                            <span class="block text-center">
                                <i class="icon-plus"></i> 
                            </span>
                            Import <?=$this->module_title?>
                        </a>
                    </li>-->
					<li>
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
                    <!--<li>
                        <a href="#" class="print-pdf" data-url="" title="Data Pendaftar">
                            <span class="block text-center">
                                <i class="fam-page_white_acrobat"></i>
                            </span> 
                            Eksport PDF
                        </a>
                    </li>

                    <li>
                        <a href="#" class="print-xls" data-url="" title="Data Pendaftar">
                            <span class="block text-center">
                                <i class="fam-page_white_acrobat"></i>
                            </span> 
                            Eksport Excel
                        </a>
                    </li>-->
				</ul>
			</div>
			<form class="search_form col-md-3 pull-right" action="<?=$this->module?>" method="get">
				<?php $this->load->view("widget/search_box_db"); ?>
			</form>
		</div>
	</div>
    <div class="alert alert-success alert-dismissible" id="message" style="display:none">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <p class="message"></p>
      </div>
     <div id="print_this">
    <form name="frmMain" action="<?=$this->module.'del_cek'?>/<?=$page;?>" method="post" id="fdatalist" style="overflow:scroll" OnSubmit="return onDelete();">
	
<?php //echo message_box();?>
    
        <table width="100%" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
        <thead>
        <tr>
        <td width="20"  rowspan="2">&nbsp;</td>
        <td width="50"  rowspan="2">&nbsp;</td>
        <th width="20" rowspan="2" colspan="2" class="text-center">No.</th>
        <th rowspan="2"  class="forder text-center" width="100" rel="date" colspan="2">Provinsi</th>
        <th rowspan="2"  class="forder  text-center" width="300" rel="title" colspan="2">Kabupaten</th>
        <th rowspan="2" colspan="2" class="text-center">Jenis Bencana</th>
        <th class="text-center"  colspan="2">Waktu Kejadian</th>
        <th class="text-center" colspan="3">Korban Jiwa</th>
        <th class="text-center"  colspan="3">Kerusakan</th>
        </tr>
        <tr>
            <th class="text-center">tgl/bln/thn Awal</th>
            <th class="text-center">tgl/bln/thn Akhir</th>
            <th class="text-center">Meninggal</th>
            <th class="text-center">Hilang</th>
            <th class="text-center">Terluka</th>
            <th class="text-center">Rumah</th>
            <th class="text-center">Fasilitas Pendidikan</th>
            <th class="text-center">Fasilitas Kesehatan</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
  		$tr_color=($k%2)?"#fff":"#fafafa";

		$id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];
		$url_edit = $module."edit_bencana/".$id;
		$url_delete = $module."delete/".$id;
		
		$status_badges = ($v['status']==1)?'<span class="label label-info">Active</span>':'<span class="label label-warning">Non Active</span>';
		$reg = ($v['status']==1)?"<a href='wa_reg/add/$id'><span class='label label-success'>Registrasi</span></a>":'';
		
   ?>
            	<tr>
					<td>
                    <input type="checkbox" name="chkDel[]" value="<?=$v['id'];?>">
                    </td>
                    <td>
                    	<a href="<?=$url_edit;?>" id="editData"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                        <a href="<?=$url_delete;?>/<?=$page;?>" id="deleteData"><i class="icon-remove icon-alert"></i></a>   
                    </td>               
                    <td><?=($data_start+$k);?></td> 	
                    <td colspan = "3" rel="title_col"><?=$v['namaProp'];?></td>
                    <td colspan = "2" rel="title_col"><?=$v['namaKab'];?></td>
                    <td colspan = "2" rel="title_col"><?=$v['jenisbencana'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['tglawal'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['tglakhir'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['meninggal'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['hilang'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['terluka'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['rumah'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['fsltspendidikan'];?></td>
                    <td colspan = "" rel="title_col"><?=$v['fsltskesehatan'];?></td>
                </tr>
                
        <? } }?>
        		<tr>
                	<td colspan="2">
                             <button type="submit" class="btn btn-primary"><i class="icon-trash"></i> Delete</button>
				    </td>
                </tr>
        </tbody>
        </table>
		</form>
    </div>
        <div class="row tables_info">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="displaying">Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries,</div>
                        <div class="displaying">
                            Rows/page:   
                        </div>
                        <div class="displaying">
                            <?=$perpage;?>    
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-md-8">
                <?=$paging;?>
            </div>
        </div>
</div>


<br />
<br />
</div>
<script>
var forder='<?=$forder;?>';
var dorder='<?=$dorder;?>';
var query ='<?=($key)?"?q=".$key:"";?>';
$(document).ready(function () {
	
	$(".page_record").change(function(){
		//alert("masuk");
		var order=(forder!='' && dorder!='')?forder+':'+dorder:0;
		var page_record = $(this).val();
		var url = '<?=$module;?>index/'+order+'/'+page_record+'/1'+query;
		window.location.href=url;
	});
	
})
</script>