
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