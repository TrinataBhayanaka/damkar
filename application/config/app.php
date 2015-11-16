<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config["hrms_service"]["server"]="http://192.168.11.11/hrms/api/";
$config["menu_title"]="XXXX";
$config["app_name"]="polpp";
$config["app_key"]="312cd30ab5cb88e5be1";
$config["site_url"]='http://brwa.or.id/';
$config["site_open"]=TRUE;

$config["encrypt_id_enable"]=TRUE;

$config["dir_tmp_news_image"] = "tmp/plupload/";
$config["dir_news_image"] = "assets/image/news/";

$config["dir_tmp_link_image"] = "tmp/plupload/";
$config["dir_link_image"] = "assets/image/links/";
 
$config["dir_tmp_pages_image"] = "tmp/plupload/";
$config["dir_pages_image"] = "assets/image/pages/";


$config["dir_tmp_members"] = "tmp/plupload/";
$config["dir_members"] = "assets/image/members/";

$config["dir_tmp_regulasi"] = "tmp/plupload/";
$config["dir_regulasi"] = "assets/image/regulasi/";
$config["dir_rujukan"] = "assets/image/rujukan/";

$config["dir_ppid"] = "/";
$config["dir_tmp_files"] = "tmp/plupload/";
//$config["dir_files"] = "assets/dokumen/files/";
$config["dir_files"] = "../../ppid-dokumen/files/";

// $config["dir_brwa_admin"] = "/brwa_admin/";
$config["dir_brwa_admin"] = "/brwa_admin/";
$config["dir_tmp"] = "tmp/plupload/";
$config["dir_file_pendukung"] = "docs/brwa/";
$config["dir_file_peta"] = "docs/brwa/peta/";
$config["dir_surat_kuasa"] = "docs/brwa/sk/";
$config["dir_file_f021"] = "docs/brwa/f021/";


/*
 | -------------------------------------------------------------------------
 | Document---Email Notification.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: dip/
 */
$config['email_templates_wa'] = 'wa/email/';

/*
 | -------------------------------------------------------------------------
 | Request Notification 
 | -------------------------------------------------------------------------
 | Default: request.tpl.php
 */
$config['email_wa_reg'] = 'register.tpl.php';
$config['email_wa_reg_user'] = 'register_user.tpl.php';

$config['file_path']=$_SERVER['DOCUMENT_ROOT']."/../ppid-dokumen/surat/";//."/ppid_admin/assets/permohonan/";

$config['logged_page'] = 'user/profile';

$config['registrasi_help']['1'] = 'Nama sesuai identitas masyarakat adat yang didaftarkan oleh pemohon';
$config['registrasi_help']['2'] = 'Bahasa yang digunakan secara turun temurun';
$config['registrasi_help']['3'] = 'Pembagian administrasi Indonesia (wilayah-wilayah administrasi yang masuk ke dalam wilayah adat)';
$config['registrasi_help']['4'] = 'Cakupan wilayah kuasa yang diakui oleh masyarakat adat';
$config['registrasi_help']['4_a'] = 'Nilai pengukuran wilayah adat dengan alat pemetaan, Menggunakan satuan hektar (Ha)';
$config['registrasi_help']['4_b'] = 'Isi dengan nama tempat dan satuan wilayah lain (bisa adat,bisa administrasi) yang berbatasan. <br>Format: [nama tempat];[satuan wilayah yang berbatasan]';
$config['registrasi_help']['4_c'] = 'Nama satuan komunitas yang didaftar/wilayah adat yang dipetakan menurut identitas komunitas.';
$config['registrasi_help']['4_d'] = 'Centang Kondisi fisik yang sesuai bentuk fisik Wilayah Adat';
$config['registrasi_help']['5'] = 'Jumlah penduduk (orang) yang menetap di wilayah adat';
$config['registrasi_help']['5_a'] = 'Contoh: 500';
$config['registrasi_help']['5_b'] = 'Contoh:';
$config['registrasi_help']['5_c'] = 'Nama sesuai identitas masyarakat adat yang didaftarkan oleh pemohon';
$config['registrasi_help']['5_d'] = 'Mata pencaharian utama dari komunitas adat (dominan dan sampingan). Maksimal 3 (tiga)<br>Contoh: Petani,Nelayan,berburu';
$config['registrasi_help']['6'] = 'Uraian singkat sejarah komunitas adat atas wilayah adatnya yang berkaitan dengan penguasaan wilayah (terkait dengan asal usul)<br>Kata kunci: (Kapan/waktu/siapa) masyarakat yang mendiami wilayah adat tersebut';
$config['registrasi_help']['7'] = 'Informasi sistem kearifan lokal komunitas adat';
$config['registrasi_help']['7_a'] = 'Uraian singkat jenis penggunaan lahan menurut istilah adat/komunitas setempat.<br>Format: [Istilah/nama lokal]=[Penjelasan dalam bahasa indonesia]<br>Contoh: <br><strong>Leuweung Tutupan</strong> = Wilayah berupa hutan yang tidak boleh dimasuki oleh orang<br><strong>Leuweung Titipan</strong> = Wilayah berupa hutan yang hanya boleh dimasuki oleh orang tertentu (sesepuh adat) untuk tujuan tertentu (upacara adat, ritual dll)<br><strong>Leuweung Awisan</strong> = Wilayah yang dikelola masyarakat untuk pertanian, perumahan, perkebunan dan aktifitas lainnya untuk menunjang kehidupan masyarakat (livelyhood)';
$config['registrasi_help']['7_b'] = 'Uraian tentang jenis dan sistem penguasaandan pengelolaan Wilayah yang dianut komunitas dalam Lingkup wilayah adat<br>Contoh:<br><ul>
<li>Tanah lndividu :  Tanah yang dikuasai dan dikeIola oleh perorangan (individu)</li>
<li>Tanah keluarga/marga  :  Tanah yang dikuasai dan dikelola bersama- sama dalam satu keluarga/marga</li>
<li>Tanah Komunal :  Tanah yang dikelola bersama-samaoleh komunitas (semua orang dalam komunitas ikut mengelola)</li>
</ul>
';
$config['registrasi_help']['8'] = 'Lembaga adat yang masih aktif atau dalam proses revitalisasi ';
$config['registrasi_help']['8_a'] = 'Nama lembaga adat yang mewakili identitas komunitas adat ';
$config['registrasi_help']['8_b'] = 'Susunan Lembaga adat komunitas yang berkaitan dengan pengabilan keputusan (pemangkuadat)<br>
Contoh:<br>
<ol>
<li>Raja/kepala  adat</li>
<li>Kewang</li>
</ol>';
$config['registrasi_help']['8_c'] = 'Uraian tugas dan fungsi pemangku adat<br>Contoh:<br>
<ul>
<li><strong>Raja</strong> :  Bertugas untuk mengurusi  pemerintahan adat</li>
<li><strong>Kewang</strong> :  Bertugas Untuk menjaga lingkungan</li>
</ul>';
$config['registrasi_help']['8_d'] = 'Tatacara yang digunakan oleh komunitas untuk mengambil keputusan (memutuskansuatu permasalahan)<br>
Contoh:<br>
<ul>
<li>Reriuangan:  Musayawarah adat yang dihadiri  oleh Abah, Olot2 dari setiap rerendangan dan warga yang diundang  untuk menentukan kapan waktu-waktu pertanian (waktu tanam, panen, dan serentaun) yang diadakan di I mah Gede.</li>
<li>Token :  keputusan yang diambil dari perwakilan masyarakat (ketua adat dan beberapa tokoh) untuk menentukan pemimpin  adat biasanya dilakukan di hutan keramat.</li>
</ul>';
$config['registrasi_help']['9'] = 'Hukum/aturan yang berlaku di masyarakat adat secara turun temurun';
$config['registrasi_help']['9_a'] = 'Uraian aturan (bisa juga larangan) dalam mengelola (memanfaatkan/menjaga) sumberdaya alam (di Hutan, Sungai, Sawah, Kebun dll)
<br>Contoh:<br>
Sasi  :  Mengatur waktu pengelolaan sumberdaya alam (Hutan  :  kapan boleh mengambil rotan, sungai; kapan boleh menangkap ikan di daerah tertentu)';
$config['registrasi_help']['9_b'] = 'Uraian aturan (bisajuga larangan) dalam kehidupan sosial (hubungan antar manusia). Seperti Pernikahan,pencurian dll';
$config['registrasi_help']['9_c'] = 'Sebutkan [nama dari] hukum adatnya dan bagaimana pelaksanaan hukuman bagi orang yang melanggarnya (apa sanksinya).
<br>Contoh:<br>
<strong>Sasi</strong> :  orang yang melanggar Sasi yang sudah ditetapkan oleh Kewang, maka diharuskan membayar 3 ekor babi untuk disembelih dan dibagikan kepada anak yatim dan warga sekitar.
<strong>Orang melintasi padi yang sudah siap panen harus membawa rotan</strong> :
Orang yang melanggar harus membuat pulut (sejenis makanan tradisional di Aceh) dan diberikan  kepada pihak yang dirugikan.';
$config['registrasi_help']['10_a'] = 'Jenis ekosistemapa saja yang ada di wilayah adat komunitas<br>
Contoh: <br>Hutan, Sungai, Mangrove, perairan, pantai';
$config['registrasi_help']['10_b'] = 'Nama sesuai identitas masyarakat adat yang didaftarkan oleh pemohon';
$config['registrasi_help']['11_a'] = 'Cantumkan 1 (satu) titik koordinat yang mewakili Wilayah Adat';
$config['registrasi_help']['11_b'] = 'lampirkan   peta  wilayah  adat berupa peta sketsa (jpg,gif,png), atau spasial data (format: shapefile, kml, kmz), Untuk Shapefile (.shp) kompres .shp .shx .dbf .sbn .prj => save file package ke .rar/zip';
$config['registrasi_help']['12'] = 'Ya*/Tidak<br>*Lampirkan dokumen  hasi/ musyawarah';
$config['registrasi_help']['13'] = 'Orang yang dimandatkan   oleh masyarakat   untuk  mengajukan permohonan   registrasi   (pendaftaran)   wilayah  adat  ke BRWA. Orang tersebut   bisa berasal  dari komunitas  adat  yang bersangkutan   dan dari orang  luar komunitas';
$config['registrasi_help']['13_a'] = 'Nama  dari  orang  yang mewakili   komunitas   adat';
$config['registrasi_help']['13_b'] = 'Jabatan  dikomunitas  (contoh;  ketua adat, tokoh atau anggota  kamunitas).   Jika orang  dari luar  disebutkan  hubungan  dengan  komunitas   tersebut  (contoh: pendamping   komunitas   adat  dari lembaga ... /direktur lembaga ...)';
$config['registrasi_help']['13_c'] = 'Alamat  lengkap  dari pemohon  untuk  mengirimkan   surat ';
$config['registrasi_help']['13_d'] = 'Nama sesuai identitas masyarakat adat yang didaftarkan oleh pemohon';
$config['registrasi_help']['14'] = 'Perwakilan   dari komunitas   adat  yang ditunjuk   oleh komunitas untuk  menandatangani    surat  Perjanjian  Kerjasama  dengan  pihak BRWA';
$config['registrasi_help']['14_a'] = 'Nama perwakilan   dari  komunitas  adat  (harus orang yang berasal  dari komunitas  adat  bersangkutan)';
$config['registrasi_help']['14_b'] = 'Jabatan/kedudukan      di Komunitas  Adat  (contoh;  Ketua adat,  warga  adat,  dll)';
$config['registrasi_help']['14_c'] = 'Alamat  lengkap  dari Penanda tangan kontrak  untuk  mengirimkan   surat ';
$config['registrasi_help']['14_d'] = 'Nama sesuai identitas masyarakat adat yang didaftarkan oleh pemohon';
$config['registrasi_help']['fp'] = 'Terkait dengan penguatan sejarah adat. dapat berupa foto maupun video atau rekaman narasi';

