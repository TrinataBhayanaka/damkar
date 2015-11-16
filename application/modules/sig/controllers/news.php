<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."ctrl/news/";
        $this->http_ref=base_url().$this->module;
        
        $this->load->model("news_model");
        $this->model=$this->news_model;
		$this->listText="LAT Control Page / News";
		
		$this->load->library("utils");
        
    }
	
	function index($key=0,$forder=0,$limit=3,$page=1){
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
			$order = 'order by id desc';
		}
		
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model->getTotalRecordWhere($filter);
    	
				
		$base_url = $this->module."index/".$key."/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(3,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString($page, $total_rows, $limit, 1, $base_url, "/");
		
		if (is_array($arrDB)) {
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['date'],0,5);
			}
		}
		$data["arrDB"]=$arrDB;
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		
		$data_layout["content"]=$this->load->view("news/list",$data,true); 
		$this->load->view("layout/main_layout",$data_layout);
	}
	
	function add(){
		//print_r($_FILES);
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$process=true;
			if (is_array($_FILES) && count($_FILES)>0) {
				$dir = FCPATH.$this->config->item('dir_image_news');
				
				$photo = $this->utils->fileUploadHandler($_FILES,$dir,$name_select,false);
				//print_r($photo);
				if (!$photo[0]['error']) {
					$sourceimage = $photo[0]['dir'].$photo[0]['img_name'];
					$thumb = $this->utils->createThumbnail($sourceimage,196,225,"head");
					if($thumb) {
						$this->utils->removePhisycalImage($sourceimage);
						$headline_img = str_replace($dir,"",$thumb);
					}
					//echo $headline_img;
				}
			}
			$_data["date"]=date("Y-m-d",time());
			$_data["title"]=$_POST['title'];
			$_data["clip"]=$_POST['clip'];
			$_data["content"]=$_POST['content'];
			$_data["image"]=$headline_img;
			$_data["status"]=($_POST['status'])?$_POST['status']:0;
			//print_r($_data);
			//exit;
			
			$insert = $this->model->InsertData($_data);
			if ($insert) {
				$data["data"]=$_data;
			}
		}
		else {
			$process=false;
		}
		$data["module"]=$this->module;
		$data["process"]=$process;
		$data_layout["content"]=$this->load->view("news/add",$data,true); 
		$this->load->view("layout/main_layout",$data_layout);
	}
  
  function edit($id=false){
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$process=true;
			if (is_array($_FILES) && count($_FILES)>0) {
				$dir = FCPATH.$this->config->item('dir_image_news');
				
				$photo = $this->utils->fileUploadHandler($_FILES,$dir,$name_select,false);
				//print_r($photo);
				if (!$photo[0]['error']) {
					$sourceimage = $photo[0]['dir'].$photo[0]['img_name'];
					$thumb = $this->utils->createThumbnail($sourceimage,196,225,"head");
					if($thumb) {
						$this->utils->removePhisycalImage($sourceimage);
						$headline_img = str_replace($dir,"",$thumb);
					}
					//echo $headline_img;
				}
			}
			$_data["date"]=date("Y-m-d",time());
			$_data["title"]=$_POST['title'];
			$_data["clip"]=$_POST['clip'];
			$_data["content"]=$_POST['content'];
			if ($headline_img) $_data["image"]=$headline_img;
			$_data["status"]=($_POST['status'])?$_POST['status']:0;
			//print_r($_data);
			//exit;
			
			$update = $this->model->UpdateData($_data,"id='".$_POST['id']."'");
			//echo $update;
			if ($update) {
				$arrDB=$this->model->GetRecordData("id='".$_POST['id']."'");
				//print_r($arrDB);
				$data["data"]=$arrDB;
			}
		}
		else {
			$arrDB=$this->model->GetRecordData("id='{$id}'");
			$data["data"]=$arrDB;
		}
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("news/edit",$data,true); 
		$this->load->view("layout/main_layout",$data_layout);
  }
  
  function delete($id=false){
	//$this->model->DeleteData("idx=".$_POST['id']."");
    //redirect($this->module);
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$delete = $this->model->DeleteData("id='".$_POST['id']."'");
			//echo $update;
			if ($delete) {
				$data["delete"]=true;
				//$arrDB=$this->model->GetRecordData("id='".$_POST['id']."'");
				//print_r($arrDB);
				//$data["data"]=$arrDB;
			}
		}
		else {
			$arrDB=$this->model->GetRecordData("id='{$id}'");
			$data["data"]=$arrDB;
		}
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("news/delete",$data,true); 
		$this->load->view("layout/main_layout",$data_layout);
  }
  
  function add_save(){
      $data=$_POST;
      $this->model->InsertData($data);
      redirect($this->module);
  }
  
  function edit_save(){
      $data=$_POST;
      $idx=$data["idx"];
      unset($data["idx"]);
      $this->model->UpdateData($data,"idx=$idx");
      redirect($this->module);
   }
}