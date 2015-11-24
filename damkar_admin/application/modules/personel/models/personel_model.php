<?php

class personel_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_personel';
	//public $tbl_cat= 'cms_pages_category';
	public $tbl_view_personel= 'view_personel';
	public $tbl_view_personelgroup= 'view_personel_group';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	// function get_pages_record($where=false,$sort='',$dataColumn=false){
        // return $this->adodbx->GetRecord($this->tbl_cat,$where,$dataColumn);
    // }


	function view_personel($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_personel,$where,$dataColumn);
    }
    function view_personel_group($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_personelgroup,$where,$dataColumn);
    }
}
