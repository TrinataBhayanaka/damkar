
 <table width="100%" border="1" class="table table-condensed table-hover">
        <thead>
        <tr >
        <th  rowspan="2"  align="center">No </th>
        <th align="center" rel="date" rowspan="2">Kabupaten/Kota</th>
        <th align="center" rel="title" rowspan="2">Luas Wilayah (km2)</th>
        <th align="center" rel="title" rowspan="2">Jumlah Kecamatan</th>
        <th align="center" rel="title" rowspan="2">Jumlah Penduduk (ribuan)</th>
        <th align="center" colspan="3">Jumlah Kondisi</th>
        <th align="center" rowspan="2">Total</th>
        </tr>
        <tr>
            <th align="center">Baik</th>
            <th align="center">Rusak Ringan</th>
            <th align="center">Rusak Berat</th>
        </tr>
        </thead>
        <tbody>
    
  <? if (is_array($arrDB)) { $no=1;foreach($arrDB as $k=>$v) {
        
        $total=$v['B']+$v['RR']+$v['RB'];
   ?>
                <tr>            
                    <td ><?=$no++;?></td>
                    <td ><?=$v['nama'];?></a></td>
                    <td><?=$v['luasWilayah'];?></td>
                    <td><?=$v['jumlahKecamatan'];?></td>
                    <td><?=$v['jumlahPenduduk'];?></td>
                    <td><?=$v['B'];?></td>
                    <td><?=$v['RR'];?></td>
                    <td><?=$v['RB'];?></td>
                    <td><?=$total;?></td>
                </tr>
                
        <? } }?>
        </tbody>
        </table>