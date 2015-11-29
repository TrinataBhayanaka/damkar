<?php

class sarpras_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_sarpras';
	public $tbl_list_join= 'dmkr_sarpras as SRP,m_kabupaten_kota as KAB, m_provinsi as PROV, dmkr_m_sektor as SKR,dmkr_m_cat_sarpras as CSRP';
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
     function SearchRecordLimitWhereJoin($where=false,$rows=false,$offset=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_by_limit_where($this->tbl_list_join,$where,$rows,$offset,$sort,$dataColumn);
    }
    function getTotalRecordWhereJoin($where=false,$selected_column='id'){
		if ($where) $where=" where ".$where;
		$sql = "select count($selected_column) as total from ".$this->tbl_list_join.$where;
		return $this->conn->GetOne($sql);	
	}
}
