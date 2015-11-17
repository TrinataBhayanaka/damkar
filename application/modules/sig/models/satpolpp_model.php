<?php

class satpolpp_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'm_kategori';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}
