<?php

class user_model extends LAT_Model{
	/**
	 * Set Table Name Here
	 */
	public $tbl= 'users';
	public $tbl_m_tanda_pengenal= 'm_tanda_pengenal';
	public $tbl_m_propinsi= 'm_propinsi';
	public $tbl_m_kabupaten_kota= 'm_kabupaten_kota';
	public $tbl_m_pekerjaan= 'm_pekerjaan';
	public $tbl_m_skpd= 'dmkr_m_skpd';
	public $tbl_m_cat_sarpras= 'dmkr_m_cat_sarpras';
    public $tbl_m_sektor= 'dmkr_m_sektor';
    public $tbl_m_kompetensi= 'dmkr_m_kompetensi';
	public $tbl_m_catKebakaran= 'dmkr_m_cat_kebakaran';

	function __construct(){
		parent::__construct();
		$this->db=$this->conn;
	}
	function m_tanda_pengenal($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_m_tanda_pengenal,$data,$sort,$dataColumn);
    }
	function m_propinsi($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_m_propinsi,$data,$sort,$dataColumn);
    }
	function m_pekerjaan($data=false,$sort='',$dataColumn=false){
        return $this->adodbx->search_record($this->tbl_m_pekerjaan,$data,$sort,$dataColumn);
    }
    function m_provinsi($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record_where($this->tbl_m_kabupaten_kota,$data,$dataColumn); 
    }
    function m_kabupaten($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record_where($this->tbl_m_kabupaten_kota,$data,$dataColumn); 
    }

    function m_skpd($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record($this->tbl_m_skpd,$data,$dataColumn); 
    }
    function m_cat_sarpras($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record($this->tbl_m_cat_sarpras,$data,$dataColumn); 
    }
    function m_cat_sarprasid($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record_where($this->tbl_m_cat_sarpras,$data,$dataColumn); 
    }
     function m_sektor($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record_where($this->tbl_m_sektor,$data,$dataColumn); 
    }
     function m_kompetensiid($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record_where($this->tbl_m_kompetensi,$data,$dataColumn); 
    }
    function m_kompetensi($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record($this->tbl_m_kompetensi,$data,$dataColumn); 
    }
    function m_kebakaran($data=false,$sort='',$dataColumn=false){        
        return $this->adodbx->search_record($this->tbl_m_catKebakaran,$data,$dataColumn); 
    }
}

