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
<div class="container fasilitass" style="font-size:normal; margin-top:-72px; margin-bottom:30px">
	<div class="row">
        <div class="col-md-12">
        	<ul class="nav nav-tabs">
                <? if (!$this->ion_auth->logged_in()) { ?>
                <li class="<?=$active=='user/register'?"active":""?>"><a href="user/register"><h4><i class="fa fa-male grey"></i>&nbsp; Pendaftaran</h4></a></li>
                <li class="<?=$active=='dip/stats'?"active":""?>"><a href="dip/stats"><h4><i class="fa fa-tasks grey"></i>&nbsp; Statistik Informasi</h4></a></li>
                <? } else { ?>
                <li class="<?=$active=='user/profile'?"active":""?>"><a href="user/profile"><h4><i class="fa fa-user grey"></i>&nbsp; Profil</h4></a></li>
                <li class="<?=$active=='user/wa'?"active":""?>"><a href="user/wa"><h4><i class="fa fa-puzzle-piece grey"></i>&nbsp; Wilayah Adat</h4></a></li>
		        <? } ?>
                <!--<li class="<?=$active=='dip'?"active":""?>"><a href="dip"><h4><i class="fa fa-exclamation-circle grey"></i>&nbsp; Notifikasi</h4></a></li>
                <li class="<?=$active=='dip/request'?"active":""?>"><a><h4><i class="fa fa-question-circle grey"></i>&nbsp; <em>Help</em></h4></a></li>-->
            </ul>
        </div>
    </div>
</div>
