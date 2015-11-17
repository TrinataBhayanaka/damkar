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
		set_message("success","Personel Deleted.");
		redirect("personel/");
  }
   
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("personel/");
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
			set_message("success","Personel Deleted.");
			redirect("personel/");
		
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		foreach ($arrDB as $key => $value) {
			$namaProp=$this->get_name_provinsi($value['propinsi']);
			$namaKab=$this->get_name_kabupaten($value['propinsi'],$value['kabupaten']);
			
			$arrDB[$key]=$value;
			$arrDB[$key]['namaProp']=$namaProp['nama'];
			$arrDB[$key]['namaKab']=$namaKab['nama'];
		}
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
		$data_layout["content"]=$this->load->view("personel/v_list.php",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
   
   }		
	
   function add_personel(){
  		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		// pre($_POST);
		// debug();
		// exit;
		//validate form input
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('nip', "<b>NIP</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nama', "<b>Nama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisKelamin', "<b>Jenis Kelamin</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrDepan', "<b>Gelar Depan</b>", 'required|xss_clean');
		//$this->form_validation->set_rules('glrBelakang', "<b>Gelar Belakang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tempatLahir', "<b>Tempat Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglLahir', "<b>Tanggal Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('agama', "<b>Agama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('statusKawin', "<b>statusKawin</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name']);
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
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
				'filename'      	=> $file_name,
				'status'      		=> 1,
			);
			}else{
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
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
				'status'      		=> 1,
			);}
			
			//sebelah kiri field database kanan name post
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Personel Added.");
				redirect("personel/");
			}
			
		}else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			//display the create user form
			//set the flash data error message if there is one
			$this->data['nip'] = array(
				'name'  => 'nip',
				'id'    => 'nip',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('nip'),
			);
			$this->data['nama'] = array(
				'name'  => 'nama',
				'id'    => 'nama',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('nama'),
			);
			$this->data['jenisKelamin'] = array(
				'name'  => 'jenisKelamin',
				'id'    => 'jenisKelamin',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jenisKelamin'),
			);
			$this->data['glrDepan'] = array(
				'name'  => 'glrDepan',
				'id'    => 'glrDepan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('glrDepan'),
			);
			$this->data['glrBelakang'] = array(
				'name'  => 'glrBelakang',
				'id'    => 'glrBelakang',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('glrBelakang'),
			);
			$this->data['tempatLahir'] = array(
				'name'  => 'tempatLahir',
				'id'    => 'tempatLahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tempatLahir'),
			);
			$this->data['tglLahir'] = array(
				'name'  => 'tglLahir',
				'id'    => 'tglLahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglLahir'),
			);
			$this->data['agama'] = array(
				'name'  => 'agama',
				'id'    => 'agama',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('agama'),
			);
			$this->data['statusKawin'] = array(
				'name'  => 'statusKawin',
				'id'    => 'statusKawin',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('statusKawin'),
			);
			$this->data['golDarah'] = array(
				'name'  => 'golDarah',
				'id'    => 'golDarah',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('golDarah'),
			);
			$this->data['reshus'] = array(
				'name'  => 'reshus',
				'id'    => 'reshus',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('reshus'),
			);
			/*$this->data['alamat'] = array(
				'name'  => 'alamat',
				'id'    => 'alamat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('alamat'),
			);*/
			$this->data['propinsi'] = array(
				'name'  => 'propinsi',
				'id'    => 'propinsi',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('propinsi'),
			);
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
			$this->data['sektor'] = array(
				'name'  => 'sektor',
				'id'    => 'sektor',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('sektor'),
			);
			$this->data['tmtPegawai'] = array(
				'name'  => 'tmtPegawai',
				'id'    => 'tmtPegawai',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tmtPegawai'),
			);
			$this->data['statusKerja'] = array(
				'name'  => 'statusKerja',
				'id'    => 'statusKerja',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('statusKerja'),
			);
			$this->data['pangkat'] = array(
				'name'  => 'pangkat',
				'id'    => 'pangkat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pangkat'),
			);
			$this->data['skPangkat'] = array(
				'name'  => 'skPangkat',
				'id'    => 'skPangkat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('skPangkat'),
			);
			$this->data['pendidikan'] = array(
				'name'  => 'pendidikan',
				'id'    => 'pendidikan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pendidikan'),
			);
			$this->data['pelatihan'] = array(
				'name'  => 'pelatihan',
				'id'    => 'pelatihan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pelatihan'),
			);
			$this->data['keterangan'] = array(
				'name'  => 'keterangan',
				'id'    => 'keterangan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('keterangan'),
			);
			
		}
		// exit;
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("personel/v_add.php",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}	
	
    function edit_personel($idx=false){
	
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
	
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		$edit_data=$this->model->GetRecordData("id='{$id}'");
		// pre($_POST);
		// exit;
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('nip', "<b>NIP</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nama', "<b>Nama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisKelamin', "<b>Jenis Kelamin</b>", 'required|xss_clean');
		$this->form_validation->set_rules('glrDepan', "<b>Gelar Depan</b>", 'required|xss_clean');
		//$this->form_validation->set_rules('glrBelakang', "<b>Gelar Belakang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tempatLahir', "<b>Tempat Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglLahir', "<b>Tanggal Lahir</b>", 'required|xss_clean');
		$this->form_validation->set_rules('agama', "<b>Agama</b>", 'required|xss_clean');
		$this->form_validation->set_rules('statusKawin', "<b>statusKawin</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name']);
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
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
				'filename'      	=> $file_name,
				'status'      		=> 1,
			);
			}else{
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
				'tmtPegawai'      => $this->input->post('tmtPegawai'),
				'statusKerja'      => $this->input->post('statusKerja'),
				'pangkat'      => $this->input->post('pangkat'),
				'skPangkat'      => $this->input->post('skPangkat'),
				'pendidikan'      => $this->input->post('pendidikan'),
				'pelatihan'      => $this->input->post('pelatihan'),
				'keterangan'      => $this->input->post('keterangan'),
				'status'      		=> 1,
			);}
			
			//sebelah kiri field database kanan name post
			$update = $this->model->UpdateData($data,"id='".$this->input->post('id')."'");
				if ($update) {
					$data["edited"]=true;
					set_message("success","Sektor Saved.");
					redirect("personel/", 'refresh');
				}
			
		}else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			//display the create user form
			//set the flash data error message if there is one
			$this->data['idd'] = $edit_data['id'];
			$this->data['img'] = $edit_data['filename'];
			$this->data['jk'] = $edit_data['jenisKelamin'];
			$this->data['almt'] = $edit_data['alamat'];
			$this->data['nip'] = array(
				'name'  => 'nip',
				'id'    => 'nip',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('nip',$edit_data['nip']),
			);
			$this->data['nama'] = array(
				'name'  => 'nama',
				'id'    => 'nama',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('nama',$edit_data['nama']),
			);
			$this->data['jenisKelamin'] = array(
				'name'  => 'jenisKelamin',
				'id'    => 'jenisKelamin',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jenisKelamin',$edit_data['jenisKelamin']),
			);
			$this->data['glrDepan'] = array(
				'name'  => 'glrDepan',
				'id'    => 'glrDepan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('glrDepan',$edit_data['glrDepan']),
			);
			$this->data['glrBelakang'] = array(
				'name'  => 'glrBelakang',
				'id'    => 'glrBelakang',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('glrBelakang',$edit_data['glrBelakang']),
			);
			$this->data['tempatLahir'] = array(
				'name'  => 'tempatLahir',
				'id'    => 'tempatLahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tempatLahir',$edit_data['tempatLahir']),
			);
			$this->data['tglLahir'] = array(
				'name'  => 'tglLahir',
				'id'    => 'tglLahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglLahir',$edit_data['tglLahir']),
			);
			$this->data['agama'] = array(
				'name'  => 'agama',
				'id'    => 'agama',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('agama',$edit_data['agama']),
			);
			$this->data['statusKawin'] = array(
				'name'  => 'statusKawin',
				'id'    => 'statusKawin',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('statusKawin',$edit_data['statusKawin']),
			);
			$this->data['golDarah'] = array(
				'name'  => 'golDarah',
				'id'    => 'golDarah',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('golDarah',$edit_data['golDarah']),
			);
			$this->data['reshus'] = array(
				'name'  => 'reshus',
				'id'    => 'reshus',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('reshus',$edit_data['reshus']),
			);
			/*$this->data['alamat'] = array(
				'name'  => 'alamat',
				'id'    => 'alamat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('alamat',$edit_data['alamat']),
			);*/
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
			$this->data['sektor'] = array(
				'name'  => 'sektor',
				'id'    => 'sektor',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('sektor',$edit_data['sektor']),
			);
			$this->data['tmtPegawai'] = array(
				'name'  => 'tmtPegawai',
				'id'    => 'tmtPegawai',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tmtPegawai',$edit_data['tmtPegawai']),
			);
			$this->data['statusKerja'] = array(
				'name'  => 'statusKerja',
				'id'    => 'statusKerja',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('statusKerja',$edit_data['statusKerja']),
			);
			$this->data['pangkat'] = array(
				'name'  => 'pangkat',
				'id'    => 'pangkat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pangkat',$edit_data['pangkat']),
			);
			$this->data['skPangkat'] = array(
				'name'  => 'skPangkat',
				'id'    => 'skPangkat',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('skPangkat',$edit_data['skPangkat']),
			);
			$this->data['pendidikan'] = array(
				'name'  => 'pendidikan',
				'id'    => 'pendidikan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pendidikan',$edit_data['pendidikan']),
			);
			$this->data['pelatihan'] = array(
				'name'  => 'pelatihan',
				'id'    => 'pelatihan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pelatihan',$edit_data['pelatihan']),
			);
			$this->data['keterangan'] = array(
				'name'  => 'keterangan',
				'id'    => 'keterangan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('keterangan',$edit_data['keterangan']),
			);
			
		}
		// pre($this->data);
		// exit;
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['propinsi']['value']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("personel/v_edit.php",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
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