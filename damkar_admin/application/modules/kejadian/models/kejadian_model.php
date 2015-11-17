<?php

class kejadian_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_kejadian';
	public $tbl_view_kejadian= 'view_kejadian';
	public $tbl_view_kejadiangroup= 'view_kejadian_group';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function cek_data($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl,$where,$dataColumn);
    }

	function view_kejadian($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_kejadian,$where,$dataColumn);
    }
    function view_kejadian_group($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_kejadiangroup,$where,$dataColumn);
    }

}
