<?php

class acl_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	 
	public $tbl= '';

	function __construct(){
		parent::__construct();
		$this->tbl_groups="groups";
        $this->tbl_rights="t_rights";
		$this->tbl_modules="t_module";
		$this->tbl_group_to_modules="groups_2_module";
		
	}
    
    function get_rights(){
        $arrRights=$this->adodbx->search_record($this->tbl_rights);
        return $arrRights;
    }
    
    function get_groups(){
        $arrGroups=$this->adodbx->search_record($this->tbl_groups);
        return $arrGroups;
    }
    
    function get_modules(){
        $find["active"]=1;
        $arrModules=$this->adodbx->search_record($this->tbl_modules,$find);
        return $arrModules;
    }
    
    function get_groups_to_modules(){
        $arrGroup2Modules=$this->adodbx->search_record($this->tbl_group_to_modules);
        return $arrGroup2Modules;
    }
	
}

