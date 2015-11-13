<?php

class kondisi_fisik_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        $this->tbl_kondisi_fisik="m_wa_kondisi_fisik";
	}
    
    function category_add($data){
        $ret=$this->adodbx->Insert($this->tbl_kondisi_fisik,$data);
        return $ret;
    }
    
    function category_update($data,$where){
        $ret=$this->adodbx->Update($this->tbl_kondisi_fisik,$data,$where);
        return $ret;
    }
    
    function category_get($where,$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl_kondisi_fisik,$where,$dataColumn);
    }
    
    function category_delete($where){
        return $this->adodbx->Delete($this->tbl_kondisi_fisik,$where);
    }
    
    function category_search_record($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_kondisi_fisik,$data,$sort,$dataColumn);
    }
    
    function category_search_record_where($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_where($this->tbl_kondisi_fisik,$where,$sort,$dataColumn);
    } 
}

