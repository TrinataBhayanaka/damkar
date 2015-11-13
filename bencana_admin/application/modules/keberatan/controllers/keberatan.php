<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class keberatan extends Admin_Controller {
	var $arr_category=array();
    
    function __construct(){
        parent::__construct();
        // echo "modules";exit;
        $this->load->helper(array('form', 'url','file'));
    	$this->load->helper("lookup");
        $class_folder=basename(dirname(__DIR__));
        $class=__CLASS__;
		
		$this->class=$class;
		$this->$class_folder=$class_folder;
		
		$this->load->helper(array('form', 'url','file'));
    	//$this->load->library("Hrms");
        $this->folder=$class_folder."/";
        $this->module=$this->folder.$class."/";
        $this->http_ref=base_url().$this->module;
       
        $this->load->helper("menu_helper");
        
        $this->load->model("general_model");
		$this->model_list_user=new general_model("users");
        $this->model=new general_model("wa_data");
		$this->model_contact=new general_model("wa_contact");
		$this->model_hukum_adat=new general_model("wa_hukum_adat");
		$this->model_hayati=new general_model("wa_hayati");
		$this->model_hak_atas_tanah=new general_model("wa_hak_atas_tanah");
		$this->model_sejarah=new general_model("wa_sejarah");
		$this->model_lembaga_adat=new general_model("wa_lembaga_adat");
		$this->model_potensi_hayati=new general_model("wa_potensi_hayati");
		$this->model_potensi_hayati_lain=new general_model("wa_potensi_hayati_lain");
		
		$this->model_file_peta=new general_model("wa_register_file_peta");
		$this->model_file=new general_model("wa_register_file");
		$this->model_image=new general_model("wa_register_image");
		
		$this->model_batas_wilayah=new general_model("wa_batas_wilayah");
		$this->model_pembagian_ruang=new general_model("wa_hak_pembagian_ruang");
		
		//nambahin
		$this->model_cms_configuration=new general_model("cms_configuration");
		$this->model_wa_keberatan=new general_model("wa_pengajuan_keberatan");
		
		$this->main_layout="admin_lte_layout/main_layout";
		$this->module_title="Pengajuan Keberatan";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx asc";
		
		$this->get_map_proses();

	 }
	 
	 function index(){
	 	$this->listview();
		//$this->_render_page($this->module."registrasi_list",$data,true);
	 }
	 
	 function listview(){
	 	//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
		$this->load->library('pagination');  
        $table=$this->model->tbl;  
		// echo $table;exit;
		$queryString=rebuild_query_string();
        
		$data_type=$this->adodbx->GetDataType($table);
		
		foreach($data_type as $x=>$val):
            if(($val=="C")||($val=="X")) $data["text"][]=$x;
        endforeach;
        
        $col_text=$data["text"];
		$field=join(",",$col_text);
        //$field="jenis_pelanggaran";
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
        
        $whereSql="";
        if(cek_array($where)):
            $whereSql.=join(" and ",$where);
        endif;
        $perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"25";
        $data["perPage"]=$perPage;
       
	    $uriSegment=4;
        
        $totalRows=$this->model->getTotalRecordWhere($whereSql);
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by {$this->tbl_sort}";
        
        //$arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
		$arrData=$this->model->search_record_by_limit_where($table,$whereSql,$perPage,$offset,$sortBy);

		$config['base_url'] = $this->module."listview";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
		$this->_render_page($this->module."v_list",$data,true);
    }
	
    function edit($id){
		
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
		// debug();
		$this->msg_ok="Link updated successfully";
        $this->msg_fail="Unable to update link";
       
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
		
            $arrData=$this->model->GetRecordData("idx=$id");
			$arrData+=$this->model_contact->GetRecordData("id_wa=$id");
			$arrData+=$this->model_sejarah->GetRecordData("id_wa=$id");
			$arrData+=$this->model_hak_atas_tanah->GetRecordData("id_wa=$id");
			$arrData+=$this->model_hayati->GetRecordData("id_wa=$id");
			$arrData+=$this->model_lembaga_adat->GetRecordData("id_wa=$id");
			$arrData+=$this->model_hukum_adat->GetRecordData("id_wa=$id");
			//$arrData+=$this->model_potensi_hayati->GetRecordData("id_wa=$id");
			
			
			$data["data"]=$arrData;
			$data["batas_wilayah"]=$this->model_batas_wilayah->SearchRecordWhere("id_wa=$id");
			
			$dataFile=$this->model_file->SearchRecordWhere("id_parent=$id");
			$dataFileJenisDoc=array();
			if(cek_array($dataFile)):
				foreach($dataFile as $file):
					$dataFileJenisDoc[$file["id_jenis_doc"]][]=$file;
				endforeach;
			endif;
			$data["data_file2"]=$dataFileJenisDoc;
			$data["data_file"]=$dataFile;
			
			$data["data_file_peta"]=$this->model_file_peta->SearchRecordWhere("id_parent=$id");
			$data["data_image"]=$this->model_image->SearchRecordWhere("id_parent=$id");

			
			//$data["potensi_hayati"]=$this->model_potensi_hayati->SearchRecordWhere("id_wa=$id");
			$arrDataPotensiMap=array();
			$arrDataPotensi=$this->model_potensi_hayati->SearchRecordWhere("id_wa=$id");
			if(cek_array($arrDataPotensi)):
				foreach($arrDataPotensi as $x=>$val):
					$arrDataPotensiMap[$val["id_potensi_hayati"]]=$val;
				endforeach;
			endif;
			$data["potensi"]=$arrDataPotensiMap;
			
			$data["potensi_lain"]=$this->model_potensi_hayati_lain->SearchRecordWhere("id_wa=$id");
			$data["pembagian_ruang"]=$this->model_pembagian_ruang->SearchRecordWhere("id_wa=$id");
			$data["arr_kab"]=$this->get_kab_kota_arr($arrData["id_propinsi"]);
			$this->_render_page($this->module."v_edit",$data,true);
        endif;
		
		if($act=="update"):
			// debug();
			$this->conn->StartTrans();
            wa_log_start($id);
			
			
			$data=get_post();
			$data_batas_wilayah=array();
			if(cek_array($data["batas"])):
				$arr_tmp=array_combine($data["batas"],$data["batas_val"]);
				foreach($arr_tmp as $batas=>$batas_val):
					$tmp=array();
					$tmp["batas"]=$batas;
					$tmp["batas_val"]=$batas_val;
					$data_batas_wilayah[]=$tmp;
				endforeach;
			endif;
			
			// $data_pembagian_ruang=array();
			// if(cek_array($data["ruang"])):
				// $arr_tmp=array_combine($data["ruang"],$data["ruang_val"]);
				// foreach($arr_tmp as $ruang=>$ruang_val):
					// $tmp=array();
					// $tmp["pemanfaatan_kawasan"]=$ruang;
					// $tmp["luas"]=$ruang_val;
					// $data_pembagian_ruang[]=$tmp;
				// endforeach;
			// endif;
			
			$data_potensi=array();
			if(cek_array($data["potensi"])):
				$arr_tmp=array_combine($data["id_potensi"],$data["potensi_val"]);
				$arr_tmp2=array_combine($data["id_potensi"],$data["potensi"]);
				
				foreach($arr_tmp as $id_potensi=>$keterangan):
					$tmp=array();
					$tmp["id_potensi_hayati"]=$id_potensi;
					$tmp["nama_potensi_hayati"]=$arr_tmp2[$id_potensi];
					$tmp["keterangan"]=$keterangan;
					$data_potensi[]=$tmp;
				endforeach;
			endif;
			
			$data_potensi_lain=array();
			if(cek_array($data["potensi_lain"])):
				$arr_tmp=array_combine($data["potensi_lain"],$data["potensi_lain_val"]);
				foreach($arr_tmp as $ruang=>$ruang_val):
					$tmp=array();
					$tmp["nama_potensi_hayati"]=$ruang;
					$tmp["keterangan"]=$ruang_val;
					$data_potensi_lain[]=$tmp;
				endforeach;
			endif;
			$data['kondisi_fisik']=implode(",",$data['list_kondisi_fisik']);
			$data=$this->_add_editor($data);
			unset($data[$this->tbl_idx]);
			// pre($data);exit;
		   	$this->model->UpdateData($data, "{$this->tbl_idx}=$id");
			$data_update=$data;
			$data_update["id_wa"]=$id;
			$this->model_contact->DeleteData("id_wa=".$id);
			$this->model_contact->InsertData($data_update);
			
			$this->model_sejarah->DeleteData("id_wa=".$id);
			$this->model_sejarah->InsertData($data_update);
			
			$this->model_hukum_adat->DeleteData("id_wa=".$id);
			$this->model_hukum_adat->InsertData($data_update);
			
			$this->model_hayati->DeleteData("id_wa=".$id);
			$this->model_hayati->InsertData($data_update);
			
			$this->model_lembaga_adat->DeleteData("id_wa=".$id);
			$this->model_lembaga_adat->InsertData($data_update);
			
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id);
			$this->model_hak_atas_tanah->InsertData($data_update);
			
			$this->model_potensi_hayati->DeleteData("id_wa=".$id);
			$this->model_potensi_hayati->InsertData($data_update);
			
			//update file peta
			$this->update_image($id);
			$this->update_file($id);
			$this->update_file_peta($id);
			
			//batas_wilayah_lain
			$this->model_batas_wilayah->DeleteData("id_wa=".$id);
			if(cek_array($data_batas_wilayah)):
				foreach($data_batas_wilayah as $data_batas):
					$data_batas["id_wa"]=$id;
					$this->model_batas_wilayah->InsertData($data_batas);
				endforeach;	
			endif;
			
			//pemanfaatan pembagian_ruang
			// $this->model_pembagian_ruang->DeleteData("id_wa=".$id);
			// if(cek_array($data_pembagian_ruang)):
				// foreach($data_pembagian_ruang as $data_ruang):
					// $data_ruang["id_wa"]=$id;
					// $this->model_pembagian_ruang->InsertData($data_ruang);
				// endforeach;	
			// endif;
			
			//data_potensi
			$this->model_potensi_hayati->DeleteData("id_wa=".$id);
			if(cek_array($data_potensi)):
				foreach($data_potensi as $data_pot):
					$data_pot["id_wa"]=$id;
					$this->model_potensi_hayati->InsertData($data_pot);
				endforeach;	
			endif;
			
			//data_potensi_lain
			$this->model_potensi_hayati_lain->DeleteData("id_wa=".$id);
			if(cek_array($data_potensi_lain)):
				foreach($data_potensi_lain as $data_potensi_lain):
					$data_potensi_lain["id_wa"]=$id;
					$this->model_potensi_hayati_lain->InsertData($data_potensi_lain);
				endforeach;	
			endif;
			
			wa_log_update($id);
			
			
			$ok=$this->conn->CompleteTrans();
			
          	$this->_proses_message($ok,$this->module."edit/$id_enc",$this->module."edit/$id_enc");
			
			
        endif;
            
    }
	
	public function del_dok($id,$id_wa)
	{
		if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
		$direktori="docs/wa_doc/keberatan/";
		check_folder($direktori);

		$get = $this->model_wa_keberatan->GetRecordData("idx=$id");
		$files = $get['dok_name'];
		if($files != ''){
			unlink($direktori.$files);
			rmdir($direktori);				
		}
		if(isset($id)){
			$this->conn->StartTrans();
            $this->model_wa_keberatan->DeleteData("{$this->tbl_idx}=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."view/$id_wa",$this->module."view/$id_wa");
		}
	} 
	
	function edit_dok($id,$id_dok){
		debug();
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
			$id_dok=decrypt($id_dok);
		endif;
		$this->msg_ok="Link updated successfully";
        $this->msg_fail="Unable to update link";
       
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model_wa_keberatan->GetRecordData("idx=$id_dok");
			$data["data"]=$arrData;
			$this->_render_page($this->module."v_edit_dok",$data,true);
        endif;
		
		if($act=="update"):
			$this->conn->StartTrans();
			$data=get_post();
			// pre($data);exit;
			$direktori="docs/wa_doc/keberatan/";
			check_folder($direktori);
			if((!empty($data['dok_name_url'])) && (empty($_FILES['dok_name']['name']))){//isi - ks			
				if ($data['dok_name_url']) $data["dok_name"]=$data['dok_name_url'];
				// pre($data);exit;
				$this->model_wa_keberatan->UpdateData($data,"idx=$id_dok");
				$ok = $this->conn->CompleteTrans();
				$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");
	
			}elseif((!empty($data['dok_name_url'])) && (!empty($_FILES['dok_name']['name']))){//isi - isi  
				$fix_name = time().substr($_FILES['dok_name']['name'],strrpos($_FILES['dok_name']['name'],"."));
				$config['upload_path']	= "$direktori";
				$config['allowed_types']= 'doc|docx|xls|xlsx|pdf|rar|zip';		
				$config['max_size']	= '1000000';
				$config['file_name'] = $fix_name;
				$this->load->library('upload', $config);    
				$field = "dok_name"; 
				if ($fix_name) $data["dok_name"]=$fix_name;
			
				if($this->upload->do_upload($field)){
					unlink($direktori.$data['dok_name_url']); 
					$datax = $this->upload->data();
					$this->model_wa_keberatan->UpdateData($data,"idx=$id_dok");
					$ok = $this->conn->CompleteTrans();
					$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");
				
				}else{
					$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");
				}
			}
			
			
			
			
			// $ok=$this->conn->CompleteTrans();
			
          	// $this->_proses_message($ok,$this->module."view/$id_wa",$this->module."view/$id_wa");
			
			
        endif;
            
    }
    
	function view($id){
        if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
		$this->msg_ok="Link updated successfully";
        $this->msg_fail="Unable to update link";
		$act=$this->input->post("act")?$this->input->post("act"):"";    
        $arrData=$this->model->GetRecordData("idx=$id");
		$arrData+=$this->model_contact->GetRecordData("id_wa=$id");
		$arrData+=$this->model_sejarah->GetRecordData("id_wa=$id");
		$arrData+=$this->model_hak_atas_tanah->GetRecordData("id_wa=$id");
		$arrData+=$this->model_hayati->GetRecordData("id_wa=$id");
		$arrData+=$this->model_lembaga_adat->GetRecordData("id_wa=$id");
		$arrData+=$this->model_hukum_adat->GetRecordData("id_wa=$id");
			
		$arrKab=$this->get_kab_kota_arr($arrData["id_propinsi"]);
		$arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
		$arrWaKondisiFisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik");
		$arrEkosistem=m_lookup("wa_jenis_ekosistem","id_jenis_ekosistem","jenis_ekosistem",""," order by order_num asc "); 
		$arrPotensiHayati=m_lookup("wa_potensi_hayati","id_potensi_hayati","nama_potensi_hayati",""," order by idx asc "); 												
										
		$data["arr_propinsi"]=$arrPropinsi;
		$data["arr_kabupaten"]=$arrKab;
		$data["arr_wa_kondisi_fisik"]=$arrWaKondisiFisik;
		$data["arr_wa_ekosistem"]=$arrEkosistem;
		$data["arr_wa_potensihayati"]=$arrPotensiHayati;
		
		//nambahin
		$arrDataPotensiMap=array();
		$arrDataPotensi=$this->model_potensi_hayati->SearchRecordWhere("id_wa=$id");
		if(cek_array($arrDataPotensi)):
			foreach($arrDataPotensi as $x=>$val):
				$arrDataPotensiMap[$val["id_potensi_hayati"]]=$val;
			endforeach;
		endif;
		$data["potensi"]=$arrDataPotensiMap;
		$data['arrAlamat']=$this->model_cms_configuration->GetRecordData("id_key='alamat_laporan'");
		$data['arrEmail']=$this->model_cms_configuration->GetRecordData("id_key='email'");
		$data['arrKontak']=$this->model_cms_configuration->GetRecordData("id_key='kontak_laporan'");
		if($act=="update"):
			// debug();
			$this->conn->StartTrans();
            $data=get_post();
			$data=$this->_add_editor($data);
			unset($data[$this->tbl_idx]);
			//pre($data);exit;
			$this->model->UpdateData($data, "{$this->tbl_idx}=$id");
			$ok=$this->conn->CompleteTrans();
          	$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");	
        endif;
		// debug();
		//-----------
		$this->load->library('pagination');  
        $table_dok='wa_pengajuan_keberatan';    
		$queryString=rebuild_query_string();
        
		$data_type=$this->adodbx->GetDataType($table_dok);
		
		foreach($data_type as $x=>$val):
            if(($val=="C")||($val=="X")) $data["text"][]=$x;
        endforeach;
        
        $col_text=$data["text"];
		$field=join(",",$col_text);
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
        
        $whereSql="id_wa = $id";
        if(cek_array($where)):
            $whereSql.=join(" and ",$where);
        endif;
        $perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"25";
        $data["perPage"]=$perPage;
	    $uriSegment=4;
        $totalRows=$this->model_wa_keberatan->getTotalRecordWhere($whereSql);
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by {$this->tbl_sort}";
        
        //$arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
		$arrDataDok=$this->model_wa_keberatan->search_record_by_limit_where($table_dok,$whereSql,$perPage,$offset,$sortBy);

		$config['base_url'] = $this->module."view";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        $this->pagination->initialize($config);
        
        $data["arrDataDok"]=$arrDataDok;
		//--------
		
		$data["data"]=$arrData;
		$data["pembagian_ruang"]=$this->model_pembagian_ruang->SearchRecordWhere("id_wa=$id");
		$data["data_view2"]=$this->load->view($this->module."v_view2",$data,true);
		$this->_render_page($this->module."v_view",$data,true);
     }
	 
	 
	 function get_kab_kota($kd_bps_propinsi="",$arr_id=""){
		$sql="select * from m_kabupaten_kota where kode_prop=$kd_bps_propinsi and kode_kab!='00' order by kode_bps";
		$arrKabKota=$this->conn->GetAll($sql);
		$arrData=array();
		if(cek_array($arrKabKota)):
			foreach($arrKabKota as $x=>$val):
				$arrData[$val["kode_bps"]]=$val["nama"];
			endforeach;
		endif;
		$data["dataKabupaten"]=$arrData;
		$data["arr_id"]=$arr_id;
		echo $this->load->view($this->module."lookup_kabupaten",$data,true);
	}
	
	 function add($id){
		if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
		$this->msg_ok="Data created successfully";
        $this->msg_fail="Unable to add new comment";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
		if($act=="create"):
			// debug();
			$data=get_post();
			$data['id_wa']=$data['id_wa'];
			$data=$this->_add_creator($data);
			if(!empty($_FILES['dok_name']['name'])){
				$fix_name = time().substr($_FILES['dok_name']['name'],strrpos($_FILES['dok_name']['name'],"."));
				
				$uploadPath="docs/wa_doc/keberatan/";
				check_folder($uploadPath);
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|rar|zip';
				$config['max_size']  = '10000000';
				$config['file_name'] = $fix_name;	
				$this->load->library('upload', $config);		
				$field = "dok_name";
				// $headline_img=$fix_name;
				if ($fix_name) $data["dok_name"]=$fix_name;
				if ($this->upload->do_upload($field))
				{					
					$data_up = $this->upload->data();
					$this->conn->StartTrans();
					$this->model_wa_keberatan->InsertData($data);
					$ok = $this->conn->CompleteTrans();
					// redirect("keberatan/keberatan/view/$id_enc");
					$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");
				}	
				else
				{
					// redirect("keberatan/keberatan/view/$id_enc");
					$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");
				}
			}
		endif;
    }
	 
	 
	 function get_kab_kota_arr($kd_bps_propinsi="",$arr_id=""){
		$sql="select * from m_kabupaten_kota where kode_prop=$kd_bps_propinsi and kode_kab!='00' order by kode_bps";
		$arrKabKota=$this->conn->GetAll($sql);
		$arrData=array();
		if(cek_array($arrKabKota)):
			foreach($arrKabKota as $x=>$val):
				$arrData[$val["kode_bps"]]=$val["nama"];
			endforeach;
		endif;
		return $arrData;
	}
	
	/*STATUS DOCUMENT*/
	 
	 function get_map_proses(){
	 	 $mapProses=m_lookup("wa_proses","id_proses","nama_proses",""," order by idx asc ");
		 $this->data["map_proses"]=$mapProses;
		 $arrProsesStatus=$this->adodbx->search_record("m_wa_proses_status");
		 $mapProsesStatus=array();
		 if(cek_array($arrProsesStatus)):
		 	foreach($arrProsesStatus as $x=>$val):
				$mapProsesStatus[$val["id_proses"]][$val["id_status"]]=$val["status"];
			endforeach;
		 endif;
		$this->data["map_proses_status"]=$mapProsesStatus;
	 }
	
	
	
}