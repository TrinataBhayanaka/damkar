<?php

class master_wilayah_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'master_wilayah';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}
