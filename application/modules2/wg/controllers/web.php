<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class web  extends CI_Controller {

    function __construct(){
        parent::__construct();
        
        $this->folder="wg/";
		$this->module_name="admin";
		$this->module=$this->folder."web/";
		$this->http_ref=base_url().$this->module;
		
		$this->load->model("user/pg_model","pg_model");
		$this->load->model("user/link_manager_model","link_model");
		
		//$this->load->model("dip/dip_model","dip_model");
		//$this->load->model("dip/req_model","req_model");
		
		$this->load->library("user_agent");
		$this->load->library("utils");
		$this->load->library("rssparser");
	}
	
	function index(){
		
	}
	
	function brwa_kepengurusan() {
		$this->load->view("wg/web/brwa_kepengurusan",$data);
	}
	function social_share($title=false,$pt=false) {
		$data['data_title']=$title;
		$data['page_title']=$pt;
		$this->load->view("wg/web/social_share",$data);
	}
	function social_ftg($title=false,$pt=false) {
		$data['data_title']=$title;
		$data['page_title']=$pt;
		$this->load->view("wg/web/social_ftg",$data);
	}
	function brwa_rss($title=0,$limit=3,$page=1){
		$filter="status=1 and (category=1015)";
		
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_pages",$filter,$limit,0," order by idx desc ");
    	
		if (is_array($arrDB)) {
			$arr=array();
			foreach($arrDB as $k=>$v) {
				$arr = array_merge($arr,$this->rss_parse($v['clip'],$v['title']));
			}
			foreach($arr as $k=>$v) {
				$rss[strtotime($v['pubDate'])]=$v;
			}
		}
		krsort($rss,SORT_NUMERIC);
		$data["title"]=$title;
		$data['rss']=$rss;
		$this->load->view("wg/web/brwa_rss",$data);
	}
	function rss_parse($url,$title=false) {
		$this->rssparser->set_feed_url($url);  // get feed
		//$this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
		$rss = $this->rssparser->getFeed(3);
		if ($rss) {
			foreach($rss as $k=>$v) {
				$v['src']=$title;
				$time = strtotime(substr($v['pubDate'],4,-6));
				$arr[$time]=$v;
			}
		}
		return $arr;
	}
	function brwa_stats(){
		$sql = "SELECT count(idx) as total,(
				CASE 
					WHEN (wa_status=1) 
					THEN 'Teregistrasi' 
					WHEN (wa_status=2) 
					THEN 'Terverifikasi' 
					WHEN (wa_status=3) 
					THEN 'Tersertifikasi' 
					ELSE 'In Progress'  
				END
				) AS wa_status
				FROM 
					v_wa_data
				GROUP BY 
					wa_status";
		// $sql = "SELECT * FROM (SELECT count(idx) as total,(
				// CASE 
					// WHEN (doc_proses=1 and doc_status=4 and wa_data_status!= 99) 
					// THEN 'Teregistrasi' 
					// WHEN (doc_proses=2 and doc_status=5 and wa_data_status != 99) 
					// THEN 'Terverifikasi' 
					// WHEN (doc_proses=3 and doc_status=2 and wa_data_status!=99)
					// THEN 'Tersertifikasi' 
					
				// END
				// ) AS wa_status
				// FROM 
					// v_wa_data
				// GROUP BY 
					// doc_proses,doc_status,wa_data_status) stats GROUP BY wa_status";
		$arrData = $this->conn->GetAll($sql);	
		// pre($arrData);exit;
		if (cek_array($arrData)) {
			foreach($arrData as $k=>$v) {
				$stats[]='["'.$v['wa_status'].'",'.$v['total']."]";
			}
			if (cek_array($stats)) $data['wa_stats']=implode(",",$stats);
			$this->load->view("wg/web/brwa_stats",$data);
		} 
		
		
	}
	function brwa_stats2(){
		$sql = "select doc_proses,doc_status from v_wa_data order by doc_proses, doc_status";
		$arrData = $this->conn->GetAll($sql);	
		if (cek_array($arrData)) {
			foreach($arrData as $k=>$v) {
				if ($v['doc_proses']==1) {
					$status_badges = '<span class="label label-warning">Teregistrasi</span>';
					if ($v['doc_status']==4) {
						$arr['Teregistrasi']+=1;
					}
					else {
						$arr['Registrasi']+=1;
					}
				}
				else if ($v['doc_proses']==2) {
					if ($v['doc_status']==4) {
						$arr['Terverifikasi']+=1;
					}
					else {
						$arr['Teregistrasi']+=1;
					}
				}
				else if ($v['doc_proses']==3) {
					if ($v['doc_status']==4) {
						$arr['Tersertifikasi']+=1;
					}
					else {
						$arr['Terverifikasi']+=1;
					}
				}
				
				//$arr[$m_jenis[$v['doc_proses']]]=$v['total'];
				//$stats[]='["'.($m_jenis[$v['doc_proses']]).'",'.$v['total']."]";
			}
			//pre ($arr);
			if (cek_array($arr)) {
				foreach($arr as $k=>$v) {
					$stats[]='["'.$k.'",'.$v."]";
				}
			}
		} 
		if (cek_array($stats)) $data['wa_stats']=implode(",",$stats);
		$this->load->view("wg/web/brwa_stats",$data);
	}
	function brwa_wa(){
		$this->load->view("wg/web/brwa_wa",$data);
	}
	function brwa_prosedur(){
		$this->load->view("wg/web/brwa_prosedur",$data);
	}
	function brwa_banner(){
		$this->load->view("wg/web/brwa_banner",$data);
	}
	
    function news_pages($title=true,$idx=false,$limit=5){
		$filter=($idx)?"idx!=".$idx." and ":"";
		$filter.="status=1 and (category=3 or category=2)";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
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
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		//$arrDB=$this->pg_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_pages",$filter,5,0," order by idx desc ");
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_news_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
		$data["module"]=$this->module;
		$data["title"]=$title;
		$data["list"]=$arrDB;
        $this->load->view("wg/web/other_list",$data);
   }
   
   
   function article_pages($title=true,$idx=false,$limit=5){
   
		$filter=($idx)?"idx!=".$idx." and ":"";
		$filter.="status=1 and (category=1)";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
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
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		//$arrDB=$this->pg_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_pages",$filter,5,0," order by idx desc ");
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
		$data["module"]=$this->module;
		$data["title"]=$title;
		$data["list"]=$arrDB;
        $this->load->view("wg/web/article_list",$data);
   }
   
   
     
   function right_menu($idx=false,$limit=5){
        $this->load->view("wg/web/right_menu");
   }
   function other_links($cat=9,$limit=5){
   		$filter="active=1 and publish=1";
		
   		$arrDB = $this->adodbx->search_record_by_limit_where("cms_link",$filter,5,0," order by idx ");
   		$data["footer_link_list"]=$arrDB;
        $this->load->view("wg/web/other_links",$data);
   }
   function map($title=false,$w=false,$h=false){
   		$data["title"]=$title;
		$data["width"]=$w;
		$data["height"]=$h;
        $this->load->view("wg/web/map",$data);
   }
   
   /* ADMIN */
   function admin_news_pages($title=true,$idx=false,$limit=5){
		$filter=($idx)?"idx!=".$idx." and ":"";
		$filter.="(category=3 or category=2)";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
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
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		//$arrDB=$this->pg_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model->total_rows_where("cms_pages",$filter);
		$total_comments=$this->model->total_rows_where("cms_comments","category=4");
		$total_published=$this->model->total_rows_where("cms_pages",$filter."and status=1");
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_pages",$filter,5,0," order by idx desc ");
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_news_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
		$data["module"]=$this->module;
		$data["total"]=$total_rows;
		$data["total_comments"]=$total_comments;
		$data["total_published"]=$total_published;
		$data["list"]=$arrDB;
        $this->load->view("wg/web/admin_news_list",$data);
   }
   
   function admin_article_pages($title=true,$idx=false,$limit=5){
   
		$filter=($idx)?"idx!=".$idx." and ":"";
		$filter.="category=1";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
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
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		//$arrDB=$this->pg_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model->total_rows_where("cms_pages",$filter);
		$total_comments=$this->model->total_rows_where("cms_comments","category=1");
		$total_published=$this->model->total_rows_where("cms_pages",$filter."and status=1");
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_pages",$filter,5,0," order by idx desc ");
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
		$data["module"]=$this->module;
		$data["total"]=$total_rows;
		$data["total_comments"]=$total_comments;
		$data["total_published"]=$total_published;
		$data["list"]=$arrDB;
        $this->load->view("wg/web/admin_article_list",$data);
   }
   
   function admin_guestbook($title=true,$idx=false,$limit=15){
   		
		$filter=($idx)?"idx!=".$idx." and ":"";
		//$filter.="category=1";
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "title like '%".$key."%' or clip like '%".$key."%'";
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
			$order = 'order by idx desc';
		}
		//debug();
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		//$arrDB=$this->pg_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$arrDB = $this->adodbx->search_record_by_limit_where("cms_guest_book",$filter,$limit,0," order by idx desc ");
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
		$data["module"]=$this->module;
		$data["title"]=$title;
		$data["list"]=$arrDB;
        $this->load->view("wg/web/admin_gb_list",$data);
   }
   
   function admin_forums($limit=5){
   		
   }
   function admin_links($cat=9,$limit=5){
   		$filter="active=1 and publish=1";
   		$sql=" select a.*,b.category as category_name,c.click_count from cms_link a 
                left join cms_link_category b on a.category=b.idx
				left join cms_link_count c on a.idx=c.id_link";

        $table="($sql) a";
        $totalRows=count($this->adodbx->search_record_where("cms_link"));
		$total_active=count($this->adodbx->search_record_where("cms_link","active=1"));
		$total_published=count($this->adodbx->search_record_where("cms_link","publish=1"));

        $sortBy=" order by idx desc";
   		$arrDB = $this->adodbx->search_record_by_limit_where($table,$filter,$limit,0,$sortBy);
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,5);
			}
		}
   		$data["list"]=$arrDB;
		$data["total"]=$totalRows;
		$data["total_published"]=$total_published;
		$data["total_active"]=$total_active;
        $this->load->view("wg/web/admin_link_list",$data);
   }
}	
