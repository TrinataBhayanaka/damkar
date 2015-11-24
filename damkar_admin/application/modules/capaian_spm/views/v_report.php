<style>@page {footer:html_myfooter1;header: html_myHeader1;background:white url('assets/image/logo-trans.png') no-repeat center center;border:0px solid red;}@page :first {footer:html_myfooter1;header: html_myHeader1;}table {font-family:chelvetica, Arial;font-size:9px;margin:0;width:100%}table.section{margin-top:10px;}th {text-align:left!important;}h5 {font-family:chelvetica, Arial;}.val{font-weight:bold}</style>
<htmlpageheader name="myHeader1">
<div style="text-align: right; border-bottom: 1px solid #000000; font-size: 10pt;">
    <table cellspacing="0" cellpadding="4" width="100%">
        <tr>
            <td style="padding-left:25px;">
                <img src="assets/image/damkar.png" style="width:65px;" />
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
        <thead style="color:#F2F1F0">
        <tr >
        <th  rowspan="3"  align="center">No </th>
        <th align="center" rel="date" rowspan="3">Kabupaten/Kota</th>
        <th align="center" rel="title" rowspan="3">Luas Wilayah (km2)</th>
        <th align="center" rel="title" rowspan="3">Jumlah Kecamatan</th>
        <th align="center" rel="title" rowspan="3">Jumlah Penduduk (ribuan)</th>
        <th align="center">&nbsp;</th>
        <th align="center">&nbsp;</th>
        <th align="center">&nbsp;</th>
        <th align="center">&nbsp;</th>
        <th align="center" colspan="15">Capaian Target SPM</th>
        <th align="center">&nbsp;</th>
        <th align="center" rowspan="3">Klarifikasi Kemampuan</th>
        </tr>
        <tr>
             <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center" rowspan="2" colspan="3">Cakupan</th>
            <th align="center">&nbsp;</th>
            <th align="center" rowspan="2" colspan="3">Respon Time (menit)</th>
            <th align="center">&nbsp;</th>
            <th align="center" rowspan="2" colspan="3">Rasio Personel</th>
            <th align="center">&nbsp;</th>
            <th align="center" rowspan="2" colspan="3">Rasio SarpRas</th>
            <th align="center">&nbsp;</th>
        </tr>
        <tr>
             <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
             <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
            <th align="center">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) { $no=1;foreach($arrDB as $k=>$v) {
        $xcakupan=$v['cakupan']/$v['m_cakupan'];
        $xresponTime=$v['responTime']/$v['m_responTime'];
        $xrasioPersonel=$v['rasioPersonel']/$v['m_rasioPersonel'];
        $xrasioSarPras=$v['rasioSarPras']/$v['m_rasioSarPras'];
        $klasifikasi=(($v['cakupan']+$v['responTime']+$v['rasioPersonel']+$v['rasioSarPras'])/($v['m_cakupan']+$v['m_responTime']+$v['m_rasioPersonel']+$v['m_rasioSarPras']))*100;
      
   ?>
                <tr>            
                    <td ><?=$no++;?></td>
                    <td ><?=$v['nama'];?></a></td>
                    <td><?=$v['luasWilayah'];?></td>
                    <td><?=$v['jumlahKecamatan'];?></td>
                    <td><?=$v['jumlahPenduduk'];?></td>
                    <td><?=number_format($xcakupan,2);?></td>
                    <td><?=number_format($xresponTime,2);?></td>
                    <td><?=number_format($xrasioPersonel,2);?></td>
                    <td><?=number_format($xrasioSarPras,2);?></td>
                    <td><?=$v['cakupan'];?></td>
                    <td>/</td>
                    <td><?=$v['m_cakupan'];?></td>
                    <td><?=number_format($xcakupan,2);?></td>
                    <td><?=$v['responTime'];?></td>
                    <td>/</td>
                    <td><?=$v['m_responTime'];?></td>
                    <td><?=number_format($xresponTime,2);?></td>
                    <td><?=$v['rasioPersonel'];?></td>
                    <td>/</td>
                    <td><?=$v['m_rasioPersonel'];?></td>
                    <td><?=number_format($xrasioPersonel,2);?></td>
                    <td><?=$v['rasioSarPras'];?></td>
                    <td>/</td>
                    <td><?=$v['m_rasioSarPras'];?></td>
                    <td><?=number_format($xrasioSarPras,2);?></td>
                    <td><?=number_format($klasifikasi,2);?>%</td>
                </tr>
                
        <? } }?>
        </tbody>
        </table>