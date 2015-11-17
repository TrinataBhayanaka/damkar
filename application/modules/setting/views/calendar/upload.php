<div class="row">
<div class="col-md-2">
	<ul class="nav nav-tabs nav-stacked">
          <li><a href="<?=base_url()?><?=$this->module?>">Calendar</a></li>
          <li class="active"><a href="javascript:void()">Upload Hari Libur</a></li>
        </ul>
</div>

<div class="col-md-7">
<?php echo portlet_simple_start();?>
<div class="fields">
<h2 class="title">Upload Kalender Nasional (Excel)</h2>
<!--<form action="<?=base_url()?>data/lppmhp/read_file/" class="form-horizontal" id="frmUpload" method="post"
enctype="multipart/form-data">-->
<form action="<?=base_url()?><?=$this->module?>do_upload/" class="form-horizontal" id="frm" method="post"
enctype="multipart/form-data">
  <fieldset>
        <div class="form-group">	
        	<div class="col-md-6">
        	<!--<label for="kode_lpp" class="control-label">Pilih File</label>-->
            <input name="userfile" class="input-file input-xlarge required" type="file" />
            </div>
        </div>
        <!-- /control-group kode_lpp-->
   
  		<div class="form-actions">
        	<button name="upload" type="submit" class="btn btn-primary save"><i class="icon-upload"></i>Upload</button>
        	<button type="reset" class="btn btn-danger">Reset</button>
        </div>
 
  </fieldset>
</form>
</div><!--//fields-->
<br><br>
<div class="alert alert-warning">
	<strong>Keterangan</strong><br>
	<ol>
    	<li>Download template excel dengan klik menu "download template" disamping</li>
        <li>Selesai download buka file excel dan isi data pada file lpp excel</li>
        <li>Simpan file excel , kemudian upload file excel yang sudah di isi</li>
        <li>Ikuti proses sampai selesai</li>
    </ol>
</div>
<?php echo portlet_simple_end();?>
</div> <!-- /span -->

<div class="col-md-3">
	<div class="well">
	<ul class="nav nav-list">
    	<li><a href="/download template" id="download_template"><i class="icon-download"></i> Download Template</a>
        </li>
    </ul>
    </div>    
</div>
</div><!-- /row -->

<script>
	$(function(){
		 $("#frm").validate({
		 	ignore:[]
		 });
		 
		 $("a#download_template").click(function(e){
			e.preventDefault();
			location="<?=base_url().$this->module."download_template";?>";
		 });	
		
	 });
</script>

<script>
	$(function(){
		var act_link="<?=substr(trim($this->module), 0, -1);?>";	
		$(".menu-bar").find("li.active").removeClass("active");
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").addClass("active");
	});
</script>