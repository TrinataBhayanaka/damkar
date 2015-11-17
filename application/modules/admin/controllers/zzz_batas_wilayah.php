<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class batas_wilayah extends Admin_Controller {
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
        //$this->model=$this->m_pelatihan_model;
        $this->model=new general_model("tb_batas_propinsi");
		$this->model_detail=new general_model("tb_batas_propinsi_detail");
		$this->model_file=new general_model("tb_batas_propinsi_file");
		$this->model_file_peta=new general_model("tb_batas_propinsi_file_peta");
		$this->model_uu=new general_model("tb_batas_propinsi_uu");
		
		//$this->model_detail=new general_model("pam_data_binter_personil");
		//$this->model_detail_file=new general_model("pam_data_binter_file");
        //$this->listText="Nama Pejabat";
        
        //$this->acc_active="master_asset_category";
        $this->main_layout="admin_lte_layout/main_layout";
		
		$this->module_title="Batas Wilayah Propinsi";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx desc";
		$this->tbl_uu="(select a.id_parent,b.* from ".$this->model_uu->tbl." a left join tb_peraturan_pembentukan_daerah b on a.id_peraturan=b.idx) uu";
		
		$this->search_table="(select a.*,b.kabupaten,c.peraturan from ".$this->model->tbl." a 
				left join (select id_parent,group_concat(kabupaten_1,'|',kabupaten_2) as kabupaten from ".$this->model_detail->tbl." group by id_parent) b  on a.idx=b.id_parent left join (select id_parent,group_concat(no_peraturan,'|',tentang) as peraturan from ".$this->tbl_uu." group by id_parent) c on a.idx=c.id_parent) a
			";
		
	 }
	 
	 function index(){
	 	$this->listview();
		//$this->_render_page($this->module."registrasi_list",$data,true);
	 }
	 
	 
	 
	 function listview(){
	 	//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
		$this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
		$data_type=$this->adodbx->GetDataType($this->search_table);
		
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
        $table=$this->search_table;
        $totalRows=count($this->model->SearchRecordWhere($whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by {$this->tbl_sort}";
        
        //$arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
		$arrData=$this->model->search_record_by_limit_where($table,$whereSql,$perPage,$offset,$sortBy);
        $arrUU=$this->conn->GetAll("select id_parent,group_concat(b.idx) as id_uu,group_concat(b.no_peraturan,'|',b.tentang order by b.idx separator ';') as data_uu from tb_batas_propinsi_uu a left join tb_peraturan_pembentukan_daerah b on a.id_peraturan=b.idx group by a.id_parent");
		$dataUU=array();
		if(cek_array($arrUU)):
			foreach($arrUU as $x=>$val):
				$dataUU[$val["id_parent"]]=$val;
			endforeach;
		endif;
		
		$data["dataUU"]=$dataUU;
		
		$config['base_url'] = $this->module."listview";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["acc_active"]="guestbook";
        $data["arrData"]=$arrData;
		
        $this->_render_page($this->module."v_list",$data,true);
    }
	
	
	 function get_propinsi_name($id_propinsi){
	 	$arrPropinsi=isset($this->arr_propinsi)?$this->arr_propinsi:m_lookup("propinsi","kode_bps","nama");
		$this->arr_propinsi=$arrPropinsi;
		return $arrPropinsi[$id_propinsi];
	 }
	 
	 function get_map_jenis_peraturan(){
	 	return m_lookup("jenis_peraturan","id_jenis_peraturan","jenis_peraturan");
	 }
	 
	 function add(){
	 	$this->msg_ok="Data created successfully";
        $this->msg_fail="Unable to add new comment";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->_render_page($this->module."v_add",$data,true);
        endif;
        //debug();
        if($act=="create"):
			$data=get_post();
			$id_propinsi_1=$data["id_propinsi_1"];
			$id_propinsi_2=$data["id_propinsi_2"];
			
			$data["propinsi_1"]=$this->get_propinsi_name($data["id_propinsi_1"]);
			$data["propinsi_2"]=$this->get_propinsi_name($data["id_propinsi_2"]);
			
			$arrJenisPeraturan=$this->get_map_jenis_peraturan();
			
			$data["jenis_peraturan"]=$arrJenisPeraturan[$data["id_jenis_peraturan"]];
			
			$arrPropinsi1_kab=$this->get_kab_kota_arr($id_propinsi_1);
			$arrPropinsi2_kab=$this->get_kab_kota_arr($id_propinsi_2);
			$id_peraturan=$data["id_jenis_peraturan"]."_".$data["no_peraturan"]."_".$data["tahun_peraturan"];
			$no_sk=ucwords($data["id_jenis_peraturan"])." No.".$data["no_peraturan"]." Tahun ".$data["tahun_peraturan"];
			
			$data["no_sk"]=$no_sk;
			$data["id_peraturan"]=$id_peraturan;
			
			$data=$this->_add_creator($data);
			//pre($arrPropinsi1_kab);
			//pre($arrPropinsi2_kab);
			
			
			$this->conn->StartTrans();
			$this->model->InsertData($data);
			
			 $id_last=$this->model->GetLastID("idx");
			
			if(cek_array($data["id_kabupaten_1"])):
				foreach($data["id_kabupaten_1"] as $x=>$val):
					$data_detail_tmp=array();
					$data_detail_tmp["id_parent"]=$id_last;
					$data_detail_tmp["id_peraturan"]=$id_peraturan;
					$data_detail_tmp["id_propinsi_1"]=$id_propinsi_1;
					$data_detail_tmp["id_propinsi_2"]=$id_propinsi_2;
					$data_detail_tmp["id_kabupaten_1"]=$val;
					$data_detail_tmp["id_kabupaten_2"]=$data["id_kabupaten_2"][$x];
					$data_detail_tmp["kabupaten_1"]=$arrPropinsi1_kab[$val];
					$data_detail_tmp["kabupaten_2"]=$arrPropinsi2_kab[$data["id_kabupaten_2"][$x]];
					//$data_detail[]=$data_detail_tmp;
					$this->model_detail->InsertData($data_detail_tmp);
				endforeach;
			endif;
			
			/* file insert */
			$this->update_file($id_last);
			
			/* file insert peta */
			$this->update_file_peta($id_last);
			
			/* insert uu */
			$this->update_uu($id_last);
			
			$ok=$this->conn->CompleteTrans();
			//pre($ok);
            $this->_proses_message($ok,$this->module."listview/",$this->module."add/");
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
            $data["data"]=$arrData;
			$data["data_file"]=$this->model_file->SearchRecordWhere("id_parent=$id");
			$data["data_file_peta"]=$this->model_file_peta->SearchRecordWhere("id_parent=$id");
			
			$data["data_detail"]=$this->model_detail->SearchRecordWhere("id_parent=$id");
			
			$sql="(select a.id_parent,b.* from ".$this->model_uu->tbl." a right join 
				tb_peraturan_pembentukan_daerah b
				 on a.id_peraturan=b.idx) a
			";
			$data["data_detail_uu"]=$this->adodbx->search_record_where($sql,"id_parent=$id");
			
			$sql_uu="(select a.id_parent,group_concat(b.idx order by b.idx separator '|') as dasar_id,group_concat(b.no_peraturan order by b.idx separator '|') as 
				no_peraturan,group_concat(b.tentang order by b.idx separator  '|') as tentang from ".$this->model_uu->tbl." a left join 
				tb_peraturan_pembentukan_daerah b
				 on a.id_peraturan=b.idx group by a.id_parent) a
			";
			$data["data_uu"]=$this->adodbx->search_record_where($sql_uu,"id_parent=$id");
			
			
			$data["arr_kab1"]=$this->get_kab_kota_arr($arrData["id_propinsi_1"]);
			$data["arr_kab2"]=$this->get_kab_kota_arr($arrData["id_propinsi_2"]);
			
			$this->_render_page($this->module."v_edit",$data,true);
        endif;
		
		if($act=="update"):
			
            $this->conn->StartTrans();
            $data=get_post();
			$id_propinsi_1=$data["id_propinsi_1"];
			$id_propinsi_2=$data["id_propinsi_2"];
			
			$data["propinsi_1"]=$this->get_propinsi_name($data["id_propinsi_1"]);
			$data["propinsi_2"]=$this->get_propinsi_name($data["id_propinsi_2"]);
			
			$arrJenisPeraturan=$this->get_map_jenis_peraturan();
			
			$data["jenis_peraturan"]=$arrJenisPeraturan[$data["id_jenis_peraturan"]];
			
			$arrPropinsi1_kab=$this->get_kab_kota_arr($id_propinsi_1);
			$arrPropinsi2_kab=$this->get_kab_kota_arr($id_propinsi_2);
			$id_peraturan=$data["id_jenis_peraturan"]."_".$data["no_peraturan"]."_".$data["tahun_peraturan"];
			$no_sk=ucwords($data["id_jenis_peraturan"])." No.".$data["no_peraturan"]." Tahun ".$data["tahun_peraturan"];
			
			$data["no_sk"]=$no_sk;
			$data["id_peraturan"]=$id_peraturan;
			
            $data=$this->_add_editor($data);
			
			unset($data[$this->tbl_idx]);
		   	
			$this->model->UpdateData($data, "{$this->tbl_idx}=$id");
			
			$this->update_file($id);
			$this->update_file_peta($id);
			
			
			$this->update_data_detail($id);
			$this->update_uu($id);
			
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
                $this->model_file->DeleteData("id_parent=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."listview",$this->module."profile/$id_enc");
        endif;
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
	
	
	function get_data_uu(){
		$sql="select * from tb_peraturan_pembentukan_daerah order by tahun_peraturan,no_peraturan";
		$arrDataAll=$this->conn->GetAll($sql);
		$arrData=array();
		
		if(cek_array($arrDataAll)):
			foreach($arrDataAll as $x=>$val):
				$arrData[$val["idx"]]=$val["no_peraturan"]." tentang ".$val["tentang"];
			endforeach;
		endif;
		
		return $arrData;
	}
	
	
	function update_uu($id_parent){
		$data=get_post();
		if(cek_var($data["dasar_id"])):
			$data_id_arr=preg_split("/\||\,/",$data["dasar_id"]);
			if(cek_array($data_id_arr)):
				$this->model_uu->DeleteData("id_parent=$id_parent");
				foreach($data_id_arr as $id_uu):
					$data_update=array();
					$data_update["id_parent"]=$id_parent;
					$data_update["id_peraturan"]=$id_uu;
					$this->model_uu->InsertData($data_update);
				endforeach;		
			endif;
		endif;
	}
	
	function update_file($id_parent){
        
		$file_arr=$this->input->post("upload_file_id");
		//$file_tipe_arr=$this->input->post("tipe_doc"); //if has tipe like foto , surat pendukung dll
        //$dasar_surat_arr=$this->input->post("dasar_surat"); //if has tipe like foto , surat pendukung dll
        if(!cek_array($file_arr)):
			return true;
		endif;
		
		/*
        foreach($file_arr as $x=>$val):
            $type_doc[$val]=$file_tipe_arr[$x];
            $dasar_surat[$val]=$dasar_surat_arr[$x];
        endforeach;
        */
		
        if(cek_array($file_arr)):
            $whereIn="idx in(".join(",",$file_arr).")";
            
            $arrFile=$this->adodbx->search_record_where("t_file_upload",$whereIn);
            if(cek_array($arrFile)):
                $this->model_file->DeleteData("id_parent=$id_parent");
                foreach($arrFile as $file):
                    $dataInsert=array();
                    $dataInsert["id_file"]=$file["idx"];
                    $dataInsert["tipe_doc"]="file";
					//$dataInsert["tipe_doc"]=$type_doc[$file["idx"]];
                    //$dataInsert["dasar_surat"]=$dasar_surat[$file["idx"]];
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
	
	
	/*function update_file($id_parent){
        $file_arr=$this->input->post("file_id");
        $file_tipe_arr=$this->input->post("tipe_doc"); //if has tipe like foto , surat pendukung dll
        $dasar_surat_arr=$this->input->post("dasar_surat"); //if has tipe like foto , surat pendukung dll
        if(!cek_array($file_arr)):
			return true;
		endif;
		
        foreach($file_arr as $x=>$val):
            $type_doc[$val]=$file_tipe_arr[$x];
            $dasar_surat[$val]=$dasar_surat_arr[$x];
        endforeach;
        
        if(cek_array($file_arr)):
            $whereIn="idx in(".join(",",$file_arr).")";
            
            $arrFile=$this->adodbx->search_record_where("t_file_upload",$whereIn);
            if(cek_array($arrFile)):
                $this->model_file->DeleteData("id_parent=$id_parent");
                foreach($arrFile as $file):
                    $dataInsert=array();
                    $dataInsert["id_file"]=$file["idx"];
                    $dataInsert["tipe_doc"]=$type_doc[$file["idx"]];
                    $dataInsert["dasar_surat"]=$dasar_surat[$file["idx"]];
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
        
    }*/
	
	
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
	
	
	function update_data_detail($id_parent){
        $this->model_detail->DeleteData("id_parent=$id_parent");
        //$data=$this->input->post("daerah_penugasan");
        $data=get_post();
		$id_propinsi_1=$data["id_propinsi_1"];
		$id_propinsi_2=$data["id_propinsi_2"];
		$arrPropinsi1_kab=$this->get_kab_kota_arr($id_propinsi_1);
		$arrPropinsi2_kab=$this->get_kab_kota_arr($id_propinsi_2);
		$id_peraturan=$data["id_jenis_peraturan"]."_".$data["no_peraturan"]."_".$data["tahun_peraturan"];
		$no_sk=ucwords($data["id_jenis_peraturan"])." No.".$data["no_peraturan"]." Tahun ".$data["tahun_peraturan"];
		
		if(cek_array($data["id_kabupaten_1"])):
			foreach($data["id_kabupaten_1"] as $x=>$val):
					$data_detail_tmp=array();
					$data_detail_tmp["id_parent"]=$id_parent;
					$data_detail_tmp["id_peraturan"]=$id_peraturan;
					$data_detail_tmp["id_propinsi_1"]=$id_propinsi_1;
					$data_detail_tmp["id_propinsi_2"]=$id_propinsi_2;
					$data_detail_tmp["id_kabupaten_1"]=$val;
					$data_detail_tmp["id_kabupaten_2"]=$data["id_kabupaten_2"][$x];
					$data_detail_tmp["kabupaten_1"]=$arrPropinsi1_kab[$val];
					$data_detail_tmp["kabupaten_2"]=$arrPropinsi2_kab[$data["id_kabupaten_2"][$x]];
					//$data_detail[]=$data_detail_tmp;
					$this->model_detail->InsertData($data_detail_tmp);
			endforeach;
		endif;
		
	}
	
	
	 function view($id){
        if($this->encrypt_status==TRUE):
            $id_enc=$id;
            $id=decrypt($id);
        endif;
        $arrData=$this->model->GetRecordData("idx=$id");
		$arrDataDetail=$this->model_detail->SearchRecordWhere("id_parent=$id");
		$arrDataFile=$this->model_file->SearchRecordWhere("id_parent=$id");
		$arrDataFilePeta=$this->model_file_peta->SearchRecordWhere("id_parent=$id");
		$arrDataUU=$this->adodbx->search_record_where($this->tbl_uu,"id_parent=$id");
		
        $data["data"]=$arrData;
		$data["data_detail"]=$arrDataDetail;
		$data["data_file"]=$arrDataFile;
       	$data["data_file_peta"]=$arrDataFilePeta;
        $data["data_uu"]=$arrDataUU;
        
		$this->_render_page($this->module."v_view_2",$data,true);
        
     }
	 
	 
	 function list_uu(){
	 	$data["arrData"]=$this->adodbx->search_record("tb_peraturan_pembentukan_daerah");
		$this->load->view($this->module."list_uu",$data);
	 }
	 
	 
	 function lookup_uu(){
	 	 $this->load->library('pagination');  
        $queryString=rebuild_query_string();
       
	    $table="tb_peraturan_pembentukan_daerah";
      
        $data_type=$this->adodbx->GetDataType($table);
		
        foreach($data_type as $x=>$val):
            if(($val=="C")||($val=="X")) $data["text"][]=$x;
        endforeach;
		
        $col_text=cek_var($data["text"])?$data["text"]:"";
        $field=join(",",$col_text);
        //$field="jenis_pelanggaran";
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
        $perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"25";
        $data["perPage"]=$perPage;
       
        $uriSegment=4;
        //$table=$this->model->tbl;
       
        $totalRows=count($this->adodbx->search_record_where($table,$whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sort=$this->input->get_post("sort")?$this->input->get_post("sort"):"idx";
        if(!empty($sort)):
            $sortBy=" order by {$sort}";
        endif;
        
        $arrData=$this->adodbx->search_record_by_limit_where($table,$whereSql,$perPage,$offset,$sortBy);
        
        $config['base_url'] = $this->module."lookup_uu";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
        
        $this->load->view($this->module."v_lookup_uu",$data);
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

}