<style>
#fdatalist th,table{
    border:1px solid #F0F0F0;
}
</style>
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
             <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=base_url()?>/register/register">Content</a> <span class="divider"></span></li>
            <li class="active"><?=$this->module_title?></li>
         </ul>
        <!-- end: breadcrumbs -->
   </div><!-- cols -->
</div> <!-- row -->

<div style="padding:0px;">
	<div class="row topbar box_shadow">
		<div class="col-md-12">
			<div class="pull-left">
				<ul class="tab-bar grey-tab">
					<li class="active">
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-list"></i> 
							</span>
							Daftar <?=$this->module_title?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>" id="addData">
							<span class="block text-center">
								<i class="icon-plus"></i> 
							</span>
							Input <?=$this->module_title?>
						</a>
					</li>
					<li>
						<a href="<?php echo $this->module?>" id="refresh">
							<span class="block text-center">
								<i class="icon-refresh"></i> 
							</span>	
							Refresh
						</a>
					</li>
				</ul>
			</div>
			<form class="search_form col-md-3 pull-right" action="#" method="get">
				<div style="padding-top:5px;" class="input-group">
              <input id="valueparameter" name="q" class="form-control input-search" value="<?=$key?>" placeholder="Search..." type="text">
              <span class="input-group-btn">
                <a id="btnsearch" href="<?=base_url()?>wilayah/sektor/index/0/10/1" class="btn btn-default"><i class="fa fa-search"></i></a>
              </span>
            </div>
			</form>
		</div>
	</div>
    <div class="alert alert-success alert-dismissible" id="message" style="display:none">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <p class="message"></p>
      </div>
    <form name="frmMain" action="<?=$this->module?>kejadian/importInsert" method="post" id="fdatalist" style="overflow:scroll">
	<?php //echo message_box();?>
    
        <table width="100%" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
        <thead>
        <tr>
        <th width="20" rowspan="2" class="text-center">No.</th>
        <th width="20" rowspan="2" class="text-center">No. Kejadian</th>
        <th class="forder text-center" width="100" rel="date" colspan="2">Provinsi</th>
        <th class="forder  text-center" width="300" rel="title" colspan="2">Kabupaten</th>
        <th rowspan="2" class="text-center">Bencana/Kejadian</th>
        <th class="text-center">Waktu Kejadian</th>
        <th class="text-center" colspan="4">Korban Meninggal</th>
        <th class="text-center">Penyebab</th>
        <th class="text-center">Objek</th>
		<th class="text-center">Nilai Kerugian</th>
		<th width="50" class="text-center">Jumlah Pengusian</th>
        </tr>
        <tr>
            <th class="text-center">kode</th>
            <th class="text-center">nama</th>
            <th class="text-center">kode</th>
            <th class="text-center">nama</th>
            <th class="text-center">tgl/bln/thn</th>
            <th class="text-center">Meninggal</th>
            <th class="text-center">hilang</th>
            <th class="text-center">terluka</th>
            <th class="text-center">mengungsi</th>
        </tr>
        </thead>
        <tbody>
    
  <? 
  $i=1;
  if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
  		$tr_color=($k%2)?"#fff":"#fafafa";

		$id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];
		$url_edit = $module."edit/".$id;
		$url_delete = $module."delete/".$id;
		
		$status_badges = ($v['status']==1)?'<span class="label label-info">Active</span>':'<span class="label label-warning">Non Active</span>';
		$reg = ($v['status']==1)?"<a href='wa_reg/add/$id'><span class='label label-success'>Registrasi</span></a>":'';
		
   ?>
            	<tr>
					              
                    <td class="text-center"><?=$i++;?></td>     
                    <td><?=$v['A'];?></td>     
                    <td rel="date_col" width="150"><?=$v['B'];?></td>
                    <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['C'];?></a></td>
                    <td><?=$v['D'];?></td>
                    <td><?=$v['E'];?></td>
                    <td><?=$v['G'];?></td>
                    <td><?=$v['H'];?></td>
                    <td><?=$v['I'];?></td>
                    <td><?=$v['J'];?></td>
                    <td><?=$v['K'];?></td>
                    <td><?=$v['L'];?></td>
                    <td><?=$v['M'];?></td>
                    <td><?=$v['N'];?></td>
                    <td><?=$v['O'];?></td>
					<td><?=$v['P'];?></td>
            	</tr>
                
        <? } }?>
        		<tr>
                	<td colspan="2">
                             <input type="submit" class="btn btn-primary" value="Simpan">
				    </td>
                </tr>
        </tbody>
        </table>
		</form>
        <div class="row tables_info">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="displaying">Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries,</div>
                        <div class="displaying">
                            Rows/page:   
                        </div>
                        <div class="displaying">
                            <?=$perpage;?>    
                        </div>
                    </div>
                </div>
            </div>
           <div class="col-md-8">
                <?=$paging;?>
            </div>
        </div>
</div>


<br />
<br />
</div>