<?



function wa_data($id_wa){
	$ci=& get_instance();
	$data["wa_data"]=$ci->adodbx->GetRecord("wa_data","idx=$id_wa");
	$data["v_wa_data"]=$ci->adodbx->GetRecord("v_wa_data","idx=$id_wa");
	$data["wa_contact"]=$ci->adodbx->GetRecord("wa_contact","id_wa=$id_wa");
	$data["wa_hukum_adat"]=$ci->adodbx->GetRecord("wa_hukum_adat","id_wa=$id_wa");
	$data["wa_hak_atas_tanah"]=$ci->adodbx->GetRecord("wa_hak_atas_tanah","id_wa=$id_wa");
	$data["wa_sejarah"]=$ci->adodbx->GetRecord("wa_sejarah","id_wa=$id_wa");
	$data["wa_lembaga_adat"]=$ci->adodbx->GetRecord("wa_lembaga_adat","id_wa=$id_wa");
	$data["wa_potensi_hayati"]=$ci->adodbx->GetRecord("wa_potensi_hayati","id_wa=$id_wa");
	$data["wa_potensi_hayati_lain"]=$ci->adodbx->GetRecord("wa_potensi_hayati_lain","id_wa=$id_wa");
	$data["wa_brwa_file"]=$ci->adodbx->GetRecord("wa_brwa_file","id_parent=$id_wa");
	$data["wa_batas_wilayah"]=$ci->adodbx->GetRecord("wa_batas_wilayah","id_wa=$id_wa");
	$data["wa_hak_pembagian_ruang"]=$ci->adodbx->GetRecord("wa_hak_pembagian_ruang","id_wa=$id_wa");
	$data["wa_data_f024"]=$ci->adodbx->GetRecord("wa_data_f024","id_wa=$id_wa");
	$data["wa_data_f022"]=$ci->adodbx->GetRecord("wa_data_f022","id_wa=$id_wa");
	$data["wa_data_f025"]=$ci->adodbx->GetRecord("wa_data_f025","id_wa=$id_wa");
	return $data;	
}


function wa_data_perubahan($id_wa){
	$ci=& get_instance();
	$data["wa_data"]=$ci->adodbx->GetRecord("wa_data","idx=$id_wa");
	$data["v_wa_data"]=$ci->adodbx->GetRecord("v_wa_data","idx=$id_wa");
	$data["wa_contact"]=$ci->adodbx->GetRecord("wa_contact","id_wa=$id_wa");
	$data["wa_hukum_adat"]=$ci->adodbx->GetRecord("wa_hukum_adat","id_wa=$id_wa");
	$data["wa_hak_atas_tanah"]=$ci->adodbx->GetRecord("wa_hak_atas_tanah","id_wa=$id_wa");
	$data["wa_sejarah"]=$ci->adodbx->GetRecord("wa_sejarah","id_wa=$id_wa");
	$data["wa_lembaga_adat"]=$ci->adodbx->GetRecord("wa_lembaga_adat","id_wa=$id_wa");
	$data["wa_potensi_hayati"]=$ci->adodbx->GetRecord("wa_potensi_hayati","id_wa=$id_wa");
	$data["wa_potensi_hayati_lain"]=$ci->adodbx->GetRecord("wa_potensi_hayati_lain","id_wa=$id_wa");
	$data["wa_brwa_file"]=$ci->adodbx->GetRecord("wa_brwa_file","id_parent=$id_wa");
	$data["wa_register_file_peta"]=$ci->adodbx->GetRecord("wa_register_file_peta","id_parent=$id_wa");
	$data["wa_register_file"]=$ci->adodbx->GetRecord("wa_register_file","id_parent=$id_wa");
	$data["wa_register_image"]=$ci->adodbx->GetRecord("wa_register_image","id_parent=$id_wa");
	$data["wa_batas_wilayah"]=$ci->adodbx->GetRecord("wa_batas_wilayah","id_wa=$id_wa");
	$data["wa_hak_pembagian_ruang"]=$ci->adodbx->GetRecord("wa_hak_pembagian_ruang","id_wa=$id_wa");
	//$data["wa_data_f024"]=$ci->adodbx->GetRecord("wa_data_f024","id_wa=$id_wa");
	//$data["wa_data_f022"]=$ci->adodbx->GetRecord("wa_data_f022","id_wa=$id_wa");
	//$data["wa_data_f025"]=$ci->adodbx->GetRecord("wa_data_f025","id_wa=$id_wa");
	return $data;	
}


function wa_data_proses($id_wa){
		$ci=& get_instance();
		$data["wa_data"]=$ci->adodbx->GetRecord("wa_data","idx=$id_wa");
		//get last data
		//$data["wa_proses_status"]=$ci->conn->GetRow("select * from wa_proses_log where id_wa=$id_wa order by idx desc");
		return $data;
}

function wa_log_data($id_wa){
	$ci=& get_instance();
	$data=$ci->adodbx->GetRecord("wa_log","id_wa=$id_wa");
	return $data;	
}

function wa_log_start($id_wa){
	$ci=& get_instance();
	$ci->old_data=wa_data($id_wa);
}

function wa_perubahan_start($id_wa){
	$ci=& get_instance();
	$ci->old_data_perubahan=wa_data_perubahan($id_wa);
}

function wa_perubahan_update($id_wa){
	$ci=& get_instance();
	$req=get_post();
	$data_new=wa_data_perubahan($id_wa);
	$wa_data=$data_new["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["revision_id"]=$ci->conn->GetOne("select count(id_wa) as hitung from wa_data_perubahan where id_wa=$id_wa");
	$data["revision_time"]=strtotime(date("Y-m-d H:i:s"));
	$data["action"]="U";
	
	$data["tanggal_perubahan"]=$req["tanggal_perubahan"];
	$data["no_dokumen_perubahan"]=$req["no_dokumen_perubahan"];
	$data["nama_pemohon_perubahan"]=$req["nama_pemohon_perubahan"];
	$data["nama_penyetuju_perubahan"]=$req["nama_penyetuju_perubahan"];
	
	$data["old_data"]=json_encode($ci->old_data_perubahan);
	$data["new_data"]=json_encode($data_new);
	$data["edited"]=date("Y-m-d H:i:s");
	$data=$ci->adodbx->Insert("wa_data_perubahan",$data);
	return $data;
}

function wa_log_insert($id_wa){
	$ci=& get_instance();
	$data_new=wa_data($id_wa);
	$wa_data=$data_new["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["revision_id"]=0;
	$data["revision_time"]=strtotime(date("Y-m-d H:i:s"));
	$data["action"]="I";
	$data["old_data"]="";
	$data["new_data"]=json_encode(wa_data($id_wa));
	$data["edited"]=date("Y-m-d H:i:s");
	$data=$ci->adodbx->Insert("wa_log",$data);
	return $data;
}

function wa_log_update($id_wa){
	$ci=& get_instance();
	
	$data_new=wa_data($id_wa);
	$wa_data=$data_new["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["revision_id"]=$ci->conn->GetOne("select count(id_wa) as hitung from wa_log where id_wa=$id_wa");
	$data["revision_time"]=strtotime(date("Y-m-d H:i:s"));
	$data["action"]="U";
	$data["old_data"]=json_encode($ci->old_data);
	$data["new_data"]=json_encode(wa_data($id_wa));
	$data["edited"]=date("Y-m-d H:i:s");
	$data=$ci->adodbx->Insert("wa_log",$data);
	return $data;
}


function wa_log_delete($id_wa){
	$ci=& get_instance();
	$old_data=$ci->old_data;
	$wa_data=$old_data["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["action"]="D";
	$data["revision_id"]=$ci->conn->GetOne("select count(id_wa) as hitung from wa_log where id_wa=$id_wa");
	$data["revision_time"]=strtotime(date("Y-m-d H:i:s"));
	$data["old_data"]=json_encode($ci->old_data);
	$data["new_data"]="";
	$data["edited"]=date("Y-m-d H:i:s");
	$data=$ci->adodbx->Insert("wa_log",$data);
	return $data;
}

/* history status */
function wa_log_proses($id_wa){
	$ci=& get_instance();
	$data_new=wa_data_proses($id_wa);
	$wa_data=$data_new["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["revision_id"]=0;
	$data["revision_time"]=strtotime(date("Y-m-d H:i:s"));
	$data["action"]="I";
	$data["old_data"]="";
	$data["new_data"]=json_encode($data_new);
	$data["edited"]=date("Y-m-d H:i:s");
	
	//cek last data proses
	//$req=get_post();
	//$doc_proses=$req["doc_proses"];
	//$doc_status=$req["doc_status"];
	$doc_proses=$wa_data["doc_proses"];
	$doc_status=$wa_data["doc_status"];
	$cek_row=$ci->conn->GetRow("select * from wa_proses_log where id_wa=$id_wa and doc_proses=$doc_proses and doc_status=$doc_status order by idx desc");
	if(!cek_array($cek_row)):
		$data=$ci->adodbx->Insert("wa_proses_log",$data);
	else:
		$idx=$cek_row["idx"];
		$data=$ci->adodbx->Update("wa_proses_log",$data,"idx=$idx");
	endif;
	
	return $data;
}

/* wa data proses */
function wa_proses_status($id_wa){
	$ci=& get_instance();
	$req=get_post();
	$doc_status=$req["doc_status"];
	$doc_proses=$req["doc_proses"];
	$data_new=wa_data_proses($id_wa);
	$wa_data=$data_new["wa_data"];
	$data=array();
	$data=$wa_data;
	$data["id_wa"]=$id_wa;
	unset($data["idx"]);
	$data["tanggal_proses"]=$req["tanggal_proses"];
	$data["new_data"]=json_encode($data_new);
	$data["edited"]=date("Y-m-d H:i:s");
	$ci->adodbx->Delete("wa_proses_status","id_wa=$id_wa and doc_proses=$doc_proses and doc_status=$doc_status");
	$data=$ci->adodbx->Insert("wa_proses_status",$data);
}


function wa_proses_status_get($id_wa,$doc_proses,$doc_status){
	$ci=& get_instance();
	$data=$ci->adodbx->GetRecord("wa_proses_status","id_wa=$id_wa and doc_status=$doc_status and doc_proses=$doc_proses");
	return $data;
}

