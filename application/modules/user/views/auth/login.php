<? $this->load->view("layout/header");?>
<style>
#login-wraper {
	margin-top:50px;
    display: block;
    padding: 0px;
    height: auto;
	border-radius:3px;
    background: #f8f8f8;
}
#login-body {
	padding:20px;
}
#login-footer {
	padding:20px;
	background:#eee
}
.shadow {
	-moz-box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .body {
    padding-bottom: 30px;
    border-bottom: 0px solid rgb(238, 238, 238);
}
.div_message p {
	margin:0!important;
}
.login-row{

}
</style>
<?php echo form_open("user/login");?>
<div class="container">
    <div id="login-wraper" class="shadow">
    <div id="login-body">
        <!--<div class="row">
            <div class="col-md-12"><?php echo message_box();?></div>
        </div>-->
        <div class="row">
            <div class="col-md-5" style="padding:10px; border-right:1px dotted #ddd">
            	<div class="row">
                    <div class="col-md-11">
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
            </div>
            <div class="col-md-7" style="padding:10px;">
                    <legend>Belum menjadi anggota?</legend>
                    <label>Dengan menjadi anggota online <strong>BRWA</strong>, anda dapat:</label>
                        <ul class="unstyled">
                            <li>Mendaftarkan Wilayah adat secara online</li>
                            <li>Anda dapat mengetahui proses Registrasi Wilayah adat</li>
                            <li>Mendapatkan Notifikasi proses</li>
                        </ul>
                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-5" style="padding-left:10px; border-right:1px dotted #ddd">
                <button type="submit" class="btn btn-primary" style="margin-right:10px"><?php echo lang('login_submit_btn'); ?></button>
				<div class="checkbox-inline">
                    <label style="font-weight:normal">
                        <?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?><?php //echo lang('login_remember_label');?>
                    </label>
                </div>
            </div>
            <div class="col-md-7" style="padding-left:10px;">
                <a href="user/register" class="btn btn-primary"><?php echo lang('login_register');?></a>
            </div>
        </div>
        
        </div>
        <!--login-body-->
        <!--login-footer-->
        <div id="login-footer">
            <div class="row">
                <div class="col-md-12" style="padding-left:10px">
                    <a href="user/forgot_password"><?php echo lang('login_forgot_password');?></a><br />
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php echo form_close();?>
<div class="container">
	 <div class="row">
        <div class="col-md-12" style="margin-top:20px; padding-left:30px;">&copy; 2011-<?=date("Y");?> <a href="https://brwa.or.id/"><b>BRWA</b></a>, All rights reserved.  </div>
    </div>
</div>