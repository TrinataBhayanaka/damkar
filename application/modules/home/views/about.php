<div class="subheader">
    <div class="container subheader-inner">
    	<h1>About</h1>
    </div>
</div>
<div class="container" style="margin-bottom:20px">

<div class="row-fluid">
<div class="span8" style="padding-right:10px">
    	<ul class="breadcrumb" style="margin-left:0; margin-top:-10px">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
          <li class="active">About</li>
        </ul>
    <div class="row-fluid">
        <div class="span12">
          <h3 class="sub" style="border-bottom:2px solid #aaa"><?=$data['title'];?></h3>
           <div class="pull-left" style="color:grey"> <?=$data['date_formatted'];?></div><br />
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
          <p><strong>Disclamer Air Traffic Service Reporting Form
            
            Undang-undang nomor 1 tahun 2009 tentang penerbangan Pasal 309 ayat (1) </strong></p>
          <p>bahwa Program keselamatan penerbangan nasional sebagaimana dimaksud dalam Pasal 308 ayat (2) memuat:            </p>
          <blockquote>
          <ol style="margin-left:20px">
            <li>Peraturan keselamatan penerbangan; </li>
            <li>Sasaran keselamatan penerbangan; </li>
            <li>Sistem pelaporan keselamatan penerbangan; </li>
          </ol>
          </blockquote>
          <p align="justify">Undang-undang nomor 1 tahun 2009 tentang penerbangan Pasal 321 ayat (1) bahwa Personel penerbangan yang mengetahui terjadinya penyimpangan atau ketidaksesuaian prosedur penerbangan, atau tidak berfungsinya peralatan dan fasilitas penerbangan wajib melaporkan kepada Menteri; dan ayat (2) bahwa Personel penerbangan yang melaporkan kejadian sebagaimana dimaksud pada ayat (1) diberi perlindungan sesuai dengan ketentuan yang berlaku.            </p>
          <p align="justify">Undang-undang nomor 1 tahun 2009 tentang penerbangan Pasal 375 Sistem informasi penerbangan mencakup pengumpulan, pengolahan, penganalisisan, penyimpanan, penyajian, serta penyebaran data dan informasi penerbangan untuk: a. meningkatkan pelayanan kepada masyarakat atau publik; dan b. mendukung perumusan kebijakan di bidang penerbangan.            </p>
          <p align="justify">Undang-undang nomor 1 tahun 2009 tentang penerbangan Pasal 377 Penyelenggaraan sistem informasi penerbangan dilakukan dengan membangun dan mengembangkan jaringan informasi secara efektif, efisien, dan terpadu yang melibatkan pihak terkait dengan memanfaatkan perkembangan teknologi informasi dan komunikasi.            </p>
          <p align="justify">Sistem incident reporting dikembangkan untuk melaporkan setiap terjadinya penyimpangan atau ketidaksesuaian prosedur penerbangan guna kepentingan pengumpulan, pengolahan, penganalisaan, penyimpanan, penyajian serta penyebaran data informasi insiden penerbangan namun bukan satu-satunya media untuk menyampaikan informasi insiden penerbangan, setiap personil penerbangan dapat menggunakan jalur komunikasi lain dalam penyampaian informasi kepada Menteri Perhubungan Republik Indonesia, setiap identitas, nomor telepon, maupun email pelapor akan tetap dirahasiakan guna kepentingan investigasi keselamatan penerbangan. </p>
        </div>
    </div>
    <br />
</div><!--end span8-->
<div class="span4" style="border-left:1px solid #eee; padding-left:10px">
  <!-- AddThis Button BEGIN --
    <div class="addthis_toolbox addthis_default_style" style="width:350px; margin-bottom:50px">
    <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4d9b20db5979ef32" class="addthis_button_compact">Share</a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_5"></a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_facebook_like" fb:like:action="recommend" fb:like:layout="button_count"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4d9b20db5979ef32"></script>
    !-- AddThis Button END -->
	<? modules::load('wg/web')->incident();?>
    <? modules::load('wg/web')->right_menu();?>
</div>
</div>
</div>
