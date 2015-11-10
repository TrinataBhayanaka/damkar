<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class config_ extends Admin_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
		$this->load->helper("lookup");
		$class_folder = basename(dirname(__DIR__)); //admin
		$class = __CLASS__; //dashboard
		$this->class=$class;
		$this->$class_folder=$class_folder;
		$this->load->library("utils");
		
		$this->load->helper(array('form', 'url','file'));
		$this->folder=$class_folder."/"; //master_data/
		$this->module=$this->folder.$class."/";//master_data/uu_daerah/
		$this->http_ref=base_url().$this->module;///brwa/admin/dashboard/
		

		$this->load->model("general_model");
		$this->model=new general_model("cms_configuration");
		$this->main_layout="admin_lte_layout/main_layout";
		$this->module_title="Configurasi";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx desc";
		
	}
		function index($forder=0,$limit=10,$page=1){
		
		$filter="status=1";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "category=1015 AND title like '%".$key."%'";
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
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
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

		
		$this->_render_page($this->module."v_view",$data,true);
		//$data_layout["content"]=$this->load->view("config_/v_view",$data,true);
		//$this->load->view($this->admin_layout,$data_layout);
	}	 
	


	function edit(){
		$this->msg_ok="Link updated successfully";
		$this->msg_fail="Unable to update link";
		 
		$act=$this->input->post("act")?$this->input->post("act"):"";
		if(empty($act)):
		$this->index();
		endif;
	
		if($act=="update"):
		$data=get_post();
		$entitas=$data["id_category"];
		$entitas1=$data["id_key"];
		$entitas2=$data["nama"];
		$entitas3=$data["value"];
		$entitas4=$data["status"];
		$data["id_category"]=$entitas;
		$data["id_key"]=$entitas1;
		$data["nama"]=$entitas2;
		$data["value"]=$entitas3;
		$data["status"]=$entitas4;
		
		$data=$this->_add_editor($data);
		$a=$data["idx"];
		$b=$data["id_category"];
		$c=$data["id_key"];
		$d=$data["nama"];
		$e=$data["value"];
		$f=$data["status"];

		for($i=0;$i<count($a);$i++){
			$this->conn->StartTrans();
			$this->db->query("update cms_configuration set id_category='$b[$i]',id_key='$c[$i]',nama='$d[$i]',value='$e[$i]',status='$f[$i]' where $this->tbl_idx=$a[$i]");
			$ok=$this->conn->CompleteTrans();
		}
	
		$this->_proses_message($ok,$this->module."edit/",$this->module."edit");
		endif;
	}
	
	
}