<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class Admin_Controller extends MY_Controller
{
    function __construct()
    {
		parent::__construct();
		/*
		$this->load->library('ion_auth');
    	if (!$this->ion_auth->logged_in())
		{
			//$this->session->set_flashdata('message', 'You must be an admin to view this page');
			//redirect them to the login page
			redirect('admin/auth/login', 'refresh');
		}
		else{
			$obj=$this->ion_auth->user()->result_array();
			$arr=(array)$obj;
			$this->data['users']["user"] =$arr[0]; 
			$this->data['users']["groups"]=$this->ion_auth->get_users_groups($arr["id"])->result_array();
		}
		*/
		
		
		if(!$this->lauth->logged_in()):
			redirect("login/");
		else:
			$this->data["users"]["user"]=$_SESSION[$this->lauth->get_appname()]["userdata"];
			//$this->data["users"]["group"]=$this->lauth->get_groupdata();
			$arrGroup=$this->lauth->get_groupdata();
			$this->data["users"]["groups"]=$arrGroup;
		endif;
		
		$this->load->library("cms");
		$this->load->model("user/user_model");
        $this->user_model=$this->user_model;
		$this->cms->init();
		
		//$this->load->model("admin/messaging_model");
        //$this->model=$this->messaging_model;
		
		//$this->get_unread_message();
		
		$this->encrypt_status=FALSE;
		if($this->config->item("encrypt_id_enable")):
			$this->encrypt_status=TRUE;
		endif;
		
		$this->main_layout="admin_lte_layout/main_layout";
		 //$this->load->library("Hrms");
		
	}
	
	function get_unread_message($forder=0,$limit=5,$page=1){
		//debug();
		$myname = $this->data['users']['user']['username'];
		$filter = "message_user='".$myname."' and status=1";
		$order = "ORDER BY waktu DESC";
		$this->list_unread_message=$this->model->new_list($filter);
		
		$filter = "message_user='".$myname."' and status=1";
		$new_message = false;
		$new_message = $this->model->user_new_message($filter);
		$this->num_unread_message = count($new_message);
		//$this->get_unread_message=$this->link_model->search_by_category(9,5,0);
	}
	function text_unread_message($forder=0,$limit=5,$page=1){
		$this->get_unread_message();
		echo $this->num_unread_message;
	}
	 function get_lookup_kebakaran(){
        $filter=" n_status=1";
        $arrData=$this->user_model->m_kebakaran($filter);
        
        return $arrData;
    } 
    function get_name_kebakaran($id){
        $filter=" id='".$id."' AND n_status=1";
        $arrData=$this->user_model->m_kebakaran($filter);

        return $arrData[0];
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
    function get_name_provinsi($prop){
    	$filter=" kode_prop='".$prop."' AND level=0";
        $arrData=$this->user_model->m_provinsi($filter);

        return $arrData[0];
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
    function get_name_kabupaten($prop,$kab){
    	$filter=" kode_prop='".$prop."' AND kode_kab='".$kab."'";
        $arrData=$this->user_model->m_kabupaten($filter);
        // pre($arrData);
       
        // pre($arrCat);
        return $arrData[0];
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
        $data_layout["content"]=$this->load->view("master_data/wilayah/v_select",$data,true);
        // pre($data_layout["content"]);
		if ($arrCat){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        exit;
        // return $arrCat;
    }
     function get_lookup_sektor($propinsi,$kabupaten){

    	$filter=" propinsi='".$propinsi."' AND kabupaten='".$kabupaten."'";
    	// pre($propinsi);
    	// pre($kabupaten);
        $arrData=$this->user_model->m_sektor($filter);
        // pre($arrData);
        // if(cek_array($arrData)):
        //     foreach($arrData as $x=>$val):
        //         $arrCat[$x]['kode_kab']=$val["kode_kab"];
        //         $arrCat[$x]['nama']=$val["nama"];
        //     endforeach;
        // endif;
        // pre($arrCat);
        // $data['data']=$arrData;
        // pre($data);
  //       $data_layout["content"]=$this->load->view("sarpras/v_select",$data,true);
  //       // pre($data_layout["content"]);
		// if ($arrData){
  //           print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
  //       }else{
  //           print json_encode(array('status'=>false));
  //       }
        // exit;
        return $arrData;
    }
    function get_lookup_sektorAjax($propinsi,$kabupaten){

    	$filter=" propinsi='".$propinsi."' AND kabupaten='".$kabupaten."'";
    	// pre($propinsi);
    	// pre($kabupaten);
        $arrData=$this->user_model->m_sektor($filter);
        // pre($arrData);
        // if(cek_array($arrData)):
        //     foreach($arrData as $x=>$val):
        //         $arrCat[$x]['kode_kab']=$val["kode_kab"];
        //         $arrCat[$x]['nama']=$val["nama"];
        //     endforeach;
        // endif;
        // pre($arrCat);
        $data['data']=$arrData;
        // pre($data);
        $data_layout["content"]=$this->load->view("sarpras/v_select",$data,true);
        // pre($data_layout["content"]);
		if ($arrData){
            print json_encode(array('status'=>true, 'data'=>$data_layout["content"]));
        }else{
            print json_encode(array('status'=>false));
        }
        exit;
        // return $arrCat;
    }
    function get_lookup_skpdAjax($id){

    	$filter=" id='".$id."'";
    	// pre($propinsi);
    	// pre($kabupaten);
        $arrData=$this->user_model->m_sektor($filter);
        // pre($arrData);
        // if(cek_array($arrData)):
        //     foreach($arrData as $x=>$val):
        //         $arrCat[$x]['kode_kab']=$val["kode_kab"];
        //         $arrCat[$x]['nama']=$val["nama"];
        //     endforeach;
        // endif;
        // pre($arrData);
        $data['data']=$arrData;
        // pre($data);
        // $data_layout["content"]=$this->load->view("sarpras/v_select",$data,true);
        // pre($data_layout["content"]);
		if ($arrData){
            print json_encode(array('status'=>true, 'data'=>$arrData[0]['skpd']));
        }else{
            print json_encode(array('status'=>false));
        }
        exit;
        // return $arrCat;
    }
}