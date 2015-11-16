<?php $id=$this->encrypt_status==TRUE?encrypt($data["idx"]):$data["idx"];?>
<div class="row" style="text-align:right;padding-bottom:0px;">
	<div class="col-md-12">
	<a href="#" class="print-pdf" data-url="" title="Data Pendaftar"><i class="fam-page_white_acrobat"></i> PDF</a>
	</div>
</div>
<!--<table border="0" cellspacing="0" cellpadding="4" width="100%">
	  <tr>
		<td style="padding-left:25px;"><img src="assets/image/logo-blank.png" style="height:45px;" /></td>
		<td style="font-size:12px;">
			<center><b>Badan Registrasi Wilayah Adat (BRWA)</b></center>
			<p align="center">Jl. Arjuna Raya No. 12 Perumahan Indraprasta, Bogor 16153 - INDONESIA<br>Telp/Fax: 0251-836 | Email: <span style="color:blue;text-decoration:underline;">brwapusat@gmail.com</span> | Websie: <span style="color:blue;text-decoration:underline;">http://brwa.or.id</span></p>
  
		</td>
	  </tr>
  </table>-->
<?php echo form_open("wa_reg/view/$id");?>
<div id="print_this">
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
  <p align="center">No. <input type="text" name="no_urut_f021" size="20" value="<?=$data["no_urut_f021"];?>" > /BRWA-F021</p>	
  <div class="col-md-12"> 
	<table class="bordered" style="border-color:black;border-collapse:collapse" cellspacing="0" cellpadding="4" width="100%">
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
			$kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 	$as = explode(',', $data['kondisi_fisik'] );
			foreach($as as $key => $val){
				foreach($kfisik as $k=>$v) {
					if($val == $k){
						$x[] = $v;
					}
				}	
			}
			echo implode(",", $x);
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
		<td width="304" colspan="2" valign="top"><p>Hukum    Adat  </p></td>
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
		<td  valign="top"><p><?php if($data["wa_musyawarah"]==1){ print"Ya, Sudah"; } else{print "Belum";}?></p></td>
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
	</table><br>
	<div style="margin-left:40px;">
	<table>
		<tr>
			<td>.................., <?php $time = strtotime($data["tanggal_pendaftaran"]); echo date("d-m-Y", $time)?></td>
			<td></td>
		
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
<div class="col-md-12">
	<div class="form-actions col-md-12"><br><br>
		<button class="btn btn-primary save" type="submit"><i class="icon-book icon-white"></i> Simpan </button>
		<button type="reset" class="btn btn-warning "><i class="icon-refresh"></i> Reset </button>
	</div>
</div>
</form>
<script>
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
			var html=style+hd+footer+$("div#print_this").html();
			var file="wilayah_adat<?="_".date("YmdHis").".pdf";?>";
			UrlSubmit(base_url+"export/proxy_pdf/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70,target:"_blank"});
		});
	});
</script>