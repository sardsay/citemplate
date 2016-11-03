<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'events';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllEvents($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->get('txtsearch');
        $lang = $this->input->get('ddlang');
        $startdate = $this->input->get('txtstartdate');
        $enddate = $this->input->get('txtenddate');
        if ($keyword !='') {
            $this->db->like('event_name',$keyword);
        }
        if ($lang) {
            $this->db->where('lang',$lang);
        }
        if ($startdate != '' && $enddate != '') {
            $this->db->where('starttime >=',date('Y-m-d',strtotime($startdate)));
            $this->db->where('endtime <=',date('Y-m-d',strtotime($enddate)));
        }else if ($startdate != '') {
            $this->db->where('starttime',date('Y-m-d',strtotime($startdate)));
        }else if ($enddate != '') {
            $this->db->where('endtime',date('Y-m-d',strtotime($enddate)));
        }
        
        $this->db->where('status !=',2);
        $this->db->select('id,event_name,starttime,endtime,lang,create_date,modify_date,status');
        
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table);
        $this->db->order_by('starttime ASC');
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
    public function getEventByID($id){
        $this->db->where('id',$id);
        $this->db->select('id,event_name,event_detail,image_thumb,starttime,endtime,lang,create_date,modify_date,status,address,telephone,latitude,longitude');
        $this->Query = $this->db->get($this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function addEventData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateEventData($data='',$id){
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
    public function getautocompleteEvent($keyword){
        $this->db->where('status !=',2);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('event_name',$keyword);
        // $this->db->where($where);
        $this->db->select('event_name');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function addGallery($data){
        if($this->db->insert('gallery_events',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function getGalleryByID($id,$st,$max){
        $this->db->where('event_id',$id);
        $this->db->select('id,image_name');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_events');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function delGallery($id){

        $this->db->where('id',$id);
        if ($this->db->delete('gallery_events')) {
            return true;
        }else{
            return false;
        }
    }
    public function getImageName($id){
        $this->db->where('id',$id);
        $this->db->select('image_name');
        $this->Query = $this->db->get('gallery_events');
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