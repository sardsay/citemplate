<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'items';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllItems($count_rows=0,$st=0,$max=0){
        $keyword = $this->input->get('txtsearch');
        $category = $this->input->get('ddcategory');
        $subcategory = $this->input->get('ddsubcategory');
        $source_id = $this->input->get('ddsource');
        $lang = $this->input->get('ddlang');
        if ($keyword !='') {
            $this->db->like('i.title',$keyword);
        }
        if ($category) {
            $this->db->where('c.id',$category);
        }
        if ($subcategory) {
            $this->db->where('i.subcategory_id',$subcategory);
        }
        if ($source_id) {
            $this->db->where('i.source_type',$source_id);
        }
        if ($lang) {
            $this->db->where('i.lang',$lang);
        }else{
            $this->db->where('i.lang','th');
        }
        //$this->db->where('i.lang','th');
        // $this->db->where('i.source_type',1);
        $this->db->where('i.status !=',5);
        
        $this->db->select('i.id,i.title,c.name as category_name,i.lang,i.subcategory_id,i.create_date,i.modify_date,i.status,i.parent_id');
        // $this->db->join('subcategory as s','i.subcategory_id=s.id');    
        $this->db->join('categorys as c','c.id=i.category_id', 'left');    
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table.' as i');
        $this->db->order_by('i.title','asc');
        //$this->db->order_by('i.id','asc');
        $this->Query = $this->db->get();
        if($count_rows==1){
            $this->Rows     =   $this->Query->result(); 
            //echo $str = $this->db->last_query(); exit;
            return count($this->Rows);
        }else{
            // $str = $this->db->last_query(); 
            // echo $str;exit;
            return $this->Rows = $this->Query->result();
        }
        
    }
    public function getItemByID($id){
        $this->db->where('i.id',$id);
        $this->db->select('i.*');
        // $this->db->join('subcategory as s','i.subcategory_id=s.id');    
        // $this->db->join('category as c','c.id=s.parent_id');
        $this->db->from($this->table.' as i');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function getItemByIDAll($id){
        $this->db->where('i.id',$id);
        $this->db->or_where('i.parent_id =', $id);
        $this->db->select('i.*');
        // $this->db->join('subcategory as s','i.subcategory_id=s.id');    
        // $this->db->join('category as c','c.id=s.parent_id');
        $this->db->from($this->table.' as i');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        //echo $str = $this->db->last_query(); exit;
        return $this->Rows;   

    }

    public function addItemData($data=''){
        if ($data!= '') {
            if ($this->db->insert($this->table,$data)) {
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

    }
    public function updateItemData($data=''){
        if ($data!= '') {
            if ($this->db->update($this->table,$data,array('id'=>$data['id'],'lang'=>$data['lang']))) {
                return true;
                
            }else{
                return false;
            }
        }

    }
    public function updateItemRollbackData($data='',$id){
        if ($data!= '') {
            if ($this->db->update($this->table,$data,array('id'=>$id))) {
                if ($this->db->delete('backup_items',array('item_id'=>$id))) {
                    return true;    
                }else{
                    return false;
                }
                
            }else{
                return false;
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
    public function updateImageThumbNameOld($data,$id){
        $this->db->where('id',$id);
        if ($this->db->update('backup_'.$this->table,$data)) {
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->or_where('parent_id',$id);
        if ($this->db->update($this->table,array('status'=>5))) {
            return true;
        }else{
            return false;
        }
    }
    public function getautocompleteItem($keyword){
        $this->db->where('status !=',5);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('title',$keyword, 'after');
        $this->db->where('lang','th');
        // $this->db->where($where);
        // $this->db->where('source_type',1);
        $this->db->select('title');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function getCategoryList(){
        $this->db->select('id,name');
        $this->db->from('categorys');
        $this->db->where('status',1);
        $this->db->order_by('name','asc');
        $this->Query = $this->db->get();
        //echo $str = $this->db->last_query();exit;
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getSubCategoryList(){
        if ($this->input->get('ddcategory')) {
            $this->db->where('parent_id',$this->input->get('ddcategory'));
        }
        $this->db->select('id,name');
        $this->db->from('subcategorys');
        $this->db->where('status',1);
        $this->db->order_by('name','asc');
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
    public function getGalleryByItemID($id,$st,$max){
        $this->db->where('item_id',$id);
        $this->db->select('id,item_id,ordering,status,image_name');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_items');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function delGallery($id){
        $this->db->where('id',$id);
        if ($this->db->delete('gallery_items')) {
            return true;
        }else{
            return false;
        }
    }
    public function getImageName($id){
        $this->db->where('id',$id);
        $this->db->select('image_name');
        $this->Query = $this->db->get('gallery_items');
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->image_name;
    }
    public function getSubcategorysByMID($cate_id){
        $this->db->where('c.id',$cate_id);
        $this->db->select('s.id,s.name');
        $this->db->from('subcategorys as s');
        $this->db->join('categorys as c','c.id = s.parent_id');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;

    }
    public function getItemAllDataByID($id){
        $this->db->where('id',$id);
        $this->db->select('*');
        $this->db->from('items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    
    public function manageTempData($data){
        if ($this->checkTempData($data['item_id'])) {
            $this->db->where('item_id',$data['item_id']);
            if ($this->db->update('backup_items',$data)) {
                if($this->manageTempGallery($data['item_id'])){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            if($this->db->insert('backup_items',$data)){
                if($this->manageTempGallery($data['item_id'])) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
    
    public function getItemTempByID($id){
        // $this->db->where('item_id',$id);
        $this->db->or_where('parent_id',$id);
        $this->db->select('id,title,description,address,telephone,website,working_time,latitude,longitude,image_thumb,lang,category_id,subcategory_id,create_date,modify_date,status,user_create,user_modify');
        $this->Query = $this->db->get('backup_'.$this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getGalleryTempByItemID($id,$st,$max){
        $this->db->where('item_id',$id);
        $this->db->select('id,image_name');
        $this->db->limit($max,$st);
        $this->db->from('backup_gallery_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function getGalleryForTempByItemID($id,$item_id){
        $this->db->where('id',$id);
        $this->db->where('item_id',$item_id);
        $this->db->select('id,item_id,image_name,item_id,ordering,status');
        // $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_items');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function addGalleryTemp($data){
        if($this->db->insert('temp_gallery_items',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function deleteGalleryOldTemp($item_id){
        $this->db->where('item_id',$item_id);
        $this->db->where('data_date',date('Y-m-d'));
        if ($this->db->delete('temp_gallery_items')) {
            return true;
        }else{
            return false;
        }
    }
    public function checkTempData($itemID){
        $this->db->where('item_id',$itemID);
        $this->db->select('count(id) as numRow');
        $this->db->from('backup_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->numRow;
    }
    public function checkGalleryTempData($itemID){
        $this->db->where('item_id',$itemID);
        $this->db->select('count(id) as numRow');
        $this->db->from('temp_gallery_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->numRow;
    }
    public function checkGalleryData($itemID){
        $this->db->where('item_id',$itemID);
        $this->db->select('count(id) as numRow');
        $this->db->from('gallery_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->numRow;
    }
    public function getTempGalleryBYItemID($id){
        $this->db->where('item_id',$id);
        $this->db->from('temp_gallery_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function manageTempGallery($id){
        if ($this->checkGalleryData($id)) {
            $data = $this->getGalleryByItemID($id);
            foreach ($data as $key => $value) {
                $gdata[$key]['item_id'] = $value->item_id;
                $gdata[$key]['image_name'] = $value->image_name;
                $gdata[$key]['ordering'] = $value->ordering;
                $gdata[$key]['status'] = $value->status;
                // $gdata[$key]['data_date'] = date('Y-m-d H:i:s');
            }unset($key,$value);
            if ($this->deleteGalleryBackup($id)) {
                if ($this->db->insert_batch('backup_gallery_items',$gdata)) {
                    if ($this->checkGalleryTempData($id)) {
                        $tdata = $this->getTempGalleryBYItemID($id);
                        foreach ($tdata as $key => $tempdata) {
                            $rawData[$key]['item_id'] = $tempdata->item_id;
                            $rawData[$key]['image_name'] = $tempdata->image_name;
                            $rawData[$key]['ordering'] = $tempdata->ordering;
                            $rawData[$key]['status'] = $tempdata->status;
                            $rawData[$key]['data_date'] = $tempdata->data_date;
                        }
                            if($this->db->insert_batch('backup_gallery_items',$rawData)){
                                $this->db->delete('temp_gallery_items',array('item_id' => $id ));
                                return true;
                            }else{
                                return false;
                            }
                    }else{
                        return true;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }else{
            if ($this->checkGalleryTempData($id)) {
                $tdata = $this->getTempGalleryBYItemID($id);
                foreach ($tdata as $key => $tempdata) {
                    $rawData[$key]['item_id'] = $tempdata->item_id;
                    $rawData[$key]['image_name'] = $tempdata->image_name;
                    $rawData[$key]['ordering'] = $tempdata->ordering;
                    $rawData[$key]['status'] = $tempdata->status;
                    $rawData[$key]['data_date'] = $tempdata->data_date;
                }
                if ($this->deleteGalleryBackup($id)) {
                    if($this->db->insert_batch('backup_gallery_items',$rawData)){
                        $this->db->delete('temp_gallery_items',array('item_id' => $id ));
                        return true;
                    }else{
                        return false;
                    }    
                }else{
                    return false;
                }
                
            }else{
                return true;
            }
        }
    }
    public function deleteGalleryBackup($itemid){
        $this->db->where('item_id',$itemid);
        if($this->db->delete('backup_gallery_items')){
            return true;
        }else{
            return false;
        }
    }
    public function updateGallery($data,$item_id){

        if ($this->db->delete('gallery_items',array('item_id' => $item_id))) {
            if($this->db->insert_batch('gallery_items',$data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }
    public function getAllAmphurChaiyaphum(){
        $this->db->where('PROVINCE_ID',25);
        $this->db->from('amphur');
        $this->db->select('AMPHUR_ID as id,AMPHUR_NAME as name');
        $this->db->order_by('AMPHUR_NAME','asc');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getDistrictByAmphurID($id){
        $this->db->where('PROVINCE_ID',25);
        $this->db->where('AMPHUR_ID',$id);
        $this->db->from('district');
        $this->db->select('DISTRICT_ID as id,DISTRICT_NAME as name');
        $this->db->order_by('DISTRICT_NAME','asc');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getDistrictByAmphur(){
        $this->db->where('PROVINCE_ID',25);
        // $this->db->where('AMPHUR_ID',$id);
        $this->db->from('district');
        $this->db->select('DISTRICT_ID as id,DISTRICT_NAME as name');
        $this->db->order_by('DISTRICT_NAME','asc');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */