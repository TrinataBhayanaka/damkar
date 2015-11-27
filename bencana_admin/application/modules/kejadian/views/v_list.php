<style>
#fdatalist th,table{
    border:1px solid #F0F0F0;
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?=$this->module_title?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="glyphicon glyphicon-fire"></i> Home</a></li>
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
                    <i class="fa fa-bars"></i> Daftar Kejadian
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="addData">
                    <i class="fa fa-plus"></i> Input Kejadian
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>kejadian/importData">
                    <i class="fa fa-upload"></i> Import Data
                </a>
                <a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
                    <i class="fa fa-refresh"></i> Refresh
                </a>

                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Tabel Daftar Kejadian</h3>
                      <div class="box-tools">
                        <form action="<?=$this->module?>" method="get">
                        <?php $this->load->view("widget/search_box_db"); ?>
                        </form>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form name="frmMain" action="<?=$this->module.'del_cek'?>/<?=$page;?>" method="post" id="fdatalist" style="overflow:scroll">
                            <table class="table table-hover">
                                
                                <tr>
                                <th width="70" colspan="2" rowspan="2">
                                    &nbsp;
                                </th>
                                    <th width="20" rowspan="2"colspan="2" class="text-center">No.</th>
                                    <th width="20" rowspan="2"colspan="2" class="text-center">No Kejadian</th>
                                    <th class="forder text-center" width="100" rel="date" colspan="2">Provinsi</th>
                                    <th class="forder  text-center" width="300" rel="title" colspan="2">Kabupaten</th>
                                    <th rowspan="2" class="text-center">Bencana/Kejadian</th>
                                    <th class="text-center">Waktu Kejadian</th>
                                    <th class="text-center" colspan="4">Korban Meninggal</th>
                                    <th class="text-center">Penyebab</th>
                                    <th class="text-center">Objek</th>
                                    <th class="text-center">Nilai Kerugian</th>
                                    <th width="50" class="text-center">Jumlah Pengusian</th>
                                </tr>
                                <tr>
                                    <th class="text-center">kode</th>
                                    <th class="text-center">nama</th>
                                    <th class="text-center">kode</th>
                                    <th class="text-center">nama</th>
                                    <th class="text-center">tgl/bln/thn</th>
                                    <th class="text-center">Meninggal</th>
                                    <th class="text-center">hilang</th>
                                    <th class="text-center">terluka</th>
                                    <th class="text-center">mengungsi</th>
                                </tr>


                                <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
                                    $tr_color=($k%2)?"#fff":"#fafafa";

                                    $id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];
                                    $url_edit = $module."edit/".$id;
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
                                                <td rel="date_col" width="150" colspan="2"><?=$v['noKejadian'];?></td>
                                                <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['kodePropinsi'];?></a></td>
                                                <td><?=$v['namaProp'];?></td>
                                                <td><?=$v['kodeKabupaten'];?></td>
                                                <td><?=$v['namaKab'];?></td>
                                                <td><?=$v['kejadian'];?></td>
                                                <td><?=$v['waktuKejadian'];?></td>
                                                <td><?=$v['meninggal'];?></td>
                                                <td><?=$v['hilang'];?></td>
                                                <td><?=$v['terluka'];?></td>
                                                <td><?=$v['mengungsi'];?></td>
                                                <td><?=$v['penyebab'];?></td>
                                                <td><?=$v['objek'];?></td>
                                                <td><?=$v['nilaiKerugian'];?></td>
                                                <td><?=$v['jumlahPengungsian'];?></td>
                                            </tr>
                                            
                                    <? } }?>
                                            <tr>
                                                <td colspan="10">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Delete</button>
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

    //callback handler for form submit
$('#fdatalist').submit(function(event) {

        if(confirm('Anda yakin akan menghapus data ini?')==true){

            $('.ajax-spinner-bars').css("display","block"); 
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : formURL, // the url where we want to POST
                data        : postData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
            })
                // using the done promise callback
                .done(function(data) {

                    // log data to the console so we can see
                    $('#dataAjax').html(data.data); 
                    $('.ajax-spinner-bars').css("display","none"); 

                    // here we will handle errors and validation messages
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        }
        return false;
    });
 
</script>

<script>
    var alm = "<?=$arrAlamat['value'];?>";
    var eml = "<?=$arrEmail['value'];?>";
    var ktk = "<?=$arrKontak['value'];?>";
    $(function(){
        var style = "<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>";
        var hd = '<htmlpageheader name=\'myHeader1\'><div style=\'text-align: right; border-bottom: 1px solid #000000; font-size: 10pt;\'><table cellspacing=\'0\' cellpadding=\'4\' width=\'100%\'><tr><td style=\'padding-left:25px;\'><img src=\'assets/image/logo-blank.png\' style=\'height:45px;\' /></td><td style=\'font-size:12px;\'><center><b>Badan Registrasi Wilayah Adat (BRWA)</b></center><p align=\'center\'>'+alm+'<br>Telp/Fax: '+ktk+' | Email: <span style=\'color:blue;text-decoration:underline;\'>'+eml+'</span> | Websie: <span style=\'color:blue;text-decoration:underline;\'>http://brwa.or.id</span></p></td></tr></table></div></htmlpageheader>';
        var footer = "<htmlpagefooter name='myfooter1'><table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt;color: #000000; font-weight: bold; font-style: italic;'><tr><td width='33%'><span style='font-weight: bold; font-style: italic;'>Sumber : http://brwa.or.id</span></td><td width='33%' align='center' style='font-weight: bold; font-style: italic;'>{PAGENO}/{nbpg}</td><td width='33%' style='text-align: right; '>{DATE j-m-Y}</td></tr></table></htmlpagefooter>";
        $("a.print-pdf").click(function(e){
            e.preventDefault();
            var base_url="<?=base_url()?>";
            console.log(base_url);
            // var html=style+hd+footer+$("div#print_this").html();
            var html=$("div#print_this").html();
            console.log(html);
            var file="wilayah_adat<?="_".date("YmdHis").".pdf";?>";
            UrlSubmit(base_url+"export/proxy_pdf/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70,target:"_blank"});
        });
    });
</script>