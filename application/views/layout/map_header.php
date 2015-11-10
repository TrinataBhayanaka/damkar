<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Badan Registrasi Wilayah Adat (BRWA)</title>
<base href="<?=BASE_URL;?>" />

<META NAME="Description" CONTENT="Badan Registrasi Wilayah Adat (BRWA) ">
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8" />
<meta name="msvalidate.01" content="2B615B21D3BEF4C1E30D2F6DCE780D15" />
<!-- Facebook Open Graph Meta Tags -->
<? $url = 'http://'.$_SERVER['HTTP_HOST'];  $uri=$_SERVER['REQUEST_URI']; ?>
<meta property="og:title" content="Badan Registrasi Wilayah Adat (BRWA)" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=$url.$uri?>" />
<meta property="og:image" content="<?=$url?><?=BASE_URL;?>assets/image/logo-blank.png" />
<meta property="og:description" content="BRWA dibentuk untuk mendukung proses pengakuan keberadaan masyarakat adat dan hak-hak atas wilayah adatnya." />

<link rel="stylesheet" type="text/css" href="assets/bs-3.3.1/css/bootstrap.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/bs-3.3.1/css/bootstrap-theme-lat.css" media="screen">
<link rel="stylesheet" href="assets/fa-4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/rrss.css">
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bs-3.3.1/js/bootstrap.min.js"></script>
<script src="assets/themes/bs-square/js/bootstrap-menu-hovers.js"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/jquery.realm.js"></script>
<script>
$(window).load(function(){
  $("ul.nav li.dropdown").mouseenter(function(){
  		$(this).find("ul.dropdown-menu").slideDown("fast");
  }).mouseleave(function(){
  		$(this).find("ul.dropdown-menu").hide();
  })
	
	$( ".div_message" ).delay( 3000 ).slideUp( 500 );
	
});
$(window).scroll(function(){
    if ($(window).scrollTop() >= 90) {
		$(".ttop").slideUp();
	   //$(".ttop").slideUp();
       //$('.sticky-header').addClass('fixed', 5000, "easeInOutQuad").find("nav").css("background","#e5e5e5");
    }
    else {
	   $(".ttop").slideDown("fast");
       //$('.sticky-header').removeClass('fixed', 5000, "easeInOutQuad" ).find("nav").css("background","#eee");
    }
});

</script>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,400,300' rel='stylesheet' type='text/css'>
<style>
	body {
		background:#ffffff;
		color:#333333;
		font-family:'Open Sans'
	}
	#closure {
		margin:0;
		position:relative;
		border:1px solid #e5e5e5;
		border-width:0 1px;
		background:#fff;
		
	}
	.fixed {
		position: fixed;
		top:0; left:0;
		z-index:2000;
		width: 100%; 
		background-image: linear-gradient(to bottom, #eee, #ddd);
	  	background-repeat: repeat-x;
	}
/* Custom container */
      .container {
        margin: 0 auto;
		padding:0!important;
		width:100%;
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
	  border-bottom:3px solid #ccc;
	  background-color: #f8f8f8;
	  /*background-image: linear-gradient(to bottom, #FFF, #F2F2F2);
	  background-repeat: repeat-x;*/
      /*margin-bottom: -90px;  Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
	  box-shadow: 0px 4px 3px rgba(100, 100, 100, 0.1);
    }
    #sub-header {
	  width:100%;
	  background-color: rgba(74, 74,74,.1);
      background-image: linear-gradient(to bottom, rgba(74, 74, 74,.1), rgba(84, 84, 84,.1));
      background-repeat: repeat-x;

    }
	.navbar-inverse {
		position:relative;
	  padding:0px;
    }
	
/* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 0px;
  border-bottom:0px solid #ddd;
  position:relative;
}

.carousel .container {
  position: relative;
  z-index: 9;
}

.carousel-control {
    position: absolute;
    top: 27%;
    left: 50%;
	margin-left:-620px;
    width: 50px;
    height: 50px;
    font-size: 50px;
	line-height:35px;
    color: #FFF;
    text-align: center;
    background: #bbb;
	background-image:none!important;
    border: 3px solid #FFF;
    border-radius: 50%;
    opacity: .4;
	/*display:none*/
}
.carousel-control.right {
	left:auto;
	right:50%;
	margin-right:-620px
}
.carousel-control:hover {
    background: #808080;
}
.carousel .item {
  height: 600px;
  overflow:hidden
}
.carousel-inner > .item > img, .carousel-inner > .item > a > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
}

.carousel-caption {
  background-color: transparent;
  position: static;
  max-width: 1000px;
  padding: 0;
  margin-top: 100px;
  text-align:left;
}
.carousel-caption h1{
	font-family:'Open Sans','Oswald',Arial;
}
.carousel-caption h1,
.carousel-caption .lead {
	font-size:50px;
	font-weight:300;
	margin: 0px;
	line-height: 1.25;
	color: #fff;
	text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
}
.carousel-caption.dark > h1,
.carousel-caption.dark > .lead {
	color: #444;
	text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.6);
}
.carousel-caption .lead {
	font-size:1.2em;
	font-weight:700
}
.carousel-caption .btn {
  margin-top: 10px;
}

.footer					{background:repeat-x 0 0 #f8f8f8; margin-top:20px; padding:40px 0 10px; border-top:4px solid #ddd }
.footer h2				{color:#333; padding-bottom:10px;font:16px/140% 'Roboto', Open Sans, sans-serif; text-transform:uppercase}

.copyright {
	padding:15px 0;
	border-top:1px solid #ccc
}
.copyright, .copyright a {
	color:#333;
	text-shadow:none;
}

.subhead {
	position:relative;
	height:200px;
	margin-bottom:30px;
	background:#4a7dab  ;
}
.subhead-caption {
  background-color: transparent;
  position: absolute;
  max-width: 1000px;
  padding: 0;
  top: 20%;
  text-align:left;
}
.subhead-caption h1{
	font-family:'Open Sans','Oswald',Arial;
}
.subhead-caption h1,
.subhead-caption .lead {
	font-size:40px;
	font-weight:300;
	margin: 0px;
	line-height: 1.25;
	color: #fff;
	text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
}
.subhead-caption .lead {
	font-size:1.2em;
	font-weight:700
}

.lat-feature {
	padding-bottom:0px;
	margin-bottom:0px;
	font-weight:normal
}
.lat-feature a{
	color:#fff;
	text-decoration:none;
}
.lat-feature h4 {
	font-size:16px!important;
	font-weight:normal
}
.lat-feature h4 a{
	color:#fff;
}
.lat-feature i {
	text-shadow: none;
	font-size: 35px;
	display: block;
	text-align: center;
	margin:0px;
	color:#fff
}
.lat-feature .col-lg-12 {
	border:0px solid #ccc; height: auto;
	text-align:center;
	margin:2px;
	background:#777;
	min-height:300px;
}
.lat-feature .col-lg-12:hover {
	opacity:.7
}
.fasilitas ul li:hover i {
	color:#fff
}
.fasilitas ul li:hover a {
	color:#fff
}
.fasilitas ul li a{
	color:#eee;
	text-decoration:none
}
.fasilitas i.red {
	/*background: #ff544f*/
}
.fasilitas .green {
	background: #71b60e
}
.fasilitas i.blue {
	/*background: #00b5e4*/
}
.fasilitas i.grey {
	/*background: #aaa*/
}
.fasilitas p {
	display:block;
	margin-top:15px;
	font-family: 'Open Sans';
	color:#777;
	font-size:.9em
}
/*
.btn-primary {
    color: #FFF;
    background-color: green;
    background-image: none;
    border-color: none;
}*/
.carousel-caption .btn {
	background: #333;
	border:0px!important;
	border-radius:0px!important;
    text-shadow: none!important;
	text-transform:uppercase;
	font-size:12px;
	color:#eee
}
.border{
	border-top:1px solid #aaa
}
ul.nav li.dropdown:hover ul.dropdown-menu{
    /*display: block;*/    
}
.navbar .nav li.dropdown:hover > a {
    color: #71b60e;
    background-color: transparent!important;
	box-shadow:none;
	/*border-bottom:3px solid #71b60e*/
}

.content-box.box-default {
    border: 1px solid #ddd;
	border-top-width:2px;
	background:#fff
}
.content-box.box-green {
    background-color: #71b60e;
    border: 1px solid #E5E5E5;
}
.content-box {
    display: block;
    text-align: center;

    overflow: hidden;
    padding: 10px;
	font-weight:normal;
	border:1px solid #ddd
}
.content-box .icon-title {
	position:relative;
	color: #555;
	padding:0px;
	overflow:hidden;
}
.content-box i.back {
	font-size:120px; color:#555; opacity:0.01; position:absolute;
}
.content-box a:hover {
	opacity:.8;
	text-decoration:none
}
.content-box a:hover i.back {
	opacity:.1;
}
.content-box a {
	font-size:1.1em;
	font-weight:bold
}
.content-box .icon-title {
	font-size:40px;
	line-height:40px;
	margin-bottom:0px
}
.content-box .icon-title.icon-title-dark {
	background:#71b60e;
}
.content-box .icon-title.icon-title-dark i {
	color:#eee;
}
.content-box-title {
	color: #777!important;
	font-size:1.5em; line-height:.7em
}
.animation-delay-10 {
    animation-delay: 1s !important;
}
.fadeInUp {
    animation-name: fadeInUp;
}
.animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}
* {
    box-sizing: border-box;
}
.section{
	font-weight:normal; padding:20px 0
}
h3 {
    font: 400 21px/24px "Open Sans",sans-serif;
}
.pages {
	margin-top:20px;
	padding-right:20px
}
h3.title, .pages h3 {
	padding:5px 0;
	border-bottom:2px solid #ccc;
	margin-bottom:20px;
	text-transform:uppercase;
	font-weight:300!important;
	color: #555;
}
.pages h3 {
	padding:5px 0;
	border-bottom:0px solid #ccc;
}
.ttop,.ttop a {
	color:#999;
}
.tickerhead {
	height:30px; 
}
.down-shadow {
	background:url(assets/image/down_shadow.jpg) center no-repeat;
	height:14px
}
#lalulintaslist{
	overflow: hidden;
}
.tag-lalulintas {
	height:25px;
}
.tickertoggle{
	position:absolute; right:10px; background:url(assets/images/arrow_down.gif) no-repeat center; width:30px; height:30px; cursor:pointer
}
.tickertoggle:hover{
	background:url(asseta/images/arrow_down.gif) no-repeat center; width:30px; height:30px; background-color:#fff;
}
.tickercontainer{
	position:relative;padding:5px; margin:5px 0 5px 0;
	background-color: #FFAF13;
}
.tickerspacer{
	color:#fff;
	float:left; background:url(assets/images/spacer.gif) right center no-repeat; width:auto; padding:4px 15px 4px 4px;line-height:22px; ; font-weight:bold;
}
.tickerspacer2{
	color:#eee;
	float:left; background:url(assets/image/spacer.gif) right center no-repeat; width:auto; padding:2px 15px 2px 0px;line-height:22px; ; font-weight:bold;
}
.tickerlist{
	display:block; height:25px; line-height:25px; margin-left:10px; color:#ddd;
}
.tickerlist a{
	text-decoration:none; color:#ddd
}
.tickerlist a:hover{
	color:#000
}
.content-sub-nav .nav-tabs > li > a, .nav-pills > li > a {
    color: #999;
    padding: 8px 10px;
    margin-right: 0px;
    line-height: 14px;
}
.friend_link {
	margin-right:15px
}


img.desaturate{
	-webkit-filter: grayscale(100%);
	filter: grayscale(100%);
	filter: gray;
	filter: url("data:image/svg+xml;utf8,<svg version='1.1' xmlns='http://www.w3.org/2000/svg' height='0'><filter id='greyscale'><feColorMatrix type='matrix' values='0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0' /></filter></svg>#greyscale");
}
img.desaturate:hover{
	-webkit-filter: grayscale(0%);
	filter: grayscale(0%);
}
.nav-tabs > li > a {
    color:#ccc;
	padding: 0px 15px;
	margin-right:5px;
	background:rgba(200,200,200,0.2);
	/*border:1px solid #aaa;*/
	border-bottom:1px solid #ccc!important
}
.nav-tabs > li > a:hover {
    color:#555
}
.nav > li.spacer {
    border-left:1px solid #eee;
	padding:5px 0;
	margin:4px 5px;
	height:21px
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    border-color: #ccc #ccc transparent;
	border-bottom:1px solid transparent!important
}	
.nav-tabs {
    border-bottom: 1px solid #ccc;
}
#newsTab li > a {
    color:#999;
	padding: 0px 15px;
	margin-right:5px;
	background:#eee;
}
#newsTab li.active > a {
    color:#333;
	background:#fff;
}
.div_message {
	position:absolute;
	border:none!important;
	border-radius:0;
	margin: 0 auto;
	width:1100px;
	padding:6px!important;
	z-index:2000;
	background-image:none!important
}
.fa-times-circle {
	color:#FF3333
}
.hilite {	
	/*background-image: linear-gradient(to bottom, #3287bd 10%, #8aabc9 90%);*/
	background:#4a7dab;border-width:1px 0;
	margin-top:-70px;
	position:relative;
	z-index:1200;
	opacity:.85
}

.breadcrumb {
    padding: 0px;
    margin: 25px 0px 5px;
    list-style: outside none none;
    background-color: transparent;
    border-radius: 4px;
	color:#ccc
}
.breadcrumb li > a {
	color:#ddd;
}
.breadcrumb li.active {
	color:#fff;
}
.page-title {
	font-size:40px;
	font-weight:300;
	line-height: 1.25;
	margin-left:0;
	border-bottom:1px solid #ddd
}
.page-title2 {
	font-size:40px;
	font-weight:300;
	margin-left:0;
	color:#eee;
	margin:10px 0 -30px;
}
.news-title{
	font-weight:400
}
#brwa-top li>a {
	 font-size:.9em;
}
#brwa-top li>a:hover {
	 background:transparent;
	 color:#777;
}
#brwa-top i {
	font-size:16px;
}
#brwa-top .ss {
	padding:4px 6px;
	color:#ccc;
	opacity:.6
}
#brwa-top .ss:hover {
	opacity:1
}
#brwa-top .ss.ss-fb i {
	color:#335696;
}
#brwa-top .ss.ss-tw i {
	color:#4fd1e1; 
}
#brwa-top .ss.ss-gg i {
	color:#c03820; 
}
#brwa-top .ss.ss-yt i {
	color:#c03820; 
}
</style>
</head>

<body style="padding-top:50px">
<div id="main-wrapper" style="display:none;height:988px; opacity:0; position:fixed; top:0; z-index:900; margin:0 -30px" class="modal-backdrop fade in"></div>
<div id="headers" class="sticky-header" >
<!--topest-->
<div class="fixed">
<nav class="navbar navbar-default" role="navigation" style="background:#fff">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding:5px 10px 0 50px; position:relative"><img src="assets/image/logo-blank.png" border="0" title="<?=$title;?>" style="margin-top:-8px" /></a>
      <a class="navbar-brand" href="#" style="padding:5px 30px 0 20px; position:relative; line-height:40px">Peta Wilayah adat</a>
    </div>
	
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-left" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav main-menu">
          <li><a href="">BERANDA</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">TENTANG BRWA &nbsp;<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="pages/about">Profil </a></li>
              <li><a href="pages/kantor">Kantor Wilayah</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdownx" data-hover="dropdown">WILAYAH ADAT &nbsp;<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="pages/prosedur">Prosedur Pendaftaran WA</a></li>
              <li><a href="user/wa/register">Pendaftaran WA</a></li>
              <li class="divider"></li>
              <li><a href="wa/">Data WA</a></li>
              <li><a href="wa/">Web GIS</a></li>
            </ul>
          </li>
        </ul>
    </div><!-- /.navbar-collapse -->
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav main-menu">
          <li><a href="pages/kontak"><i class="fa fa-plus"></i>&nbsp;</a></li>
          <li><a href="pages/kontak"><i class="fa fa-minus"></i>&nbsp;</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdownx" data-hover="dropdown">PETA DASAR &nbsp;<i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="pages/slpp">GOOGLE</a></li>
              <li><a href="pages/ukp3">DEFAULT</a></li>
            </ul>
          </li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>
