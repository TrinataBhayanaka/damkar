<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class galerifoto extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."galeri/galerifoto/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("form_validation","utils","ion_auth"));

        $this->module_title="galerifoto List";
        $this->load->model("galerialbum_model");
        $this->model=$this->galerialbum_model;

		$this->load->model("ion_auth_model");
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->ammmodel=$this->account_manager_model;
		$this->load->model("user/user_model");
        $this->user_model=$this->user_model;
		$this->load->model("general_model");
		$this->wa_model=new general_model("wa_data");

		$this->listText="CMS / News";
        
		$this->admin_layout="admin_lte_layout/main_layout";

    }
    

   function delete($idx=false){
		debug();
		// if (!$this->cms->has_admin($this->module)) redirect ("error_");
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		// pre($id);
		// exit;
		debug();
		$user=$this->model->GetRecordData("idx='{$id}'");
		$folder = $this->config->item('dir_members');
		$data["process"]=true;
		$new_name = $folder.$user['image'];
		$files = FCPATH.$new_name;
		unlink($files);
		$delete = $this->model->DeleteData("idx=$id");		
		$data["delete"]=true;
		set_message("success","galerifoto Deleted.");
		// exit;
		redirect("galeri/galerifoto/");
  }
   
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("galerifoto/");
		   }
	   for($i=0;$i<count($_POST["chkDel"]);$i++)
	{
		$id = $_POST["chkDel"][$i];
		if($_POST["chkDel"][$i] != "")
		{
			$delete = $this->model->DeleteData("id=$id");	
			}
	}
		if($delete){
			set_message("success","galerifoto Deleted.");
			redirect("galerifoto/");
		
		}   
	}
	
   function __file_upload($file_name,$name=false) {
		$cfolder = $this->config->item('dir_members');
		if (!is_dir($cfolder)) mkdir($cfolder);
		
		$folder = $this->config->item('dir_members');
		$data["process"]=true;
		if ($file_name) {
			$fix_name = (($name)?$name:$file_name).substr($file_name,strrpos($file_name,"."));
			$tmp_name = $this->config->item('dir_tmp_members').$file_name;
			$new_name = $folder.$fix_name;
			if (file_exists($tmp_name)) {
				if (copy($tmp_name,$new_name)) {
					unlink($tmp_name);
					return $fix_name;
				}
			}
		}
	}
	
   function index($forder=0,$limit=10,$page=1){
		$filter="category=7";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "(category=7) AND (title like '%".$key."%')";
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
		// debug();
		// exit;
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
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
				$arrDB[$k]['namaAlbum']=$this->model->getNameAlbum($v['image_src']);
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
		// pre($data);exit;
		// exit;
		$data_layout["content"]=$this->load->view("galeri/list_galerifoto",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
   }		
   
	function add(){
  		//if (!$this->cms->has_write($this->module)) redirect ("admin/error");
		$data["module"]=$this->module;
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$data["process"]=true;
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name']);
			}	
			// exit;
			$_data["created"]=$_POST['tgl'];
			$_data["category"]=$_POST['category'];
			$_data["image_src"]=$_POST['album'];
			$_data["image"]=$file_name;
			$_data["status"]=($_POST['status'])?$_POST['status']:0;
			$_data["author"]=$_POST['author'];
			
			$insert = $this->model->InsertData($_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Galeri Album Added.");
				redirect("galeri/galerifoto/");
			}
		}
		else {
			$data["process"]=false;
		}
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["acc_active"]="content";
		$data["process"]=$process;
		$data['album']=$this->model->selectgalerialbum();
		// pre($data);
		// exit;
		$data_layout["content"]=$this->load->view("galeri/add_foto",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
	
     function edit($idx=false){
		if($this->encrypt_status==TRUE):
			// $id_enc=$idx;
			$idx=decrypt($idx);
		endif;
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$process=true;
			if ($_POST['image_name']) {
				// pre($_POST['image_name']);
				$file_name = $this->__file_upload($_POST['image_name']);
				$_data["created"]=$_POST['tgl'];
				$_data["image_src"]=$_POST['album'];
				$_data["status"]=($_POST['status'])?$_POST['status']:0;
				$_data["image"]=$file_name;
			}else{
				$_data["created"]=$_POST['tgl'];
				$_data["image_src"]=$_POST['album'];
				$_data["status"]=($_POST['status'])?$_POST['status']:0;
			}	
			$enc=encrypt($_POST['idx']);
			$update = $this->model->UpdateData($_data,"idx='".$_POST['idx']."'");
			if ($update) {
				$data["edited"]=true;
				$arrDB=$this->model->GetRecordData("idx='".$_POST['idx']."'");
				$data["data"]=$arrDB;
				set_message("success","Galeri Album Edited.");
				redirect("galeri/galerifoto/");
			}
		}
		else {
			$arrDB=$this->model->GetRecordData("idx='{$idx}'");
			$arrDB['news_content']=$this->utils->closetags($arrDB['news_content']);
			$data["data"]=$arrDB;
			$data['album']=$this->model->selectgalerialbum();
		}
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["acc_active"]="content";
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("galeri/edit_foto",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
  }
  
}