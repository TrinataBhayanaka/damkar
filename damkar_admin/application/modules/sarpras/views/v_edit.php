<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/jquery.hotkeys.js"></script>
<!--<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/2.3.2/plugin/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="assets/js/plugin/ckeditor4.4.2/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/pluploader.js"></script>
<script type="text/javascript" src="http://www.plupload.com/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<!-- Place inside the <head> of your HTML -->
<style>
#imgcontainer .img-btn-change {
	position:absolute;
	width:100%;
	height:160px;
	line-height:160px;
	top:0;
	padding:5px;
	color:transparent;
	text-align:center;
	background:transparent;
	margin:1px;
	z-index:100;
	cursor:pointer
}
#imgcontainer .img-btn-change:hover {
	display:block;
	color:#eee;
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
}
</style>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1>Ubah Data<small> Sarana dan Prasarana </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?php echo $this->module?>" id="refresh">Sarana dan Prasarana</a> <span class="divider"></span></li>
			<li class="active">Ubah Data</li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

                        
<div style="padding:0px">
<div class="row topbar box_shadow">
    <div class="col-md-12">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>" id="refresh">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar 
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Update 
                    </a>
                </li>
            </ul>
    	<!--<form class="search_form col-md-3 pull-right" action="<?//=$this->module?>listview" method="get">
        	<?php //$this->load->view("widget/search_box_db"); ?>
        </form>-->
    </div>
</div>
<br>
<div class="row-fluid">
<ul class="nav nav-tabs" id="news-tab">
   <li class="active"><a href="#tab-edit" class="a_view"><i class="icon-plus"></i> Tambah Data</a></li>
</ul>
<!--tab content-->
<div class="tab-content">
  
<div id="tab-edit" class="tab-pane active">  
	
	<?php 
		if ($message) {
			echo '<div class="alert alert-warning alert-dismissible" >
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
              </div>';
		}
	?>
	<?php echo form_open("sarpras/sarpras/edit/".$idd,'id="fdata"');?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  
			  <div class="row">
					<div class="col-md-8">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Provinsi </label>
									<select class="form-control" id="propinsi" name="propinsi">
									<? 
									// pre($m_propinsi);
									foreach ($m_propinsi as $key => $value) {
										$selected="";
										if($value['kode_prop']==$propinsi['value']){
											$selected="selected";
										}
									?>
									<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
									<? 
										}


									?>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Kabupaten</label>
									<select class="form-control" id="kabupaten" name="kabupaten">
									<? 
									// pre($m_propinsi);
									foreach ($m_kabupaten as $key => $value) {
										$selected="";
										if($value['kode_kab']==$kabupaten['value']){
											$selected="selected";
										}
									?>
									<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
									<? 
										}


									?>
									</select></div>
								</div>
							</div>
							
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Nama Sektor </label>
									<select class="form-control" id="idSektor" name="idSektor">
									<? 
									// pre($m_propinsi);
									foreach ($m_sektor as $key => $value) {
										$selected="";
										if($value['idSektor']==$idSektor['value']){
											$selected="selected";
										}
									?>
									<option value="<?=$value['id']?>" <?=$selected?>><?=$value['namaSektor']?></option>
									<? 
										}


									?>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>SKPD </label>

									<?php echo form_input($skpd,false,'class="form-control" readonly');?>
								</div>
								</div>
							</div>
							<div class="row">
								
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Jenis SarPras</label>
									<select class="form-control" id="catSarpras" name="catSarpras">	
									<? 
									// pre($m_propinsi);
									foreach ($m_catSarpras as $key => $value) {
										$selected="";
										if($value['id']==$catSarpras['value']){
											$selected="selected";
										}
									?>
									<option value="<?=$value['id']?>" <?=$selected?>><?=$value['jenisSarpras']?></option>
									<? 
										}


									?>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Kondisi </label>

									<select class="form-control" id="kondisi" name="kondisi">	
										<? 
											$m_kondisi = array('B'=>'Baik','RR'=>'Rusak Ringan','RB'=>'Rusak Berat');
											foreach ($m_kondisi as $key => $value) {
												$selected="";
												if($key==$kondisi['value']){
													$selected="selected";
												}
										?>		
												<option value="<?=$key?>" <?=$selected?>><?=$value?></option>
										<?
											}
										?>
									</select>
								</div>
								</div>
							</div>
					</div> <!-- span6 -->
				<!-- 	<div class="col-md-4">
						<div id="attachment_frame" class="form-group">
							<span class="help-block" style="display:inline">Lampiran Tanda Pengenal (Max : 200Kb)</span>
							<div id="imgcontainer">
								<div id="preview" style="width:100%; height:180px;" class="img-thumbnail"><?php echo $image_canvas;?></div>
								<div id="btn-change" class="img-btn-change"><span><i class="icon-pencil"></i> &nbsp;Attachment</span></div>
							</div>
							<input id="image_name" type="hidden" name="image_name" />
						</div>
					</div> -->
					
				</div>
				
			</div>
		</div>
	</div>

	<div class="container" style="background-color:#F5F5F5;margin-top:20px;margin-bottom:20px;">
	
	<!--tab content-->
	  <br>
		<div class="form-actions">
			<button type="submit" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn">Batal</button>
		</div>
		<br />
	</div>
	<?php echo form_close();?>

</div>
<div id="tab-view" class="tab-pane">    
    <div class="row-fluid">
	    <div class="span9">
            <div class="row-fluid">
                <div class="span12">
                    <h1 id="title-view"></h1>
                    <p>
                    <blockquote id="news_clip-view">
                    
                    </blockquote>
                    </p>
                    <span id="canvas_view" style="float:left;margin:0;"><canvas width=0 height=0></canvas></span>
                    <p id="news_content-view">
                    
                    </p>
                </div>
            </div>
        </div> 
    </div>
    <br />
    <br />
</div>
</div>
<!-- en tab-content-->
</div>
</div>
<script>

	//callback handler for form submit
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
                  message: "<i class='fa fa-check'></i> Data Berhasil Diubah "
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
   $('#fdata').on('change','#idSektor',function(){

                   var idSektor =$('#idSektor').val();
                   // var valueparameter =$('#valueparameter').val();

                    $.post(basedomain+urlPageList+'get_lookup_skpdAjax/'+idSektor, {actionfunction: 'showDataAjax'}, function(data){
                            
                            if (data.status==true) {
                               
                                    $('#skpd').val(data.data); 

                                 $('.ajax-spinner-bars').css("display","none"); 
                                
                            }else{
                                   $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

                return false;
                });
</script>

