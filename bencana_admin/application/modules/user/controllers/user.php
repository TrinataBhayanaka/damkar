<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
        
		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :

		$this->load->database();
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
		$this->load->helper('language');
		$this->main_layout="main_layout";
        $this->folder="user/";
        $this->module=$this->folder."user/";
		$this->admin_layout="layout/main_layout";
		
		$this->load->model("user_model");
        $this->user_model=$this->user_model;
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
	//redirect if needed, otherwise display the user list
	function index()
	{
		redirect('user/login', 'refresh');
	}

	//log the user in
	function login()
	{
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				set_message("success",$this->ion_auth->messages());
				redirect($this->input->post('pending_url')?$this->input->post('pending_url'):'home/', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				set_message("error",$this->ion_auth->errors());
				redirect('user/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'placeholder' => lang('login_identity_label'),
				'class' =>'form-control',
				'value' => ''//$this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' =>'form-control',
				'placeholder' => lang('login_password_label'),
				'value' => ''
			);

			$this->_render_page('user/auth/login', $this->data);
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		set_message("success",$this->ion_auth->messages());
		redirect('home/');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('user/auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('user/auth/forgot_password', $this->data,true);
		}
		else
		{
			// get identity for that email
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if(empty($identity)) {
                $this->ion_auth->set_message('forgot_password_email_not_found');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("user/forgot_password", 'refresh');
            }
            
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				set_message("success",$this->ion_auth->messages());
				redirect("user/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("user/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);
		
		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				$this->_render_page('user/auth/reset_password', $this->data,true);
			}
			else
			{
				//pre($this->_valid_csrf_nonce()."::::".$user->id."====".$this->input->post('user_id'));exit;
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						set_message("error",$this->ion_auth->messages());
						redirect('user/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("user/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("user/", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("user/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data,true);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('user/auth', 'refresh');
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
	//create a new user
	function register()
	{
		$this->data['title'] = "Register User";
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			//redirect('user/auth', 'refresh');
		}

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
			$password = $this->input->post('password');
			
			/*$cfolder = $this->config->item('dir_members');
			if (!is_dir($cfolder)) mkdir($cfolder);
			
			$folder = $this->config->item('dir_members');
			$data["process"]=true;
			if ($_POST['image_name']) {
				$fix_name = $_POST['username'].substr($_POST['image_name'],strrpos($_POST['image_name'],"."));
				$tmp_name = $this->config->item('dir_tmp_members').$_POST['image_name'];
				$new_name = $folder.$fix_name;
				if (file_exists($tmp_name)) {
					if (copy($tmp_name,$new_name)) {
						$file_name=$fix_name;
						unlink($tmp_name);
					}
				}
			}*/
			if ($_POST['image_name']) $file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);

			$additional_data = array(
				'first_name' 			=> $this->input->post('first_name'),
				'last_name'  			=> $this->input->post('last_name'),
				'company'    			=> $this->input->post('company'),
				'phone'      			=> $this->input->post('phone'),
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
				'image'      			=> $file_name
			);
		}
		
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			set_message("success","Proses Pendaftaran Berhasil. Kode Aktifasi telah dikirim ke email anda (".$email.")");
			redirect("user/login", 'refresh');
		}
		else
		{
		
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
			
			
			$this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
			$this->data['m_propinsi']=$this->get_lookup_propinsi();
			$this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
			$this->_render_page('user/auth/create_user', $this->data,true);
		}
	}
	
	//edit a user
	function profile()
	{
		$this->data['title'] = "Edit User";
		if (!$this->ion_auth->logged_in())
		{
			redirect('user', 'refresh');
		}

		$user = $this->ion_auth->user()->row();
		
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('create_user_validation_name_label'), 'required|xss_clean');
		$this->form_validation->set_rules('first_name', "Nama Lengkap", 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean');
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
			if ($this->_valid_csrf_nonce() === FALSE || !$this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}
			if ($_POST['image_name']) $file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			$data = array(
				'username' 				=> $this->input->post('username'),
				'first_name' 			=> $this->input->post('first_name'),
				'last_name'  			=> $this->input->post('last_name'),
				'company'    			=> $this->input->post('company'),
				'phone'      			=> $this->input->post('phone'),
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

			//Update the groups user belongs to
			$groupData = $this->input->post('groups');

			if (isset($groupData) && !empty($groupData)) {

				$this->ion_auth->remove_from_group('', $id);

				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id);
				}

			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);

				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "User Saved");
				redirect("user/profile/".$id, 'refresh');
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;
		
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('username', $user->username),
		);
		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
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
			'value' => $this->form_validation->set_value('tanda_pengenal', $user->tanda_pengenal),
		);
		$this->data['tempat_lahir'] = array(
			'name'  => 'tempat_lahir',
			'id'    => 'tempat_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tempat_lahir', $user->tempat_lahir),
		);
		$this->data['tanggal_lahir'] = array(
			'name'  => 'tanggal_lahir',
			'id'    => 'tanggal_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tanggal_lahir', $user->tanggal_lahir),
		);
		$this->data['kode_pos'] = array(
			'name'  => 'kode_pos',
			'id'    => 'kode_pos',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kode_pos', $user->kode_pos),
		);
		$this->data['kabupaten_kota'] = array(
			'name'  => 'kabupaten_kota',
			'id'    => 'kabupaten_kota',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('kabupaten_kota', $user->kabupaten_kota),
		);
		$this->data['propinsi'] = array(
			'name'  => 'propinsi',
			'id'    => 'propinsi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('propinsi', $user->propinsi),
		);
		$this->data['pekerjaan_select'] = array(
			'name'  => 'pekerjaan_select',
			'id'    => 'pekerjaan',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('pekerjaan_select', $user->pekerjaan),
		);
		$this->data['pekerjaan'] = array(
			'name'  => 'pekerjaan',
			'id'    => 'pekerjaan_text2',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('pekerjaan', $user->pekerjaan),
		);
		
		$this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_propinsi();
		$this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();

		$this->_render_page('user/auth/profile', $this->data,true);
	}

	//edit a user
	function edit_user($id)
	{
		$this->data['title'] = "Edit User";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('username', $this->lang->line('edit_user_validation_name_label'), 'required|xss_clean');
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			$data = array(
				'username' => $this->input->post('username'),
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);

			//Update the groups user belongs to
			$groupData = $this->input->post('groups');

			if (isset($groupData) && !empty($groupData)) {

				$this->ion_auth->remove_from_group('', $id);

				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id);
				}

			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);

				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "User Saved");
				redirect("user/", 'refresh');
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;
		
		$this->data['username'] = array(
			'name'  => 'username',
			'id'    => 'username',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('username', $user->username),
		);
		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
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

		$this->_render_page('user/auth/edit_user', $this->data,true);
	}

	// create a new group
	function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user/auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("user/auth", 'refresh');
                
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data,true);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('user/auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user/auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("user/auth/list_group/");
			}
		}

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['group'] = $group;
        $this->data['id'] = $id;

		$this->data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data,true);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}
	/*****************************************************************************************************
	KOMENG 03/06/2014
	As per a personal response from Ben Edmunds, the developer of Ion Auth...
    "We added CSRF protection to the Ion Auth examples before CI built them into the framework so you might be best just removing them from the Ion Auth example controller and views if you�re using a newer version of CI with that built in."
	Since I'm already using the latest version of CodeIgniter (2.1.4), I've decided to go this route.
	The temporary workaround from my OP is now permanent:
	I've enabled the "CSRF Protection" option on line 298 in the CodeIgniter config/config.php file.
	$config['csrf_protection'] = TRUE;  // enabled CSRF protection
	Then I suppressed the CSRF protection in Ion Auth by always returning true from this function.
	
	function _valid_csrf_nonce()
	{
		return TRUE;  // effectively disables Ion Auth's CSRF protection
	}
	
	And finally, the developer commenting on using CodeIgniter's CSRF protection instead:
	
	*****************************************************************************************************/
	/*function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}*/
	
	function _valid_csrf_nonce()
	{		
		return TRUE;
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
	
	
	function list_group(){
		$arrData=$this->ion_auth->groups()->result_array();
		$data["arrData"]=$arrData;
		$this->_render_page("auth/list_group",$data,true);
		
	}
    
     function group_delete(){
        $arrBread[]=array("text"=>$this->listText,"url"=>"$this->http_ref");
        $arrBread[]=array("text"=>"Delete","url"=>"");
        $datam["arrBread"]=$arrBread;
        $chk=$_POST["chk"];
        $idxCols=implode(",",$chk);
        $data["data"]=$this->conn->GetAll("select * from groups where id in ($idxCols) ");
        
        $datam["content"]=$this->load->view($this->module."group_delete",$data,true);
        $this->load->view($this->admin_layout,$datam);
    }
     
    function group_delete_save(){
        $data=$_POST;
        $chk=$data["chk"];
        $this->conn->StartTrans();
        foreach($chk as $x=>$value):
            $idx=$value;
            $this->conn->Execute("delete from groups where id='{$idx}'");
            $this->conn->Execute("delete from users_groups where group_id='{$idx}'");
            
        endforeach;
        $ok=$this->conn->CompleteTrans();
        if($ok==true):
            print "ok";
        else:
            print "not ok";
        endif;
        
    }

}
