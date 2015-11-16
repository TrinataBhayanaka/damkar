<? $this->load->view("login/login_header")?>
<style>
a {
	color:#03873d;
}
.container,.carousel {
        margin: 0 auto;
        max-width: 300px;
      }
#login-wraper {
	margin-top:50px;
    display: block;
    padding: 0px;
    width: 300px;
    height: auto;
	border-radius:3px;
    background: #ccc;
}
#login-body {
	padding:10px;
}
#login-footer {
	padding:10px;
	background:#eee
}
.shadow {
	-moz-box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .body {
    padding-bottom: 30px;
    border-bottom: 1px solid rgb(238, 238, 238);
}
.div_message p {
	margin:0!important;
}
.login-row{

}
</style>
    <?php echo form_open("admin/auth/login");?>
<div class="container">
    <div id="login-wraper" class="shadow">
    <div id="login-body">
        <div class="row-fluid">
            <div class="span12"><?php echo message_box();?></div>
        </div>
        <div class="row-fluid">
            <div class="span12" style="padding:10px;">
                        <input type="hidden" name="pending_url" value="<?=$this->session->flashdata('pending_url');?>" />
                    <legend><?php echo lang('login_heading');?></legend>
                    <div class="bodys">
                        <label><?php echo lang('login_identity_label');?></label>
                        <?php echo form_input($identity);?>
                        
                        <label><?php echo lang('login_password_label');?></label>
                        <?php echo form_input($password);?>
                    </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12" style="padding-left:10px">
                <button type="submit" class="btn btn-success" style="margin-right:10px"><?php echo lang('login_submit_btn'); ?></button>
            </div>
        </div>
        
        </div>
        <!--login-body-->
        <!--login-footer-->
        <div id="login-footer">
            <div class="row-fluid">
                <div class="span12" style="padding-left:10px">
					<div class="span12 help-block" style="margin-top:20px; padding-left:20px;">&copy; <?=date("Y");?> <a href="https://brwa.go.id/"><b>BRWA - ACEH</b></a>, All rights reserved.  </div>
				</div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php echo form_close();?>
        
<? $this->load->view("login/login_footer")?>


