<script type="text/javascript" src="assets/js/plugins/pluploader/pluploader.js"></script>
<script type="text/javascript" src="assets/js/plugins/pluploader/jquery.plupload.queue.js"></script>
<style>
#imgcontainer .img-btn-change {
	position:absolute;
	width:100%;
	height:160px;
	line-height:160px;
	top:0;
	padding:5px;
	color:transparent;
	text-align:center;
	background:transparent;
	margin:1px;
	z-index:100;
	cursor:pointer
}
#imgcontainer .img-btn-change:hover {
	display:block;
	color:#eee;
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
}
.smallmap {
    width: 100%;
    height: 350px;
    border: 1px solid #ccc;
}
#tags {
    display: none;
}

#docs p {
    margin-bottom: 0.5em;
}
#table_batas_wilayah td{
	vertical-align:middle!important;
}
</style>
<!-- Carousel
================================================== -->
<div class="subhead">
  <div class="container">
    <div class="subhead-caption" style="max-width:800px">
      <h1>Wilayah Adat</h1>
      <p class="lead"><?=$data["nama_kewilayahan"]?></p>
    </div>
  </div>
</div>
<?php $this->load->view('dok_menu',array("active"=>"user/wa"))?>
<?php $this->load->view('user/wa/view_menu',array("active"=>"list"))?>
<div class="container">

<?
	$data_proses=$this->data["map_proses"];
	$data_proses_status=$this->data["map_proses_status"];
	
?>
	<div class="row">
    	<div class="col-md-12">
    	<h3 class="box-title">Wilayah Adat</h3>
        <div class="panel panel-default">
        <div class="panel-footer">
        <table class="table"; style="border-top:2px solid #ccc">
        <tbody>
        <tr><th class="strong">Nama Komunitas</th><th><?=ucwords($data["nama_kewilayahan"])?></th></tr>
        <tr><td style="width:300px" class="strong">Propinsi</td><td><?=ucwords(strtolower($arr_propinsi[$data["id_propinsi"]]))?></td></tr>
        <tr><td class="strong">Kabupaten/Kota</td><td><?=ucwords(strtolower($arr_kabupaten[$data["id_kabupaten"]]))?></td></tr>
        <tr><td class="strong">Kecamatan</td><td><?=ucwords($data["kecamatan"])?></td></tr>
        <tr><td class="strong">Desa</td><td><?=ucwords($data["desa"])?></td></tr>
        <tr><td class="strong">Proses</td><td><?=$data_proses[$data["doc_proses"]]?> >> <?=$data_proses_status[$data["doc_proses"]][$data["doc_status"]]?></td></tr>
        </tbody>
        </table>
		</div>
        </div>
        </div>
    </div>

<?
	$arr_wa_doc_status[""]="<span class='label label-warning'>Belum</span>";
	$arr_wa_doc_status["0"]="<span class='label label-warning'>Belum</span>";
	$arr_wa_doc_status["1"]="<span class='label label-info'>Proses</span>";
	$arr_wa_doc_status["2"]="<span class='label label-primary'>OK</span>";
	$arr_wa_doc_status["99"]="<span class='label label-danger'>Tidak Valid</span>";
?>

<div class="row">
	<div class="col-md-12">
    	<? 
			$id_wa=$data["idx"];
			$arrLog=$this->adodbx->search_record_where("wa_proses_log","id_wa=$id_wa","order by revision_id desc");
		?>
        <? if(cek_array($arrLog)):?>
	        <h3 class="box-title">Status History</h3>
        	<table class="table table-bordered">
            	<thead>
                	<th>Tanggal</th><th>Proses</th><th>Status</th><th>#</th></thead>
                </thead>
            	<? foreach($arrLog as $log):?>
                	<tr><td><?=date("Y-m-d",$log["revision_time"]);?></td><td><?=$this->data["map_proses"][$log["doc_proses"]]?></td><td><?=$this->data["map_proses_status"][$log["doc_proses"]][$log["doc_status"]]?></td><td><?=$arr_wa_doc_status[$log["wa_data_status"]]?></td><tr>
                <? endforeach;?>
            </table>
        <? endif;?>
    </div>
</div>
    	<h3 class="box-title">F021</h3>
<? if ($data['wa_status']<1) { ?>
<br />
    <div class="row">
    	<div class="col-md-12">
        	<div class="row">
            	<div class="col-md-12">
                	<div class="panel panel-default">
                        <div class="panel-footer">
                                Salah satu syarat Pendaftaran Wilayah Adat BRWA adalah adanya <strong>"Dokumen Pendaftaran yang telah ditanda tangani pemohon"</strong>.<br />
								<ul>
                                	<li>Silahkan Download Dokumen Formulir Pendaftaran (F-021) <a href="#" class="print-pdf" data-url="" title="Download">disini</a>, </li>
                                    <li>Tanda tangani </li>
                                    <li>lalu Upload kembali <a href="#" class="upload-f021" data-url="" title="Upload Formulir F-021 yang sudah ditandatangani">disini.</a></li>
                                </ul>
                                
							   <?php echo form_open("user/wa/regf021",'id="fdata"');?>
                               <input type="hidden" name="idx" value="<?=$data['idx'];?>" />
                               <input type="hidden" name="idx" value="<?=$data['idx'];?>" />
                               <input type="hidden" name="no" value="<?=$data["idx"];?>-BRWA-F021" />
                               <div id="fupload" class="row hide">
                                     <div class="col-md-5">
                                        <div class="form-group">
                                        <label>Upload Formulir Pendaftaran</label>
                                        <?php echo form_input('file_f021',false,'id="lampiran_f021" readonly="readonly" class="form-control required"');?>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" id="upf021">
                                            <label>&nbsp;</label>
                                            <a id="pickfile" class='form-control btn btn-info'>Browse</a>
                                         </div>
                                    </div>
                                    <div id="btn-submit" class="col-md-1 hide">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success">Upload</button>
                                         </div>
                                    </div>
                                    <div id="progress" class="col-md-5 hide">
                                    	<div class="form-group">
                                        <label>Uploading...</label>
                                        <table class="table">
                                            <tr>
                                                <td><div class="plupload_progress_bar_0"></div></td><td><div class="plupload_progress_text_0"></div></td>
                                            </tr>
                                        </table>
                                        </div>
                                    </div>
                                    
                                </div>
							<?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
 <? } ?>        
         
         

<!--<table border="0" cellspacing="0" cellpadding="4" width="100%">
	  <tr>
		<td><img src="assets/image/logo-blank.png" style="height:45px;" /></td>
		<td>
			<b>Badan Registrasi Wilayah Adat (BRWA)</b>
			<p>Jl. Arjuna Raya No. 12 Perumahan Indraprasta, Bogor 16153 - INDONESIA<br>Telp/Fax: 0251-836 | Email: <span style="color:blue;text-decoration:underline;">brwapusat@gmail.com</span> | Websie: <span style="color:blue;text-decoration:underline;">http://brwa.or.id</span></p>
		</td>
	  </tr>
</table>-->
<div id="print_this_reg">
<style>
    	.bordered
        {
            border:thin solid #ccc;
            border-collapse: collapse; 
        }
         
        .bordered td 
        {
			border-collapse: collapse;
            border: 1px solid #ccc;
        }
    </style> 
  <h4 align="center">FORMULIR PENDAFTARAN</h4>
  <input type="hidden" name="act" id="act" value="update"/>
  <p align="center">No. <?//=$data["idx"];?>&nbsp;&nbsp;&nbsp; /BRWA-F021</p>	
  <div class="row">
  <div class="col-md-12"> 
	<table class="table bordered" style="border-color:black;border-collapse:collapse" cellspacing="0" cellpadding="4" width="100%">
	  <tr align="center" style="border-collapse: collapse;">
		<td align="center">No</td>
		<td width="268" valign="top"><b>Data</b></td>
		<td valign="top"><b>Uraian</b></td>
	  </tr>
	  <tr>
	    <td align="center">1</td>
		<td width="304" valign="top"><p>Nama Komunitas</p></td>
		<td valign="top"><p><?=$data["nama_kewilayahan"]?></p></td>
	  </tr>
	  <tr>
	    <td align="center">2</td>
		<td width="304" valign="top"><p>Bahasa</p></td>
		<td valign="top"><p><?=$data["bahasa"]?></p></td>
	  </tr>
	  <tr>
	    <td align="center">3</td>
		<td width="304" colspan="2" valign="top"><p>Kewilayahan</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Propinsi</p></td>
		<td valign="top"><p><?=$arr_propinsi[$data["id_propinsi"]]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Kabupaten</p></td>
		<td valign="top"><p><?=$arr_kabupaten[$data["id_kabupaten"]]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Kecamatan</p></td>
		<td valign="top"><p><?=$data["kecamatan"]?></p></td>
	  </tr>
	   <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Desa</p></td>
		<td valign="top"><p><?=$data["desa"]?></p></td>
	  </tr>
	  <tr>
	    <td align="center">4</td>
		<td width="304" colspan="2" valign="top"><p>Kewilayahan Adat</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Luas    Wilayah Adat</p></td>
		<td valign="top"><p><?=$data["luas"]?> Ha</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Batas Wilayah </p></td>
		<td valign="top">
		<ol>
		  <li>Sebelah Barat berbatasan dengan <?=$data["batas_barat"]?>, </li>
		  <li>Sebelah Timur dengan <?=$data["batas_timur"]?>, </li>
		  <li>Sebelah Utara dengan <?=$data["batas_utara"]?></li>
		  <li>Sebelah Selatan dengan <?=$data["batas_selatan"]?></li>
		</ol></td>
	  </tr>
	  
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Satuan    Wilayah Adat </p></td>
		<td valign="top"><p><?=$data["satuan"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Kondisi    Fisik Wilayah Adat</p></td>
		<td  valign="top">
		<p>
		<?php 	
			$kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 	
			if ($data['kondisi_fisik'] ) {
			$as = explode(',', $data['kondisi_fisik'] );
			
			foreach($as as $key => $val){
				foreach($kfisik as $k=>$v) {
					if($val == $k){
						$x[] = $v;
					}
				}	
			}
			echo implode(",", $x);
			}
		?>
		</p>
		</td>
	  </tr>
	  <tr>
	    <td align="center">5</td>
		<td width="304" colspan="2" valign="top"><p>Kependudukan</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Jumlah    KK</p></td>
		<td  valign="top"><p><?=$data["kepala_keluarga"]?> KK</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Jumlah    Laki-laki</p></td>
		<td  valign="top"><p><?=$data["laki_laki"]?>    Jiwa</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Jumlah    Perempuan</p></td>
		<td  valign="top"><p><?=$data["perempuan"]?>    Jiwa</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Mata    Pencaharian Utama</p></td>
		<td  valign="top"><p><?=$data["mata_pencaharian"]?></p></td>
	  </tr>
	  <tr>
	    <td align="center">6</td>
		<td width="304" colspan="1" valign="top"><p>Sejarah    Singkat Masyarakat Adat (Sejarah asal-usul, suku)</p></td>
		<td  valign="top"><p><?=$data["sejarah_singkat"]?></p></td>
	  </tr>
	  <tr>
	    <td align="center">7</td>
		<td width="304" colspan="2" valign="top"><p>Hak    atas Tanah dan Pengelolaan Wilayah</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Pembagian Ruang Menurut Aturan Adat </p></td>
		<td  valign="top"><?=$data["wa_hak_pembagian_ruang"];?>
			<!--<table border="0" cellspacing="0" cellpadding="0" width="278">
			  <?php //if(cek_array($pembagian_ruang)):?>
				<?php //foreach($pembagian_ruang as $val):?>
					<? //$luas[]=$val["luas"];?>
					<tr>
						<td width="168" nowrap="nowrap" valign="bottom"><p><?=$val["pemanfaatan_kawasan"]?></p></td>
						<td width="110" nowrap="nowrap" valign="bottom"><p align="right"><?=number_format($val["luas"],2)?></p></td>
					  </tr>
				<?php //endforeach;?>
			  <?php //endif;?>
			  <tr>
				<td width="168" nowrap="nowrap" valign="bottom"><p>Total</p></td>
				<td width="110" nowrap="nowrap" valign="bottom"><p align="right"><?=number_format(array_sum($luas),2);?></p></td>
			  </tr>
			</table>-->
		</td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Sistem    Pengelolaan Wilayah </p></td>
		<td  valign="top"><p><?=$data["sistem_penguasaan"]?></p></td>
	  </tr>
	  <tr>
		<td>8</td>
		<td width="304" colspan="2" valign="top"><p>Kelembagaan    Adat</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Nama    Lembaga Adat </p></td>
		<td  valign="top"><p><?=$data["nama_lembaga_adat"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Struktur    Lembaga Adat</p></td>
		<td  valign="top"><p><?=$data["struktur"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Tugas dan Fungsi Masing-masing Pemangku Adat </p></td>
		<td  valign="top"><p><?=$data["tugas_dan_fungsi"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Mekanisme    Pengambilan Keputusan</p></td>
		<td  valign="top"><p><?=$data["mekanisme_pengambilan_keputusan"]?></p></td>
	  </tr>
	  <tr>
		<td>9</td>
		<td width="304" colspan="2" valign="top"><p>Hukum    Adat</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Aturan Adat Yang berkaitan dengan Pengelolaan Wilayah    dan Sumber Daya Alam</p></td>
		<td  valign="top"><p><?=$data["aturan_adat"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Aturan    Adat yang berkaitan pranata sosial</p></td>
		<td  valign="top"><p><?=$data["aturan_pranata_sosial"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Satu contoh keputusan dari penerapan hukum adat</p></td>
		<td  valign="top"><p><?=$data["contoh_keputusan"]?></p></td>
	  </tr>
	  <tr>
		<td>10</td>
		<td width="304" colspan="2" valign="top"><p>Keanekaragaman Hayati</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Jenis Ekosistem</p></td>
		<td  valign="top"><p>
		<?php 	
			$arrLookupGroup=m_lookup("wa_jenis_ekosistem","id_jenis_ekosistem","jenis_ekosistem",""," order by order_num asc "); 												
			foreach($arrLookupGroup as $k=>$v) {
				if($k == $data['id_jenis_ekosistem']){
					echo $v;
				}
			}
		?>
		</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" colspan="2" valign="top"><p>b. Potensi dan manfaat keanekaragaman hayati</p></td>
	  </tr>
	  <?php 
	  $no=1;
	  $arrLookupGroup=m_lookup("wa_potensi_hayati","id_potensi_hayati","nama_potensi_hayati",""," order by idx asc "); 
	  foreach($arrLookupGroup as $id_potensi => $nama_potensi):?>
		<tr>
			<td width="36" valign="top"><p>&nbsp;</p></td>
			<td width="268" valign="top"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $no.") ".$nama_potensi?></td>
			<td valign="top"><?php echo $potensi[$id_potensi]["keterangan"]?></td>
		</tr>
	  <?php $no++; endforeach;?>
	  <tr>
		<td width="36" valign="top">11</td>
		<td width="268" valign="top"><p>Peta Wilayah Adat</p></td>
		<td  valign="top"><p><?=$data["sistem_penguasaan"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top">12</td>
		<td width="268" valign="top"><p>Apakah wilayah adat yang diregistrasikan telah dimusyawarahkan?</p></td>
		<td  valign="top"><p><?=($data["wa_musyawarah"] = 1 ? 'Ya' : 'Tidak');?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top">13</td>
		<td width="268" colspan="2" valign="top"><p>Kontak Pemohon</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Nama</p></td>
		<td  valign="top"><p><?=$data["nama_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Jabatan</p></td>
		<td  valign="top"><p><?=$data["jabatan_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Alamat Surat</p></td>
		<td  valign="top"><p><?=$data["alamat_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Telp</p></td>
		<td  valign="top"><p><?=$data["telp_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>e. HP</p></td>
		<td  valign="top"><p><?=$data["hp_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>f. Fax</p></td>
		<td  valign="top"><p><?=$data["fax_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>g. Email</p></td>
		<td  valign="top"><p><?=$data["email_pemohon"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top">14</td>
		<td width="268" colspan="2" valign="top"><p>Penandatangan Surat Perjanjian Kerjasama</p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>a. Nama</p></td>
		<td  valign="top"><p><?=$data["nama_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>b. Jabatan</p></td>
		<td  valign="top"><p><?=$data["jabatan_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>c. Alamat Surat</p></td>
		<td  valign="top"><p><?=$data["alamat_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>d. Telp</p></td>
		<td  valign="top"><p><?=$data["telp_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>e. HP</p></td>
		<td  valign="top"><p><?=$data["hp_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>f. Fax</p></td>
		<td  valign="top"><p><?=$data["fax_tt"]?></p></td>
	  </tr>
	  <tr>
		<td width="36" valign="top"><p>&nbsp;</p></td>
		<td width="268" valign="top"><p>g. Email</p></td>
		<td  valign="top"><p><?=$data["email_tt"]?></p></td>
	  </tr>
	</table>
	<br>
	<div style="margin-left:40px;">
    <?
		$tanggal_daftar=($data["tanggal_daftar"])?($data["tanggal_daftar"]):($data["created"]);
	?>
	<table>
		<tr>
			<td>.................., <?php $time = strtotime($tanggal_daftar); echo date("d-m-Y", $time)?></td>
			<td> </td>
		
		</tr>
		<tr>
			<td>Tertanda,</td>
			<td></td>
		</tr>
		</table>
		<table>
		<br><br><br><br><br>
		<tr>
			<td>_________________________</td>
			<td></td>
		</tr>
	</table>
	</div>
  </div>
  </div>
</div>
<script>
	function UrlSubmit(url, params) {
		params["target"]=params["target"]||'';
		var target=('target="'+params["target"])+'"'||'';
		var form = [ '<form id="flyfrm" name="flyfrm" method="POST" ',target,' action="', url, '">' ];
	
		for(var key in params) 
			form.push('<input type="hidden" name="', key, '" value="', params[key], '"/>');
	
		form.push('</form>');
	
		jQuery(form.join('')).appendTo('body')[0].submit();
	}
	var alm = "<?=$arrAlamat['value'];?>";
	var eml = "<?=$arrEmail['value'];?>";
	var ktk = "<?=$arrKontak['value'];?>";
	$(function(){
		var style = "<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>";
		var hd = '<htmlpageheader name=\'myHeader1\'><div style=\'text-align: right; border-bottom: 1px solid #000000; font-size: 10pt;\'><table cellspacing=\'0\' cellpadding=\'4\' width=\'100%\'><tr><td style=\'padding-left:25px;\'><img src=\'assets/image/logo-blank.png\' style=\'height:45px;\' /></td><td style=\'font-size:12px;\'><center><b>Badan Registrasi Wilayah Adat (BRWA)</b></center><p align=\'center\'>'+alm+'<br>Telp/Fax: '+ktk+' | Email: <span style=\'color:blue;text-decoration:underline;\'>'+eml+'</span> | Websie: <span style=\'color:blue;text-decoration:underline;\'>http://brwa.or.id</span></p></td></tr></table></div></htmlpageheader>';
		var footer = "<htmlpagefooter name='myfooter1'><table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt;color: #000000; font-weight: bold; font-style: italic;'><tr><td width='33%'><span style='font-weight: bold; font-style: italic;'>Sumber : http://brwa.or.id</span></td><td width='33%' align='center' style='font-weight: bold; font-style: italic;'>{PAGENO}/{nbpg}</td><td width='33%' style='text-align: right; '>{DATE j-m-Y}</td></tr></table></htmlpagefooter>";
		$("a.print-pdf").click(function(e){
			e.preventDefault();
			var base_url="<?=base_url()?>";
			var html=style+hd+footer+$("div#print_this_reg").html();
			var file="wilayah_adat<?="_".date("YmdHis").".pdf";?>";
			UrlSubmit(base_url+"export/proxy_pdf/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70});
		});
		
		$("a.upload-f021").click(function(e){
			e.preventDefault();
			$("#fupload").removeClass("hide");
		});
	});
</script>
    	</div>
	</div>
</div>

<div class="container" style="margin-bottom:20px;">
<?php 
	if ($message) {
		echo '<div class="row"><div class="col-md-12 alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$message.'</div></div>';
	}
?>
<!--tab content-->
  
    <br />
    <br />
</div>
<?php echo form_close();?>

<script>
//Uploader
$(function(){
	var ufile=false;
	var x = false; 
	var maxfiles = 3;
	var uppeta = new plupload.Uploader({
		runtimes : 'html5,flash',
		browse_button : 'pickfile',
		container: 'upf021',
		multi_selection: false,
		url: "http://brwa.or.id/test.php",
		max_file_size : '5250kb',
		filters : [
			{extensions : "jpg,gif,png,pdf,doc,docx"}
		],
		flash_swf_url : 'http://rawgithub.com/moxiecode/moxie/master/bin/flash/Moxie.cdn.swf'
	});
	
	uppeta.bind('Init', function(up, params) {
		$('#runtime').html("Current runtime: " + params.runtime);
	});

	uppeta.init();

	uppeta.bind('FilesAdded', function(up, files) {
		var z=0;
		$.each(files, function(i,file){
			$("#lampiran_f021").val(file.name);
			$("#btn-submit").removeClass("hide");
		});
	});
	uppeta.bind('Error', function(up, err) {
		alert("Error: " + err.code + " -" + err.message/* +  (err.file ? ", File: " + err.file.name : "")*/);
		up.refresh();
	});
	
	uppeta.bind('FileUploaded', function(upldr, file, object) {
		var myData;
		try {
			myData = eval(object.response);
		} catch(err) {
			myData = eval('(' + object.response + ')');
		}
		//alert('uppeta'+"::"+myData.result);
		if (uppeta.files.length === (uppeta.total.uploaded + uppeta.total.failed)) {
			x=true;
			$('#fdata').submit();
		}
	});
	uppeta.bind('UploadProgress', function(up, file) {
		var col="blue";
		$(".plupload_progress_bar_0").attr("style", "width:"+ file.percent + "px; height:10px; float:left; margin-top:5px; background:"+col+"; display:inline-block");
		$(".plupload_progress_text_0").text(file.percent + "%");
	});
	
	//SUBMITTER
	$('#fdata').submit(function(e) {
		$("#btn-submit").addClass("hide");
		$("#progress").removeClass("hide");
		// Files in queue upload them first
		if (uppeta.files.length > 0) {
			uppeta.start();
		}
		else {
			x = true;
		}
		$("#konfirm").html((!x)?"Uploading Data...Please Wait":"Submitting Data...");
		//return false;
		//alert(x+":"+y);
		//alert('You must at least upload one file.');
		//return false;
		return (!x)? false:true;
	});    
});
</script>



