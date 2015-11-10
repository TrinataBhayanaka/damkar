<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wa_reg extends Admin_Controller {
	var $arr_category=array();
    
    function __construct(){
        parent::__construct();
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
		$this->model_adm_groups=new general_model("adm_groups");
		$this->load->model("ion_auth_model");
		$this->load->library('lauth');
		$this->appname=$this->lauth->appname;
		$this->load->model("admin/account_manager_model");
        $this->model_grp=$this->account_manager_model;
		
		$this->main_layout="admin_lte_layout/main_layout";
		$this->module_title="Pengajuan Wilayah Adat";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx asc";
		
		$this->get_map_proses();
		
		$this->cek_file();
		$this->cek_file_peta();
		$this->cek_file_image();
	 }
	 
	 function index(){
	 	$this->listview();
		//$this->_render_page($this->module."registrasi_list",$data,true);
	 }
	 
	 
	 
	 
	 
	 function listview(){
	 	debug();
	 	if (!$this->cms->has_view($this->module)) redirect ("error_");
		//acl
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		$zz=$this->model_grp->group_get("id=$userSess[group_brwa]");
		//acl
		$this->load->library('pagination');  
        $table=$this->model->tbl;    
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
		
		// if($userSess['id_propinsi'] != ''):
			// $where[]="(doc_proses=1 and doc_status=1 and id_propinsi = $userSess[id_propinsi])";
        // else:
			// $where[]="(doc_proses=1 and doc_status=1)";
		// endif;
		
		//acl
		if($zz['id_propinsi'] != ''):
			$where[]="id_propinsi IN ( $zz[id_propinsi] ) and (doc_proses=1 and doc_status=1)";
        else:
			$where[]="(doc_proses=1 and doc_status=1)";
		endif;
		//acl
		
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
		//pre($data["arrData"]);exit;
		$this->_render_page($this->module."v_list",$data,true);
    }
	
	
	function listuser(){
		// debug();
	 	//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
		// $userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		// if($userSess['id_propinsi'] != ''):
			// $arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
				// foreach($arrPropinsi as $x=>$val):
					// if($userSess['id_propinsi'] == $x):
						// $v = $val;
					// endif;
				// endforeach;
		// endif;
		$this->load->library('pagination');  
        $table=$this->model_list_user->tbl;    
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
        
        $totalRows=$this->model_list_user->getTotalRecordWhere($whereSql,"id");
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" ";
        
        //$arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
		$arrData=$this->model_list_user->search_record_by_limit_where($table,$whereSql,$perPage,$offset,$sortBy);
      
		$config['base_url'] = $this->module."listuser";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
		//pre($data["arrData"]);exit;
		$this->_render_page($this->module."v_list_user",$data,true);
    }
	
	function add_backup($id){
		$this->msg_ok="Data created successfully";
        $this->msg_fail="Unable to add new comment";
        $data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
			// pre($data['arrdata']);exit;
			$this->_render_page($this->module."v_add",$data,true);
        endif;
		
        //debug();
        if($act=="create"):
			//debug();
			$data=get_post();
			$data=$this->_add_creator($data);
			$this->conn->StartTrans();
			$this->model->InsertData($data);
			//pre($data);exit;
			$id_last=$this->model->GetLastID("idx");
			// pre($id_last);exit;
			$data_update=$data;
			unset($data_update["idx"]);
			$data_update["id_wa"]=$id_last;
			$this->model_contact->DeleteData("id_wa=".$id_last);
			$this->model_contact->InsertData($data_update);
			
			$this->model_sejarah->DeleteData("id_wa=".$id_last);
			$this->model_sejarah->InsertData($data_update);
			
			$this->model_hukum_adat->DeleteData("id_wa=".$id_last);
			$this->model_hukum_adat->InsertData($data_update);
			
			$this->model_hayati->DeleteData("id_wa=".$id_last);
			$this->model_hayati->InsertData($data_update);
			
			$this->model_lembaga_adat->DeleteData("id_wa=".$id_last);
			$this->model_lembaga_adat->InsertData($data_update);
			
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id_last);
			$this->model_hak_atas_tanah->InsertData($data_update);
			
			$ok=$this->conn->CompleteTrans();
			//pre($ok);
            //$this->_proses_message($ok,$this->module."listview/",$this->module."add/");
        else:
			$this->data['message'] = validation_errors() ? validation_errors():false;
			$this->_render_page("wa_reg/add/$data[arrdata][id]", $this->data,true);
		endif;
    }
	
	function add($idx=null){
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		$arrGroup = $this->model_adm_groups->GetRecordData("id=$userSess[group_brwa]");
		// pre($arrGroup['id_propinsi']);exit;
		if (!$this->cms->has_write($this->module)) redirect ("error_");
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		// debug();
		
		$this->msg_ok="Data created successfully";
        $this->msg_fail="Unable to add new comment";
        
		$data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
		
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
			if($idx==null):
				//$arrDB=$this->model_list_user->SearchRecord();
				//$data["data_user"]=$arrDB;
				//$this->_render_page($this->module."v_add_step1",$data,true);
				redirect($this->module."listuser");
				return false;
			endif;
		
            $data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
			$data['tooltip'] = $this->config->item("registrasi_help");
			// if(($userSess['group_brwa'] == 1) || ($userSess['group_brwa'] == 2)):
				// $this->_render_page($this->module."v_add",$data,true);
			// else:
				// $this->_render_page($this->module."v_add_others",$data,true);
			// endif;
			// echo $arrGroup['id_propinsi'];exit;
			if(($arrGroup['id_propinsi'] == '') || ($arrGroup['id_propinsi'] == null)):
				$this->_render_page($this->module."v_add",$data,true);
			elseif($arrGroup['id_propinsi'] != ''):
				$this->_render_page($this->module."v_add_others",$data,true);
				
			endif;
			
        endif;
		
        //debug();
        if($act=="create"):
			$data=get_post();
			// echo $id."/".$id_enc;
			// pre($data);exit;
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
			$data['jenis_ekosistem']=implode(",",$data['list_jenis_ekosistem']);
			
			$data=$this->_add_creator($data);
			$this->conn->StartTrans();
			$this->model->InsertData($data);
			$id_last=$this->model->GetLastID("idx");
			$data_update=$data;
			unset($data_update["idx"]);
			$data_update["id_wa"]=$id_last;
			$this->model_contact->DeleteData("id_wa=".$id_last);
			$this->model_contact->InsertData($data_update);
			
			$this->model_sejarah->DeleteData("id_wa=".$id_last);
			$this->model_sejarah->InsertData($data_update);
			
			$this->model_hukum_adat->DeleteData("id_wa=".$id_last);
			$this->model_hukum_adat->InsertData($data_update);
			
			$this->model_hayati->DeleteData("id_wa=".$id_last);
			$this->model_hayati->InsertData($data_update);
			
			$this->model_lembaga_adat->DeleteData("id_wa=".$id_last);
			$this->model_lembaga_adat->InsertData($data_update);
			
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id_last);
			$this->model_hak_atas_tanah->InsertData($data_update);
			
			//$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			//$this->model_potensi_hayati->InsertData($data_update);
			
			//batas_wilayah_lain
			$this->model_batas_wilayah->DeleteData("id_wa=".$id_last);
			if(cek_array($data_batas_wilayah)):
				foreach($data_batas_wilayah as $data_batas):
					$data_batas["id_wa"]=$id_last;
					$this->model_batas_wilayah->InsertData($data_batas);
				endforeach;	
			endif;
			
			//pemanfaatan pembagian_ruang
			// $this->model_pembagian_ruang->DeleteData("id_wa=".$id_last);
			// if(cek_array($data_pembagian_ruang)):
				// foreach($data_pembagian_ruang as $data_ruang):
					// $data_ruang["id_wa"]=$id_last;
					// $this->model_pembagian_ruang->InsertData($data_ruang);
				// endforeach;	
			// endif;
			
			//data_potensi
			$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi)):
				foreach($data_potensi as $data_pot):
					$data_pot["id_wa"]=$id_last;
					$this->model_potensi_hayati->InsertData($data_pot);
				endforeach;	
			endif;
			
			//data_potensi_lain
			$this->model_potensi_hayati_lain->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi_lain)):
				foreach($data_potensi_lain as $data_potensi_lain):
					$data_potensi_lain["id_wa"]=$id_last;
					$this->model_potensi_hayati_lain->InsertData($data_potensi_lain);
				endforeach;	
			endif;
			
			$this->update_file($id_last);
			$this->update_image($id_last);
			$this->update_file_peta($id_last);
			
			
			//update history
			wa_log_insert($id_last);
			
			$ok=$this->conn->CompleteTrans();
			if($this->encrypt_status==TRUE):
				$idn=encrypt($id_last);
			endif;
			//$this->data['tooltip'] = $this->config->item("registrasi_help");
           	$this->_proses_message($ok,$this->module."edit/$idn",$this->module."add/$idn");
        /*
		else:
			$this->data['message'] = validation_errors() ? validation_errors():false;
			$this->_render_page("wa_reg/add/$data[arrdata][id]", $this->data,true);
		*/
		endif;
    }
	
	
	function add2($idx=null){
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		
		$this->msg_ok="Data created successfully";
        $this->msg_fail="Unable to add new comment";
        
		
		
		$data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
		
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
			if($idx==null):
				//$arrDB=$this->model_list_user->SearchRecord();
				//$data["data_user"]=$arrDB;
				//$this->_render_page($this->module."v_add_step1",$data,true);
				redirect($this->module."listuser");
				return false;
			endif;
		
            $data['arrdata']=$this->model_list_user->GetRecordData("id=$id");
			// pre($data['arrdata']);exit;
			$this->_render_page($this->module."v_register",$data,true);
        endif;
		
        //debug();
        if($act=="create"):
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
			
			$data_pembagian_ruang=array();
			if(cek_array($data["ruang"])):
				$arr_tmp=array_combine($data["ruang"],$data["ruang_val"]);
				foreach($arr_tmp as $ruang=>$ruang_val):
					$tmp=array();
					$tmp["pemanfaatan_kawasan"]=$ruang;
					$tmp["luas"]=$ruang_val;
					$data_pembagian_ruang[]=$tmp;
				endforeach;
			endif;
			
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
			
			
			
			$data=$this->_add_creator($data);
			$this->conn->StartTrans();
			$this->model->InsertData($data);
			$id_last=$this->model->GetLastID("idx");
			$data_update=$data;
			unset($data_update["idx"]);
			$data_update["id_wa"]=$id_last;
			$this->model_contact->DeleteData("id_wa=".$id_last);
			$this->model_contact->InsertData($data_update);
			
			$this->model_sejarah->DeleteData("id_wa=".$id_last);
			$this->model_sejarah->InsertData($data_update);
			
			$this->model_hukum_adat->DeleteData("id_wa=".$id_last);
			$this->model_hukum_adat->InsertData($data_update);
			
			$this->model_hayati->DeleteData("id_wa=".$id_last);
			$this->model_hayati->InsertData($data_update);
			
			$this->model_lembaga_adat->DeleteData("id_wa=".$id_last);
			$this->model_lembaga_adat->InsertData($data_update);
			
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id_last);
			$this->model_hak_atas_tanah->InsertData($data_update);
			
			//$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			//$this->model_potensi_hayati->InsertData($data_update);
			
			//batas_wilayah_lain
			$this->model_batas_wilayah->DeleteData("id_wa=".$id_last);
			if(cek_array($data_batas_wilayah)):
				foreach($data_batas_wilayah as $data_batas):
					$data_batas["id_wa"]=$id_last;
					$this->model_batas_wilayah->InsertData($data_batas);
				endforeach;	
			endif;
			
			//pemanfaatan pembagian_ruang
			$this->model_pembagian_ruang->DeleteData("id_wa=".$id_last);
			if(cek_array($data_pembagian_ruang)):
				foreach($data_pembagian_ruang as $data_ruang):
					$data_ruang["id_wa"]=$id_last;
					$this->model_pembagian_ruang->InsertData($data_ruang);
				endforeach;	
			endif;
			
			//data_potensi
			$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi)):
				foreach($data_potensi as $data_pot):
					$data_pot["id_wa"]=$id_last;
					$this->model_potensi_hayati->InsertData($data_pot);
				endforeach;	
			endif;
			
			//data_potensi_lain
			$this->model_potensi_hayati_lain->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi_lain)):
				foreach($data_potensi_lain as $data_potensi_lain):
					$data_potensi_lain["id_wa"]=$id_last;
					$this->model_potensi_hayati_lain->InsertData($data_potensi_lain);
				endforeach;	
			endif;
			
			$this->update_file($id_last);
			$this->update_image($id_last);
			$this->update_file_peta($id_last);
			
			
			$ok=$this->conn->CompleteTrans();
			if($this->encrypt_status==TRUE):
				$idn=encrypt($id_last);
			endif;
           	$this->_proses_message($ok,$this->module."edit/$idn",$this->module."add/$idn");
        /*
		else:
			$this->data['message'] = validation_errors() ? validation_errors():false;
			$this->_render_page("wa_reg/add/$data[arrdata][id]", $this->data,true);
		*/
		endif;
    }
	
    
    function edit($id){
		
		if (!$this->cms->has_write($this->module)) redirect ("error_");
  		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		$arrGroup = $this->model_adm_groups->GetRecordData("id=$userSess[group_brwa]");
		// echo $arrGroup['id_propinsi'];exit;
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
			$data['tooltip'] = $this->config->item("registrasi_help");
			if(($userSess['group_brwa'] == 1) || ($userSess['group_brwa'] == 2)):
				$this->_render_page($this->module."v_edit",$data,true);
			else:
				$this->_render_page($this->module."v_edit_others",$data,true);
			endif;
			// if(($arrGroup['id_propinsi'] == '') || ($arrGroup['id_propinsi'] == null)):
				// $this->_render_page($this->module."v_edit",$data,true);
			// elseif($arrGroup['id_propinsi'] != ''):
				// $this->_render_page($this->module."v_edit_others",$data,true);
				
			// endif;
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
			$data['jenis_ekosistem']=implode(",",$data['list_jenis_ekosistem']);
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
    
    function del($id){
        if (!$this->cms->has_admin($this->module)) redirect ("error_");
        if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
        
        $this->msg_ok="Data deleted successfully";
        $this->msg_fail="Unable to delete data";
      
        $arrData=$this->model->GetRecordData("{$this->tbl_idx}=$id");
		
		
        $act="delete";    
        if($act=="delete"):
			wa_log_start($id);
			
            $this->conn->StartTrans();
               $this->model->DeleteData("{$this->tbl_idx}=$id");
			$this->model_contact->DeleteData("id_wa=".$id);
			$this->model_sejarah->DeleteData("id_wa=".$id);
			$this->model_hukum_adat->DeleteData("id_wa=".$id);
			$this->model_hayati->DeleteData("id_wa=".$id);
			$this->model_lembaga_adat->DeleteData("id_wa=".$id);
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id);
			
			wa_log_delete($id);
			$ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."listview",$this->module."view/$id_enc");
        endif;
    }
	
	function view($id){
        if (!$this->cms->has_read($this->module)) redirect ("error_");
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
			debug();
			$this->conn->StartTrans();
            $data=get_post();
			$data=$this->_add_editor($data);
			unset($data[$this->tbl_idx]);
			//pre($data);exit;
			$this->model->UpdateData($data, "{$this->tbl_idx}=$id");
			$ok=$this->conn->CompleteTrans();
          	$this->_proses_message($ok,$this->module."view/$id_enc",$this->module."view/$id_enc");	
        endif;
		
		
		
		$data["data"]=$arrData;
		// pre($arrData);exit;
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
	
	
	function update_file($id_parent){
        
		$file_arr=$this->input->post("upload_file_id");
		//$file_tipe_arr=$this->input->post("tipe_doc"); //if has tipe like foto , surat pendukung dll
        //$dasar_surat_arr=$this->input->post("dasar_surat"); //if has tipe like foto , surat pendukung dll
        $id_jenis_doc_arr=$this->input->post("id_jenis_doc");
		if(!cek_array($file_arr)):
			return true;
		endif;
		
		
        foreach($file_arr as $x=>$val):
            $id_jenis_doc[$val]=$id_jenis_doc_arr[$x];
            //$dasar_surat[$val]=$dasar_surat_arr[$x];
        endforeach;
        
		
        if(cek_array($file_arr)):
            $whereIn="idx in(".join(",",$file_arr).")";
            $arrFile=$this->adodbx->search_record_where("t_file_upload",$whereIn);
            if(cek_array($arrFile)):
                $this->model_file->DeleteData("id_parent=$id_parent");
                foreach($arrFile as $file):
                    $dataInsert=array();
					$dataInsert=$file;
					unset($dataInsert["idx"]);
                    $dataInsert["id_file"]=$file["idx"];
                    $dataInsert["tipe_doc"]="file";
					//$dataInsert["tipe_doc"]=$type_doc[$file["idx"]];
                    //$dataInsert["dasar_surat"]=$dasar_surat[$file["idx"]];
					$dataInsert["id_jenis_doc"]=$id_jenis_doc[$file["idx"]];
                    $dataInsert["id_parent"]=$id_parent;
                    $dataInsert["file_name"]=$file["file_name"];
                    $dataInsert["file_path"]=$file["relative_path"];
                    $dataInsert=$this->_add_creator($dataInsert);
                    $dataInsert["ip_address"]=$file["ip_client"];
                    if(empty($file["ip_client"])):
                        $dataInsert=$this->_add_ip_address($dataInsert);
                    endif;
                    //pre($dataInsert);
                    $this->model_file->InsertData($dataInsert);
                endforeach;
            endif;
        endif; 
        
    }
	
	function update_file_peta($id_parent){
        $file_arr=$this->input->post("peta_file_id");
        if(!cek_array($file_arr)):
			return true;
		endif;
		
        if(cek_array($file_arr)):
            $whereIn="idx in(".join(",",$file_arr).")";
            
            $arrFile=$this->adodbx->search_record_where("t_file_upload",$whereIn);
            if(cek_array($arrFile)):
                $this->model_file_peta->DeleteData("id_parent=$id_parent");
                foreach($arrFile as $file):
                    $dataInsert=array();
					$dataInsert=$file;
					unset($dataInsert["idx"]);
                    $dataInsert["id_file"]=$file["idx"];
                    $dataInsert["id_parent"]=$id_parent;
                    $dataInsert["file_name"]=$file["file_name"];
                    $dataInsert["file_path"]=$file["relative_path"];
                    $dataInsert["tipe_doc"]="peta";
                    
					$dataInsert=$this->_add_creator($dataInsert);
                    $dataInsert["ip_address"]=$file["ip_client"];
                    if(empty($file["ip_client"])):
                        $dataInsert=$this->_add_ip_address($dataInsert);
                    endif;
                    //pre($dataInsert);
                    $this->model_file_peta->InsertData($dataInsert);
                endforeach;
            endif;
        endif; 
        
    }
	
	
	function update_image($id_parent){
        $file_arr=$this->input->post("image_file_id");
        if(!cek_array($file_arr)):
			return true;
		endif;
		
        if(cek_array($file_arr)):
            $whereIn="idx in(".join(",",$file_arr).")";
            
            $arrFile=$this->adodbx->search_record_where("t_file_upload",$whereIn);
            if(cek_array($arrFile)):
                $this->model_image->DeleteData("id_parent=$id_parent");
                foreach($arrFile as $file):
                    $dataInsert=array();
					$dataInsert=$file;
					unset($dataInsert["idx"]);
                    $dataInsert["id_file"]=$file["idx"];
                    $dataInsert["id_parent"]=$id_parent;
                    $dataInsert["file_name"]=$file["file_name"];
                    $dataInsert["file_path"]=$file["relative_path"];
                    $dataInsert["tipe_doc"]="image";
                    
					$dataInsert=$this->_add_creator($dataInsert);
                    $dataInsert["ip_address"]=$file["ip_client"];
                    if(empty($file["ip_client"])):
                        $dataInsert=$this->_add_ip_address($dataInsert);
                    endif;
                    //pre($dataInsert);
                    $this->model_image->InsertData($dataInsert);
                endforeach;
            endif;
        endif; 
        
    }
	
	function delete_image($id=false){
	 	$this->conn->StartTrans();
		$this->model_image->DeleteData("id_file=$id");
		$ok=$this->conn->CompleteTrans();
		if($ok):
			$this->delete_file($id);
		else:
			print "failed";
		endif;
	 }
	
	function delete_peta_file($id=false){
	 	$this->conn->StartTrans();
		$this->model_file_peta->DeleteData("id_file=$id");
		$ok=$this->conn->CompleteTrans();
		if($ok):
			$this->delete_file($id);
		else:
			print "failed";
		endif;
	 }
	
	
	 function delete_upload_file($id=false){
	 	$this->conn->StartTrans();
		$this->model_file->DeleteData("id_file=$id");
		$ok=$this->conn->CompleteTrans();
		if($ok):
			$this->delete_file($id);
		else:
			print "failed";
		endif;
	 }
	 
	 function delete_file($id=false){
	 	if(!$id):
			print "failed";
			exit();
		endif;
	 	$file=$this->conn->GetRow("select * from t_file_upload where idx=$id");
	 	$ok=$this->conn->Execute("delete from t_file_upload where idx=$id");
		if($ok):
			if(is_file('./' . $file["relative_path"]))
			unlink('./' . $file["relative_path"]);
			if(is_file('./' . $file["relative_path_view"]))
			unlink('./' . $file["relative_path_view"]);
			if(is_file('./' . $file["relative_path_thumb"]))
			unlink('./' . $file["relative_path_thumb"]);
			print "ok";
		else:
			print "failed";
		endif;
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
	 
	 /* cek file */
	 function cek_file(){
	 	$basepath=str_replace("\\","/",FCPATH);
		$arrFile=$this->model_file->SearchRecordWhere("id_file is null");
		$i=0;
		if(cek_array($arrFile)):
		$this->conn->StartTrans();
		foreach($arrFile as $x=>$file):
			$file["relative_path"]=$file["file_path"];
			$file["full_path"]=$basepath.$file["relative_path"];
			$file["file_path"]=str_replace($file["file_name"],"",$file["full_path"]);
			
			if($file["is_image"]==1):
				$file["file_path_view"]=str_replace("/ori/","/resize/",$file["relative_path"]);
				$file["file_path_thumb"]=str_replace("/ori/","/resize/",$file["relative_path"]);
			endif;
			$file["raw_name"]=str_replace($file["file_ext"],"",$file["file_name"]);
			$file["id_file_str"]=$file["id"]."-".date("YmdHis",strtotime($file["created"]));
			$file["orig_name"]=$file["file_name"];
			$file["client_name"]=$file["file_name"];
			$this->adodbx->Insert("t_file_upload",$file);
			$sql = "select max(idx) as value from t_file_upload";
			$id_file=$this->conn->GetOne($sql);
			$id_register=$file["id"];	
			$dataUpdate["id_file"]=$id_file;
			$this->model_file->UpdateData($dataUpdate,"id=$id_register");
		endforeach;
			$this->conn->CompleteTrans();
		endif;
		
	 }
	 
	 function cek_file_peta(){
	 	$basepath=str_replace("\\","/",FCPATH);
		$arrFile=$this->model_file_peta->SearchRecordWhere("id_file is null");
		$i=0;
		if(cek_array($arrFile)):
		$this->conn->StartTrans();
		foreach($arrFile as $x=>$file):
			$file["relative_path"]=$file["file_path"];
			$file["full_path"]=$basepath.$file["relative_path"];
			$file["file_path"]=str_replace($file["file_name"],"",$file["full_path"]);
			
			if($file["is_image"]==1):
				$file["file_path_view"]=str_replace("/ori/","/resize/",$file["relative_path"]);
				$file["file_path_thumb"]=str_replace("/ori/","/resize/",$file["relative_path"]);
			endif;
			$file["raw_name"]=str_replace($file["file_ext"],"",$file["file_name"]);
			$file["id_file_str"]=$file["id"]."-".date("YmdHis",strtotime($file["created"]));
			$file["orig_name"]=$file["file_name"];
			$file["client_name"]=$file["file_name"];
			$this->adodbx->Insert("t_file_upload",$file);
			$sql = "select max(idx) as value from t_file_upload";
			$id_file=$this->conn->GetOne($sql);
			$id_register=$file["id"];	
			$dataUpdate["id_file"]=$id_file;
			$this->model_file_peta->UpdateData($dataUpdate,"id=$id_register");
		endforeach;
			$this->conn->CompleteTrans();
		endif;
		
	 }
	 
	 
	 
	 function cek_file_image(){
	 	$basepath=str_replace("\\","/",FCPATH);
		$arrFile=$this->model_image->SearchRecordWhere("id_file is null");
		if(cek_array($arrFile)):
		$this->conn->StartTrans();
		foreach($arrFile as $x=>$file):
			$file["relative_path"]=$file["file_path"];
			$file["full_path"]=$basepath.$file["relative_path"];
			$file["file_path"]=str_replace($file["file_name"],"",$file["full_path"]);
			
			if($file["is_image"]==1):
				$file["file_path_view"]=str_replace("/ori/","/resize/",$file["relative_path"]);
				$file["file_path_thumb"]=str_replace("/ori/","/resize/",$file["relative_path"]);
			endif;
			$file["raw_name"]=str_replace($file["file_ext"],"",$file["file_name"]);
			$file["id_file_str"]=$file["id"]."-".date("YmdHis",strtotime($file["created"]));
			$file["orig_name"]=$file["file_name"];
			$file["client_name"]=$file["file_name"];
			$this->adodbx->Insert("t_file_upload",$file);
			$sql = "select max(idx) as value from t_file_upload";
			$id_file=$this->conn->GetOne($sql);
			$id_register=$file["id"];	
			$dataUpdate["id_file"]=$id_file;
			$this->model_image->UpdateData($dataUpdate,"id=$id_register");
		endforeach;
			$this->conn->CompleteTrans();
		endif;
		
	 }
	 
	
}