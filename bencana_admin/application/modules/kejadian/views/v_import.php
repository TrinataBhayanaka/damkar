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
    <small>Import Data</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-globe"></i> Home</a></li>
    <li><a href="kejadian/kejadian"> <?=$this->module_title?></a></li>
    <li class="active">Import Data Kejadian</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">

    <div class="row">
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

            <?php 
                if ($message) {
                    echo '<div class="alert alert-warning alert-dismissible" >
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>'.$message.'
                      </div>';
                }
            ?>
            <?php echo form_open_multipart("kejadian/kejadian/importDatax",'id="fdata"');?>

                <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title">Tambah Data</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputFile">Import Excel </label>
                                    <input type="file" name="userfile">
                                    <p class="help-block">Pilih file anda</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Extract</button>
                        </div>
                     </div>
                </div>

            <?php echo form_close();?>

        </div>
    </div>

</section>

<script>

	//callback handler for form submit
// $('#fdata').submit(function(event) {

        // $('.ajax-spinner-bars').css("display","block"); 
	    // var postData = $(this).serializeArray();
	    // var formURL = $(this).attr("action");
	    
        // $.ajax({
            // type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            // url         : formURL, // the url where we want to POST
            // data        : postData, // our data object
            // dataType    : 'json', // what type of data do we expect back from the server
            // encode          : true
        // })
            //using the done promise callback
            // .done(function(data) {

                //log data to the console so we can see
                // $('#dataAjax').html(data.data); 
        		// $('.ajax-spinner-bars').css("display","none"); 

                //here we will handle errors and validation messages
            // });

        //stop the form from submitting the normal way and refreshing the page
        // event.preventDefault();
    // });
 
</script>

