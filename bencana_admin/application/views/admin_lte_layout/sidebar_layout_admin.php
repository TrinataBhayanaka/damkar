<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="header">MAIN MENU</li>
            <li class="active">
                <a href="admin/dashboard/">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <? if(($this->cms->has_read("wa_reg/wa_reg/"))||($this->cms->has_read("reg/"))||($this->cms->has_read("ver/"))||($this->cms->has_read("ser/"))||($this->cms->has_read("keberatan/"))||($this->cms->has_read("register/register/"))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Wilayah & Sektor/UPT</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="wilayah/wilayah"><i class="fa"></i>Wilayah List</a></li>
                    <li><a href="wilayah/sektor"><i class="fa"></i>Sektor /UPT List</a></li>
                </ul>
            </li>
            <? endif; ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Personel</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <? //if($this->cms->has_read("register/register/")):?>
                    <li><a href="personel/"><i class="fa"></i>Personel List</a></li>
                    <? //endif; ?>
                    
               </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i>
                    <span>Data Bencana</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <? //if($this->cms->has_read("register/register/")):?>
                    <li><a href="bencana/"><i class="fa"></i>Bencana List</a></li>
                    <? //endif; ?>
                    
               </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Statistik Informasi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <? //if($this->cms->has_read("register/register/")):?>
                    <li><a href="bencana/"><i class="fa"></i>Statistik Informasi List</a></li>
                    <? //endif; ?>
                    
               </ul>
            </li>
            <!--<li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-fire"></i>
                    <span>Kejadian</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <? //if($this->cms->has_read("register/register/")):?>
                    <li><a href="kejadian/kejadian"><i class="fa"></i>Kejadian List </a></li>
                    <? //endif; ?>
                    
               </ul>
            </li>-->

            <? if(($this->cms->has_read("admin/articles/"))||($this->cms->has_read("admin/news/"))||($this->cms->has_read("admin/slider/"))||($this->cms->has_read("admin/rss/"))):?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span>Web Content</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="admin/slider"><i class="fa"></i>Carousel</a></li>
                    <li><a href="admin/news"><i class="fa"></i>Berita </a></li>
                    <li><a href="admin/articles"><i class="fa"></i>Artikel </a></li>
                    <li><a href="admin/agenda"><i class="fa"></i>Agenda </a></li>
                    <li><a href="galeri/galerialbum/"><i class="fa"></i>Galeri Album</a></li>
                    <li><a href="galeri/galerifoto/"><i class="fa"></i>Galeri Foto</a></li>
                    <li><a href="admin/rss"><i class="fa"></i>RSS </a></li>
                </ul>
            </li>
            <? endif; ?>
            <? if($this->cms->has_read("admin/pages/")):?>
                 <li class="treeview">
                    <a href="#">
                        <i class="fa fa-clone"></i>
                        <span>Web Pages</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="admin/pages/index/pbrwa"><i class="fa"></i>Profil </a></li>
                        <li><a href="admin/pages/index/peraturan"><i class="fa"></i>Peraturan </a></li>
                        
                    </ul>
                </li>
                <?php endif;?>
                <? if($this->cms->has_read("admin/link_manager/")):?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>Web Links</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="admin/link_manager/category_list"><i class="fa"></i>Category</a></li>
                        <li><a href="admin/link_manager/link_list"><i class="fa"></i>Link</a></li>
                    </ul>
                </li>
                <?php endif;?>

        </ul>
    </section>
</aside>


