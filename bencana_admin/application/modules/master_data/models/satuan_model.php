<?php

class satuan_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        $this->tbl_satuan="m_wa_satuan";
	}
    
    function category_add($data){
        $ret=$this->adodbx->Insert($this->tbl_satuan,$data);
        return $ret;
    }
    
    function category_update($data,$where){
        $ret=$this->adodbx->Update($this->tbl_satuan,$data,$where);
        return $ret;
    }
    
    function category_get($where,$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl_satuan,$where,$dataColumn);
    }
    
    function category_delete($where){
        return $this->adodbx->Delete($this->tbl_satuan,$where);
    }
    
    function category_search_record($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_satuan,$data,$sort,$dataColumn);
    }
    
    function category_search_record_where($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record_where($this->tbl_satuan,$where,$sort,$dataColumn);
    } 
}

