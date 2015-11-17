<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stats extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder;
		$this->page_active="stats";
        $this->http_ref=base_url().$this->module;
        
		
		$this->load->model("general_model");
		$this->model=new general_model("wa_data");
		$this->model_view=new general_model("v_wa_data");
		$this->model_contact=new general_model("wa_contact");
		$this->model_hukum_adat=new general_model("wa_hukum_adat");
		$this->model_hayati=new general_model("wa_hayati");
		$this->model_hak_atas_tanah=new general_model("wa_hak_atas_tanah");
		$this->model_sejarah=new general_model("wa_sejarah");
		$this->model_lembaga_adat=new general_model("wa_lembaga_adat");
		$this->model_potensi_hayati=new general_model("wa_potensi_hayati");
		
		//$this->load->model('ion_auth_model')

		$this->load->libraries(array('ion_auth','form_validation','utils'));
		$this->load->helpers(array('form', 'url','lookup','language'));
		$this->lang->load('auth');
		
		$this->user=(array)$this->ion_auth->user()->row();
		$this->tbl_idx="idx";
		
		$this->admin_layout="layout/main_layout";
		
    }
	function get_kab_kota($kd_bps_propinsi="",$arr_id=""){
		$sql="select * from m_kabupaten_kota where kode_prop=$kd_bps_propinsi and kode_kab!='00' order by kode_bps";
		$arrKabKota=$this->conn->GetAll($sql);
		$arrData=array();
		if(cek_array($arrKabKota)):
			foreach($arrKabKota as $x=>$val):
				$arrData[$val["kode_bps"]]=$val["nama"];
			endforeach;
		endif;
		$data["dataKabupaten"]=$arrData;
		$data["arr_id"]=$arr_id;
		echo $this->load->view($this->module."wa/lookup_kabupaten",$data,true);
	}
	function get_data_by_stats($ws=false) {
		$ws_sql = ($ws!==false)? " wa_status='".$ws."'":"";
		$sql = "SELECT * FROM (
					SELECT count(idx) as total, propinsi, (
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
						WHERE
							".$ws_sql."
						GROUP BY 
							propinsi,wa_status
					) stats
				ORDER BY total";
		$arrData = $this->conn->GetAll($sql);	
		pre($arrData);
		
	}
	function view() {
		//$this->get_data_by_stats(1);
		// $sql = "SELECT * FROM (SELECT count(idx) as total, propinsi,(
				// CASE 
					// WHEN (wa_status=0) 
					// THEN 'In Progress' 
					// WHEN (wa_status=1) 
					// THEN 'Teregistrasi' 
					// WHEN (wa_status=2) 
					// THEN 'Terverifikasi' 
					// ELSE 'Tersertifikasi'  
				// END
				// ) AS wa_status
				// FROM 
					// v_wa_data
				// GROUP BY 
					// propinsi,wa_status) stats ORDER BY total desc";
		$sql = "SELECT * FROM (SELECT count(idx) as total, propinsi,(
				CASE 
					WHEN (doc_proses=1 and doc_status=4 and wa_data_status!= 99) 
					THEN 'Teregistrasi' 
					WHEN (doc_proses=2 and doc_status=5 and wa_data_status != 99) 
					THEN 'Terverifikasi' 
					WHEN (doc_proses=3 and doc_status=2 and wa_data_status!=99)
					THEN 'Tersertifikasi' 
				END
				) AS wa_status
				FROM 
					v_wa_data
				GROUP BY 
					propinsi,doc_proses,doc_status,wa_data_status) stats ORDER BY total desc";
		$arrData = $this->conn->GetAll($sql);
		// pre($arrData);exit;
		if (cek_array($arrData)) {
			foreach($arrData as $k=>$v) {
				$arr['Indonesia'][$v['wa_status']]+=$v['total'];
				$arr['Indonesia']['Total']+=$v['total'];
				
				$arr[$v['propinsi']][$v['wa_status']]+=$v['total'];
				$arr[$v['propinsi']]['Total']+=$v['total'];
				
				//bar_val['In Progress'][$v['propinsi']]+=0;
				$bar_val['Teregistrasi'][$v['propinsi']]+=0;
				$bar_val['Terverifikasi'][$v['propinsi']]+=0;
				$bar_val['Tersertifikasi'][$v['propinsi']]+=0;
				$bar_val[$v['wa_status']][$v['propinsi']]=$v['total'];
				$bar_txt[$v['propinsi']]=$v['propinsi'];
				
				if (count($stats[$v['wa_status']])>4) {
					$total[$v['wa_status']]+=$v['total'];
					$stats[$v['wa_status']][6]='["Lainnya",'.($total[$v['wa_status']])."]";
				}
				else {
					$stats[$v['wa_status']][]='["'.$v['propinsi'].'",'.$v['total']."]";
				}
				
				if (count($pie_total['total'])>9) {
					$total['total']+=$v['total'];
					$pie_total['total'][6]='["Lainnya",'.($total['total'])."]";
				}
				else {
					$total[$v['propinsi']]+=$v['total'];
					$pie_total['total'][$v['propinsi']]='["'.$v['propinsi'].'",'.$total[$v['propinsi']]."]";
				}
			}
			foreach($stats as $k=>$v) {
				$chart[$k]=implode(",",$v);
			}
			
			foreach($pie_total as $k=>$v) {
				$chart_total[$k]=implode(",",$v);
			}
			//pre($bar_val);exit;
			foreach($bar_val as $k=>$v) {
				if($k == ''){
				 break;
				}
				$bar['value'][$k]="[".implode(",",$v)."]";
			}
			
			$bar['text'] = "'".implode("','",$bar_txt)."'";
			$bar['value'] = implode(",",$bar['value']);
			$data["list"]=$arr;
			$data["chart"]=$chart;
			$data["chart2"]=$chart_total;
			$data["bar"]=$bar;
			// pre($bar);exit;
			$data_layout["content"]=$this->load->view($this->module."stats/index",$data,true);
			$this->load->view("layout/main_layout",$data_layout);
			//
			//return $arr;
		} 
	}
	
	function index($forder=0,$limit=10,$page=1){
		$this->view();
	}
	function _render_page($view, $data=null, $render=false)
	{
		$this->viewdata = (empty($data)) ? $this->data: $data;
		$view_html = $this->load->view($view, $this->viewdata, $render);
		if($render):
			$datam["acc_active"]="account_manager";
			$datam["content"]=$view_html;
			$this->load->view($this->admin_layout,$datam);
		endif;
		//if ($render) return $view_html;
	}
}