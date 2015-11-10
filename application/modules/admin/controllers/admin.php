<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends Admin_Controller {
	function __construct(){
        parent::__construct();
        $class_folder=basename(dirname(__DIR__));
        $class=__CLASS__;
	    
    	
		$this->class=$class;
		$this->$class_folder=$class_folder;
		$this->load->helper(array('form', 'url','file'));
    	$this->load->library("parser");
		
	    $this->folder=$class_folder."/";
        $this->module=$this->folder.$class."/";
    
	    $this->http_ref=base_url().$this->module;
       
        //$this->load->model("general_model");
        //$this->model=new general_model("tb_batas_propinsi");
		
		$this->main_layout="admin_lte_layout/main_layout";
		
		$this->module_title="Dashboard";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx desc";
		$this->init_layout();
	}
	
	function init_layout($page_title="",$page_title_small="",$bread_crumb=array()){
		$this->main_layout="admin_lte_layout/main_layout";
		$this->bread_layout="admin_lte_layout/bread_crumb_template";
		
		$this->layout_data["page_title"]=$page_title!=""?$page_title:$this->module_title;
		$this->layout_data["page_title_small"]=$page_title_small!=""?$page_title_small:$this->module_title_small;
		
		$data["breadcrumb"]=cek_array($bread_crumb)?$bread_crumb:array(
			array("title"=>"Home",
				  "url"=>base_url()."/admin/",
				  "active"=>"",
				  "icon"=>"<i class='icon-home blue'></i> "
				  )
		);
		$str_bread=$this->parser->parse($this->bread_layout,$data,true);
		
		$this->layout_data["breadcrumb"]=$str_bread;
	}
	
	function index(){
		//$this->data_rkp_peraturan();
		redirect("admin/dashboard");
		//$this->_render_page($this->module."dashboard_index",$data,true);
	}
	
	function data_rkp_peraturan(){
		$sql_rkp="select 'propinsi' as batas_wilayah,1 as sort,tahun_peraturan as tahun,count(idx) as total from tb_batas_propinsi
					group by tahun_peraturan
			  union all
			  select 'kabupaten/kota' as batas_wilayah,2 as sort,tahun_peraturan as tahun,count(idx) as total from tb_batas_kabupaten
					group by tahun_peraturan";
		
		
		$sql_group="select sort,batas_wilayah,group_concat(tahun,':',total order by tahun asc separator ',') as data from (".$sql_rkp.") a 
					group by sort,batas_wilayah order by sort";
		
		//debug();
			$arrData=$this->conn->GetAll($sql_group);
			$data_header[]="tahun";
			foreach($arrData as $x=>$val):
				$data_header[]=$val["batas_wilayah"];	
				$data_tmp_data=$this->parse_data($val["data"]);
				$arrData[$x]["data_per_tahun"]=$data_tmp_data;
			endforeach;
			pre($arrData);
			
			
	}
	
	function parse_data($str,$delim1=",",$delim2=":"){
		$op = array();
		$pairs = explode($delim1, $str);
		foreach ($pairs as $pair) {
			list($k, $v) = array_map("urldecode", explode($delim2, $pair));
			$op[$k] = $v;
		}
		return $op;
	}

}