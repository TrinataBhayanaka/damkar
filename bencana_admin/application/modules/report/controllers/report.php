<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."register/register/";
		$this->http_ref=base_url().$this->module;///brwa_admin/admin/news/
        
    	$this->load->library("utils");
        $this->module_title="User List";
		//$this->load->model("account_manager_model");
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->user_model=$this->user_model;
		$this->admin_layout="admin_lte_layout/main_layout";
		
    }
	
	function _render_page($view, $data=null, $render=false)
	{
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$view_html = $this->load->view($view, $this->viewdata, $render);
		if($render):
			$datam["acc_active"]="account_manager";
			$datam["content"]=$view_html;
			$this->load->view($this->admin_layout,$datam);
		endif;
		//if ($render) return $view_html;
	}
	
	
	function index(){
		
		

		$data_layout["content"]=$this->load->view("report/list",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f022(){
		$data_layout["content"]=$this->load->view("report/r_f022",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f026(){
		$data_layout["content"]=$this->load->view("report/r_f026",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f027(){
		$data_layout["content"]=$this->load->view("report/r_f027",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}

	function report_f028(){
		$data_layout["content"]=$this->load->view("report/r_f028",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f029(){
		$data_layout["content"]=$this->load->view("report/r_f029",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f030(){
		$data_layout["content"]=$this->load->view("report/r_f030",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f031(){
		$data_layout["content"]=$this->load->view("report/r_f031",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f035(){
		$data_layout["content"]=$this->load->view("report/r_f035",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f036(){
		$data_layout["content"]=$this->load->view("report/r_f036",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	}
	function report_f_keberatan(){
		$data_layout["content"]=$this->load->view("report/r_f_keberatan",$data,true);
		$this->load->view($this->admin_layout,$data_layout);
	} 
}