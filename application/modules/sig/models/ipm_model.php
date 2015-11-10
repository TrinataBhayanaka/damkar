<?php

class ipm_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'v_data_ipm';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
	function getDataYears() {
		$res=$this->conn->GetAll("select distinct(tahun) from ".$this->tbl." order by tahun desc");
		
		return $res;
	}
}
