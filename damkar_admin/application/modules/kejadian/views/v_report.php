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
        <th  rowspan="2"  align="center">No Kejadian</th>
        <th align="center" rel="date" colspan="2">Provinsi</th>
        <th align="center" rel="title" colspan="2">Kabupaten</th>
        <th rowspan="2" align="center">Bencana/Kejadian</th>
        <th align="center">Waktu Kejadian</th>
        <th align="center" colspan="4">Korban Meninggal</th>
        <th align="center" rowspan="2">Penyebab</th>
        <th align="center" rowspan="2">Objek</th>
        <th align="center" rowspan="2">Nilai Kerugian</th>
        <th  align="center" rowspan="2">Jumlah Pengusian</th>
        </tr>
        <tr>
            <th align="center">kode</th>
            <th align="center">nama</th>
            <th align="center">kode</th>
            <th align="center">nama</th>
            <th align="center">tgl/bln/thn</th>
            <th align="center">Meninggal</th>
            <th align="center">hilang</th>
            <th align="center">terluka</th>
            <th align="center">mengungsi</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) { foreach($arrDB as $k=>$v) {
        $tr_color=($k%2)?"#fff":"#fafafa";

        $id=$this->encrypt_status==TRUE?encrypt($v["id"]):$v["id"];
        $url_edit = $module."edit/".$id;
        $url_delete = $module."delete/".$id;
        
        $status_badges = ($v['status']==1)?'<span class="label label-info">Active</span>':'<span class="label label-warning">Non Active</span>';
        $reg = ($v['status']==1)?"<a href='wa_reg/add/$id'><span class='label label-success'>Registrasi</span></a>":'';
        
   ?>
                <tr>            
                    <td rel="date_col"><?=$v['noKejadian'];?></td>
                    <td rel="title_col"><a href="<?=$url_edit;?>"><?=$v['kodePropinsi'];?></a></td>
                    <td><?=$v['namaPropinsi'];?></td>
                    <td><?=$v['kodeKabupaten'];?></td>
                    <td><?=$v['namaPropinsi'];?></td>
                    <td><?=$v['kejadian'];?></td>
                    <td><?=$v['waktuKejadian'];?></td>
                    <td><?=$v['meninggal'];?></td>
                    <td><?=$v['hilang'];?></td>
                    <td><?=$v['terluka'];?></td>
                    <td><?=$v['mengungsi'];?></td>
                    <td><?=$v['penyebab'];?></td>
                    <td><?=$v['objek'];?></td>
                    <td><?=$v['nilaiKerugian'];?></td>
                    <td><?=$v['jumlahPengungsian'];?></td>
                </tr>
                
        <? } }?>
        </tbody>
        </table>