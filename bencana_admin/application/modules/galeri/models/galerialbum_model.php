<?php

class galerialbum_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'cms_pages';
	public $tbl_list_joint= 'cms_pages';
	//public $tbl_cat= 'cms_pages_category';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
        
	}
	// function get_pages_record($where=false,$sort='',$dataColumn=false){
        // return $this->adodbx->GetRecord($this->tbl_cat,$where,$dataColumn);
    // }
	
	 function selectgalerialbum(){
    	$sql="select idx,title from cms_pages where category ='6'";
		// pre($sql);			
		$result=$this->conn->GetAll($sql);
		// pre($result);
		return $result;
    }
	 function getNameAlbum($id){
    	$sql="select title from cms_pages where idx ='{$id}' AND category='6'";
		// pre($sql);			
		$result=$this->conn->GetAll($sql);
		// pre($result);exit;
		return $result[0]['title'];
    }
}
