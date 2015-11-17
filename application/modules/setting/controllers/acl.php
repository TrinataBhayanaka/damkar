<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acl extends Admin_Controller {
	 function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
    	$this->folder="setting/";
		$this->module=$this->folder."acl/";
        $this->http_ref=base_url().$this->module;
		
		$this->load->model("acl_model");
        $this->model=$this->acl_model;
		$this->model=new acl_model();
		$this->acc_active="acl_list";
    
	    $this->msg_ok="Data Saved Successfully!!";
        $this->msg_fail="Unable to save data!!";
    }
    
    function index(){
		$this->acl_list();
    }
	
	function acl_list(){
		//if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);
		$arrRights=$this->adodbx->search_record($this->acl_model->tbl_rights);
		$arrGroups=$this->adodbx->search_record($this->acl_model->tbl_groups);
		$find["active"]=1;
		$arrModules=$this->adodbx->search_record($this->acl_model->tbl_modules,$find," order by order_num,idx");
		$arrGroup2Modules=$this->adodbx->search_record($this->acl_model->tbl_group_to_modules);
		$data["acc_active"]='account_manager';//$this->acc_active; //komeng add
		$data["arrRights"]=$arrRights;
		$data["arrGroups"]=$arrGroups;
		$data["arrModules"]=$arrModules;
		$data["arrGroup2Modules"]=$arrGroup2Modules;
		$this->_render_page($this->module."acl_list",$data,true);
				
	}
	
	/*
	function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
			
			$datam["acc_active"]='account_manager';//komeng fix
            $datam["content"]=$view_html;
            $this->load->view("admin_layout/main_layout",$datam);
        endif;
    }
	*/
	
	function acl_save(){
		$req=get_post();
		foreach($req["rb"] as $gid =>$rights):
			$data_tmp=array();
			$data_group[]=$gid;
			$data_tmp["group_id"]=$gid;
			foreach($rights as $mid=>$val):
				$data_tmp["module_id"]=$mid;
				$data_tmp["rights"]=$val;
				$arrData[]=$data_tmp;
			endforeach;
		endforeach;
		$in_group=join(",",$data_group);
        $this->conn->StartTrans();
        $this->adodbx->Delete($this->model->tbl_group_to_modules," group_id in ($in_group)");
		
        foreach($arrData as $x=>$data):
            $this->adodbx->Insert($this->model->tbl_group_to_modules, $data);
        endforeach;
        $ok=$this->conn->CompleteTrans();
        $this->_proses_message($ok,$this->agent->referrer(),$this->agent->referrer());
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
    
    function test_cms_library(){
        $this->load->library("cms");
		//$this->cms=Cms->factory();
		//$this->cms=new Cms();
		//pre($this->cms);
        //$this->cms=new Cms();
		//$this->cms->init_user();
		//$this->cms=$this->cms->factory();
       // $this->cms->factory();
		pre($this->cms->user_group);
		exit();
        if($this->cms->has_read("admin/dms/")){
            print "anda berhak read";
        }else{
            print "anda tidak berhak membaca";
        }
         
         //pre($cms->get_module_right_max("admin/dms"));
    }


}