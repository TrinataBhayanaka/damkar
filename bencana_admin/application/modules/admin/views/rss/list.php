<?
$result = ($key)?"Keywords: <strong>".$key."</strong>":"&nbsp;"; 
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?=$this->module_title?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-desktop"></i> Home</a></li>
    <li class="active"><?=$this->module_title?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <?php echo message_box();?> 

        <div id="print_this">

            <div class="col-xs-12">

                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>">
                    <i class="fa fa-bars"></i> Daftar Rss
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>add" id="addData">
                    <i class="fa fa-plus"></i> Input Rss
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
                    <i class="fa fa-refresh"></i> Refresh
                </a>
                
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Tabel Daftar Rss</h3>
                      <div class="box-tools">
                        <form action="<?=$this->module?>" method="get">
                        <?php $this->load->view("widget/search_box_db"); ?>
                        </form>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body  table-responsive no-padding">
                        <form name="frmMain" action="<?=$this->module.'del_cek'?>" method="post" OnSubmit="return onDelete();">
                            <table class="table table-hover table-bordered">
                                
                                <tr>
                                    <th width="70">
                                        &nbsp;
                                    </th>
                                    <th width="20">No.</th>
                                    <th width="20">&nbsp;</th>
                                    <th class="forder" width="100" rel="date">Date</th>
                                    <th class="forder" width="300" rel="title">Title/Judul</th>
                                    <th>Url</th>
                                    <!--<td class="tbldata_header forder">Alamat</td>-->
                                    <th width="100">Publish</th>
                                </tr>

                                <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
                                    $tr_color=($k%2)?"#fff":"#fafafa";
                                    $id=$this->encrypt_status==TRUE?encrypt($v[$this->tbl_idx]):$v[$this->tbl_idx];
                                    $url_edit = $module."edit/".$id;
                                    $url_delete = $module."delete/".$id;
                                    
                                    $status_badges = ($v['status'])?'<span class="label label-info">Published</span>':'<span class="label label-warning">Draft</span>';
                                    
                               ?>
                                            <tr>
                                                <td>
                                                    <!--<div class="btn-groupx">
                                                        <a href="<?//=$url_edit;?>"><i class="icon-edit icon-white"></i></a>
                                                        <a href="<?//=$url_delete;?>" ><i class="icon-trash icon-white"></i></a>
                                                    </div>-->
                                                    <a href="<?=$url_edit;?>"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                    <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$url_delete;?>"><i class="fa fa-times"></i></a>
                                                            
                                                    
                                                </td>               
                                                <!--<td class="tc">
                                                    <div class="btn-group">
                                                        <a title="Profil" class="btn btn-small btn-primary" style="margin-right:2px" href="pegawai/pegawai/edit/eU9pUW5vcWVGTjA"><i class="icon-search icon-white"></i></a>
                                                        <a class="btn btn-small btn-danger" title="delete" href="pegawai/pegawai/del/eU9pUW5vcWVGTjA"><i class="icon-remove icon-white"></i></a>
                                                    </div>
                                                </td>-->
                                                <td><?=($data_start+$k);?></td>     
                                                <td></td>   
                                                <td rel="date_col" width="150"><?=$v['date_formatted'];?></td>
                                                <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['title'];?></a></td>
                                                <td><?=$v['news_clip2'];?></td>
                                                <td><?=$status_badges;?></td>
                                            </tr>
                                    <? } }?>

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
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
		$("#button_list").click(function(){
			var key=($("#key_list").val())?$("#key_list").val():'0';
			var prc=$("#page_record").val();
			var order=(forder!='' && dorder!='')?forder+':'+dorder:0;
			window.location.href='<?=$module;?>index/'+key+'/'+order+'/'+prc+'/1';
		});
		
		$(".page_record").change(function(){
			var order=(forder!='' && dorder!='')?forder+':'+dorder:0;
			var page_record = $(this).val();
			var url = '<?=$module;?>index/'+order+'/'+page_record+'/1'+query;
			window.location.href=url;
		});
		
    })
</script>