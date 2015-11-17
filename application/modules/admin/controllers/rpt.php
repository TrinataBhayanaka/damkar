<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rpt extends Admin_Controller {
	function __construct(){
        parent::__construct();
        $class_folder=basename(dirname(__DIR__));
        $class=__CLASS__;
	    
    	
		$this->class=$class;
		$this->$class_folder=$class_folder;
		$this->load->helper(array('form', 'url','file'));
    	$this->load->library("parser");
		$this->load->helper("lookup");
		
	    $this->folder=$class_folder."/";
        $this->module=$this->folder.$class."/";
    
	    $this->http_ref=base_url().$this->module;
       
        $this->main_layout="admin_lte_layout/main_layout";
		
		$this->module_title="Laporan";
		$this->module_title_small="(Rekapitulasi data batas wilayah)";
		$this->tbl_idx="idx";
		$this->tbl_sort="idx desc";
		$this->init_layout();
	}
	
	function init_layout($page_title="",$page_title_small="",$bread_crumb=array()){
		$this->main_layout="admin_lte_layout/main_layout";
		$this->bread_layout="admin_lte_layout/bread_crumb_template";
		
		$this->layout_data["page_title"]=$page_title!=""?$page_title:$this->module_title;
		$this->layout_data["page_title_small"]=$page_title_small!=""?$page_title_small:$this->module_title_small;
		
		$data["breadcrumb"]=cek_array($bread_crumb)?$bread_crumb:array(
			array("title"=>"Home",
				  "url"=>base_url()."admin/",
				  "active"=>"",
				  "icon"=>"<i class='icon-home blue'></i> "
				  )
		);
		$str_bread=$this->parser->parse($this->bread_layout,$data,true);
		
		$this->layout_data["breadcrumb"]=$str_bread;
	}
	
	function set_bread($arrBread){
		$arrBreadDefault=array(
			array("title"=>"Home",
				  "url"=>base_url()."admin/",
				  "active"=>"",
				  "icon"=>"<i class='icon-home blue'></i> "
				  ),
			array("title"=>"Report",
				  "url"=>$this->module,
				  "active"=>"",
				  "icon"=>" "
				  )
		);
		
		$arrBread=array_merge($arrBreadDefault,$arrBread);
		
		$data["breadcrumb"]=$arrBread;
		$str_bread=$this->parser->parse($this->bread_layout,$data,true);
		$this->layout_data["breadcrumb"]=$str_bread;
	}
	
	function index(){
		$this->_render_page($this->module."rpt_index",$data,true);
	}
	
	/* REKAP PENEGASAN BATAS BERDASARKAN PERMENDAGRI/ KEPMENDAGRI */ 
	function rkp_peraturan(){
		$arrBread=array(
			array("title"=>"Rekap Peraturan",
				  "url"=>"".$this->module."/rkp_peraturan/",
				  "active"=>"",
				  "icon"=>" "
			 )
		);
		$this->set_bread($arrBread);
		//debug();
		$sql_rkp="select 'propinsi' as batas_wilayah,1 as sort,tahun_peraturan as tahun,count(idx) as total from tb_batas_propinsi
					group by tahun_peraturan
			  union all
			  select 'kabupaten/kota' as batas_wilayah,2 as sort,tahun_peraturan as tahun,count(idx) as total from tb_batas_kabupaten
					group by tahun_peraturan";
		
		$sql_group="select sort,batas_wilayah,group_concat(tahun,':',total order by tahun asc separator ',') as data from (".$sql_rkp.") a 
					group by sort,batas_wilayah order by sort";
		//debug();
		$arrData=$this->conn->GetAll($sql_group);
		if(cek_array($arrData)):
			foreach($arrData as $x=>$val):
				$data_tmp=array();
				$data_tmp["batas_wilayah"]=strtoupper($val["batas_wilayah"]);
				$data_tmp_data=$this->parse_data($val["data"]);
				$arrData[$x]["data_per_tahun"]=$data_tmp_data;
				/* merge to $data_tmp */
				$data_tmp+=$data_tmp_data;
				$arrDataPivot[]=$data_tmp;
			endforeach;
		endif;
		
		//pre($arrDataNew);
		$data["arrData"]=$arrData;
		$data["arrDataPivot"]=$arrDataPivot;
		$this->_render_page($this->module."rkp_peraturan",$data,true);
		
	}
	
	
	function rkp_segmen_batas(){
		$arrBread=array(
			array("title"=>"Rekap Segmen Batas",
				  "url"=>"".$this->module."/rkp_segmen_batas/",
				  "active"=>"",
				  "icon"=>" "
			 )
		);
		$this->set_bread($arrBread);
		//debug();
		$sql_rkp="select 'propinsi' as batas_wilayah,1 as sort,
				a.tahun_peraturan as tahun,count(b.idx) as total 
				from tb_batas_propinsi a,tb_batas_propinsi_detail b
				where a.idx=b.id_parent 
				group by a.tahun_peraturan
				
				union all
				
				select 'kabupaten/kota' as batas_wilayah,2 as sort,
				a.tahun_peraturan as tahun,count(b.idx) as total 
				from tb_batas_kabupaten a,tb_batas_kabupaten_detail b
				where a.idx=b.id_parent 
				group by a.tahun_peraturan";
		
		$sql_group="select sort,batas_wilayah,group_concat(tahun,':',total order by tahun asc separator ',') as data from (".$sql_rkp.") a 
					group by sort,batas_wilayah order by sort";
		
		$arrData=$this->conn->GetAll($sql_group);
		if(cek_array($arrData)):
			foreach($arrData as $x=>$val):
				$data_tmp=array();
				$data_tmp["batas_wilayah"]=strtoupper($val["batas_wilayah"]);
				$data_tmp_data=$this->parse_data($val["data"]);
				$arrData[$x]["data_per_tahun"]=$data_tmp_data;
				/* merge to $data_tmp */
				$data_tmp+=$data_tmp_data;
				$arrDataPivot[]=$data_tmp;
			endforeach;
		endif;
		//pre($arrDataNew);
		$data["arrData"]=$arrData;
		$data["arrDataPivot"]=$arrDataPivot;
		$this->_render_page($this->module."rkp_segmen_batas",$data,true);
	}
	
	
	function daftar_penetapan_kabkota(){
		$arrBread=array(
			array("title"=>"Daftar Penetapan Batas Kabupaten Kota",
				  "url"=>"".$this->module."/daftar_penetapan_kabkota/",
				  "active"=>"",
				  "icon"=>" "
			 )
		);
		$this->set_bread($arrBread);
		/*
		$sql="select a.*,b.kabupaten_2
				 from tb_batas_kabupaten a 
				left join
				(select id_parent,
                group_concat(concat(id_propinsi_2,':',kabupaten_2) separator ','
				) as kabupaten_2 from tb_batas_kabupaten_detail  group by id_parent
				) b on a.idx=b.id_parent ";
		*/
		
		$sql="select a.*,b.kabupaten_2,c.detail_uu,d.detail_file,e.detail_file_peta from tb_batas_kabupaten a 
			left join 
			(select id_parent,group_concat(id_kabupaten_2,':',kabupaten_2 separator ',') as kabupaten_2 from tb_batas_kabupaten_detail group by id_parent) b
			 on a.idx=b.id_parent 
			 left join 
			 (select id_parent,group_concat(idx,'|',no_peraturan,'|',tentang separator ';') as detail_uu from 
			 (select a.id_parent,b.* from tb_batas_kabupaten_uu a left join tb_peraturan_pembentukan_daerah b on a.id_peraturan=b.idx) uu 
			 group by id_parent) c on a.idx=c.id_parent
			 
			 left join (select id_parent,group_concat(id,'|',file_name,'|',file_path separator ';') as detail_file from tb_batas_kabupaten_file group by id_parent) d
			 on a.idx=d.id_parent 
			 
			 left join (select id_parent,group_concat(id,'|',file_name,'|',file_path separator ';') as detail_file_peta from tb_batas_kabupaten_file_peta group by id_parent) e
			 on a.idx=e.id_parent 
			 ";
		
		$data_type=$this->adodbx->GetDataType("($sql) a");
		foreach($data_type as $x=>$val):
            if(($val=="C")||($val="X")) $data["text"][]=$x;
        endforeach;
        
		
		$col_text=$data["text"];
		$field=join(",",$col_text);
        //$field="jenis_pelanggaran";
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
		
		
		if(cek_var($this->input->get_post("id_propinsi"))):
			$where[]="( id_propinsi_1 like '%".$this->input->get_post("id_propinsi")."%' ".
						"or kabupaten_2 like '%".$this->input->get_post("id_propinsi")."%' )";
		endif;
		
		if(cek_var($this->input->get_post("id_kabupaten"))):
			$where[]="id_kabupaten_1 like '%".$this->input->get_post("id_kabupaten")."%'";
		endif;
		
		if(cek_var($this->input->get_post("tahun_peraturan"))):
			$where[]="tahun_peraturan='".$this->input->get_post("tahun_peraturan")."'";
		endif;
		
		if(cek_var($this->input->get_post("id_jenis_peraturan"))):
			$where[]="id_jenis_peraturan='".$this->input->get_post("id_jenis_peraturan")."'";
		endif;
		
		$whereSql="";
        if(cek_array($where)):
			$whereSql=" where ";
            $whereSql.=join(" and ",$where);
        endif;

		$arrDataTahun=$this->conn->GetAll("select tahun_peraturan from tb_batas_kabupaten group by tahun_peraturan order by tahun_peraturan desc");
	    if(cek_array($arrDataTahun)):
			foreach($arrDataTahun as $x=>$val):
				$dataTahun["".$val["tahun_peraturan"].""]=$val["tahun_peraturan"];
			endforeach;
		endif;

				
		$arrData=$this->conn->GetAll("select * from ($sql) a ".$whereSql);
		$arrDataDetail=$this->conn->GetAll("select * from tb_batas_kabupaten_detail");
		
		foreach($arrDataDetail as $x=>$val):
			$data_detail[$val["id_parent"]][$val["id_propinsi_2"]][]=$val;			
		endforeach;
		
		
		
		
		foreach($arrData as $x=>$val):
			$data_detail_parent=array();
			$data_detail_parent=cek_var($data_detail[$val["idx"]])?$data_detail[$val["idx"]]:array();
			$arrData[$x]["data_detail"]=$data_detail_parent;
		endforeach;
		
		$data["arrData"]=$arrData;
		$data["arrDataTahun"]=$dataTahun;
		
		
		$this->_render_page($this->module."daftar_penetapan_kab",$data,true);
	}
	
	
	
	function daftar_penetapan_prop(){
		$arrBread=array(
			array("title"=>"Daftar Penetapan Batas Propinsi",
				  "url"=>"".$this->module."/daftar_penetapan_prop/",
				  "active"=>"",
				  "icon"=>" "
			 )
		);
		$this->set_bread($arrBread);
		/*
		$sql="select a.*,concat(propinsi_1,':',propinsi_2) as propinsi,
				concat(id_propinsi_1,':',id_propinsi_2) as id_propinsi,
				b.kabupaten
				 from tb_batas_propinsi a 
				left join
				(select id_parent,group_concat(concat(kabupaten_1,':',kabupaten_2) separator ','
				) as kabupaten from tb_batas_propinsi_detail  group by id_parent
				) b on a.idx=b.id_parent";
		*/
		
		$sql="select a.*,concat(propinsi_1,':',propinsi_2) as propinsi,
				concat(id_propinsi_1,':',id_propinsi_2) as id_propinsi,
				b.kabupaten,c.detail_uu,d.detail_file,e.detail_file_peta 
				 from tb_batas_propinsi a 
				left join
				(select id_parent,group_concat(concat(kabupaten_1,':',kabupaten_2) separator ','
				) as kabupaten from tb_batas_propinsi_detail  group by id_parent
				) b on a.idx=b.id_parent
				left join 
			 (select id_parent,group_concat(idx,'|',no_peraturan,'|',tentang separator ';') as detail_uu from 
			 (select a.id_parent,b.* from tb_batas_propinsi_uu a left join tb_peraturan_pembentukan_daerah b on a.id_peraturan=b.idx) uu 
			 group by id_parent) c on a.idx=c.id_parent
			 
			 left join (select id_parent,group_concat(id,'|',file_name,'|',file_path separator ';') as detail_file from tb_batas_propinsi_file group by id_parent) d
			 on a.idx=d.id_parent 
			 
			 left join (select id_parent,group_concat(id,'|',file_name,'|',file_path separator ';') as detail_file_peta from tb_batas_propinsi_file_peta group by id_parent) e
			 on a.idx=e.id_parent 
				
				";
		
		
		
		$data_type=$this->adodbx->GetDataType("($sql) a");
		foreach($data_type as $x=>$val):
            if(($val=="C")||($val="X")) $data["text"][]=$x;
        endforeach;
        
        $col_text=$data["text"];
		$field=join(",",$col_text);
        //$field="jenis_pelanggaran";
        $whereSql=get_where_from_searchbox($field);
        
        if($this->input->get_post("q")):
            $where[]="(".$whereSql.")";
        endif;
		
		if(cek_var($this->input->get_post("id_propinsi"))):
			$where[]="id_propinsi like '%".$this->input->get_post("id_propinsi")."%'";
		endif;
		
		if(cek_var($this->input->get_post("tahun_peraturan"))):
			$where[]="tahun_peraturan='".$this->input->get_post("tahun_peraturan")."'";
		endif;
		
		if(cek_var($this->input->get_post("id_jenis_peraturan"))):
			$where[]="id_jenis_peraturan='".$this->input->get_post("id_jenis_peraturan")."'";
		endif;
		
		$whereSql="";
        if(cek_array($where)):
			$whereSql=" where ";
            $whereSql.=join(" and ",$where);
        endif;
	
	
		$arrDataTahun=$this->conn->GetAll("select tahun_peraturan from tb_batas_propinsi group by tahun_peraturan order by tahun_peraturan desc");
	    if(cek_array($arrDataTahun)):
			foreach($arrDataTahun as $x=>$val):
				$dataTahun["".$val["tahun_peraturan"].""]=$val["tahun_peraturan"];
			endforeach;
		endif;
		
		$arrData=$this->conn->GetAll("select * from ($sql) a ".$whereSql);
		$arrDataDetail=$this->conn->GetAll("select * from tb_batas_propinsi_detail");
		
		foreach($arrDataDetail as $x=>$val):
			$data_detail[$val["id_parent"]][]=$val;			
		endforeach;
		
		
		foreach($arrData as $x=>$val):
			$data_detail_parent=array();
			$data_detail_parent=cek_var($data_detail[$val["idx"]])?$data_detail[$val["idx"]]:array();
			$arrData[$x]["data_detail"]=$data_detail_parent;
		endforeach;
		
		$data["arrData"]=$arrData;
		$data["arrDataTahun"]=$dataTahun;
		$this->_render_page($this->module."daftar_penetapan_propinsi",$data,true);
	}
	
	
	function test_parse_data(){
		$str="2004:1,2005:1,2006:1,2010:1";
		pre($this->parse_data($str));
		
	}
	
	function parse_data($str,$delim1=",",$delim2=":"){
		$op = array();
		$pairs = explode($delim1, $str);
		foreach ($pairs as $pair) {
			list($k, $v) = array_map("urldecode", explode($delim2, $pair));
			$op[$k] = $v;
		}
		return $op;
	}

}