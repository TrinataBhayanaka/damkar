<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wilayah extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."wilayah/wilayah/";
		$this->http_ref=base_url().$this->module;
        
		
        $this->module_title="Wilayah List";
        $this->load->model("wilayah_model");
        $this->model=$this->wilayah_model;
		
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->helper("lookup");
		
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('lauth');
		$this->load->library("utils");
		
		$this->load->model("ion_auth_model");
		$this->load->database();
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->ammmodel=$this->account_manager_model;
		$this->load->model("user/user_model");
        $this->user_model=$this->user_model;
		$this->load->model("general_model");
		$this->wa_model=new general_model("wa_data");
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
   
   //belajar iman
   function index($forder=0,$limit=10,$page=1){
		$filter="";
		// $_GET['q']=".com";
		// $page=2;
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			
			//$filter = "(nomor_pengenal like '%".$key."%' or nama like '%".$key."%' or email like '%".$key."%')";
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		// pre($arrDB);
		// exit;
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
		// pre($arrDB);
		// exit;
		// pre($data);
		// exit;
		$data_layout["content"]=$this->load->view("wilayah/wilayah/v_list_tmp.php",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
   
   }
   
   
   function add_wilayah(){
  		// if (!$this->cms->has_write($this->module)) redirect ("error_");
		// pre($_POST);
		// exit;
		// debug();
		//validate form input
		$this->data['post']=$_POST;
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('luasWilayah', "<b>Luas Wilayah</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahKecamatan', "<b>Jumlah Kecamatan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahPenduduk', "<b>Jumlah Penduduk</b>", 'required|xss_clean');
		$this->form_validation->set_rules('cakupan', "<b>Cakupan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('responTime', "<b>Respon Time</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioPersonel', "<b>Rasio Personel</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioSarPras', "<b>Rasio SarPras</b>", 'required|xss_clean');
		if ($this->form_validation->run() == true)
		{
			$additional_data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				'luasWilayah'    	=> $this->input->post('luasWilayah'),
				'jumlahKecamatan'   => $this->input->post('jumlahKecamatan'),
				'jumlahPenduduk'   	=> $this->input->post('jumlahPenduduk'),
				'cakupan'      		=> $this->input->post('cakupan'),
				'responTime' 	    => $this->input->post('responTime'),
				'rasioPersonel'     => $this->input->post('rasioPersonel'),
				'rasioSarPras'      => $this->input->post('rasioSarPras'),
				'status'      		=> 1,
			);
			//sebelah kiri field database kanan name post
			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Data Added.");
				redirect("wilayah/wilayah/");
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
			$this->data['luasWilayah'] = array(
				'name'  => 'luasWilayah',
				'id'    => 'luasWilayah',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('luasWilayah'),
			);
			$this->data['jumlahKecamatan'] = array(
				'name'  => 'jumlahKecamatan',
				'id'    => 'jumlahKecamatan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jumlahKecamatan'),
			);
			$this->data['jumlahPenduduk'] = array(
				'name'  => 'jumlahPenduduk',
				'id'    => 'jumlahPenduduk',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('jumlahPenduduk'),
			);
			$this->data['cakupan'] = array(
				'name'  => 'cakupan',
				'id'    => 'cakupan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('cakupan'),
			);
			$this->data['responTime'] = array(
				'name'  => 'responTime',
				'id'    => 'responTime',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('responTime'),
			);
			$this->data['rasioPersonel'] = array(
				'name'  => 'rasioPersonel',
				'id'    => 'rasioPersonel',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('rasioPersonel'),
			);
			$this->data['rasioSarPras'] = array(
				'name'  => 'rasioSarPras',
				'id'    => 'rasioSarPras',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('rasioSarPras'),
			);
		}
		
		// $this->data['m_propinsi']=$this->get_lookup_propinsi();
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("wilayah/wilayah/v_add",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
   
   function edit_wilayah($idx=false){
		//acl

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
		$this->form_validation->set_rules('propinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('luasWilayah', "<b>Luas Wilayah</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahKecamatan', "<b>Jumlah Kecamatan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahPenduduk', "<b>Jumlah Penduduk</b>", 'required|xss_clean');
		$this->form_validation->set_rules('cakupan', "<b>Cakupan</b>", 'required|xss_clean');
		$this->form_validation->set_rules('responTime', "<b>Respon Time</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioPersonel', "<b>Rasio Personel</b>", 'required|xss_clean');
		$this->form_validation->set_rules('rasioSarPras', "<b>Rasio SarPras</b>", 'required|xss_clean');
		if (isset($_POST) && !empty($_POST))
		{
			$data = array(
				'propinsi' 			=> $this->input->post('propinsi'),
				'kabupaten'  		=> $this->input->post('kabupaten'),
				'luasWilayah'    	=> $this->input->post('luasWilayah'),
				'jumlahKecamatan'   => $this->input->post('jumlahKecamatan'),
				'jumlahPenduduk'   	=> $this->input->post('jumlahPenduduk'),
				'cakupan'      		=> $this->input->post('cakupan'),
				'responTime' 	    => $this->input->post('responTime'),
				'rasioPersonel'     => $this->input->post('rasioPersonel'),
				'rasioSarPras'      => $this->input->post('rasioSarPras'),
				'status'      		=> 1,
			);
			
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
					set_message("success","User Saved.");
					redirect("wilayah/wilayah/", 'refresh');
				}
				
			}
		}
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		$this->data['idd'] = $edit_data['id'];
		//$this->data['kabupaten'] = $edit_data['kabupaten'];
		//pass the user to the view
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
		$this->data['luasWilayah'] = array(
			'name'  => 'luasWilayah',
			'id'    => 'luasWilayah',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('luasWilayah',$edit_data['luasWilayah']),
		);
		$this->data['jumlahKecamatan'] = array(
			'name'  => 'jumlahKecamatan',
			'id'    => 'jumlahKecamatan',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('jumlahKecamatan',$edit_data['jumlahKecamatan']),
		);
		$this->data['jumlahPenduduk'] = array(
			'name'  => 'jumlahPenduduk',
			'id'    => 'jumlahPenduduk',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('jumlahPenduduk',$edit_data['jumlahPenduduk']),
		);
		$this->data['cakupan'] = array(
			'name'  => 'cakupan',
			'id'    => 'cakupan',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('cakupan',$edit_data['cakupan']),
		);
		$this->data['responTime'] = array(
			'name'  => 'responTime',
			'id'    => 'responTime',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('responTime',$edit_data['responTime']),
		);
		$this->data['rasioPersonel'] = array(
			'name'  => 'rasioPersonel',
			'id'    => 'rasioPersonel',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('rasioPersonel',$edit_data['rasioPersonel']),
		);
		$this->data['rasioSarPras'] = array(
			'name'  => 'rasioSarPras',
			'id'    => 'rasioSarPras',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('rasioSarPras',$edit_data['rasioSarPras']),
		);
		//$this->data['m_propinsi']=$this->get_lookup_propinsi();
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['propinsi']['value']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("wilayah/wilayah/v_edit",$this->data,true); 
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
		$data["process"]=true;
		$new_name = $folder.$user['image'];
		$delete = $this->model->DeleteData("id=$id");		
		$data["delete"]=true;
		set_message("success","Wilayah Deleted.");
		redirect("wilayah/wilayah/");
  }
   
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("wilayah/wilayah/");
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
			set_message("success","User Deleted.");
			redirect("wilayah/wilayah/");
		
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