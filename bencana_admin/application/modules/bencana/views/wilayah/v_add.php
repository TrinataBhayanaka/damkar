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
                    <h1>User<small> Add </small></h1>
                </div><!-- col -->
            </div><!-- row-->
        </div><!-- end: page-header -->
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>register/register"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Content</a> <span class="divider"></span></li>
			<li><a href="<?=$this->folder?>"><?=$this->module_title?></a> <span class="divider"></span></li>
            <li class="active">Add</li>
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
                <li>
					<a href="<?php echo $this->module?>" id="addData">
						<span class="block text-center">
							<i class="icon-refresh"></i> 
						</span>	
						Refresh
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
	<?php echo form_open("wilayah/addAjax",'id="fdata"');?>
	<input type="hidden" name="idx" value="<?=$data['id'];?>" />
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  
			  <div class="row">
					<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
									
									<label>Provinsi </label>
									<?=form_dropdown("propinsi",$m_propinsi,$propinsi['value'],"id='propinsi' class='form-control required'");?>

									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									
									<label>Kabupaten </label>
									<?php echo form_input($kabupaten,false,'class="form-control required"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
									
									<label>Luas Wilayah </label>
									<?php echo form_input($luasWilayah,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
									
									<label>Jumlah Kecamatan </label>
									<?php echo form_input($jumlahKecamatan,false,'class="form-control"');?>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
									
									<label>Jumlah Penduduk </label>
									<?php echo form_input($jumlahPenduduk,false,'class="form-control"');?>
									</div>
								</div>
							</div>

							<div class="row" >
								<div class="col-md-12" >
									<h2 style="border-top:10px solid #F3F3F3;padding-top:10px">Rasio Capaian(SPM)</h2>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
									<label>Cakupan</label>
									<?php echo form_input($cakupan,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Respon Time</label>
									<?php echo form_input($responTime,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Rasio Personel</label>
									<?php echo form_input($rasioPersonel,false,'class="form-control"');?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label>Rasio SarPras</label>
									<?php echo form_input($rasioSarPras,false,'class="form-control"');?>
									</div>
								</div>
							</div>
							
							
					</div> <!-- span6 -->
					
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

                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
 
</script>

