<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'users';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllUsers($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->post('txtsearch');
        
        if ($keyword !='') {
            $this->db->like('u.realname',trim($keyword));
        }
        $this->db->select('u.id,u.realname as name,u.username,u.status,u.create_date,u.modify_date,g.name as group_name');

        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table.' as u');
        $this->db->join('user_groups as g','u.group_id=g.id');
        $this->Query = $this->db->get();
        if($count_rows==1){
            $this->Rows     =   $this->Query->result(); 
            // $str = $this->db->last_query(); 
            // echo $str;exit;
            return count($this->Rows);
        }else{
            // $str = $this->db->last_query(); 
            // echo $str;exit;
            return $this->Rows = $this->Query->result();
        }
        
    }
    public function getUserByID($id){
        $this->db->where('id',$id);
        $this->db->select('id,shopname,realname,address,phone,email,username,status,group_id,create_date,modify_date');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addUserData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateUserData($data='',$id){
        if ($data!= '') {
            $this->db->where('id',$id);
            if ($this->db->update($this->table,$data)) {
                return true;
            }else{
                return 0;
            }
        }

    }
    public function updateImageThumbName($data,$id){
        $this->db->where('id',$id);
        if ($this->db->update($this->table,$data)) {
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        $this->db->where('id',$id);
        if ($this->db->update($this->table,array('status'=>2))) {
            return true;
        }else{
            return false;
        }
    }
    public function getautocompleteUser($keyword){
        $this->db->where('status !=',2);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('name',$keyword);
        // $this->db->where($where);
        $this->db->select('name as title');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function getGroupList(){
        $this->db->select('id,name');
        // $this->db->where('id !=',1);
        $this->db->order_by('name ASC');
        $this->Query = $this->db->get('user_groups');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    /*public function getAllData($count_rows=0,$st=0,$max=0){
    	
		$this->db->select('*');
		if($max!=0)
		$this->db->limit($max,$st);

		$this->Query	=	$this->db->get('mobile_servicepoint');
		if($count_rows==1){
			$this->Rows		=	$this->Query->result();	
			return count($this->Rows);
		}else{
			return $this->Rows		=	$this->Query->result();
		}
		$this->Query->free_result();

    }*/
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */