<? $this->load->view("login/login_header")?>
		
        <div class="form-box" id="login-box">
        	<div class="header">Sign In</div>
            <?php echo message_box();?>
            <form id="frmlogin" action="<?=base_url()."login/auth/"?>" method="post">
            	<input type="hidden" name="act" id="act" value="login"/>
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="uid" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pwd" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button id="a_login" type="submit" class="btn bg-olive btn-block">Login</button>  
                    
                    <!--<p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            </form>

        </div>
        
<? $this->load->view("login/login_footer")?>


