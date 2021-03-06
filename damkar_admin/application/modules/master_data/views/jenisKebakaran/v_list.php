
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
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
				</ul>
			</div>
			<form class="search_form col-md-3 pull-right" action="#" method="get">
				<div style="padding-top:5px;" class="input-group">
              <input id="valueparameter" name="q" class="form-control input-search" value="<?=$key?>" placeholder="Search..." type="text">
              <span class="input-group-btn">
                <a id="btnsearch" href="<?=base_url()?>master_data/jenisKebakaran/index/0/10/1" class="btn btn-default"><i class="fa fa-search"></i></a>
              </span>
            </div>
			</form>
		</div>
	</div>
    <div class="alert alert-success alert-dismissible" id="message" style="display:none">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <p class="message"></p>
      </div>
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
        <th width="50">&nbsp;</th>
        <th width="20">No.</th>
        <th width="20">&nbsp;</th>
        <th>Kategori Kebakaran</th>
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
                    	<a href="<?=$url_edit;?>" id="editData"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                        <a href="<?=$url_delete;?>/<?=$page;?>" id="deleteData"><i class="icon-remove icon-alert"></i></a>   
                    </td>               
                    <td><?=($data_start+$k);?></td> 	
                    <td></td> 
                    <td><?=$v['catKebakaran'];?></td>
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

    //callback handler for form submit
$('#fdatalist').submit(function(event) {

    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");

    bootbox.confirm("<h4>Anda yakin akan menghapus data ini?</h4>", function(result){ 
            
      if(result==true){
    $('.ajax-spinner-bars').css("display","block"); 
        $.ajax({
            type        : 'POST', 
            url         : formURL, 
            data        : postData,
            dataType    : 'json', 
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
    // }
    return false;
});
 
</script>