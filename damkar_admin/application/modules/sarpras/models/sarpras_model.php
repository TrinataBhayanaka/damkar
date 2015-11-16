<?php

class sarpras_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_sarpras';
	public $tbl_view_sarpras= 'view_sarpras';
	public $tbl_view_sarprasgroup= 'view_sarpras_group';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function view_sarpras($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_sarpras,$where,$dataColumn);
    }
    function view_sarpras_group($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_sarprasgroup,$where,$dataColumn);
    }
}
