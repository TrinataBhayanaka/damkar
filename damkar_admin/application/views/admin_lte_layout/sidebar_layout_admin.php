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
                <li>
                    <a href="capaian_spm/capaian_spm">
                        <i class="fa fa-line-chart"></i>
                        <span>Capaian Target SPM</span>
                    </a>
                    
                </li>
            <? endif; ?>
            <li>
                <a href="personel/personel">
                    <i class="fa fa-users"></i>
                    <span>Personel</span>
                </a>
            </li>
            <li>
                <a href="kejadian/kejadian">
                    <i class="fa fa-ambulance"></i>
                    <span>Kejadian</span>
                </a>
            </li>
             <li>
                <a href="sarpras/sarpras">
                    <i class="fa fa-truck"></i>
                    <span>Sarana & Prasarana</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Master Data</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                
                <ul class="treeview-menu">
                    <li><a href="master_data/wilayah"><i class="fa fa-map"></i>Wilayah List</a></li> 
                    <li><a href="master_data/m_capaian_spm"><i class="fa  fa-area-chart"></i>Capaian SPM List</a></li> 
                    <li><a href="master_data/sektor"><i class="fa fa-map-marker"></i>Sektor List</a></li> 
                    <li><a href="master_data/jenisKebakaran"><i class="fa  fa-fire"></i>Jenis Kebakaran</a></li> 
                    <li><a href="master_data/jenisSarPras"><i class="fa fa-truck"></i>Jenis SarPras</a></li> 
                    <li><a href="master_data/jenisKompetensi"><i class="fa fa-file-text-o"></i>Jenis Kompentensi</a></li> 
                </ul>
            </li>
            <?php if($this->cms->has_admin("admin/account_manager/")):?>
              <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>Account Manager</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="admin/account_manager/"><i class="fa"></i>Users</a></li>
                    <li><a href="admin/account_manager/group_list"><i class="fa"></i>Groups</a></li>
                  <!--   <li><a href="setting/module/"><i class="fa fa-angle-double-right"></i>  Module</a></li> -->
                    <li><a href="admin/acl"><i class="fa"></i>ACL Groups </a></li>
                </ul>
            </li>
            <?php endif;?>

        </ul>
    </section>
</aside>