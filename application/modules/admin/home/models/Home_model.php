<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
	
    public function __construct() {
        parent::__construct();       
    }

    public function getDefalutMenu(){
    	if (isset($this->session->userdata)) {

    		$menu = $this->session->userdata('menu');
            // print_r($menu);exit;
    		foreach ($menu as $key => $value) {

    			$this->db->select('class,method,parent_of,level');
    			$this->db->where('mid',$value);
    			$this->Query = $this->db->get('menu_setting');
    			$this->Rows = $this->Query->result();
    			foreach ($this->Rows as $key => $mdata) {
    				if ($mdata->class!='') {
    					if ($mdata->method!='index') {
    						return $default = $mdata->class.'/'.$mdata->method;
    					}else{
    						return $mdata->class;
    					}	
    				}
    			}
    		}
    		

    	}
    	
    }
    public function Access_Level($class,$method){
        $this->db->where('class',$class);
        $this->db->where('method',$method);
        $this->db->select('mid');
        $this->Query = $this->db->get('menu_setting');
        $this->Rows = $this->Query->result_array();
        return $this->Rows[0]['mid'];
    }
    
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */