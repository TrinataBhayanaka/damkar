<?php

class user_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'users';
    function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
    
	
	
}

