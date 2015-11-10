<?php

class kejadian_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_kejadian';
	//public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function cek_data($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl,$where,$dataColumn);
    }
}
