<?
	$appname=$this->lauth->get_appname();
	$userdata=isset($_SESSION[$appname]["userdata"])?$_SESSION[$appname]["userdata"]:FALSE;
	if(!$userdata):
		redirect("login/");
	endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Admin Kebencanaan</title>
	<meta name="description" content="Badan Registrasi Wilayah Adat.">
	<meta name="author" content="DNFLINK">
	<meta name="keyword" content="">
	<!-- end: Meta -->
	<link rel="icon" 
      type="image/png" 
      href="assets/image/batas.png" />
	<!-- start: Mobile Specific -->
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- end: Mobile Specific -->
	
    <base href="<?=BASE_URL;?>" />
    
	<!-- start: CSS -->
	<link href="assets/themes/admin_lte/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/themes/admin_lte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/themes/admin_lte/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/style.lat.css" rel="stylesheet">
	<link href="assets/css/style.new.infobox.css" rel="stylesheet">
	<link href="assets/css/style.new.statsbox.css" rel="stylesheet">
	<link href="assets/css/style.new.badges.css" rel="stylesheet">
	<link href="assets/css/style.new.task.css" rel="stylesheet">
	<link href="assets/css/ajax-spinner.css" rel="stylesheet">
    
   
    <!-- Theme style -->
    <link href="assets/themes/admin_lte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="assets/themes/admin_lte/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="assets/themes/admin_lte/css/AdminLTE-LAT.css" rel="stylesheet" type="text/css" />
    
	
    <style>
		
		*,body,html,input,button,textarea,select{
			font-family: "Source Sans Pro",sans-serif; !important;
		}
		
		body,html{
			font-size:14px !important;
			
		}
		
		.wrapper{
			background-color:#FeFeFe !important;
			
		}
		
		.content{
			background-color:#fefefe !important;
    		padding:20px 20px !important; 
			
		}
		
		.navbar-left > .nav > li.active{
			background-color:#307095 !important;
			box-shadow: 0 0 5px #dadada;
		}
		
		.content .page-header{
			/*
			margin: -20px -20px 20px !important;
			background: none repeat scroll 0 0 #fbfbfb;
    		box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
			padding: 2px 15px 2px 20px;
			*/
			margin: -20px -20px 20px !important;
			background: none repeat scroll 0 0 #fbfbfb;
			box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
			padding: 10px 15px 10px 20px;
			position: relative;
		}
		
		.content .page-header h1{
			font-family: "Source Sans Pro",sans-serif !important;
			font-size: 24px !important;
			margin:0;
			/*font-weight: 500;*/
    		line-height: 1.1;
			text-transform:none !important;
		}
		
		.content .breadcrumb{
			background-color:#fcfcfc !important;
			/*margin: -15px -10px 30px !important;*/
			margin:-20px -20px 20px !important;
			padding: 13px 5px  !important;
			border-bottom:1px #f2f2f2 solid;
		}
		
		.content .breadcrumb li a{
			font-size:12px !important;
		}
		
		.content{
			padding-bottom:50px !important;
		}
		
		.content .breadcrumb li:first-child a {
			padding: 0 0 0 15px !important;
		}
		
		.topbar{
			background: linear-gradient(to bottom, rgb(235, 235, 235),rgb(244,244,244)) repeat scroll 0 0 transparent !important;
			background-color:#F9F9F9 !important;
		}
		
		.sidebar-menu .treeview-menu > li.active > a{
			 color: #478FCA !important; 
		}
		
		.sidebar-menu li.active_state{
			/*
			border-color: #3c8dbc !important;
			border:1px solid;
			*/
			padding:0px;
			/*border-right-color: #3c8dbc !important;
			border-right:2px solid;*/
			border-radius: 0;
    		border-top: 0 none;
		}
		.tables_info {
			padding:5px;
			margin:20px 5px;
			background:#f4f4f4;
			border-top:1px solid #ddd
		}
		.tables_info .displaying {
			margin-top:5px;
			margin:5px 10px 5px -10px;
			display:inline-block;
		}
		.fa-remove, .icon-remove {
			color: #FF6666!important;
		}
	</style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <link href="assets/js/plugins/chart/jqplot/jquery.jqplot.css" rel="stylesheet" />
	<link href="assets/css/retina.min.css" rel="stylesheet">
    <link href='assets/js/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='assets/js/plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link href='assets/js/plugins/daterange/daterangepicker-bs3.css' rel='stylesheet' />
	<!-- end: CSS -->
	
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		
	  	<!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="assets/js/respond.min.js"></script>-->
		
	<![endif]-->
	
    <!-- start: JavaScript-->
	<!--[if !IE]>-->

	<script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src='assets/js/plugins/fullcalendar/lib/jquery-ui.custom.min.js'></script>
    <script type="text/javascript" src='assets/js/plugins/fullcalendar/fullcalendar.min.js'></script>
    <script type="text/javascript" src="assets/js/plugins/daterange/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/daterange/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/jquery.easy-pie-chart.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui-1.10.3.js"></script>
    <script type="text/javascript" src="assets/themes/admin_lte/js/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="assets/themes/admin_lte/js/plugins/morris/raphael-js/raphael.min.js"></script>
	<!--<![endif]-->

	<!--[if IE]>
		<script src="assets/js/jquery-1.10.2.min.js"></script>
	<![endif]-->

	<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
	<!--<![endif]-->

	<!--[if IE]>
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
	<![endif]-->
	<script type="text/javascript" src="assets/themes/admin_lte/js/bootstrap.min.js"></script>
    <script src="assets/themes/admin_lte/js/AdminLTE/app.js" type="text/javascript"></script>
    <?=loadFunction("validate");?>
    <? $this->load->view("admin_lte_layout/header_js")?>
    	
					
</head>

<body class="skin-blue">
	<div class='ajax-spinner-bars' style="display:none;" align="center">
  		
  		 <div id="facebookG" align="center">
  		 	<img src="assets/images/loading.gif" width="40%"/>
			<!-- <div id="blockG_1" class="facebook_blockG">
			</div>
			<div id="blockG_2" class="facebook_blockG">
			</div>
			<div id="blockG_3" class="facebook_blockG">
			</div> -->
		</div> 

	</div>