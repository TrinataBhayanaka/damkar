<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kejadian extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."kejadian/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("excel","form_validation","utils","ion_auth"));

        $this->module_title="Kejadian List";
        $this->load->model("kejadian_model");
        $this->load->model("logkejadian_model");
        $this->model=$this->kejadian_model;
        $this->modellog=$this->logkejadian_model;

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
  		

		$data_layout["content"]=$this->load->view("kejadian/v_kejadian_ajax",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}
	
	function importData(){
		
		$data_layout["content"]=$this->load->view("kejadian/v_import",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
	}

	function importDatax(){
			// header('Content-Type: text/plain');
		// pre($_FILES);
		 $inputFileName = $_FILES['userfile']['tmp_name'];
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);

                // pre($objReader);

                $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
              // $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sheet1');

              $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sheet1');

  
     $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    
     $count=count($sheetData);
     // pre($count);
			$dataexcel = Array();
			$index=0;
			foreach ($sheetData as $key => $value) {

				if($key>=3){

					$dataexcel[$index]['A']=$value['A'];
					$dataexcel[$index]['B']=$value['B'];
					$dataexcel[$index]['C']=$value['C'];
					$dataexcel[$index]['D']=$value['D'];
					$dataexcel[$index]['E']=$value['E'];
					$dataexcel[$index]['F']=$value['F'];
					$dataexcel[$index]['G']=$value['G'];
					$dataexcel[$index]['H']=$value['H'];
					$dataexcel[$index]['I']=$value['I'];
					$dataexcel[$index]['J']=$value['J'];
					$dataexcel[$index]['K']=$value['K'];
					$dataexcel[$index]['L']=$value['L'];
					$dataexcel[$index]['M']=$value['M'];
					$dataexcel[$index]['N']=$value['N'];
					$dataexcel[$index]['O']=$value['O'];
					$dataexcel[$index]['P']=$value['P'];
					$dataexcel[$index]['Q']=$value['Q'];
					$dataexcel[$index]['R']=$value['R'];

				$index++;
				}
				
			}
     		// pre($dataexcel);exit;
			$data['arrDB']=$dataexcel;
			$_SESSION['dataexcel']=$dataexcel;
   

		$data_layout["content"]=$this->load->view("kejadian/v_list_excel",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
		
	}
	public function importInsert(){
		pre($_SESSION['dataexcel']);
		// exit;
		foreach ($_SESSION['dataexcel'] as $key => $value) {
			// pre($value);
			$kodeKabupaten=substr($value[D],2,2);
			$dataImport = array(
				'noKejadian'    	=> $value[A],
				'kodePropinsi' 		=> $value[B],
				'namaPropinsi' 		=> $value[C],
				'kodeKabupaten'  	=> $kodeKabupaten,	
				'namaKabupaten'  	=> $value[E],	
				'kejadian'  		=> $value[F],
				'namaKejadian'  	=> $value[G],
				'waktuKejadian'  	=> $value[H],	
				'meninggal'  		=> $value[I],	
				'hilang'  			=> $value[J],	
				'terluka'  			=> $value[K],	
				'mengungsi'  		=> $value[L],	
				'penyebab'  		=> $value[M],	
				'objek'  			=> $value[N],	
				'nilaiKerugian'  	=> $value[O],	
				'jumlahPengungsian' => $value[P],		
				'x' 				=> $value[Q],		
				'y' 				=> $value[R],		
				'n_status'      	=> 1,
			);
				$logdataImport = array(
				'noKejadian'    	=> $value[A],
				'kodePropinsi' 		=> $value[B],
				'namaPropinsi' 		=> $value[C],
				'kodeKabupaten'  	=> $kodeKabupaten,	
				'namaKabupaten'  	=> $value[E],	
				'kejadian'  		=> $value[F],
				'namaKejadian'  	=> $value[G],
				'waktuKejadian'  	=> $value[H],	
				'meninggal'  		=> $value[I],	
				'hilang'  			=> $value[J],	
				'terluka'  			=> $value[K],	
				'mengungsi'  		=> $value[L],	
				'penyebab'  		=> $value[M],	
				'objek'  			=> $value[N],	
				'nilaiKerugian'  	=> $value[O],	
				'jumlahPengungsian' => $value[P],		
				'x' 				=> $value[Q],		
				'y' 				=> $value[R],				
				'status'      		=> "import",
			);
			$filter="noKejadian='".$value[A]."'";
			if(!$this->model->cek_data($filter)){

				$dataImport['statusQuery']="insert";	
				$logdataImport['statusQuery']="insert";	

				$insert = $this->model->InsertData($dataImport);
				$insertlog = $this->modellog->InsertData($logdataImport);

			}else{

				$dataImport['statusQuery']="update";
				$logdataImport['statusQuery']="update";		


				$insertlog = $this->modellog->InsertData($logdataImport);
				$update = $this->model->UpdateData($dataImport,"noKejadian='".$value[A]."'");
			}
			// pre($dataImport);
				// pre($dataImport);
				// pre($logdataImport);exit;
		}

				redirect("kejadian/kejadian/");

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
		$this->form_validation->set_rules('noKejadian', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kodePropinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kodeKabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kejadian', "<b>Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('waktuKejadian', "<b>Waktu Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('hilang', "<b>Hilang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('terluka', "<b>Terluka</b>", 'required|xss_clean');
		$this->form_validation->set_rules('penyebab', "<b>Penyebab</b>", 'required|xss_clean');
		$this->form_validation->set_rules('objek', "<b>objek</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nilaiKerugian', "<b>Nilai Kerugian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahPengungsian', "<b>Jumlah Pengungsian</b>", 'required|xss_clean');

		if ($this->form_validation->run() == true)
		{
			// if ($_POST['image_name']) {
			// 	$file_name = $this->__file_upload($_POST['image_name'],$_POST['username']);
			// }
			$namaPropinsi=$this->get_name_provinsi($this->input->post('kodePropinsi'));
			$namaKabupaten=$this->get_name_kabupaten($this->input->post('kodePropinsi'),$this->input->post('kodeKabupaten'));
			$namaKebakaran=$this->get_name_kebakaran($this->input->post('kejadian'));

			$additional_data = array(
				'noKejadian' 		=> $this->input->post('noKejadian'),
				'kodePropinsi' 			=> $this->input->post('kodePropinsi'),
				'kodeKabupaten'  		=> $this->input->post('kodeKabupaten'),
				'namaPropinsi' 			=> $namaPropinsi['nama'],
				'namaKabupaten'  		=> $namaKabupaten['nama'],
				'kejadian'    		=> $this->input->post('kejadian'),
				'namaKejadian'    	=> $namaKebakaran['catKebakaran'],
				'waktuKejadian'  	=> $this->input->post('waktuKejadian'),
				'meninggal'   		=> $this->input->post('meninggal'),
				'hilang'      		=> $this->input->post('hilang'),
				'terluka' 	    	=> $this->input->post('terluka'),
				'mengungsi'     	=> $this->input->post('mengungsi'),
				'penyebab'      	=> $this->input->post('penyebab'),
				'objek'      		=> $this->input->post('objek'),
				'nilaiKerugian'     => $this->input->post('nilaiKerugian'),
				'jumlahPengungsian' => $this->input->post('jumlahPengungsian'),
				'x' 				=> $this->input->post('x'),
				'y'					 => $this->input->post('y'),
				'n_status'      	=> 1,
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

			$dataFormInput=array('noKejadian','kodePropinsi','kodeKabupaten','kejadian','waktuKejadian','meninggal','hilang','terluka','mengungsi','penyebab','objek','nilaiKerugian','jumlahPengungsian','x','y');

			$this->data=$this->set_dataInput($dataFormInput);
			// pre($this->data);
		}
		
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['kodePropinsi']['value']);
		$this->data['m_kebakaran']=$this->get_lookup_kebakaran();
		// pre($this->data['m_kebakaran']);
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		$data_layout["content"]=$this->load->view("kejadian/v_add",$this->data,true); 

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
		$this->form_validation->set_rules('noKejadian', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kodePropinsi', "<b>Provinsi</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kodeKabupaten', "<b>Kabupaten</b>", 'required|xss_clean');
		$this->form_validation->set_rules('kejadian', "<b>Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('waktuKejadian', "<b>Waktu Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('hilang', "<b>Hilang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('terluka', "<b>Terluka</b>", 'required|xss_clean');
		$this->form_validation->set_rules('penyebab', "<b>Penyebab</b>", 'required|xss_clean');
		$this->form_validation->set_rules('objek', "<b>objek</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nilaiKerugian', "<b>Nilai Kerugian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahPengungsian', "<b>Jumlah Pengungsian</b>", 'required|xss_clean');
		if (isset($_POST) && !empty($_POST))
		{

			$namaPropinsi=$this->get_name_provinsi($this->input->post('kodePropinsi'));
			$namaKabupaten=$this->get_name_kabupaten($this->input->post('kodePropinsi'),$this->input->post('kodeKabupaten'));
			$namaKebakaran=$this->get_name_kebakaran($this->input->post('kejadian'));
			// pre($namaKebakaran);
			$data = array(
				'noKejadian' 		=> $this->input->post('noKejadian'),
				'kodePropinsi' 			=> $this->input->post('kodePropinsi'),
				'kodeKabupaten'  		=> $this->input->post('kodeKabupaten'),
				'namaPropinsi' 			=> $namaPropinsi['nama'],
				'namaKabupaten'  		=> $namaKabupaten['nama'],
				'kejadian'    		=> $this->input->post('kejadian'),
				'namaKejadian'    	=> $namaKebakaran['catKebakaran'],
				'waktuKejadian'  	=> $this->input->post('waktuKejadian'),
				'meninggal'   		=> $this->input->post('meninggal'),
				'hilang'      		=> $this->input->post('hilang'),
				'terluka' 	    	=> $this->input->post('terluka'),
				'mengungsi'     	=> $this->input->post('mengungsi'),
				'penyebab'      	=> $this->input->post('penyebab'),
				'objek'      		=> $this->input->post('objek'),
				'nilaiKerugian'     => $this->input->post('nilaiKerugian'),
				'jumlahPengungsian' => $this->input->post('jumlahPengungsian'),
				'x' 				=> $this->input->post('x'),
				'y'					 => $this->input->post('y'),
				'n_status'      	=> 1,
			);
			// pre($data);
			if ($this->form_validation->run() === TRUE)
			{

// 			pre($data);
// debug();
// 			pre($user);
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

		$dataFormInput=array('noKejadian','kodePropinsi','kodeKabupaten','kejadian','waktuKejadian','meninggal','hilang','terluka','mengungsi','penyebab','objek','nilaiKerugian','jumlahPengungsian','x','y');

		$this->data=$this->set_dataInput($dataFormInput,2,$user);
		// pre($this->data);
		// $this->data['m_tanda_pengenal']=$this->get_lookup_tanda_pengenal();
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['kodePropinsi']['value']);
		$this->data['m_kebakaran']=$this->get_lookup_kebakaran();
		// $this->data['m_pekerjaan']=$this->get_lookup_pekerjaan();
		$this->data["user_name"]=$this->data['users']['user']['username'];
		$this->data["acc_active"]="content";
		$this->data["process"]=$process;
		// pre($this->data);exit;
		$data_layout["content"]=$this->load->view("kejadian/v_edit",$this->data,true); 
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
		   // redirect("wilayah/wilayah/");
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
			
			$filter = "(namaSektor like '%".$key."%' or skpd like '%".$key."%' or propinsi like '%".$key."%' or kabupaten like '%".$key."%')";
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
		$data_layout["content"]=$this->load->view("kejadian/v_list",$data,true); 
		
		return $data_layout["content"];
	}
	function dataPaging2($forder=0,$limit=10,$page=1,$postKey=false){
		$filter="";
		if($postKey){
			$key=$postKey;
		}else{
			$key = ($_POST['q'])?$_POST['q']:0;
		}

		if ($key) {
			
			$filter = "(namaSektor like '%".$key."%' or skpd like '%".$key."%' or propinsi like '%".$key."%' or kabupaten like '%".$key."%')";
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
		// $data_layout["content"]=$this->load->view("kejadian/v_list",$data,true); 
		
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

	public function pdfReport(){
		// pre($_POST);
		// exit;
		$data=$this->dataPaging2(0,100,1);
		// pre($data);
		$data_layout["content"]=$this->load->view("kejadian/v_report",$data,true); 
		
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
	}
	public function pdfReportIntensitas(){
		$result=$this->model->view_kejadian();
    	$resultGroup=$this->model->view_kejadian_group();

    	// pre($result);
    	$count=array();
    	foreach ($result as $key => $value) {
	
			$count[$value['kodePropinsi']][$value['kodeKabupaten']][$value['kejadian']][]=$value['kejadian'];
	
		}
		$arrDB=array();
		foreach ($resultGroup as $keyG => $valueG) {
			$arrDB[$keyG]=$valueG;
			$arrDB[$keyG]['BG']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['1']);
			$arrDB[$keyG]['PP']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['2']);
			$arrDB[$keyG]['PI']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['3']);
			$arrDB[$keyG]['UPG']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['4']);
			$arrDB[$keyG]['H']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['5']);
			$arrDB[$keyG]['KL']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['6']);
		}
		// pre($count);
		// pre($arrDB);
    	// exit;
    	$this->data['arrDB']=$arrDB;
		// pre($_POST);
		// exit;
		// $data=$this->dataPaging2(0,100,1);
		// pre($data);
		$data_layout["content"]=$this->load->view("kejadian/v_reportIntensitas",$this->data,true); 
		// $this->load->view($this->admin_layout,$data_layout);
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
	}
	public function xlsReportIntensitas(){
		$result=$this->model->view_kejadian();
    	$resultGroup=$this->model->view_kejadian_group();

    	// pre($result);
    	$count=array();
    	foreach ($result as $key => $value) {
	
			$count[$value['kodePropinsi']][$value['kodeKabupaten']][$value['kejadian']][]=$value['kejadian'];
	
		}
		$arrDB=array();
		foreach ($resultGroup as $keyG => $valueG) {
			$arrDB[$keyG]=$valueG;
			$arrDB[$keyG]['BG']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['1']);
			$arrDB[$keyG]['PP']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['2']);
			$arrDB[$keyG]['PI']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['3']);
			$arrDB[$keyG]['UPG']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['4']);
			$arrDB[$keyG]['H']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['5']);
			$arrDB[$keyG]['KL']=count($count[$valueG['kodePropinsi']][$valueG['kodeKabupaten']]['6']);
		}
		// pre($count);
		// pre($arrDB);
    	// exit;
    	$this->data['arrDB']=$arrDB;
		// pre($_POST);
		// exit;
		// $data=$this->dataPaging2(0,100,1);
		// pre($data);
		$data_layout["content"]=$this->load->view("kejadian/v_report_xls_Intensitas",$this->data,true); 
		// $this->load->view($this->admin_layout,$data_layout);
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
	}
	public function xlsReport(){
		// pre($_POST);
		// exit;
		$data=$this->dataPaging2(0,100,1);
		// pre($data);
		$data_layout["content"]=$this->load->view("kejadian/v_report_xls",$data,true); 
		
		if ($data_layout){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
	}
   
}