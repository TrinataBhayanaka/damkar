<?php //pre($this->cms->has_read("reg/"));exit;?>
<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--<div class="user-panel">
                        <div class="pull-left image">
                            <img src="assets/themes/admin_lte/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>-->
                    <!-- search form -->
                    <!--<form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <?php //if($this->cms->has_read("admin/dashboard")):?>
                        <li class="active">
                            <a href="admin/dashboard/">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                      <? //endif; ?> 
                      <li class="treeview">
                            <a href="#">
                                <i class="fa fa-code"></i>
                                <span>Wilayah & Sektor/UPT</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="wilayah/wilayah"><i class="fa"></i>List Wilayah</a></li>
                                <li><a href="wilayah/sektor"><i class="fa"></i>List Sektor/UPT</a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>
						<? if(($this->cms->has_read("wa_reg/wa_reg/"))||($this->cms->has_read("reg/"))||($this->cms->has_read("ver/"))||($this->cms->has_read("ser/"))||($this->cms->has_read("keberatan/"))||($this->cms->has_read("register/register/"))):?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-puzzle-piece"></i>
                                <span>Data Bencana</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<? //if($this->cms->has_read("register/register/")):?>
								<li><a href="bencana/bencana"><i class="fa"></i>List Bencana</a></li>
                                <? //endif; ?>
								<? //if($this->cms->has_read("wa_reg/wa_reg/")):?>
								<li><a href="bencana/tambah"><i class="fa"></i>Tambah Bencana</a></li>
                                <? //endif; ?>
								<!--<? if($this->cms->has_read("reg/reg/")):?>
								<li><a class="mnu_reg" href="reg"><i class="fa"></i>Registrasi</a></li>
                                <? endif; ?>
								<? if($this->cms->has_read("ver/")):?>
								<li><a class="mnu_ver" href="ver"><i class="fa"></i>Verifikasi </a></li>
								<? endif; ?>
								<? if($this->cms->has_read("ser/")):?>
								<li><a class="mnu_ser" href="ser"><i class="fa"></i>Sertifikasi </a></li>
								<? endif; ?>
								<? if($this->cms->has_read("keberatan/")):?>
								<li><a class="mnu_keberatan" href="keberatan"><i class="fa"></i>Pengajuan Keberatan </a></li>
								<? endif; ?>-->
						   </ul>
                        </li>
                        <? endif; ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Personel</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="personel/personel"><i class="fa"></i>Personel List</a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i>
                                <span>Peraturan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="personel/personel"><i class="fa"></i>Personel List</a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-calendar"></i>
                                <span>Agenda</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="personel/personel"><i class="fa"></i>Personel List</a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>

                        <!--<li class="treeview">
                            <a href="#">
                                <i class="fa fa-puzzle-piece"></i>
                                <span>Kejadian</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="kejadian/kejadian"><i class="fa"></i>Kejadian List </a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>-->

                        <!--<li class="treeview">
                            <a href="#">
                                <i class="fa fa-code"></i>
                                <span>Master Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="kejadian/kejadian"><i class="fa"></i>Isinya apa hayoo </a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>

                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-o"></i>
                                <span>Fasilitas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="kejadian/kejadian"><i class="fa"></i>Isinya apa hayoo </a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li>-->

                        <? if($this->cms->has_read("admin/link_manager/")):?>
                        <!--<li class="treeview">
                            <a href="#">
                                <i class="fa fa-link"></i>
                                <span>Web Links</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin/link_manager/category_list"><i class="fa"></i>Category</a></li>
                                <li><a href="admin/link_manager/link_list"><i class="fa"></i>Link</a></li>
                            </ul>
                        </li>-->
                        <?php endif;?>

                        <? if(($this->cms->has_read("admin/articles/"))||($this->cms->has_read("admin/news/"))||($this->cms->has_read("admin/slider/"))||($this->cms->has_read("admin/rss/"))):?>
                        <!--<li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Web Content</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="admin/slider"><i class="fa"></i>Carousel</a></li>
                                <li><a href="admin/news"><i class="fa"></i>Berita </a></li>
								<li><a href="admin/articles"><i class="fa"></i>Artikel </a></li>
								<li><a href="admin/rss"><i class="fa"></i>RSS </a></li>
                            </ul>
                        </li>-->
                        <? endif; ?>
                        
                        <!-- <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Configuration</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <? //if($this->cms->has_read("register/register/")):?>
                                <li><a href="kejadian/kejadian"><i class="fa"></i>Isinya apa hayoo </a></li>
                                <? //endif; ?>
                                
                           </ul>
                        </li> -->
                        
                      <?php if($this->cms->has_admin("admin/config_/")):?>
                        <!-- <li class="active">
                            <a href="admin/config_/">
                                <i class="fa fa-briefcase"></i> <span>ACL Manager</span>
                            </a>
                        </li> -->
                      <? endif; ?>  
                        <?php //endif;?>
                        
                        
                        <!--
                        <li>
                            <a href="pages/widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="pages/calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="pages/mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>                                
                                <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>