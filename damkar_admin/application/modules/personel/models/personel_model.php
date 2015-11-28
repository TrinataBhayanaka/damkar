<?php

class personel_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_personel';
	public $tbl_list_join= 'dmkr_personel as PRS,m_kabupaten_kota as KAB, m_provinsi as PROV, dmkr_m_sektor as SKR,dmkr_m_kompetensi as KMP';
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

    function SearchRecordLimitWhereJoin($where=false,$rows=false,$offset=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_by_limit_where($this->tbl_list_join,$where,$rows,$offset,$sort,$dataColumn);
    }
    function getTotalRecordWhereJoin($where=false,$selected_column='id'){
		if ($where) $where=" where ".$where;
		$sql = "select count($selected_column) as total from ".$this->tbl_list_join.$where;
		return $this->conn->GetOne($sql);	
	}
}
