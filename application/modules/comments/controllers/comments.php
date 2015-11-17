<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments extends CI_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="comments/";
		$this->module=$this->folder."comments/";
        $this->http_ref=base_url().$this->module;
        
    }
	
	function index(){
		$this->load->view("index");
	}
	
	function test(){
		print "test";
	}
	
	function test2(){
		$this->load->view("test_comment");
	}
	
	
}