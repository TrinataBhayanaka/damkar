<style>
label{
     font-weight: bold;
}
</style>
<div class="row"> 
     <div class="col-md-12"> 
          <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th colspan="4" bgcolor="#F0F0F0" align="center">Data Kejadian</th>
                  </tr>
               <tr>
                  <th >No Kejadian</th>
                  <td colspan="3"><?=$data['noKejadian']?></td>
                </tr>
                <tr>
                  <th>Kode Provinsi</th>
                  <td><?=$data['kodePropinsi']?></td>
                  <th>Nama Provinsi</th>
                  <td> <?=$data['namaPropinsi']?></td>
                </tr>
                <tr>
                  <th>Kode Kabupaten</th>
                  <td><?=$data['kodeKabupaten']?></td>
                  <th>Nama Kabupaten</th>
                  <td> <?=$data['namaKabupaten']?></td>
                </tr>
                <tr>
                  <th>Jenis Kebakaran</th>
                  <td colspan="3"><?=$data['namaKejadian']?></td>
                </tr>
                <tr>
                  <th>Waktu Kejadian</th>
                  <td colspan="3"><?=$data['waktuKejadian']?></td>
                </tr>
                <tr>
                  <th>Meninggal</th>
                  <td><?=$data['meninggal']?></td>
                  <th>Hilang</th>
                  <td><?=$data['hilang']?></td>
                </tr>

                <tr>
                  <th>Terluka</th>
                  <td><?=$data['terluka']?></td>
                  <th>Mengungsi</th>
                  <td><?=$data['mengungsi']?></td>
                </tr>
                <tr>
                  <th>Penyebab</th>
                  <td><?=$data['penyebab']?></td>
                  <th>Objek</th>
                  <td> <?=$data['objek']?></td>
                </tr>
                <tr>
                  <th>Nilai Kerugian</th>
                  <td><?=$data['nilaiKerugian']?></td>
                  <th>Jumlah Pengungsi</th>
                  <td> <?=$data['jumlahPengungsian']?></td>
                </tr>
                <tr>
                  <th>Koordinat X</th>
                  <td><?=$data['x']?></td>
                  <th>Koordinat Y</th>
                  <td> <?=$data['y']?></td>
                </tr>
              </tbody>
         </table>
         <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th colspan="4" bgcolor="#F0F0F0" align="center">Tampilan MAP</th>
                  </tr>
                </tbody>
          </table>

         <button aria-hidden="true" data-dismiss="modal" class="btn btn-info" type="button">Close</button>
     </div>  
</div>