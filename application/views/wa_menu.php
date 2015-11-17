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
                <li class="<?=$active=='stats'?"active":""?>"><a href="stats"><h4><i class="fa fa-line-chart grey"></i>&nbsp; Statistik</h4></a></li>
                <li class="<?=$active=='wa'?"active":""?>"><a href="wa"><h4><i class="fa fa-puzzle-piece grey"></i>&nbsp; Wilayah Adat</h4></a></li>
                <? if ($idx) { ?>
                <li class="<?=$active=='wa/view/'.$idx?"active":""?>"><a href="wa/view/<?=$idx;?>"><h4><i class="fa fa-search grey"></i>&nbsp; View</h4></a></li>
                <? } ?>
            </ul>
        </div>
    </div>
</div>
