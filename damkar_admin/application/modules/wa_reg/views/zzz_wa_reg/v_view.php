<style>
	.simplecolorpicker{
		border:thin solid #DADADA !important;
	}
	.frm h3{
		color:#aaa;
		background:#eee;
		padding:5px;
		border-radius:3px
	}
</style>

<?php
	$arrLookupGroup=m_lookup("event_categories","id_name","name",""," order by order_num asc "); 
?>

<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>">Master Data</a> <span class="divider"></span></li>
        	<li class="active">View</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<? $id=$this->encrypt_status==TRUE?encrypt($data["idx"]):$data["idx"];?>
<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<ul class="tab-bar grey-tab">
                <li>
                    <a href="<?=$this->module?>listview/">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <!--<li>
                    <a href="<?//=$this->module?>add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?//=$this->module_title?>
                    </a>
                </li>-->
                
                 <li class="active">
                    <a href="javascript:void(0)">
              
                        <span class="block text-center">
                            <i class="icon-search"></i> 
                        </span>
                        View <?=$this->module_title?>
                    </a>
                </li>
                
                 <li>
                    <a href="<?=$this->module?>edit/<?=$id?>">
                  		<span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_title?>
                    </a>
                </li>
               <li class="">
                    <a href="<?php echo $this->module?>add_dok/<?=$id?>">
                        <span class="block text-center">
                            <i class="icon-file"></i> 
                        </span>
                        Input Dokumen <?=$this->module_title?>
                    </a>
                </li>
                <li class="pull-right">
                    <a class='red' onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$this->module?>del/<?=$id?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete <?=$this->module_title?>
                    </a>
                </li>
                
            </ul>
       
    	
    </div>
</div>


<div class="row">
	<div class="col-md-6 frm">
    <h3>Kewilayahan</h3>
    <table class="table table-condensed table-bordered">
    	<tr><td class="strong">Nama Kewilayahan</td><td>:</td><td><?=$data["nama_kewilayahan"]?></td></tr>
        <td style="width:200px" class="strong">Propinsi</td><td width="5">:</td><td><?=$arr_propinsi[$data["id_propinsi"]]?></td></tr>
        <tr><td class="strong">Kabupaten/Kota</td><td>:</td><td><?=$arr_kabupaten[$data["id_kabupaten"]]?></td></tr>
        <tr><td class="strong">Kecamatan</td><td>:</td><td><?=$data["kecamatan"]?></td></tr>
        <tr><td class="strong">Desa</td><td>:</td><td><?=$data["desa"]?></td></tr>
      
    </table>
    
    <h3 class="heading">Wilayah Adat</h3>
    <table class="table table-condensed table-bordered">
    	<tr><td class="strong">Luas</td><td>:</td><td><?=$data["luas"]?> Ha</td></tr>
        <td style="width:200px" class="strong">Kondisi Fisik</td><td width="5">:</td><td><?=$arr_wa_kondisi_fisik[$data["id_kondisi_fisik"]]?></td></tr>
        <tr><td class="strong">Satuan</td><td>:</td><td><?=$data["satuan"]?></td></tr>
        
    </table>
    
    
    <h3 class="heading">Kependudukan</h3>
    <table class="table table-condensed table-bordered">
    	
        <tr><td class="strong">Jumlah KK</td><td width="5">:</td><td><?=$data["kepala_keluarga"]?></td></tr>
        <td style="width:200px" class="strong">Jumlah Laki-laki</td><td width="5">:</td><td><?=$data["laki_laki"]?></td></tr>
        <tr><td class="strong">Jumlah Perempuan</td><td>:</td><td><?=$data["perempuan"]?></td></tr>
        <tr><td class="strong">Mata Pencaharian Utama</td><td>:</td><td><?=$data["mata_pencaharian"]?></td></tr>
        
    </table>
    
    
     <h3 class="heading">Kelembagaan Wilayah Adat</h3>
    <table class="table table-condensed table-bordered">
        <tr><td class="strong">Nama Lembaga Adat</td><td width="5">:</td><td><?=$data["nama_lembaga_adat"]?></td></tr>
        <td style="width:200px" class="strong">Struktur</td><td width="5">:</td><td><?=$data["struktur"]?></td></tr>
    </table>
    
    
     <h3 class="heading">Keaneka ragaman hayati</h3>
    <table class="table table-condensed table-bordered">
        <tr><td class="strong" width="200px">Ekosistem</td><td width="5">:</td><td><?=$arr_wa_ekosistem[$data["id_jenis_ekosistem"]]?></td></tr>
		<tr><td class="strong" width="200px">Potensi & Manfaat Keanekaragaman Hayati</td><td width="5">:</td><td><?=$arr_wa_potensihayati[$data["id_potensi_hayati"]]?></td></tr>
    </table>
    
    
    
    
    
   	<br><br> 
   
</div>
<div class="col-md-6 frm">
<!--<h5 class="heading">Kontak</h5>-->
    <h3 class="heading">Pemohon</h3>
    <table class="table table-condensed table-bordered">
    	<tr><td class="strong">Nama</td><td width="5">:</td><td><?=$data["nama_pemohon"]?></td></tr>
        <tr><td class="strong">Jabatan</td><td>:</td><td><?=$data["jabatan_pemohon"]?></td></tr>
        <tr><td class="strong">Alamat</td><td>:</td><td><?=$data["alamat_pemohon"]?></td></tr>
        <tr><td class="strong">Telp</td><td>:</td><td><?=$data["telp_pemohon"]?></td></tr> 
        <tr><td class="strong">HP</td><td>:</td><td><?=$data["hp_pemohon"]?></td></tr> 
        <tr><td class="strong">Fax</td><td>:</td><td><?=$data["fax_pemohon"]?></td></tr>
        <tr><td class="strong">Email</td><td>:</td><td><?=$data["email_pemohon"]?></td></tr>   
    </table>
    
    <h3 class="heading">Penanda Tangan</h3>
    <table class="table table-condensed table-bordered">
    	<tr><td class="strong">Nama</td><td width="5">:</td><td><?=$data["nama_tt"]?></td></tr>
        <tr><td class="strong">Jabatan</td><td>:</td><td><?=$data["jabatan_tt"]?></td></tr>
        <tr><td class="strong">Alamat</td><td>:</td><td><?=$data["alamat_tt"]?></td></tr>
        <tr><td class="strong">Telp</td><td>:</td><td><?=$data["telp_tt"]?></td></tr> 
        <tr><td class="strong">HP</td><td>:</td><td><?=$data["hp_tt"]?></td></tr> 
        <tr><td class="strong">Fax</td><td>:</td><td><?=$data["fax_tt"]?></td></tr>
        <tr><td class="strong">Email</td><td>:</td><td><?=$data["email_tt"]?></td></tr>   
    </table>
</div>
</div>
