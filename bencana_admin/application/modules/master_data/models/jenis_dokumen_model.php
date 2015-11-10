<?php

class jenis_dokumen_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        $this->tbl_jenis_dokumen="m_wa_jenis_document";
	}
    
    function category_add($data){
        $ret=$this->adodbx->Insert($this->tbl_jenis_dokumen,$data);
        return $ret;
    }
    
    function category_update($data,$where){
        $ret=$this->adodbx->Update($this->tbl_jenis_dokumen,$data,$where);
        return $ret;
    }
    
    function category_get($where,$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl_jenis_dokumen,$where,$dataColumn);
    }
    
    function category_delete($where){
        return $this->adodbx->Delete($this->tbl_jenis_dokumen,$where);
    }
    
    function category_search_record($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_jenis_dokumen,$data,$sort,$dataColumn);
    }
    
    function category_search_record_where($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_where($this->tbl_jenis_dokumen,$where,$sort,$dataColumn);
    } 
}

