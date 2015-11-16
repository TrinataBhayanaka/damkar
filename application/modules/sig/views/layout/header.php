<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="Description" CONTENT="BKIPM - Badan Karantina Ikan, Pengendalian Mutu dan Keamanan Hasil Perikanan, Kementrian Kelautan dan Perikanan Republik Indonesia ">
<META http-equiv="Content-Type" CONTENT="text/html; charset=utf-8" />
<title>CMS - Lingkar Arsa Technologies</title>
<base href="<?=BASE_URL;?>" />
<link rel="shortcut icon" href="assets/image/favicon.ico" />
<link rel="stylesheet" type="text/css" href="assets/css/mmenu.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen">
<script src="assets/js/1.7.2/jquery.min.js"></script>
<script src="assets/js/jquery.easing.1.3.js"></script>
<script src="assets/js/jquery-bkipm.v1.1.js"></script>
<script src="assets/js/latmenu.js"></script>
<script src="assets/js/jquery-elmrotator.js"></script>
<script src="assets/js/bkipm-common.js"></script>
<script src="assets/js/jquery.sticky.js"></script>
<script>
$(window).load(function(){
  $("#topheader").sticky({ topSpacing: 0 });
  $("#subheader").sticky({ topSpacing: $("#topheader").outerHeight() });
  $('#key_list').live('keydown',function (event) {
		var keypressed = event.keyCode || event.which;
		if (keypressed == 13) {
			$("#button_list").trigger("click");
		}
	});
});
</script>
<style>
a {
	color:#eee;
}
/* subheader */
#subheader {
	width:100%
}
/* content data information */
.content-data-info {
	float:right; 
	font-size:12px; 
	margin:5px 10px
}

/* content row data */
.content-data-row {
	padding:10px 0 20px 0;
	border-bottom:1px dotted #ccc;
	background-color:#fff;
}
/* content data date */
.content-data-date {
	font-family:arial, helvetica, sans-serif; 
	text-decoration:none; 
	font-size:10px; 
	color:#555; 
	line-height: 14px;
}
/* content data title a */
.content-data-title a {
	font-family:Arial, Helvetica, sans-serif; 
	text-decoration: none; 
	color:#3a6898;
	line-height:16px;
	font-weight: bold;
}
.content-data-title a:hover {
	text-decoration: none; 
	color: #c45009;
}
.content-data-title {
	padding:5px;
}
li.content-data-title {
	padding:5px 0 5px;
}
#submenu {	width: auto; margin-bottom: 10px; padding:10px 0 5px 10px; border-bottom:1px solid #ddd; background:#fff url(assets/image/app/bgcmsmenu.gif) repeat-x top }
#submenu ul { margin: 0;padding: 0;list-style: none;line-height: normal; margin-left: 5px;}
#submenu li { position:relative; display: inline-block;text-align: center; margin-right: 2px;}
#submenu li a {
	display: block;
	float: left;
	height: 16px;
	line-height:16px;
	padding: 4px;
	text-decoration: none;
	font-size: 11px;
	color: #000;
	border:1px solid #ddd;
	-moz-border-radius: 3px;
	border-radius:3px;
}
#submenu a:hover { background: #ddd; color: #000; height:16px; border:1px solid #ccc;padding: 4px;}
#submenu .menu_active { background: #000000;color: #FFFFFF;height:24px;}

#submenu li span {
	display: block;
	float: left;
	height: 20px;
	padding:2px;
	border:1px solid #ccc;
	background:#fff;
	-moz-border-radius: 3px;
	border-radius:3px;
}
#submenu span input {  }

.cmstitle{
	padding:2px 15px 2px 15px; 
	font-size:large; 
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	border-bottom:1px solid #ccc; 
	background:#999
}
.cmssubtitle{
	padding-left:5px; font-size: medium
}
.cmspaging{
	padding:15px 8px; background:#fff url(assets/image/app/bgcmsmenu.gif) repeat-x top
}
.mmenuactive{
	background:#999
}
.tbldata{
	margin:0;
}
.tbldata td{
	border-bottom:1px solid #ddd;
	border-collapse:collapse;
	padding:4px;
}
.tbldata_header{
	font-weight:bold;
	height:30px;
	color:#000;
}
.forder:hover{
	background-color:#ddd;
}
.tbldata_subheader{
	font-weight:bold;
	height:30px;
	border-top:1px solid #eee;
 	background:#ddd;
}
.formdata_header{
	font-weight:bold;
}
div.pagination {
	padding: 2px;
	margin: 0px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #aaa;
	
	text-decoration: none; /* no underline */
	color: #777;
	-moz-border-radius: 2px;
	border-radius:2px;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #777;
	
	font-weight: bold;
	background-color: #999;
	color: #FFF;
	-moz-border-radius: 2px;
	border-radius:2px;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #ddd;

	color: #ccc;
	-moz-border-radius: 2px;
	border-radius:2px;
}
	
</style>
</head>

<body>
<div id="topheader" style="position:relative; z-index:10; background:url(assets/image/img.jpg) bottom; width:100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="top-heads">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      	<td width="100" style="font-size:large; color:#ccc; border-right:1px solid #444; text-indent:20px"><a href="ctrl">C M S</a></td>
        <td><a href="#" style="margin-left:20px"><img src="assets/image/logo-en.png" border="0" title="<?=$title;?>" /></a></td>
      	<td width="100" style="font-size: medium; color:#ccc; border-right:1px solid #444; text-indent:20px"><a href="ctrl/auth/logout">Logout</a></td>
      </tr>
    </table>
</td>
  </tr>
  <tr>
    <td class="top-tagline" style="background:#424242">
    <!-- Menu -->
    <div class="menu-container">
        <ul id="top-menu" class="dropmenu"> 
            <li rel="cms0"> 
                <a href="ctrl/image">Image Tag</a> 
                <!--<div>
                    <ul class="left"> 
                        <li><a href='<?=__SITEPATH;?>en/news'>Web MAP</a></li>
                        <li><a href='<?=__SITEPATH;?>en/sni'>Web STAT</a></li>
                        <li><a href='<?=__SITEPATH;?>en/upi'>Data Peta Digital</a></li>
                   </ul> 
                </div>-->
            </li> 
            <li rel="cms1"> 
                <a href="ctrl/news">News</a> 
            </li>  
            <li rel="cms2"> 
                <a href="ctrl/portfolio">PORTFOLIO</a> 
            </li>
            <li rel="cms5"> 
                <a href="ctrl/client">Client</a> 
            </li>
            <li rel="cms3"> 
                <a href="ctrl/about">ABOUT</a> 
            </li>
            <li rel="cms4"> 
                <a href="ctrl/contact">CONTACT</a> 
            </li>
            <!--<li style="border-left: solid 1px #777; height:35px;"></li>-->
        </ul> 
    </div>
    <!-- end menu -->
	</td>
  </tr>
  </table>
  </div>
