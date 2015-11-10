<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
		$this->load->helper('language');
		
		$this->load->model("ion_auth_model");
		$this->load->library('lauth');
		$this->appname=$this->lauth->appname;

	}
	
	public function index()
	{
		if(!$this->lauth->logged_in()):
			$this->load->view('login/login');
		else:
			redirect("admin/dashboard");
		endif;
	}
	
	public function auth(){
		$user=$this->input->post("uid",true);
		$pass=$this->input->post("pwd",true);
		$user=$user?$user:"";
		$pass=$pass?$pass:"";
		set_flash("uid",$user);
		set_flash("pass",$pass);
		
		if(empty($user)):
			set_message("error","User Name tidak boleh kosong!!");
			redirect("login");
		endif;
		if(empty($pass)):
			set_message("error","Password tidak boleh kosong!!");
			redirect("login");
		endif;
		/*
		if(empty($cap)):
			set_message("error","Isi captcha sesuai dengan gambar!!");
			redirect("login");
		endif;
		*/
		/*
		$code=$_SESSION["captcha"]["code"];
		if(strtolower($code)!=strtolower($cap)):
			set_message("error","Isi captcha sesuai dengan gambar!!");
			redirect("login");
		endif;
		*/
		//$password = $this->ion_auth_model->hash_password($this->input->post('pwd'));
		$ret=$this->lauth->login($user,b64encode($pass));
		// $ret=$this->login_model->check_login($user,$pass);
		if($ret):
			// echo "asd";exit;
			session_regenerate_id();
			$userSess=$_SESSION[$this->lauth->appname]["userdata"]["user"];
			// pre($userSess);exit;
			//$_SESSION[$this->lauth->appname]["groupdata"]=$this->conn->GetRow("select * from b_tb_group where idx=".$_SESSION[$this->lauth->appname]["userdata"]["user"]["group_id"]);
			//$_SESSION[$this->lauth->appname]["leveldata"]=$this->conn->GetRow("select * from tb_user_level where kd_level=".$userSess["user_level_id"]);
		endif;
		if(!$this->lauth->logged_in()):
			redirect("login");
		else:
			redirect("admin/dashboard");
		endif;
	}
	
	
	function check(){
		$user=isset($_POST["username"])?$_POST["username"]:"";
		$pass=isset($_POST["password"])?$_POST["password"]:"";
		if(($user=="")||($pass=="")):
			$this->index();
		endif;
	    $arrDB=$this->conn->GetRow("select * from t_user where user_id=? and password=?",array($user,$pass));
		$status=cek_array($arrDB);
		if($status==true):
			if(($user!=$arrDB["user_id"])||($pass!=$arrDB["password"])):
				$this->index();
				break;
			endif;
			
			$arrDB[$this->appname]["islogin"]=true;
			//set session
			//$this->session->set_userdata($arrDB);
			
			//$_SESSION["userdata"]=$arrDB;
			//$_SESSION["org"]=array();
			//$_SESSION["app"]["p2hp"]="1";
			$_SESSION[$this->appname]["userdata"]=$arrDB;
			/*$_SESSION[$this->appname]["org"]=array();*/
			
			/*$arrLPP=$this->conn->GetRow("select * from m_lpp where kd_lpp='".$arrDB["org_id"]."'");
			if(cek_array($arrLPP)):
				$_SESSION[$this->appname]["org"]=$arrLPP;
			endif;
			*/
			/*
			if($arrDB["group_id"]):
				$dataDJPB["id_perusahaan"]="DJPB";
				$dataDJPB["nama_perusahaan"]="Direktorat Jenderal Perikanan Budidaya";
				$_SESSION["perusahaan"]=$dataDJPB;
			endif;
			*/
			
			//if user pengguna jasa
			/*
			if($arrDB["group_id"]==2):
				$arrPerusahaan=$this->perusahaan_model->GetRecord("idx=".$arrDB["id_perusahaan"]);
				$_SESSION["perusahaan"]=$arrPerusahaan;
			endif;
			*/
			
			$data["status"]="success";
			$data["msg"]="Login Succeed";
			$data["data"]=$arrDB;
			redirect("/");
		else:
			$this->session->set_flashdata('message', '<div id="message">Oopsie, username dan password salah, silahkan mencoba kembali.</div>');
	        $data["status"]="success";
			$data["msg"]="Login Succeed";
			$data["data"]=$arrDB;
			redirect('login', 'refresh');
		endif;
		print json_encode($data);
	}
	
	function logout()
	{
		/*
	    $this->session->sess_destroy();
		session_unset();
		session_destroy();
		redirect('login');
		*/
		$this->lauth->logout();
		redirect('login');
	}
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */