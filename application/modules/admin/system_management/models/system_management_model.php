<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');
class System_Management_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    var $table = 'base_complaint_meeting_status';
	
    public function __construct() {
        parent::__construct();       
    }
    public function getAll(){
    	$data ='';
    	if ($this->input->post()) {
    		$data['val_search'] = $this->input->post('txtsearch',TRUE);
	        $data['val_status'] = $this->input->post('ddstatus',TRUE);
    	}
    	
    	$this->db->select('*');
    	$this->db->from($this->table);
    	if (!empty($data)) {
    		if ($data['val_search']!='') {
    			$this->db->like('name', $data['val_search'], 'both'); 
    		}
    		if ($data['val_status']!='') {
    			$this->db->where('status', $data['val_status']); 
    		}
    	}
    	$this->Query = $this->db->get();
    	return $this->Rows = $this->Query->result();
    }
    public function del($id){
    	$this->db->where('id', $id);
		if($this->db->delete($this->table))
			return true;
		else
			return false;
    }
    public function delGroup($id){
        $this->db->where('id', $id);
        if($this->db->delete('user_groups'))
            return true;
        else
            return false;
    }
    public function delUser($id){
        // $this->db->where('id', $id);
        if($this->db->delete('ndh_users', array('id' => $id)) ) {
            if($this->db->delete('users', array('userID' => $id)))
                return true;
            else
                return false;
        }else{
            return false;
        }
    }
    public function add($data='',$table){
    	if ($data!='') {
    		if($this->db->insert($table,$data))
    			return true;
    		else
    			return false;
    	}
    }
    public function add_returnID($data='',$table){
        if ($data!='') {
            if($this->db->insert($table,$data))
                return $this->db->insert_id();
            else
                return false;
        }
    }

    public function update($data='',$id,$table){
        
        if ($data!='') {
            $this->db->where('id',$id);
            if($this->db->update($table,$data))
                return true;
            else
                return false;
        }
    }
    public function updatek2($data='',$id,$table){
        
        if ($data!='') {
            $this->db->where('userID',$id);
            if($this->db->update($table,$data))
                return true;
            else
                return false;
        }
    }
    public function updateGroup($data='',$id){
        
    	if ($data!='') {
    		$this->db->where('id',$id);
    		if($this->db->update('user_groups',$data))
    			return true;
    		else
    			return false;
    	}
    }
    public function getDataByID($id=''){
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->where('id',$id);
    	$this->Query	=	$this->db->get();
		return $this->Rows		=	$this->Query->result();	
    }
    public function getUserAll(){

        if ($this->input->post('txtsearch',TRUE)!='') {
            $this->db->like('LCASE(u.name)', strtolower($this->input->post('txtsearch',TRUE))); 
        }
        if ($this->input->post('ddstatus',TRUE)!='') {
            $this->db->where('u.status', $this->input->post('ddstatus',TRUE)); 
        }
        $this->db->select('u.id,u.username,u.name,u.lastname,g.name as groupname,u.status');
        $this->db->from('users as u');
        // $this->db->join('users as k2user','u.id=k2user.userID');
        $this->db->join('user_groups as g','u.group_id=g.id');
        // $this->db->where('id !=',$user_id);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getUserDataByID($id){
        $this->db->select('*');
        $this->db->from('users');
        // $this->db->join('ndh_users as u','u.id=k2.userID');
        $this->db->where('id',$id);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getGroupNames(){
        if ($this->input->post('txtsearch',TRUE)!='') {
            $this->db->like('LCASE(name)',strtolower($this->input->post('txtsearch',TRUE)));
        }
        $this->db->select('id,name');
        $this->Query = $this->db->get('user_groups');
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        // echo $str;exit;
    }
    public function getGroupDataBuID($id){
        $this->db->where('id',$id);
        $this->Query = $this->db->get('user_groups');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getRoles(){
        $this->db->select('id,name,menu_id');
        $this->db->from('user_groups');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getMenuLists(){
        $this->db->select('mid,menu,parent_of,level');
        $this->db->where('status',1);
        $this->db->from('menu_setting');
        $this->db->order_by('ordering ASC');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getMainMenuId($parent_of=''){
        if ($parent_of!='') {

            $this->db->select('parent_of');
            $this->db->where('mid',$parent_of);
            $this->db->from('menu_setting');
            $this->db->where('status',1);
            $this->Query = $this->db->get();
            $this->Rows = $this->Query->result();
            return $this->Rows[0]->parent_of;
            // $str = $this->db->last_query(); 
            // echo $str;exit;
        }
    }
    
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */