<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wa extends Public_Controller {
	
    function __construct(){
        parent::__construct();
        
        $this->folder="";
		$this->module=$this->folder."user/";
		$this->page_active="wa";
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
		$this->model_potensi_hayati_lain=new general_model("wa_potensi_hayati_lain");
		
		$this->model_batas_wilayah=new general_model("wa_batas_wilayah");
		$this->model_pembagian_ruang=new general_model("wa_hak_pembagian_ruang");
		
		$this->model_t_file_upload=new general_model("t_file_upload");
		$this->model_file_peta=new general_model("wa_register_file_peta");
		$this->model_file=new general_model("wa_register_file");
		$this->model_image=new general_model("wa_register_image");
		$this->model_cms_configuration=new general_model("cms_configuration");
		
		//$this->load->model('ion_auth_model')

		$this->load->libraries(array('ion_auth','form_validation','utils'));
		$this->load->helpers(array('form', 'url','lookup','language','file'));
		$this->lang->load('auth');
		
		$this->user=(array)$this->ion_auth->user()->row();
		$this->tbl_idx="idx";
		$this->get_map_proses();
		
		$this->admin_layout="layout/main_layout";
		
		// if (!$this->ion_auth->logged_in())
		// {
			// redirect('user/login', 'refresh');
		// }
    }
	
	function get_map_proses(){
	 	 $mapProses=m_lookup("wa_proses","id_proses","nama_proses",""," order by idx asc ");
		 $this->data["map_proses"]=$mapProses;
		 $arrProsesAllStatus=$this->adodbx->search_record_where("m_wa_proses_status",""," order by id_proses,id_status");
		 $mapProsesAllStatus=array();
		 if(cek_array($arrProsesAllStatus)):
		 	$mapProsesAllStatus[$val["id_proses"]][$val["id_status"]]=$val["status"];
		 endif;
		 $this->data["map_proses_all_status"]=$mapProses;
		 
		 $arrProsesStatus=$this->adodbx->search_record_where("m_wa_proses_status","id_status<90"," order by id_proses,id_status");
		 $mapProsesStatus=array();
		 $mapProses=array();
		 $mapProsesByOrder=array();
		 $mapOrderByProcess=array();
		 if(cek_array($arrProsesStatus)):
		 	foreach($arrProsesStatus as $x=>$val):
				$mapProses[$val["id_proses"]][]=$val["id_status"];
				$mapProsesDataStatus[$val["id_proses"]][]=$val;
				$mapProsesStatus[$val["id_proses"]][$val["id_status"]]=$val["status"];
				$mapOrderByProses[$val["id_proses"]][$val["id_status"]]=$x;
				$mapProsesByOrder[]=$val;
				$maxOrder=$x;
			endforeach;
		 endif;
		$this->data["max_order"]=$maxOrder;
		$this->data["max_proses"]=$arrProsesStatus[$maxOrder]["id_proses"];
		$this->data["max_status"]=$arrProsesStatus[$maxOrder]["id_status"];
		$this->data["map_status_in_proses"]=$mapProses;
		$this->data["map_data_proses"]=$mapProsesDataStatus;
		$this->data["map_proses_status"]=$mapProsesStatus;
		$this->data["map_proses_order"]=$mapProsesByOrder;
		$this->data["map_order_proses"]=$mapOrderByProses;
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
	function index($forder=0,$limit=10,$page=1){
		$this->list_view($forder,$limit,$page);
	}
	function register($idx=false,$fn=false){
		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_flashdata('pending_url', 'dip/request/'.$idx.'/'.$fn);
			redirect('user/login', 'refresh');
		}
		// echo "asd";exit; 
		$user=(array)$this->ion_auth->user()->row();
		//if ($this->form_validation->run() == true)
		if ($_SERVER['REQUEST_METHOD']=='POST') 
		{
			// echo "aaa";exit;
			$data=get_post();
//			pre($data);exit;
			
			$data_batas_wilayah=array();
			if(cek_array($data["batas"])):
				$arr_tmp=array_combine($data["batas"],$data["batas_val"]);
				foreach($arr_tmp as $batas=>$batas_val):
					$tmp=array();
					$tmp["batas"]=$batas;
					$tmp["batas_val"]=$batas_val;
					$data_batas_wilayah[]=$tmp;
				endforeach;
			endif;
			
			// $data_pembagian_ruang=array();
			// if(cek_array($data["ruang"])):
				// $arr_tmp=array_combine($data["ruang"],$data["ruang_val"]);
				// foreach($arr_tmp as $ruang=>$ruang_val):
					// $tmp=array();
					// $tmp["pemanfaatan_kawasan"]=$ruang;
					// $tmp["luas"]=$ruang_val;
					// $data_pembagian_ruang[]=$tmp;
				// endforeach;
			// endif;
			
			$data_potensi=array();
			if(cek_array($data["potensi"])):
				$arr_tmp=array_combine($data["id_potensi"],$data["potensi_val"]);
				$arr_tmp2=array_combine($data["id_potensi"],$data["potensi"]);
				
				foreach($arr_tmp as $id_potensi=>$keterangan):
					$tmp=array();
					$tmp["id_potensi_hayati"]=$id_potensi;
					$tmp["nama_potensi_hayati"]=$arr_tmp2[$id_potensi];
					$tmp["keterangan"]=$keterangan;
					$data_potensi[]=$tmp;
				endforeach;
			endif;
			
			$data_potensi_lain=array();
			if(cek_array($data["potensi_lain"])):
				$arr_tmp=array_combine($data["potensi_lain"],$data["potensi_lain_val"]);
				foreach($arr_tmp as $ruang=>$ruang_val):
					$tmp=array();
					$tmp["nama_potensi_hayati"]=$ruang;
					$tmp["keterangan"]=$ruang_val;
					$data_potensi_lain[]=$tmp;
				endforeach;
			endif;
			
			$data['kondisi_fisik']=implode(",",$data['list_kondisi_fisik']);
			$data['jenis_ekosistem']=implode(",",$data['list_jenis_ekosistem']);
			$data['tanggal_daftar']=date("Y-m-d");
			//debug();
			
			$data=$this->_add_creator($data);
			
			$this->conn->StartTrans();
			$this->model->InsertData($data);
			$id_last=$this->model->GetLastID("idx");
			$data_update=$data;
			unset($data_update["idx"]);
			$data_update["id_wa"]=$id_last;
			$this->model_contact->DeleteData("id_wa=".$id_last);
			$this->model_contact->InsertData($data_update);
			
			$this->model_sejarah->DeleteData("id_wa=".$id_last);
			$this->model_sejarah->InsertData($data_update);
			
			$this->model_hukum_adat->DeleteData("id_wa=".$id_last);
			$this->model_hukum_adat->InsertData($data_update);
			
			$this->model_hayati->DeleteData("id_wa=".$id_last);
			$this->model_hayati->InsertData($data_update);
			
			$this->model_lembaga_adat->DeleteData("id_wa=".$id_last);
			$this->model_lembaga_adat->InsertData($data_update);
			
			$this->model_hak_atas_tanah->DeleteData("id_wa=".$id_last);
			$this->model_hak_atas_tanah->InsertData($data_update);
			
			//$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			//$this->model_potensi_hayati->InsertData($data_update);
			
			//batas_wilayah_lain
			$this->model_batas_wilayah->DeleteData("id_wa=".$id_last);
			if(cek_array($data_batas_wilayah)):
				foreach($data_batas_wilayah as $data_batas):
					$data_batas["id_wa"]=$id_last;
					$this->model_batas_wilayah->InsertData($data_batas);
				endforeach;	
			endif;
			
			//pemanfaatan pembagian_ruang
			// $this->model_pembagian_ruang->DeleteData("id_wa=".$id_last);
			// if(cek_array($data_pembagian_ruang)):
				// foreach($data_pembagian_ruang as $data_ruang):
					// $data_ruang["id_wa"]=$id_last;
					// $this->model_pembagian_ruang->InsertData($data_ruang);
				// endforeach;	
			// endif;
			
			//data_potensi
			$this->model_potensi_hayati->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi)):
				foreach($data_potensi as $data_pot):
					$data_pot["id_wa"]=$id_last;
					$this->model_potensi_hayati->InsertData($data_pot);
				endforeach;	
			endif;
			
			//data_potensi_lain
			$this->model_potensi_hayati_lain->DeleteData("id_wa=".$id_last);
			if(cek_array($data_potensi_lain)):
				foreach($data_potensi_lain as $data_potensi_lain):
					$data_potensi_lain["id_wa"]=$id_last;
					$this->model_potensi_hayati_lain->InsertData($data_potensi_lain);
				endforeach;	
			endif;
			
			//spread file
			$adm_folder = $_SERVER['DOCUMENT_ROOT'].$this->config->item('dir_brwa_admin');
			if ($_POST['file_pendukung']) {
				foreach($_POST['file_pendukung'] as $k=>$v) {
					
					$fix_name = "file_pendukung_".$v;
					$tmp_name = $this->config->item('dir_tmp').$v;
					$new_name = $adm_folder.$this->config->item('dir_file_pendukung').$fix_name;
					if (file_exists($tmp_name)) {
						if (copy($tmp_name,$new_name)) {
							$file_pendukung[]=$fix_name;
							
							//tfileupload
							list($width, $height, $type, $attr) = getimagesize( $new_name );
							if ($width) {
								$file_data['is_image']=true;
								$file_data['image_width']=$width;
								$file_data['image_height']=$height;
								$file_data['image_type']=$type;
							}
							$file_data["upload_time"]=time();
							$file_data["id_file_str"]=date("Ymdhis");
							
							$file_info=get_file_info($new_name);
							$file_data['id_parent']=$id_last;
							$file_data['id_user']=$_POST['id_user'];
							$file_data['id_jenis_doc']='doc3';
							$file_data['tipe_doc']='file';
							$file_data['keterangan']=$_POST['file_keterangan'][$k];
							$file_data['file_name']=$fix_name;
							$file_data['file_path']=$this->config->item('dir_file_pendukung').$fix_name;
							$file_data['file_type']=get_mime_by_extension($new_name);
							$file_data['file_ext']=substr($v,strrpos($v,"."));
							$file_data['file_size']=$file_info['size'];
							$file_data['upload_time']=date("Y-m-d h:i:s",(int)$file_info['date']);
							$file_data['created']=date("Y-m-d h:i:s");
							
							$this->model_t_file_upload->InsertData($file_data);
							$img_idx_fp=$this->model_t_file_upload->GetLastID("idx");
							
							$file_data['id_file']=$img_idx_fp;
							$this->model_file->InsertData($file_data);
							
							unlink($tmp_name);
						}
					}
				}
			}
			if ($_POST['file_peta']) {
				$fix_name = "file_peta_".$_POST['file_peta'];
				$tmp_name = $this->config->item('dir_tmp').$_POST['file_peta'];
				$new_name = $adm_folder.$this->config->item('dir_file_peta').$fix_name;
				if (file_exists($tmp_name)) {
					if (copy($tmp_name,$new_name)) {
						//$file_peta=$fix_name;
						
						list($width, $height, $type, $attr) = getimagesize( $new_name );
						if ($width) {
							$file_peta['is_image']=true;
							$file_peta['image_width']=$width;
							$file_peta['image_height']=$height;
							$file_peta['image_type']=$type;
						}
						$file_info=get_file_info($new_name);
						$file_peta['id_parent']=$id_last;
						$file_peta['id_user']=$_POST['id_user'];
						$file_peta['id_jenis_doc']='peta';
						$file_peta['tipe_doc']='file';
						$file_peta['file_name']=$fix_name;
						$file_peta['file_path']=$this->config->item('dir_file_peta').$fix_name;
						$file_peta['file_type']=get_mime_by_extension($new_name);
						$file_peta['file_ext']=substr($fix_name,strrpos($fix_name,"."));
						$file_peta['file_size']=$file_info['size'];
						$file_peta['upload_time']=date("Y-m-d h:i:s",(int)$file_info['date']);
						$file_peta['created']=date("Y-m-d h:i:s");
						
						$this->model_t_file_upload->InsertData($file_peta);
						$img_idx_peta=$this->model_t_file_upload->GetLastID("idx");
						
						$file_peta['id_file']=$img_idx_peta;
						$this->model_file_peta->InsertData($file_peta);
						unlink($tmp_name);
					}
				}
			}
			
			if ($_POST['surat_kuasa']) {
				$fix_name = "surat_kuasa_".$_POST['surat_kuasa'];
				$tmp_name = $this->config->item('dir_tmp').$_POST['surat_kuasa'];
				$new_name = $adm_folder.$this->config->item('dir_surat_kuasa').$fix_name;
				if (file_exists($tmp_name)) {
					if (copy($tmp_name,$new_name)) {
						//$file_peta=$fix_name;
						
						list($width, $height, $type, $attr) = getimagesize( $new_name );
						if ($width) {
							$file_peta['is_image']=true;
							$file_peta['image_width']=$width;
							$file_peta['image_height']=$height;
							$file_peta['image_type']=$type;
						}
						$file_info=get_file_info($new_name);
						$file_sk['id_parent']=$id_last;
						$file_sk['id_user']=$_POST['id_user'];
						$file_sk['id_jenis_doc']='doc1';
						$file_sk['tipe_doc']='file';
						$file_sk['file_name']=$fix_name;
						$file_sk['file_path']=$this->config->item('dir_surat_kuasa').$fix_name;
						$file_sk['file_type']=get_mime_by_extension($new_name);
						$file_sk['file_ext']=substr($fix_name,strrpos($fix_name,"."));
						$file_sk['file_size']=$file_info['size'];
						$file_sk['upload_time']=date("Y-m-d h:i:s",(int)$file_info['date']);
						$file_sk['created']=date("Y-m-d h:i:s");
						
						$this->model_t_file_upload->InsertData($file_sk);
						$img_idx_sk=$this->model_t_file_upload->GetLastID("idx");
						
						$file_sk['id_file']=$img_idx_sk;
						$this->model_file->InsertData($file_sk);
						unlink($tmp_name);
					}
				}
			}
			
			$ok=$this->conn->CompleteTrans();
			if ($ok) {
				if ($this->send_email($data)) {
					$this->send_email_to_user($data);
				}		
				redirect('user/wa', 'refresh');
			}
		}
		else
		{
			$this->data['message'] = validation_errors() ? validation_errors():false;
			$this->data['user'] = $user;
			$this->data['tooltip'] = $this->config->item("registrasi_help");
			$this->_render_page('user/wa/register', $this->data,true);
		}
	}
	function admin_email_list() {
		$this->model_admin=new general_model("adm_users");
		
		$filter = "group_brwa=1 or group_brwa=2";
		//$filter = "id=1";
		$arrDB=$this->model_admin->SearchRecordWhere($filter);
		if (cek_array($arrDB)) {
			foreach($arrDB as $k=>$v) {
				$arr[]=$v['email'];
			}
			return $arr;
		}
	}
	function send_email($data=false) {
		$email = $this->admin_email_list();
		$message = $this->load->view($this->config->item('email_templates_wa').$this->config->item('email_wa_reg'), $data, true);

		$this->email->clear();
		$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
		$this->email->to($email);
		$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Pendaftaran Wilayah Adat Baru');
		$this->email->message($message);
		if ($this->email->send() == TRUE)
		{
			return true;
		}
	}
	function send_email_to_user($data=false) {
		$message = $this->load->view($this->config->item('email_templates_wa').$this->config->item('email_wa_reg_user'), $data, true);

		$this->email->clear();
		$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
		$this->email->to($data['email_pemohon']);
		$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Pendaftaran Wilayah Adat Baru');
		$this->email->message($message);
		if ($this->email->send() == TRUE)
		{
			return true;
		}
	}
	//F021
	function regf021($idx=false,$fn=false){
		if (!$this->ion_auth->logged_in())
		{
			$this->session->set_flashdata('pending_url', 'dip/request/'.$idx.'/'.$fn);
			redirect('user/login', 'refresh');
		}

		$user=(array)$this->ion_auth->user()->row();
		//if ($this->form_validation->run() == true)
		if ($_SERVER['REQUEST_METHOD']=='POST') 
		{
			$data=get_post();
			//pre($data);
			//debug();
			
			$data=$this->_add_creator($data);
			
			$this->conn->StartTrans();
			//spread file
			$adm_folder = $_SERVER['DOCUMENT_ROOT'].$this->config->item('dir_brwa_admin');
			if ($_POST['file_f021']) {
				$fix_name = $_POST['no']."_".time()."".(substr($_POST['file_f021'],strrpos($_POST['file_f021'],".")));
				$tmp_name = $this->config->item('dir_tmp').$_POST['file_f021'];
				$new_name = $adm_folder.$this->config->item('dir_file_f021').$fix_name;
				if (file_exists($tmp_name)) {
					if (copy($tmp_name,$new_name)) {
						//$file_peta=$fix_name;
						
						list($width, $height, $type, $attr) = getimagesize( $new_name );
						if ($width) {
							$file_peta['is_image']=true;
							$file_peta['image_width']=$width;
							$file_peta['image_height']=$height;
							$file_peta['image_type']=$type;
						}
						$file_info=get_file_info($new_name);
						$file_f021['id_parent']=$_POST['idx'];
						$file_f021['id_user']=$_POST['id_user'];
						$file_f021['id_jenis_doc']='doc2';
						$file_f021['tipe_doc']='file';
						$file_f021['file_name']=$fix_name;
						$file_f021['file_path']=$this->config->item('dir_file_f021').$fix_name;
						$file_f021['file_type']=get_mime_by_extension($new_name);
						$file_f021['file_ext']=substr($fix_name,strrpos($fix_name,"."));
						$file_f021['file_size']=$file_info['size'];
						$file_f021['upload_time']=date("Y-m-d h:i:s",(int)$file_info['date']);
						$file_f021['created']=date("Y-m-d h:i:s");
						
						$this->model_t_file_upload->InsertData($file_f021);
						$img_idx=$this->model_t_file_upload->GetLastID("idx");
						
						$file_f021['id_file']=$img_idx;
						$this->model_file->InsertData($file_f021);
						unlink($tmp_name);
					}
				}
			}
			
			$ok=$this->conn->CompleteTrans();
			if ($ok) {
				redirect('user/wa/view/'.encrypt($data['idx']), 'refresh');
			}
		}
		else
		{
			$this->_render_page('user/wa/', $this->data,true);
		}
	}
	
	function list_view($forder,$limit,$page){
		$filter="id_user=".$this->user['id'];
		$key = ($_GET['q'])?$_GET['q']:0;
		if ($key) {
			$filter = "nama_kewilayahan like '%".$key."%' or desa like '%".$key."%'";
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
		//$arrDB=$this->model->SearchRecord(false,'order by id desc');
		$arrDB=$this->model_view->SearchRecordLimitWhere($filter,$limit,$offset,$order);
		$total_rows=$this->model_view->getTotalRecordWhere($filter);
		$query_url = ($key)?"?q=".$key:"";
		$base_url = $this->module."index/".$forder."/".$limit;
		$perpage = $this->utils->getPerPage($limit,array(3,15,20,25,30,40,50));
		$paging = $this->utils->getPaginationString2($page, $total_rows, $limit, 1, $base_url, "/",$query_url);
		
		if (is_array($arrDB)) {
			$img_dir = $this->config->item("dir_news_image");
			foreach($arrDB as $k=>$v) {
				if (!file_exists($img_dir.$v['image'])) $arrDB[$k]['image'] = "blank.png";
				$arrDB[$k]['date_formatted']=$this->utils->dateToString($v['created'],0,4);
				$arrDB[$k]['news_clip2']=substr($v['clip'],0,100)."...";
			}
		}
		$data["acc_active"]="content";
		$data["user_name"]=$this->data['users']['user']['username'];
		$data["total_rows"]=$total_rows;
		$data["data_start"]=$data_start;
		$data["data_end"]=($data_end<$total_rows)?$data_end:$total_rows; 
		$data["perpage"]=$perpage;
		$data["paging"]=$paging;
		$data["module"]=$this->module;
		
		$data["list"]=$arrDB;
        $data_layout["content"]=$this->load->view($this->module."wa/index",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
	
	function view($idx){
		if($this->encrypt_status==TRUE):
			$id_enc=$idx;
			$idx=decrypt($idx);
		endif;
		
		$arrDB=$this->model_view->GetRecordData("idx='{$idx}'");
		$arrDBF021=$this->model_file->SearchRecordWhere("id_parent='{$idx}' and id_jenis_doc='doc2'");
		//$hayati=$this->model_potensi_hayati->SearchRecordWhere('id_wa='.$arrDB[idx]);

		//pre($arrDBF021);
		//$data["data"]=$arrDB;
		//$data["data_potensi_hayati"]=$hayati;
		
		//nambahin
		$arrDataPotensiMap=array();
		$arrDataPotensi=$this->model_potensi_hayati->SearchRecordWhere("id_wa=$id");
		if(cek_array($arrDataPotensi)):
			foreach($arrDataPotensi as $x=>$val):
				$arrDataPotensiMap[$val["id_potensi_hayati"]]=$val;
			endforeach;
		endif;
		$data["potensi"]=$arrDataPotensiMap;
		$data['arrAlamat']=$this->model_cms_configuration->GetRecordData("id_key='alamat_laporan'");
		$data['arrEmail']=$this->model_cms_configuration->GetRecordData("id_key='email'");
		$data['arrKontak']=$this->model_cms_configuration->GetRecordData("id_key='kontak_laporan'");
		
		
	    $data["data"]=$arrDB;
		$data["pembagian_ruang"]=$this->model_pembagian_ruang->SearchRecordWhere("id_wa=$id");
		$data['f021']=$arrDBF021;
		
        $data_layout["content"]=$this->load->view($this->module."wa/view",$data,true);
        $this->load->view("layout/main_layout",$data_layout);
	}
	function view_f($id){
		if ($id) {
			$arrData=$this->req_model->GetRecordByID($id);
			$user = $this->ion_auth->user()->row();
			if ($user->id==$arrData['id_user']) {
				if ($arrData['file_name']) {
					$file_name = $arrData['file_name'];
					$m_skpa=$this->get_lookup_skpa();
					$skpa = ($arrData['skpa'])?$m_skpa[$arrData['skpa']]:'skpa';
					$file_path = $this->config->item('dir_files').str_replace(" ","_",$skpa)."/";
					$tmp_name = $this->config->item('dir_files').$file_name;
					$new_name = $file_path.$file_name;

					if (file_exists($new_name)) {
						$this->__view($file_name,$file_path,$arrData['file_type']);
					}
				}
			}
		}
	}
	
	function bukti_permohonan($id){
		if ($id) {
			$arrData=$this->req_model->GetRecordByID($id);
			$file_path = $this->config->item('file_path');
			$file_name = "BP-".str_replace("/","_",$arrData['nomor_permohonan']).'.pdf';
			//pre($file_name);
			$this->__download($file_name,$file_path,false);
		}
	}
	function bukti_pemberitahuan($id){
		if ($id) {
			$arrData=$this->req_model->GetRecordByID($id);
			$file_path = $this->config->item('file_path');
			$file_name = str_replace("/","_",$arrData['nomor_permohonan']).'.pdf';
			//pre($file_name);
			$this->__download($file_name,$file_path,false);
		}
	}
	function download($id){
		if ($id) {
			$arrData=$this->req_model->getRequestFileById($id);
			$user = $this->ion_auth->user()->row();
			if ($user->id==$arrData['id_user']) {
				if ($arrData['file_name']) {
					$update = $this->model->UpdateData(array("num_download"=>($arrData['num_download']+1)),"idx=".$arrData['file_id']);
					
					$file_name = $arrData['file_name'];
					$m_skpa=$this->get_lookup_skpa();
					$skpa = ($arrData['skpa'])?$m_skpa[$arrData['skpa']]:'skpa';
					$file_path = $this->config->item('dir_files').str_replace(" ","_",$skpa)."/";
					$tmp_name = $this->config->item('dir_files').$file_name;
					$new_name = $file_path.$file_name;

					if (file_exists($new_name)) {
						$this->__download($file_name,$file_path,$arrData['file_type']);
					}
				}
			}
		}
	}
	
	function __mime_type($ext) {
		$mime_ext = array (
		
		  // archives
		  'zip' => 'application/zip',
		
		  // documents
		  'pdf' => 'application/pdf',
		  'doc' => 'application/msword',
		  'xls' => 'application/vnd.ms-excel',
		  'ppt' => 'application/vnd.ms-powerpoint',
		  
		  // executables
		  'exe' => 'application/octet-stream',
		
		  // images
		  'gif' => 'image/gif',
		  'png' => 'image/png',
		  'jpg' => 'image/jpeg',
		  'jpeg' => 'image/jpeg',
		
		  // audio
		  'mp3' => 'audio/mpeg',
		  'wav' => 'audio/x-wav',
		
		  // video
		  'mpeg' => 'video/mpeg',
		  'mpg' => 'video/mpeg',
		  'mpe' => 'video/mpeg',
		  'mov' => 'video/quicktime',
		  'avi' => 'video/x-msvideo'
		);
		return $mime_ext[$ext]?$mime_ext[$ext]:'';
	}
	function __download($file_name,$file_path,$file_mime) {
		$file = $file_path.$file_name;
		// file size in bytes
		$fsize = filesize($file); 
		
		// file extension
		$fext = strtolower(substr(strrchr($file_name,"."),1));
		
		$mtype = '';
		  // mime type is not set, get from server settings
		  if (function_exists('mime_content_type')) {
			$mtype = mime_content_type($file);
		  }
		  else if (function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo, $file);
			finfo_close($finfo);  
		  }
		  else if ($file_mime) {
		  	$mtype = $file_mime;
		  }
		  else {
		  	$mtype = $this->__mime_type($fext);
		  }
		  if ($mtype == '') {
			$mtype = "application/force-download";
		  }
		//pre($mtype);
		//pre($fsize);
		//exit;
		// set headers
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: $mtype");
		header("Content-Disposition: attachment; filename=\"$file_name\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $fsize);
		
		// download
		// @readfile($file_path);
		$file = @fopen($file,"rb");
		if ($file) {
		  while(!feof($file)) {
			print(fread($file, 1024*8));
			flush();
			if (connection_status()!=0) {
			  @fclose($file);
			  die();
			}
		  }
		  @fclose($file);
		}
	}
	
	function __view($file_name,$file_path,$file_mime) {
		$file = $file_path.$file_name;
		// file size in bytes
		$fsize = filesize($file); 
		
		// file extension
		$fext = strtolower(substr(strrchr($file_name,"."),1));
		
		$mtype = '';
		  // mime type is not set, get from server settings
		  if (function_exists('mime_content_type')) {
			$mtype = mime_content_type($file);
		  }
		  else if (function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo, $file);
			finfo_close($finfo);  
		  }
		  else if ($file_mime) {
		  	$mtype = $file_mime;
		  }
		  else {
		  	$mtype = $this->__mime_type($fext);
		  }
		  if ($mtype == '') {
			$mtype = "application/force-download";
		  }
		//pre($mtype);
		//pre($fsize);
		//exit;
		// set headers
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: $mtype");
		header("Content-Disposition: inline; filename=\"$file_name\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . $fsize);
		
		// download
		// @readfile($file_path);
		$file = @fopen($file,"rb");
		if ($file) {
		  while(!feof($file)) {
			print(fread($file, 1024*8));
			flush();
			if (connection_status()!=0) {
			  @fclose($file);
			  die();
			}
		  }
		  @fclose($file);
		}
	}
	function kacrut() {
		pre('a');
		$adm_folder = '/var/www/html/brwa_admin/';//$_SERVER['DOCUMENT_ROOT'].$this->config->item('dir_brwa_admin');
		$fix_name = "file_peta_towel.jpg";
		$tmp_name = '/var/www/html/'.$this->config->item('dir_tmp')."towel.jpg";
		$new_name = $adm_folder.$this->config->item('dir_file_peta').$fix_name;
		pre($tmp_name."::".$new_name);
		copy($tmp_name,$new_name);
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