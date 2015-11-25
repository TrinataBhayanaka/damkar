<?
	$appname=$this->lauth->get_appname();
	$userdata=isset($_SESSION[$appname]["userdata"])?$_SESSION[$appname]["userdata"]:FALSE;
	if(!$userdata):
		redirect("login/");
	endif;
	$id=$this->encrypt_status==TRUE?encrypt($userdata['id']):$userdata['id'];
?>

<header class="main-header">

    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>K</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><small><b>Admin</b> Kebencanaan</small></span>
    </a>


    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="glyphicon glyphicon-user"></i>
                  <span class="hidden-xs"><?=$userdata["first_name"]?> <?php echo $userdata["last_name"]?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?=base_url()?>login/logout/" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>

        </div>

    </nav>

</header>