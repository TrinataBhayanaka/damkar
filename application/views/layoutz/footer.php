<?
$footer_pp_list=$this->footer_pp_list;
$footer_link_list=$this->footer_link_list;
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="span2">
        <h2>Menu</h2>
        <ul>
          <li><a href="about">Tentang PPID</a></li>
          <li><a href="news">Berita</a></li>
          <li><a href="dip">Pelayanan Informasi</a></li>
          <!--<li><a href="pp">Regulations</a></li>-->
        </ul>
      </div>
      <div class="span3">
        <h2>Dokumen Informasi Publik</h2>
        <ul>
          <li><a href="dip/?I[]=1">Tersedia Setiap Saat</a></li>
          <li><a href="dip/?I[]=2">Berkala</a></li>
          <li><a href="dip/?I[]=3">Serta Merta</a></li>
          <li><a href="dip/?I[]=4">Dikecualikan</a></li>
          <li><a>&nbsp;</a></li>
          <li><a href="dip/request">Permohonan Informasi</a></li>
        </ul>
      </div>
      <div class="span3">
        <h2><a href="linkdir">Tautan</a></h2>
        <ul>
          <?php if (is_array($footer_link_list)) { ?>
          <?php foreach($footer_link_list as $k=>$v) { ?>
          <li><a href="linkdir/get_link/<?=$v['idx'];?>" target="_blank"><?=$v['name'];?></a></li>
          <?php }} ?>
        </ul>
      </div>
      <div class="span4">
        <h2>Kontak</h2>
        <ul>
              <li class="kontak">
                  <address>
                <strong>Pusat Pelayanan Informasi PPID Utama</strong><br>
                UPTD Seuramoe Informasi Aceh<br />
                Jl. Sulthan Alaidin Mahmudsyah No.14, Banda Aceh<br><br />
                <abbr title="Phone">P:</abbr> +62 (651)-33615
                </address>
                 
                <address>
                	<!--<a href="?r=solutions/gis"><i class="icon-facebook icon-white connect"></i></a>
                  	<a href="#"><i class="icon-twitter icon-white connect"></i></a>-->
                  	<a href="mailto:ppidprovaceh@dephub.go.id"><i class="icon-envelope icon-white connect"></i></a>
                </address>
        </ul>
      </div>
      <div class="span12" style="margin-top:20px; padding-top:5px;border-top:1px solid #aaa">&copy; Copyright 2011-<?=date("Y");?> <a href="https://ppid.acehprov.go.id/"><b>PPID - ACEH</b></a>, All rights reserved.  </div>
    </div>
  </div>
</div>
<div id="toTop" class="box_shadow">^ Back to Top</div>
<script>
$(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();   
        } else {
            $('#toTop').fadeOut();
        }
    });
 
    $('#toTop,#newstotop').click(function() {
        $('body,html').animate({scrollTop:0},800);
    }); 
});
</script>
<script>
$(document).ready(function () {
	var act_link="<?=$this->page_active?>";
	$(".main-menu>li").find("a[href='"+act_link+"']").parent("li").addClass("active");
});
</script>