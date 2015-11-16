<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends Admin_Controller {

	function __construct(){
        parent::__construct();
        
        $this->folder="admin/";
		$this->module=$this->folder."admin/";
        $this->http_ref=base_url().$this->module;
		
        $this->admin_layout="admin_layout/main_layout";
    }
	
	function index(){
		redirect("admin/stats");
    }
	
	function login(){
		redirect ("admin/auth/login","refresh");
	}
	
	function logout(){
		redirect ("admin/auth/logout","refresh");
	}
	
	function error_page($code='401',$text='Unauthorized') {
		$data['error_code'] = $code;
		$data['error_text'] = $text;
		$this->load->view($this->module."/error",$data);
	}
	
}