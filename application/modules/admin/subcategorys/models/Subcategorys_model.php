<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class SubCategorys_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'subcategorys';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllCategorys($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->post('txtsearchCate');
        $ddmaincategory = $this->input->post('ddmaincategory');
        if ($keyword !='') {
            $this->db->like('s.name',$keyword);
        }
        if ($ddmaincategory != 0) {
            $this->db->where('c.id',$ddmaincategory);
        }
        $this->db->where('s.status !=',2);
        $this->db->where('c.status',1);
        $this->db->select('s.id,s.name,s.name_en,s.name_cn,s.status,c.name as maincate');
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table.' as s');
        $this->db->join('categorys as c', 'c.id = s.parent_id');

        $this->Query = $this->db->get();
        if($count_rows==1){
            $this->Rows     =   $this->Query->result(); 
            // $str = $this->db->last_query(); 
            // echo $str;exit;
            return count($this->Rows);
        }else{
            return $this->Rows = $this->Query->result();
        }
        
    }
    public function getCategoryByID($cate_id){
        $this->db->where('id',$cate_id);
        $this->db->select('id,name,name_en,name_cn,parent_id,status,image_thumb_vertical,pin_map');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addCateData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateCateData($data='',$id){
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
    public function delete($cate_id){
        $this->db->where('id',$cate_id);
        if ($this->db->delete($this->table)) {
            return true;
        }else{
            return false;
        }
    }
    public function getautocompleteCate($keyword){
        $this->db->where('status !=',2);
        $where = '(name LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->where($where);
        $this->db->select('name');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function getMainCategory(){
        $this->db->where('status !=',2);
        $this->db->select('id,name');
        $this->db->from('categorys');
        $this->Query = $this->db->get();
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