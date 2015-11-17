<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sektor extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."wilayah/sektor/";
        $this->http_ref=base_url().$this->module;
		
        $this->load->helper('form');
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->helper("lookup");
		
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('lauth');
		$this->load->library("utils");

        $this->module_title="Sektor List";
        $this->load->model("sektor_model");
        $this->model=$this->sektor_model;

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
	
	function get_lookup_propinsi(){
        $arrData=$this->user_model->m_propinsi(false," order by ur_wilayah" );
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$val["ur_wilayah"]]=$val["ur_wilayah"];
            endforeach;
        endif;
        return $arrCat;
    }
	
	function index($forder=0,$limit=10,$page=1){
		$filter="";
		// $_GET['q']=".com";
		// $page=2;
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			
			//$filter = "(nomor_pengenal like '%".$key."%' or nama like '%".$key."%' or email like '%".$key."%')";
			$filter = "(namaSektor like '%".$key."%' or skpd like '%".$key."%' or propinsi like '%".$key."%' or kabupaten like '%".$key."%')";
			
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
		
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		// pre($arrDB);
		foreach ($arrDB as $key => $value) {
			$namaProp=$this->get_name_provinsi($value['propinsi']);
			$namaKab=$this->get_name_kabupaten($value['propinsi'],$value['kabupaten']);
			
			$arrDB[$key]=$value;
			$arrDB[$key]['namaProp']=$namaProp['nama'];
			$arrDB[$key]['namaKab']=$namaKab['nama'];
		}
		// pre($arrDB);
		// exit;
		$total_rows=$this->model->getTotalRecordWhere2($filter);
		// pre($total_rows);exit;
		$query_url = ($key)?"?q=".$key:"";
		$base_url = $this->module."index/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(5,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		$data["acc_active"]="content";
		$data["arrDB"]=$arrDB;
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		// pre($data);
		// exit;
		$data_layout["content"]=$this->load->view("wilayah/sektor/v_list.php",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
   
   }	
	
   function add_sektor(){
  		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		// pre($_POST);
		// debug();
		
		//validate form input
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('namaSektor', "<b>Sektor</b>", 'required|xss_clean');
		$this->form_validation->set_rules('skpd', "<b>Skps</b>", 'required|xss_clean');
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
			
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name']);
				$additional_data = array(
				'namaSektor' 		=> $this->input->post('namaSektor'),
				'skpd'  			=> $this->input->post('skpd'),
				'propinsi'    		=> $this->input->post('propinsi'),
				'kabupaten'   		=> $this->input->post('kabupaten'),
				'filename'      	=> $file_name,
				'status'      		=> 1,
				);
			}else{
				$additional_data = array(
				'namaSektor' 		=> $this->input->post('namaSektor'),
				'skpd'  			=> $this->input->post('skpd'),
				'propinsi'    		=> $this->input->post('propinsi'),
				'kabupaten'   		=> $this->input->post('kabupaten'),
				'filename'      	=> '',
				'status'      		=> 1,
				);
			}
			
			//sebelah kiri field database kanan name post
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Data Added.");
				redirect("wilayah/sektor/");
			}
			
		}else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			//display the create user form
			//set the flash data error message if there is one
			$this->data['propinsi'] = array(
				'name'  => 'propinsi',
				'id'    => 'propinsi',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('propinsi'),
			);
			$this->data['kabupaten'] = array(
				'name'  => 'kabupaten',
				'id'    => 'kabupaten',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('kabupaten'),
			);
			$this->data['namaSektor'] = array(
				'name'  => 'namaSektor',
				'id'    => 'namaSektor',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('namaSektor'),
			);
			$this->data['skpd'] = array(
				'name'  => 'skpd',
				'id'    => 'skpd',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('skpd'),
			);
			
		}
		// exit;
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("wilayah/sektor/v_add",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
 	
	function edit_sektor($idx=false){
		//acl
		// pre($_POST);
		// exit;
		// $this->pre($_REQUEST);
		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
	
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		$edit_data=$this->model->GetRecordData("id='{$id}'");
		// pre($edit_data);
		// exit;
		//validate form input
		$this->form_validation->set_rules('namaSektor', "<b>Sektor</b>", 'required|xss_clean');
		$this->form_validation->set_rules('skpd', "<b>Skps</b>", 'required|xss_clean');
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		if (isset($_POST) && !empty($_POST))
		{
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name']);
				$data = array(
				'namaSektor' 		=> $this->input->post('namaSektor'),
				'skpd'  			=> $this->input->post('skpd'),
				'propinsi'    		=> $this->input->post('propinsi'),
				'kabupaten'   		=> $this->input->post('kabupaten'),
				'filename'      	=> $file_name,
				'status'      		=> 1,
				);
			}else{
				$data = array(
				'namaSektor' 		=> $this->input->post('namaSektor'),
				'skpd'  			=> $this->input->post('skpd'),
				'propinsi'    		=> $this->input->post('propinsi'),
				'kabupaten'   		=> $this->input->post('kabupaten'),
				);
			}
			
			
			if ($this->form_validation->run() === TRUE)
			{
				// echo "masukkk";
				// pre($_POST);
				// exit;
				//check to see if we are creating the user
				//redirect them back to the admin page
				$update = $this->model->UpdateData($data,"id='".$this->input->post('id')."'");
				if ($update) {
					$data["edited"]=true;
					set_message("success","Sektor Saved.");
					redirect("wilayah/sektor/", 'refresh');
				}
				
			}
		}
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['idd'] = $edit_data['id'];
		$this->data['img'] = $edit_data['filename'];
			
		//pass the user to the view
			//display the create user form
			//set the flash data error message if there is one
		$this->data['propinsi'] = array(
			'name'  => 'propinsi',
			'id'    => 'propinsi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('propinsi',$edit_data['propinsi']),
		);
		$this->data['kabupaten'] = array(
			'name'  => 'kabupaten',
			'id'    => 'kabupaten',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kabupaten',$edit_data['kabupaten']),
		);
		$this->data['namaSektor'] = array(
			'name'  => 'namaSektor',
			'id'    => 'namaSektor',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('namaSektor',$edit_data['namaSektor']),
		);
		$this->data['skpd'] = array(
			'name'  => 'skpd',
			'id'    => 'skpd',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('skpd',$edit_data['skpd']),
		);
		
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['propinsi']['value']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("wilayah/sektor/v_edit",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
  }
   
	
	
	function delete($idx=false){
  		// debug();
		// if (!$this->cms->has_admin($this->module)) redirect ("error_");
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		$user=$this->model->GetRecordData("id='{$id}'");
		$folder = $this->config->item('dir_members');
		$data["process"]=true;
		$new_name = $folder.$user['image'];
		$files = FCPATH.$new_name;
		unlink($files);
		$delete = $this->model->DeleteData("id=$id");		
		$data["delete"]=true;
		set_message("success","Sektor Deleted.");
		redirect("wilayah/sektor/");
  }
   
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("wilayah/sektor/");
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
			set_message("success","Sektor Deleted.");
			redirect("wilayah/sektor/");
		
		}   
	}


	 function get_lookup_provinsi(){
    	$filter=" kode_kab=00 AND level=0";
        $arrData=$this->user_model->m_provinsi($filter);
        // pre($arrData);
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$x]['kode_prop']=$val["kode_prop"];
                $arrCat[$x]['nama']=$val["nama"];
            endforeach;
        endif;
        // pre($arrCat);
        return $arrCat;
    }
	
	function get_lookup_kabupaten($id=11){
    	
    	$filter=" kode_prop='".$id."' AND level=1";
        $arrData=$this->user_model->m_kabupaten($filter);
        // pre($arrData);
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$x]['kode_kab']=$val["kode_kab"];
                $arrCat[$x]['nama']=$val["nama"];
            endforeach;
        endif;
        // pre($arrCat);
        return $arrCat;
    }

    function get_lookup_kabupatenAjax($id){

    	$filter=" kode_prop='".$id."' AND level=1";
        $arrData=$this->user_model->m_kabupaten($filter);
        // pre($arrData);
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$x]['kode_kab']=$val["kode_kab"];
                $arrCat[$x]['nama']=$val["nama"];
            endforeach;
        endif;
        // pre($arrCat);
        $data['data']=$arrCat;
        // pre($data);
        $data_layout["content"]=$this->load->view("wilayah/wilayah/v_select",$data,true);
        // pre($data_layout["content"]);
		if ($arrCat){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        exit;
        // return $arrCat;
    }
	
	

	
   
}