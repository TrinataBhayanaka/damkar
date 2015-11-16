    <?
	$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
	$arrKabkot=m_lookup("kabupaten_kota","kode_bps","nama");
	?>
    
    Terimakasih telah mendaftarkan wilayah adat anda di Badan Registrasi Wilayah Adat. <br />
    Dalam waktu 5 (lima) hari kerja, Admin kami akan menghubungi anda di nomor telepon atau email yang sudah diberikan.
    <br /><br /><br />
	Data Pemohon:
    <table cellpadding="2" border="0" cellspacing="0">
    	<tr>
        <td width="160">Nama </td><td width="10">:</td><td><?php echo $nama_pemohon;?></td>
        </tr>
        <tr>
        <td>Jabatan</td><td width="10">:</td><td><?php echo $jabatan_pemohon;?></td>
        </tr>
        <tr>
        <td>Alamat</td><td width="10">:</td><td><?php echo $alamat_pemohon;?></td>
        </tr>
        <tr>
        <td>Telp/HP</td><td width="10">:</td><td><?php echo $telp_pemohon;?>/<?=$hp_pemohon?></td>
        </tr>
        <tr>
        <td>Fax</td><td width="10">:</td><td><?php echo $fax_pemohon;?></td>
        </tr>
        <tr>
        <td>Email</td><td width="10">:</td><td><?php echo $email_pemohon;?></td>
        </tr>
    </table>
    <br><br>
    
    Data Wilayah Adat:
    <table cellpadding="2" border="0" cellspacing="0">
    	<tr>
        <td width="160">Nama Wilayah Adat</td><td width="10">:</td><td><?php echo $nama_kewilayahan;?></td>
        </tr>
        <tr>
        <td>Propinsi</td><td width="10">:</td><td><?php echo $arrPropinsi['id_propinsi'];?></td>
        </tr>
        <tr>
        <td>Kabupaten</td><td width="10">:</td><td><?php echo $arrKabkot['id_kabupaten'];?></td>
        </tr>
        <tr>
        <td>Kecamatan</td><td width="10">:</td><td><?php echo $kecamatan;?></td>
        </tr>
        <tr>
        <td>Desa</td><td width="10">:</td><td><?php echo $desa;?></td>
        </tr>
        <tr>
        <td>&nbsp;</td><td width="10">&nbsp;</td><td>&nbsp;</td>
        </tr>
        <tr>
        <td>Luas Wilayah</td><td width="10">:</td><td><?php echo $luas;?> Ha</td>
        </tr>
        <tr>
        <td>Satuan Wil. Adat</td><td width="10">:</td><td><?php echo $satuan;?></td>
        </tr>
        <tr>
        <td>Sejarah Singkat</td><td width="10">:</td><td><?php echo $sejarah_singkat;?></td>
        </tr>
    </table>
<br>
<br>

    Untuk melihat proses data wilayah adat ini, silahkan login dihalaman PORTAL BRWA (http://brwa.or.id/user)<br>
