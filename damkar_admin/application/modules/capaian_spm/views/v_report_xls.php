
 <table width="100%" border="1" class="table table-condensed table-hover">
        <thead style="color:#F2F1F0">
        <tr >
        <th  rowspan="3"  align="center">No </th>
        <th align="center" rel="date" rowspan="3">Kabupaten/Kota</th>
        <th align="center" rel="date" rowspan="3">SKPD</th>
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
                    <td ><?=$v['skpd'];?></a></td>
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