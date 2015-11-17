<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <h2>BRWA</h2>
        <ul class="list-unstyled">
          <li><a href="pages/about">Profil</a></li>
        </ul>
      </div>
      <div class="col-md-3">
      	<div class="row">
              <div class="col-md-12">
              	<h2>Wilayah Adat</h2>
                <ul class="list-unstyled">
                  <li><a href="pages/prosedur">Prosedur</a></li>
                  <li><a href="pages/prosedur#regol">Pendaftaran Online</a></li>
                  <li>&nbsp;</li>
                  <li><a href="wa?q=&p=&s[]=3">Wilayah Adat - Tersertifikasi</a></li>
                  <li><a href="wa?q=&p=&s[]=2">Wilayah Adat - Terverifikasi</a></li>
                  <li><a href="wa?q=&p=&s[]=1">Wilayah Adat - Teregistrasi</a></li>
                  <li>&nbsp;</li>
                  <li><a href="sig/">Peta Sebaran</a></li>
                </ul>
              </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="row">
              <div class="col-md-12">
                <h2>layanan</h2>
                <ul class="list-unstyled">
                  <li><a href="layanan/index#kantor">Kantor Wilayah</a></li>
                  <li><a href="layanan/index#slpp">S L P P</a></li>
                  <li><a href="layanan/index#ukp3">U K P 3</a></li>
                </ul>
              </div>
         </div>
      </div>
      <div class="col-md-4">
        <h2>Kontak BRWA</h2>
        <ul class="list-unstyled">
              <li class="kontak"><?=$this->cms_cfg['alamat']?>
              </li>
              <li class="kontak">
                  <a href="#"><i class="icon-facebook icon-white connect"></i></a>
                  <a href="#"><i class="icon-twitter icon-white connect"></i></a>
                  <a href="#"><i class="icon-envelope icon-white connect"></i></a>
              </li>
        </ul>
      </div>
     </div>
  </div>
  <div style="padding:5px 0">
  	<div class="container">
        <div class="row">
          <div class="col-md-11 copyright">&copy; Copyright <?=date("Y");?> <a href="http://brwa.or.id"><b>BRWA</b></a>, All rights reserved.  </div>
          <div class="col-md-1 copyright"><a href="http://www.brwa.or.id" target="_blank" class="friend_link" title="BRWA.OR.ID"><img class="desaturate" src="assets/image/logo-blank.png" style="height:16px" /></a></div>
        </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
$(document).ready(function () {
	var act_link="<?=$this->page_active?>";
	$(".main-menu>li").find('a[href="'+act_link+'"]').parents("li").addClass("active");
	
	$("#q_button").click(function(){
		$("#search_form").submit();
	});
});
</script>
<script src="assets/js/jquery-rrss.js"></script>