<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wg extends MY_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="wg/";
		$this->module=$this->folder."wg/";
        $this->http_ref=base_url().$this->module;
        $this->load->helper(array('form', 'url','file'));
        $this->load->model("user/wg_model");
		$this->load->model("user/pp_model");
        $this->model=$this->wg_model;
		$this->model=new wg_model();
		//$this->load->library("utils");
	}
	
    
	function get_visitor_counter($render=TRUE,$regenerate_session=FALSE){
	    if($regenerate_session):
            session_regenerate_id();
        endif;    
	    $ses_id=session_id();
        
        if(!isset($_SESSION["user"]["session_id"])):
            $_SESSION["user"]["session_id"]=0;
            $ses_id2=0;
        else:
            $ses_id2=$_SESSION["user"]["session_id"];
        endif;
        $view_data=$render?FALSE:TRUE;
        $total=$this->conn->GetOne("select total from ".$this->model->tbl_visitor_counter);
        $this->conn->StartTrans();    
        if(($ses_id2!=$ses_id)||(empty($total))):
            $_SESSION["user"]["session_id"]=$ses_id;
            $total=empty($total)?1:$total+1;
            if($total==1):
                $dataInsert["total"]=1;
                $this->adodbx->Insert($this->model->tbl_visitor_counter, $dataInsert);
            endif;
            if($total>1):
                $dataUpdate["total"]=$total;
                $this->adodbx->Update($this->model->tbl_visitor_counter, $dataUpdate,"1=1");
            endif;
        endif;
        $ok=$this->conn->CompleteTrans();
        if($ok):
            $data["total"]=$total;
        else:
            $data["total"]=0;
        endif;
        
        if($render):
             $this->load->view($this->module."visitor_counter",$data,$view_data);
        else:
            if(!$this->input->is_ajax_request()):
             return $data;
            else:
               echo json_encode($data);
            endif;
        endif;    	
	}

    // $t_check in secs so default is 3 minutes
    function get_visitor_online($render=TRUE,$regenerate_session=FALSE,$t_check=180){
        if($regenerate_session):
            session_regenerate_id();
        endif;    
        $access_time=time();
        $time_check=$access_time-$t_check;
        $sess_id=session_id();
        $this->conn->StartTrans();
        //delete data < time check
        $dataUpdate1["active"]=0;
        $this->adodbx->Update($this->model->tbl_visitor_online, $dataUpdate1,"access_time<$time_check");
        
        $found= $this->conn->GetOne("select count(active) as total from cms_visitor_online where active=1 and session='{$sess_id}'");
        if($found==0):
            $data["access_time"]=$access_time;
            $data["session"]=$sess_id;
            $data["active"]=1;
            $data=$this->_add_ip_address($data);
            $data=$this->_add_editor($data);
            $this->adodbx->Insert($this->model->tbl_visitor_online, $data);
        endif;
        if($found>0):
            $dataUpdate["access_time"]=$access_time;
            $dataUpdate["active"]=1;
            $dataUpdate=$this->_add_ip_address($dataUpdate);
            $dataUpdate=$this->_add_editor($dataUpdate);
            $this->adodbx->Update($this->model->tbl_visitor_online, $dataUpdate,"session='{$sess_id}' and active=1");
        endif;
        
        $total=$this->conn->GetOne("select count(*) as total from cms_visitor_online where access_time>$time_check");
        $ok=$this->conn->CompleteTrans();
        if($ok):
            $dataRet["total"]=$total;
        else:
            $dataRet["total"]=0;
        endif;
            
        if($render):
            $this->load->view($this->module."visitor_online",$dataRet,$view_data);
        else:
            if(!$this->input->is_ajax_request()):
            return $dataRet;
        else:
            echo json_encode($dataRet);
        endif;
            endif;  
        
    }

}