<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Items_mobile_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
    public $table = 'items';
	
    public function __construct() {
        parent::__construct();       
    }
    
    public function getAllItemsUpdate($count_rows=0,$st=0,$max=0){
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
        if ($lang) {
            $this->db->where('i.lang',$lang);
        }
        if ($subcategory) {
            $this->db->where('i.subcategory_id',$subcategory);
        }
        if ($source_id) {
            $this->db->where('i.source_type',$source_id);
        }
        $this->db->where('i.source_type',2);
        $this->db->where('i.status !=',5);
        $this->db->where('i.status !=',3);
        $this->db->where('i.status !=',1);
        $this->db->select('i.item_id as id,i.title,c.name as category_name,i.lang,i.subcategory_id,i.create_date,i.modify_date,i.status');
        $this->db->join('categorys as c','c.id=i.category_id');    
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table.'_mobile as i');

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
    public function getAllItemsNew($count_rows=0,$st=0,$max=0){
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
        if ($lang) {
            $this->db->where('i.lang',$lang);
        }
        if ($subcategory) {
            $this->db->where('i.subcategory_id',$subcategory);
        }
        if ($source_id) {
            $this->db->where('i.source_type',$source_id);
        }
        $this->db->where('i.source_type',2);
        $this->db->where('i.status !=',5);
        $this->db->where('i.status !=',1);
        $this->db->where('i.status !=',0);
        $this->db->where('i.status !=',3);
        $this->db->select('i.id,i.title,c.name as category_name,i.lang,i.subcategory_id,i.create_date,i.modify_date,i.status');
        $this->db->join('categorys as c','c.id=i.category_id');    
        if ($max!=0) {
            $this->db->limit($max,$st);
        }
        $this->db->from($this->table.' as i');

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
    public function getItemByID($id){
        $this->db->where('i.id',$id);
        $this->db->select('*');
        // $this->db->join('subcategory as s','i.subcategory_id=s.id');    
        // $this->db->join('category as c','c.id=s.parent_id');
        $this->db->from($this->table.' as i');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;   

    }
    public function getItemByIDUpdate($id){
        $this->db->where('i.item_id',$id);
        $this->db->select('i.item_id as id,i.title,i.description,i.address,i.telephone,i.website,i.working_time,i.latitude,i.longitude,i.image_thumb,i.category_id,i.district_id,i.amphur_id,i.lang,i.subcategory_id,i.create_date,i.modify_date,i.status');
        // $this->db->join('subcategory as s','i.subcategory_id=s.id');    
        // $this->db->join('category as c','c.id=s.parent_id');
        $this->db->from($this->table.'_mobile as i');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
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
    public function updateItemData($data='',$id){
        if ($data!= '') {
            $this->db->where('id',$id);
            if ($this->db->update($this->table,$data)) {
                if ($data['status'] == 3) {
                    $this->db->delete('gallery_items',array('item_id'=>$id,'status'=>0));
                }else if ($data['status'] == 1) {
                    $this->db->update('gallery_items',array('status'=>1),array('item_id'=>$id,'status'=>0));
                }
                return true;
            }else{
                return 0;
            }
        }

    }
    public function updateItemDataUpdate($data='',$id){
        if ($data!= '') {
            if ($data['status'] == 5) {
                $this->db->update($this->table,$data,array('id'=>$id));
                // $this->db->delete('items_mobile',array('item_id'=>$id));
                if($this->db->delete(array('gallery_items','items_mobile'),array('item_id'=>$id))){
                    return true;
                }else{
                    return false;
                }    

            }else if($data['status'] == 3){
                
                if ($this->db->update($this->table.'_mobile',$data,array('item_id'=>$id))) {
                    $this->db->delete('gallery_items_mobile',array('item_id'=>$id));
                    return true;
                }else{
                    return false;
                }    
            }else if ($data['status'] == 1) {
                
                $this->db->update($this->table,$data,array('id'=>$id));
                if ($this->db->delete($this->table.'_mobile',array('item_id'=>$id))) {
                    return true;
                }else{
                    return false;
                }
                
            }
            
        }

    }
    public function updateOtherLang($data,$parent_id){
        if ($this->db->update($this->table,array('parent_id'=>$parent_id))) {
            return true;
        }else{
            return false;
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
    public function deleteNew($id){
        $this->db->where('id',$id);
        if ($this->db->update($this->table,array('status'=>5))) {
            $this->db->delete('gallery_items',array('item_id'=>$id));
            return true;
        }else{
            return false;
        }
    }
    public function deleteUpdate($id){
        $this->db->where('item_id',$id);
        if ($this->db->update($this->table.'_mobile',array('status'=>5))) {
            return true;
        }else{
            return false;
        }
    }
    public function getautocompleteItemNew($keyword){
        $this->db->where('status',2);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('title',$keyword);
        $this->db->where('source_type',2);
        $this->db->select('title');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
        // $str = $this->db->last_query(); 
        //     echo $str;exit;
    }
    public function getautocompleteItemUpdate($keyword){
        $this->db->where('status !=',5);
        $this->db->where('status !=',3);
        // $where = '(title LIKE "%'.$keyword.'%" OR name_en LIKE "%'.$keyword.'%")';
        $this->db->like('title',$keyword);
        $this->db->where('source_type',2);
        $this->db->select('title');
        $this->db->from($this->table.'_mobile');
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
        $this->Query = $this->db->get();
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
        $this->db->select('id,image_name');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_items');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getGalleryByItemIDUpdate($id,$st,$max){
        $this->db->where('status',1);
        $this->db->where('item_id',$id);
        $this->db->select('id,image_name,status');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_items_mobile');
        $this->Rows = $this->Query->result();
        if (count($this->Rows) > 0) {
            return $this->Rows;    
        }else{
            return "";
        }
        
    }
    public function getGalleryByItemIDUpdateDelete($id,$st,$max){
        $this->db->where('status',0);
        $this->db->where('item_id',$id);
        $this->db->select('id,image_name,status');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('gallery_items_mobile');
        $this->Rows = $this->Query->result();
        if (count($this->Rows) > 0) {
            return $this->Rows;    
        }else{
            return "";
        }
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
    public function addTempItemData($data){
        if($this->checkTempData($data['item_id'])){
            $this->db->where('item_id',$data['item_id']);
            if ($this->db->update('temp_items',$data)) {
                return true;
            }else{
                return false;
            }
        }else{
            if($this->db->insert('temp_itmes',$data)){
                return true;
            }else{
                return false;
            }
        }
    }
    public function getItemTempByID($id){
        $this->db->where('id',$id);
        $this->db->select('id,title,description,address,telephone,website,latitude,longitude,image_thumb,lang,subcategory_id,create_date,modify_date,status,user_create,user_modify');
        $this->Query = $this->db->get('temp_'.$this->table);
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getGalleryTempByItemID($id,$st,$max){
        $this->db->where('item_id',$id);
        $this->db->select('id,image_name');
        $this->db->limit($max,$st);
        $this->Query = $this->db->get('temp_gallery_items');
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getGalleryForTempByItemID($id){
        $this->db->where('item_id',$id);
        $this->db->select('image_name,item_id,ordering,status');
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
        $this->db->from('temp_items');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows[0]->numRow;
    }
    public function getAllAmphurChaiyaphum(){
        $this->db->where('PROVINCE_ID',25);
        $this->db->from('amphur');
        $this->db->select('AMPHUR_ID as id,AMPHUR_NAME as name');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getDistrictByAmphurID($id){
        $this->db->where('PROVINCE_ID',25);
        $this->db->where('AMPHUR_ID',$id);
        $this->db->from('district');
        $this->db->select('DISTRICT_ID as id,DISTRICT_NAME as name');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getDistrictByAmphur(){
        $this->db->where('PROVINCE_ID',25);
        // $this->db->where('AMPHUR_ID',$id);
        $this->db->from('district');
        $this->db->select('DISTRICT_ID as id,DISTRICT_NAME as name');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getNewItemFromMobile(){
        $this->db->where('source_type',2);
        $this->db->where('status',2);
        $this->db->select('id');
        $this->db->from($this->table);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return count($this->Rows);
    }
    public function getUpdateItemFromMobile(){
        $this->db->where('source_type',2);
        // $this->db->where('status',2);
        $this->db->select('id');
        $this->db->from($this->table.'_mobile');
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return count($this->Rows);
    }
    public function deleteGalleryItem($filename,$id){
        $this->db->where('item_id',$id);
        $this->db->where('image_name',$filename);
        if ($this->db->delete('gallery_items')) {
            return true;
        }else{
            return false;
        }
    }
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */