<?php

class auth_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'cms_users';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
	
	function getUserData($name,$pass) {
		$res=$this->conn->GetRow("select * from ".$this->tbl." where username='".$name."' and passwd='".$pass."'");
		
		return $res;
	}
	function getUserDataById($name) {
		$res = $this->conn->GetRow("select * from ".$this->tbl." where id='".$name."'");
		return $res;
	}
}
