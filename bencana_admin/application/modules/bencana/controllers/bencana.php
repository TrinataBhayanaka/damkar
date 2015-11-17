<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bencana extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."bencana/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("form_validation","utils","ion_auth"));

        $this->module_title="bencana List";
        $this->load->model("bencana_model");
        $this->model=$this->bencana_model;

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
		set_message("success","bencana Deleted.");
		redirect("bencana/");
  }
   
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("bencana/");
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
			set_message("success","bencana Deleted.");
			redirect("bencana/");
		
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
			
			$filter = "(jenisbencana like '%".$key."%' or tglawal like '%".$key."%' or tglakhir like '%".$key."%')";
			
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
		$data_layout["content"]=$this->load->view("bencana/v_list.php",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
   
   }		
	
   function add_bencana(){
  		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		// pre($_POST);
		// debug();
		// exit;
		//validate form input
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisbencana', "<b>Jenis Bencana</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglawal', "<b>Tanggal Awal</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglakhir', "<b>Tanggal Akhir</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
				$additional_data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				'jenisbencana'    	=> $this->input->post('jenisbencana'),
				'tglawal'   => $this->input->post('tglawal'),
				'tglakhir'   	=> $this->input->post('tglakhir'),
				'meninggal'      		=> $this->input->post('meninggal'),
				'hilang' 	    => $this->input->post('hilang'),
				'terluka'     => $this->input->post('terluka'),
				'rumah'      => $this->input->post('rumah'),
				'fsltspendidikan'      => $this->input->post('fsltspendidikan'),
				'fsltskesehatan'      => $this->input->post('fsltskesehatan'),
				'status'      		=> 1,
			);
			//sebelah kiri field database kanan name post
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","bencana Added.");
				redirect("bencana/");
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
			$this->data['jenisbencana'] = array(
				'name'  => 'jenisbencana',
				'id'    => 'jenisbencana',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jenisbencana'),
			);
			$this->data['tglawal'] = array(
				'name'  => 'tglawal',
				'id'    => 'tglawal',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglawal'),
			);
			$this->data['tglakhir'] = array(
				'name'  => 'tglakhir',
				'id'    => 'tglakhir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglakhir'),
			);
			$this->data['meninggal'] = array(
				'name'  => 'meninggal',
				'id'    => 'meninggal',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('meninggal'),
			);
			$this->data['hilang'] = array(
				'name'  => 'hilang',
				'id'    => 'hilang',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('hilang'),
			);
			$this->data['terluka'] = array(
				'name'  => 'terluka',
				'id'    => 'terluka',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('terluka'),
			);
			$this->data['rumah'] = array(
				'name'  => 'rumah',
				'id'    => 'rumah',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('rumah'),
			);
			$this->data['fsltspendidikan'] = array(
				'name'  => 'fsltspendidikan',
				'id'    => 'fsltspendidikan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('fsltspendidikan'),
			);
			$this->data['fsltskesehatan'] = array(
				'name'  => 'fsltskesehatan',
				'id'    => 'fsltskesehatan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('fsltskesehatan'),
			);
			
		}
		// exit;
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("bencana/v_add.php",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}	
	
    function edit_bencana($idx=false){
	
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
	
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		$edit_data=$this->model->GetRecordData("id='{$id}'");
		// pre($_POST);
		// exit;
		$this->data['post']=$_POST;
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jenisbencana', "<b>Jenis Bencana</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglawal', "<b>Tanggal Awal</b>", 'required|xss_clean');
		$this->form_validation->set_rules('tglakhir', "<b>Tanggal Akhir</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
				$data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				'jenisbencana'    	=> $this->input->post('jenisbencana'),
				'tglawal'   => $this->input->post('tglawal'),
				'tglakhir'   	=> $this->input->post('tglakhir'),
				'meninggal'      		=> $this->input->post('meninggal'),
				'hilang' 	    => $this->input->post('hilang'),
				'terluka'     => $this->input->post('terluka'),
				'rumah'      => $this->input->post('rumah'),
				'fsltspendidikan'      => $this->input->post('fsltspendidikan'),
				'fsltskesehatan'      => $this->input->post('fsltskesehatan'),
			);
			
			
			//sebelah kiri field database kanan name post
			$update = $this->model->UpdateData($data,"id='".$this->input->post('id')."'");
				if ($update) {
					$data["edited"]=true;
					set_message("success","Sektor Saved.");
					redirect("bencana/", 'refresh');
				}
			
		}else{
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			//display the create user form
			//set the flash data error message if there is one
			$this->data['idd'] = $edit_data['id'];
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
			$this->data['jenisbencana'] = array(
				'name'  => 'jenisbencana',
				'id'    => 'jenisbencana',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jenisbencana',$edit_data['jenisbencana']),
			);
			$this->data['tglawal'] = array(
				'name'  => 'tglawal',
				'id'    => 'tglawal',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglawal',$edit_data['tglawal']),
			);
			$this->data['tglakhir'] = array(
				'name'  => 'tglakhir',
				'id'    => 'tglakhir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tglakhir',$edit_data['tglakhir']),
			);
			$this->data['meninggal'] = array(
				'name'  => 'meninggal',
				'id'    => 'meninggal',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('meninggal',$edit_data['meninggal']),
			);
			$this->data['hilang'] = array(
				'name'  => 'hilang',
				'id'    => 'hilang',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('hilang',$edit_data['hilang']),
			);
			$this->data['terluka'] = array(
				'name'  => 'terluka',
				'id'    => 'terluka',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('terluka',$edit_data['terluka']),
			);
			$this->data['rumah'] = array(
				'name'  => 'rumah',
				'id'    => 'rumah',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('rumah',$edit_data['rumah']),
			);
			$this->data['fsltspendidikan'] = array(
				'name'  => 'fsltspendidikan',
				'id'    => 'fsltspendidikan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('fsltspendidikan',$edit_data['fsltspendidikan']),
			);
			$this->data['fsltskesehatan'] = array(
				'name'  => 'fsltskesehatan',
				'id'    => 'fsltskesehatan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('fsltskesehatan',$edit_data['fsltskesehatan']),
			);
			
		}
			
		
		// pre($this->data);
		// exit;
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['propinsi']['value']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("bencana/v_edit.php",$this->data,true); 
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