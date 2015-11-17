<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articles extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."articles/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->model("user/pg_model");
        $this->model=$this->pg_model;
		
		$this->load->model("user/account_manager_model");
        $this->ammmodel=$this->account_manager_model;
		
		$this->load->library("utils");
    }
	function read($idx=false){
		$this->news_read($idx);
	}
	
	function news_read($idx=false){
		$arrDB=$this->model->GetRecordData("idx='{$idx}'");
		$arrDB['news_content']=$this->utils->closetags($arrDB['content']);
		
		$img_dir = $this->config->item("dir_pages_image");
		if (!file_exists($img_dir.$arrDB['image']) || !$arrDB['image']) $arrDB['image'] = "blank.png";
		$arrDB['date_formatted']=$this->utils->dateToString($arrDB['created'],0,5);
		$arrDB['news_clip2']=substr($arrDB['clip'],0,100)."...";
		
		$this->breadcrumb=array("Beranda"=>"","Artikel"=>"articles/","Baca"=>"#");
		$userDB=$this->ammmodel->GetRecordData("username='".$arrDB['author']."'");
		$arrDB['author']=$userDB['first_name'];
		
		$data["data"]=$arrDB;
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("read",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
  }
	function index($forder=0,$limit=10,$page=1){
		$this->news_list($forder,$limit,$page);
	}
	
	function news_list($forder,$limit,$page){
		$filter="status=1 and (category=1)";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
			$data["key"]=$key;
		}
		$offset 		= ($page-1)*$limit;
		$data_start 	= $offset+1;
		$data_end 		= $offset+$limit;
		
		if ($forder) {
			$spl = preg_split("/:/",$forder);
			$order = 'order by '.$spl[0].' '.$spl[1];
			$data["forder"]=$spl[0];
			$data["dorder"]=$spl[1];
		}
		else {
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model->getTotalRecordWhere($filter);
    	
		$query_url = ($key)?"?q=".$key:"";
		$base_url = $this->module."index/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(3,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				if (!file_exists($img_dir.$v['image'])) $arrDB[$k]['image'] = "blank.png";
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
			}
		}
		$data["acc_active"]="content";
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		
		$data["news_list"]=$arrDB;
        $data_layout["content"]=$this->load->view("index",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
}