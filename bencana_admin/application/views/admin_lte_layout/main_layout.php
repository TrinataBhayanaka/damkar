<? $this->load->view("admin_lte_layout/header");?>
<?
	$appname=$this->lauth->get_appname();
	$userdata=isset($_SESSION[$appname]["userdata"])?$_SESSION[$appname]["userdata"]:FALSE;
	if(!$userdata):
		redirect("login/");
	endif;
?>
<? $this->load->view("admin_lte_layout/header_layout");?>

<!-- start: main Menu -->
<?php //echo isset($sidebar)?$sidebar:$this->load->view("admin_layout/menu_example");?>
<!-- end: main Menu -->

<!-- start: Wrapper-->
<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php
	$this->load->view("admin_lte_layout/sidebar_layout_admin");
	// $sess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
	// if($sess['group_brwa'] == 1):
		// $this->load->view("admin_lte_layout/sidebar_layout_admin");
	// elseif($sess['group_brwa'] == 2):
		// $this->load->view("admin_lte_layout/sidebar_layout_pusat");
	// elseif($sess['group_brwa'] == 9):
		// $this->load->view("admin_lte_layout/sidebar_layout_operator");
	// else:
		// $this->load->view("admin_lte_layout/sidebar_layout_daerah");
	// endif;
	?>

	
    <!-- Right side column. Contains the navbar and content of the page -->
     <aside class="right-side">                
     	<!-- Content Header (Page header) -->
          <? if(cek_var($this->layout_data["page_title"])):?>
          <section class="content-header">
                <h1>
                   <?php echo $this->layout_data["page_title"]?$this->layout_data["page_title"]:"";?>
                   <small><?php echo $this->layout_data["page_title_small"]?$this->layout_data["page_title_small"]:"";?>
                   </small>
                </h1>
           </section>
           <? endif;?>

                <!-- Main content -->
                <section class="content">
                	<? if(cek_var($this->layout_data["breadcrumb"])):?>
                    	<?php echo $this->layout_data["breadcrumb"];?>
					<? endif;?>
					<?php echo $content;?>
				</section><!-- /.content -->
        </aside><!-- /.right-side -->
</div>
<!-- end: Wrapper-->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
    
</div>

<!--<div class="clearfix"></div>-->
<!--<br><br>-->

<? $this->load->view("admin_lte_layout/footer");?>