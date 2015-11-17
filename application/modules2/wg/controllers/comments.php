<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="wg/";
		$this->module_name="admin";
		$this->module=$this->folder."comments/";
		$this->http_ref=base_url().$this->module;
		$this->load->model("user/comments_model","model");
		$this->load->library("user_agent");
	}
	
	function index(){
		
	}
	
	 /* comments */
   function comments_add($post_id=false,$category=false){
       if(!$post_id):
           $post_id=$this->input->get_post("post_id");
       endif;
       if(!$category):
           $category=$this->input->category("category");
       endif;
       $data_comment["category"]=$category;
       $data_comment["post_id"]=$post_id;
       
       $data["data_comment"]=$data_comment;    
       $this->load->view($this->module."add",$data);
   }
   
   function comments_add_save($post_id=false,$category=false){
   
   		$is_valid=validate_key($this->input->get_post("token"));
        if(!$is_valid):
			
            if ($this->agent->is_referral()):
               //echo $this->agent->referrer();
               set_message("error","Your form has expired, reload page and then submit again");
               redirect ($this->agent->referrer());
            else:
                redirect($this->module."doc_add");
           endif;
           exit();
        endif;
		
   		if(!$post_id):
           $post_id=$this->input->get_post("post_id");
       endif;
	    if(!$category):
           $category=$this->input->get_post("category");
       endif;
	   $data=get_post();
	   $this->conn->StartTrans();
       $data["category"]=$category;
       $this->adodbx->Insert("cms_comments", $data);
       $ok=$this->conn->CompleteTrans();
       if($ok):
	   		if(!$this->input->is_ajax_request()):
	   	   		redirect($this->agent->referrer());
		   	else:
				print "ok";
			endif;
       else:
	   		print "failed";
          //print "failed";
       endif;
   }
   
   function comments_list($post_id=false,$category=false){
   	  
	   if(!$post_id):
           $post_id=$this->input->get_post("post_id");
       endif;
	   if(!$category):
           $category=$this->input->get_post("category");
       endif;
       $where[]="category=$category";
       $where[]="post_id=$post_id";
       $whereSql=join(" and ",$where);
       $arrData=$this->adodbx->search_record_where("cms_comments",$whereSql," order by created desc ");
       $data["comment_list"]=$this->_build_comments($arrData);
       $data["arrData"]=$arrData;
       $this->load->view($this->module."list",$data);
   }
   
    function comments_list2($post_id=false,$category=false){
   	  
	   if(!$post_id):
           $post_id=$this->input->get_post("post_id");
       endif;
	   if(!$category):
           $category=$this->input->get_post("category");
       endif;
       $where[]="category=$category";
       $where[]="post_id=$post_id";
       $whereSql=join(" and ",$where);
       $arrData=$this->adodbx->search_record_where("cms_comments",$whereSql," order by idx desc ");
       $data["arrData"]=$arrData;
       $this->load->view("wg/comments/list2",$data);
   }
   
   function comments_reply($idx){
       $row=$this->adodbx->GetRecord("cms_comments","idx=$idx");
       $data["parent"]=$row;
       $data_comment["category"]=$row["category"];
       $data_comment["post_id"]=$row["post_id"];
       $data_comment["parent_id"]=$idx;

       $data["data_comment"]=$data_comment;    
       $this->load->view($this->module."reply",$data);
   }
   
   function comments_reply_save(){
       //debug();    
	    $is_valid=validate_key($this->input->get_post("token"));
        if(!$is_valid):
            if ($this->agent->is_referral()):
               set_message("error","Your form has expired, reload page and then submit again");
               redirect ($this->agent->referrer());
            else:
                redirect($this->module."doc_add");
           endif;
           exit();
        endif;
		
       $data=get_post();
       $this->conn->StartTrans();
       $this->adodbx->Insert("cms_comments", $data);
       $ok=$this->conn->CompleteTrans();
       if($ok):
	   		if(!$this->input->is_ajax_request()):
	   	   		redirect($this->agent->referrer());
		   	else:
				print "ok";
			endif;
       else:
           print "failed";
       endif;
   }
   
    function _build_comments($rows,$parent=0){  
      $result="";
      foreach ($rows as $x=> $row):
        if ($row['parent_id'] == $parent):
            $result .= "<div class='media'>";
            $result.=' <a href="#" class="pull-left">
                    '.image_asset("user.png",'',array("class"=>"avatar media-object","alt"=>"Image","style"=>"width:30px;height:30px;")).'
                </a>';    
            $result.="<div class='media-body'><h4 class='media-heading'>".$row["name"]." <span>".relativeTime($row["created"])."  
            <a href='#' class='comments_reply' data-idx='".$row["idx"]."' data-parent='".$parent."' rel='".$this->module."comments_reply/".$row["idx"]."'>Reply</a>
             </span></h4>
                <div class='comments-body'>{$row['body']}</div><hr>";
                   
            if ($this->_has_children($rows,$row['idx'])):
                $result.= $this->_build_comments($rows,$row['idx']);
            endif;
            $result.= "</div></div>";
        endif;
      //$result="</div></div>";
      endforeach;
      //$result.= "</div>";
      return $result;
    }
    
    function _has_children($rows,$id) {
      foreach ($rows as $row) {
        if ($row['parent_id'] == $id)
          return true;
      }
      return false;
    }
	
	function test_comment(){
		$this->load->view($this->module."list2");
	}
	
	
	
}	
