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
			  //pre($m_propinsi);
		}
	?>
	<?php echo form_open("kejadian/kejadian/addAjax",'id="fdata"');?>
	<input type="hidden" name="idx" value="<?=$data['id'];?>" />
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			  
			  <div class="row">
					<div class="col-md-7">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									
									<label>Nomor Kejadian</label>
									<?php echo form_input($noKejadian,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Propinsi</label>
									<?php //echo form_input($propinsi,false,'class="form-control required"');?>
									<select class="form-control" id="propinsi" name="kodePropinsi">
										<?php 
										// pre($m_propinsi);
										foreach ($m_propinsi as $key => $value) {
											$selected="";
										?>
										<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
										<?php 
											}

										?>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Kabupaten</label>
									<?php //echo form_input($kabupaten,false,'class="form-control required"');?>
									<select class="form-control" id="kabupaten" name="kodeKabupaten">
										<?php 
										// pre($m_propinsi);
										foreach ($m_kabupaten as $key => $value) {
											$selected="";
										?>
										<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
										<?php 
											}

										?>
									</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Bencana</label>
									<?php echo form_input($kejadian,false,'class="form-control required"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Waktu Kejadian</label>
									<?php //echo form_input($waktuKejadian,false,'class="form-control required"');?>
									<input type="hidden" id="waktuKejadian" name="waktuKejadian" value="<?php echo date("Y-m-d",strtotime($waktuKejadian['value']));?>" />
									<input type="text" id="tanggal_lahir_selector" name="tanggal_lahir_selector" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($waktuKejadian['value']));?>" />
									
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label><strong>Data Korban Kejadian:</strong></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Meninggal</label>
									<?php echo form_input($meninggal,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Terluka</label>
									<?php echo form_input($terluka,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Hilang</label>
									<?php echo form_input($hilang,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Mengungsi</label>
									<?php echo form_input($mengungsi,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>&nbsp;</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Penyebab</label>
									<?php echo form_input($penyebab,false,'class="form-control required"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Objek</label>
									<?php echo form_input($objek,false,'class="form-control required"');?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Nilai Kerugian</label>
									<?php echo form_input($nilaiKerugian,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									
									<label>Jumlah Pengungsi</label>
									<?php echo form_input($jumlahPengungsian,false,'class="form-control required IsInteger"');?>
									</div>
								</div>
							</div>
							
							
							
					</div>
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
$(function(){
	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#waktuKejadian").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$('.dp1').datepicker('hide');
	}).data('datepicker');
	
	$('.dp1').on("keyup",function(){
		setValDate(tgl_lahir,"#waktuKejadian");
	});
$('.IsInteger').keypress(function (e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31
    && (charCode < 48 || charCode > 57))
        return false;
});
$('#fdata').on('change','#propinsi',function(){
	var basedomain = '<?=base_url()?>';
	var parameter =$('#propinsi').val();
	var urlPageList = 'personel/';
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
 });
</script>

