<? $this->load->view("login/login_header")?>

<div class="login-box">
  <div class="login-logo">
    <img src="assets/image/dagri_logo.png"><br>
    <a href="<?=base_url()?>"><b>Admin</b>  Kebencanaan</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="<?=base_url()."login/auth/"?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="uid" id="username" class="form-control" placeholder="User ID">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         
        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
      </div>
    </form>

  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
        
<? $this->load->view("login/login_footer")?>