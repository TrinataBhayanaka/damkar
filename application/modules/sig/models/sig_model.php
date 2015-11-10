<?php

class sig_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'cms_lookup';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}
