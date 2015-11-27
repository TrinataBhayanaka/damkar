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
    <li><a href="admin/dashboard"><i class="fa fa-globe"></i> Home</a></li>
    <li><a href="bencana"> <?=$this->module_title?></a></li>
    <li class="active">Edit Data Bencana</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-xs-12">
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>" id="daftar">
            	<i class="fa fa-bars"></i> Daftar Wilayah
			</a>
			<a class="btn btn-app bg-purple" href="<?php echo $this->module?>add_wilayah" id="addData">
				<i class="fa fa-plus"></i> Input Wilayah
			</a>

			<?php 
				// pre($propinsi['value']);				  
				// pre($m_propinsi);	
				if ($message) {
					echo '<div class="alert alert-warning alert-dismissible" >
		                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
		              </div>';
				}
									
			?>

			<?php echo form_open("wilayah/edit_wilayah".$id,'id="fdata"');?>
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
											<?//=form_dropdown("propinsi",$m_propinsi,$propinsi['value'],"id='propinsi' class='form-control required'");?>
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
											<?php// echo form_input($kabupaten,false,'class="form-control required"');?>
											<select class="form-control" id="kabupaten" name="kabupaten">
												<? 
												foreach ($m_kabupaten as $key => $value) {
													$selected="";
													if($value['kode_kab'] == $kabupaten['value']){
														$selected="selected = selected";
													}
												?>
												<option value="<?=$value['kode_kab']?>" <?=$selected?>><?=$value['nama']?></option>
												<? 
													}


												?>
											</select>
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
	            <div class="box-footer">
	             	<div class="form-actions">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="reset" class="btn">Batal</button>
					</div>
	             </div>
			</div>
			<?php echo form_close();?>

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
	</div>

</section>

<script> 
$(document).ready(function() {
$('#fdata').on('change','#propinsi',function(){
		var basedomain = '<?=base_url()?>';
 		var parameter =$('#propinsi').val();
		var urlPageList = 'wilayah/wilayah/';
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

