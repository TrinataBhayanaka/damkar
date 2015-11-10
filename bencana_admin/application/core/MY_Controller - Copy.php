<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
 	function __construct()
 	{
  		parent::__construct();
    }
	
	
	public function info(){
		print get_class($this);
		print get_parent_class($this);
        echo $this->db->platform();
	}
		
	/* adding creator and editor  to data */
	function _add_creator($data){
        $data["created"]=date("Y-m-d H:i:s");
        $data["creator"]=$this->data["users"]["user"]["username"];
        $data["edited"]=date("Y-m-d H:i:s");
        $data["editor"]=$this->data["users"]["user"]["username"];
        return $data;
    }
    
    function _add_editor($data){
        $data["edited"]=date("Y-m-d H:i:s");
        $data["editor"]=$this->data["users"]["user"]["username"];
        return $data;
    }
	
	function _add_ip_address($data){
		//$data["ip_client"]=$this->input->ip_address();
		$data["ip_client"]=$this->_prepare_ip($this->input->ip_address());
		$data["ip_address"]=$data["ip_client"];
		return $data;
	}
	
	
	function _prepare_ip($ip_address) {
	    if ($this->conn->databaseType === 'postgre' || $this->conn->databaseType === 'sqlsrv' || $this->conn->databaseType === 'mssql')
        {
            return $ip_address;
        }
        else
        {
            return inet_pton($ip_address);
        }
       
    }
    
}
