<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getNewsByStatus($status){
        $this->db->select('count(id) as num');
        
        $this->db->where('status',$status);
        $this->db->from('news');
        // $this->db->where('show_main',1);
        // $this->db->limit(4);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->num;

    }
    public function getCategoryByStatus($status){
    	$this->db->select('count(id) as num');
    	
    	$this->db->where('status',$status);
    	$this->db->from('categorys');
    	// $this->db->where('show_main',1);
    	// $this->db->limit(4);
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	return $this->Rows[0]->num;

    }
    
    public function getItemByStatus($status){
    	$this->db->where('status',$status);
    	$this->db->select('count(id) as num');
    	$this->db->from('items');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	return $this->Rows[0]->num;
    }
    
    public function getEventByStatus($status){
        $this->db->select('count(id) as num');
        $this->db->where('status',$status);
        $this->db->from('events');
        // $this->db->join('gallery_events as g','e.id = g.event_id');
        // $this->db->order_by('e.starttime ASC');
        // $this->db->limit(11);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        // echo $str = $this->db->last_query();
        // exit;
        return $this->Rows[0]->num;
    }
    public function getEventAll(){
    	$this->db->where('status != ',2);
        
    	$this->db->select('count(id) as num');
    	$this->db->from('events');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	return $this->Rows[0]->num;
    }
    public function getNewsAll(){
        $this->db->where('status != ',2);
        
        $this->db->select('count(id) as num');
        $this->db->from('news');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->num;
    }
    public function getItemAll(){
        $this->db->where('status != ',2);
        
        $this->db->select('count(id) as num');
        $this->db->from('items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->num;
    }
    public function getCateAll(){
        $this->db->where('status != ',2);
        
        $this->db->select('count(id) as num');
        $this->db->from('categorys');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->num;
    }
    public function getEventByID($id){
    	$this->db->where('status',1);
    	$this->db->where('id',$id);
    	$this->db->select('id,event_name,event_detail,starttime,endtime,address,telephone,latitude,longitude');
    	$this->db->from('events');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getGalleryEventByID($id,$limit=0){
    	$this->db->where('event_id',$id);
    	$this->db->where('status',1);
    	$this->db->select('id,image_name');
    	$this->db->from('gallery_events');
    	$this->db->order_by('ordering ASC');
    	if ($limit !=0 ) {
    		$this->db->limit($limit);
    	}
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	// echo $str = $this->db->last_query();
     //    exit;
    	$num = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}

    }
    public function getGalleryItemByID($id){
    	$this->db->where('item_id',$id);
    	$this->db->where('status',1);
    	$this->db->select('id,image_name');
    	$this->db->from('gallery_items');
    	$this->db->order_by('ordering ASC');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	// echo $str = $this->db->last_query();
     //    exit;
    	$num = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}

    }
    public function searchEvent($keyword,$lang='th'){
    	$this->db->like('event_name',$keyword,'both');
    	$this->db->where('status',1);
        $this->db->where('lang',$lang);
    	$this->db->select('id,event_name,event_detail,latitude,longitude,image_thumb');
    	$this->db->from('events');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	// echo $str = $this->db->last_query();
     //    exit;
    	$num = count($this->Rows);
    	if ($num >0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function searchItem($keyword,$lang = 'th'){
    	$this->db->like('title',$keyword,'both');
    	$this->db->where('status',1);
        $this->db->where('lang',$lang);
    	$this->db->select('id,title,image_thumb,latitude,longitude');
    	$this->db->from('items');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	// echo $str = $this->db->last_query();
     //    exit;
    	$num = count($this->Rows);
    	if ($num >0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getItemDataUpdate($date){
    	$this->db->where('modify_date >=',$date);
    	$this->db->where('status',1);
    	$this->db->select('id,title,description,address,telephone,website,lang,latitude,longitude,image_thumb,category_id,status,modify_date');
    	$this->db->from('items');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num = count($this->Rows);
    	if ($num > 0 ) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getPinMapByCateID($id){
        $this->db->where('id',$id);
        $this->db->select('pin_map');
        $this->Query = $this->db->get('categorys');
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num > 0) {
            return $this->Rows[0]->pin_map;
        }else{
            return null;
        }

    }
    public function getNearBy($lat,$long,$lang='th'){
        // $this->db->where('');
        $sql ="SELECT *,( 6371 * acos( cos( radians(".$this->db->escape_str($lat).")) * cos( radians( b.latitude ) ) * cos( radians( b.longitude ) - radians(".$this->db->escape_str($long).") ) + sin( radians(".$this->db->escape_str($lat).") ) * sin( radians( b.latitude ) ) ) ) AS distance ";
        $sql.=" FROM items as b ";
        $sql.=" WHERE latitude IS NOT NULL AND status =1 ";
        $sql.=" AND lang = '".$lang."'";
        $sql.=" HAVING  distance < 20";
        $sql.=" ORDER BY distance ASC ";
        $sql.=" LIMIT 100";
        $this->Query = $this->db->query($sql);
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num > 0) {
            return $this->Rows;    
        }else{
            return null;
        }
        

    }
    public function getFavItemByID($id)
    {

        $this->db->where('id',$id);
        $this->db->select('id,title,image_thumb,latitude,longitude,category_id,status');
        $this->db->from('items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num  = count($this->Rows);
        if ($num > 0) {
            return $this->Rows;
        }else{
            return null;
        }

    }
    public function getFavEventByID($id)
    {
        
        $this->db->where('id',$id);
        $this->db->select('id,event_name,event_detail,latitude,longitude,image_thumb,status');
        $this->db->from('events');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num >0) {
            return $this->Rows;
        }else{
            return null;
        }
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