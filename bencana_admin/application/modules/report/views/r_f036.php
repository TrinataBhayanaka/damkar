<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
#wrap-content{ margin:0; padding:0; font-size:14px; width:800px; border:1px solid; background-color:white;}
#wrap-content th{ text-align:center;}
.head-1 td{ padding:10px; text-align:center}
.head-1 .span1{ font-size:15px}
.head-1 .span2{ font-size:14px}
.head-2 { margin-bottom:10px;}
.foot{ margin-left:20px; margin-top:15px;}
.main-table td{ padding:3px;}
</style>
<script>
	var alm = "<?=$arrAlamat['value'];?>";
	var eml = "<?=$arrEmail['value'];?>";
	var ktk = "<?=$arrKontak['value'];?>";
	$(function(){
		var style = "<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>";
		var footer = "<htmlpagefooter name='myfooter1'><table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt;color: #000000; font-weight: bold; font-style: italic;'><tr><td width='33%'><span style='font-weight: bold; font-style: italic;'>Sumber : http://brwa.or.id</span></td><td width='33%' align='center' style='font-weight: bold; font-style: italic;'>{PAGENO}/{nbpg}</td><td width='33%' style='text-align: right; '>{DATE j-m-Y}</td></tr></table></htmlpagefooter>";
		$("a.print-pdf").click(function(e){
			e.preventDefault();
			var base_url="<?=base_url()?>";
			var html=style+footer+$("div#wrap-content").html();
			var file="wilayah_adat<?="_".date("YmdHis").".pdf";?>";
			UrlSubmit(base_url+"export/proxy_pdf/",{filename:file,tbl:encodeURIComponent(html),time:(new Date).getTime(),header_height:70});
		});
	});
</script>
<body class="print">
<a href="#" class="print-pdf" data-url="" title="Data Pendaftar"><i class="fam-page_white_acrobat"></i> PDF</a>
<div>
</div>
<div id="wrap-content">
<table border="0" class="head-1" width="800">
<tr><td><img src="assets/image/logo-blank.png" style=" width:145px; height:45px;" ><td><td><b>Badan Registrasi Wilayah Adat (BRWA)</b><br />
<span class="span1">Jl.Arjuna Raya No.12 Perumahan Indraprasta, Bogor 16153 - INDONESIA <br /></span>
<span class="span2">Telp/Fax: 0251 - 8362606 | Email:brwapusat@gmail.com | Website: http://brwa.co.id<br /></span>
<hr align="center"> 
<td></tr>
</table>

<table border="0" width="800">
<tr><th><p align="center"><strong>REKOMENDASI STATUS KELULUSAN</strong><strong> </strong><br /></p></th></tr>
<tr><th>NomorUrut: _____/BRWA-F036</p></th></tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="750" class="main-table" align="center">
  <tr>
    <td width="200" valign="top">Tanggal Pemeriksaan</td>
    <td  colspan="2" valign="top">:</td>
  </tr>
  <tr>
    <td valign="top">Komunitas/<br />
      Kelembagaan Adat</td>
    <td colspan="2" valign="top">:</td>
  </tr>
  <tr>
    <td valign="top">No. Registrasi</td>
    <td colspan="2" valign="top">:</td>
  </tr>
  <tr>
    <td valign="top">Lokasi</td>
    <td colspan="2" valign="top">:</td>
  </tr>
  <tr>
    <td valign="top">Ruang Lingkup</td>
    <td colspan="2" valign="top">:</td>
  </tr>
  <tr>
    <td width="593" colspan="3" valign="top" style="text-align:center">
      <strong><p>STANDAR PENILAIAN</p></strong></td>
  </tr>
  </table>
  <table border="1" cellspacing="0" cellpadding="0" width="750" class="main-table" align="center">
  <tr>
    <td width="297" colspan="2" valign="top">
    Catatan Rekomendasi Tim    Evaluator:</td>
    <td width="297" valign="top"></td>
  </tr>
  <tr>
    <td width="297" colspan="2" valign="top">
      DOKUMEN LAPORAN</td>
    <td width="297" valign="top">
      STATUS KECUKUPAN</td>
  </tr>
  <tr>
    <td width="297" colspan="2" valign="top">
      <ul>
        <li>Daftar Periksa Penilaian Verifikasi (BRWA-F029)</li>
      </ul></td>
    <td width="297" >
      []Baik               []Cukup               []Kurang </td>
  </tr>
  <tr>
    <td width="297" colspan="2" valign="top">
      <ul>
        <li>Ringkasan Tinjauan Dokumen (BRWA-F025)</li>
      </ul></td>
    <td width="297" valign="top">
      []Baik               []Cukup               []Kurang</td>
  </tr>
  <tr>
    <td width="297" colspan="2" valign="top">
      <ul>
        <li>Laporan Kesimpulan Hasil Verifikasi (BRWA-F031)</li>
      </ul></td>
    <td width="297" valign="top">
    []Baik               []Cukup               []Kurang</td>
  </tr>
  <tr>
    <td width="297" colspan="2" valign="top">
      <ul>
        <li>Daftar Hadir Pertemuan (BRWA-F026)</li>
      </ul></td>
    <td width="297" valign="top">
      []Baik               []Cukup               []Kurang</td>
  </tr>
  <tr>
    <td width="593" colspan="3" valign="top">
      <p align="left">CATATAN:</p>
      <p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="593" colspan="3" valign="top" style="padding-left:15px;">
      <p align="left">PERNYATAAN PEMERIKSAAN:<br />
        Kepala BRWA dan Deputi Verifikasi    telah mempelajari seluruh dokumen di atas dan telah menyimpulkan bahwa hasil    penilaian keseluruhan dari komunitas/kelembagaan adat telah/belum*)memenuhiketentuan    yang telahditetapkan </p>
      <p align="left">Kami <a name="_GoBack" id="_GoBack">memutuskan bahwa komunitas adat di atas dapat/tidak dapat diberikan piagam sertifikasi wilayah adat.</a> <br />
        Keputusan ini melibatkan    keduanya, BRWA dan komunitas/kelembagaan adat pemohon.</p></td>
  </tr>
 </table>
 <table border="0" width="800" style="text-align:center;margin-top:30px;">
     <tr><td></td><td>Tanggal,</td></tr>
     <tr><td width="400" valign="top">Mengetahui</td><td width="400">Menyetujui</td></tr>
     <tr><td colspan="2"><p>&nbsp;</p></td></tr>
     <tr><td width="400" valign="top">Dewan Penyantun</td><td width="400">Kepala BRWA</td></tr>
 </table>
<p align="left">&nbsp;</p>
<p align="left">*) Coret yang tidak perlu</p>
</div>
</body>
</html>
