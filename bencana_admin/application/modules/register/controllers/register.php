<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends Admin_Controller {

    function __construct(){
        parent::__construct();
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."register/register/";
		$this->http_ref=base_url().$this->module;///brwa_admin/admin/news/
        $this->load->helper("lookup");
        $this->load->model("register_model");
		$this->load->model("ion_auth_model");
        $this->model=$this->register_model;
		$this->load->library("utils");
        $this->module_title="Member List";
		//$this->load->model("account_manager_model");
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->ammmodel=$this->account_manager_model;
		$this->load->model("user/user_model");
        $this->user_model=$this->user_model;
		$this->load->model("general_model");
		$this->wa_model=new general_model("wa_data");
		$this->admin_layout="admin_lte_layout/main_layout";
		
		//nambahin
		$this->model_cms_configuration=new general_model("cms_configuration");
		$this->load->model("ion_auth_model");
		$this->load->library('lauth');
		$this->appname=$this->lauth->appname;
		$this->load->model("admin/account_manager_model");
        $this->model_grp=$this->account_manager_model;
		
    }
	
	function _render_page($view, $data=null, $render=false)
	{
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$view_html = $this->load->view($view, $this->viewdata, $render);
		if($render):
			$datam["acc_active"]="account_manager";
			$datam["content"]=$view_html;
			$this->load->view($this->admin_layout,$datam);
		endif;
		//if ($render) return $view_html;
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
	
	function get_lookup_tanda_pengenal(){
        $arrData=$this->user_model->m_tanda_pengenal(false," order by id" );
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$val["name"]]=$val["name"];
            endforeach;
        endif;
        return $arrCat;
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
	function get_lookup_pekerjaan(){
        $arrData=$this->user_model->m_pekerjaan(false," order by id" );
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$val["name"]]=$val["name"];
            endforeach;
        endif;
        return $arrCat;
    }
	
	function user_list(){
       	$queryString=rebuild_query_string();
		$q=$this->input->get_post("q");
        $field="ip_address,password,salt,activation_code,forgotten_password_code,forgotten_password_time,remember_code,created_on,last_login,active,username,first_name,last_name,email,company,phone,handphone,nama,tanda_pengenal,nomor_pengenal,jenis_kelamin,tempat_lahir,tanggal_lahir,pekerjaan,golongan_darah,alamat,kode_pos,kabupaten_kota,propinsi,image";
		$whereSql=get_where_from_searchbox($field);
		$arrBread[]=array("text"=>"".$this->listText."","url"=>"");
        $this->load->library('pagination');  
		
		$perPage=20;
        $uriSegment=4;
        $totalRows=count($this->ammmodel->SearchRecordWhere($whereSql));
		$offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
		$sortBy=" order by username";
		$arrData=$this->ammmodel->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
        if(cek_array($arrData)):
			foreach($arrData as $x=>$val):
				$arrData[$x]["groups"]=(array) $this->ion_auth->get_users_groups($val["id"])->result_array();
			endforeach;
		endif;
		
		$config['base_url'] = $this->http_ref."/index/";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
		$config["suffix"]=$queryString;
        //$config['display_pages'] = FALSE;
		$this->pagination->initialize($config);
		
		$data["arrData"]=$arrData;
        $datam["arrBread"]=$arrBread;
		$datam["acc_active"]=$this->acc_active;
        $datam["content"]=$this->load->view("register/user_list",$data,true);
        $this->load->view($this->admin_layout,$datam);
    }
    function pr($data){
    	echo"<pre>";
    	print_r($data);
    	echo"</pre>";
    }
	function index($forder=0,$limit=10,$page=1){
		// debug();
		// print_r($_GET);
		if (!$this->cms->has_view($this->module)) redirect ("error_");
		$filter="";
		$_GET['q']=".com";
		$page=2;
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			
			$filter = "(nomor_pengenal like '%".$key."%' or nama like '%".$key."%' or email like '%".$key."%')";
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
		
		pre("---filter---");
		pre($filter);
		pre("---limit---");
		pre($limit);
		pre("---offset---");
		pre($offset);
		pre("---order---");
		pre($order);
		pre("---arrdb---");
		pre($arrDB);
		$total_rows=$this->model->getTotalRecordWhere2($filter);
		pre($total_rows);exit;
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

		$data_layout["content"]=$this->load->view("register/list",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
	function add(){
  		if (!$this->cms->has_write($this->module)) redirect ("error_");
		// debug();
		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('create_user_validation_name_label'), 'required|xss_clean');
		$this->form_validation->set_rules('first_name', "Nama Lengkap", 'required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tanda_pengenal', 'Tanda pengenal', 'required|xss_clean');
		$this->form_validation->set_rules('pekerjaan_select', 'Pekerjaan Select', 'xss_clean');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'xss_clean');
		$this->form_validation->set_rules('kabupaten_kota', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('propinsi', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('kode_pos', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('username'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->ion_auth_model->hash_password($this->input->post('password'));
			$rmm_cd = $this->ion_auth_model->hash_password($email);
		
			if ($_POST['image_name']) {
				$file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			}
			$additional_data = array(
				'first_name' 			=> $this->input->post('first_name'),
				'last_name'  			=> $this->input->post('last_name'),
				'company'    			=> $this->input->post('company'),
				'phone'      			=> $this->input->post('phone'),
				'handphone'      		=> $this->input->post('handphone'),
				'nama'      			=> $this->input->post('first_name'),
				'pekerjaan' 	     	=> $this->input->post('pekerjaan'),
				'tanda_pengenal'      	=> $this->input->post('tanda_pengenal'),
				'nomor_pengenal'      	=> $this->input->post('username'),
				'jenis_kelamin'      	=> $this->input->post('jenis_kelamin'),
				'tempat_lahir'      	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'      	=> $this->input->post('tanggal_lahir'),
				'alamat'      			=> $this->input->post('alamat'),
				'kabupaten_kota'      	=> $this->input->post('kabupaten_kota'),
				'propinsi'      		=> $this->input->post('propinsi'),
				'kode_pos'      		=> $this->input->post('kode_pos'),
				'image'      			=> $file_name,
				'username'      		=> $username,
				'email'      			=> $email,
				'password'      		=> $password,
				'active'      			=> 1,
				'remember_code'      	=> $rmm_cd
			);

			$insert = $this->model->InsertData($additional_data);
			if ($insert) {
				$data["redirect"]=true;
				set_message("success","Data Added.");
				redirect("register/register/");
			}
			
		}else{
		
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			$this->data['username'] = array(
				'name'  => 'username',
				'id'    => 'username',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('username'),
			);
			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['handphone'] = array(
				'name'  => 'handphone',
				'id'    => 'handphone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('handphone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => ''/*$this->form_validation->set_value('password')*/,
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => ''/*$this->form_validation->set_value('password_confirm')*/,
			);
			
			//ADDITIONAL DATA
			$this->data['tanda_pengenal'] = array(
				'name'  => 'tanda_pengenal',
				'id'    => 'tanda_pengenal',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tanda_pengenal'),
			);
			$this->data['tempat_lahir'] = array(
				'name'  => 'tempat_lahir',
				'id'    => 'tempat_lahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tempat_lahir'),
			);
			$this->data['tanggal_lahir'] = array(
				'name'  => 'tanggal_lahir',
				'id'    => 'tanggal_lahir',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('tanggal_lahir'),
			);
			$this->data['kode_pos'] = array(
				'name'  => 'kode_pos',
				'id'    => 'kode_pos',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('kode_pos'),
			);
			$this->data['kabupaten_kota'] = array(
				'name'  => 'kabupaten_kota',
				'id'    => 'kabupaten_kota',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('kabupaten_kota'),
			);
			$this->data['propinsi'] = array(
				'name'  => 'propinsi',
				'id'    => 'propinsi',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('propinsi'),
			);
			$this->data['pekerjaan_select'] = array(
				'name'  => 'pekerjaan_select',
				'id'    => 'pekerjaan',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pekerjaan_select'),
			);
			$this->data['pekerjaan'] = array(
				'name'  => 'pekerjaan',
				'id'    => 'pekerjaan_text2',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('pekerjaan'),
			);
		}
		
		$this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_propinsi();
		$this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("register/add",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
  
	function edit($idx=false){
		//acl

		$this->pr($_REQUEST);
		if (!$this->cms->has_write($this->module)) redirect ("error_");
		$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
		// pre($userSess);exit;
		// if(($userSess['group_brwa'] ==1) || ($userSess['group_brwa'] ==2)):
			// if(!$this->cms->has_write($this->module)):
				// redirect ("error_");
			// endif;
		// else:
			// redirect ("error_");
		// endif;
		//acl
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$id=decrypt($idx);
		endif;
		$user=$this->model->GetRecordData("id='{$id}'");
		// pre($user);exit;
		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('create_user_validation_name_label'), 'required|xss_clean');
		$this->form_validation->set_rules('first_name', "Nama Lengkap", 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean');
		$this->form_validation->set_rules('handphone', $this->lang->line('create_user_validation_handphone_label'), 'xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tanda_pengenal', 'Tanda pengenal', 'required|xss_clean');
		$this->form_validation->set_rules('pekerjaan_select', 'Pekerjaan Select', 'xss_clean');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'xss_clean');
		$this->form_validation->set_rules('kabupaten_kota', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('propinsi', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('kode_pos', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			// if ($this->_valid_csrf_nonce() === FALSE || !$this->input->post('id'))
			// {
				// show_error($this->lang->line('error_csrf'));
			// }
			if ($_POST['image_name']) $file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			$data = array(
				'username' 				=> $this->input->post('username'),
				'first_name' 			=> $this->input->post('first_name'),
				'last_name'  			=> $this->input->post('last_name'),
				'company'    			=> $this->input->post('company'),
				'phone'      			=> $this->input->post('phone'),
				'handphone'     		=> $this->input->post('handphone'),
				'nama'      			=> $this->input->post('first_name'),
				'tanda_pengenal'      	=> $this->input->post('tanda_pengenal'),
				'nomor_pengenal'      	=> $this->input->post('username'),
				'jenis_kelamin'      	=> $this->input->post('jenis_kelamin'),
				'pekerjaan' 	     	=> $this->input->post('pekerjaan'),
				'tempat_lahir'      	=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'      	=> $this->input->post('tanggal_lahir'),
				'alamat'      			=> $this->input->post('alamat'),
				'kabupaten_kota'      	=> $this->input->post('kabupaten_kota'),
				'propinsi'      		=> $this->input->post('propinsi'),
				'kode_pos'      		=> $this->input->post('kode_pos')
			);
			if ($file_name) $data['image']=$file_name;

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->ion_auth_model->hash_password($this->input->post('password'));
			}

			if ($this->form_validation->run() === TRUE)
			{
				//check to see if we are creating the user
				//redirect them back to the admin page
				$update = $this->model->UpdateData($data,"id='".$this->input->post('id')."'");
				if ($update) {
					$data["edited"]=true;
					set_message("success","User Saved.");
					redirect("register/register/", 'refresh');
				}
				
			}
		}
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['idd'] = $user['id'];
		$this->data['alm'] = $user['alamat'];
		$this->data['img'] = $user['image'];
		$this->data['jk'] = $user['jenis_kelamin'];
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('username', $user['username']),
		);
		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user['first_name']),
		);
		
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user['email']),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user['last_name']),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user['company']),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user['phone']),
		);
		$this->data['handphone'] = array(
			'name'  => 'handphone',
			'id'    => 'handphone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('handphone', $user['handphone']),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);
		
		//ADDITIONAL DATA
		$this->data['tanda_pengenal'] = array(
			'name'  => 'tanda_pengenal',
			'id'    => 'tanda_pengenal',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tanda_pengenal', $user['tanda_pengenal']),
		);
		$this->data['tempat_lahir'] = array(
			'name'  => 'tempat_lahir',
			'id'    => 'tempat_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tempat_lahir', $user['tempat_lahir']),
		);
		$this->data['tanggal_lahir'] = array(
			'name'  => 'tanggal_lahir',
			'id'    => 'tanggal_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tanggal_lahir', $user['tanggal_lahir']),
		);
		$this->data['kode_pos'] = array(
			'name'  => 'kode_pos',
			'id'    => 'kode_pos',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kode_pos', $user['kode_pos']),
		);
		$this->data['kabupaten_kota'] = array(
			'name'  => 'kabupaten_kota',
			'id'    => 'kabupaten_kota',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kabupaten_kota', $user['kabupaten_kota']),
		);
		$this->data['propinsi'] = array(
			'name'  => 'propinsi',
			'id'    => 'propinsi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('propinsi', $user['propinsi']),
		);
		$this->data['pekerjaan_select'] = array(
			'name'  => 'pekerjaan_select',
			'id'    => 'pekerjaan',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('pekerjaan_select', $user['pekerjaan']),
		);
		$this->data['pekerjaan'] = array(
			'name'  => 'pekerjaan',
			'id'    => 'pekerjaan_text2',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('pekerjaan', $user['pekerjaan']),
		);
		
		$this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_propinsi();
		$this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("register/edit",$this->data,true); 
		$this->load->view($this->admin_layout,$data_layout);
  }
  
  function delete($idx=false){
  		// debug();
		if (!$this->cms->has_admin($this->module)) redirect ("error_");
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
		redirect("register/register/");
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
   function del_cek(){
	   $get = get_post();
	   //print(count($_POST["chkDel"]));exit;
	   if($_POST["chkDel"]==""){
		   redirect("register/register/");
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
			redirect("register/register/");
		
		}   
	}
}