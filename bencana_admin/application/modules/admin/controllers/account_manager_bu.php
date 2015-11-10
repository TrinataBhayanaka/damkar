<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_manager extends Admin_Controller {

    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form', 'url','file'));
		$this->load->helper("lookup");
    	$this->folder="admin/";
		$this->module=$this->folder."account_manager/";
        $this->http_ref=base_url().$this->module;
		
		$this->lang->load('auth');
		$this->load->helper('language');
        
        $this->load->helper("menu_helper");
        $this->load->helper("bootstrap_helper");
        $this->load->model("account_manager_model");
        $this->model=$this->account_manager_model;
		
		$this->load->model("skpa_model");
        $this->skpa_model=$this->skpa_model;
		$this->module_title="Account Manager";
		$this->module_titles="User";
		$this->module_titless="Group";
		//$this->listText="Ikan";
		$this->acc_active="account_manager";
		$this->tbl_idx="id";
		//komeng added
		$this->my_logged_data = $this->data['users']['user'];	
		
		$this->admin_layout="admin_lte_layout/main_layout";
		$this->auth_error_page="admin/error_page";
		
    }
    
    function index(){
		$this->user_list();
    }
    
    function user_list(){
  		//if (!$this->cms->has_view($this->module)) redirect ($this->auth_error_page);
		
       	$queryString=rebuild_query_string();
		//debug();
        $q=$this->input->get_post("q");
        $field="username,first_name,last_name,email";
		$whereSql=get_where_from_searchbox($field);
		$arrBread[]=array("text"=>"".$this->listText."","url"=>"");
        $this->load->library('pagination');  
		$perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"25";
        $data["perPage"]=$perPage;
        $uriSegment=4;
        $totalRows=count($this->model->SearchRecordWhere($whereSql));
		$offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
		$sortBy=" order by username";
		$arrData=$this->model->SearchRecordLimitWhere($whereSql,$perPage,$offset,$sortBy);
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
		$data['group_brwa']=$this->model->masterGroup_get();
		$data["m_skpa"]=$this->get_lookup_skpa(false);
        $datam["arrBread"]=$arrBread;
		$datam["acc_active"]=$this->acc_active;
        $datam["content"]=$this->load->view($this->module."user_list2",$data,true);
        //$this->load->view("main_layout",$datam);
		$this->load->view($this->admin_layout,$datam);
        
        
    }
    
    /*
    function user_add(){
  		if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);

        $arrBread[]=array("text"=>$this->listText,"url"=>"{$this->http_ref}");
        $arrBread[]=array("text"=>"Add Data","url"=>"");
        $datam["arrBread"]=$arrBread;
		
		$datam["content"]=$this->load->view($this->module."user_add",'',true);
        //$this->load->view("main_layout",$datam);
		$this->load->view($this->admin_layout,$datam);
        
    }*/
	function get_lookup_skpa($pilih=true){
        $arrData=$this->skpa_model->search_record(false," order by id" );
        if ($pilih) $arrCat=array(""=>"--Pilih--");
        if(cek_array($arrData)):
            foreach($arrData as $x=>$val):
                $arrCat[$val["id"]]=$val["name"];
            endforeach;
        endif; 
        return $arrCat;
    }
    
    function user_add(){
        //if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		// debug();
        $this->msg_ok="User created successfully";
        $this->msg_fail="Unable to create new User";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
			//$skpa = $this->get_lookup_skpa();
            //$data['m_skpa']=$skpa;
            $this->_render_page($this->module."user_add2",$data,true);
        endif;
        
        if($act=="create"):
            $ok=$this->user_add_save();
            $this->_proses_message($ok,$this->module."user_list/",$this->module."user_add/");
        endif;
    }
    
    function user_add_save(){
            //debug();
			// $email    = strtolower($this->input->post('email'));
            // $username    = strtolower($this->input->post('username'));
            // $password = $this->input->post('password');
		$pass = b64encode($this->input->post('password'));
            $add_data = array(
                'email' => $this->input->post('email'),
                'username'  => $this->input->post('username'),
                'password'      =>$pass,
				'group_brwa'      => $this->input->post("groups"),
				'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'phone'      => $this->input->post('phone'),
				'company'    => $this->input->post('company'),
                'nomor_induk'    => $this->input->post('nomor_induk'),
				'id_propinsi'    => $this->input->post('id_propinsi')
            );
			$data['query'] = $this->account_manager_model->users_add($add_data); 
			redirect('admin/account_manager');
            //$groups=$this->input->post("groups");
            
        // $ok=$this->ion_auth->register($username, $password, $email, $additional_data);

         // if(!$this->input->is_ajax_request()):
            // if($ok):
                // $groupData = $this->input->post('groups');
                // $id=$ok;
                // if (isset($groupData) && !empty($groupData)) {
    
                    // $this->ion_auth->remove_from_group('', $id);
    
                    // foreach ($groupData as $grp) {
                       // $this->ion_auth->add_to_group($grp, $id);
                    // }
    
                // }
            // endif;
            // return $ok;      
        // else:
                
            // if($ok):
                // $groupData = $this->input->post('groups');
                // $id=$ok;
                // if (isset($groupData) && !empty($groupData)) {
    
                    // $this->ion_auth->remove_from_group('', $id);
    
                    // foreach ($groupData as $grp) {
                       // $this->ion_auth->add_to_group($grp, $id);
                    // }
    
                // }
                // print "ok";
            // else:
                // print "not ok";
            // endif;
        // endif;
       
    }
    
	
    /*
    function user_edit($id=false){
  		if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);

        if(!$id){
            $id=$_POST["id"];
        }
        
        $myData=$this->model->GetRecordData("id='{$id}'");
        $data["data"]=$myData;
        
        $arrBread[]=array("text"=>$this->listText,"url"=>"$this->http_ref");
        $arrBread[]=array("text"=>"Edit","url"=>"");
        $datam["arrBread"]=$arrBread;
        $datam["content"]=$this->load->view($this->module."user_edit",$data,true);
        //$this->load->view("main_layout",$datam);
		$this->load->view($this->admin_layout,$datam);
        
    }
     */
     
    function user_edit($id){
        //if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		//debug();
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
        $this->msg_ok="User updated successfully";
        $this->msg_fail="Unable to update user";
        $data['group_brwa']=$this->model->masterGroup_get();
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model->GetRecordData("id=$id");
			// pre($arrData);exit;
            $data["data"]=$arrData;
			// $skpa = $this->get_lookup_skpa();
            // $data['m_skpa']=$skpa;
            $this->_render_page($this->module."user_edit2",$data,true);
        endif;
        if($act=="update"):
            //$this->conn->StartTrans();
            $ok=$this->user_edit_save($id_enc);
            $this->_proses_message($ok,$this->module."user_list",$this->module."user_edit/$id_enc");
        endif;
            
    } 
    
     function user_edit_save($id){
        //debug();
		$id=$this->uri->segment(4);  		
		
        // $user = $this->ion_auth->user($id)->row();
        // $groups=$this->ion_auth->groups()->result_array();
        // $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        
        $add_data = array(
                'username' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'company'    => $this->input->post('company'),
                'nomor_induk'    => $this->input->post('nomor_induk'),
                'phone'      => $this->input->post('phone'),
				'id'      => $id,
				'group_brwa'      => $this->input->post("groups"),
				'id_propinsi'    => $this->input->post('id_propinsi')
        );

            //Update the groups user belongs to
            // $groupData = $this->input->post('groups');

            // if (isset($groupData) && !empty($groupData)) {

                // $this->ion_auth->remove_from_group('', $id);

                // foreach ($groupData as $grp) {
                    // $this->ion_auth->add_to_group($grp, $id);
                // }

            // }

            //update the password if it was posted
            if ($this->input->post('password'))
            {
                $add_data['password'] = b64encode($this->input->post('password'));
            }
			$ok=$this->account_manager_model->users_update($add_data); 
			redirect('admin/account_manager');
             // $ok=$this->ion_auth->update($user->id, $data);
        
        // if(!$this->input->is_ajax_request()):
            // return $ok;      
        // else:
                
            // if($ok):
                // print "ok";
            // else:
                // print "not ok";
            // endif;
        // endif;
    }
    

    function user_view($id=false){
        if(!$id){
            $id=$_POST["id"];
        }
        
        $myData=$this->model->GetRecordData("id='{$id}'");
        if(cek_array($myData)):
            $myData["groups"]=(array) $this->ion_auth->get_users_groups($myData["id"])->result_array();
        endif;
        $data["data"]=$myData;
        
        
        
        $arrBread[]=array("text"=>$this->listText,"url"=>"$this->http_ref");
        $arrBread[]=array("text"=>"View","url"=>"");
        $datam["arrBread"]=$arrBread;
        
        $datam["content"]=$this->load->view($this->module."user_view",$data,true);
        //$this->load->view("main_layout",$datam);
		$this->load->view($this->admin_layout,$datam);
        
    }
	
	/*
    function user_delete(){
  		if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);

        $arrBread[]=array("text"=>$this->listText,"url"=>"$this->http_ref");
        $arrBread[]=array("text"=>"Delete","url"=>"");
        $datam["arrBread"]=$arrBread;
        $chk=$_POST["chk"];
        $idxCols=implode(",",$chk);
        $data["data"]=$this->model->SearchRecordWhere(" id in ($idxCols) ");
        
        $datam["content"]=$this->load->view($this->module."user_delete",$data,true);
        //$this->load->view("main_layout",$datam);
		$this->load->view($this->admin_layout,$datam);
        
    }*/
    
     function user_delete($id){
        //if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
        // $this->msg_ok="User deleted successfully";
        // $this->msg_fail="Unable to delete user";
        
        //$act=$this->input->post("act")?$this->input->post("act"):"";    
        // if(empty($act)):
            // $arrData=$this->model->GetRecordData("id=$id");
            // $data["data"]=$arrData;
            // $this->_render_page($this->module."user_delete2",$data,true);
        // endif;
        //if($act=="delete"):
           $ok=$this->user_delete_save($id);
		   if ($ok) {
				$data["delete"]=true;
				//set_message("error","News Deleted.");
				redirect("admin/account_manager/");
			}
           // $this->_proses_message($ok,$this->module."user_list",$this->module."user_delete/$id");
			//$this->_render_page($this->module."user_delete2",$data,true);
		//endif;
    }
    
    function user_delete_save($id){
        $ok=$this->ion_auth->delete_user($id);
        return $ok;    
    }
    
    
    /*
    function user_delete_save(){
        $data=$_POST;
        $chk=$data["chk"];
        foreach($chk as $x=>$value):
            $idx=$value;
            $ok=$this->ion_auth->delete_user($idx);
            if(!$ok):
                break;
            endif;
        endforeach;
         if(!$this->input->is_ajax_request()):
            return $ok;      
        else:
                
            if($ok):
                print "ok";
            else:
                print "not ok";
            endif;
        endif;
        
    }*/
    
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
    
    
    //group
    
    function group_list(){
     //   if (!$this->cms->has_view($this->module)) redirect ($this->auth_error_page);
        $this->load->library('pagination');  
            
        $queryString=rebuild_query_string();
        
        $field="name,description";
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
        
        $whereSql="";
        
        if(cek_array($where)):
            $whereSql.=join(" and ",$where);
        endif;
        
        $perPage=$this->input->get_post("pp")?$this->input->get_post("pp"):"25";
        $data["perPage"]=$perPage;
       //$this->model= new account_manager_model();
        $uriSegment=4;
        $totalRows=count($this->model->group_search_record($whereSql));
        $offset=$totalRows>$perPage?(int)$this->uri->segment($uriSegment):0;
        $sortBy=" order by id";
        
        $arrData=$this->adodbx->search_record_by_limit_where($this->model->tbl_group,$whereSql,$perPage,$offset,$sortBy);
        
        $config['base_url'] = $this->module."group_list";  
        $config['per_page'] = $perPage;  
        $config['total_rows'] = $totalRows;
        $config['uri_segment'] = $uriSegment;
        $config["suffix"]=$queryString;
        $config["first_url"]=$config["base_url"].$queryString;
        //$config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        
        $data["arrData"]=$arrData;
        
        
        //$arrData=$this->model->group_search_record_where(false," order by id ");
        //$data["arrData"]=$arrData;
        $this->_render_page($this->module."group_list",$data,true);
    
    }
    
    function group_add(){
        // if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);

        $this->msg_ok="Group created successfully";
        $this->msg_fail="Unable to create new Group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $data=null;
            $this->_render_page($this->module."group_add",$data,true);
        endif;
        //debug();
        if($act=="create"):
            $this->conn->StartTrans();
            $data=get_post();
            $data=array_map("trim",$data);
            $data=$this->_add_creator($data);
            $this->model->group_add($data);
            $ok=$this->conn->CompleteTrans();
           
            $this->_proses_message($ok,$this->module."group_list/",$this->module."group_add/");
        endif;
    }
    
    
     function group_edit($id){
        // if (!$this->cms->has_write($this->module)) redirect ($this->auth_error_page);
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
        $this->msg_ok="Group updated successfully";
        $this->msg_fail="Unable to update group";
        
        $act=$this->input->post("act")?$this->input->post("act"):"";    
        if(empty($act)):
            $arrData=$this->model->group_get("id=$id");
            $data["data"]=$arrData;
            $this->_render_page($this->module."group_edit",$data,true);
        endif;
        if($act=="update"):
            $this->conn->StartTrans();
            $data=get_post();
            unset($data["idx"]);
            $data=array_map("trim",$data);
            $data=$this->_add_editor($data);
            $this->model->group_update($data, "id=$id_enc");
            $ok=$this->conn->CompleteTrans();
            $this->_proses_message($ok,$this->module."group_list",$this->module."group_edit/$id");
        endif;
            
    }
    
    function group_delete($id){
        // if (!$this->cms->has_admin($this->module)) redirect ($this->auth_error_page);
		if($this->encrypt_status==TRUE):
			$id_enc=$id;
			$id=decrypt($id);
		endif;
            $this->conn->StartTrans();
            $this->model->group_delete("id=$id");
            $ok=$this->conn->CompleteTrans();
			redirect("admin/account_manager/group_list/");
    }
    
    
    function _proses_message($ok,$url_ok=false,$url_error=false){
        $url_ok=$url_ok?$url_ok:$this->module;
		// pre();exit;
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
            $this->load->view("admin_lte_layout/main_layout",$datam);
        endif;
        //if (!$render) return $view_html;
    }
    
    
    
    
}

/* End of file ikan.php */
/* Location: ./application/controllers/master//ikan.php*/