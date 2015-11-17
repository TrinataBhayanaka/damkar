<? //pre($data);?>
<? //pre($data_file);?>
<? //pre($data_personil);?>
<? //pre($data_daerah);?>
<?
$data_file_all=array();
if(cek_array($data_file)):
foreach($data_file as $x=>$val):
	$tmp=array();
	$tmp=array_map("trim",$val);
	$tmp["relative_path"]=$tmp["file_path"];
	$tmp["idx"]=$tmp["id_file"];
	$data_file_all[$val["tipe_doc"]][]=$tmp;
endforeach;
endif;

?>

<div class="row">
    <div class="scol-sm-12 col-lg-12">
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
            <li><a href="#">Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->folder?>">Operasi</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">Profile</li>
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
                <li>
                    <a href="<?=$this->module?>add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                
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
<div class="col-md-12 col-lg-12">
	<?php echo message_box();?>
    
     <div class="row">
		<div class="col-md-12">
        	<h5 class="heading">Data Informasi</h5>
            
            <table>
            	<tr>
                	<td width="300px">Judul</td><td width="10px">:</td><td><?=$data["judul"]?></td>
                </tr>
                 <tr>
                	<td>Sumber</td><td>:</td><td><?=$data["sumber"]?></td>
                </tr>
                <tr>
                	<td>Deskripsi</td><td>:</td><td><label style="height:auto;word-wrap:true"><?=$data["deskripsi"]?></td>
                </tr>
                 <tr>
                	<td>Tanggal</td><td>:</td><td><?=date2indo($data["tanggal"])?></td>
                </tr>
               
                 <tr class="ttop">
                	<td >Laporan</td><td>:</td><td>
                    	<?php if(cek_array($data_file_all["laporan"])):?>
                        	<table class="table table-condensed small-font table-bordered">
                            <thead>
                            	<tr><th>File</th></tr>
                            </thead>
                            <tbody>
                        	<?php foreach($data_file_all["laporan"] as $x=>$file):?>
                            	<tr><td><a href="<?=$file["file_path"]?>"><i class="icon-search"></i> <?=$file["file_name"]?></a></td></tr>
                            <?php endforeach;?>
                            </tbody>
                            </table>
                        <? else:?>
                        Belum ada file yang diupload!!
						<?php endif;?>
                    </td>
                </tr>
                
                <tr class="ttop">
                	<td >Dokumentasi Tambahan</td><td>:</td><td>
                    	<?php if(cek_array($data_file_all["dokumen"])):?>
                        	<table class="table table-condensed small-font table-bordered">
                            <thead>
                            	<tr><th>File</th></tr>
                            </thead>
                            <tbody>
                        	<?php foreach($data_file_all["dokumen"] as $x=>$file):?>
                            	<tr><td><a href="<?=$file["file_path"]?>"><i class="icon-search"></i> <?=$file["file_name"]?></a></td></tr>
                            <?php endforeach;?>
                            </tbody>
                            </table>
                        <? else:?>
                        Belum ada file yang diupload!!
						<?php endif;?>
                    </td>
                </tr>
                
                  <tr>
                	<td>Keyword</td><td>:</td><td><?php echo !empty($data["keyword"])?"<ul class='list-inline'><li class='label label-primary'  style='margin-right:5px' >".str_replace(",","</li><li class='label label-primary' style='margin-right:5px'>",$data["keyword"])."</li></ul>":"";?></td>
                </tr>
                
            </table>
</div></div>         
</div></div>

<script>
	$(function(){
		var act_link="<?=substr(trim($this->module), 0, -1);?>";	
		
		$(".menu-bar").find("li.active").removeClass("active");
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").addClass("active");
		
	});
</script>

<? //$this->load->view("active_menu");?>