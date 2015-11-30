<?php

class dashboard_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'cms_pages';
	public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	function get_pages_record($where=false,$sort='',$dataColumn=false){
        return $this->adodbx->GetRecord($this->tbl_cat,$where,$dataColumn);
    }

    function jumPersonel(){
    	$sql="select count(id) from dmkr_personel";
					
		$result=$this->conn->GetAll($sql);

		return $result[0]['count(id)'];
    }
    function jumPersonelPns(){
    	$sql="select count(id) from dmkr_personel where statusKerja='PNS'";
					
		$result=$this->conn->GetAll($sql);

		return $result[0]['count(id)'];
    }
    function jumPersonelNonPns(){
    	$sql="select count(id) from dmkr_personel where statusKerja='Non PNS'";
					
		$result=$this->conn->GetAll($sql);

		return $result[0]['count(id)'];
    }
    function jumPersonelSer(){
    	$sql="select count(id) from dmkr_personel where kompetensi<>'8'";
					
		$result=$this->conn->GetAll($sql);

		return $result[0]['count(id)'];
    }
    function jumPersonelNSer(){
    	$sql="select count(id) from dmkr_personel where kompetensi='8'";
					
		$result=$this->conn->GetAll($sql);

		return $result[0]['count(id)'];
    }
}
