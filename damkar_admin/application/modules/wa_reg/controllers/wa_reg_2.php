<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wa_reg extends Admin_Controller {
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
		$this->main_layout="admin_lte_layout/main_layout";
		$this->module_title="Register Wilayah Adat";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx asc";
		
	 }
	 
	 function index(){
	 	$this->listview();
		//$this->_render_page($this->module."registrasi_list",$data,true);
	 }
	 
	 
	 
	 function listview(){
	 	//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
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
	
	function add($id){
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
			debug();
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
	
	function add($id){
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
			debug();
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
	
    
    function edit($id){
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
		
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
			
			
            $data["data"]=$arrData;
			$data["arr_kab"]=$this->get_kab_kota_arr($arrData["id_propinsi"]);
			
			$this->_render_page($this->module."v_edit",$data,true);
        endif;
		
		if($act=="update"):
			debug();
			$this->conn->StartTrans();
            $data=get_post();
			$data=$this->_add_editor($data);
			unset($data[$this->tbl_idx]);
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
			
			$ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."listview",$this->module."edit/$id_enc");
        endif;
            
    }
    
    function del($id){
        //if (!$this->cms->has_admin($this->module)) redirect ("admin/error");
        if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
        
        $this->msg_ok="Data deleted successfully";
        $this->msg_fail="Unable to delete data";
      
        $arrData=$this->model->GetRecordData("{$this->tbl_idx}=$id");
		
		
        $act="delete";    
        if($act=="delete"):
            $this->conn->StartTrans();
               $this->model->DeleteData("{$this->tbl_idx}=$id");
			$this->model_contact->DeleteData("id_wa=".$id);
			$this->model_sejarah->DeleteData("id_wa=".$id);
			$this->model_hukum_adat->DeleteData("id_wa=".$id);
			$this->model_hayati->DeleteData("id_wa=".$id);
			$this->model_lembaga_adat->DeleteData("id_wa=".$id);
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id);
				
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."listview",$this->module."view/$id_enc");
        endif;
    }
	
	function view($id){
        if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
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
		
		$data["arr_propinsi"]=$arrPropinsi;
		$data["arr_kabupaten"]=$arrKab;
		$data["arr_wa_kondisi_fisik"]=$arrWaKondisiFisik;
		$data["arr_wa_ekosistem"]=$arrEkosistem;
		
	    $data["data"]=$arrData;
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
	 
	
}