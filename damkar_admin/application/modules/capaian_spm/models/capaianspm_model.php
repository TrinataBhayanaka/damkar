<?php

class capaianspm_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'dmkr_spm';
	public $tbl_list_join= 'dmkr_spm as SPM,m_kabupaten_kota as KAB, m_provinsi as PROV';
	public $tbl_view_capaian= 'view_capaian';
	//public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function view_capaian($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_view_capaian,$where,$dataColumn);
    }

    function SearchRecordLimitWhereJoin($where=false,$rows=false,$offset=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_by_limit_where($this->tbl_list_join,$where,$rows,$offset,$sort,$dataColumn);
    }
}
