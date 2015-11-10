<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."ctrl/auth";
        $this->http_ref=base_url().$this->module;
        
        $this->load->model("auth_model");
        $this->model=$this->auth_model;
		$this->listText="LAT Control Page";
        
    }
	
	function index() {
		$status=false;
		if (!$_SESSION['s_sid']) {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				if ($this->login()) {
					$status='L1';
				}
			}
			else {
				$status='L0';
			}
		}
		else {
			$status='L2';
		}
		
		$data["status"]=$status;
		$data["user_data"]=$_SESSION;
		$this->load->view("auth/index",$data); 	
	}
	
	function login() {
		if (!$_SESSION['s_sid']) {
			$user_data = $this->model->getUserData($_POST['username'],md5($_POST['password'])) ;
			//print_r($user_data);
			if ($user_data['passwd'] && md5($_POST['password'])==$user_data['passwd']) {
				$this->store_sess($user_data);
				$status = 1;
				//$this->writeLog($user_data,'login','Login Successfull');
			}
			else {
				$status = 2;
				//$this->writeLog($user_data,'login','Failed To Login');
			}
		}
		else {
			$status = 1;
		}	
		
		$data["status"]=$status;
		$this->load->view("auth/login",$data); 	
	}
	
	private function store_sess($user_data) {
		$hash = md5($this->hash . $user_data['id'] . $user_data['passwd']);
		echo $hash;
		$_SESSION['username'] = $user_data['username'];
		$_SESSION['lastlog'] = $user_data['login'];
		
		$_SESSION['login'] = 1;
		$_SESSION['s_regid'] = $user_data['id'];
		$_SESSION['s_time'] = time();
		$_SESSION['s_user'] = $user_data['username'];
		$_SESSION['s_sid'] = $hash;

		return true;
	}
	
	public function logout() {
		$user_data=$this->model->getUserDataById($_SESSION['s_regid']);
		$this->unset_sess($user_data);
		//$this->set('pagetitle','Logged Out');
		$brc[] = array(
        	'href'      => PATH.'login/logout/',
        	'text'      => 'Log Out',//$this->language->get('text_home'),
        	'separator' => '&gt;'
      	); 
		$this->load->view("auth/logout"); 	
		//$this->set('breadcrumbs',$this->_document->breadcrumbs($brc));
	}
	
	private function unset_sess($user_data) {
		//$this->writeLog($user_data,'logout');

		unset($_SESSION['username']);
		unset($_SESSION['level']);
		unset($_SESSION['unit']);
		unset($_SESSION['lastlog']);
		
		unset($_SESSION['login']);
		unset($_SESSION['s_regid']);
		unset($_SESSION['s_time']);
		unset($_SESSION['s_level']);
		unset($_SESSION['s_user']);
		unset($_SESSION['s_sid']);
		unset($_SESSION['user']);
		
	}
}