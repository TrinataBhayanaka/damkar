
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
        <tr>
        <th  rowspan="2"  align="center">No</th>
        <th align="center" rel="date" rowspan="2">Kabupaten/Kota</th>
        <th align="center" rel="title" rowspan="2">Luas Wilayah (km)</th>
        <th rowspan="2" align="center">Jumlah Kecamatan</th>
        <th align="center" rowspan="2">Jumlah Penduduk</th>
        <th align="center" colspan="7">Intensitas KEbakaran</th>
        </tr>
        <tr>
            <th align="center">Bangunan/ Gedung Publik</th>
            <th align="center">Pemukiman / Penduduk</th>
            <th align="center">Pabrik / Industri dan B3</th>
            <th align="center">Usaha Perkebunan dan Gambut</th>
            <th align="center">Hutan</th>
            <th align="center">Kebakaran Lain</th>
            <th align="center">Jumlah Kejadian Kebakaran</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) {$no=1; foreach($arrDB as $k=>$v) {
       
        $total=$v['BG']+$v['PP']+$v['PI']+$v['UPG']+$v['H']+$v['KL'];
   ?>
                <tr>            
                    <td rel="date_col"><?=$no++;?></td>
                    <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['namaKabupaten'];?></a></td>
                    <td><?=$v['luasWilayah'];?></td>
                    <td><?=$v['jumlahKecamatan'];?></td>
                    <td><?=$v['jumlahPenduduk'];?></td>
                    <td><?=$v['BG'];?></td>
                    <td><?=$v['PP'];?></td>
                    <td><?=$v['PI'];?></td>
                    <td><?=$v['UPG'];?></td>
                    <td><?=$v['H'];?></td>
                    <td><?=$v['KL'];?></td>
                    <td><?=$total;?></td>
                </tr>
                
        <? } }?>
        </tbody>
        </table>