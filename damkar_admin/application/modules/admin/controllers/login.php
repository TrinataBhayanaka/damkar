<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	function __construct(){
        parent::__construct();
        $class_folder=basename(dirname(__DIR__));
        $class=__CLASS__;
	    
    	$this->class=$class;
		$this->view_path=$class."/";
		$this->$class_folder=$class_folder;
		$this->load->helper(array('form', 'url','file'));
    	$this->load->library("parser");
		
	    $this->folder=$class_folder."/";
        $this->module=$this->folder.$class."/";
    
	    $this->http_ref=base_url().$this->module;
        //$this->module_title="Login";
		//$this->tbl_idx="idx";
		//$this->tbl_sort="idx desc";
	}
	
	function index(){
		$this->msg_ok="Login OK";
        $this->msg_fail="Unable to login !!!! Check your username and password!!";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->load->view($this->view_path."login");
        endif;
		if($act=="login"):
			redirect("/");
		endif;
		
	}
	
}