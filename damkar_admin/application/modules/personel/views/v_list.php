
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
            <li  class="active">Personel</li>
          
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
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>

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
				</ul>
			</div>
			<!-- <form class="search_form col-md-3 pull-right" action="#" method="get">
				<div style="padding-top:5px;" class="input-group">
              <input id="valueparameter" name="q" class="form-control input-search" value="<?=$key?>" placeholder="Search..." type="text">
              <span class="input-group-btn">
                <a id="btnsearch" href="<?=base_url()?>personel/personel/index/0/10/1" class="btn btn-default"><i class="fa fa-search"></i></a>
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
                                    <label>Sektor</label>
                                    <select class="form-control" id="idSektor" name="sektor">
                                        <option value="">--All--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Tingkat Kompetensi</label>
                                    <select class="form-control" id="kompetensi" name="kompetensi">
                                        <option value="">--All--</option>
                                    <? 
                                    // pre($m_propinsi);
                                    foreach ($m_kompetensi as $keyKm => $value) {
                                        // $selected="";
                                        // if($value['kode_prop']=="14"){
                                        //  $selected="selected";
                                        // }
                                    ?>
                                    <option value="<?=$value['id']?>" ><?=$value['kompetensi']?></option>
                                    <? 
                                        }


                                    ?>
                                    </select>
                                    </div>
                                </div>
        
    </div>
    <div class="row">
                      
         <div class="col-md-3">
            <div class="form-group">
            
            <label>Nama </label>
            <input type="text" class="form-control" name="nama" placeholder="nama personel"/>
                                    
            </div>
        </div>  
        <div class="col-md-3">
            <div class="form-group">
            
            <label>NIP </label>
            <input type="text" class="form-control" name="nip" placeholder="nip personel"/>
                                    
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
    <form name="frmMain" action="<?=$this->module.'del_cek'?>/<?=$page;?>" method="post" id="fdatalist">
<div id="tabs-0">
	<?php //echo message_box();?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
        <thead>
        <tr>
        <th width="20">&nbsp;</th>
        <th width="100">&nbsp;</th>
        <th width="20">No.</th>
        <th width="20">&nbsp;</th>
        <th class="forder"  rel="date"><a id="sort" href="<?=base_url()?>personel/personel/index/2/10/1/<?=$key?>">NIP <i class="fa fa-sort"></i></a></th>
        <th class="forder"  rel="title"><a id="sort" href="<?=base_url()?>personel/personel/index/3/10/1/<?=$key?>">Nama <i class="fa fa-sort"></i></a></th>
        <th>Tingkat Kompetensi</th>
        <th>Sektor</th>
        <th>Kabupaten</th>
        <th>Provinsi</th>
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
                    <td></td> 	
                    <td rel="date_col"><?=$v['nip'];?></td>
                    <td rel="title_col"><?=$v['nama'];?></td>
                    <td><?=$v['kompetensi'];?></td>
					<td><?=$v['namaSektor'];?></td>
                    <td><?=$v['namaKabupaten'];?></td>
					<td><?=$v['namaProvinsi'];?></td>
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
        </td>
      </tr>
    </table>
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
    });
        $('.ajax-spinner-bars').css("display","none"); 
        return false;
    });
 $(function(){
       
            console.log(base_url);
            // var html=style+hd+footer+$("div#print_this").html();
            // var html=$("div#print_this").html();
            // console.log(html);
            var filePdf="personel<?="_".date("YmdHis").".pdf";?>";
            var fileXls="personel<?="_".date("YmdHis").".xls";?>";

        $("a.print-pdf").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"personel/personel/pdfReport", function(data){
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
      
        $("a.print-xls").click(function(e){
            e.preventDefault();
            
            $.post(base_url+"personel/personel/xlsReport", function(data){
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

         
      
    }); 

$('#detail.detailData').on('click', function(){
             
  $page = $(this).attr('href');

     // alert($page);
            $('.ajax-spinner-bars').css("display","block"); 
            $.post(base_url+"personel/personel/detail/"+$page, function(data){
                if (data.status==true) {
                      bootbox.dialog({
                            title: "Detail Data Personel ",
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
  $('#fdata').on('change','#kabupaten',function(){

                   var propinsi =$('#propinsi').val();
                   var kabupaten =$('#kabupaten').val();
                   // alert(propinsi);
                   // var valueparameter =$('#valueparameter').val();

                    $.post(basedomain+urlPageList+'get_lookup_sektorAjax/'+propinsi+'/'+kabupaten , {actionfunction: 'showDataAjax'}, function(data){
                            
                            if (data.status==true) {
                               
                                    $('#idSektor').html(data.data); 

                                 $('.ajax-spinner-bars').css("display","none"); 
                                
                            }else{
                                   $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

                return false;
                });
</script>