<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class calendar extends Admin_Controller {
	
    var $arr_category=array();
    
    function __construct(){
        parent::__construct();
        
		//print __CLASS__;
		$class_folder=basename(dirname(__DIR__));
        $class=__CLASS__;
		
		$this->class=$class;
		$this->$class_folder=$class_folder;
		
		$this->load->helper(array('form', 'url','file'));
    	$this->load->library("Hrms");
        $this->folder=$class_folder."/";
		//$this->folder="";
        $this->module=$this->folder.$class."/";
        $this->http_ref=base_url().$this->module;
        
        $this->load->helper("menu_helper");
        
        //$this->load->model("general_model");
        $this->model=new general_model("m_calendar");
        //$this->listText="Nama Pejabat";
        
        $this->acc_active="data_$class";
        $this->admin_layout="admin_layout/main_layout";
		$this->folder_title="Pegawai";
		$this->module_title="Cuti";
		$this->tbl_idx="id";
		//$this->tbl_idx_pegawai="id_pegawai";
		//$this->tbl_sort="tgl_selesai desc";
		
    }
	
	function index($m="",$y=""){
			$req=get_post();
			$m=$req["month"];
			$y=$req["year"];
			$m=empty($m)?date("m"):$m;
			$y=empty($y)?date("Y"):$y;
			$this->data_libur=array();
			$this->data_libur=$this->get_calendar_holiday($m,$y);
			$data["print_calendar"]=$this->show_month($m,$y);
			$data["data_libur"]=$this->data_libur;
			$this->_render_page($this->module."index",$data,true);
	}
	
	function show_month($month = null, $year = null)
	{
		
		$arr=$this->data_libur;
		foreach($arr as $x=>$val):
			$holiday[$val["hari"]]=1;
		endforeach;
			
		$calendar = '';
		if($month == null || $year == null) {
			$month = date('m');
			$year = date('Y');
		}
		$date = mktime(12, 0, 0, $month, 1, $year);
		$daysInMonth = date("t", $date);
		$offset = date("w", $date);
		$rows = 1;
		$prev_month = $month - 1;
		$prev_year = $year;
		if ($month == 1) {
			$prev_month = 12;
			$prev_year = $year-1;
		}
	 
		$next_month = $month + 1;
		$next_year = $year;
		if ($month == 12) {
			$next_month = 1;
			$next_year = $year + 1;
		}
		$calendar .= "<div class='panel-heading text-center'><div class='row'><div class='col-md-3 col-xs-4'><a class='ajax-navigation btn btn-default btn-sm' href='".$this->module."?month=".$prev_month."&year=".$prev_year."'><span class='glyphicon glyphicon-arrow-left'></span></a></div><div class='col-md-6 col-xs-4'><strong>" . date("F Y", $date) . "</strong></div>";
		$calendar .= "<div class='col-md-3 col-xs-4 '><a class='ajax-navigation btn btn-default btn-sm' href='".$this->module."?month=".$next_month."&year=".$next_year."'><span class='glyphicon glyphicon-arrow-right'></span></a></div></div></div>";
		$calendar .= "<table class='table table-bordered table-calendar' style='background-color:white'>";
		$calendar .= "<thead class='well'><tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr></thead>";
		$calendar .= "<tbody><tr>";
		$td_cell=0;
		$date_prev_offset=$offset-1;
		for($i = 1; $i <= $offset; $i++) {
			$td_cell++;
			$date_prev=date("d",mktime(0,0,0,$month,($day-$date_prev_offset),$year));
			$calendar .= "<td id=".date("Ymd",strtotime($date_prev))." class='prev-month-date'>".$date_prev."</td>";
			$date_prev_offset--;
		}
		for($day = 1; $day <= $daysInMonth; $day++) {
			$td_cell++;
			if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
				$calendar .= "</tr><tr>";
				$rows++;
			}
			$day_offset=($td_cell%7); //1 saturday 2 sunday
			$class=$day_offset<=1?"alert-danger":"";
			if(isset($holiday[$day])):
				$class="alert-danger holiday";
			endif;
			$day_print=$day;
			if($day<10):
				$day_print="0".$day;
			endif;
			$date_id=date("Ymd",mktime(0,0,0,$month,($day),$year));
			$calendar .= "<td id='".$date_curr_id."' data-date='".$year."-".$month."-".$day_print."' class='".$class."'>" . $day ."<a href='#' class='calendar-edit' style='display:none' title='add event'><i class='pull-right icon-plus'></i></a></td>";
		}
		$date_next_offset=0;
		while( ($day + $offset) <= $rows * 7)
		{
			$date_next=date("j",mktime(0,0,0,$month,($day+date_next_offset),$year));
			$date_id=date("Ymd",strtotime($date_next));
			$date_next_offset++;
			$calendar .= "<td id='".$date_id."' class='next-month-date'>".$date_next."</td>";
			$day++;
		}
		$calendar .= "</tr></tbody>";
		$calendar .= "</table>";
		return $calendar;
	}
	
	function show_month_row($month = null, $year = null)
	{
		$arr=$this->get_calendar_holiday($m,$y);
		foreach($arr as $x=>$val):
			$holiday[$val["hari"]]=1;
		endforeach;
			
		$calendar = '';
		if($month == null || $year == null) {
			$month = date('m');
			$year = date('Y');
		}
		$date = mktime(12, 0, 0, $month, 1, $year);
		$daysInMonth = date("t", $date);
		$offset = date("w", $date);
		$rows = 1;
		$prev_month = $month - 1;
		$prev_year = $year;
		if ($month == 1) {
			$prev_month = 12;
			$prev_year = $year-1;
		}
	 
		$next_month = $month + 1;
		$next_year = $year;
		if ($month == 12) {
			$next_month = 1;
			$next_year = $year + 1;
		}
		$calendar .= "<tr>";
		$td_cell=0;
		$date_prev_offset=$offset-1;
		for($i = 1; $i <= $offset; $i++) {
			$td_cell++;
			$date_prev=date("d",mktime(0,0,0,$month,($day-$date_prev_offset),$year));
			$calendar .= "<td id=".date("Ymd",strtotime($date_prev))." class='prev-month-date'>".$date_prev."</td>";
			$date_prev_offset--;
		}
		for($day = 1; $day <= $daysInMonth; $day++) {
			$td_cell++;
			if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
				$calendar .= "</tr><tr>";
				$rows++;
			}
			$day_offset=($td_cell%7); //1 saturday 2 sunday
			$class=$day_offset<=1?"alert-danger":"";
			if(isset($holiday[$day])):
				$class="alert-danger holiday";
			endif;
			$day_print=$day;
			if($day<10):
				$day_print="0".$day;
			endif;
			$date_id=date("Ymd",mktime(0,0,0,$month,($day),$year));
			$calendar .= "<td id='".$date_curr_id."' data-date='".$year."-".$month."-".$day_print."' class='".$class."'>" . $day ."<a href='#' class='calendar-edit' style='display:none' title='add event'><i class='pull-right icon-plus'></i></a></td>";
		}
		$date_next_offset=0;
		while( ($day + $offset) <= $rows * 7)
		{
			$date_next=date("j",mktime(0,0,0,$month,($day+date_next_offset),$year));
			$date_id=date("Ymd",strtotime($date_next));
			$date_next_offset++;
			$calendar .= "<td id='".$date_id."' class='next-month-date'>".$date_next."</td>";
			$day++;
		}
		$calendar .= "</tr>";
		return $calendar;
	}
	
	
	function get_calendar_holiday($m,$y){
		//$data_search["tahun"]=$y;
		//$data_search["bulan"]=$m;
		$arr=$this->model->SearchRecordWhere("tahun=$y and bulan=$m order by tanggal asc");
		return $arr;
	}
	 

	function add_save(){
        $data=$_POST;
		$this->conn->StartTrans();
		$data["tahun"]=date("Y",strtotime($data["tanggal"]));
		$data["bulan"]=date("m",strtotime($data["tanggal"]));
		$data["hari"]=date("d",strtotime($data["tanggal"]));
		
        $this->model->InsertData($data);
        $ok=$this->conn->CompleteTrans();
        if($ok):
            print "ok";
        else:
            print "not ok";
        endif;
    }
    
    function edit_save(){
        $data=$_POST;
        $id=$data[$this->tbl_idx];
		//$dataOld=$this->model->GetRecord("{$this->tbl_idx}={$id}");
        unset($data["{$this->tbl_idx}"]);
		$this->conn->StartTrans();
        $this->model->UpdateData($data,"{$this->tbl_idx}={$id}");
        $ok=$this->conn->CompleteTrans();
        if($ok):
            print "ok";
        else:
            print "not ok";
        endif;
    }
	
	function delete_save($id){
		$this->msg_ok="Data deleted successfully";
        $this->msg_fail="Unable to delete data";
		
		$this->conn->StartTrans();
		$dataOld=$this->model->GetRecordData("{$this->tbl_idx}='{$id}'");
		$this->model->DeleteData("{$this->tbl_idx}='{$id}'");
		$ok=$this->conn->CompleteTrans();
		//$this->_proses_message($ok,$this->module."menu",$this->module."menu");
		if($ok):
            print "ok";
        else:
            print "not ok";
        endif;
	}
	
	
	 function _proses_message($ok,$url_ok=false,$url_error=false){
        $url_ok=$url_ok?$url_ok:$this->module;
        $url_error=$url_error?$url_error:$this->module;
        if(!$this->input->is_ajax_request()):    
            if($ok):
                    set_message("success", $this->msg_ok);
                    redirect($url_ok);
            else:
                    set_message("error",$this->msg_fail);
                    redirect($url_error);
            endif;  
        else:
            if($ok):
                 print "ok";
            else:
                print "failed";
            endif;    
        endif;
    }
    
    function _render_page($view, $data=null, $render=false)
    {
        $this->viewdata = (empty($data)) ? $this->data: $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if($render):
            $datam["acc_active"]=$this->acc_active;
            $datam["content"]=$view_html;
            $this->load->view($this->admin_layout,$datam);
        endif;
        //if (!$render) return $view_html;
    }
    
    function _prepare_ip($ip_address) {
        if ($this->db->platform() === 'postgre' || $this->db->platform() === 'sqlsrv' || $this->db->platform() === 'mssql')
        {
            return $ip_address;
        }
        else
        {
            return inet_pton($ip_address);
        }
       
    }
	
	/* UPLOAD */
	
	function upload_data(){
		$this->_render_page($this->module."upload",$data,true);	
	}
	
	function upload_progress(){
		$data_excel=$this->xls2array_simple();
		$this->save2db($data_excel);
	}
	
	function save2db($arrData){
		if(cek_array($arrData)):
			$this->conn->StartTrans();
			foreach($arrData as $x=>$val):
				array_map("trim",$val);
				$dataInsert=$val;
				$hari=$val["hari"]*1;
				$bulan=$val["bulan"]*1;
				$tahun=$val["tahun"]*1;
				
				if(!$hari) continue;
				if(!bulan) continue;
				if(!tahun) continue;
					
				
				$arrFound=$this->model->SearchRecordWhere("tahun=$tahun and bulan=$bulan and hari=$hari");
				if(!cek_array($arrFound)):
					$this->model->InsertData($dataInsert);
				else:
					$this->model->UpdateData($dataInsert,"tahun=$tahun and bulan=$bulan and hari=$hari");
				endif;
			endforeach;
			 $this->conn->CompleteTrans();
		endif;
	}
	
	
	function download_template(){
		$this->load->helper("download");
		$excel_content=file_get_contents(APPROOT."/docs/template/kalender_nasional.xlsx");
		$name="kalender_nasional_".date("Y")."_tpl_".date("YmdHis").".xlsx";
		
		force_download($name,$excel_content);
	}
	
	function do_upload(){
		$uploadPath="docs/calendar/";
		check_folder($uploadPath);
		
		$config['upload_path'] = $uploadPath;
    	$config['allowed_types'] = "xls|xlsx";
        $this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()):
     		print $this->upload->display_errors();
		else:
			$tmpName=basename($_FILES["userfile"]["tmp_name"]);
			$data=$this->upload->data();
			$data["file_temp"]=$tmpName;
			$this->conn->StartTrans();
			$this->upload_progress();
            $ok=$this->conn->CompleteTrans();
		endif;
        $this->msg_ok="Data upload successfully";
        $this->msg_fail="Unable to upload data";
        $this->_proses_message($ok,$this->module."upload",$this->module."upload");
	}
	
	
	function xls2array_simple($fullname=""){
        $col_def=array("tahun","bulan","hari","name","keterangan");
        $this->load->library("excel");
        $excelReader = PHPExcel_IOFactory::createReader('Excel2007'); 
        
        if($fullname==""):
            $fullname="docs/calendar/kalender_nasional.xlsx";
        endif;
        $file_path=$fullname;
        $excelReader->setReadDataOnly(true);
        $excel = $excelReader->load($file_path);
        
       $arrData=$excel->getSheet("0")->toArray();
       //pre($arrData);
       //get header
       if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $strval=join("",$val);
                if($strval=='12345'):
                    $iDat=$x+1;
                    $iHead=$x-1;
                    $dataHeader=$arrData[$x-1];
                endif;
            endforeach;
       endif;
       //pre($header);
       
       $empty_data=0;
       $error_data=array();
       for($i=$iDat;$i<count($arrData);$i++):
                $data_tmp=array();
                $rowData=array();
                foreach($arrData[$i] as $collVal):
                    if(mb_detect_encoding($collVal)=="UTF-8"):
                        $collVal=preg_replace("/(\xC2\xA0|&nbsp;)/"," ",$collVal);
                        $collVal=trim(iconv("UTF-8","CP1252",$collVal));
                    endif;
                    
                    $rowData[]=trim($collVal);
                endforeach;
                $data_tmp=array_combine($col_def,$rowData);
                $d=trim($data_tmp["hari"])*1; 
                $m=trim($data_tmp["bulan"])*1;
                $y=trim($data_tmp["tahun"])*1;
                $ck_date=($d.$m.$y)*1;
                //pre($ck_date);
                $empty_data++;
                //$ck_data=array_map("trim",$data_tmp);
                //pre($ck_data);
                if($ck_date!=0):
                    $tgl=date("Y-m-d",mktime(0,0,0,$m,$d,$y));
                else:
                    $empty_data++;
                    $error_data[]=$data_tmp;    
                    $tgl=NULL;
                endif;
                $data_tmp["tanggal"]=$tgl;
                
                if(count($error_data)>=5):
                    break;
                endif;
                
                $dataData[]=$data_tmp;
                
           endfor;
           return $dataData;
    }

    
	
}