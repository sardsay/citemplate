<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
	
    public function __construct() {
        parent::__construct();       
    }
    public function getPWDByEmail($email){
        $this->db->where('email',$email);
        $this->db->select('password');
        $this->db->from('users');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->password;
    }

    public function auThenUser($dataSet){
        if ($dataSet != '' && count($dataSet)==2) {
            $this->db->where('status',1);
            $this->db->where('email',$dataSet['email']);
            // $this->db->where('password',$dataSet['pass']);
            $this->db->select('id as user_id,username,shopname,realname,facebook_id,group_id as memtype,email,avatar');
            $this->db->from('users');
            $this->Query = $this->db->get();
            $this->Rows = $this->Query->result();
            return $this->Rows;
        }else{
            return null;
        }

    }
    public function addMember($dataSet){
        if ($dataSet !='' && count($dataSet) >1) {
            if ($this->db->insert('users',$dataSet)) {
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    public function checkSubCateByCateID($id){
    	$this->db->where('parent_id',$id);
    	$this->db->from('subcategorys');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num = count($this->Rows);
    	if ($num > 0) {
    		return 1;
    	}else{
    		return 0;
    	}
    }
    public function getCategoryMain(){
    	$this->db->select('id,name,name_en,name_cn,image_thumb_vertical');
    	$this->db->where('status',1);
    	$this->db->from('categorys');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getItemListByCateID($id,$lang = 'th',$page){

    	$this->db->where('status',1); 
        $this->db->where('subcategory_id',0);   	
        $this->db->where('lang',$lang);
    	$this->db->where('category_id',$id);
    	$this->db->select('id,title,address,website,description,telephone,working_time,modify_date,image_thumb,latitude,longitude,category_id');
    	$this->db->from('items');
        $st = (intval($page)*5)- 5;
        $this->db->limit(5,$st);
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num  = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getItemListBySubCateID($id,$lang = 'th',$page){

        $this->db->where('status',1); 
        $this->db->where('subcategory_id',$id);       
        $this->db->where('lang',$lang);
        // $this->db->where('category_id',$id);
        $this->db->select('id,title,address,website,description,telephone,working_time,modify_date,image_thumb,latitude,longitude,category_id');
        $this->db->from('items');
        $st = (intval($page)*5)- 5;
        $this->db->limit(5,$st);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num  = count($this->Rows);
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
        if ($num > 0) {
            return $this->Rows;
        }else{
            return null;
        }
    }
    public function getSubCategoryByMainID($id,$lang = 'th'){
        $this->db->where('parent_id',$id);
        // $this->db->where('lang',$lang);
        if ($lang == 'th') {
            $this->db->select('id,name,pin_map,name_en,image_thumb_vertical');    
        }else if($lang == 'en'){
            $this->db->select('id,name_en as name,pin_map,name_en,image_thumb_vertical');
        }else{
            $this->db->select('id,name_cn as name,pin_map,name_en,image_thumb_vertical');    
        }
        
        $this->db->where('status',1);
        $this->db->from('subcategorys');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
        if ($num > 0) {
            return $this->Rows;
        }else{
            return null;
        }
    }
    public function getItemDetailByID($item_id){
    	$this->db->where('i.id',$item_id);
    	$this->db->where('i.status',1);
    	$this->db->where('c.status',1);
    	$this->db->select('i.id,i.title,i.image_thumb,i.description,i.address,i.telephone,i.website,i.category_id,i.latitude,i.longitude,c.pin_map,i.working_time,i.subcategory_id,i.user_create,i.lang');
    	$this->db->from('items as i');
    	$this->db->join('categorys as c','i.category_id = c.id');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num  = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getItemDetailForEditByID($item_id){
        $this->db->where('i.id',$item_id);
        $this->db->where('i.status',1);
        $this->db->where('c.status',1);
        $this->db->select('i.id,i.title,i.image_thumb,i.description,i.address,i.telephone,i.website,i.category_id,i.latitude,i.longitude,c.pin_map,i.working_time,i.subcategory_id,i.user_create,i.lang,i.amphur_id,i.district_id');
        $this->db->from('items as i');
        $this->db->join('categorys as c','i.category_id = c.id');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num  = count($this->Rows);
        if ($num > 0) {
            return $this->Rows;
        }else{
            return null;
        }
    }
    public function getAttractionList($lang = 'th'){
    	$this->db->where('i.status',1);
    	$this->db->where('c.status',1);
        $this->db->where('i.lang',$lang);
    	$this->db->select('i.id,i.title,i.image_thumb,i.category_id,i.latitude,i.longitude');
    	$this->db->from('items as i');
    	$this->db->join('category as c','i.category_id = c.id');
    	$this->db->order_by('id','RANDOM');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num  = count($this->Rows);
    	if ($num > 0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
    }
    public function getScheduleByEventID($id){
        $this->db->where('event_id',$id);
        $this->db->select('id,start_date,end_date,start_time,end_time,schedule_detail');
        $this->db->from('schedule');
        // $this->db->where('sm.event_id',$id);
        // $this->db->select('sd.id,sm.start_date,sm.end_date,sd.start_time,sd.end_time,sd.schedule_detail');
        // $this->db->from('schedule_detail as sd');
        // $this->db->join('schedule_maindate as sm','sd.maindate_id=sm.id');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        // echo $this->db->last_query();
        $num = count($this->Rows);
        if ($num > 0) {
            return $this->Rows;
        }else{
            return null;
        }

    }
    public function getEventMainPage($lang = 'th'){
        $this->db->select('e.id,e.event_name,e.event_detail,e.starttime,e.endtime,e.address,e.telephone,e.lang,e.image_thumb,e.latitude,e.longitude');
        $this->db->where('e.endtime >=',date('Y-m-d'));
        // $this->db->where('e.starttime >=','2015-01-30');
        $this->db->where('e.lang',$lang);
        $this->db->where('e.status',1);
        $this->db->from('events as e');
        // $this->db->join('gallery_events as g','e.id = g.event_id');
        $this->db->order_by('e.starttime ASC');
        $this->db->limit(11);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        // echo $str = $this->db->last_query();
        // exit;
        $num = count($this->Rows);
        if ($num > 0) {
        	return $this->Rows;
        }else{

        }
    }
    public function getEventList($lang = 'th',$page){
        $st = ($page * 10)-10;
        $this->db->limit(10,$st);
    	$this->db->where('status',1);
        $this->db->where('lang',$lang);
    	$this->db->select('id,event_name,event_detail,latitude,longitude,image_thumb');
    	$this->db->from('events');
        $this->db->where('endtime >=',date('Y-m-d'));
        $this->db->order_by('starttime ASC');
    	$this->Query = $this->db->get();
    	$this->Rows = $this->Query->result();
    	$num = count($this->Rows);
    	if ($num >0) {
    		return $this->Rows;
    	}else{
    		return null;
    	}
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
    
    public function getGalleryNewsByID($id,$limit=0){
        $this->db->where('news_id',$id);
        $this->db->where('status',1);
        $this->db->select('id,image_name');
        $this->db->from('gallery_news');
        if ($limit != 0) {
            $this->db->limit($limit);
        }
        // $this->db->order_by('ordering ASC');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        // echo $str = $this->db->last_query();
        // exit;
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
    public function searchItem($keyword,$lang = 'th',$cate_id,$sub_id,$ap_id,$page){
    	$this->db->like('title',$keyword,'both');
        if ($ap_id != '') {
            $this->db->where('amphur_id',$ap_id);
        }
        if ($cate_id != '') {
            $this->db->where('category_id',$cate_id);
        }
        if ($sub_id != '') {
            $this->db->where('subcategory_id',$sub_id);
        }
        $st = ($page*10)-10;
        $this->db->limit(10,$st);
    	$this->db->where('status',1);
        $this->db->where('lang',$lang);
    	$this->db->select('id,title,image_thumb');
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
    public function getFavEventByID($id){
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
    public function getNewsList($lang = 'th',$page){
        $st = ($page * 10)-10;
        $this->db->limit(10,$st);
        $this->db->where('status',1);
        $this->db->where('lang',$lang);
        $this->db->select('id,title,description,image_thumb');
        $this->db->from('news');
        $this->db->order_by('data_date DESC');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num >0) {
            return $this->Rows;
        }else{
            return null;
        }
    }
    public function getCategoryMainNameByID($cid = 0,$lang){
        if ($cid != 0 || $cid != '') {
            $this->db->where('id',$cid);
            if ($lang == 'en') {
                $this->db->select('name_en as name');    
            }else if ($lang == 'th') {
                $this->db->select('name');
            }else{
                $this->db->select('name_cn as name');
            }
            $this->Query = $this->db->get('categorys');
            $this->Rows = $this->Query->result();
            return $this->Rows[0]->name;         
        }
    }
    public function getSubCategoryNameByID($sid = 0,$lang){
        if ($sid != 0 || $sid != '') {
            $this->db->where('id',$sid);
            if ($lang == 'en') {
                $this->db->select('name_en as name');    
            }else if ($lang == 'th') {
                $this->db->select('name');
            }else{
                $this->db->select('name_cn as name');
            }
            $this->Query = $this->db->get('subcategorys');
            $this->Rows = $this->Query->result();
            return ($this->Rows[0]->name !=null)?$this->Rows[0]->name:'-';
        }
    }
    public function getNewsDetailByID($id=0){
        if ($id != 0) {
            $this->db->where('id',$id);
            $this->db->where('status',1);
            $this->db->from('news');
            $this->db->select('id,title,description,data_date,create_date,modify_date,lang,user_create');
            $this->Query = $this->db->get();
            $this->Rows = $this->Query->result();
            return $this->Rows;            
        }
    }
    public function getAmphurList($lang = 'th'){
        if ($lang == 'th') {
            $this->db->select('AMPHUR_ID as id,TRIM(AMPHUR_NAME) as name');
        }else if ($lang == 'en') {
            $this->db->select('AMPHUR_ID as id,TRIM(AMPHUR_NAME_ENG) as name');
        }else{
            $this->db->select('AMPHUR_ID as id,TRIM(AMPHUR_NAME_CHN) as name');
        }
        $this->db->where('PROVINCE_ID',25);
        $this->db->from('amphur');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        
    }
    public function getDistrictList($lang = 'th',$amphur_id){
        if ($lang == 'th') {
            $this->db->select('DISTRICT_ID as id,TRIM(DISTRICT_NAME) as name');
        }else if ($lang == 'en') {
            $this->db->select('DISTRICT_ID as id,TRIM(DISTRICT_NAME_ENG) as name');
        }else{
            $this->db->select('DISTRICT_ID as id,TRIM(DISTRICT_NAME_CHN) as name');
        }
        $this->db->where('AMPHUR_ID',$amphur_id);
        $this->db->where('PROVINCE_ID',25);
        $this->db->from('district');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getMainCateList($lang = 'th'){
        if ($lang == 'th') {
            $this->db->select('id,name');
        }else if ($lang == 'en') {
            $this->db->select('id,name_en as name');
        }else{
            $this->db->select('id,name_cn as name');
        }
        $this->db->from('categorys');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getSubCateList($lang = 'th',$main_id=1){
        $this->db->where('parent_id',$main_id);
        if ($lang == 'th') {
            $this->db->select('id,name');
        }else if ($lang == 'en') {
            $this->db->select('id,name_en as name');
        }else{
            $this->db->select('id,name_cn as name');
        }
        $this->db->from('subcategorys');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num >0) {
            return $this->Rows;
        }else{
            return null;
        }
        
    }
    public function getUserNmaeByUserID($id = 1){
        $this->db->where('id',$id);
        $this->db->select('username');
        $this->Query = $this->db->get('users');
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->username;
    }
    public function getCountItemCreateByUserID($id){
        $this->db->where('user_create',$id);
        $this->db->select('count(id) as numall');
        $this->db->from('items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->numall;
    }
    public function checkEmailMember($email){
        $this->db->where('email',$email);
        $this->db->from('users');
        $this->db->select('count(id) as num');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        if ($this->Rows[0]->num > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function updateAvatarByID($filename,$id){
        if ($filename !='' && $id != '') {
            $this->db->where('id',$id);

            if ($this->db->update('users',array('avatar'=>$filename))) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function updateMember($dataSet,$id){
        if ($dataSet !='' && count($dataSet) >1) {
            $this->db->where('id',$id);
            if ($this->db->update('users',$dataSet)) {
                return true;
            }else{
                return false;
            }
        }
    }
    public function checkEmailMemberEdit($email,$id){
        $this->db->where('id',$id);
        $this->db->where('email',$email);
        $this->db->from('users');
        $this->db->select('count(id) as num');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        if ($this->Rows[0]->num > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function addItem($data_set){
        if ($data_set != '' && count($data_set) > 0) {
            if ($this->db->insert('items',$data_set)) {
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    public function getUserData($uid){
        $this->db->where('id',18);
        $this->db->select('id as user_id,username,shopname,realname,facebook_id,group_id as memtype,email,avatar');
        $this->db->from('users');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function addGallery($data){
        if($this->db->insert('gallery_items',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function addGalleryEdit($data){
        if($this->db->insert('gallery_items_mobile',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function addMobileItemEdit($data){
        if($this->db->insert('items_mobile',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function updateItemMobileEdit($dataSet,$id){
        if ($dataSet !='' && count($dataSet) > 1) {
            $this->db->where('id',$id);
            if ($this->db->update('items_mobile',$dataSet)) {
                return true;
            }else{
                return false;
            }
        }
    }
    public function updateMobileItemEdit($dataSet,$id){
        if ($dataSet !='' && count($dataSet) > 1) {
            $this->db->where('item_id',$id);
            if ($this->db->update('items_mobile',$dataSet)) {
                return true;
            }else{
                return false;
            }
        }
    }
    public function checkMobileItemByID($item_id){
        $this->db->where('item_id',$item_id);
        $this->db->select('id');
        $this->db->from('items_mobile');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num > 0) {
            return 1;
        }else{
            return 0;
        }
    }
    public function checkItemStatusByID($item_id){
        $this->db->where('id',$item_id);
        $this->db->where('status',0);
        $this->db->select('id');
        $this->db->from('items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        $num = count($this->Rows);
        if ($num > 0) {
            return 1;
        }else{
            return 0;
        }
    }
    public function getPlaceByUserID($user_id){
        $this->db->where('user_create',$user_id);
        $this->db->select('id,title,image_thumb,status,create_date,modify_date');
        $this->db->from('items');
        $this->db->order_by('id DESC');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function reportItem($user_id,$item_id){
        if ($this->db->insert('items_mobile',array('item_id' => $item_id,'status'=>4,'user_modify'=>$user_id ))) {
            return true;
        }else{
            return false;
        }
    }
    public function updateImageThumbName($data,$id){
        $this->db->where('id',$id);
        if ($this->db->update('items',$data)) {
            return true;
        }else{
            return false;
        }
    }
    public function checkFacebookID($fid){
        $this->db->where('facebook_id',$fid);
        $this->db->select('id');
        $this->db->from('users');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        if (count($this->Rows) > 0) {
            return $this->Rows[0]->id;
        }else{
            return false;
        }
    }
    public function getAvatarByUserID($userID){
        $this->db->where('id',$userID);
        $this->db->select('avatar');
        $this->db->from('users');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->avatar;
    }
    public function getItemStatusMobileTable($id,$itemID){
        $this->db->where('user_modify',$id);
        $this->db->where('item_id',$itemID);
        $this->db->select('status');
        $this->db->from('items_mobile');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        // echo $str = $this->db->last_query();
        // exit;
        if (count($this->Rows) > 0) {
            return $this->Rows[0]->status;    
        }else{
            return null;
        }
        
    }
    public function deleteEditPicMobile($item_id,$filename){
        // $this->db->where('item_id',$item_id);
        // $this->db->where('image_name',$filename);
        if($this->db->insert('gallery_items_mobile',array('item_id'=>$item_id,'image_name'=>$filename,'status'=>0))){
            return true;
        }else{
            return false;
        }
    }
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */