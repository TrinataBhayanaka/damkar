<?php

class module_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 't_module';
    function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
    
	
	
}

