<meta http-equiv="pragma" content="no-cache">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS Login - Lingkar Arsa Technologies</title>
<base href="<?=BASE_URL;?>" />
<script src="assets/js/1.7.2/jquery.min.js"></script>
<script>
$(document).ready(function () {
	$("#error").hide();
});
</script>
<style>
body {
	background-color: #FFFFFF;
	margin: 0px;
	color:#424242;
	font-family:Tahoma, Arial,Helvetica,sans-serif;
	font-size: 12px;
}
.olotd {
	-moz-border-radius: 5px;
	border-radius:5px;
	opacity:0.7;
	filter:alpha(opacity=70); /* For IE8 and earlier */
}
</style>
</head>
<body style="background:#777 url(assets/image/abstract.jpg) no-repeat 0px -180px" onLoad='document.login.login.focus()'>
<span id="error" style="background-color:#ffbfbf; text-align:center; font-weight:bold; padding:10px; position: relative; display: <?=$display;?>"><?=$errorTxt;?></span>
<table border="0" align="center" cellspacing="10" cellpadding="10" class="adminformrelative" style="margin-top:120px">
	<tr>
      	<td width="80" style="font-size:x-large; color:#ccc; border-right:1px solid #aaa;">C M S</td>
    <td><img src="assets/image/logo-en.png" border="0" title="<?=$title;?>" /></td>
    </tr>
</table>
<table border="0" align="center" cellspacing="10" cellpadding="15" class="adminformrelative">
  <tr>
    <td background="public/images/bglogin.gif" class="olotd" style="background:#777; border:0px solid #eee">
    <form name="login" action="ctrl/auth/login" method="post">
      <table border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td><b>Username</b></td>
          <td>&nbsp;</td>
          <td><b>Password</b></td>
        </tr>
        <tr>
          <td><input name="username" type="text" id="login" style="width:180px; font-size: medium" /></td>
          <td>&nbsp;</td>
          <td><input name="password" type="password" id="password" value="" style="width:180px; font-size: medium" /></td>
        </tr>
        <tr>
          <td><input name="do_login" type="submit" value=" Login " id="sbmt" style="width:100px; height:31px" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="z-index:1;">
  <tr>
    <td>
    <div style="padding:10px 0 10px 0;">
    	<div style=" margin-left:20px; margin-right:auto; color:#fff; font-size:x-small">&copy; 2012 - <?=date("Y");?> Lingkar Arsa Technologies, All Rights Reserved </div>
    </div>
</td>
  </tr>
</table>
</body></html>

