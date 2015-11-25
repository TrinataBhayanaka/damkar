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
                    <i class="fa fa-puzzle-piece"></i>
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
                    <i class="fa fa-puzzle-piece"></i>
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
                    <i class="fa fa-puzzle-piece"></i>
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
                    <i class="fa fa-puzzle-piece"></i>
                    <span>Statistik Informasi</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <? //if($this->cms->has_read("register/register/")):?>
                    <li><a href="bencana/"><i class="fa"></i>Statistik Informasi List</a></li>
                    <? //endif; ?>
                    
               </ul>
            </li>
            <li class="treeview">
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
            </li>

        </ul>
    </section>
</aside>


