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
	border-bottom:4px solid #8d965e;
}

</style>
<div class="container fasilitas" style="font-size:normal; margin-top:-10px; margin-bottom:-16px">
	<div class="row-fluid">
        <ul class="nav nav-big">
        <li class="<?=$active=='dip'?"active":""?>"><a href="dip"><i class="icon-file-alt grey"></i><h4>Daftar Informasi Publik</h4><p>Media awal pengajuan permohonan secara online.</p></a></li>
        <li class="<?=$active=='dip/request'?"active":""?>"><a href="dip/request"><i class="icon-edit grey"></i><h4><p>Permohonan Informasi</h4>Pengisian formulir permintaan informasi publik .</p></a></li>
        <li class=""><a href="#"><i class="icon-bullhorn grey"></i><h4>Form Keberatan</h4><p>Pengajuan pengaduan apabila permintaan informasi ditolak .</p></a></li>
        <li class=""><a href="user/dokumen/request"><i class="icon-tasks grey"></i><h4>Status Permohonan</h4><p>Anda dapat mengetahui sampai dimana proses permohonan yang diajukan .</p></a></li>
        </ul>
    </div>
</div>