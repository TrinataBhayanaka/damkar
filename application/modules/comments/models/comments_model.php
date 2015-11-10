<?php

class comments_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'tb_comments';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
}

