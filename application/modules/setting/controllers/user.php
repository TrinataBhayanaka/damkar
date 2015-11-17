<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
    	$this->folder="setting/";
		$this->module=$this->folder."user/";
        $this->http_ref=base_url().$this->module;
		
		$this->lang->load('auth');
		$this->load->helper('language');
        
        $this->load->helper("menu_helper");
        $this->load->helper("bootstrap_helper");
        $this->load->model("user_model");
        $this->model=$this->user_model;
		//$this->listText="Ikan";
		$this->acc_active="account_manager";
		
		//komeng added
		$this->my_logged_data = $this->data['users']['user'];	
		
		$this->main_layout="admin_lte_layout/main_layout";
		
		$this->auth_error_page="admin/error_page";
		
    }
	
	function index(){
		$this->user_list();
	}
	
	function user_list(){
       if (!$this->cms->has_view($this->module)) redirect ($this->auth_error_page);
	   	$this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="first_name,last_name,username";
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
        $sortBy=" order by id";
        
        $arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
        
        $config['base_url'] = $this->module."user_list";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
		if(cek_array($arrData)):
				foreach($arrData as $x=>$val):
					$arrData[$x]["groups"]=$this->conn->GetAll("select a.*,b.name from users_groups a left join groups b on a.group_id=b.id where user_id=".$val["id"]);
				endforeach;
		endif;
		
		$data["arrData"]=$arrData;
        
        
        //$arrData=$this->model->group_search_record_where(false," order by id ");
        //$data["arrData"]=$arrData;
        $this->_render_page($this->module."user_list2",$data,true);
    
    }
    
    function user_add(){
        if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Group created successfully";
        $this->msg_fail="Unable to create new Group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->_render_page($this->module."user_add2",$data,true);
        endif;
        //debug();
        if($act=="create"):
            $this->conn->StartTrans();
            $data=get_post();
            //$data=array_map("trim",$data);
            $data=$this->_add_creator($data);
            $this->model->InsertData($data);
			$idLast=$this->model->GetLastID("id");
			
			$arrData=$this->model->GetRecordData("id=$idLast");
			
			$this->adodbx->Delete("users_groups","user_id=$idLast");
			if(cek_array($data["groups"])):
				foreach($data["groups"] as $x=>$val):
					$groupID=$val;
					$dataUpdate["user_id"]=$idLast;
					$dataUpdate["group_id"]=$groupID;
            		$this->adodbx->Insert("users_groups",$dataUpdate);
				endforeach;
			endif;
			
            $ok=$this->conn->CompleteTrans();
           
            $this->_proses_message($ok,$this->module."user_list/",$this->module."user_add/");
        endif;
    }
    
    
     function user_edit($id){
        if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		
        $this->msg_ok="Group updated successfully";
        $this->msg_fail="Unable to update group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model->GetRecordData("id=$id");
           	$data["data"]=$arrData;
			 $this->_render_page($this->module."user_edit2",$data,true);
        endif;
        if($act=="update"):
            $this->conn->StartTrans();
            $data=get_post();
			
			unset($data["idx"]);
            //$data=array_map("trim",$data);
            $data=$this->_add_editor($data);
            //$data["category"]=$this->input->post("category");
            //$data["description"]=$this->input->post("description");
            if(trim($data["password"])==""):
				unset($data["password"]);
			endif;
			
			$this->model->UpdateData($data, "id=$id");
			
			$this->adodbx->Delete("users_groups","user_id=$id");
			if(cek_array($data["groups"])):
				foreach($data["groups"] as $x=>$val):
					$groupID=$val;
					$dataUpdate["user_id"]=$id;
					$dataUpdate["group_id"]=$groupID;
            		$this->adodbx->Insert("users_groups",$dataUpdate);
				endforeach;
			endif;
			$ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."user_list",$this->module."user_edit/$id");
        endif;
            
    }
    
    function group_delete($id){
        if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Group deleted successfully";
        $this->msg_fail="Unable to delete group";
        
		$act=$this->input->get_post("act")?$this->input->get_post("act"):"";    
    	if(empty($act)):
            $arrData=$this->model->group_get("id=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."group_delete",$data,true);
        endif;
        if($act=="delete"):
            $this->conn->StartTrans();
            $this->model->group_delete("id=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."group_list",$this->module."group_delete/$id");
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
	
	function activate($id){
		$this->msg_ok="Activate successfully";
        $this->msg_fail="Unable to activate user";
		
		$dataUpdate["active"]=1;
		$this->conn->StartTrans();
		$this->model->UpdateData($dataUpdate,"id=$id");
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."user_list",$this->module."user_list");
	}
	
	function deactivate($id){
		$this->msg_ok="Deactivate successfully";
        $this->msg_fail="Unable to deactivate user";
		
		$dataUpdate["active"]=0;
		$this->conn->StartTrans();
		$this->model->UpdateData($dataUpdate,"id=$id");
		$ok=$this->conn->CompleteTrans();
		$this->_proses_message($ok,$this->module."user_list",$this->module."user_list");
	}
	
	
	function user_delete($id){
        if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="User deleted successfully";
        $this->msg_fail="Unable to delete group";
        
		//$act=$this->input->get_post("act")?$this->input->get_post("act"):"";    
    	$act="delete";
		if(empty($act)):
            $arrData=$this->model->GetRecordData("id=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."user_delete2",$data,true);
        endif;
        if($act=="delete"):
            $this->conn->StartTrans();
            $this->adodbx->Delete("users_groups","user_id=$id");
			$this->model->DeleteData("id=$id");
			$ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."user_list",$this->module."user_list");
        endif;
    }

}
