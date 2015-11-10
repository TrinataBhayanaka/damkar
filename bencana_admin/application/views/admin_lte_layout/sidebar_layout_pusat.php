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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-puzzle-piece"></i>
                                <span>Wilayah Adat</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="register/register"><i class="fa"></i>Member List </a></li>
                                <li><a href="wa_reg/wa_reg"><i class="fa"></i>Pengajuan Baru</a></li>
                                <li><a class="mnu_reg" href="reg"><i class="fa"></i>Registrasi</a></li>
                                <li><a class="mnu_ver" href="ver"><i class="fa"></i>Verifikasi </a></li>
								<li><a class="mnu_ser" href="ser"><i class="fa"></i>Sertifikasi </a></li>
								<li><a class="mnu_keberatan" href="keberatan"><i class="fa"></i>Pengajuan Keberatan </a></li>
                            </ul>
                        </li>
						 <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Master Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            
                            <ul class="treeview-menu">
                                <li><a href="master_data/entitas"><i class="fa"></i>Entitas</a></li> 
                                <li><a href="master_data/jenis_ekosistem"><i class="fa"></i>Jenis Ekosistem</a></li>
                                <li><a href="master_data/jenis_document"><i class="fa"></i>Jenis Dokumen</a></li>
                                <li><a href="master_data/kondisi_fisik"><i class="fa"></i>Kondisi Fisik</a></li>                                
                                <li><a href="master_data/potensi_hayati"><i class="fa"></i>Potensi Hayati</a></li>
                                <li><a href="master_data/satuan"><i class="fa"></i>Satuan</a></li>
                                <li><a href="master_data/document"><i class="fa"></i>Dokumen</a></li>
                                <li><a href="master_data/tanda_pengenal"><i class="fa"></i>Tanda Pengenal</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>