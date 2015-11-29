<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_capaian_spm extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."master_data/m_capaian_spm/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("form_validation","utils","ion_auth"));

        $this->module_title="Master Data Capaian SPM";
        $this->load->model("m_capaianspm_model");
        $this->model=$this->m_capaianspm_model;

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
    

	function index($forder=0,$limit=10,$page=1){
  		
		
		$data_layout["content"]=$this->load->view("master_data/capaianspm/v_capaian_ajax",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}

	function dataAjax($forder=0,$limit=10,$page=1,$postKey=false){

	
		// $arrDB=true;
		$data=$this->dataPaging($forder,$limit,$page,$postKey);
		$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
		
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
	}

 	 function addAjax(){
 	 	// pre($_POST);
 		$this->data['post']=$_POST;
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('luasWilayah', "<b>Luas Wilayah</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('jumlahKecamatan', "<b>Jumlah Kecamatan</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('jumlahPenduduk', "<b>Jumlah Penduduk</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tahun', "<b>Tahun</b>", 'required|xss_clean');
		$this->form_validation->set_rules('cakupan', "<b>Cakupan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('responTime', "<b>Respon Time</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioPersonel', "<b>Rasio Personel</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioSarPras', "<b>Rasio SarPras</b>", 'required|xss_clean');

		if ($this->form_validation->run() == true)
		{
			// if ($_POST['image_name']) {
			// 	$file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			// }

			$additional_data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				// 'luasWilayah'    	=> $this->input->post('luasWilayah'),
				// 'jumlahKecamatan'   => $this->input->post('jumlahKecamatan'),
				// 'jumlahPenduduk'   	=> $this->input->post('jumlahPenduduk'),
				'tahun'      		=> $this->input->post('tahun'),
				'cakupan'      		=> $this->input->post('cakupan'),
				'responTime' 	    => $this->input->post('responTime'),
				'rasioPersonel'     => $this->input->post('rasioPersonel'),
				'rasioSarPras'      => $this->input->post('rasioSarPras'),
				'status'      		=> 1,
			);
		
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				// $data["redirect"]=true;
				// set_message("success","Data Added.");
				// redirect("master_data/capaianspm/");
				$data=$this->dataPaging(0,10,1);
				$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
		
				if ($data_layout){
		            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
		        }else{
		            print json_encode(array('status'=>false));
		        }
		        
		        exit;
			}
			
		}else{
		
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$dataFormInput=array('propinsi','kabupaten','cakupan','responTime','rasioPersonel','rasioSarPras','tahun');

			$this->data=$this->set_dataInput($dataFormInput);

		}
		// pre($this->form_validation->set_rules());
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		// pre($this->data['m_propinsi']);
		// pre($this->data['m_kabupaten']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("master_data/capaianspm/v_add",$this->data,true); 

		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
 	 }
 	 function edit($idx=false){
		//acl

		
		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		// $userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		// pre($idx);

		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;

		$user=$this->model->GetRecordData("id='{$id}'");
		// pre($user);exit;
		//validate form input
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('luasWilayah', "<b>Luas Wilayah</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('jumlahKecamatan', "<b>Jumlah Kecamatan</b>", 'required|xss_clean');
		// $this->form_validation->set_rules('jumlahPenduduk', "<b>Jumlah Penduduk</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tahun', "<b>Tahun</b>", 'required|xss_clean');
		$this->form_validation->set_rules('cakupan', "<b>Cakupan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('responTime', "<b>Respon Time</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioPersonel', "<b>Rasio Personel</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioSarPras', "<b>Rasio SarPras</b>", 'required|xss_clean');

		if (isset($_POST) && !empty($_POST))
		{

			$data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				// 'luasWilayah'    	=> $this->input->post('luasWilayah'),
				// 'jumlahKecamatan'   => $this->input->post('jumlahKecamatan'),
				// 'jumlahPenduduk'   	=> $this->input->post('jumlahPenduduk'),
				'tahun'      		=> $this->input->post('tahun'),
				'cakupan'      		=> $this->input->post('cakupan'),
				'responTime' 	    => $this->input->post('responTime'),
				'rasioPersonel'     => $this->input->post('rasioPersonel'),
				'rasioSarPras'      => $this->input->post('rasioSarPras'),
				'status'      		=> 1,
			);

			if ($this->form_validation->run() === TRUE)
			{
				//check to see if we are creating the user
				//redirect them back to the admin page
				$update = $this->model->UpdateData($data,"id='".$user['id']."'");
				if ($update) {
					// $data["edited"]=true;
					// set_message("success","User Saved.");
					// redirect("register/register/", 'refresh');
					$data=$this->dataPaging(0,10,1);
					$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
		
					if ($data_layout){
			            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
			        }else{
			            print json_encode(array('status'=>false));
			        }
			        
			        exit;
				}
				
			}
		}
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['idd'] = $idx;

		$dataFormInput=array('propinsi','kabupaten','cakupan','responTime','rasioPersonel','rasioSarPras','tahun');

		$this->data=$this->set_dataInput($dataFormInput,2,$user);
		// pre($this->data['propinsi']);
		// $this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['propinsi']['value']);
		// $this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("master_data/capaianspm/v_edit",$this->data,true); 
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
  }

	function delete($idx=false,$forder=0,$limit=10,$page=1,$postKey=false){
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
		set_message("success","User Deleted.");
		$arrDB=true;
		$data=$this->dataPaging($forder,$limit,$page,$postKey);
		$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
		
		if ($arrDB){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
		// redirect("register/register/");
 	 }
 	 function del_cek($forder=0,$limit=10,$page=1,$postKey=false){
	   $get = get_post();

	   if($_POST["chkDel"]==""){
		   // redirect("master_data/capaianspm/");
	   		$arrDB=true;
				$data=$this->dataPaging($forder,$limit,$page,$postKey);
				$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
		
				if ($arrDB){
		            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
		        }else{
		            print json_encode(array('status'=>false));
		        }
		        exit;
		   }
	   for($i=0;$i<count($_POST["chkDel"]);$i++)
		{
			$id = $_POST["chkDel"][$i];
			// pre($id);
			if($_POST["chkDel"][$i] != "")
			{
				$delete = $this->model->DeleteData("id=$id");	
				}
		}
			if($delete){

				$arrDB=true;
				$data=$this->dataPaging($forder,$limit,$page,$postKey);
				$data_layout["content"]=$this->load->view("master_data/capaianspm/v_list",$data,true); 
				if ($arrDB){
		            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
		        }else{
		            print json_encode(array('status'=>false));
		        }
		        exit;
			
			}   
	}
 	 function dataPaging($forder=0,$limit=10,$page=1,$postKey=false){
		$filter="";
		if($postKey){
			$key=$postKey;
		}else{
			$key = ($_POST['q'])?$_POST['q']:0;
		}

		if ($key) {
			
			$filter = "(propinsi like '%".$key."%' or kabupaten like '%".$key."%' or luasWilayah like '%".$key."%' or jumlahKecamatan like '%".$key."%' or jumlahPenduduk like '%".$key."%' or cakupan like '%".$key."%' or responTime like '%".$key."%' or rasioPersonel like '%".$key."%' or rasioSarPras like '%".$key."%')";
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

		$result=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		// pre($arrDB);
		foreach ($result as $keys => $value) {
			$namaProp=$this->get_name_provinsi($value['propinsi']);
			$namaKab=$this->get_name_kabupaten($value['propinsi'],$value['kabupaten']);
			
			$arrDB[$keys]=$value;
			$arrDB[$keys]['namaProp']=$namaProp['nama'];
			$arrDB[$keys]['namaKab']=$namaKab['nama'];
		}
		$total_rows=$this->model->getTotalRecordWhere2($filter);
		//print_r($total_rows);exit;
		$query_url = ($key)?"/".$key:"";
		$base_url = $this->module."index/".$forder."/".$limit;
		$perpage = $this->utils->getPerPageAjax($limit,array(5,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationStringAjax($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		$data["acc_active"]="content";
		$data["arrDB"]=$arrDB;
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;

		$data["page"]=$forder."/".$limit."/".$page.$query_url;
		
		return $data;
	}

 	 function set_dataInput($data,$type=1,$dataVal){
 	 	if($type=='1'){
			foreach ($data as $key => $value) {
				$this->data[$value]=array(
									'name'  => $value,
									'id'    => $value,
									'type'  => 'text',
									'value' => $this->form_validation->set_value($value)
								);
			}
		}elseif($type=='2'){
			foreach ($data as $key => $value) {
				$this->data[$value]=array(
									'name'  => $value,
									'id'    => $value,
									'type'  => 'text',
									'value' => $this->form_validation->set_value($value,$dataVal[$value])
								);
			}
		}
		return $this->data;
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
   
   
}