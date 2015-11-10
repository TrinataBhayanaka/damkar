<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
    	$this->folder="setting/";
		$this->module=$this->folder."group/";
        $this->http_ref=base_url().$this->module;
		
		$this->lang->load('auth');
		$this->load->helper('language');
        
        $this->load->helper("menu_helper");
        $this->load->helper("bootstrap_helper");
        //$this->load->model("group_model");
        //$this->model=$this->group_model;
		$this->load->model("general_model");
        
		$this->model=new general_model("groups");
		$this->model_user=new general_model("users");
		$this->model_user_group=new general_model("users_groups");
		
		//$this->listText="Ikan";
		$this->acc_active="account_manager";
		
		//komeng added
		$this->my_logged_data = $this->data['users']['user'];	
		$this->auth_error_page="pages/error_page";
		
		
    }
	
	function index(){
		$this->group_list();
	}
	
	function group_list(){
       	if (!$this->cms->has_view($this->module)) redirect ($this->auth_error_page);
	   	//debug();
        $this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="name,description";
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
        $totalRows=$this->model->getTotalRecordWhere($whereSql);
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by id";
        
        $arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
        
        $config['base_url'] = $this->module."group_list";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
        
        
        //$arrData=$this->model->group_search_record_where(false," order by id ");
        //$data["arrData"]=$arrData;
        $this->_render_page($this->module."group_list",$data,true);
    
    }
    
    function group_add(){
        if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Group created successfully";
        $this->msg_fail="Unable to create new Group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->_render_page($this->module."group_add",$data,true);
        endif;
        //debug();
        if($act=="create"):
            $this->conn->StartTrans();
            $data=get_post();
            $data=array_map("trim",$data);
            $data=$this->_add_creator($data);
            //debug();
			$this->model->InsertData($data);
            $ok=$this->conn->CompleteTrans();
           	$this->_proses_message($ok,$this->module."group_list/",$this->module."group_add/");
        endif;
    }
    
    
     function group_edit($id){
       if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		
        $this->msg_ok="Group updated successfully";
        $this->msg_fail="Unable to update group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
			$arrData=$this->model->GetRecordData("id=$id");
			$arrDataUser=$this->conn->GetAll("
						select b.* from ".$this->model_user_group->tbl." a 
						left join ".$this->model_user->tbl." b 
						on a.group_id=b.id where group_id=$id");
			$data["data_user"]=$arrDataUser;			
			$data["data"]=$arrData;
            $this->_render_page($this->module."group_edit",$data,true);
        endif;
        if($act=="update"):
            $this->conn->StartTrans();
            $data=get_post();
            unset($data["idx"]);
            $data=array_map("trim",$data);
            $data=$this->_add_editor($data);
           // $data["category"]=$this->input->post("category");
           // $data["description"]=$this->input->post("description");
            $this->model->UpdateData($data, "id=$id");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."group_list",$this->module."group_edit/$id");
        endif;
            
    }
    
    function group_delete($id){
        if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Group deleted successfully";
        $this->msg_fail="Unable to delete group";
        
		$act=$this->input->get_post("act")?$this->input->get_post("act"):"";    
    	if(empty($act)):
            $arrData=$this->model->GetRecordData("id=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."group_delete",$data,true);
        endif;
        if($act=="delete"):
            $this->conn->StartTrans();
            $this->model->DeleteData("id=$id");
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
    
	
	/*function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
            $datam["content"]=$view_html;
            $this->load->view("admin_layout/main_layout",$datam);
        endif;
        //if (!$render) return $view_html;
    }*/

}
