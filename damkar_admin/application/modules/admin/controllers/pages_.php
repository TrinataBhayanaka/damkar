<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages_ extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."admin/pages_/";
		$this->http_ref=base_url().$this->module;///brwa_admin/admin/pages_/
    
        $this->load->model("pgs_model");
        $this->model=$this->pgs_model;
		$this->listText="CMS SLPP";
		$this->load->library("utils");
        $this->module_title="SLPP";
        $this->module_title2="UKP3";
		$this->load->model("account_manager_model");
        $this->ammmodel=$this->account_manager_model;
		$this->admin_layout="admin_lte_layout/main_layout";
	
    }
   		function index($forder=0,$limit=5,$page=1){
		//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
   		
		$filter="category=1013";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "category=1013 AND simpul like '%".$key."%'";
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
	
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		// pre($whereSql);exit;
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model->getTotalRecordWhere($filter);
    	
		$query_url = ($key)?"?q=".$key:"";
		$base_url = $this->module."index/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(5,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		
		if (is_array($arrDB)) {
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
				$arrDB[$k]['date_formatted_2']=$this->utils->dateToString($v['tanggal'],0,5);
				$arrDB[$k]['z']=substr($v['z'],0,100)."...";
				$arrDB[$k]['x']=substr($v['x'],0,100)."...";
			}
		}
		$data["acc_active"]="content";
		$data["arrDB"]=$arrDB;
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		
		$data_layout["content"]=$this->load->view("pages_/list_view",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
	function add(){
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");

		$data["module"]=$this->module;
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		
			$data["process"]=true;
			$_data["created"]=date("Y-m-d h:i:s",time());
			$_data["tanggal"]=$_POST['date'];
			$_data["category"]=1013;
			$_data["simpul"]=$_POST['simpul'];
			$_data["nama"]=$_POST['nama'];
			$_data["kontak_fasilitator"]=$_POST['kontak_fasilitator'];
			$_data["kontak_fasilitator_2"]=$_POST['kontak_fasilitator_2'];
			$_data["alamat_brwa"]=$_POST['alamat_brwa'];
			
			$_data["status"]=($_POST['status'])?$_POST['status']:0;
			$_data["author"]=$_POST['author'];
			
			$insert = $this->model->InsertData($_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Data Added Succesfully.");
				redirect("admin/pages_/");
			}
		}
		else{
			$data["process"]=false;
		}
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["acc_active"]="content";
		$data["process"]=$process;
		
		$data_layout["content"]=$this->load->view("pages_/add",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
  
  function edit($idx=false){
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$process=true;
			$_data["created"]=date("Y-m-d h:i:s",time());
			$_data["tanggal"]=$_POST['date'];
			$_data["category"]=1013;
			$_data["simpul"]=$_POST['simpul'];
			$_data["nama"]=$_POST['nama'];
			$_data["kontak_fasilitator"]=$_POST['kontak_fasilitator'];
			$_data["kontak_fasilitator_2"]=$_POST['kontak_fasilitator_2'];
			$_data["alamat_brwa"]=$_POST['alamat_brwa'];
			
			$_data["status"]=($_POST['status'])?$_POST['status']:0;
			$_data["author"]=$_POST['author'];
			
			$update = $this->model->UpdateData($_data,"idx='".$_POST['idx']."'");
			if ($update) {
				$data["edited"]=true;
				$arrDB=$this->model->GetRecordData("idx='".$_POST['idx']."'");
				$data["data"]=$arrDB;
				set_message("success","Data Edited.");
				redirect("admin/pages_");
			}
		}
		else {
			$arrDB=$this->model->GetRecordData("idx='{$idx}'");
			$arrDB['news_content']=$this->utils->closetags($arrDB['news_content']);
			$data["data"]=$arrDB;
		}
		
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["acc_active"]="content";
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("pages_/edit",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
  }
  
  function delete($idx=false){
  		//if (!$this->cms->has_admin($this->module)) redirect ("admin/error");
		//if ($_SERVER['REQUEST_METHOD']=='POST') {
		$delete = $this->model->DeleteData("idx=$idx");		  
		//echo $update;
		if ($delete) {
			$data["delete"]=true;
			//set_message("error","News Deleted.");
			redirect("admin/pages_/");
		}
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

//category
   function UKP3($forder=0,$limit=5,$page=1){
   	//if (!$this->cms->has_view($this->module)) redirect ("admin/error");
   
   	$filter="category=1014";
   	$key = ($_GET['q'])?$_GET['q']:0;
   	if ($key) {
   		$filter = "category=1014 AND wilayah like '%".$key."%'";
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
   	$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
   	$total_rows=$this->model->getTotalRecordWhere($filter);
   	 
   	$query_url = ($key)?"?q=".$key:"";
   	$base_url = $this->module."index/".$forder."/".$limit;
   	$perpage = $this->utils->getPerPage($limit,array(5,15,20,25,30,40,50));
   	$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
   
   	if (is_array($arrDB)) {
   		foreach($arrDB as $k=>$v) {
   			$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
   			$arrDB[$k]['simpul']=substr($v['simpul'],0,100)."...";
   			$arrDB[$k]['nama']=substr($v['nama'],0,100)."...";
   		}
   	}
   	$data["acc_active"]="content";
   	$data["arrDB"]=$arrDB;
   	$data["user_name"]=$this->data['users']['user']['username'];
   	$data["total_rows"]=$total_rows;
   	$data["data_start"]=$data_start;
   	$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows;
   	$data["perpage"]=$perpage;
   	$data["paging"]=$paging;
   	$data["module"]=$this->module;
   
   	$data_layout["content"]=$this->load->view("pages_/list_view_UKP3",$data,true);
   	$this->load->view($this->admin_layout,$data_layout);
   }
   
   function add_ukp3(){
   	//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
   
   	$data["module"]=$this->module;
   	if ($_SERVER['REQUEST_METHOD']=='POST') {
   
   		$data["process"]=true;
   		$_data["created"]=date("Y-m-d h:i:s",time());
   		$_data["category"]=1014;
   		$_data["wilayah"]=$_POST['wilayah'];
   		$_data["nama"]=$_POST['nama'];
   		$_data["kontak_fasilitator"]=$_POST['kontak_fasilitator'];
   			
   		$_data["status"]=($_POST['status'])?$_POST['status']:0;
   		$_data["author"]=$_POST['author'];
   		$insert = $this->model->InsertData($_data);
   		if ($insert) {
   			$data["redirect"]=true;
   			set_message("success","Data Added Succesfully.");
   			redirect("admin/pages_/UKP3");
   		}
   	}
   	else{
   		$data["process"]=false;
   	}
   	$data["user_name"]=$this->data['users']['user']['username'];
   	$data["acc_active"]="content";
   	$data["process"]=$process;
   
   	$data_layout["content"]=$this->load->view("pages_/add_ukp3",$data,true);
   	$this->load->view($this->admin_layout,$data_layout);
   }
    

   function edit_ukp3($idx=false){
   	//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
   	if ($_SERVER['REQUEST_METHOD']=='POST') {
   		$process=true;
   		$_data["created"]=($_POST['news_date'])?$_POST['news_date']:date("Y-m-d",time());
   		$_data["category"]=1014;
   		$_data["wilayah"]=$_POST['wilayah'];
   		$_data["nama"]=$_POST['nama'];
   		$_data["kontak_fasilitator"]=$_POST['kontak_fasilitator'];
   		$_data["status"]=($_POST['status'])?$_POST['status']:0;
   		$_data["author"]=$_POST['author'];
   			
   		$update = $this->model->UpdateData($_data,"idx='".$_POST['idx']."'");
   		if ($update) {
   			$data["edited"]=true;
   			$arrDB=$this->model->GetRecordData("idx='".$_POST['idx']."'");
   			$data["data"]=$arrDB;
   			set_message("success","Data Edited.");
   			redirect("admin/pages_/UKP3");
   		}
   	}
   	else {
   		$arrDB=$this->model->GetRecordData("idx='{$idx}'");
   		$arrDB['news_content']=$this->utils->closetags($arrDB['news_content']);
   		$data["data"]=$arrDB;
   	}
   
   	$data["user_name"]=$this->data['users']['user']['username'];
   	$data["acc_active"]="content";
   	$data["module"]=$this->module;
   	$data_layout["content"]=$this->load->view("pages_/edit_ukp3",$data,true);
   	$this->load->view($this->admin_layout,$data_layout);
   }
   
   function delete_ukp3($idx=false){
   	//if (!$this->cms->has_admin($this->module)) redirect ("admin/error");
   	//if ($_SERVER['REQUEST_METHOD']=='POST') {
   	$delete = $this->model->DeleteData("idx=$idx");
   	//echo $update;
   	if ($delete) {
   		$data["delete"]=true;
   		//set_message("error","News Deleted.");
   		redirect("admin/pages_/UKP3");
   	}
   }  
   
}