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
            <li><a href="<?=base_url()?>admin/"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">Add</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->

<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<div class="pull-left">
            <ul class="tab-bar grey-tab">
                <li>
                    <a href="<?php echo $this->module?>">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li class="active">
                    <a href="<?php echo $this->module?>add">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                <!--<li class="">
                    <a href="<?php //echo $this->module?>add_dok/<?//=$arrdata['id'];?>">
                        <span class="block text-center">
                            <i class="icon-file"></i> 
                        </span>
                        Input Dokumen <?//=$this->module_title?>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
        <thead>
        <tr>
        <th width="20">No.</th>
        <th width="20">&nbsp;</th>
        <th class="forder" width="100" rel="date">Nama</th>
        <th class="forder" width="300" rel="title">Email</th>
        <th>Tanda Pengenal</th>
		<th>Nomor Pengenal</th>
        </tr>
        </thead>
        <tbody>
        	<?php foreach($data_user as $x=>$v):?>
            <? $id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];?>
            <tr>
					<td><?=($x+1);?></td> 	
                    <td></td> 	
                    <td rel="date_col" width="150"><a href="<?=$this->module?>add/<?=$id?>"><?=$v['nama'];?></a></td>
                    <td rel="title_col"><?=$v['email'];?></td>
                    <td><?=$v['tanda_pengenal'];?></td>
					<td><?=$v['nomor_pengenal'];?></td>
                </tr>
               <?php endforeach;?> 
        </tbody>
        </table>
    
    </div>
</div>