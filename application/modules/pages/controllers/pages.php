<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pages extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."pages/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->model("user/pg_model");
        $this->model=$this->pg_model;
		
		$this->load->model("user/account_manager_model");
        $this->ammmodel=$this->account_manager_model;
		
		$this->load->library("utils");
    }
	function about(){
		$this->page_title="Profil";
		$this->page_sub_title="Badan Registrasi Wilayah Adat (BRWA) adalah lembaga tempat pendaftaran (registrasi) wilayah adat";
		$this->page_active=$this->module."about";
		$this->breadcrumb=array("Beranda"=>"","Tentang Portal Kebencanaan"=>"pages/about","Profil"=>"#");
		$this->right_page=array("brwa_kepengurusan");
		$this->index('pbrwa');
	}
	function agenda(){
		$this->page_title="Agenda";
		$this->page_sub_title="Badan Registrasi Wilayah Adat (BRWA) adalah lembaga tempat pendaftaran (registrasi) wilayah adat";
		$this->page_active=$this->module."about";
		$this->breadcrumb=array("Beranda"=>"","Tentang Portal Kebencanaan"=>"pages/about","Agenda"=>"#");
		$this->right_page=array("brwa_kepengurusan");
		$this->index('pbrwa');
	}
	function peraturan(){
		$this->page_title="Peraturan";
		$this->page_sub_title="Badan Registrasi Wilayah Adat (BRWA) adalah lembaga tempat pendaftaran (registrasi) wilayah adat";
		$this->page_active=$this->module."about";
		$this->breadcrumb=array("Beranda"=>"","Tentang Portal Kebencanaan"=>"pages/about","Peraturan"=>"#");
		$this->right_page=array("brwa_kepengurusan");
		$this->index('pbrwa');
	}
	function galeri(){
		$this->page_title="Galeri";
		$this->page_sub_title="Badan Registrasi Wilayah Adat (BRWA) adalah lembaga tempat pendaftaran (registrasi) wilayah adat";
		$this->page_active=$this->module."about";
		$this->breadcrumb=array("Beranda"=>"","Tentang Portal Kebencanaan"=>"pages/about","Galeri"=>"#");
		$this->right_page=array("brwa_kepengurusan");
		$this->index('pbrwa');
	}
	function statistik(){
		$this->page_title="Statistik";
		$this->page_sub_title="Badan Registrasi Wilayah Adat (BRWA) adalah lembaga tempat pendaftaran (registrasi) wilayah adat";
		$this->page_active=$this->module."about";
		$this->breadcrumb=array("Beranda"=>"","Tentang Portal Kebencanaan"=>"pages/about","Statistik"=>"#");
		$this->right_page=array("brwa_kepengurusan");
		$this->index('pbrwa');
	}
	function kantor(){
		$this->page_title="Kantor Wilayah ";
		$this->page_sub_title="Kantor Wilayah BRWA";
		$this->page_active=$this->module."kantor";
		$this->breadcrumb=array("Beranda"=>"","Tentang BRWA"=>"pages/about","Kantor"=>"#");
		$this->index('kbrwa');
	}
	function prosedur(){
		$this->page_title="Prosedur";
		$this->page_sub_title="Prosedur Pendaftaran Wilayah Adat";
		$this->page_active=$this->module."prosedur";
		$this->breadcrumb=array("Beranda"=>"","Pendaftaran"=>"pages/prosedur","Prosedur"=>"#");
		$this->right_page=array("brwa_stats","brwa_wa","brwa_prosedur");
		$this->index('psdbrwa');
	}
	function slpp(){
		$this->page_title="SLPP";
		$this->page_sub_title="Simpul Layanan Pemetaan Partisipatif (SLPP)";
		$this->page_active=$this->module."slpp";
		$this->breadcrumb=array("Beranda"=>"","Layanan"=>"pages/layanan","SLPP"=>"#");
		$this->index('slppbrwa');
	}
	function ukp3(){
		$this->page_title="UKP3";
		$this->page_sub_title="Unit Kerja Pemetaan Partisipatif (UKP3)";
		$this->page_active=$this->module."ukp3";
		$this->breadcrumb=array("Beranda"=>"","Layanan"=>"pages/layanan","UKP3"=>"#");
		$this->index('ukp3brwa');
	}
	function faq(){
		$this->page_title="Frequently Asked Question";
		$this->page_sub_title="Frequently Asked Question";
		$this->page_active=$this->module."faq";
		$this->index('faq');
	}
	
	function kontak(){
		$this->page_title="Kontak";
		$this->page_active="";
		$this->index('kontak');
	}
	function index($category){
		$filter="category='".$category."'";
		$pages=$this->model->get_pages_record($filter);
		$where="category=1020";
		$list =$this->model->ListAll($where);
		
		if (!$pages['idx'])  redirect ("admin/error");
		
		$filter="category='".$pages['idx']."' AND status =1";
		$arrDB=$this->model->GetRecordData($filter);
		
		$data["page"]=$pages;
		$data["data"]=$arrDB;
		$data["list"]=$list;
		
		$data_layout["content"]=$this->load->view("index",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
  function gl_data($idx=false){
		echo 'a';

	}
}