<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pp extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."pp/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->model("user/pp_model");
        $this->load->helper(array('form', 'url','file'));
        $this->model=$this->pp_model;
		$this->model=new pp_model();
		//$this->load->library("utils");
    }
	
	function index(){
		//$this->load->view($this->module."index");
		//$this->link_list();
		redirect($this->module."pp_list");
		//$this->link_list();
	}
    
    function cat($str){
        $cat=$this->conn->GetOne("select * from ".$this->model->tbl_link_category." where lower(category) like '%".strtolower($str)."%'");
        redirect($this->module."pp_list?cat_id=$cat");
    }
	
	
	
    function pp_list(){
		
        $cat_idx=$this->input->get_post("cat_id");
        $arrLinkIndex[]="Category";    
        if($cat_idx):
            $where[]="category=$cat_idx";
            $arrLinkIndex[]=$this->conn->GetOne("select category from ".$this->model->tbl_link_category." where idx=$cat_idx");
        else:
            $arrLinkIndex[]="All";
        endif;
        
        $this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="no_pp,about,description";
        if($this->input->get_post("q")):
            $whereSqlx=get_where_from_searchbox($field);
            $where[]="($whereSqlx)";
        endif;
        
        $whereSql="";
        if(cek_array($where)):
            $whereSql.=join(" and ",$where);
        endif;
     
        $sql=" select a.*,b.category as category_name,c.realname,c.path from ".$this->model->tbl." a 
                left join ".$this->model->tbl_link_category." b on a.category=b.idx
                left join cms_pp_file c on a.idx=c.id_pp 
               
        ";
		$table="($sql) a";
		 //left join ".$this->model->tbl_link_count." c on a.idx=c.id_link
        
        //$arrData=$this->model->SearchRecordWhere(false," order by category,name");
        $perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"10";
        $data["perPage"]=$perPage;
       
        $uriSegment=3;
        
       
        $totalRows=count($this->adodbx->search_record_where($table,$whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by idx";
        
        $arrData=$this->adodbx->search_record_by_limit_where($table,$whereSql,$perPage,$offset,$sortBy);
        $config['base_url'] = $this->module."pp_list/";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        $config['num_links'] = 2;
        
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
        $data["arrLinkIndex"]=$arrLinkIndex;
        $data["category_list"]=$this->category_list(false);
        $this->_render_page("content_list",$data,true);
        
    }
    
	function category_list($render=TRUE){
		$dataCategory=$this->model->category_list_count();
        $data["arrCategory"]=$dataCategory["arrData"];
        $data["total"]=$dataCategory["total"];
		if($render):
        	$this->_render_page("category_list",$data,true);
		else:
			return $this->load->view("category_list",$data,true);
		endif;
	}
    
    function get_link($idx){
        $sql=" select a.*,b.category as category_name,c.realname,c.path from ".$this->model->tbl." a 
                left join ".$this->model->tbl_link_category." b on a.category=b.idx
                left join cms_pp_file c on a.idx=c.id_pp 
               
        ";
        $table="($sql) a";
        
        $row=$this->adodbx->GetRecord($table,"idx=$idx");
       
        $id_link=$row["idx"];
        $this->model->click_count($id_link);
        redirect($row["path"].$row["realname"]);
    }
    
    function click_count($idx){
        $ok=$this->model->click_count($idx);
        if($ok):
            print "ok";
        else:
            print "failed";
        endif;
    }
    
    
    function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
            $datam["content"]=$view_html;
            $this->load->view("layout/main_layout",$datam);
        endif;
        //if (!$render) return $view_html;
    }
    
    
    function _prepare_ip($ip_address) {
        if ($this->db->platform() === 'postgre' || $this->db->platform() === 'sqlsrv' || $this->db->platform() === 'mssql')
        {
            return $ip_address;
        }
        else
        {
            return inet_pton($ip_address);
        }
    }
    
    /*
    function test_by_category(){
        debug();
       pre( $this->model->search_by_category(4));
        
    }
	*/
}