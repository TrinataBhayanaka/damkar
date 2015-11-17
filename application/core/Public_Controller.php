<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
		
		sanitizeAllRequestData();
		
		$this->load->library('ion_auth');
        if($this->config->item('site_open') === FALSE)
        {
            show_error('Sorry the site is shut for now.');
        }
    	if ($this->ion_auth->logged_in())
		{
		
			$obj=$this->ion_auth->user()->result_array();
			$arr=(array)$obj;
			$this->data['users']["user"] =$arr[0]; 
			$this->data['users']["groups"]=$this->ion_auth->get_users_groups($arr["id"])->result_array();
			$this->user_data=$arr[0];
		}
		$this->load->model("user/link_manager_model");
        $this->link_model=$this->link_manager_model;
		
		$this->load->model("general_model");
		$this->cfg_model=new general_model("cms_configuration");
		
		$this->cms_cfg=array();
		$this->cmsConfiguration();
		
		$this->encrypt_status=FALSE;
		if($this->config->item("encrypt_id_enable")):
			$this->encrypt_status=TRUE;
		endif;
		
		$this->render_footer();
    }
	
	function cmsConfiguration() {
		$cms_cfg=$this->cfg_model->SearchRecord();
		if (cek_array($cms_cfg)) {
			foreach($cms_cfg as $k=>$v) {
				$this->cms_cfg[$v['id_key']]=nl2br($v['value']);
			}
		}
	}
	
	function cleanInput($input) {
 
	  $search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	  );
 
		$output = preg_replace($search, '', $input);
		return $output;
	}
	
	function render_footer() {
		$this->footer_link_list();
		//$this->footer_pp_list();
	}
	function footer_link_list($forder=0,$limit=5,$page=1){
		$this->footer_link_list=$this->link_model->search_by_category(false,5,0);
	}
	function footer_pp_list($forder=0,$limit=5,$page=1){
		$this->footer_pp_list=$this->pp_model->category_search_record();
	}
}