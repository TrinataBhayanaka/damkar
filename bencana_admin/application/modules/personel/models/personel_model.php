<?php

class personel_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'bencana_personel';
	//public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	// function get_pages_record($where=false,$sort='',$dataColumn=false){
        // return $this->adodbx->GetRecord($this->tbl_cat,$where,$dataColumn);
    // }
}
