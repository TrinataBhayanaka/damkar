<?php

class menu_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 't_menu';
	public $tbl_category="t_menu_category";
	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
	
	function DeleteCategory($id){
		debug();
		$this->DeleteData("id_menu_category=$id");
		$this->adodbx->Delete($this->tbl_category,"id_menu_category=$id");
	}
	
}