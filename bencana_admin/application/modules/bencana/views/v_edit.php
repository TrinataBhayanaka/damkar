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

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?=$this->module_title?>
    <small>Edit Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-file-text"></i> Home</a></li>
    <li><a href="wilayah/wilayah"> <?=$this->module_title?></a></li>
    <li class="active">Edit Data Wilayah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-xs-12">

			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="daftar">
            	<i class="fa fa-bars"></i> Daftar Bencana
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>add_bencana" id="addData">
				<i class="fa fa-plus"></i> Input Bencana
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="refresh">
				<i class="fa fa-refresh"></i> Refresh
			</a>


			<?php 
				if ($message) {
					echo '<div class="alert alert-warning alert-dismissible" >
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
		              </div>';
				}
			?>
			<?php echo form_open("bencana/edit_bencana",'id="fdata"');?>
			<input type="hidden" name="id" value="<?=$idd;?>" />

				<div class="box box-default">
					<div class="box-header with-border">
		              <h3 class="box-title">Edit Data</h3>
		              <div class="box-tools pull-right">
		                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
		              </div>
		            </div><!-- /.box-header -->
		            <div class="box-body">

		            <div class="row">
						<div class="col-md-12">
						  
						  <div class="row">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
												
												<label>Provinsi </label>
												<select class="form-control" id="propinsi" name="propinsi">
													<?php 
													// pre($m_propinsi);
													foreach ($m_propinsi as $key => $value) {
														$selected="";
														if($value['kode_prop']==$propinsi['value']){
															$selected="selected = selected";
														}
													?>
													<option value="<?=$value['kode_prop']?>" <?=$selected?>><?=$value['nama']?></option>
													<?php 
														}

													?>
												</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												
												<label>Kabupaten </label>
												<select class="form-control" id="kabupaten" name="kabupaten">
													<?php 
													// pre($m_propinsi);
													foreach ($m_kabupaten as $key => $value) {
														$selected="";
														if($value['kode_kab'] == $kabupaten['value']){
															$selected="selected = selected";
														}
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
											<div class="col-md-4">
												<div class="form-group">
												
												<label>Tanggal Awal </label>
												<input type="hidden" id="tglawal" name="tglawal" value="<?php echo date("Y-m-d",strtotime($tglawal['value']));?>" />
												<input type="text" id="tglawal_" name="tglawal_" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tglawal['value']));?>" />
												
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												
												<label>Tanggal Akhir </label>
												<input type="hidden" id="tglakhir" name="tglakhir" value="<?php echo date("Y-m-d",strtotime($tglakhir['value']));?>" />
												<input type="text" id="tglakhir_" name="tglakhir_" class="dp1 form-control" value="<?php echo date("d/m/Y",strtotime($tglakhir['value']));?>" />
												
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
												
												<label>Jenis Bencana </label>
												<?php echo form_input($jenisbencana,false,'class="form-control"');?>
												</div>
											</div>
										</div>

										<div class="row" >
											<div class="col-md-12" >
												<h3 style="border-top:10px solid #F3F3F3;padding-top:10px">Korban Jiwa</h3>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
												<label>Meninggal</label>
												<?php echo form_input($meninggal,false,'class="form-control IsInteger"');?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
												<label>Hilang</label>
												<?php echo form_input($hilang,false,'class="form-control IsInteger"');?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
												<label>Terluka</label>
												<?php echo form_input($terluka,false,'class="form-control IsInteger"');?>
												</div>
											</div>
										</div>

										<div class="row" >
											<div class="col-md-12" >
												<h3 style="border-top:10px solid #F3F3F3;padding-top:10px">Kerusakan</h3>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
												<label>Rumah</label>
												<?php echo form_input($rumah,false,'class="form-control IsInteger"');?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
												<label>Fasilitas Pendidikan</label>
												<?php echo form_input($fsltspendidikan,false,'class="form-control IsInteger"');?>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
												<label>Fasilitas Kesehatan</label>
												<?php echo form_input($fsltskesehatan,false,'class="form-control IsInteger"');?>
												</div>
											</div>
										</div>
										
										
								</div> <!-- span6 -->
								
							</div>
								
							</div>
							
						</div>

		            </div>
		            <div class="box-footer">
		             	<div class="form-actions">
							<button type="submit" class="btn btn-success">Simpan</button>
							<button type="reset" class="btn">Batal</button>
						</div>
	             	</div>
		        </div>

			<?php echo form_close();?>

		</div>
	</div>

</section>

<script>
//js here
//Uploader
$(function(){

	tgl_lahir = $('.dp1').datepicker({
		format:"dd/mm/yyyy"
	}).on('changeDate', function(ev){
		var newDate = new Date(ev.date);
		$("#tglawal").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$("#tglakhir").val(newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate());
		$('.dp1').datepicker('hide');
	}).data('datepicker');
	
	$('.dp1').on("keyup",function(){
		setValDate(tgl_lahir,"#tglawal");
		setValDate(tgl_lahir,"#tglakhir");
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
		var urlPageList = 'bencana/';
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

});
</script>

