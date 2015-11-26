<section class="page-header">
  <div class="container">

    <h1><?=$this->page_title?></h1>

    <!-- breadcrumbs -->
    <ol class="breadcrumb">
      <? foreach ($this->breadcrumb as $k=>$v) { ?>
        <? if ($v=='#') { ?>
          <li class="active"><?=$k?></li>
          <? } else { ?>
          <li><a href="<?=$v?>"><?=$k?></a></li>
        <? } ?>
      <? } ?>
    </ol><!-- /breadcrumbs -->

  </div>
</section>



<?
	//$right = (cek_array($this->right_page))?true:false;
?>

<section>
  <div class="container">

  <div class="row">
    <div class="col-md-<?=$right?'8':'12'?> ">

      <?php //$data['content']?>

      <h3>Profil Portal kebencanaan</h3>

      <p>Sejarah Lembaga Badan Nasional Penanggulangan Bencana (BNPB) terbentuk tidak terlepas dari perkembangan penanggulangan bencana pada masa kemerdekaan hingga bencana alam berupa gempa bumi dahsyat di Samudera Hindia pada abad 20. Sementara itu, perkembangan tersebut sangat dipengaruhi pada konteks situasi, cakupan dan paradigma penanggulangan bencana.</p>

      <p>Melihat kenyataan saat ini, berbagai bencana yang dilatarbelakangi kondisi geografis, geologis, hidrologis, dan demografis mendorong Indonesia untuk membangun visi untuk membangun ketangguhan bangsa dalam menghadapi bencana.</p>

      <p>Wilayah Indonesia merupakan gugusan kepulauan terbesar di dunia. Wilayah yang juga terletak di antara benua Asia dan Australia dan Lautan Hindia dan Pasifik ini memiliki 17.508 pulau. Meskipun tersimpan kekayaan alam dan keindahan pulau-pulau yang luar biasa, bangsa Indonesia perlu menyadari bahwa wilayah nusantara ini memiliki 129 gunung api aktif, atau dikenal dengan ring of fire, serta terletak berada pada pertemuan tiga lempeng tektonik aktif dunia?Lempeng Indo-Australia, Eurasia, dan Pasifik.</p>

      <p>Ring of fire dan berada di pertemuan tiga lempeng tektonik menempatkan negara kepulauan ini berpotensi terhadap ancaman bencana alam. Di sisi lain, posisi Indonesia yang berada di wilayah tropis serta kondisi hidrologis memicu terjadinya bencana alam lainnya, seperti angin puting beliung, hujan ekstrim, banjir, tanah longsor, dan kekeringan. Tidak hanya bencana alam sebagai ancaman, tetapi juga bencana non alam sering melanda tanah air seperti kebakaran hutan dan lahan, konflik sosial, maupun kegagalan teknologi.</p>

      <p>Menghadapi ancaman bencana tersebut, Pemerintah Indonesia berperan penting dalam membangun sistem penanggulangan bencana di tanah air. Pembentukan lembaga merupakan salah satu bagian dari sistem yang telah berproses dari waktu ke waktu. Lembaga ini telah hadir sejak kemerdekaan dideklarasikan pada tahun 1945 dan perkembangan lembaga penyelenggara penanggulangan bencana dapat terbagi berdasarkan periode waktu sebagai berikut. </p>
      <? modules::load('wg/web')->social_ftg('BRWA - '.$this->page_title,true);?>

    </div>
    <? if ($right) {  ?>
      <div class="col-md-4">
        <?=$list[0]['content'];?>
      </div>
    <? } ?>
  </div>

  </div>
</section>




<br />

<script>  
$(document).ready(function () {
//	$("a[href='pages/about']").parent().addClass("active");
})
</script>
<style>
strong {
	font-weight: bold; 
}

em {
	font-style: italic; 
}

table {
	border-collapse: separate;
	box-shadow: inset 0 1px 0 #fff;
	line-height: 20px;
	text-align: left;
}	
td {
	padding: 5px 10px;
	border-bottom:1px solid rgba(204,204,204,1);
	position: relative;
	transition: all 300ms;
}


</style>
