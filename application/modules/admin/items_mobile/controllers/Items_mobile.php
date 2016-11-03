<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_mobile extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        $this->data  = (object)array(); 
    }
	/*public function index()
	{
		$this->load->view('dashboard/welcome_message');
	}*/
    public function index(){
        # set title and header
        $this->load->library('pagination');
        $this->load->model('items_mobile/items_mobile_model');
        $this->template->write('website_name', 'Amazing chaiyaphum : จัดการสถานที่');
        $this->data->Header_title = 'จัดการสถานที่จากแอพพลิเคชั่น';
        $this->data->title = 'รายการสถานที่ทั้งหมด';
        $this->data->allNew = $this->items_mobile_model->getNewItemFromMobile();
        $this->data->allUpdate = $this->items_mobile_model->getUpdateItemFromMobile();

        $this->data->main_active = 'items';

        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/page_main',$this->data);
        $this->template->render(); 
    }
    public function new_index(){
        # set title and header
        $this->load->library('pagination');
        $this->load->model('items_mobile/items_mobile_model');
        $this->template->write('website_name', 'Amazing chaiyaphum : จัดการสถานที่');
        $this->data->Header_title = 'จัดการสถานที่จากแอพพลิเคชั่น';
        $this->data->title = 'รายการสถานที่ทั้งหมด';
        $this->data->ddsubcategory = $this->items_mobile_model->getSubCategoryList();

        $page = $this->input->get('page');
        if($page==0)
        {
          $page=1;
        }
        // set pagination config
        $base_url = base_url().'items/new_index?txtname='.$this->input->get('txtname').'&ddcategory='.$this->input->get('ddcategory').'&ddlang='.$this->input->get('ddlang');
        $uri_segment =3;
        $per_page = 10;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->items_mobile_model->getAllItemsNew(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allItems = $this->items_mobile_model->getAllItemsNew(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->ddcategory = $this->items_mobile_model->getCategoryList();
//        
        // $this->data->allCategorys = $this->items_mobile_model->getAllCategorys();
        # set active menu
        $this->data->main_active = 'items';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/new_main',$this->data);
        $this->template->render(); 
    }
    public function update_index(){
        # set title and header
        $this->load->library('pagination');
        $this->load->model('items_mobile/items_mobile_model');
        $this->template->write('website_name', 'Amazing chaiyaphum : จัดการสถานที่');
        $this->data->Header_title = 'จัดการข้อมูลสถานที่อัพเดทจากแอพพลิเคชั่น';
        $this->data->title = 'รายการสถานที่ทั้งหมด';
        $this->data->ddsubcategory = $this->items_mobile_model->getSubCategoryList();

        $page = $this->input->get('page');
        if($page==0)
        {
          $page=1;
        }
        // set pagination config
        $base_url = base_url().'items/new_index?txtname='.$this->input->get('txtname').'&ddcategory='.$this->input->get('ddcategory').'&ddlang='.$this->input->get('ddlang');
        $uri_segment =3;
        $per_page = 10;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->items_mobile_model->getAllItemsUpdate(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allItems = $this->items_mobile_model->getAllItemsUpdate(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->ddcategory = $this->items_mobile_model->getCategoryList();
//        
        // $this->data->allCategorys = $this->items_mobile_model->getAllCategorys();
        # set active menu
        $this->data->main_active = 'items';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/update_main',$this->data);
        $this->template->render(); 
    }
    /*public function add(){
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'เพิ่มสถานที่';
        $this->data->title = 'รายการสถานทีทั้งหมด่';
        $this->load->model('items_mobile/items_mobile_model');
        $this->data->main_active = 'items';
        
        $this->data->ddcategory = $this->items_mobile_model->getCategoryList();
        $this->data->ddsubcategory = $this->items_mobile_model->getSubCategoryList();
        $this->data->ddamphur = $this->items_mobile_model->getAllAmphurChaiyaphum();
        $this->data->dddistrict = $this->items_mobile_model->getDistrictByAmphur();
        if ($this->input->post()) {
            $ddcategory = $this->input->post('ddcategory');
            $ddsubcategory = $this->input->post('ddsubcategory');
            $txttitle = $this->input->post('txttitle');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txttelephone = $this->input->post('txttelephone');
            $txtwebsite = $this->input->post('txtwebsite');
            $txtworkingtime = $this->input->post('txtworkingtime');
            $txtareadescription = $this->input->post('txtareadescription');
            $txtlatitude = $this->input->post('txtlatitude');
            $txtlongitude = $this->input->post('txtlongitude');
            $ddamphur = $this->input->post('ddamphur');
            $dddistrict = $this->input->post('dddistrict');
            $ddlang = $this->input->post('ddlang');
            $rdstatus = $this->input->post('rdstatus');
            $thumb = $_FILES['thumb_image'];
            $gallery = $_FILES['gallery'];
            
            $error = '';$error_val = '';
            if ($ddcategory == '0'){
                $error['ddcategory'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddcategory'] = $ddcategory;
            }
            
            if ($txttitle == '' || $txttitle ==null){
                $error['txttitle'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txttitle'] = $txttitle;
            }
            
            if ($txtlatitude == '' || $txtlatitude ==null){
                $error['txtlatitude'] = 'กรุณากรอก ละติจูด'; 
            }else{
                  $error_val['val_txtlatitude'] = $txtlatitude;
            }
            if ($txtlongitude == '' || $txtlongitude ==null){
                $error['txtlongitude'] = 'กรุณากรอก ละติจูด'; 
            }else{
                  $error_val['val_txtlongitude'] = $txtlongitude;
            }
            if ($ddamphur == '0'){
                $error['ddamphur'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddamphur'] = $ddamphur;
            }
            if ($dddistrict == '0'){
                $error['dddistrict'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_dddistrict'] = $dddistrict;
            }
            if ($ddlang == '0'){
                $error['ddlang'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddlang'] = $ddlang;
            }
            $error_val['val_txttelephone'] = $txttelephone;
            $error_val['val_txtwebsite'] = $txtwebsite;
            $error_val['val_txtareaaddress'] = $txtareaaddress;
            $error_val['val_txtareadescription'] = $txtareadescription;
            if ($thumb['name'] == '') {
                $error['image_thumb'] = 'กรุณาเลือกไฟล์เพื่อทำการอัพโหลด'; 
                
            }
            
            if ($error == '') {
                $data_set = array('title'=>$txttitle,
                                'description'=> $txtareadescription,
                                'category_id'=> $ddcategory,
                                'subcategory_id'=> $ddsubcategory,
                                'amphur_id'=> $ddamphur,
                                'district_id'=> $dddistrict,
                                'address'=> $txtareaaddress,
                                'telephone'=> $txttelephone,
                                'website'=> $txtwebsite,
                                'working_time'=> $txtworkingtime,
                                'lang'=> $ddlang,
                                'latitude'=> $txtlatitude,
                                'longitude'=> $txtlongitude,
                                'create_date'=> date('Y-m-d H:i:s'),
                                'status'=> $rdstatus,
                                'user_create' => $this->session->userdata('user_id'),
                                'user_modify' => $this->session->userdata('user_id'),
                                );

                if ($id = $this->items_mobile_model->addItemData($data_set)) {
                    if ($id != 0) {
                        if ($thumb_name = $this->upload_image($thumb,'thumb',$id,600,400)) {
                            $thumb_data = array('image_thumb'=>$thumb_name);
                            $this->items_mobile_model->updateImageThumbName($thumb_data,$id);
                        }
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'item_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->items_mobile_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('items_mobile/add','refresh');
                                        exit;
                                    }
                                }       
                            }
                        }
                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('items','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('items_mobile/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('items_mobile/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/add_form',$this->data);
        $this->template->render(); 
    }*/
    public function editnew($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'สถานที่เพิ่มใหม่จากแอพพลเคชั่น';
        $this->data->title = 'รายการสถานทีทั้งหมด่';
        $this->load->model('items_mobile/items_mobile_model');
        $this->data->main_active = 'items';
        
        $this->data->ddcategory = $this->items_mobile_model->getCategoryList();
        $this->data->ddsubcategory = $this->items_mobile_model->getSubCategoryList();
        $this->data->itemdata = $this->items_mobile_model->getItemByID($id);
        $this->data->gallery1 = $this->items_mobile_model->getGalleryByItemID($id,0,5);
        $this->data->gallery2 = $this->items_mobile_model->getGalleryByItemID($id,5,5);
        # badkup data
        // $this->data->itemTempData = $this->items_mobile_model->getItemTempByID($id);
        // $this->data->galleryTemp1 = $this->items_mobile_model->getGalleryTempByItemID($id,0,5);
        // $this->data->galleryTemp2 = $this->items_mobile_model->getGalleryTempByItemID($id,5,5);
        $this->data->ddamphur = $this->items_mobile_model->getAllAmphurChaiyaphum();
        $this->data->dddistrict = $this->items_mobile_model->getDistrictByAmphur();
        
        if ($this->input->post()) {
            
            foreach ($this->data->itemdata as $key => $value) {
                $data_set2['parent_id'] = $value->id;
                $data_set2['title'] = '';
                $data_set2['description'] = '';
                $data_set2['address'] = '';
                $data_set2['telephone'] = $value->telephone;
                $data_set2['website'] = $value->website;
                $data_set2['working_time'] = $value->working_time;
                if ($value->lang == 'th') {
                    $data_set2['lang'] = 'en';
                    $data_set3['lang'] = 'cn';
                }else if ($value->lang == 'en') {
                    $data_set2['lang'] = 'th';
                    $data_set3['lang'] = 'cn';
                }else {
                    $data_set2['lang'] = 'th';
                    $data_set3['lang'] = 'en';
                }
                
                $data_set2['latitude'] = $value->latitude;
                $data_set2['longitude'] = $value->longitude;
                $data_set2['image_thumb'] = $value->image_thumb;
                $data_set2['source_type'] = $value->source_type;
                $data_set2['status'] = 0;
                $data_set2['category_id'] = $value->category_id;
                $data_set2['subcategory_id'] = $value->subcategory_id;
                $data_set2['district_id'] = $value->district_id;
                $data_set2['amphur_id'] = $value->amphur_id;
                $data_set2['province_id'] = $value->province_id;
                $data_set2['create_date'] = $value->create_date;
                $data_set2['modify_date'] = $value->modify_date;
                $data_set2['user_create'] = $value->user_create;

                $data_set3['parent_id'] = $value->id;
                $data_set3['title'] = '';
                $data_set3['description'] = '';
                $data_set3['address'] = '';
                $data_set3['telephone'] = $value->telephone;
                $data_set3['website'] = $value->website;
                $data_set3['working_time'] = $value->working_time;
                $data_set3['latitude'] = $value->latitude;
                $data_set3['longitude'] = $value->longitude;
                $data_set3['image_thumb'] = $value->image_thumb;
                $data_set3['source_type'] = $value->source_type;
                $data_set3['status'] = 0;
                $data_set3['category_id'] = $value->category_id;
                $data_set3['subcategory_id'] = $value->subcategory_id;
                $data_set3['district_id'] = $value->district_id;
                $data_set3['amphur_id'] = $value->amphur_id;
                $data_set3['province_id'] = $value->province_id;
                $data_set3['create_date'] = $value->create_date;
                $data_set3['modify_date'] = $value->modify_date;
                $data_set3['user_create'] = $value->user_create;
            }
            
            $rdstatus = $this->input->post('rdstatus');

            if ($rdstatus != '') {
                $data_set = array(
                                'modify_date'=> date('Y-m-d H:i:s'),
                                'status'=> $rdstatus,
                                'parent_id'=> $this->data->itemdata[0]->id
                                ); 
                
                if ($this->items_mobile_model->updateItemData($data_set,$id)) {
                    $this->items_mobile_model->addItemData($data_set2);
                    $this->items_mobile_model->addItemData($data_set3);
                    $data = array('success_msg' => "แก้ไขสถานะเรียบร้อยแล้ว");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile','refresh');
                    exit;
                            
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขสถานะได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile/editnew/'.$id,'refresh');
                    exit;      
                }                
            }else{
                
                $data = array('error_msg' => "ไม่สามารถแก้ไขสถานะได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile/editnew/'.$id,'refresh');
                    exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/editnew_form',$this->data);
        $this->template->render(); 
    }
    public function editupdate($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'ข้อมูลสถานที่อัพเดทจากแอพพลเคชั่น';
        $this->data->title = 'รายการสถานทีทั้งหมด่';
        $this->load->model('items_mobile/items_mobile_model');
        $this->data->main_active = 'items';
        
        $this->data->ddcategory = $this->items_mobile_model->getCategoryList();
        $this->data->ddsubcategory = $this->items_mobile_model->getSubCategoryList();
        $this->data->itemdata = $this->items_mobile_model->getItemByIDUpdate($id);
        $this->data->gallery1 = $this->items_mobile_model->getGalleryByItemIDUpdate($id,0,5);
        $this->data->gallery2 = $this->items_mobile_model->getGalleryByItemIDUpdate($id,5,5);
        $this->data->gallery1Delete = $this->items_mobile_model->getGalleryByItemIDUpdateDelete($id,0,5);
        $this->data->gallery2Delete = $this->items_mobile_model->getGalleryByItemIDUpdateDelete($id,5,5);
        
        $this->data->ddamphur = $this->items_mobile_model->getAllAmphurChaiyaphum();
        $this->data->dddistrict = $this->items_mobile_model->getDistrictByAmphur();
       
        if ($this->input->post()) {
            
            $rdstatus = $this->input->post('rdstatus');

            if ($rdstatus != '') {
                foreach ($this->data->itemdata as $key => $value) {
                    $data_set['title'] = $value->title;
                    $data_set['description'] = $value->description;
                    $data_set['address'] = $value->address;
                    $data_set['telephone'] = $value->telephone;
                    $data_set['website'] = $value->website;
                    $data_set['working_time'] = $value->working_time;
                    $data_set['latitude'] = $value->latitude;
                    $data_set['longitude'] = $value->longitude;
                    $data_set['image_thumb'] = $value->image_thumb;
                    $data_set['source_type'] = $value->source_type;
                    $data_set['status'] = $rdstatus;
                    $data_set['category_id'] = $value->category_id;
                    $data_set['subcategory_id'] = $value->subcategory_id;
                    $data_set['district_id'] = $value->district_id;
                    $data_set['amphur_id'] = $value->amphur_id;
                    $data_set['province_id'] = $value->province_id;
                    $data_set['create_date'] = $value->create_date;
                    $data_set['modify_date'] = date('Y-m-d H:i:s');
                    $data_set['user_modify'] = $this->session->userdata('user_id');

                    $data_set2['telephone'] = $value->telephone;
                    $data_set2['website'] = $value->website;
                    $data_set2['working_time'] = $value->working_time;
                    $data_set2['latitude'] = $value->latitude;
                    $data_set2['longitude'] = $value->longitude;
                    $data_set2['image_thumb'] = $value->image_thumb;
                    $data_set2['source_type'] = $value->source_type;
                    $data_set2['status'] = $rdstatus;
                    $data_set2['category_id'] = $value->category_id;
                    $data_set2['subcategory_id'] = $value->subcategory_id;
                    $data_set2['district_id'] = $value->district_id;
                    $data_set2['amphur_id'] = $value->amphur_id;
                    $data_set2['province_id'] = $value->province_id;
                    $data_set2['modify_date'] = date('Y-m-d H:i:s');
                    $data_set2['user_modify'] = $this->session->userdata('user_id');

                    
                }
                // $data_set = array(
                //                 'modify_date'=> date('Y-m-d H:i:s'),
                //                 'status'=> $rdstatus,
                //                 'user_modify'=>$this->session->userdata('user_id')
                //                 ); 
                
                if ($rdstatus ==3) {
                    if ($this->data->gallery1Delete !='') {
                        foreach ($this->data->gallery1Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                
                            }
                        }unset($value,$key);
                    }
                    if ($this->data->gallery2Delete !='') {
                        foreach ($this->data->gallery2Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                
                            }
                        }unset($value,$key);
                    }
                }
                if ($rdstatus ==5) {
                    if ($this->data->gallery1Delete !='') {
                        foreach ($this->data->gallery1Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                
                            }
                        }unset($value,$key);
                    }
                    if ($this->data->gallery2Delete !='') {
                        foreach ($this->data->gallery2Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                
                            }
                        }unset($value,$key);
                    }
                }
                if ($rdstatus == 1) {
                    if ($this->data->gallery1Delete !='') {
                        foreach ($this->data->gallery1Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                $this->items_mobile_model->deleteGalleryItem($value->image_name,$id);
                            }
                        }unset($value,$key);
                    }
                    if ($this->data->gallery2Delete !='') {
                        foreach ($this->data->gallery2Delete as $key => $value) {
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/'.$value->image_name)) {
                                $this->items_mobile_model->deleteGalleryItem($value->image_name,$id);
                            }
                        }unset($value,$key);
                    }
                    if ($this->data->gallery1 !='') {
                        foreach ($this->data->gallery1 as $key => $value) {
                            $image1Data = array(
                                                'item_id'=>$id,
                                                'image_name'=> $value->image_name,
                                                'status'=>1
                                                );
                            $this->items_mobile_model->addGallery($image1Data);
                        }unset($value,$key);
                    }
                    if ($this->data->gallery2 !='') {
                        foreach ($this->data->gallery2 as $key => $value) {
                            $image1Data = array(
                                                'item_id'=>$id,
                                                'image_name'=> $value->image_name,
                                                'status'=>1
                                                );
                            $this->items_mobile_model->addGallery($image1Data);
                        }unset($value,$key);
                    }
                }
                if ($this->items_mobile_model->updateItemDataUpdate($data_set,$id)) {
                    $this->items_mobile_model->updateOtherLang($data_set2);
                    $data = array('success_msg' => "แก้ไขสถานะเรียบร้อยแล้ว");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile','refresh');
                    exit;
                            
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขสถานะได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile/editupdate/'.$id,'refresh');
                    exit;      
                }                
            }else{
                
                $data = array('error_msg' => "ไม่สามารถแก้ไขสถานะได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items_mobile/editupdate/'.$id,'refresh');
                    exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items_mobile/editupdate_form',$this->data);
        $this->template->render(); 
    }
    
    private function upload_image($file,$type,$id,$width,$height){

            
            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('items_mobile/add','refresh');
                exit;
            }
            $file_path = URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/';
            
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
                        
            }
            $file_path = URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/';
            
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
                        
            }
            if ($type == 'thumb') {
                $rawfilename = 'thumb_item'.$id;
            }else if ($type == 'gallery') {
                // $rawfilename = 'item_'.$id.'_'.$no;
            }
            if ($type== 'pincate') {
                $arr_typefiles = array('.png');
            }else{
                $arr_typefiles = array('.png','.jpg','.jpeg','.JPG');    
            }
            
            $fileicon = $file['name'];
            $ext = strrchr($fileicon, '.');
            $filename = $rawfilename.$ext;
            if (in_array($ext, $arr_typefiles)) {

               if (move_uploaded_file($file['tmp_name'], $file_path . $filename)) {
                    
                    if($display = $this->resizeImage($file_path.$filename,$width,$height)){
                        return $filename;        
                    }else{
                        return $display;
                    }
                }else{
                    return false;
                }

            }else{
                return false;
                

            }
    }
    private function upload_Gallery($file_name,$file_tmp,$id,$width,$height,$no){
            
            $file_path = URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/';
            
            $rawfilename = 'item_'.$id.'_'.date('YmdHis').'_'.$no;
            
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
            }
            $file_path = URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/gallerys/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
            }
            $arr_typefiles = array('.png','.jpg','.jpeg','.JPG');    
            $fileicon = $file_name;
            $ext = strrchr($fileicon, '.');
            $filename = $rawfilename.$ext;
            if (in_array($ext, $arr_typefiles)) {

               if (move_uploaded_file($file_tmp, $file_path . $filename)) {
                    
                    if($display = $this->resizeImage($file_path.$filename,$width,$height)){
                        return $filename;        
                    }else{
                        return $display;
                    }
                }else{
                    return false;
                }

            }else{
                return false;
            }
    }
    public function deleteNew(){
        $id = $this->input->post('item_id',TRUE);
        if ($id!='') {
            $this->load->model('items_mobile/items_mobile_model');
            if ($this->items_mobile_model->deleteNew($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    public function deleteUpdate(){
        $id = $this->input->post('item_id',TRUE);
        if ($id!='') {
            $this->load->model('items_mobile/items_mobile_model');
            if ($this->items_mobile_model->deleteUpdate($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    public function pagination_page($base_usl,$uri_segment,$per_page,$total_rows){
        $config['base_url'] = $base_usl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page; 
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbers']  = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['prev_tag_open'] = $config['next_tag_open'] = '<li>';
        $config['prev_tag_close'] = $config['next_tag_close'] = '</li>'; 
        $config['num_tag_open'] = $config['first_tag_open'] = $config['last_tag_open'] ='<li>';
        $config['num_tag_close'] = $config['first_tag_close'] = $config['last_tag_close'] ='</li>';
        // $config['attributes']['rel'] = FALSE;
        $this->pagination->initialize($config); 
        return $this->pagination->create_links();
    }
    public function get_AutocompleteNew(){
        $string = $this->input->get('keyword');
        $this->load->model('items_mobile/items_mobile_model');
        $rawdata = $this->items_mobile_model->getautocompleteItemNew($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->title);
        }
        echo  json_encode($source);
        unset($term,$data,$source,$datac);
    }
    public function get_AutocompleteUpdate(){
        $string = $this->input->get('keyword');
        $this->load->model('items_mobile/items_mobile_model');
        $rawdata = $this->items_mobile_model->getautocompleteItemUpdate($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->title);
        }
        echo  json_encode($source);
        unset($term,$data,$source,$datac);
    }
    public function resizeImage($urlpath,$width,$height){
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $urlpath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['create_thumb'] = FALSE;
        $config['overwrite'] = TRUE;
        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        
        if (!$this->image_lib->resize()){
            echo  $this->image_lib->display_errors();exit;
        }else{
            return true;
        }
    }
    
    public function get_delfile(){
        $id = $this->input->post('fid');
        $main_id = $this->input->post('eid');
        $this->load->model('items_mobile/items_mobile_model');
        $dataRaw = $this->items_mobile_model->getGalleryForTempByItemID($main_id);
        $dataSet = [];
        foreach ($dataRaw as $key => $value) {
            $dataSet['item_id'] = $value->item_id;
            $dataSet['image_name'] = $value->image_name;
            $dataSet['ordering'] = $value->ordering;
            $dataSet['status'] = $value->status;
            $dataSet['data_date'] = date('Y-m-d');
        }
        // echo json_encode($dataSet);
        if ($this->items_mobile_model->addGalleryTemp($dataSet)) {
            if ($this->items_mobile_model->delGallery($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }

        // $image_name = $this->items_mobile_model->getImageName($id);
        // if(unlink($_SERVER['DOCUMENT_ROOT'].'/phetja/'.URLPATH_UPLOAD_ITEMIMAGES.($main_id%10).'/'.$main_id.'/gallerys/'.$image_name)){
        /*    if ($this->items_mobile_model->delGallery($id)) {
                echo 1;
            }else{
                echo 0;
            }*/
        // }
        exit;
    }
    public function get_subcaterys(){
        $cate_id = $this->input->post('cateID');
        $this->load->model('items_mobile/items_mobile_model');
        $data = $this->items_mobile_model->getSubcategorysByMID($cate_id);
        // echo json_encode($data);
        $text = '<option value="0">กรุณาเลือกหมวดหมู่ย่อย</option>';
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $text .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }    
        }
        echo $text;
        exit;
    }
    public function get_amphurs(){
        $id = $this->input->post('amphurID');
        $this->load->model('items_mobile/items_mobile_model');
        $data = $this->items_mobile_model->getDistrictByAmphurID($id);
        // echo json_encode($data);
        $text = '<option value="0">กรุณาเลือกตำบล</option>';
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $text .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }    
        }
        echo $text;
        exit;
    }
    // public function test(){
    //     $title='bmta test';
    //     $message='message test';
    //     $data = array(
    //                 'alert' => $title.' '.$message,
    //                 'sound' => 'default',
    //                 'badge' => 1,
    //                 'pubDate' => date('Y-m-d'),
    //                 'title' => htmlentities($title, ENT_QUOTES,'UTF-8'),
    //                 'description' =>htmlentities($message, ENT_QUOTES,'UTF-8')

                
    //         );
    //     echo json_encode($data);
    // }
        
}
