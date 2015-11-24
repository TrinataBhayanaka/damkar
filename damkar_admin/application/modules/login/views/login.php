<? $this->load->view("login/login_header")?>
		
        <div class="form-box" id="login-box">
        	<div class="header" style="text-align:center">
                <img src="assets/images/Pemadam_200.png" width="30%"/>
                <br/>DINAS PEMADAM KEBAKARAN</div>
            
            <form id="frmlogin" action="<?=base_url()."login/auth/"?>" method="post">
            	<input type="hidden" name="act" id="act" value="login"/>
                <div class="body bg-gray">
                	<?php echo message_box();?>
                    <div class="form-group">
                        <input type="text" name="uid" id="username" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pwd" id="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <!--<div class="form-group">
                        <input type="checkbox" name="check" id="check"/> Remember me
                    </div>-->
                </div>
                <div class="footer">                                                               
                    <button id="a_login" type="submit" class="btn bg-olive btn-block">Login</button>  
                    
                    <!--<p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            </form>
			
        </div>
        
        
<? $this->load->view("login/login_footer")?>


