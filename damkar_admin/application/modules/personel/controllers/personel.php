<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class personel extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."personel/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("form_validation","utils","ion_auth"));

        $this->module_title="Personel List";
        $this->load->model("personel_model");
        $this->model=$this->personel_model;

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
  		

		$data_layout["content"]=$this->load->view("personel/v_personel_ajax",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}

	function dataAjax($forder=0,$limit=10,$page=1,$postKey=false){

	
		// $arrDB=true;
		$data_layout["content"]=$this->dataPaging($forder,$limit,$page,$postKey);

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
		$this->form_validation->set_rules('nip', "<b>NIP</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nama', "<b>Nama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisKelamin', "<b>Jenis Kelamin</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrDepan', "<b>Gelar Depan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrBelakang', "<b>Gelar Belakang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tempatLahir', "<b>Tempat Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglLahir', "<b>Tanggal Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('agama', "<b>Agama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('sektor', "<b>Sektor</b>", 'required|xss_clean');

		if ($this->form_validation->run() == true)
		{
			// if ($_POST['image_name']) {
			// 	$file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			// }

			$additional_data = array(
				'nip' 			=> $this->input->post('nip'),
				'nama'  		=> $this->input->post('nama'),
				'jenisKelamin'    	=> $this->input->post('jenisKelamin'),
				'glrDepan'   => $this->input->post('glrDepan'),
				'glrBelakang'   	=> $this->input->post('glrBelakang'),
				'tempatLahir'      		=> $this->input->post('tempatLahir'),
				'tglLahir' 	    => $this->input->post('tglLahir'),
				'agama'     => $this->input->post('agama'),
				'statusKawin'      => $this->input->post('statusKawin'),
				'golDarah'      => $this->input->post('golDarah'),
				'reshus'      => $this->input->post('reshus'),
				'alamat'      => $this->input->post('alamat'),
				'propinsi'      => $this->input->post('propinsi'),
				'kabupaten'      => $this->input->post('kabupaten'),
				'sektor'      => $this->input->post('sektor'),
				'kompetensi'      => $this->input->post('kompetensi'),
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
				'status'      		=> 1,
			);
		
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				// $data["redirect"]=true;
				// set_message("success","Data Added.");
				// redirect("personel/");
				$data_layout["content"]=$this->dataPaging(0,10,1);

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

			$dataFormInput=array('nip','nama','jenisKelamin','glrDepan','glrBelakang','tempatLahir','tglLahir','agama','statusKawin','golDarah','reshus','alamat','propinsi','kabupaten','sektor','kompetensi','tmtPegawai','statusKerja','pangkat','skPangkat','pendidikan','pelatihan','keterangan');

			$this->data=$this->set_dataInput($dataFormInput);

		}
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kompetensi']=$this->user_model->m_kompetensi();
		// pre($this->data['m_kompetensi']);
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("personel/v_add",$this->data,true); 

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
		$this->form_validation->set_rules('nip', "<b>NIP</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nama', "<b>Nama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisKelamin', "<b>Jenis Kelamin</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrDepan', "<b>Gelar Depan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrBelakang', "<b>Gelar Belakang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tempatLahir', "<b>Tempat Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglLahir', "<b>Tanggal Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('agama', "<b>Agama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('sektor', "<b>Sektor</b>", 'required|xss_clean');

		if (isset($_POST) && !empty($_POST))
		{

			$data = array(
				'nip' 			=> $this->input->post('nip'),
				'nama'  		=> $this->input->post('nama'),
				'jenisKelamin'    	=> $this->input->post('jenisKelamin'),
				'glrDepan'   => $this->input->post('glrDepan'),
				'glrBelakang'   	=> $this->input->post('glrBelakang'),
				'tempatLahir'      		=> $this->input->post('tempatLahir'),
				'tglLahir' 	    => $this->input->post('tglLahir'),
				'agama'     => $this->input->post('agama'),
				'statusKawin'      => $this->input->post('statusKawin'),
				'golDarah'      => $this->input->post('golDarah'),
				'reshus'      => $this->input->post('reshus'),
				'alamat'      => $this->input->post('alamat'),
				'propinsi'      => $this->input->post('propinsi'),
				'kabupaten'      => $this->input->post('kabupaten'),
				'sektor'      => $this->input->post('sektor'),
				'kompetensi'      => $this->input->post('kompetensi'),
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
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
					$data_layout["content"]=$this->dataPaging(0,10,1);

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

		$dataFormInput=array('nip','nama','jenisKelamin','glrDepan','glrBelakang','tempatLahir','tglLahir','agama','statusKawin','golDarah','reshus','alamat','propinsi','kabupaten','sektor','kompetensi','tmtPegawai','statusKerja','pangkat','skPangkat','pendidikan','pelatihan','keterangan');

		$this->data=$this->set_dataInput($dataFormInput,2,$user);
		
		// pre($this->data);
		// $this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kompetensi']=$this->user_model->m_kompetensi();
		// pre($this->data['m_kompetensi']);
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		// $this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("personel/v_edit",$this->data,true); 
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
		$data_layout["content"]=$this->dataPaging($forder,$limit,$page,$postKey);
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
		   // redirect("personel/");
	   		$arrDB=true;
				$data_layout["content"]=$this->dataPaging($forder,$limit,$page,$postKey);
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
				$data_layout["content"]=$this->dataPaging($forder,$limit,$page,$postKey);
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
			
			$filter = "(nip like '%".$key."%' or nama like '%".$key."%' or glrDepan like '%".$key."%' or glrBelakang like '%".$key."%' or sektor like '%".$key."%')";
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
		foreach ($result as $key => $value) {
			$namaProp=$this->get_name_provinsi($value['propinsi']);
			$namaKab=$this->get_name_kabupaten($value['propinsi'],$value['kabupaten']);
			
			$arrDB[$key]=$value;
			$arrDB[$key]['namaProp']=$namaProp['nama'];
			$arrDB[$key]['namaKab']=$namaKab['nama'];
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
		$data_layout["content"]=$this->load->view("personel/v_list",$data,true); 
		
		return $data_layout["content"];
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