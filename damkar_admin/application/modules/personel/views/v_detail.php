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
                    <th colspan="4" bgcolor="#F0F0F0" align="center">Identitas Diri</th>
                  </tr>
               <tr>
                  <th >No Induk Pegawai</th>
                  <td><?=$user['nip']?></td>
                  <th>Gelar Depan</th>
                  <td> <?=$user['glrDepan']?></td>
                </tr>
                <tr>
                  <th>Nama lengkap</th>
                  <td><?=$user['nama']?></td>
                  <th>Gelar Belakang</th>
                  <td> <?=$user['glrBelakang']?></td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td colspan="3"><?=$user['jenisKelamin']?></td>
                </tr>
                <tr>
                  <th>Tempat Lahir</th>
                  <td><?=$user['tempatLahir']?></td>
                  <th>Tanggal Lahir</th>
                  <td><?=$user['tglLahir']?></td>
                </tr>

                <tr>
                  <th>Agama</th>
                  <td><?=$user['agama']?></td>
                  <th>Status Perkawinan</th>
                  <td><?=$user['statusKawin']?></td>
                </tr>
                <tr>
                  <th>Golongan Darah</th>
                  <td><?=$user['golDarah']?></td>
                  <th>Rhesus</th>
                  <td> <?=$user['reshus']?></td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td colspan="3"><?=$user['alamat']?></td>
                </tr>
                  <tr>
                    <th colspan="4" bgcolor="#F0F0F0" align="center">Identitas Tambahan</th>
                  </tr>
                <tr>
                  <th>Provinsi</th>
                  <td> <?=$user['propinsi']?></td>
                  <th>Kabupaten</th>
                  <td> <?=$user['kabupaten']?></td>
                </tr>
                <tr>
                  <th>Sektor</th>
                  <td> <?=$user['sektor']?></td>
                  <th>Tingkat Kompetensi</th>
                  <td> <?=$user['kompetensi']?></td>
                </tr>
                <tr>
                  <th>TMT Pegawai</th>
                  <td> <?=$user['tmtPegawai']?></td>
                  <th>Status Pegawai</th>
                  <td> <?=$user['statusKerja']?></td>
                </tr>
                <tr>
                  <th>Pangkat Golongan</th>
                  <td> <?=$user['pangkat']?></td>
                  <th>SK PAngkat</th>
                  <td> <?=$user['skPangkat']?></td>
                </tr>
                <tr>
                  <th>Pendidikan Terakahir</th>
                  <td> <?=$user['pendidikan']?></td>
                  <th>Pendidikan Pelatihan</th>
                  <td> <?=$user['pelatihan']?></td>
                </tr>
                <tr>
                  <th>Keterangan</th>
                  <td colspan="3">  <?=$user['keterangan']?></td>
                </tr>
              </tbody>
         </table>

         <button aria-hidden="true" data-dismiss="modal" class="btn btn-info" type="button">Close</button>

     </div>  
</div>