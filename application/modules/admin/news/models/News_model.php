<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'news';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllNews($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->get('txtsearch');
        $lang = $this->input->get('ddlang');
        if ($keyword !='') {
            $this->db->like('title',$keyword);
        }
        if ($lang) {
            $this->db->where('lang',$lang);
        }
        
        $this->db->where('status !=',2);
        $this->db->select('id,title,description,data_date,lang,create_date,modify_date,status,user_create,user_modify');
        
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table);
        $this->db->order_by('id DESC');
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
    public function getNewsByID($id){
        $this->db->where('id',$id);
        $this->db->select('id,title,description,data_date,lang,create_date,modify_date,status,user_create,user_modify');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addNewsData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateNewsData($data='',$id){
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
        if ($this->db->delete($this->table)) {
            return true;
        }else{
            return false;
        }
    }
    public function getautocompleteNews($keyword){
        $this->db->where('status !=',2);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('title',$keyword);
        // $this->db->where($where);
        $this->db->select('title');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function addGallery($data){
        if($this->db->insert('gallery_news',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function getGalleryByID($id,$st,$max){
        $this->db->where('news_id',$id);
        $this->db->select('id,image_name');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_news');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function delGallery($id){

        $this->db->where('id',$id);
        if ($this->db->delete('gallery_news')) {
            return true;
        }else{
            return false;
        }
    }
    public function getImageName($id){
        $this->db->where('id',$id);
        $this->db->select('image_name');
        $this->Query = $this->db->get('gallery_news');
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->image_name;
    }
    public function addSchedule($data){
        if ($this->db->insert_batch('schedule',$data)) {
            return true;
        }else{
            return false;
        }
    }
    public function getScheduleByID($id){
        $this->db->where('event_id',$id);
        $this->db->select('*');
        $this->Query = $this->db->get('schedule');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function deleteScheduleByID($id){
        $this->db->where('event_id',$id);
        if($this->db->delete('schedule')){
            return true;
        }else{
            return false;
        }
    }
    /*public function getCategoryList(){
        $this->db->select('id,name');
        $this->db->from('category');
        $this->db->where('status',1);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }*/
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