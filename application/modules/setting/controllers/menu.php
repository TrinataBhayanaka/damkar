<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu extends Admin_Controller {


    var $arr_category=array();
    
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
    
        $this->folder="setting/";
        $this->module=$this->folder."menu/";
        $this->http_ref=base_url().$this->module;
        
        $this->load->helper("menu_helper");
        
        $this->load->model("menu_model");
        $this->model=$this->menu_model;
        //$this->model=new m_penghargaan_model();
        //$this->listText="Nama Pejabat";
        
        $this->acc_active="setting_menu";
        $this->admin_layout="admin_layout/main_layout";
		
		$this->module_title="Menu";
		$this->tbl_idx="menu_id";
    }
    
	
	function save_menu(){
		$data=get_post();
		//debug();
		$arrMenu=json_decode($data["nestable-output"],true);
		$arrMenuUpdate=$this->parseJsonArray($arrMenu);
		$this->conn->StartTrans();
		if(cek_array($arrMenuUpdate)):
			$count=0;
			foreach($arrMenuUpdate as $x=>$val):
				$dataUpdate=array();
				$id=$val["menu_id"];
				$dataUpdate=$val;
				$count++;
				$dataUpdate["order_num"]=$count;
				unset($dataUpdate["menu_id"]);
				$this->model->UpdateData($dataUpdate, "{$this->tbl_idx}=$id");
			endforeach;
		endif;
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."menu",$this->module."menu");
	}
	
	function parseJsonArray($jsonArray, $parentID = 0) {
	  $return = array();
	  foreach ($jsonArray as $subArray) {
		$returnSubSubArray = array();
		if (isset($subArray['children'])) {
	  		$returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
		}
		$return[] = array('menu_id' => $subArray['id'], 'menu_parent_id' => $parentID);
		$return = array_merge($return, $returnSubSubArray);
	  }
	  return $return;
	}
	
	function index(){
		$data=array();
		$this->_render_page($this->module."index",$data,true);
      //$this->listview();
	   /*
	   $whereCat=false;
       $arrCategory=$this->model->category_search_record_where($whereCat,"order by order_num");
       $sort=$this->input->post("sort")?$this->input->post("sort"):" category asc";
       $orderBy="";
       if($sort):
           $orderBy="order by ".$sort;
       endif;
       $sql="select * from cms_link ".$orderBy;
       
       $arrData=$this->conn->GetAll($sql);
       $data["arrCategory"]=$arrCategory;
       $data["arrData"]=$arrData;
       $this->_render_page($this->module."index",$data,true);
	   */
    }
	
	function menu_view(){
		debug();
		$data=array();
		$this->_render_page($this->module."index",$data,true);
    }
	
	
	function get_menu($id){
		$data=$this->model->GetRecordData("{$this->tbl_idx}=$id");
		print json_encode($data);
	}
	
	function add_save(){
        $data=$_POST;
		$this->conn->StartTrans();
        $this->model->InsertData($data);
        $ok=$this->conn->CompleteTrans();
        if($ok):
            print "ok";
        else:
            print "not ok";
        endif;
    }
    
    function edit_save(){
        $data=$_POST;
        $id=$data[$this->tbl_idx];
		//$dataOld=$this->model->GetRecord("{$this->tbl_idx}={$id}");
        unset($data["{$this->tbl_idx}"]);
		$this->conn->StartTrans();
        $this->model->UpdateData($data,"{$this->tbl_idx}={$id}");
        $ok=$this->conn->CompleteTrans();
        if($ok):
            print "ok";
        else:
            print "not ok";
        endif;
    }
	
	function delete_save($id){
		$this->msg_ok="Data deleted successfully";
        $this->msg_fail="Unable to delete data";
		
		$this->conn->StartTrans();
		$dataOld=$this->model->GetRecordData("{$this->tbl_idx}='{$id}'");
		$parent_id=$dataOld["menu_parent_id"];
		$this->model->DeleteData("{$this->tbl_idx}='{$id}'");
		$dataUpdate["menu_parent_id"]=$parent_id;
		$this->model->UpdateData($dataUpdate,"menu_parent_id={$id}");
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."menu",$this->module."menu");
	}
	
	/* CATEGORY */
	
	function category_save(){
		$data=get_post();
		$action=$data["act"];
		pre($data);
		debug();
		$id=!empty($data["category_id"])?$data["category_id"]:"";
		$this->conn->StartTrans();
		if($action=="add"){
			$this->msg_ok="Data created successfully";
        	$this->msg_fail="Unable to add new comment";
			unset($data["id"]);
			unset($data["action"]);
			$this->model->Insert("t_menu_category",$data);
		}
		if($action=="update"){
			$this->msg_ok="Data updated successfully";
        	$this->msg_fail="Unable to update data";
			$id_update=$data["id_menu_category"];
			$dataUpdate=$data;
			unset($dataUpdate["id_menu_category"]);
			unset($dataUpdate["action"]);
			//pre($dataUpdate);
			$this->conn->AutoExecute("t_menu_category",$dataUpdate,"UPDATE","id_menu_category=$id_update");
		}
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."menu",$this->module."menu");
	}
	
	function category_delete($id){
		$this->msg_ok="Data deleted successfully";
        $this->msg_fail="Unable to delete data";
		$this->conn->StartTrans();
		$this->model->DeleteCategory($id);
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."menu",$this->module."menu");
	}
    
   /* LINK */
    /*===============================================================================================*/
    function listview(){
  		//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
		
        $this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="name";
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
        $table=$this->model->tbl;
        $totalRows=count($this->model->SearchRecordWhere($whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by id_penghargaan";
        
        $arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
        
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
            $this->conn->StartTrans();
            $data=get_post();
            $data=array_map("trim",$data);
           
            $data=$this->_add_creator($data);
            
            $this->model->InsertData($data);
            $ok=$this->conn->CompleteTrans();
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
            $arrData=$this->model->GetRecordData("{$this->tbl_idx}=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."v_edit",$data,true);
        endif;
        if($act=="update"):
            $this->conn->StartTrans();
            $data=get_post();
            $data=array_map("trim",$data);
            
            $data=$this->_add_editor($data);
            
           unset($data[$this->tbl_idx]);
            $this->model->UpdateData($data, "{$this->tbl_idx}=$id");
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
      
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model->GetRecordData("{$this->tbl_idx}=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."v_delete",$data,true);
        endif;
        if($act=="delete"):
            $this->conn->StartTrans();
            $this->model->DeleteData("{$this->tbl_idx}=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."listview",$this->module."del/$id_enc");
        endif;
    }
    /* end link */
    /*===============================================================================================*/
    
    function _proses_message($ok,$url_ok=false,$url_error=false){
        $url_ok=$url_ok?$url_ok:$this->module;
        $url_error=$url_error?$url_error:$this->module;
        if(!$this->input->is_ajax_request()):    
            if($ok):
                    set_message("success", $this->msg_ok);
                    redirect($url_ok);
            else:
                    set_message("error",$this->msg_fail);
                    redirect($url_error);
            endif;  
        else:
            if($ok):
                 print "ok";
            else:
                print "failed";
            endif;    
        endif;
    }
    
    function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
            $datam["content"]=$view_html;
            $this->load->view($this->admin_layout,$datam);
        endif;
        //if (!$render) return $view_html;
    }
    
    function _prepare_ip($ip_address) {
        if ($this->db->platform() === 'postgre' || $this->db->platform() === 'sqlsrv' || $this->db->platform() === 'mssql')
        {
            return $ip_address;
        }
        else
        {
            return inet_pton($ip_address);
        }
       
    }
    
    
    
	
}

/* End of file pejabat.php */
/* Location: ./application/controllers/master//pejabat.php*/