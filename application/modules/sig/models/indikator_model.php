<?php

class indikator_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'kategori';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}
