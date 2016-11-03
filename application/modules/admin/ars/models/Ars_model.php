<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Ars_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'ar_list';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllArs($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->get('txtsearch');
    
        if ($keyword !='') {
            $this->db->like('title',$keyword);
        }
        
        $this->db->where('status !=',2);
        $this->db->select('*');
        
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table);
        $this->db->order_by('id ASC');
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
    public function getArByID($id){
        $this->db->where('id',$id);
        $this->db->select('*');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addArData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateArData($data='',$id){
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
        if ($this->db->delete($this->table,array('id' => $id))) {
            return true;
        }else{
            return false;
        }
    }
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */