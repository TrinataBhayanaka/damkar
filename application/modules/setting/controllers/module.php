<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class module extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
    	$this->folder="setting/";
		$this->module=$this->folder."module/";
        $this->http_ref=base_url().$this->module;
		
		$this->lang->load('auth');
		$this->load->helper('language');
        
        $this->load->helper("menu_helper");
        $this->load->helper("bootstrap_helper");
        $this->load->model("module_model");
        $this->model=$this->module_model;
		//$this->listText="Ikan";
		$this->acc_active="account_manager";
		
		//komeng added
		$this->my_logged_data = $this->data['users']['user'];	
		
		//$this->main_layout="layout/main_layout";
		$this->auth_error_page="pages/no_access";
		
		
    }
	
	function index(){
		$this->module_list();
	}
	
	function module_list(){
       	//if (!$this->cms->has_view($this->module)) redirect ($this->auth_error_page);
	   	//debug();
        $this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="module_name,module_path,module_url";
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
       //$this->model= new account_manager_model();
        $uriSegment=4;
        $totalRows=count($this->model->SearchRecordWhere($whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by order_num,idx";
        $arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
		
        $config['base_url'] = $this->module."module_list";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
       
        $this->_render_page($this->module."module_list",$data,true);
    
    }
    
    function module_add(){
        //if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		
        $this->msg_ok="Module created successfully";
        $this->msg_fail="Unable to create new module";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->_render_page($this->module."module_add",$data,true);
        endif;
        //debug();
        if($act=="create"):
            $this->conn->StartTrans();
            $data=get_post();
			$active=isset($data["active"])?$data["active"]:0;
			$data["active"]=$active;
			$order_num=$this->conn->GetOne("select order_num from t_module where idx=".$data["parent_idx"]);
			$data["order_num"]=$order_num?$order_num:$order_num;
			
			$data=$this->_add_creator($data);
            $this->model->InsertData($data);
			$newID=$this->model->GetLastID("idx");
			if(cek_array($data["right"])):
				$this->adodbx->Delete("groups_2_module","module_id=".$newID);
				foreach($data["right"] as $x=>$val):
					$data_update=array();
					$data_update["group_id"]=$x;
					$data_update["module_id"]=$newID;
					$data_update["rights"]=$val;
					$this->adodbx->Insert("groups_2_module",$data_update);
				endforeach;	
			endif;
            
			$ok=$this->conn->CompleteTrans();
           	$this->_proses_message($ok,$this->module."module_list/",$this->module."module_add/");
        endif;
    }
    
    
     function module_edit($id){
        //if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		
        $this->msg_ok="Module updated successfully";
        $this->msg_fail="Unable to update module";
     
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model->GetRecordData("idx=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."module_edit",$data,true);
        endif;
        if($act=="update"):
            $this->conn->StartTrans();
            $data=get_post();
            unset($data["idx"]);
            //$data=array_map("trim",$data);
			$active=isset($data["active"])?$data["active"]:0;
			$data["active"]=$active;
			
			$order_num=$this->conn->GetOne("select order_num from t_module where idx=".$data["parent_idx"]);
			$data["order_num"]=$order_num?$order_num:$order_num;
			
			if(cek_array($data["right"])):
				$this->adodbx->Delete("groups_2_module","module_id=".$id);
				foreach($data["right"] as $x=>$val):
					$data_update=array();
					$data_update["group_id"]=$x;
					$data_update["module_id"]=$id;
					$data_update["rights"]=$val;
					$this->adodbx->Insert("groups_2_module",$data_update);
				endforeach;	
			endif;
			
			$data=$this->_add_editor($data);
           	// $data["category"]=$this->input->post("category");
           	// $data["description"]=$this->input->post("description");
            
			$this->model->UpdateData($data, "idx=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."module_list",$this->module."module_edit/$id");
        endif;
            
    }
    
    function module_delete($id){
        //if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Module deleted successfully";
        $this->msg_fail="Unable to delete group";
        
		$act=$this->input->get_post("act")?$this->input->get_post("act"):"";    
    	if(empty($act)):
            $arrData=$this->model->GetRecordData("idx=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."module_delete",$data,true);
        endif;
        if($act=="delete"):
            
			$this->conn->StartTrans();
            $this->model->DeleteData("idx=$id");
			$this->adodbx->Delete("groups_2_module","module_id=".$id);
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."module_list",$this->module."module_delete/$id");
        endif;
    }
    
    
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
    
	/*
    function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
            $datam["content"]=$view_html;
            $this->load->view("admin_layout/main_layout",$datam);
        endif;
        //if (!$render) return $view_html;
    }
	*/
}
