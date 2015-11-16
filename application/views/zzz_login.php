<? $this->load->view("admin_layout/header");?>
<? echo js_asset("jquery.cookie.js");?>
<? echo js_asset("lingkar/app.pack.js");?>


			<form id="frmlogin" action="<?=base_url()."login/auth/"?>" method="post" class="well form-search">
              <input type="text" name="username"  id="username" class="input-small" placeholder="User Name">
              <input type="password" name="password" id="password" class="input-small" placeholder="Password">
              <a href="<?=base_url()."login/auth/"?>" id="a_login" class="btn btn-primary"><i class="icon-user"></i>&nbsp;Login</a>
              
               <label class="inline" for="remember" style="vertical-align: bottom;">
               <br>
              <!-- <input class="sCheck" type="checkbox" name="check" value="1" id="check"/>
                Remember me? </label>-->
            </form>
            
            
<? $this->load->view("admin_layout/footer");?>            
            
            
            