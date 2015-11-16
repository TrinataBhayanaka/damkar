
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