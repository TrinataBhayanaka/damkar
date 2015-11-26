<script language="JavaScript">
	function onDelete(){
		if(confirm('Do you want to delete ?')==true){
			return true;
		}else{
			return false;
		}
	}
</script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?=$this->module_title?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-globe"></i> Home</a></li>
    <li class="active"><?=$this->module_title?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="alert alert-success alert-dismissible" id="message" style="display:none">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <p class="message"></p>
        </div>

        <div id="print_this">

            <div class="col-xs-12">
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="daftar">
                    <i class="fa fa-bars"></i> Daftar Sektor
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>add_sektor" id="addData">
                    <i class="fa fa-plus"></i> Input Sektor
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
                    <i class="fa fa-refresh"></i> Refresh
                </a>

                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Tabel Daftar Wilayah</h3>
                      <div class="box-tools">
                        <form action="<?=$this->module?>" method="get">
                        <?php $this->load->view("widget/search_box_db"); ?>
                        </form>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form name="frmMain" action="<?=$this->module.'del_cek'?>" method="post" OnSubmit="return onDelete();">
                            <table class="table table-hover">
                                
                                <tr>
                                <th width="70" colspan="2">
                                    &nbsp;
                                </th>
                                <th width="20">No.</th>
                                <th width="20">&nbsp;</th>
                                <th class="forder" width="100" rel="date">Kantor Sektor</th>
                                <th class="forder" width="300" rel="title">SKPD</th>
                                <th>Propinsi</th>
                                <th>Kabupaten</th>
                                <th width="50">Status</th>
                                </tr>

                                <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
                                    $tr_color=($k%2)?"#fff":"#fafafa";

                                    $id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];
                                    $url_edit = $module."edit_sektor/".$id;
                                    $url_delete = $module."delete/".$id;
                                    
                                    $status_badges = ($v['status']==1)?'<span class="label label-info">Active</span>':'<span class="label label-warning">Non Active</span>';
                                    $reg = ($v['status']==1)?"<a href='wa_reg/add/$id'><span class='label label-success'>Registrasi</span></a>":'';
                                    
                               ?>
                                            <tr>
                                                <td>
                                                <div class="form-group">
                                                    <label>
                                                      <input type="checkbox" name="chkDel[]" class="minimal" value="<?=$v['id'];?>">
                                                    </label>
                                                </div>
                                                </td>
                                                <td>
                                                    <a href="<?=$url_edit;?>" id="editData"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                    <a href="<?=$url_delete;?>/<?=$page;?>" id="deleteData"><i class="fa fa-times"></i></a>   
                                                </td>               
                                                <td><?=($data_start+$k);?></td>     
                                                <td></td>   
                                                <td rel="date_col" width="150"><?=$v['namaSektor'];?></td>
                                                <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['skpd'];?></a></td>
                                                <td><?=$v['namaProp'];?></td>
                                                <td><?=$v['namaKab'];?></td>
                                                <td><?=$status_badges;?></td>
                                            </tr>
                                            
                                    <? } }?>
                                            <tr>
                                                <td colspan="10">
                                                         <button type="submit" class="btn btn-primary"><i class="icon-trash"></i> Delete</button>
                                                </td>
                                            </tr>

                            </table>
                        </form>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <div class="displaying">
                            Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries, Rows/page: <?=$perpage;?>
                        </div>
                        <div class="pagination pagination-sm no-margin pull-right">
                            <?=$paging;?>
                        </div>
                    </div>
                  </div><!-- /.box -->


            </div>

        </div>

    </div>

</section>



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