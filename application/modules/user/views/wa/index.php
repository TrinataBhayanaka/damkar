<!-- Carousel
================================================== -->
<div class="subhead">
  <div class="container">
    <div class="subhead-caption" style="max-width:800px">
      <h1>Wilayah Adat</h1>
      <p class="lead">&nbsp;</p>
    </div>
  </div>
</div>
<?php $this->load->view('dok_menu',array("active"=>"user/wa"))?>
<?php $this->load->view('user/wa/menu',array("active"=>"list"))?>

<div class="container" style="margin-bottom:20px">
<div class="row">
<div class="col-md-12 content-page">
    <div class="row">
        <div class="col-md-12">
          <h3 class="sub" style="border-bottom:2px solid #aaa">Indeks</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <?php if (is_array($list)) { ?>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
                <thead>
                <tr>
                <th width="20">No.</th>
                <th class="forder" width="120" rel="date">Tanggal daftar</th>
                <th class="forder" width="300" rel="title">Nama Kewilayahan</th>
                <th width="400">Lokasi</th>
                <!--<td class="tbldata_header forder">Alamat</td>-->
                <th width="100">Proses</th>
                <th width="160">Status</th>
                <th width="80">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?
					$p1=m_lookup("wa_proses_status","id_status","status","id_proses='1'");
					$p2=m_lookup("wa_proses_status","id_status","status","id_proses='2'");
					$p3=m_lookup("wa_proses_status","id_status","status","id_proses='3'");
				?>
          <? foreach($list as $k=>$v) {
                $tr_color=($k%2)?"#fff":"#fafafa";
				$id=$this->encrypt_status==TRUE?encrypt($v[$this->tbl_idx]):$v[$this->tbl_idx];
                $url_edit = $module."wa/view/".$id;
                $url_delete = $module."wa/delete/".$id;
                
				switch($v['doc_proses']) {
					case '1':
						$proses_badges = '<span class="label label-info">Registrasi</span>';
						$status_badges = $p1[$v['doc_status']];
						break;
					case '2':
						$proses_badges = '<span class="label label-warning">Verifikasi</span>';
						$status_badges = $p2[$v['doc_status']];
						break;
					case '3':
						$proses_badges = '<span class="label label-success">Sertifikasi</span>';
						$status_badges = $p3[$v['doc_status']];
						break;
				}
                
           ?>
                        <tr>
                            <!--<td class="tc">
                                <div class="btn-group">
                                    <a title="Profil" class="btn btn-small btn-primary" style="margin-right:2px" href="pegawai/pegawai/edit/eU9pUW5vcWVGTjA"><i class="icon-search icon-white"></i></a>
                                    <a class="btn btn-small btn-danger" title="delete" href="pegawai/pegawai/del/eU9pUW5vcWVGTjA"><i class="icon-remove icon-white"></i></a>
                                </div>
                            </td>-->
                            <td><?=($data_start+$k);?></td> 	
                            <td rel="date_col" width="150"><?=$v['date_formatted'];?></td>
                            <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['nama_kewilayahan'];?></a></td>
                            <td style="white-space:nowrap">
								<?=$v['desa'];?>,<br /> 
								
								<?php 
									$split = $v['kecamatan'];
									$sep = explode(",",$split);
									$merg = implode("<br />",$sep);
									echo "$merg";
								?>
								<?=$merg;?><br /><?=$v['kabupaten'];?><br /><?=$v['propinsi'];?>
                            </td>
                            <td><?=$proses_badges;?></td>
                            <td><?=$status_badges;?></td>
                            <td>
                                <!--<div class="btn-groupx">
                                    <a href="<?=$url_edit;?>"><i class="icon-edit icon-white"></i></a>
                                    <a href="<?=$url_delete;?>" ><i class="icon-trash icon-white"></i></a>
                                </div>-->
                                <a href="<?=$url_edit;?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                                <a onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$url_delete;?>"><i class="icon-remove icon-alert"></i></a>
                                        
                                
                            </td>               
                        </tr>
                <? } ?>
                </tbody>
                </table>
        
                </td>
              </tr>
            </table>
         <!--end media-->
         <? } ?>
      </div>
    </div>
    <br />
	<div class="table-nav table-nav-border-top">
			<div class="pull-left text">Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries</div>            
            <div class="pull-right"><?=$paging;?></div>
            <!--<div class="pull-right"><?=$perpage;?></div>
            <div class="pull-right">Rows/page: </div>-->
        </div>
</div><!--end span8-->
</div>

</div>
