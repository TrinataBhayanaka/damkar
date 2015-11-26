<? $this->load->view("login/login_header")?>
		
        <div id="login-container" style="top:80px">

            <div id="logo">
                <a href="<?=base_url()?>">
                    <img src="assets/images/Pemadam_200.png" width="100" height="100" alt="Logo" />
                </a>
            </div>

            <div id="login">

                <h3>Dinas Pemadam Kebakaran</h3>

                <h5>Silahkan Login untuk mendapatkan akses</h5>

                <form id="frmlogin" action="<?=base_url()."login/auth/"?>" method="post" class="form">

                    <div class="form-group">
                        <input type="text" class="form-control" name="uid" id="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="pwd" id="password" placeholder="Password">
                    </div>

                    <div class="form-group">

                        <button type="submit" id="login-btn" class="btn btn-primary btn-block">Login &nbsp; <i class="fa fa-play-circle"></i></button>

                    </div>
                </form>

            </div> <!-- /#login -->


        </div> <!-- /#login-container -->
        
        
<? $this->load->view("login/login_footer")?>


