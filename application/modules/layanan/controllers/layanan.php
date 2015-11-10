<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class layanan extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."layanan/";
		$this->page_active="layanan/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->model("general_model");
		$this->model=new general_model("cms_layanan");
		
		$this->load->model("user/account_manager_model");
        $this->ammmodel=$this->account_manager_model;
		
		$this->load->library("utils");
    }
	function index($cat='slpp',$forder=0,$limit=20,$page=1){
		//$this->_list($cat,$forder,$limit,$page);
		
		$this->page_active="layanan/index/";
		$data["acc_active"]="content";
		$data["user_name"]=$this->data['users']['user']['username'];
		
		$slpp=$this->_list_x("slpp");
		$data["slpp"]["list"]=$slpp['list'];
		$data["slpp"]["total_rows"]=$slpp['total'];
		
		$ukp3=$this->_list_x("ukp3");
		$data["ukp3"]["list"]=$ukp3['list'];
		$data["ukp3"]["total_rows"]=$ukp3['total'];
		
		$data["module"]=$this->module;
		
		$data["list"]=$arrDB;
        $data_layout["content"]=$this->load->view("index",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
	
	function _list($cat,$forder,$limit,$page){ 
		switch($cat) {
			case 'slpp':
				$catid = '1013';
				$data["layanan_title"]="SLPP";
				$data["layanan_area"]="simpul";
				$data["layanan_desc"]="Simpul Layanan Pemetaan Partisipatif (SLPP)";
				$data["layanan_what"]="Simpul layanan pemetaan partisipatif (SLPP)dibentuk untuk memberikan layanan pemetaan partisipatif yang lebih cepat, lebih dekat dan lebih murah. Beberapa masalah yang menyebabkan layanan pemetaan tidak bisa dilakukan sesuai dengan harapan masyarakat yang membutuhkan, diantaranyatidak tersedianya fasilitator, tidak adanya peralatan dan masalah non teknis lainnya. Akibatnya masyarakat yang membutuhkan layanan mendesak tidak dapat terlayani. Sementara itu kasus keruangan semakin banyak, mulai dari tingkat ancaman sampai dengan pada tahap perampasan terhadap hak-hak masyarakat. Dari pengalaman selama ini, salah satu hal penting dalam proses advokasi dan penyelesaian konflik adalah pemetaan partisipatif untuk mempertegas hak-hak masyarakat atas tanah dan memperjelas area konflik.";
				break;
			case 'ukp3':
				$catid = '1014';
				$data["layanan_title"]="UKP3";
				$data["layanan_area"]="wilayah";
				$data["layanan_desc"]="Unit Kerja Pemetaan Partisipatif (UKP3)";
				$data["layanan_what"]="";
				break;
			default:
				$catid = ' and (category=1013 or category=1014)';
				$data["layanan_title"]="SLPP";
				$data["layanan_area"]="simpul";
				$data["layanan_desc"]="Simpul Layanan Pemetaan Partisipatif (SLPP)";
				$data["layanan_what"]="Simpul layanan pemetaan partisipatif (SLPP)dibentuk untuk memberikan layanan pemetaan partisipatif yang lebih cepat, lebih dekat dan lebih murah. Beberapa masalah yang menyebabkan layanan pemetaan tidak bisa dilakukan sesuai dengan harapan masyarakat yang membutuhkan, diantaranyatidak tersedianya fasilitator, tidak adanya peralatan dan masalah non teknis lainnya. Akibatnya masyarakat yang membutuhkan layanan mendesak tidak dapat terlayani. Sementara itu kasus keruangan semakin banyak, mulai dari tingkat ancaman sampai dengan pada tahap perampasan terhadap hak-hak masyarakat. Dari pengalaman selama ini, salah satu hal penting dalam proses advokasi dan penyelesaian konflik adalah pemetaan partisipatif untuk mempertegas hak-hak masyarakat atas tanah dan memperjelas area konflik.";
				break;
		}
		$filter="status=1 and (category=".$catid.")";
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
		$base_url = $this->module."index/".$cat."/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(3,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		
		$this->page_active="layanan/index/".$cat;
		$data["acc_active"]="content";
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		
		$data["list"]=$arrDB;
        $data_layout["content"]=$this->load->view("index",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
	
	function _list_x($cat='slpp'){ 
		switch($cat) {
			case 'slpp':
				$catid = '1013';
				$data["layanan_title"]="SLPP";
				$data["layanan_area"]="simpul";
				$data["layanan_desc"]="Simpul Layanan Pemetaan Partisipatif (SLPP)";
				$data["layanan_what"]="Simpul layanan pemetaan partisipatif (SLPP)dibentuk untuk memberikan layanan pemetaan partisipatif yang lebih cepat, lebih dekat dan lebih murah. Beberapa masalah yang menyebabkan layanan pemetaan tidak bisa dilakukan sesuai dengan harapan masyarakat yang membutuhkan, diantaranyatidak tersedianya fasilitator, tidak adanya peralatan dan masalah non teknis lainnya. Akibatnya masyarakat yang membutuhkan layanan mendesak tidak dapat terlayani. Sementara itu kasus keruangan semakin banyak, mulai dari tingkat ancaman sampai dengan pada tahap perampasan terhadap hak-hak masyarakat. Dari pengalaman selama ini, salah satu hal penting dalam proses advokasi dan penyelesaian konflik adalah pemetaan partisipatif untuk mempertegas hak-hak masyarakat atas tanah dan memperjelas area konflik.";
				break;
			case 'ukp3':
				$catid = '1014';
				$data["layanan_title"]="UKP3";
				$data["layanan_area"]="wilayah";
				$data["layanan_desc"]="Unit Kerja Pemetaan Partisipatif (UKP3)";
				$data["layanan_what"]="";
				break;
			default:
				$catid = ' and (category=1013 or category=1014)';
				$data["layanan_title"]="SLPP";
				$data["layanan_area"]="simpul";
				$data["layanan_desc"]="Simpul Layanan Pemetaan Partisipatif (SLPP)";
				$data["layanan_what"]="Simpul layanan pemetaan partisipatif (SLPP)dibentuk untuk memberikan layanan pemetaan partisipatif yang lebih cepat, lebih dekat dan lebih murah. Beberapa masalah yang menyebabkan layanan pemetaan tidak bisa dilakukan sesuai dengan harapan masyarakat yang membutuhkan, diantaranyatidak tersedianya fasilitator, tidak adanya peralatan dan masalah non teknis lainnya. Akibatnya masyarakat yang membutuhkan layanan mendesak tidak dapat terlayani. Sementara itu kasus keruangan semakin banyak, mulai dari tingkat ancaman sampai dengan pada tahap perampasan terhadap hak-hak masyarakat. Dari pengalaman selama ini, salah satu hal penting dalam proses advokasi dan penyelesaian konflik adalah pemetaan partisipatif untuk mempertegas hak-hak masyarakat atas tanah dan memperjelas area konflik.";
				break;
		}
		$filter="status=1 and (category=".$catid.")";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
			$data["key"]=$key;
		}
		
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
		$arrDB=$this->model->SearchRecordWhere($filter,$order);
		$total_rows=$this->model->getTotalRecordWhere($filter);
    	
		$data["list"]=$arrDB;
		$data["total"]=$total_rows;
		return $data;
	}
}