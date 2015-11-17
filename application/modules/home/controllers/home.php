<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        $this->folder="";
		$this->module=$this->folder."home/";
        $this->http_ref=base_url().$this->module;
        
		$this->load->model("user/pg_model");
        $this->model=$this->pg_model;
		
		$this->load->model("user/link_manager_model");
        $this->link_model=$this->link_manager_model;
			
		$this->load->library("rssparser");
		$this->load->library("utils");
    }
	
	function index(){
		//pre($this->session);
		
		$data["news_list"]=$this->news_list();
		$data["article_list"]=$this->article_list();
		$data["slider_list"]=$this->slider_list();
		$data["partner_list"]=$this->footer_links();
		$data["scroller_list"]=$this->scroller_text();
		
		
		//$data["rss"]=$this->rss_list();
        $datam["content"]=$this->load->view("index",$data,true);
        $this->load->view("layout/main_layout",$datam);
        
	}
	function scroller_text() {
		$sql = "select propinsi,propinsi,doc_proses,doc_status,wa_status from v_wa_data order by doc_proses, doc_status";
		$sql = "SELECT count(idx) as total, propinsi,(
				CASE 
					WHEN (wa_status=0) 
					THEN 'In Progress' 
					WHEN (wa_status=1) 
					THEN 'Teregistrasi' 
					WHEN (wa_status=2) 
					THEN 'Terverifikasi' 
					ELSE 'Tersertifikasi'  
				END
				) AS wa_status
				FROM 
					v_wa_data
				GROUP BY 
					propinsi,wa_status";
		$arrData = $this->conn->GetAll($sql);	
		if (cek_array($arrData)) {
			$arr['Indonesia']['Teregistrasi']=0;
			$arr['Indonesia']['Terverifikasi']=0;
			foreach($arrData as $k=>$v) {
				$arr['Indonesia'][$v['wa_status']]+=$v['total'];
				$arr['Indonesia']['Total']+=$v['total'];
				
				$arr[$v['propinsi']]['Teregistrasi']+=0;
				$arr[$v['propinsi']]['Terverifikasi']+=0;
				$arr[$v['propinsi']]['Tersertifikasi']+=0;
				$arr[$v['propinsi']][$v['wa_status']]+=$v['total'];
				$arr[$v['propinsi']]['Total']+=$v['total'];
			} 
			return $arr;
		} 
	}
	
	function footer_links($cat=1,$limit=10,$offset=0,$order='order by idx desc'){
   		// debug();
		// $filter="category=".$cat." and active=1 and publish=1";
		$filter="active=1 and publish=1";
		$arrDB=$this->link_model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
   		return $arrDB;
   }
	function news_list($forder=0,$limit=2,$page=1){
		$filter="status=1 and (category=3 or category=2)";
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
    	
		$query_url = ($key)?"?q=".$key:"";
		
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_news_image");
			foreach($arrDB as $k=>$v) {
				if (!file_exists($img_dir.$v['image'])) $arrDB[$k]['image'] = "blank.png";
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,8);
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
			}
		}
		return $arrDB;
	}
	
	function article_list($forder=0,$limit=5,$page=1){
		$filter="status=1 and (category=1)";
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
    	
		$query_url = ($key)?"?q=".$key:"";
		
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				if (!file_exists($img_dir.$v['image'])) $arrDB[$k]['image'] = "blank.png";
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,8);
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
			}
		}
		return $arrDB;
	}
	
	function slider_list($forder=0,$limit=3,$page=1){
		$filter="status=1 and category=4";
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
    	
		$query_url = ($key)?"?q=".$key:"";
		
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_pages_image");
			foreach($arrDB as $k=>$v) {
				if (!file_exists($img_dir.$v['image'])) $arrDB[$k]['image'] = "blank.png";
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,8);
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
			}
		}
		return $arrDB;
	}
	function rss_list($forder=0,$limit=3,$page=1){
		$filter="status=1 and (category=1015)";
		$key = ($_GET['q'])?$_GET['q']:0;
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
		$arrDB=$this->model->SearchRecordLimitWhere($filter,$limit,$offset,$order);
    	
		if (cek_array($arrDB)) {
			$arr=array();
			foreach($arrDB as $k=>$v) {
				$arr = array_merge($arr,$this->rss_parse($v['clip'],$v['title']));
			}
		}
		//krsort($arr);
		return $arr;
	}
	function rss_parse($url,$title=false) {
		try {
		$this->rssparser->set_feed_url($url);  // get feed
		//$this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
		$rss = $this->rssparser->getFeed(3);
		if ($rss) {
			foreach($rss as $k=>$v) {
				$v['src']=$title;
				$time = strtotime(substr($v['pubDate'],4,-6));
				$arr[date("d-m-Y h:i",$time)]=$v;
			}
		}
		return $arr;
		} catch (Exception $e) { }
	}
}