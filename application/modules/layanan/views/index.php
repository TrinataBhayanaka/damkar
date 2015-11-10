<div style="background:#4a7dab; margin-top:0px; border-bottom:1px solid #ddd; padding:15px">
<div class="container">
	<div class="row">
    	<div class="col-md-8">
        	<h1 class="page-title2">Layanan BRWA</h1>
        </div>
    	<div class="col-md-4">
        	<ul class="breadcrumb">
              	<li><a href="">Home</a></li>
                <li><a href="layanan">Layanan</a></li>
                <li class="active">Indeks</li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container pages">
	<a name="kantor"></a>
	<div class="row">
    	<div class="col-md-12">
        	<h3>Kantor & kontak layanan pendftaran wilayah adat</h3>
            NASIONAL
            <table class="table">
              <tr>
                  <td width="20">1.</td>
                  <td width="250"><strong>BRWA Nasional</strong></td>
                  <td>Jl. Arjuna Raya No.12 Indraprasta, Bogor<br />Telp. 0251 8362606</td>
              </tr>
              <tr>
                  <td>2.</td>
                  <td><strong>PB AMAN</strong></td>
                  <td>Jl. Tebet Timur Dalam Raya No. 11A Kel. Tebet Timur, Kec. Tebet, Jakarta Selatan - 12820<br />Telp/fax +62 8297954 / 837 06282<br />
<br />
Jl. Sempur No. 31 Bogor. 16154</td>
              </tr>
              <tr>
                  <td>3.</td>
                  <td><strong>JKPP</strong></td>
                  <td>Jl. Cimanuk Blok B-VII No.6. Komp. Bogor Baru. Bogor.<br />Telp/fax: +62251 - 8379143</td>
              </tr>
              <tr>
                  <td>4.</td>
                  <td><strong>FWI</strong></td>
                  <td>Jl. Sempur Kaler No. 62 Bogor<br />Telp/fax: +62 251 8333308</td>
              </tr>
              <tr>
                  <td>5.</td>
                  <td><strong>Sawit Watch</strong></td>
                  <td>Bogor Baru Taman, Jalan Cisangkui, Blok B 6 No 1, Bogor 16127 Indonesia. <br />Phone:+62(251) 8352171 Fax:</td>
              </tr>
              <tr>
                  <td>6.</td>
                  <td><strong>KpSHK</strong></td>
                  <td>Perumahan indraprasta<br />Jl. Abiyasa Raya No.66, Indraprasta I - Bogor. Jawa Barat.<br />Indonesia 16153<br />
						Tel: 0251-8326541, Fax: 0251-8326541</td>
              </tr>
              <tr>
                  <td>7.</td>
                  <td><strong>Samdhana Institute</strong></td>
                  <td>Jl. Guntur No. 32, Bogor 16151 <br />Telp/Hp : +62 251 8313947</td>
              </tr>
             </table>
             <br />
             KANTOR WILAYAH
            <table class="table">
              <tr>
                  <td width="20">1.</td>
                  <td width="250"><strong>BRWA Kalimantan Barat</strong></td>
                  <td>Mikael Eko. <br />Perkumpulan Pancur Kasih<br />Jl. Gusti Situt Mahmud Gg. Selat Sumba 3<br />
                  Komp. Persekolahan Asisi PO BOX 6191<br />
                  Kel. Siantan Tengah Kec. Pontianak Utara<br />
                  Pontianak. 78241.</td>
              </tr>
              <tr>
                  <td>2.</td>
                  <td><strong>BRWA Sulawesi Tengah</strong></td>
                  <td>Joisman Tanduru<br />Jl. Emisaelan Lrg. Patraco-Milano No. 76, Kota Palu.</td>
              </tr>
              <tr>
                  <td>3.</td>
                  <td><strong>Fasilitator Registrasi</strong></td>
                  <td>propinsi /kabupaten yang sudah disepakati pasca training</td>
              </tr>
             </table>
             <br />
    	</div>
        <!--<div class="col-md-4">
			<? //modules::load('wg/web')->brwa_rss(1);?>
			<? //modules::load('wg/web')->article_pages(1,false,3);?>
            <? //modules::load('wg/web')->other_links();?>
        </div>-->
	</div>
    
    
    <a name="slpp"></a>
    <div class="row">
    	<div class="col-md-12">
        	<h3>Simpul Layanan Pemetaan Partisipatif (SLPP)</h3>
            Daftar Kontak Fasilitator
            <table class="table">
            <tr>
              <th style="width:20px">No.</th>
              <th>Simpul</th>
              <th>Nama Fasilitator</th>
              <th>Email</th>
              <th>HP</th>
              <th>&nbsp;</th>
              </tr>
            <?php if (is_array($slpp['list'])) { ?>
			  <?php 
                foreach($slpp['list'] as $k=>$v) { 
                    $image = ($v['image'])?$v['image']:"blank.png";
                    $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
              ?>
              <tr>
              <td><?=(1+$k);?>.</td>
              <td><strong><?=$v['simpul'];?></strong><div><?=$v['clip'];?></div></td>
              <td><?=$v['nama'];?></td>
              <td><?=$v['kontak_fasilitator'];?></td>
              <td><?=$v['kontak_fasilitator_2'];?></td>
              <td>&nbsp;</td>
              </tr>
              
             <? }} ?>
             </table>
             <br />
    	</div>
        <!--<div class="col-md-4">
			<? //modules::load('wg/web')->brwa_rss(1);?>
			<? //modules::load('wg/web')->article_pages(1,false,3);?>
            <? //modules::load('wg/web')->other_links();?>
        </div>-->
	</div>
    
    <a name="ukp3"></a>
    <div class="row">
    	<div class="col-md-12">
        	<h3>Unit Kerja Pemetaan Partisipatif (UKP3)</h3>
            Daftar Kontak Fasilitator
            <table class="table">
            <tr>
              <th style="width:20px">No.</th>
              <th>Wilayah</th>
              <th>Nama Fasilitator</th>
              <th>Email</th>
              <th>HP</th>
              <th>&nbsp;</th>
              </tr>
            <?php if (is_array($ukp3['list'])) { ?>
			  <?php 
                foreach($ukp3['list'] as $k=>$v) { 
                    $image = ($v['image'])?$v['image']:"blank.png";
                    $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
              ?>
              <tr>
              <td><?=(1+$k);?>.</td>
              <td><strong><?=$v['wilayah'];?></strong><div><?=$v['clip'];?></div></td>
              <td><?=$v['nama'];?></td>
              <td><?=$v['kontak_fasilitator'];?></td>
              <td><?=$v['kontak_fasilitator_2'];?></td>
              <td>&nbsp;</td>
              </tr>
              
             <? }} ?>
             </table>
             <br />
             <? modules::load('wg/web')->social_ftg('BRWA - '.$this->page_title,true);?>
    	</div>
        <!--<div class="col-md-4">
			<? //modules::load('wg/web')->brwa_rss(1);?>
			<? //modules::load('wg/web')->article_pages(1,false,3);?>
            <? //modules::load('wg/web')->other_links();?>
        </div>-->
	</div>
</div>
