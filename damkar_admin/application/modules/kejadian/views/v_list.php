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
                    <h1>Daftar <?=$this->module_title?><small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
             <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
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
							Daftar
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>" id="addData">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input
						</a>
					</li>
                    <li>
                        <a href="<?php echo $this->module?>kejadian/importData">
                            <span class="block text-center">
                                <i class="icon-plus"></i> 
                            </span>
                            Import
                        </a>
                    </li>
					<li>
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
                    <!-- <li>
                        <div class="btn-group">
                          <button class="btn btn-default" type="button"><i class="fa fa-download"></i> Eksport</button>
                          <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul id="menu"role="menu" class="dropdown-menu">
                            <li><a href="#" class="print-pdf" data-url="">
                                <i class="fam-page_white_acrobat"></i> PDF Kejadian</a></li>
                            <li><a href="#" class="print-xls"><i class="fa fa-file-excel-o"></i> Excel Kejadian</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"  class="print-pdf-i" data-url="">
                                <i class="fam-page_white_acrobat"></i> PDF Intensitas</a>
                            </li>
                            <li><a href="#" class="print-xls-i" data-url=""><i class="fa fa-file-excel-o"></i> Excel Intensitas</a></li>
                          </ul>
                        </div>
                    </li> -->
                    <li>
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
                                <i class="fa fa-file-excel-o"></i>
                            </span> 
                            Eksport Excel
                        </a>
                    </li>

                    <li>
                        <a href="#" class="print-pdf-i" data-url="" title="Data Pendaftar">
                            <span class="block text-center">
                                <i class="fam-page_white_acrobat"></i>
                            </span> 
                            Eksport PDF Intensitas
                        </a>
                    </li>

                    <li>
                        <a href="#" class="print-xls-i" data-url="" title="Data Pendaftar">
                            <span class="block text-center">
                                <i class="fa fa-file-excel-o"></i>
                            </span> 
                            Eksport Excel Intensitas
                        </a>
                    </li>
				</ul>
			</div>
			<!-- <form class="search_form col-md-3 pull-right" action="#" method="get">
				<div style="padding-top:5px;" class="input-group">
              <input id="valueparameter" name="q" class="form-control input-search" value="<?=$key?>" placeholder="Search..." type="text">
              <span class="input-group-btn">
                <a id="btnsearch" href="<?=base_url()?>wilayah/sektor/index/0/10/1" class="btn btn-default"><i class="fa fa-search"></i></a>
              </span>
            </div>
			</form> -->
             <input id="valueparameter" name="q" class="form-control input-search" value="<?=$key?>" placeholder="Search..." type="hidden">
		</div>
	</div>
    <div class="alert alert-success alert-dismissible" id="message" style="display:none">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <p class="message"></p>
      </div>
      <form action="<?=$this->module?>searchAjax" method="post" id="fdata">
   <div class="row">
        <div class="col-md-3">
            <div class="form-group">
            
            <label>Provinsi </label>
            <select class="form-control" id="propinsi" name="propinsi">
                <option value="">--Pilih Propinsi--</option>
            <? 
            // pre($m_propinsi);
            foreach ($m_propinsi as $keyP => $value) {
                $selected="";
                // if($value['kode_prop']=="14"){
                //  $selected="selected";
                // }
            ?>
            <option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
            <? 
                }


            ?>
            </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            
            <label>Kabupaten </label>
            <!-- <div id="kabupaten">

            </div> -->
            <select class="form-control" id="kabupaten" name="kabupaten">
                <option value="">--All--</option>
            <? 
            // pre($m_propinsi);
            foreach ($m_kabupaten as $keyK => $value) {
                $selected="";
                // if($value['kode_prop']=="14"){
                //  $selected="selected";
                // }
            ?>
            <option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
            <? 
                }


            ?>
            </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label>Kejadian</label>
            <select class="form-control" id="kejadian" name="kejadian">
                 <option value="">--All--</option>
                <? 
                // pre($m_propinsi);
                foreach ($m_kebakaran as $keyKBr => $value) {
                    // $selected="";
                    // if($value['id']==$kejadian['value']){
                    //  $selected="selected";
                    // }
                ?>
                <option value="<?=$value['id']?>"><?=$value['catKebakaran']?></option>
                <? 
                    }


                ?>
                </select>
            </div>
        </div>
                          
         <div class="col-md-3">
            <div class="form-group">
            
            <label>Nomor Kejadian </label>
            <input type="text" class="form-control" name="nomor" placeholder="Nomor Kejadian"/>
                                    
            </div>
        </div>  
    </div>
    
    <div class="row">
                      
         <div class="col-md-4">
            <div class="form-group">
            
            <label>&nbsp; </label>
          <button type="submit" class="form-control btn btn-primary"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>          
    </div>
</form>
    <form name="frmMain" action="<?=$this->module.'del_cek'?>/<?=$page;?>" method="post" id="fdatalist" >
	<?php //echo message_box();?>
    
        <table width="100%" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
        <thead>
        <tr>
        <td width="20"  >&nbsp;</td>
        <td width="100"  >&nbsp;</td>
        <th width="20" class="text-center">No.</th>
        <th ><a id="sort" href="<?=base_url()?>kejadian/kejadian/index/2/10/1/<?=$key?>">No Kejadian <i class="fa fa-sort"></a></th>
        <th class="text-center">Kejadian</th>
        <th class="text-center" >Penyebab</th>
        <th class="text-center">Objek</th>
        <th class="forder  text-center"  rel="title" >Kabupaten</th>
        <!-- <th class="forder text-center" rel="date" >Provinsi</th> -->
        <th class="forder text-center" rel="date" >Koordinat X</th>
        <th class="forder text-center" rel="date" >Koordinat Y</th>
        </tr>
        </thead>
        <tbody>
    
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
                    <input type="checkbox" name="chkDel[]" value="<?=$v['id'];?>">
                    </td>
                    <td>
                        <a href="<?=$id;?>" id="detail" class="btn btn-info detailData"><i class="icon-list"></i></a>&nbsp;&nbsp;
                    	<a href="<?=$url_edit;?>" id="editData"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                        <a href="<?=$url_delete;?>/<?=$page;?>" id="deleteData"><i class="icon-remove icon-alert"></i></a>   
                    </td>               
                    <td><?=($data_start+$k);?></td> 	
                    <td><?=$v['noKejadian'];?></td>
                    <td><?=$v['namaKejadian'];?></td>
                    <td><?=$v['penyebab'];?></td>
                    <td><?=$v['objek'];?></td>
                    <td class="text-center"><?=$v['namaKabupaten'];?></td>
                    <!-- <td class="text-center"><?=$v['namaPropinsi'];?></td> -->
                    <td class="text-center"><?=$v['x'];?></td>
                    <td class="text-center"><?=$v['y'];?></td>
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

            var base_url="<?=base_url()?>";
    //callback handler for form submit
$('#fdatalist').submit(function(event) {
    
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
        bootbox.confirm("<h4>Anda yakin akan menghapus data ini?</h4>", function(result){ 
        
          if(result==true){
            $('.ajax-spinner-bars').css("display","block"); 
            
            
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
                    $.notify({
                      message: "<i class='fa fa-check'></i> Data Berhasil Dihapus <i class='fa fa-eraser'></i>"
                    },{
                        type: 'info'
                    });
                // here we will handle errors and validation messages
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        }
    })
            
    $('.ajax-spinner-bars').css("display","none"); 
        return false;
    });
 
$('#fdata').submit(function(event) {

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
                 $.notify({
                  message: "<i class='fa fa-search'></i> Pencarian data Berhasil "
                },{
                    type: 'success'
                });
                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
</script>

<script>
    $(function(){
       
            console.log(base_url);
            // var html=style+hd+footer+$("div#print_this").html();
            // var html=$("div#print_this").html();
            // console.log(html);
            var filePdf="kejadian<?="_".date("YmdHis").".pdf";?>";
            var fileXls="kejadian<?="_".date("YmdHis").".xls";?>";
            var filePdfI="kejadian_intensitas<?="_".date("YmdHis").".pdf";?>";
            var fileXlsI="kejadian_intensitas<?="_".date("YmdHis").".xls";?>";

        $("a.print-pdf").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"kejadian/kejadian/pdfReport", function(data){
                            // console.log(data);
                            if (data.status==true) {
                               console.log(data.data);
                                    UrlSubmit(base_url+"export/proxy_pdf/",{filename:filePdf,tbl:encodeURIComponent(data.data),time:(new Date).getTime(),header_height:70,target:"_blank"});

                                   
                                    $('.ajax-spinner-bars').css("display","none");
                            }else{
                                 $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")
            
        });
         $("a.print-pdf-i").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"kejadian/kejadian/pdfReportIntensitas", function(data){
                            // console.log(data);
                            if (data.status==true) {
                               console.log(data.data);
                                    UrlSubmit(base_url+"export/proxy_pdf/",{filename:filePdfI,tbl:encodeURIComponent(data.data),time:(new Date).getTime(),header_height:70,target:"_blank"});

                                   
                                    $('.ajax-spinner-bars').css("display","none");
                            }else{
                                 $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")
            
        });
        $("a.print-xls").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"kejadian/kejadian/xlsReport", function(data){
                            // console.log(data);
                            if (data.status==true) {
                               console.log(data.data);
                                    UrlSubmit(base_url+"export/toxls/",{filename:fileXls,tbl:encodeURIComponent(data.data),time:(new Date).getTime(),header_height:70,target:"_blank"});

                                   
                                    $('.ajax-spinner-bars').css("display","none");
                            }else{
                                 $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")
            
        });
         $("a.print-xls-i").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"kejadian/kejadian/xlsReportIntensitas", function(data){
                            // console.log(data);
                            if (data.status==true) {
                               console.log(data.data);
                                    UrlSubmit(base_url+"export/toxls/",{filename:fileXlsI,tbl:encodeURIComponent(data.data),time:(new Date).getTime(),header_height:70,target:"_blank"});

                                   
                                    $('.ajax-spinner-bars').css("display","none");
                            }else{
                                 $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")
            
        });
    });

$('#detail.detailData').on('click', function(){
             
  $page = $(this).attr('href');

     // alert($page);
            $('.ajax-spinner-bars').css("display","block"); 
            $.post(base_url+"kejadian/kejadian/detail/"+$page, function(data){
                if (data.status==true) {
                      bootbox.dialog({
                            title: "Detail Data Kejadian ",
                            message: data.data,
                         
                        }
                    );
                    $('.ajax-spinner-bars').css("display","none"); 
                }else{

                    $('.ajax-spinner-bars').css("display","none"); 
                }

                        }, "JSON")
          
                return false;
                });
$('#fdata').on('change','#propinsi',function(){

                   var parameter =$('#propinsi').val();
                   // alert(parameter);
                   // var valueparameter =$('#valueparameter').val();

                    $.post(basedomain+urlPageList+'get_lookup_kabupatenAjax/'+parameter , {actionfunction: 'showDataAjax'}, function(data){
                            
                            if (data.status==true) {
                               
                                    $('#kabupaten').html(data.data); 

                                 $('.ajax-spinner-bars').css("display","none"); 
                                
                            }else{
                                   $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

                return false;
                });
</script>