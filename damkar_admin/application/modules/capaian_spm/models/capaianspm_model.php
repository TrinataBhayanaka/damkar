<?php

class capaianspm_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_spm';
	public $tbl_view_capaian= 'view_capaian';
	//public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function view_capaian($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_capaian,$where,$dataColumn);
    }
}
