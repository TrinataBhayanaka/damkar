<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class satpolpp extends CI_Controller {

    function __construct(){
        parent::__construct();
	//debug();
        
        $this->folder="";
		$this->module=$this->folder="";
		$this->module=$this->folder."sig/wilayah/";
		$this->http_ref=base_url().$this->module;
	
		$this->load->model("satpolpp_model");
		$this->model=$this->satpolpp_model;
		
		$this->load->model("master_wilayah_model");
		$this->mwilayah_model=$this->master_wilayah_model;
	
		$this->load->model("m_indikator_model");
		$this->indikator_model=$this->m_indikator_model;

		$this->listText="LAT Control Page / News";
		
 		$this->api_host = "http://simsatpolpp.ditjenpum.go.id/layanandata/polpp/index";
   }
	
	function index($key=0,$forder=0,$limit=3,$page=1){
		
	}
	function get_indikator($structurize=true) {
		$sql="kode_komponen='0003'";
		$arr=$this->indikator_model->SearchRecordWhere($sql.$not_sql);
		if (!$structurize) {
			if (cek_array($arr)) {
				foreach($arr as $k=>$v) {
					$ind[$v['colom_nilai']]=$v;
				}
				return $ind;
			}
		}
		else {
			if (cek_array($arr)) {
				foreach($arr as $k=>$v) {
					$ind[$v['kategori']][]=$v;
				}
				return $ind;
			}
		}
	}
	function get_indikator2($kat=false) {
		if (!$kat) {
			$indikator['pegawai']['jumlah_pegawai']="Jumlah Pegawai";
			$indikator['pegawai']['jumlah_pns']="Jumlah Pegawai";
			$indikator['pegawai']['jumlah_npns']="Jumlah Non PNS";
			$indikator['pegawai']['jumlah_ppns_satpolpp']="Jumlah PPNS PolPP";
			$indikator['pegawai']['jumlah_ppns_unitlain']="Jumlah PPNS Unit Lain";
			$indikator['pegawai']['status_color']="Kebutuhan Personil";
			$indikator['pendidikan']['jumlah_pddk_s2']="S2";
			$indikator['pendidikan']['jumlah_pddk_s1']="S1";
			$indikator['pendidikan']['jumlah_pddk_d3']="D3";
			$indikator['pendidikan']['jumlah_pddk_slta']="SLTA";
			$indikator['golongan']['jumlah_gol_1']="Gol. I";
			$indikator['golongan']['jumlah_gol_2']="Gol. II";
			$indikator['golongan']['jumlah_gol_3']="Gol. III";
			$indikator['golongan']['jumlah_gol_4']="Gol. IV";
			$indikator['diklat']['jumlah_diklat_struktural']="Struktural";
			$indikator['diklat']['jumlah_diklat_fungsional']="Fungsional";
			$indikator['diklat']['jumlah_diklat_pemerintahan']="Pemerintahan";
			$indikator['diklat']['jumlah_diklat_teknis']="Teknis";
			$indikator['diklat']['jumlah_diklat_dasar']="Dasar";
		}
		else {
			$indikator['jumlah_pegawai']="Jumlah Pegawai";
			$indikator['jumlah_pns']="Jumlah Pegawai";
			$indikator['jumlah_npns']="Jumlah Non PNS";
			$indikator['jumlah_ppns_satpolpp']="Jumlah PPNS PolPP";
			$indikator['jumlah_ppns_unitlain']="Jumlah PPNS Unit Lain";
			$indikator['status_color']="Kebutuhan Personil";
			$indikator['jumlah_pddk_s2']="S2";
			$indikator['jumlah_pddk_s1']="S1";
			$indikator['jumlah_pddk_d3']="D3";
			$indikator['jumlah_pddk_slta']="SLTA";
			$indikator['jumlah_gol_1']="Gol. I";
			$indikator['jumlah_gol_2']="Gol. II";
			$indikator['jumlah_gol_3']="Gol. III";
			$indikator['jumlah_gol_4']="Gol. IV";
			$indikator['jumlah_diklat_struktural']="Struktural";
			$indikator['jumlah_diklat_fungsional']="Fungsional";
			$indikator['jumlah_diklat_pemerintahan']="Pemerintahan";
			$indikator['jumlah_diklat_teknis']="Teknis";
			$indikator['jumlah_diklat_dasar']="Dasar";
		}
		return $indikator;
		//return $this->indikator_model->SearchRecordWhere($sql.$not_sql);
	}
	function get_years($not=false) {
		return false;//$this->model->getDataYears();
	}
	function map_filter($selected=false,$parent=false){
		//$json = file_get_contents($this->config->item("api_host")."list_wilayah");
		//debug();
		$sql_p="parent = 0";
		$sql_p.=($parent)?" or parent=".$parent:"";
		$arrDDB=$this->mwilayah_model->SearchRecordWhere($sql_p." order by kode_wilayah");
		$data["list_propinsi_selected"]=$selected;
		$data["list_propinsi"]=$arrDDB;
		$data["module"]=$this->module;
		$sql="kode_komponen='0001' and status='1'";
		$data["indikator"]=$this->get_indikator(); 
		$data["tahun_indikator"]=$this->get_years();

		$this->load->view("satpolpp/map_filter",$data);
	}
  	function map_detail($kdw=false,$thn=false,$indikator=false){
		//debug();
		$kd21 = substr($kdw, 0,-2);
		$kd22 = substr($kdw, -2);
		$indikator = ($indikator)?$indikator:'jumlah_pegawai';
		$indikator_name=$this->indikator_model->GetRow("select kategori,nama from m_indikator where colom_nilai='".$indikator."'");
		if ($thn) $sql_tahun = " and tahun=".$thn;
		if ($kd22=="00") {
			//$sql_p=($kdw)?"kode_wilayah = '".$kdw."'":"";
			//$arrPDB=$this->model->SearchRecordWhere($sql_p.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
			//print_r($arrPDB);
			//$selected_wilayah_provinsi=$arrPDB[0]['nama_wilayah'];
			//$sql=($kdw)?"kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
			//$kdw="__00";
		}
		else {
			//$sql=($kdw)?"kode_wilayah = '".$kdw."'":"kode_wilayah like '%00'";
			//$kdw=$kd21;//."__&kode_wilayah_not_like=__00";
		}
		
		$w = "?kode_wilayah_like=".$kdw;
		$json = file_get_contents($this->api_host.$w);
		$arr = json_decode($json,true);
		
		$arrDB=$this->model->SearchRecordWhere($sql.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
		//print_r($arrDB);
		//exit;
		
		/*if (is_array($arrDB)) {
			$min = 1000000000000000;
			$max = 'none';
			foreach($arrDB as $k=>$v) {
				$param[]=$v['kode_wilayah'];
				if ($kdw==$v['kode_wilayah']) $selected_wilayah=$v['nama_wilayah'];
				$arr[$v['kode_wilayah']]=$v;
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}*/
		//$sql_legend="kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'";
		$sql_legend=($kdw)?"kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
		$arrLegend=$this->model->SearchRecordWhere($sql_legend.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
		
		$w = ($kdw)?"?kode_wilayah_like={$kd21}__&kode_wilayah_not_like=__00":"?kode_wilayah_like=__00";
		$s = "&sort=".$indikator."%20desc";
		$json = file_get_contents($this->api_host.$w.$s);
		$arrLegend = json_decode($json,true);
		
		if (is_array($arrLegend)) {
			$min = 1000000000000;
			$max = 'none';
			foreach($arrLegend as $k=>$v) {
				$param[]=$v['kode_wilayah'];
				if ($kdw==$v['kode_wilayah']) $selected_wilayah=$v['nama_wilayah'];
				if (substr($v['kode_wilayah'], -2)=='00') $arr[$v['kode_wilayah']]=$v;
				$arr_wilayah[$v['kode_wilayah']]=$arrDBWilayah[$k];
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}
		
		$cs = ($_GET['cseries'])?$_GET['cseries']:false;
		$step = ($_GET['cstep'])?$_GET['cstep']:7;
		$diff = (abs(ceil($max)-floor($min))/$step);
		$color = $this->_colorSeries($cs,$step);
		$range = $this->_legendRange($color,$min,$max,$step);
		$legend = $this->_drawLegend($color,$min,$max,$step,$indikator_name['kategori'],$indikator_name['nama']);
		
		$data["legend_table"]=$legend;
		$data["range"]=$range;
		$data["color"]=$color;
		$data["diff"]=$diff;
		$data["kode_wilayah"]=$kdw;
		$data["nama_wilayah"]=$selected_wilayah;
		$data["nama_wilayah_provinsi"]=$selected_wilayah_provinsi;
		$data["tahun"]=$thn;
		$data["typ"]=$indikator;
		$data["plist"]=$arr;
		$data_indikator=$this->get_indikator();
		$data["indikator_aktif"]=$indikator;
		if (is_array($data_indikator)) {
			foreach($data_indikator as $k=>$v) {
				$ind[$v['colom_nilai']]=$v;
			}
		}
		$data["indikator"]=$ind;
		
		$data_indikator=$this->get_indikator(1);
		$data_indikator2=$this->get_indikator(0);
		$data["list"]=$arrLegend;
		$data["indikator_aktif"]=$indikator;
		$data["indikator_title"]=$data_indikator2[$indikator];
		
		$data["indikator"]=$data_indikator;
		//print_r($arrDB);
		$this->load->view("satpolpp/map_detail",$data);
  	}
  	function map_search($kdw=false,$thn=false,$indikator=false){
		//debug();
		if ($thn) $sql_tahun = " and tahun=".$thn;
		if ($kdw) {
			$kd21 = substr($kdw, 0,-2);
			$kd22 = substr($kdw, -2);
			$kdw = ($kd22=="00")?$kd21:$kdw;
		}
		
		$indikator = ($indikator)?$indikator:'jumlah_pegawai';
		
		$w = ($kdw)?"?kode_wilayah_like={$kd21}__&kode_wilayah_not_like=__00":"?kode_wilayah_like=__00";
		$s = "&sort=".$indikator."%20desc";
		$json = file_get_contents($this->api_host.$w.$s);
		$arr = json_decode($json,true);
		//pre($arr);
		
		//$sql_legend=($kdw)?"kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
		//$arrLegend=$this->model->SearchRecordWhere($sql_legend.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
		
		if (is_array($arr)) {
			$omin = 1000000000000;
			$omax = 'none';
			foreach($arr as $k=>$v) {
				if ($v[$indikator]<$omin) $omin=$v[$indikator];
				if ($omax=='none') {
					$omax=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$omax) $omax=$v[$indikator];
				}
			}
		}
		//pre($omax);
		//$sql=($kdw)?"kode_wilayah like '".$kdw."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
		//$arrDB=$this->model->SearchRecordWhere($sql.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
		if (is_array($arr)) {
			$min = 1000000000000;
			$max = 'none';
			foreach($arr as $k=>$v) {
				$param[]=$v['kode_wilayah'];
				$arr[$v['kode_wilayah']]=$v;
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}
		$cs = ($_GET['cseries'])?$_GET['cseries']:false;
		$step = ($_GET['cstep'])?$_GET['cstep']:7;
		$diff = (abs(ceil($max)-floor($min))/$step);
		$color = $this->_colorSeries($cs,$step);
		$range = $this->_legendRange($color,$min,$max,$step);
		$orange = $this->_legendRange($color,$omin,$omax,$step);
		//print_r($range);
		
		$data["range"]=$orange;
		//$data["range"]=$range;
		$data["color"]=$color;
		//$data["diff"]=$diff;
		//$data["min"]=$min;
		$data["kode_wilayah"]=$kdw;
		$data["tahun"]=$thn;
		$data["typ"]=$indikator;
		$data["list"]=$arr;
		$data_indikator=$this->get_indikator(1);
		$data_indikator2=$this->get_indikator(0);
		$data["indikator_aktif"]=$indikator;
		$data["indikator_title"]=$data_indikator2[$indikator];
		
		$data["indikator"]=$data_indikator;
		$this->load->view("satpolpp/map_search",$data);
  	}
	function map_json($kdw=false,$thn=false,$indikator=false){
		if ($thn) $sql_tahun = " and tahun=".$thn;
		if ($kdw) {
			$kd21 = substr($kdw, 0,-2);
			$kd22 = substr($kdw, -2);
			$kdw = ($kd22=="00")?$kd21:$kdw;
		}
		
		$indikator = ($indikator)?$indikator:'jumlah_pegawai';
		
		$w = ($kdw)?"?kode_wilayah_like={$kd21}__&kode_wilayah_not_like=__00":"?kode_wilayah_like=__00";
		$json = file_get_contents($this->api_host.$w);
		$data = json_decode($json,true);
		
		//$sql=($kdw)?"kode_wilayah like '".$kdw."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
		//$data=$this->model->SearchRecordWhere($sql.$sql_tahun);

		//$indikator = ($indikator)?$indikator:'jumlah_penduduk';
		//$sql_legend="kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'";
		//$sql_legend=($kdw)?"kode_wilayah like '".$kd21."%' and kode_wilayah not like '%00'":"kode_wilayah like '%00'";
		//$arrLegend=$this->model->SearchRecordWhere($sql_legend.$sql_tahun." order by CAST(".$indikator." AS UNSIGNED) desc");
		
		if (is_array($data)) {
			$omin = 1000000000000;
			$omax = 'none';
			foreach($data as $k=>$v) {
				if ($v[$indikator]<$omin) $omin=$v[$indikator];
				if ($omax=='none') {
					$omax=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$omax) $omax=$v[$indikator];
				}
			}
		}
		if (is_array($data)) {
			$min = 1000000000000;
			$max = 'none';
			foreach($data as $k=>$v) {
				$param[]=$v['kode_wilayah'];
				$arr[$v['kode_wilayah']]=$v;
				//$max+=$v[$indikator];
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}
		
		$cs = ($_GET['cseries'])?$_GET['cseries']:false;
		$step = ($_GET['cstep'])?$_GET['cstep']:7;
		$diff = (abs(ceil($max)-floor($min))/$step);
		$color = $this->_colorSeries($cs,$step);
		$range = $this->_legendRange($color,$min,$max,$step);
		$orange = $this->_legendRange($color,$omin,$omax,$step);
		$param = implode("!",$param);
		//print_r($arr);
		//exit;
		$base_url = ($kdw)?"map_kabupaten/":"map_provinsi/";
		//echo$this->config->item("api_host").$base_url.$param;
		
		$json = file_get_contents($this->config->item("api_host").$base_url.$param);
		$json = json_decode($json,true);
		pre($json);
		$theme_colors = $this->config->item('color');
		$indikator_name=$this->indikator_model->GetRow("select kategori,nama from m_indikator where colom_nilai='".$indikator."'");
		$data_indikator=$this->get_indikator();
		//print_r($indikator_name['nama']);
		foreach($json['features'] as $k=>$v) {
			//$index = ceil($arr[$v['properties']['kode_wilayah']][$indikator]/$diff);
			//$index = floor(($arr[$v['properties']['kode_wilayah']][$indikator]-$min)/$diff);
			$index=0;
			$val = $arr[$v['properties']['kode_wilayah']][$indikator];
			for($zi=0;$zi<count($orange);$zi++) {
				if ($val>$orange[$zi]['min'] && $val<=$orange[$zi]['max']) {
					$index=$zi;
					break;
				}
			}
			
			$nilai = ($indikator=='status_color')?"":number_format($arr[$v['properties']['kode_wilayah']][$indikator],0,0,".");
			$popup_content ="Data Satpol PP<BR><span>Area: ".$arr[$v['properties']['kode_wilayah']]['nama_wilayah']."</span><BR>".$a.'<span style="color:#000">'.$indikator_name['kategori'].' '.$indikator_name['nama'].": <strong>".$nilai."</strong> ".$indikator_name['satuan'].'</span></li>';
			$json['features'][$k]['properties']['kode_wilayah']=$v['properties']['kode_wilayah'];
			$json['features'][$k]['properties']['nama_wilayah']=$v['properties']['nama_wilayah'];
			$json['features'][$k]['properties']['label0']="Data Satpol PP";
			$json['features'][$k]['properties']['label1']=$arr[$v['properties']['kode_wilayah']]['nama_wilayah'];
			$json['features'][$k]['properties']['label2']='*';
			//$json['features'][$k]['properties']['label3']=$indikator_name['nama'].": ".number_format(doubleval($arr[$v['properties']['kode_wilayah']][$indikator]),0,0,".");
			$label3=array();
			$sub = $data_indikator[$indikator_name['kategori']];
			//$json['features'][$k]['properties']['label3']='<li style="padding:3px 0; list-style:square; color:'.$color[$index].'"><span style="color:#000">'.$indikator_name['kategori'].' '.$indikator_name['nama'].": <strong>".number_format($arr[$v['properties']['kode_wilayah']][$indikator],0,0,".")."</strong> ".$indikator_name['satuan'].'</span></li>';
			if (is_array($sub)) {
				foreach($sub as $kk=>$vv) {
					if ($vv['colom_nilai']!=$indikator) {
						$label3[]='<li>'.$vv['nama'].": <strong>".number_format(doubleval($arr[$v['properties']['kode_wilayah']][$vv['colom_nilai']]),0,0,".")."</strong> ".$vv['satuan'].'</li>';
					}
					else {
						array_unshift($label3,'<li style="padding:5px 0; list-style:square; color:'.$color[$index].'"><span style="color:#000">'.$vv['nama'].": <strong>".number_format(doubleval($arr[$v['properties']['kode_wilayah']][$vv['colom_nilai']]),0,0,".")."</strong> ".$vv['satuan'].'</span></li>');
						$json['features'][$k]['properties']['label_pop']='<div class="hov-legend" style="background-color:'.$color[$index].'" title=""></div><div style="display:inline-block" title="">'.$vv['kategori'].'</div> <span style="margin-left:5px;border-bottom:1px dotted #999">: <strong>'.number_format(doubleval($arr[$v['properties']['kode_wilayah']][$vv['colom_nilai']]),0,0,".").'</strong>  '.$vv['satuan'].'</span>';
					}
				}
			}
			$json['features'][$k]['properties']['label3']="<ul style='margin-left:12px'>".implode("\n",$label3)."</ul>";
			$json['features'][$k]['properties']['label_pop']='<div class="hov-legend" style="background-color:'.$color[$index].'" title=""></div><div style="display:inline-block" title="">'.$indikator_name['kategori'].' '.$indikator_name['nama'].'</div> <span style="margin-left:5px;border-bottom:1px dotted #999">: <strong>'.number_format($arr[$v['properties']['kode_wilayah']][$indikator],0,0,".").'</strong>  '.$vv['satuan'].'</span>';
			$json['features'][$k]['properties']['color']=$color[$index];
		}
		//print_r($json);
		echo json_encode($json);
		
		$data["kode_wilayah"]=$kdw;
		$data["tahun"]=$thn;
		$data["typ"]=$indikator;
		$data["list"]=$arrDB;
		
		
		
		//$legend = $this->_drawLegend($color,$min,$max,"box");
		//echo $legend;
		//print_r($arrDB);
		//$this->load->view("ipm/map_search",$data);
  	}
	function map_legend($kdw=false,$thn=false,$indikator=false){
		//$arrDB=$arrDB=$this->model->SearchRecord("where kode_wilayah like '".$kdw."%'");
		//debug();
		if ($thn) $sql_tahun = " and tahun=".$thn;
		if ($kdw) {
			$kd21 = substr($kdw, 0,-2);
			$kd22 = substr($kdw, -2);
			$kdw = ($kd22=="00")?$kd21:$kdw;
		}
		$indikator = ($indikator)?$indikator:'jumlah_pegawai';
		$indikator_name=$this->indikator_model->GetRow("select kategori,nama from m_indikator where colom_nilai='".$indikator."'");
		
		$w = ($kdw)?"?kode_wilayah_like={$kd21}__&kode_wilayah_not_like=__00":"?kode_wilayah_like=__00";
		$json = file_get_contents($this->api_host.$w);
		$arrLegend = json_decode($json,true);
		
		if (is_array($arrLegend)) {
			$min = 1000000000000;
			$max = 'none';
			foreach($arrLegend as $k=>$v) {
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}
		/*if (is_array($data)) {
			$min = 1000000000000;
			$max = 'none';
			foreach($data as $k=>$v) {
				$param[]=$v['kode_wilayah'];
				$arr[$v['kode_wilayah']]=$v;
				if ($v[$indikator]<$min) $min=$v[$indikator];
				if ($max=='none') {
					$max=$v[$indikator];
				}
				else {
					if ($v[$indikator]>$max) $max=$v[$indikator];
				}
			}
		}*/
		$cs = ($_GET['cseries'])?$_GET['cseries']:false;
		$step = ($_GET['cstep'])?$_GET['cstep']:7;
		$diff = ceil(abs($max-$min)/$step);
		$diff = (abs(ceil($max)-floor($min))/$step);
		$color = $this->_colorSeries($cs,$step,$diff);
		//print_r($color);
		//$max=$max+$diff;
		$legend = $this->_drawLegend($color,$min,$max,$step,$indikator_name['kategori'],$indikator_name['nama']);
		echo $legend;
		//print_r($arrDB);
		//$this->load->view("ipm/map_search",$data);
  	}
  	function _bd_nice_number($n) {
		// first strip any formatting;
		$n = (0+str_replace(",","",$n));
	   
		// is this a number?
		if(!is_numeric($n)) return false;
	   
		// now filter it;
		if($n>1000000000000) return round(($n/1000000000000),1).' T';
		else if($n>1000000000) return round(($n/1000000000),1).' B';
		else if($n>1000000) return round(($n/1000000),1).' M';
		else if($n>1000) return round(($n/1000),0).' K';
	   
		return number_format($n);
	}
	function _legendRange($color,$min=0,$max='?',$step=7,$type=1) {
		$d = ceil(abs(ceil($max)-floor($min))/$step);
		krsort($color);
		foreach($color as $k=>$v) {
			//$val = $this->_bd_nice_number(($d*$k))." - ".$this->_bd_nice_number(($d*($k+1)));
			$val[$k]['min'] = $min+($d*$k);
			$val[$k]['max'] = $min+($d*($k+1));
		}
		return $val;
	}
	function _drawLegend($color,$min=0,$max='?',$step=7,$type=1,$thn=false) {
		$tbl.='<div style="padding:10px; border:1px solid #aaa; max-width:550px">';
		$tbl.='<div style="padding:2px">'.$type.'</div>';
		$tbl.='<div style="padding:2px; font-size:large; border-bottom:1px solid #ddd">'.$thn.'</div>';
		$tbl.='<table cellpadding="0" cellspacing="0" border="0">';
		//$lgd .='<tr><td>'.number_format($min,0,0,".").' &nbsp; </td>';
		//$ind .='<tr><td>&nbsp;</td>';
		//$d = round($max-$min)/(count($color)-1);
		$d = ceil(abs($max-$min)/count($color));
		$d = ceil(abs(ceil($max)-floor($min))/$step);
		krsort($color);
		foreach($color as $k=>$v) {
			$val = $this->_bd_nice_number(($d*$k))." - ".$this->_bd_nice_number(($d*($k+1)));
			$val = number_format($min+($d*$k),0,0,".")." - ".number_format($min+($d*($k+1)),0,0,".");
			$lgd.='<tr>';
			$lgd.='<td><div id="'.$k.'" style="width:12px;height:10px;background:'.$v.'"></div></td>';
			$lgd.='<td width="9"><div class="ind" id="ind_'.$k.'" style="display:none;width:8px;height:9px;background:url(images/arrow_left.gif) no-repeat left center"></div></td>';
			$lgd.='<td><div style="margin-left:2px; font-size:x-small; line-height:16px">'.$val.'</div></td>';
			$lgd.='</tr>';
		}
		//$lgd .='<td> &nbsp; '.number_format($max,0,0,".").'</td></tr>';
		$tbl .=$lgd.$ind;
		$tbl.='</table>';
		$tbl.='</div>';
		return $tbl;
	}
	function _interpolate($pBegin, $pEnd, $pStep, $pMax) {
		if ($pBegin < $pEnd) {
			return (($pEnd - $pBegin) * ($pStep / $pMax)) + $pBegin;
		} else {
			return (($pBegin - $pEnd) * (1 - ($pStep / $pMax))) + $pEnd;
		}
	}
// return color array
	function _colorSeries($cs=false,$step=16) {
		$colorseries=($cs)?$cs:"33ff00|ffff00|ff0000";
		$step=($step)?$step:16;
		
		$acol = preg_split("/\||;|,|:|\./",$colorseries);
		$anum = count($acol);
		for($i=0;$i<$anum-1;$i++) {
			$arr[$i][0]['r']=(hexdec($acol[$i]) & 0xff0000) >> 16;
			$arr[$i][0]['g']=(hexdec($acol[$i]) & 0x00ff00) >> 8;
			$arr[$i][0]['b']=(hexdec($acol[$i]) & 0x0000ff) >> 0;
			$arr[$i][1]['r']=(hexdec($acol[$i+1]) & 0xff0000) >> 16;
			$arr[$i][1]['g']=(hexdec($acol[$i+1]) & 0x00ff00) >> 8;
			$arr[$i][1]['b']=(hexdec($acol[$i+1]) & 0x0000ff) >> 0;
		}
		$dstep = floor($step/($anum-1));
		foreach($arr as $k=>$v) {
			for ($i = 0; $i <= $dstep; $i++) {
				$theR = $this->_interpolate($v[0]['r'], $v[1]['r'], $i, $dstep);
				$theG = $this->_interpolate($v[0]['g'], $v[1]['g'], $i, $dstep);
				$theB = $this->_interpolate($v[0]['b'], $v[1]['b'], $i, $dstep);
		
				$theVal = ((($theR << 8) | $theG) << 8) | $theB;
				$color[($k*$dstep)+$i]=sprintf("#%06X", $theVal);
			}
		}
		if (count($color)<=$step) $color[]="#".$acol[$anum-1];
		return $color;
	}
  function add_save(){
      $data=$_POST;
      $this->model->InsertData($data);
      redirect($this->module);
  }
  
  function edit_save(){
      $data=$_POST;
      $idx=$data["idx"];
      unset($data["idx"]);
      $this->model->UpdateData($data,"idx=$idx");
      redirect($this->module);
   }
}