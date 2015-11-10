<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class error_ extends Admin_Controller {
	function __construct(){
        parent::__construct();       
      
	}
	 
	 function index(){
	 	$this->listview();
		//$this->_render_page($this->module."registrasi_list",$data,true);
		//$this->load->view('error_');
	 }

	 function listview(){
		$this->_render_page("error_",$data,true);
    }
	
}