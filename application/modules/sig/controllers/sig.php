<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sig extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."sig/";
        $this->http_ref=base_url().$this->module;
        $this->load->helpers(array('form', 'url','lookup','language','file'));
		
        $this->load->model("sig_model");
        $this->model=$this->sig_model;
		$this->listText="LAT Control Page";
        
    }
	
	function index(){
		$arrDB=$this->model->SearchRecord();
    
		$data["arrDB"]=$arrDB;
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("map/list",$data,true); 
		$this->load->view("map/main_layout",$data_layout);
	}
	function index2x(){
		$arrDB=$this->model->SearchRecord();
    
		$data["arrDB"]=$arrDB;
		$data["module"]=$this->module;
		$data_layout["content"]=$this->load->view("map/list2",$data,true); 
		$this->load->view("map/main_layout2",$data_layout);
	}
	
	function add(){
		$this->load->view("add");
	}
  
  function edit($idx){
    $arrDB=$this->model->GetRecordData("idx='{$idx}'");
    $data["data"]=$arrDB;
    $this->load->view("edit",$data);
  }
  
  function delete($idx){
	$this->model->DeleteData("idx=$idx");
    redirect($this->module);
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
   
   function get_kab_kota($kd_bps_propinsi="",$arr_id=""){
		$sql="select * from m_kabupaten_kota where kode_prop=$kd_bps_propinsi and kode_kab!='00' order by kode_bps";
		$arrKabKota=$this->conn->GetAll($sql);
		$arrData=array();
		$arrData[""]="Pilih Kabupaten";
		if(cek_array($arrKabKota)):
			foreach($arrKabKota as $x=>$val):
				$arrData[$val["kode_bps"]]=$val["nama"];
			endforeach;
		endif;
		$data["dataKabupaten"]=$arrData;
		$data["arr_id"]=$arr_id;
		echo $this->load->view($this->module."lookup_kabupaten",$data,true);
	}
}