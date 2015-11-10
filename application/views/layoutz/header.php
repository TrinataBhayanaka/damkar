<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="Description" CONTENT="ATM - ESIRS ATM Division, Directorate of Air Navigation">
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8" />
<title>PPID Aceh</title>
<base href="<?=base_url()?>"/>

<link href="assets/image/logo_kecil.png" rel='shortcut icon' type='image/vnd.microsoft.icon'/>
<!-- LOAD LIBRARY CSS -->
<link href="assets/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">
<?php echo css_asset("styles.css")?>
<?php echo css_asset("mybootstrap.css")?>
   
<!--[if IE 7]>
	<link rel="stylesheet" href="assets/fa/css/font-awesome-ie7.min.css">
<![endif]-->
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Monda:400,700);
@import url(http://fonts.googleapis.com/css?family=Open+Sans);

body {
	padding-top: 60px;
	padding-bottom: 40px;
	font-family:Arial,Helvetica;
}
.sidebar-nav {
	padding: 9px 0;
}
@media (max-width: 980px) {
	/* Enable use of floated navbar text */
	.navbar-text.pull-right {
		float: none;
		padding-left: 5px;
		padding-right: 5px;
	}
}
</style>
   
   
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<?php echo js_asset("html5.js");?>
<![endif]-->
<link href="<?=base_url()?>assets/themes/google/bootstrap.css" rel="stylesheet">
<link href="<?=base_url()?>assets/themes/google/lat.css" rel="stylesheet">

<link href="assets/app/admin/css/admin.css" rel="stylesheet">
<link href="assets/bootstrap/2.3.2/themes/bs-square/css/lat.css" rel="stylesheet">

<script src="assets/js/1.7.2/jquery.min.js"></script>
<script src="assets/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/jquery.realm.js"></script>
<style>
	body {
		background:#fff url(assets/image/main_bgs.png) repeat-x top;
		font-family: Arial, Helvetica, sans-serif;
		/*font-family:'Open Sans',Helvetica;*/
	}
/* Custom container */
      .container,.carousel {
        margin: 0 auto;
        max-width: 968px;
      }
	  .div_message {
        margin: 0 auto;
        max-width: 920px;
		
      }
	  .div_message p {
	  	margin: 0px !important;
	  }
/* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 999;
      margin-top: 0;
      margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
	  padding:5px;
	  background-color: rgb(34, 34, 34);
      background-image: linear-gradient(to bottom, rgb(34, 34, 34), rgb(44, 44, 44));
      background-repeat: repeat-x;
      border-color: rgb(37, 37, 37);
	  
	box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
    }
    .navbar-wrapper .navbar {

    }
	
/* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 0px;
}

.carousel .container {
  position: relative;
  z-index: 9;
  padding:2px;
}
.carousel-inner {
	box-shadow: 0px 0px 0px #888888;
  background-color:#eee;
}
.carousel-control {
  height: 80px;
  margin-top: 0;
  font-size: 120px;
  text-shadow: 0 1px 1px rgba(0,0,0,.4);
  background-color: transparent;
  border: 0;
  z-index: 10;
}

.carousel .item {
  height: 300px;
  box-shadow: 0px 0px 0px #888888;
  margin:0px;
  background-color:#eee;
}
.carousel img {
  position: absolute;
  top: 0px;
  left: 0px;
  height: 360px;
}

.carousel-caption {
  background-color: transparent;
  position: static;
  max-width: 350px;
  padding: 0 5px;
  margin-top: 50px;
  margin-left:20px;
}
.carousel-caption h1,
.carousel-caption h2,
.carousel-caption h3, /*{
	display:inline;
	background-color:#000;
	color: #fff;
}*/
.carousel-caption .lead {
  font-family:"Monda";
  margin: 0px;
  line-height: 1.25;
  color: #fff;
  text-shadow: 0 1px 1px rgba(0,0,0,.4);
}
.carousel-caption .btn {
  margin-top: 10px;
}

.footer					{background:url(assets/image/footer.png) repeat-x 0 0 #333/*#36587b*/; text-shadow:0 -1px 0 #232323; }
.footer	 .container		{background:url(assets/image/footer-logo.png) no-repeat 100% 50%; padding:30px 0 10px; color:#c2c2C2;}
.footer	 a				{color:#fff;}
.footer h2				{color:#ffffff; padding-bottom:10px;font:13px/140% 'Monda','Proxima', Open Sans, sans-serif; text-transform:uppercase}
.footer ul 				{list-style:none; margin:0;}
.footer ul li			{font:11px/200% 'Proxima', Open Sans, sans-serif;}
.footer ul li a			{color:#ccc}
.footer ul li a:hover	{color:#fff; text-decoration:none}
.footer .border			{background:url(assets/image/border-hr.png) repeat-x 0 0; padding:20px 0 10px 0; clear:left; margin-top:20px;}
.kontak a		 		{font-size:medium; margin:20px 10px 0 2px}


h1.site-header {
	color:#eee;
}
a.news {
	color:#0a3e73;
	font-weight:bold;
}
a.news-title {
	color:#333;
	font-weight:bold;
}
a.news-title:hover {
	color: #0066CC;
	font-weight:bold;
}
.navbar {
	margin-top:0px;
}
.navbar-inverse .nav > li > a {
	font-family:"Monda",'Open Sans';
    color: #eee;
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.25);
	font-size:12px;
	text-transform:uppercase;
	font-weight:normal;
	padding: 10px 12px;
}
.navbar-inverse .nav li.dropdown > .dropdown-toggle .caret {
    border-top-color: #ccc;
    border-bottom-color: #ccc;
}
.navbar-inverse .nav > li > a small.highlight {
	background-color:#0a3e73; color:#fdc400; padding:0 5px;
}
.navbar-small .nav > li > a {
    color: #aaa;
    text-shadow: none;
	font-size:small;
	padding:5px;
	font-weight:normal;
}
.navbar-small .nav > li > a:hover {
    color: #eee;
    text-shadow: none;
}
h3.sub {
	font-family:"Segoe UI",'Open Sans';
	color:#03873d;
	font-size:28px;
	font-weight: lighter
}
h3.rightsub {
	font-family:"Segoe UI",'Open Sans';
	color:#555;
	font-size:28px;
	font-weight: lighter
}
.carousel-indicators {
	top: 90%;
	right: 25px;
	z-index: 31;
}
.carousel-control {
	background:url(assets/image/carousel/arrows.pngs) no-repeat scroll 0% 0% transparent;
	width:49px;
	height:49px
}
.carousel-control.right {
    right: -55px;
    left: auto;
	background-position: 0px 1px;
}
.carousel-control.left {
    left: -55px;
    right: auto;
	background-position: 0px -68px;
}
.media {
	padding-bottom:10px; 
	border-bottom:1px solid #ddd;
}
.media:last-child {
	border-bottom-width:0px
}
.topflow {
	/*border-bottom:2px dotted #a2afbc*//*#3e5f95*/;
	background:url(assets/image/top-shadow.png) no-repeat bottom;
	margin-left:-10px;
	margin-bottom:0;
	font-family:Arial, Helvetica, sans-serif;
	width:968px;
	height:50px;
}
.topflow > li {
	color:#ccc;
	padding:5px
}
.topflow > li > a {
	color:#aaa;
}
.topflow > li > a:hover {
	color:#fff;
	text-decoration:none
}
.topflow li > .divider {
    padding: 0 5px 0 10px;
    color: rgb(204, 204, 204);
}
.breadcrumb a/*,a:focus*/ {
	color:#555;
}
.subheader {
	height:160px; background-color:#eee;
	margin-bottom:20px;
	margin-top:0px;
}
.subheader .subheader-inner {
	height: inherit; background:url(assets/image/sub_header_bg.png) left center no-repeat
}
.subheader h1 {
	margin-top:50px;
	font-family:"Segoe UI",'Open Sans';
	color:#777;
	font-size:45px;
	font-weight: lighter
}
.subheader-inner-replace h1 {
	font-family:"Segoe UI",'Open Sans';
	color:#777;
	font-size:24px;
	line-height:24px;
	font-weight: lighter

}
.subheader small {
	font-family:"Segoe UI",'Open Sans';
	color:#aaa;
	font-size:25px;
	margin-top:10px;
	font-weight: lighter
}
.dropdown-menu {
	margin-top:5px;
	padding-top:5px;
    background-clip: padding-box;
}
.navbar-inner {
    box-shadow: none;
}
.right-menu > li {
	font-size:large; 
	background:#ccc;
	font-family:'Monda','Open Sans';
}
.right-menu > li .box-icon {
	display:inline-block;
	margin:-10px 5px -10px -10px;
	width:20px;
	height:inherit;
	padding: inherit;
	background:#999;
	text-align:center
}
.navbar-inverse .nav > li >a {
    color: #ddd;
}
.navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus {
    color: rgb(255, 255, 255);
    background-color: #027334;
}
.content-page {
	 padding-right:10px
}
.right-page {
	border-left:1px solid #dedede; padding-left:10px;
}
.tophead {
	/*height: 20px; padding-bottom:14px; background:url(assets/image/down_shadow.jpg) bottom center no-repeat*/
	border-bottom:4px solid #ddd
}
.tickerhead {
	border-bottom:1px solid #d5d5d5;
	height:30px; 
}
.down-shadow {
	background:url(assets/image/down_shadow.jpg) center no-repeat;
	height:14px
}
#lalulintaslist{
	overflow: hidden;
	float:left
}
.tag-lalulintas {
	height:25px;
}
.tickertoggle{
	position:absolute; right:10px; background:url(../images/arrow_down.gif) no-repeat center; width:30px; height:30px; cursor:pointer
}
.tickertoggle:hover{
	background:url(../images/arrow_down.gif) no-repeat center; width:30px; height:30px; background-color:#fff;
}
.tickercontainer{
	position:relative;padding:5px; margin:5px 0 5px 0;
	background-color: #FFAF13;
}
.tickerspacer{
	color:#fff;
	float:left; background:url(../images/spacer.gif) right center no-repeat; width:auto; padding:4px 15px 4px 4px;line-height:22px; ; font-weight:bold;
}
.tickerspacer2{
	color:#777;
	float:left; background:url(assets/image/spacer.gif) right center no-repeat; width:auto; padding:2px 15px 2px 0px;line-height:22px; ; font-weight:bold;
}
.tickerlist{
	display:block; height:25px; line-height:25px; margin-left:0px
}
.tickerlist a{
	text-decoration:none; color:#444
}
.tickerlist a:hover{
	color:#000
}
.fixed {
    position: fixed;
    top:0; left:0;
	z-index:1000;
    width: 100%; 
	border-bottom:1px solid #ccc;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}
#toTop {
    width: 100px;
    border: 0px solid #CCC;
    background: none;
    text-align: center;
    padding: 5px;
    position: absolute!important;
	float:right;
    z-index: 5000;
    cursor: pointer;
    display: none;
    color: #333;
    font-family: verdana;
    font-size: 11px;
}
</style>
<script>
$(document).ready(function () {
	$('.carousel').carousel();
	$('#lalulintaslist').realm({
		slideShow:true,
		slideEffect: 'slide-vertical', //pilihan
		slideInterval: 5000,
		onHoverStop:false,
		continuous:true,
		showControlBar:false,
		showData:false,
		showNumberBar:false,
		onSlideEnd:function() {  }
	});
	$('.tooltip-demo').tooltip();
	$( ".div_message" ).delay( 3000 ).slideUp( 500 );
});
$(window).scroll(function(){
	var sh = $('.subheader-inner').html();
	
    if ($(window).scrollTop() >= 50) {
       $('.sticky-header').addClass('fixed');
	  	if (sh) {
			$('#shr').html(sh);
	   		$('#subhead').show();
		}
    }
    else {
       $('.sticky-header').removeClass('fixed');
	   $('#shr').html('');
	   $('#subhead').hide();
    }
});
</script>
</head>

<body>
	<?php echo message_box();?>
    <div class="sticky-header">
        <div class="navbar navbar-inverse" style="background:none; background-color:#fff; margin-top:-15px; margin-bottom:0px;">
            <div class="navbar-inner" style="background:none; background-color:transparent; border:0;">
                <div class="container">
                    <a class="brand" href="" style="margin:20px 0px 10px -5px" title="PPID - Provinsi Aceh"><img src="assets/image/logo2.png" align="absmiddle" /></a>
                </div>
            </div>
        </div>
        <div class="navbar navbar-inverse">
        <div class="navbar-inner" style="background:#03873d url(assets/image/login_bg.pngs) no-repeat;">
            <div class="container" >
                <nav>
                    <div class="nav-collapse">
                        <ul class="nav main-menu" style="width:100%;">
                            <li><a href="">Beranda</a></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="profil">Profil <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="pages/about">Tentang PPID</a></li>
                                    <li><a href="pages/pd">Profil Daerah</a></li>
                                    <li><a href="pages/pj">Profil Pejabat</a></li>
                                    <li class="divider"></li>
                                    <li><a href="pages/ki">Keterbukaan Informasi</a></li>
                                </ul>
                            </li>
                            <li><a href="news"> Berita</a></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="prosedur">Prosedur <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="pages/permohonan_informasi">Permohonan Informasi</a></li>
                                    <li><a href="pages/pengajuan_keberatan">Pengajuan Keberatan</a></li>
                                    <li><a href="pages/pengajuan_sengketa">Pengajuan Sengketa ke KIA</a></li>
                                    <li><a href="pages/pengajuan_ke_pn">Pengajuan Sengketa ke Pengadilan</a></li>
                                </ul>
                            </li>
                            
                            <!--<?
                            $footer_pp_list=$this->footer_pp_list;
                            ?>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> &nbsp;Informasi Publik <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php 
                                      if (is_array($footer_pp_list)) { 
                                        $more=(count($footer_pp_list)>8)?'<a href="pp">more...</a>':'';
                                        $max=8;
                                      ?>
                                      <?php for($i=0;$i<=5;$i++) { ?>
                                      <li><a href="pp/cat/<?=$footer_pp_list[$i]['category'];?>"><?=$footer_pp_list[$i]['description'];?></a></li>
                                      <?php } if ((count($footer_pp_list)>5)) { ?>
                                        <li class="divider"></li>
                                        <li><a href="pp">more...</a></li>
                                      <?php }} ?>
                                </ul>
                            </li>-->
                            <li><a href="dip"> Pelayanan Informasi Publik</a></li>
                            <li><a href="pages/faq">F.A.Q.</a></li>
                           <? if (!$this->ion_auth->logged_in()) { ?>
                            <li style="float:right; margin-right:10px"><a href="user"><i class="icon-unlock icon-white"></i> &nbsp;Masuk</a></li>
                            <? } else { ?>
                            <li style="float:right; margin-right:10px"><a href="user/logout" class="tooltip-demo" data-toggle="tooltip" href="#" data-original-title="Logout"><i class="icon-off icon-white"></i> &nbsp; Keluar</a></li>
                            <!--<li style="float:right; margin-right:10px"><a href="user/dokumen/request"><i class="icon-edit icon-white"></i> &nbsp;Permohonan</a></li>-->
                            <? } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        </div>
        <div id="subhead" style="background:#f4f4f4; display:none;">
        	<div class="container" style="position:relative">
        		<div id="shr" class="subheader-inner-replace"></div>
                <span id="toTop" class="pull-right">^ Back to Top</span>
            </div>
            
        </div>
    </div>
    <? 
	//run visitor online
	modules::load('wg/wg')->get_visitor_online(FALSE);
	modules::load('wg/wg')->get_visitor_counter(FALSE);
	?>
    

