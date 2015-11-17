<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>
<htmlpageheader name="myHeader1">
<div style="text-align: right; border-bottom: 1px solid #000000; font-size: 10pt;">
    <table cellspacing="0" cellpadding="4" width="100%">
        <tr>
            <td style="padding-left:25px;">
                <img src="assets/image/logo-blank.png" style="height:45px;" />
            </td>
            <td style="font-size:12px;">
                <center>
                    <b>PEMADAM KEBAKARAN (DAMKAR)</b>
                </center>
                <p align="center">Cimanggis Dalam<br>Telp/Fax: 0456 4353236 | Email: 
                    <span style="color:blue;text-decoration:underline;">contact@damkar.com</span> | Websie: 
                    <span style="color:blue;text-decoration:underline;">http://damkar.or.id</span>
                </p>
            </td>
        </tr>
    </table>
</div>
</htmlpageheader>
<htmlpagefooter name='myfooter1'>
<table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt;color: #000000; font-weight: bold; font-style: italic;'>
    <tr>
        <td width='33%'>
            <span style='font-weight: bold; font-style: italic;'>Sumber : http://brwa.or.id</span>
        </td>
        <td width='33%' align='center' style='font-weight: bold; font-style: italic;'>
            {PAGENO}/{nbpg}
        </td>
        <td width='33%' style='text-align: right; '>{DATE j-m-Y}</td>
    </tr>
</table>
</htmlpagefooter>

 <table width="100%" border="1" class="table table-condensed table-hover">
        <thead>
        <tr >
        <th  rowspan="2"  align="center">No </th>
        <th align="center" rel="date" rowspan="2">Kabupaten/Kota</th>
        <th align="center" rel="title" rowspan="2">Luas Wilayah (km2)</th>
        <th align="center" rel="title" rowspan="2">Jumlah Kecamatan</th>
        <th align="center" rel="title" rowspan="2">Jumlah Penduduk (ribuan)</th>
        <th align="center" colspan="6">Jumlah Sarana dan Prasarana Damkar</th>
        <th align="center" rowspan="2">Klarifikasi Kemampuan</th>
        </tr>
        <tr>
            <th align="center" colspan="3">Mobil Damkar dan Mesin Pompa/Selang dan Alat Damkar Lahut</th>
            <th align="center">Mobil Komando (unit)</th>
            <th align="center">Tandon Air (unit)</th>
            <th align="center">Peralatan Rescue (unit)</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) { $no=1;foreach($arrDB as $k=>$v) {
        
      
   ?>
                <tr>            
                    <td ><?=$no++;?></td>
                    <td ><?=$v['nama'];?></a></td>
                    <td><?=$v['luasWilayah'];?></td>
                    <td><?=$v['jumlahKecamatan'];?></td>
                    <td><?=$v['jumlahPenduduk'];?></td>
                    <td><?=$v['tMD'];?></td>
                    <td>+</td>
                    <td><?=$v['tSA'];?></td>
                    <td><?=$v['tMK'];?></td>
                    <td><?=$v['tTA'];?></td>
                    <td><?=$v['tPR'];?></td>
                    <td>&nbsp;</td>
                </tr>
                
        <? } }?>
        </tbody>
        </table>