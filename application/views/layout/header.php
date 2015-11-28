<?php //echo "aaa";exit;?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title><?=$this->cms_cfg['site_title']?></title>
	<meta name="keywords" content="HTML5,CSS3,Template" />
	<meta name="description" content="" />
	<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

	<!-- Facebook Open Graph Meta Tags -->
	<? $url = 'http://'.$_SERVER['HTTP_HOST'];  $uri=$_SERVER['REQUEST_URI']; ?>

<base href="<?=BASE_URL;?>" />
	<!-- mobile settings -->
	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

	<!-- WEB FONTS : use %7C instead of | (pipe) -->
	<link href="assets/themes/tmpl-byu/assets/plugins/google-fonts/gfonts.css" rel="stylesheet" type="text/css" />

	<!-- CORE CSS -->
	<link href="assets/themes/tmpl-byu/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- REVOLUTION SLIDER -->
	<link href="assets/themes/tmpl-byu/assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
	<link href="assets/themes/tmpl-byu/assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />

	<!-- THEME CSS -->
	<link href="assets/themes/tmpl-byu/assets/css/essentials.css" rel="stylesheet" type="text/css" />
	<link href="assets/themes/tmpl-byu/assets/css/layout.css" rel="stylesheet" type="text/css" />

	<!-- PAGE LEVEL SCRIPTS -->
	<link href="assets/themes/tmpl-byu/assets/css/header-1.css" rel="stylesheet" type="text/css" />
	<link href="assets/themes/tmpl-byu/assets/css/color_scheme/blue.css" rel="stylesheet" type="text/css" id="color_scheme" />

	<!-- JAVASCRIPT FILES -->
	<script type="text/javascript">var plugin_path = 'assets/themes/tmpl-byu/assets/plugins/';</script>
	<script type="text/javascript" src="assets/themes/tmpl-byu/assets/plugins/jquery/jquery-2.1.4.min.js"></script>

	<!-- JAVASCRIPT FILES -->
    <script type="text/javascript" src="assets/themes/tmpl-byu/assets/js/scripts.js"></script>
    
    
    <!-- REVOLUTION SLIDER -->
    <script type="text/javascript" src="assets/themes/tmpl-byu/assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/themes/tmpl-byu/assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/themes/tmpl-byu/assets/js/view/demo.revolution_slider.js"></script>

    <!--Morris.js [ OPTIONAL ]-->
	<script src="assets/themes/tmpl-byu/assets/plugins/morris-js/morris.min.js"></script>
	<script src="assets/themes/tmpl-byu/assets/plugins/morris-js/raphael-js/raphael.min.js"></script>

</head>

<body class="smoothscroll enable-animation">

		<!-- wrapper -->
		<div id="wrapper">

			<!-- Top Bar -->
			<div id="topBar">
				<div class="container">

					<!-- right -->
					<ul class="top-links list-inline pull-right">
					<? if ($this->ion_auth->logged_in()) { ?>
						<li class="text-welcome hidden-xs">Selamat Datang, <strong><?=$this->user_data['nama']?></strong></li>
						<li>
							<a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> MY ACCOUNT</a>
							<ul class="dropdown-menu pull-right">
								<li><a tabindex="-1" href="user/profile"><i class="fa fa-cog"></i> MY PROFILE</a></li>
								<li class="divider"></li>
								<li><a tabindex="-1" href="user/logout"><i class="glyphicon glyphicon-off"></i> LOGOUT</a></li>
							</ul>
						</li>
					<? } else { ?>
						<li class="text-welcome hidden-xs"><a href="user/register"><i class="fa fa-user hidden-xs"></i> Pengguna baru? Daftar <strong>disini</strong></a></li>
						<li class="text-welcome hidden-xs"><a href="user"><i class="fa fa-key hidden-xs"></i> Masuk</a></li>
					<? } ?>

					</ul>

					<!-- left -->
					<ul class="top-links list-inline">
						<li class="hidden-xs"><a href="#"><i class="fa fa-phone"></i> KONTAK (0123) 456789</a></li>
						<li class="hidden-xs"><a href="#"><i class="fa fa-envelope"></i> kebencanaan@kebencanaan.or.id</a></li>
					</ul>

				</div>
			</div>
			<!-- /Top Bar -->

			<div id="header" class="sticky shadow-after-3 clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- BUTTONS -->
						<ul class="pull-right nav nav-pills nav-second-main">

							<!-- SEARCH -->
							<li class="search">
								<a href="javascript:;">
									<i class="fa fa-search"></i>
								</a>
								<div class="search-box">
									<form action="search" method="get">
										<div class="input-group">
											<input type="text" name="src" placeholder="Pencarian" class="form-control" />
											<span class="input-group-btn">
												<button class="btn btn-primary" type="submit">Cari</button>
											</span>
										</div>
									</form>
								</div> 
							</li>
							<!-- /SEARCH -->
						</ul>
						<!-- /BUTTONS -->


						<!-- Logo -->
						<a class="logo pull-left" href="">
							<img src="assets/themes/tmpl-byu/assets/images/logo.png" alt="" />
						</a>
					<div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
							<nav class="nav-main">

								<ul id="topMain" class="nav nav-pills nav-main">
									<li>
										<a href="">BERANDA</a>
									</li>
									<li>
										<a href="pages/about">PROFIL</a>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" href="#">
											BERITA & ARTIKEL
										</a>
										<ul class="dropdown-menu">
											<li>
												<a href="news">
													BERITA
												</a>
											</li>
											<li>
												<a href="articles">
													ARTIKEL
												</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="pages/agenda">AGENDA</a>
									</li>
									<li>
										<a href="pages/agenda">PERATURAN</a>
									</li>
									<li>
										<a href="pages/galeri">GALERI</a>
									</li>
									<li>
										<a href="pages/statistik">STATISTIK</a>
									</li>

								</ul>

							</nav>
						</div>

					</div>
				</header>
				<!-- /Top Nav -->

			</div>