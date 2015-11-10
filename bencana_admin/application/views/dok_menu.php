<style>
.nav-big li {
	width:25%; float:left; 
	border-bottom:1px solid #ddd;
}
.nav-big li:hover {
	background:none;
}
.nav-big li a {
	padding:10px 5px;
	color:#888;
	margin-right:5px;
	border-bottom:4px solid transparent;
}
.nav-big li a:hover,.nav-big li.active a {
	background:none;
	color:#555;
	border-bottom:5px solid #8d965e;
}
.nav-big i {
	font-size:22px;
	float:left;
	margin-top:10px;
	margin-right:15px;
	line-height:22px;
	height:40px
}
.nav-big h4 {
	font-size:16px!important
}
</style>
<div class="container fasilitass" style="font-size:normal; margin-top:0px; margin-bottom:-16px">
	<div class="row-fluid">
        <ul class="nav nav-big">
        <li class="<?=$active=='dip'?"active":""?>"><a href="dip"><i class="icon-file-alt grey"></i><h4>Daftar Informasi Publik</h4></a></li>
        <li class="<?=$active=='dip/request'?"active":""?>"><a href="dip/request"><i class="icon-edit grey"></i><h4>Permohonan Informasi</h4></a></li>
        <? if (!$this->ion_auth->logged_in()) { ?>
        <li class="<?=$active=='dip/stats'?"active":""?>"><a href="dip/stats"><i class="icon-tasks grey"></i><h4>Statistik Informasi</h4></a></li>
        <li class="<?=$active=='user/register'?"active":""?>"><a href="user/register"><i class="icon-male grey"></i><h4>Pendaftaran</h4></a></li>
        <? } else { ?>
        <li class="<?=$active=='user/dokumen'?"active":""?>"><a href="user/dokumen/request"><i class="icon-question-sign grey"></i><h4>Status Permohonan</h4></a></li>
        <li class="<?=$active=='user/profile'?"active":""?>"><a href="user/profile"><i class="icon-user grey"></i><h4>Profil Saya</h4></a></li>
        <? } ?>
        </ul>
    </div>
	<!--<div class="row-fluid ">
        <a href="dip" class="span3 btn" style="border-radius:6px; border-bottom:2px solid blue">
          <i class="icon-copy grey"></i>
          <h4>Daftar Informasi Publik</h4>
       </a>
        <a href="dip/request" class="span3 btn" style="border-radius:6px">
          <i class="icon-edit grey"></i>
          <h4>Permohonan Informasi</h4>
        </a>
        <a href="" class="span3 btn" style="border-radius:6px">
          <i class="icon-bullhorn grey"></i>
          <h4>Form Keberatan</h4>
        </a>
        <a href="" class="span3 btn" style="border-radius:6px">
          <i class="icon-tasks grey"></i>
          <h4>Status Permohonan</h4>
        </a>
      </div>-->
</div>