<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kejadian extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="";

		$this->module=$this->folder."kejadian/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->library(array("excel","excel_reader","form_validation","utils","ion_auth"));

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
	public function importInsert(){
		// pre($_SESSION['dataexcel']);
		foreach ($_SESSION['dataexcel'] as $key => $value) {
			// pre($value);
			$dataImport = array(
				'noKejadian'    	=> $value[A],
				'kodePropinsi' 		=> $value[B],
				'namaPropinsi' 		=> $value[C],
				'kodeKabupaten'  	=> $value[D],	
				'namaKabupaten'  	=> $value[E],	
				'kejadian'  		=> $value[F],
				'waktuKejadian'  	=> $value[G],	
				'meninggal'  		=> $value[H],	
				'hilang'  			=> $value[I],	
				'terluka'  			=> $value[J],	
				'mengungsi'  		=> $value[K],	
				'penyebab'  		=> $value[L],	
				'penyebab'  		=> $value[M],	
				'nilaiKerugian'  	=> $value[N],	
				'jumlahPengungsian' => $value[O],		
				'n_status'      	=> 1,
			);
				$logdataImport = array(
				'noKejadian'    	=> $value[A],
				'kodePropinsi' 		=> $value[B],
				'namaPropinsi' 		=> $value[C],
				'kodeKabupaten'  	=> $value[D],	
				'namaKabupaten'  	=> $value[E],	
				'kejadian'  		=> $value[F],
				'waktuKejadian'  	=> $value[G],	
				'meninggal'  		=> $value[H],	
				'hilang'  			=> $value[I],	
				'terluka'  			=> $value[J],	
				'mengungsi'  		=> $value[K],	
				'penyebab'  		=> $value[L],	
				'penyebab'  		=> $value[M],	
				'nilaiKerugian'  	=> $value[N],	
				'jumlahPengungsian' => $value[O],				
				'status'      		=> "import",
			);
			$filter="noKejadian='".$value[0]."'";
			if(!$this->model->cek_data($filter)){

				$dataImport['statusQuery']="insert";	
				$logdataImport['statusQuery']="insert";	

				$insert = $this->model->InsertData($dataImport);
				$insertlog = $this->modellog->InsertData($logdataImport);

			}else{

				$dataImport['statusQuery']="update";
				$logdataImport['statusQuery']="update";		


				$insertlog = $this->modellog->InsertData($logdataImport);
				$update = $this->model->UpdateData($dataImport,"noKejadian='".$value[0]."'");
			}
			// pre($dataImport);
		}

				redirect("kejadian/kejadian/");

	}
	
	function toecel(){
		//load our new PHPExcel library
		// $this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$filename='just_some_random_name.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		             
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	function exportData(){
		$this->html2fpdf->AddPage();
		// $fp = fopen("sample.html","r");
		$strContent = "<h1 align=center>Hello World!</h1><p>Sekarang saya bisa bikin laporan PDF dengan mudah</p>";
		// $strContent = fread($fp, filesize("sample.html"));
		// fclose($fp);
		$this->html2fpdf->WriteHTML($strContent);
		$this->html2fpdf->Output("sample.pdf","I");
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

    // $starting = 1;
    // $end      = 3;
    // for($i = $starting;$i<=$end; $i++)
    // {

    //    for($j=0;$j<count($arrayLabel);$j++)
    //    {
    //        //== display each cell value
    //        echo $objWorksheet->getCell($arrayLabel[$j].$i)->getValue();
    //    }
    // }
     //or dump data
     $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
     // pre($sheetData);
     // exit();
 	// pre($objWorksheet);
            //  Loop through each row of the worksheet in turn
        //     for ($row = 1; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
        //     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
        //                                         NULL,
        //                                         TRUE,
        //                                         FALSE);
        //     echo $objWorksheet->getCell($arrayLabel[$j].$i)->getValue();
        //     pre($rowData);
        // }
        	// pre($rowData);
 	// $starting = 1;
  //   $end      = 7;
  //   for($i = $starting;$i<=$end; $i++)
  //   {

  //      for($j=0;$j<count($arrayLabel);$j++)
  //      {
  //          //== display each cell value
  //          echo $objWorksheet->getCell($arrayLabel[$j].$i)->getValue();
  //      }
  //   }
                // exit;
			// $this->excel_reader2->read($_FILES['userfile']['tmp_name']);
			// $data = $this->excel_reader2->sheets[0];
		// 	$Spreadsheet = $this->SpreadsheetReader->read($_FILES['userfile']['tmp_name']);
		
		// 	$Sheets = $Spreadsheet -> Sheets();

		// 	pre($Spreadsheet);exit;
     $count=count($sheetData);
     // pre($count);
			$dataexcel = Array();

			foreach ($sheetData as $key => $value) {

				if($key>=3){
					$dataexcel[]=$value;
				}
				
			}
     		// $index=0;
			// for ($i = 3; $i <= $count; $i++) {
			// 	// pre($data['cells'][$i]);
   //                          if($sheetData[$i][1] == '') break;
   //                          $dataexcel[] = $sheetData[$i][A];
   //                          $dataexcel[] = $sheetData[$i][B];
   //                          $dataexcel[] = $sheetData[$i][C];
   //                          $dataexcel[] = $sheetData[$i][D];
   //                          $dataexcel[] = $sheetData[$i][E];
   //                          $dataexcel[] = $sheetData[$i][F];
   //                          $dataexcel[] = $sheetData[$i][G];
   //                          $dataexcel[] = $sheetData[$i][H];
   //                          $dataexcel[] = $sheetData[$i][I];
   //                          $dataexcel[] = $sheetData[$i][J];
   //                          $dataexcel[] = $sheetData[$i][K];
   //                          $dataexcel[] = $sheetData[$i][L];
   //                          $dataexcel[] = $sheetData[$i][M];
   //                          $dataexcel[] = $sheetData[$i][N];
   //                          $dataexcel[] = $sheetData[$i][O];
   //                          $index++;

    //         $dataImport = array(
				// 'noKejadian'    	=> $data['cells'][$i][1],
				// 'kodePropinsi' 		=> $data['cells'][$i][2],
				// 'namaPropinsi' 		=> $data['cells'][$i][3],
				// 'kodeKabupaten'  	=> $data['cells'][$i][4],	
				// 'namaKabupaten'  	=> $data['cells'][$i][5],	
				// 'kejadian'  	=> $data['cells'][$i][6],
				// 'waktuKejadian'  	=> $data['cells'][$i][7],	
				// 'meninggal'  	=> $data['cells'][$i][8],	
				// 'hilang'  	=> $data['cells'][$i][9],	
				// 'terluka'  	=> $data['cells'][$i][10],	
				// 'mengungsi'  	=> $data['cells'][$i][11],	
				// 'penyebab'  	=> $data['cells'][$i][12],	
				// 'nilaiKerugian'  	=> $data['cells'][$i][13],	
				// 'jumlahPengungsian'  	=> $data['cells'][$i][14],
				// 'statusQuery'  		=> "INSERT",				
				// 'n_status'      		=> 1,
			// );
		// 	$logdataImport = array(
		// 		'noKejadian'    	=> $data['cells'][$i][1],
		// 		'kodePropinsi' 		=> $data['cells'][$i][2],
		// 		'namaPropinsi' 		=> $data['cells'][$i][3],
		// 		'kodeKabupaten'  	=> $data['cells'][$i][4],	
		// 		'namaKabupaten'  	=> $data['cells'][$i][5],	
		// 		'kejadian'  	=> $data['cells'][$i][6],
		// 		'waktuKejadian'  	=> $data['cells'][$i][7],	
		// 		'meninggal'  	=> $data['cells'][$i][8],	
		// 		'hilang'  	=> $data['cells'][$i][9],	
		// 		'terluka'  	=> $data['cells'][$i][10],	
		// 		'mengungsi'  	=> $data['cells'][$i][11],	
		// 		'penyebab'  	=> $data['cells'][$i][12],	
		// 		'nilaiKerugian'  	=> $data['cells'][$i][13],	
		// 		'jumlahPengungsian'  	=> $data['cells'][$i][14],
		// 		'statusQuery'  		=> "INSERT",				
		// 		'status'      		=> "import",
		// 	);
		// // exit;
		// 	$insert = $this->model->InsertData($dataImport);
		// 	$insert2 = $this->modellog->InsertData($logdataImport);

			// }
			// pre($dataexcel);
		// exit;
			$data['arrDB']=$dataexcel;
			$_SESSION['dataexcel']=$dataexcel;
    //              $worksheet  = $objPHPExcel->setActiveSheetIndexbyName('Sheet1');


    // $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    // $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    // $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    // $nrColumns          = ord($highestColumn) - 64;
    // $worksheetTitle     = $worksheet->getTitle();

    // echo "<br>The worksheet ".$worksheetTitle." has ";
    // echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    // echo ' and ' . $highestRow . ' row.';
    // echo '<br>Data: <table border="1"><tr>';
    // //----- loop from all rows -----
    // for ($row = 1; $row <= $highestRow; ++ $row) 
    // {
    //     echo '<tr>';
    //     echo "<td>".$row."</td>";
    //     //--- read each excel column for each row ----
    //     for ($col = 0; $col < $highestColumnIndex; ++ $col) 
    //     {
    //         if($row == 1)
    //         {
    //             // show column name with the title
    //              //----- get value ----
    //             $cell = $worksheet->getCellByColumnAndRow($col, $row);
    //             $val = $cell->getValue();
    //             //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
    //             echo '<td>' . $val ."(".$row." X ".$col.")".'</td>';
    //         }
    //         else
    //         {
    //             if($col == 9)
    //             {
    //                 //----- get value ----
    //                 $cell = $worksheet->getCellByColumnAndRow($col, $row);
    //                 $val = $cell->getValue();
    //                 //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
    //                 echo '<td>zone ' . $val .'</td>';
    //             }
    //             else if($col == 13)
    //             {
    //                 $date = PHPExcel_Shared_Date::ExcelToPHPObject($worksheet->getCellByColumnAndRow($col, $row)->getValue())->format('Y-m-d');
    //                 echo '<td>' .dateprovider($date,'dr') .'</td>';
    //             }
    //             else
    //             {
    //                  //----- get value ----
    //                 $cell = $worksheet->getCellByColumnAndRow($col, $row);
    //                 $val = $cell->getValue();
    //                 //$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
    //                 echo '<td>' . $val .'</td>';
    //             }
    //         }
    //     }
    //     echo '</tr>';
    // }
    // echo '</table>';
    // $this->benchmark->mark('code_end');

    // echo "Total time:".$this->benchmark->elapsed_time('code_start', 'code_end');     
    // $this->load->view("error");
// pre($data);exit;
		$data_layout["content"]=$this->load->view("kejadian/v_list_excel",$data,true); 
		$this->load->view($this->admin_layout,$data_layout);
		
	}
	public function tes(){
		pre($_SESSION['dataexcel']);
		foreach ($_SESSION['dataexcel'] as $key => $value) {
			// pre($value);
			$dataImport = array(
				'noKejadian'    	=> $value[0],
				'kodePropinsi' 		=> $value[1],
				'namaPropinsi' 		=> $value[2],
				'kodeKabupaten'  	=> $value[3],	
				'namaKabupaten'  	=> $value[4],	
				'kejadian'  		=> $value[5],
				'waktuKejadian'  	=> $value[6],	
				'meninggal'  		=> $value[7],	
				'hilang'  			=> $value[8],	
				'terluka'  			=> $value[9],	
				'mengungsi'  		=> $value[10],	
				'penyebab'  		=> $value[11],	
				'penyebab'  		=> $value[12],	
				'nilaiKerugian'  	=> $value[13],	
				'jumlahPengungsian' => $value[14],		
				'n_status'      	=> 1,
			);
				$logdataImport = array(
				'noKejadian'    	=> $value[0],
				'kodePropinsi' 		=> $value[1],
				'namaPropinsi' 		=> $value[2],
				'kodeKabupaten'  	=> $value[3],	
				'namaKabupaten'  	=> $value[4],	
				'kejadian'  		=> $value[5],
				'waktuKejadian'  	=> $value[6],	
				'meninggal'  		=> $value[7],	
				'hilang'  			=> $value[8],	
				'terluka'  			=> $value[9],	
				'mengungsi'  		=> $value[10],	
				'penyebab'  		=> $value[11],	
				'penyebab'  		=> $value[12],	
				'nilaiKerugian'  	=> $value[13],	
				'jumlahPengungsian' => $value[14],			
				'status'      		=> "import",
			);
			$filter="noKejadian='".$value[0]."'";
			if(!$this->model->cek_data($filter)){

				$dataImport['statusQuery']="insert";	
				$logdataImport['statusQuery']="insert";	

				$insert = $this->model->InsertData($dataImport);
				$insertlog = $this->modellog->InsertData($logdataImport);

			}else{

				$dataImport['statusQuery']="update";
				$logdataImport['statusQuery']="update";		


				$insertlog = $this->modellog->InsertData($logdataImport);
				$update = $this->model->UpdateData($dataImport,"noKejadian='".$value[0]."'");
			}
			pre($dataImport);
		}

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
		/*$this->form_validation->set_rules('kejadian', "<b>Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('waktuKejadian', "<b>Waktu Kejadian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('hilang', "<b>Hilang</b>", 'required|xss_clean');
		$this->form_validation->set_rules('terluka', "<b>Terluka</b>", 'required|xss_clean');
		$this->form_validation->set_rules('penyebab', "<b>Penyebab</b>", 'required|xss_clean');
		$this->form_validation->set_rules('objek', "<b>objek</b>", 'required|xss_clean');
		$this->form_validation->set_rules('nilaiKerugian', "<b>Nilai Kerugian</b>", 'required|xss_clean');
		$this->form_validation->set_rules('jumlahPengungsian', "<b>Jumlah Pengungsian</b>", 'required|xss_clean');*/

		if ($this->form_validation->run() == true)
		{
			
			$additional_data = array(
				'noKejadian' 		=> $this->input->post('noKejadian'),
				'kodePropinsi' 			=> $this->input->post('kodePropinsi'),
				'kodeKabupaten'  		=> $this->input->post('kodeKabupaten'),
				'kejadian'    		=> $this->input->post('kejadian'),
				'waktuKejadian'  	=> $this->input->post('waktuKejadian'),
				'meninggal'   		=> $this->input->post('meninggal'),
				'hilang'      		=> $this->input->post('hilang'),
				'terluka' 	    	=> $this->input->post('terluka'),
				'mengungsi'     	=> $this->input->post('mengungsi'),
				'penyebab'      	=> $this->input->post('penyebab'),
				'objek'      		=> $this->input->post('objek'),
				'nilaiKerugian'     => $this->input->post('nilaiKerugian'),
				'jumlahPengungsian' => $this->input->post('jumlahPengungsian'),
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

			$dataFormInput=array('noKejadian','kodePropinsi','kodeKabupaten','kejadian','waktuKejadian',
							'meninggal','hilang','terluka','mengungsi','penyebab','objek','nilaiKerugian','jumlahPengungsian');

			$this->data=$this->set_dataInput($dataFormInput);

		}
		
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten();
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

		if (isset($_POST) && !empty($_POST))
		{

			$data = array(
				'noKejadian' 		=> $this->input->post('noKejadian'),
				'kodePropinsi' 			=> $this->input->post('kodePropinsi'),
				'kodeKabupaten'  		=> $this->input->post('kodeKabupaten'),
				'kejadian'    		=> $this->input->post('kejadian'),
				'waktuKejadian'  	=> $this->input->post('waktuKejadian'),
				'meninggal'   		=> $this->input->post('meninggal'),
				'hilang'      		=> $this->input->post('hilang'),
				'terluka' 	    	=> $this->input->post('terluka'),
				'mengungsi'     	=> $this->input->post('mengungsi'),
				'penyebab'      	=> $this->input->post('penyebab'),
				'objek'      		=> $this->input->post('objek'),
				'nilaiKerugian'     => $this->input->post('nilaiKerugian'),
				'jumlahPengungsian' => $this->input->post('jumlahPengungsian'),
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

		
		$dataFormInput=array('noKejadian','kodePropinsi','kodeKabupaten','kejadian','waktuKejadian',
							'meninggal','hilang','terluka','mengungsi','penyebab','objek','nilaiKerugian','jumlahPengungsian');

		$this->data=$this->set_dataInput($dataFormInput,2,$user);
		// pre($this->data);
		$this->data['m_propinsi']=$this->get_lookup_provinsi();
		$this->data['m_kabupaten']=$this->get_lookup_kabupaten($this->data['kodePropinsi']['value']);
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
			
			$filter = "(noKejadian like '%".$key."%' or kodePropinsi like '%".$key."%' or kodeKabupaten like '%".$key."%' or waktuKejadian like '%".$key."%' or penyebab like '%".$key."%'
			or objek like '%".$key."%' or objek like '%".$key."%')";
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
			$namaProp=$this->get_name_provinsi($value['kodePropinsi']);
			$namaKab=$this->get_name_kabupaten($value['kodePropinsi'],$value['kodeKabupaten']);
			
			$arrDB[$key]=$value;
			$arrDB[$key]['namaProp']=$namaProp['nama'];
			$arrDB[$key]['namaKab']=$namaKab['nama'];
		}
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