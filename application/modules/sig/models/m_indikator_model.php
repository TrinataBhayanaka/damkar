<?php

class m_indikator_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'm_indikator';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}
