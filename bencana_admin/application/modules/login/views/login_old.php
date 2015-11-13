<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style>
html,body{
	background-color:#565758;
}	
.boxLogin {
	width:360px;
	margin:auto;
	background:#565758 url("../img/bk_login_ver.jpg") no-repeat -5px bottom;
	/*margin-top:150px;*/
	padding:0px;
	padding-top:150px;
}

.boxLogin  div.fields {
	width:330px;
	padding:20px 20px 20px 20px;
	height:230px;
	background:#fff url("<?=base_url()?>assets/bk_login_rpx.png") repeat-x top right;
	overflow:hidden;
	border-bottom-right-radius: 3px;
    border-top-right-radius: 3px;
	border-bottom-left-radius: 3px;
    border-top-left-radius: 3px;
	box-shadow:auto;
}


.boxLogin  .fields p.error {
	background:transparent;
}

.fields p.rem {
	padding:10px 0 0 100px;
}

.fields p label { display:inline-block;}

.action {
	/*padding:10px 15px 0 0;*/
	padding-top:10px;
	/*text-align:right;*/
}
.clearfix:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}

.clearfix {
    display: block;
}
</style>
<?php loadCss("form");?>
<?php loadCss("styles");?>

<!-- LOAD LIBRARY JQUERY/JAVASCRIPT -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url();?>assets/js/1.7.2/jquery.min.js"><\/script>');
</script>
<? echo js_asset("jquery.cookie.js");?>
<script>
	$(document).ready(function(){
		$('#username').val($.cookie('username'));
		$('#password').val($.cookie('password'));
		if($.cookie('check')==1){
			$('#check').attr("checked",true);
		}else{
			$('#check').attr("checked",false);
		}
		
		$("#a_login").click(function(e){
			e.preventDefault();
			var username= $('#username').val();
			var password = $('#password').val();
			var cook = $('#check').attr('checked');
			
			if(cook == true){
				$.cookie('username', username);
				$.cookie('check', 1);
				$.cookie('password', password);
			}else{
				//clear cookies
				$.cookie('check', 0);
				$.cookie('username', '');
				$.cookie('password', '');
			}
			
			$("#frmlogin").submit();
			/*$.post("<?=base_url("login/check/")?>",$("#frmlogin").serialize());*/
		});
		
		$('#password').keypress(function(e) {
			if(e.which == 13) {
            	$(this).blur();
            	setTimeout(function(){
					$('#a_login').focus().click()
				},500);
        	}
		});
	});
	
	function Alert(title,message){
		apprise("<b>"+title+"</b><p>"+message+"</p>");  
	}
	
	function alertme(){
		alert("test");
	}
	
	function removeScript(){
		var str=$('#cboxLoadedContent').html();
		str=str.replace("/<script\b[^>]*>(.*?)<\/script>/i", "");
		str=str.replace("/<styles\b[^>]*>(.*?)<\/styles>/i", "");
		str=str.replace("/<link href\b[^>]*>(.*?)<\/link>/i", "");
		$('#cboxLoadedContent').html(str);
	}
	
	function close_colorbox(){
		$.colorbox.close();
	}
	
</script>
</head>

<body style="margin:0;background-color:#565758;">
<div class="content" style="margin:0">

<div class="boxLogin clearfix">
			<form action="<?=base_url("login/check/")?>" id="frmlogin" method="post">
              <div class="fields">
              	<h2 style="font-size:20px;margin-bottom:30px">APP-LPPMHP</h2>
                <p class="sep">
                  <label class="small" for="username">User name</label>
                  <input type="text" value="" class="sText" name="username" id="username"/>
                </p>
			    <p class="sep">
                  <label class="small" for="password">Password</label>
                  <input type="password" value="" class="sText" name="password" id="password"/>
                </p>
			    <p class="rem">
                  <input class="sCheck" type="checkbox" name="check" value="1" id="check"/>
			      <label for="check">Remember me</label>
                </p>
                <div style="border-top: 1px solid #D3D3D3;height:2px"></div>
                
              
                 <div class="action">
                   <div style="float:left"><!--<a  href="<?=base_url("info")?>?no_head=1" id="a_help" class="button left"><span class="iconize icon_help"></span>Help?</a>--></div>
                  <div style="float:right">
                  <a href="<?=base_url("login/check/")?>" id="a_login" class="btn"><span class="iconize icon_old_user"></span>Login</a>
                  </div>
                  <div class="clearfix"></div>
                  </div>
             </div>
			</form>
</div>
</div>
</body>
</html>
