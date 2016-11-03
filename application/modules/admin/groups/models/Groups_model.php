<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'user_groups';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllGroups($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->post('txtsearch');
        
        if ($keyword !='') {
            $this->db->like('name',$keyword);
        }
        $this->db->select('id,name,status');
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table);

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
    public function getGroupByID($id){
        $this->db->where('id',$id);
        $this->db->select('id,name,status');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addGroupData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateGroupData($data='',$id){
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
    public function getautocompleteGroup($keyword){
        $this->db->where('status !=',2);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('name',$keyword);
        $this->db->select('name as title');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
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