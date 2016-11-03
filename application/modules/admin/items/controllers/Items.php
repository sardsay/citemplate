<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MX_Controller {

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
        $this->load->model('items/items_model');
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'จัดการสถานที่';
        $this->data->title = 'รายการสถานที่ทั้งหมด';
        $this->data->ddsubcategory = $this->items_model->getSubCategoryList();
        # start add js for this page
        // $this->template->add_chart_js(URLPATH_JS.'morris/chart-data-morris.js');
//        $this->template->add_css(URLPATH_CSS.'plugins/dataTables/dataTables.bootstrap.css');
//        $this->template->add_js(URLPATH_JS.'plugins/dataTables/jquery.dataTables.js');
//        $this->template->add_js(URLPATH_JS.'plugins/dataTables/dataTables.bootstrap.js');
        # end add js for this page
        # query data 
        //load model (folder/model)

        $page = $this->input->get('page');
        if($page==0)
        {
          $page=1;
        }
        // set pagination config
        $base_url = base_url().'items?txtsearch='.$this->input->get('txtsearch').'&ddcategory='.$this->input->get('ddcategory').'&ddlang='.$this->input->get('ddlang').'&ddsubcategory='.$this->input->get('ddsubcategory');
        $uri_segment =3;
        $per_page = 10;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->items_model->getAllItems(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allItems = $this->items_model->getAllItems(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->ddcategory = $this->items_model->getCategoryList();
//        
        // $this->data->allCategorys = $this->items_model->getAllCategorys();
        # set active menu
        $this->data->main_active = 'items';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'เพิ่มสถานที่';
        $this->data->title = 'รายการสถานทีทั้งหมด่';
        $this->load->model('items/items_model');
        $this->data->main_active = 'items';
        
        $this->data->ddcategory = $this->items_model->getCategoryList();
        $this->data->ddsubcategory = $this->items_model->getSubCategoryList();
        $this->data->ddamphur = $this->items_model->getAllAmphurChaiyaphum();
        $this->data->dddistrict = $this->items_model->getDistrictByAmphur();
        if ($this->input->post()) { 
            
            // thai
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
            $ddlang = "th";
            $ddamphur = $this->input->post('ddamphur');
            $dddistrict = $this->input->post('dddistrict');
            $rdstatus = $this->input->post('rdstatus');
            $thumb = $_FILES['thumb_image'];
            $gallery = $_FILES['gallery'];
            
            // eng
            $ddcategory2 = $this->input->post('ddcategory');
            $ddsubcategory2 = $this->input->post('ddsubcategory');
            $txttitle2 = $this->input->post('txttitle2');
            $txtareaaddress2 = $this->input->post('txtareaaddress2');
            $txttelephone2 = $this->input->post('txttelephone');
            $txtwebsite2 = $this->input->post('txtwebsite');
            $txtworkingtime2 = $this->input->post('txtworkingtime');
            $txtareadescription2 = $this->input->post('txtareadescription2');
            $txtlatitude2 = $this->input->post('txtlatitude');
            $txtlongitude2 = $this->input->post('txtlongitude');
            $ddlang2 = "en";
            $ddamphur2 = $this->input->post('ddamphur');
            $dddistrict2 = $this->input->post('dddistrict');
            $rdstatus2 = $this->input->post('rdstatus');
            $thumb2 = $_FILES['thumb_image'];
            $gallery2 = $_FILES['gallery'];
            
            // china
            $ddcategory3 = $this->input->post('ddcategory');
            $ddsubcategory3 = $this->input->post('ddsubcategory');
            $txttitle3 = $this->input->post('txttitle3');
            $txtareaaddress3 = $this->input->post('txtareaaddress3');
            $txttelephone3 = $this->input->post('txttelephone');
            $txtwebsite3 = $this->input->post('txtwebsite');
            $txtworkingtime3 = $this->input->post('txtworkingtime');
            $txtareadescription3 = $this->input->post('txtareadescription3');
            $txtlatitude3 = $this->input->post('txtlatitude');
            $txtlongitude3 = $this->input->post('txtlongitude');
            $ddlang3 = "cn";
            $ddamphur3 = $this->input->post('ddamphur');
            $dddistrict3 = $this->input->post('dddistrict');
            $rdstatus3 = $this->input->post('rdstatus');
            $thumb3 = $_FILES['thumb_image'];
            $gallery3 = $_FILES['gallery'];
            
            $error = '';$error_val = '';
            if ($ddcategory == '0'){
                $error['ddcategory'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddcategory'] = $ddcategory;
            }
            // if ($ddsubcategory == '0'){
            //     $error['ddsubcategory'] = 'กรุณาเลือกหมวดหมู่'; 
            // }else{
            //     $error_val['val_ddsubcategory'] = $ddsubcategory;
            // }
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
                $data_setTH = array(
                    'title'=>$txttitle,
                    'description'=>$txtareadescription,
                    'category_id'=> $ddcategory,
                    'subcategory_id'=> $ddsubcategory,
                    'amphur_id'=> $ddamphur,
                    'district_id'=> $dddistrict,
                    'address'=>$txtareaaddress,
                    'telephone'=>$txttelephone,
                    'website'=>$txtwebsite,
                    'working_time'=>$txtworkingtime,
                    'lang'=>$ddlang,
                    'latitude'=>$txtlatitude,
                    'longitude'=>$txtlongitude,
                    'create_date'=>date('Y-m-d H:i:s'),
                    'status'=>$rdstatus,
                    'user_create' => $this->session->userdata('user_id'),
                    'user_modify' => $this->session->userdata('user_id'),
                    );

                //print_r($data_setTH); exit;
                if ($id = $this->items_model->addItemData($data_setTH)) {
                    
                    $data_setEN = array(
                        'title'=>$txttitle2,
                        'description'=>$txtareadescription2,
                        'category_id'=> $ddcategory2,
                        'subcategory_id'=> $ddsubcategory2,
                        'amphur_id'=> $ddamphur2,
                        'district_id'=> $dddistrict2,
                        'address'=>$txtareaaddress2,
                        'telephone'=>$txttelephone2,
                        'website'=>$txtwebsite2,
                        'working_time'=>$txtworkingtime2,
                        'lang'=>$ddlang2,
                        'latitude'=>$txtlatitude2,
                        'longitude'=>$txtlongitude2,
                        'create_date'=>date('Y-m-d H:i:s'),
                        'status'=>$rdstatus2,
                        'parent_id'=>$id,
                        'user_create' => $this->session->userdata('user_id'),
                        'user_modify' => $this->session->userdata('user_id'),
                        );
                    $data_setCN = array(
                        'title'=>$txttitle3,
                        'description'=>$txtareadescription3,
                        'category_id'=> $ddcategory3,
                        'subcategory_id'=> $ddsubcategory3,
                        'amphur_id'=> $ddamphur3,
                        'district_id'=> $dddistrict3,
                        'address'=>$txtareaaddress3,
                        'telephone'=>$txttelephone3,
                        'website'=>$txtwebsite3,
                        'working_time'=>$txtworkingtime3,
                        'lang'=>$ddlang3,
                        'latitude'=>$txtlatitude3,
                        'longitude'=>$txtlongitude3,
                        'create_date'=>date('Y-m-d H:i:s'),
                        'status'=>$rdstatus3,
                        'parent_id'=>$id,
                        'user_create' => $this->session->userdata('user_id'),
                        'user_modify' => $this->session->userdata('user_id'),
                        );

                    $this->items_model->addItemData($data_setEN);
                    $this->items_model->addItemData($data_setCN);
                    
                    if ($id != 0) {
                        if ($thumb_name = $this->upload_image($thumb,'thumb',$id,600,400)) {
                            $thumb_data = array('image_thumb'=>$thumb_name);
                            $this->items_model->updateImageThumbName($thumb_data,$id);
                        }
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'item_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->items_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('items/add','refresh');
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
                        redirect('items/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('items/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('items/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items/add_form',$this->data);
        $this->template->render(); 
    }
    public function edit($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        // echo $id; exit;
        $this->template->write('website_name', 'จัดการสถานที่');
        $this->data->Header_title = 'แก้ไขการสถานที่';
        $this->data->title = 'รายการสถานทีทั้งหมด่';
        $this->load->model('items/items_model');
        $this->data->main_active = 'items';
        
        $this->data->ddcategory = $this->items_model->getCategoryList();
        $this->data->ddsubcategory = $this->items_model->getSubCategoryList();
        $this->data->itemdata = $this->items_model->getItemByIDAll($id);
        $this->data->gallery1 = $this->items_model->getGalleryByItemID($id,0,10);
        //$this->data->gallery2 = $this->items_model->getGalleryByItemID($id,5,5);
        # badkup data
        $this->data->itemTempData = $this->items_model->getItemTempByID($id);
        $this->data->galleryTemp1 = $this->items_model->getGalleryTempByItemID($id,0,10);

        //$this->data->galleryTemp2 = $this->items_model->getGalleryTempByItemID($id,5,5);
        $this->data->ddamphur = $this->items_model->getAllAmphurChaiyaphum();
        $this->data->dddistrict = $this->items_model->getDistrictByAmphur();
        // echo '<pre>';
        // print_r($this->data->itemTempData);
        // echo '</pre>';
        // exit;
        if ($this->input->post() && $this->input->post('save')=='submit') {
            
            $ddcategory = $this->input->post('ddcategory');
            $ddsubcategory = $this->input->post('ddsubcategory');
            $txttelephone = $this->input->post('txttelephone');
            $txtworkingtime = $this->input->post('txtworkingtime');
            $txtwebsite = $this->input->post('txtwebsite');

            $txttitle = $this->input->post('txttitle');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txtareadescription = $this->input->post('txtareadescription');

            $txttitle2 = $this->input->post('txttitle2');
            $txtareaaddress2 = $this->input->post('txtareaaddress2');
            $txtareadescription2 = $this->input->post('txtareadescription2');

            $txttitle3 = $this->input->post('txttitle3');
            $txtareaaddress3 = $this->input->post('txtareaaddress3');
            $txtareadescription3 = $this->input->post('txtareadescription3');


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
            /*if ($ddsubcategory == '0'){
                $error['ddsubcategory'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddsubcategory'] = $ddsubcategory;
            }*/
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
            
            if ($ddlang == '0'){
                $error['ddlang'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddlang'] = $ddlang;
            }
            $error_val['val_txttelephone'] = $txttelephone;
            $error_val['val_txtwebsite'] = $txtwebsite;
            $error_val['val_txtareaaddress'] = $txtareaaddress;
            $error_val['val_txtareadescription'] = $txtareadescription;
            
                if ($this->input->post('version') == 'current') {
                    if ($error == '') {
                        $oData = [];
                    
                        foreach ($this->data->itemdata as $key => $oitem) {
                            if ($oitem->lang == 'th') {
                                $temp_id = $oitem->id;
                                $oData['id'] = $oitem->id;
                                $oData['item_id'] = $oitem->id;
                                $oData['parent_id'] = $oitem->parent_id;
                                $oData['title'] = $oitem->title;
                                $oData['description'] = $oitem->description;
                                $oData['category_id'] = $oitem->category_id;
                                $oData['subcategory_id'] = $oitem->subcategory_id;
                                $oData['amphur_id'] = $oitem->amphur_id;
                                $oData['district_id'] = $oitem->district_id;
                                $oData['address'] = $oitem->address;
                                $oData['telephone'] = $oitem->telephone;
                                $oData['lang'] = $oitem->lang;
                                $oData['image_thumb'] = $oitem->image_thumb;
                                $old_image_filename = $oitem->image_thumb;
                                $source_type = $oitem->source_type;
                                $oData['source_type'] = $oitem->source_type;
                                $oData['website'] = $oitem->website;
                                $oData['working_time'] = $oitem->working_time;
                                $oData['latitude'] = $oitem->latitude;
                                $oData['longitude'] = $oitem->longitude;
                                $oData['create_date'] = $oitem->create_date;
                                $oData['modify_date'] = $oitem->modify_date;
                                $oData['status'] = $oitem->status;
                                $oData['user_create'] = $oitem->user_create;
                                $oData['user_modify'] = $oitem->user_modify;
                            }
                            
                        }unset($key,$oitem);

                        foreach ($this->data->itemdata as $key => $oitem) {
                            if ($oitem->lang == 'en') {
                                $temp_id2 = $oitem->id;
                                $oData2['id'] = $oitem->id;
                                $oData2['item_id'] = $oitem->id;
                                $oData2['parent_id'] = $id;
                                $oData2['title'] = $oitem->title;
                                $oData2['description'] = $oitem->description;
                                $oData2['category_id'] = $oitem->category_id;
                                $oData2['subcategory_id'] = $oitem->subcategory_id;
                                $oData2['amphur_id'] = $oitem->amphur_id;
                                $oData2['district_id'] = $oitem->district_id;
                                $oData2['address'] = $oitem->address;
                                $oData2['telephone'] = $oitem->telephone;
                                $oData2['lang'] = $oitem->lang;
                                $oData2['image_thumb'] = $oitem->image_thumb;
                                $old_image_filename = $oitem->image_thumb;
                                $oData2['source_type'] = $oitem->source_type;
                                $oData2['website'] = $oitem->website;
                                $oData2['working_time'] = $oitem->working_time;
                                $oData2['latitude'] = $oitem->latitude;
                                $oData2['longitude'] = $oitem->longitude;
                                $oData2['create_date'] = $oitem->create_date;
                                $oData2['modify_date'] = $oitem->modify_date;
                                $oData2['status'] = $oitem->status;
                                $oData2['user_create'] = $oitem->user_create;
                                $oData2['user_modify'] = $oitem->user_modify;
                            }
                            
                        }unset($key,$oitem);

                        foreach ($this->data->itemdata as $key => $oitem) {
                            if ($oitem->lang == 'cn') {
                                $temp_id3 = $oitem->id;
                                $oData3['id'] = $oitem->id;
                                $oData3['item_id'] = $oitem->id;
                                $oData3['parent_id'] = $id;
                                $oData3['title'] = $oitem->title;
                                $oData3['description'] = $oitem->description;
                                $oData3['category_id'] = $oitem->category_id;
                                $oData3['subcategory_id'] = $oitem->subcategory_id;
                                $oData3['amphur_id'] = $oitem->amphur_id;
                                $oData3['district_id'] = $oitem->district_id;
                                $oData3['address'] = $oitem->address;
                                $oData3['telephone'] = $oitem->telephone;
                                $oData3['lang'] = $oitem->lang;
                                $oData3['image_thumb'] = $oitem->image_thumb;
                                $old_image_filename = $oitem->image_thumb;
                                $oData3['source_type'] = $oitem->source_type;
                                $oData3['website'] = $oitem->website;
                                $oData3['working_time'] = $oitem->working_time;
                                $oData3['latitude'] = $oitem->latitude;
                                $oData3['longitude'] = $oitem->longitude;
                                $oData3['create_date'] = $oitem->create_date;
                                $oData3['modify_date'] = $oitem->modify_date;
                                $oData3['status'] = $oitem->status;
                                $oData3['user_create'] = $oitem->user_create;
                                $oData3['user_modify'] = $oitem->user_modify;
                            }
                            
                        }


                        $data_set = array(
                                        'id'=>$temp_id,
                                        'title'=> $txttitle,
                                        // 'parent_id' => $id,
                                        'description'=> $txtareadescription,
                                        'category_id'=> $ddcategory,
                                        'subcategory_id'=> $ddsubcategory,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $txtareaaddress,
                                        'telephone'=> $txttelephone,
                                        'website'=> $txtwebsite,
                                        'lang'=> 'th',
                                        'working_time'=>$txtworkingtime,
                                        'source_type' => $source_type,
                                        'latitude'=> $txtlatitude,
                                        'longitude'=> $txtlongitude,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $rdstatus,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                        $data_set2 = array(
                                        'id'=>$temp_id2,
                                        'title'=> $txttitle2,
                                        'parent_id' => $id,
                                        'description'=> $txtareadescription2,
                                        'category_id'=> $ddcategory,
                                        'subcategory_id'=> $ddsubcategory,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $txtareaaddress2,
                                        'telephone'=> $txttelephone,
                                        'website'=> $txtwebsite,
                                        'lang'=> 'en',
                                        'working_time'=>$txtworkingtime,
                                        'source_type' => $source_type,
                                        'latitude'=> $txtlatitude,
                                        'longitude'=> $txtlongitude,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $rdstatus,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                        $data_set3 = array(
                                        'id'=>$temp_id3,
                                        'title'=> $txttitle3,
                                        'parent_id' => $id,
                                        'description'=> $txtareadescription3,
                                        'category_id'=> $ddcategory,
                                        'subcategory_id'=> $ddsubcategory,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $txtareaaddress3,
                                        'telephone'=> $txttelephone,
                                        'website'=> $txtwebsite,
                                        'lang'=> 'cn',
                                        'working_time'=>$txtworkingtime,
                                        'source_type' => $source_type,
                                        'latitude'=> $txtlatitude,
                                        'longitude'=> $txtlongitude,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $rdstatus,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                        
                        if ($this->items_model->manageTempData($oData)) {
                            $this->items_model->manageTempData($oData2);
                            $this->items_model->manageTempData($oData3);
                             if ($this->items_model->updateItemData($data_set)) {
                                $this->items_model->updateItemData($data_set2);
                                $this->items_model->updateItemData($data_set3);
                                    if ($id != 0) {
                                        if ($thumb['name'] !='' && $thumb['name']!=null) {
                                            if ($thumb_name = $this->upload_imageEdit($thumb,'thumb',$id,600,400,'current',$old_image_filename)) {
                                                $thumb_data = array('image_thumb'=>$thumb_name);
                                                $this->items_model->updateImageThumbName($thumb_data,$id);
                                                $back_file_image = explode('.', $old_image_filename);
                                                $thumb_data2 = array('image_thumb'=>$back_file_image[0].'_bk.'.$back_file_image[1]);
                                                $this->items_model->updateImageThumbNameOld($thumb_data2,$id);
                                            }
                                        }
                                            for ($i=0; $i <count($gallery['name']) ; $i++) { 
                                                if ($gallery['name'][$i] != '') {
                                                    if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                                        $thumb_data = array(
                                                            'image_name'=>$gname,
                                                            'item_id'=>$id,
                                                            'status'=>'1'
                                                            );
                                                        if (!$this->items_model->addGallery($thumb_data)) {
                                                            $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                                            # parse value msg to show error or succsess data for a while. 
                                                            $this->session->set_flashdata('msg',$data);
                                                            redirect('items/add','refresh');
                                                            exit;
                                                        }
                                                    }       
                                                }
                                            }
                                            $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                                            # parse value msg to show error or succsess data for a while. 
                                            $this->session->set_flashdata('msg',$data);
                                            redirect('items','refresh');
                                            exit;
                                    }else{
                                        $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('items/edit/'.$id,'refresh');
                                        exit;
                                    }
                                        
                                }else{
                                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                    # parse value msg to show error or succsess data for a while. 
                                    $this->session->set_flashdata('msg',$data);
                                    redirect('items/edit/'.$id,'refresh');
                                    exit;
                                }
                         }else{
                            $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                            # parse value msg to show error or succsess data for a while. 
                            $this->session->set_flashdata('msg',$data);
                            redirect('items/edit/'.$id,'refresh');
                            exit;
                         }
                    }else{
                
                        $this->session->set_flashdata('error_form',$error);
                        $this->session->set_flashdata('error_val',$error_val);
                        redirect('items/edit/'.$id,'refresh');
                        exit;
                    }

                }else{ // re backup
                    /*foreach ($this->data->itemdata as $key => $oitem) {
                            $temp_id = $oitem->id;
                            $oData['id'] = $oitem->id;
                            $oData['item_id'] = $oitem->id;
                            $oData['title'] = $oitem->title;
                            $oData['description'] = $oitem->description;
                            $oData['category_id'] = $oitem->category_id;
                            $oData['subcategory_id'] = $oitem->subcategory_id;
                            $oData['amphur_id'] = $oitem->amphur_id;
                            $oData['district_id'] = $oitem->district_id;
                            $oData['address'] = $oitem->address;
                            $oData['telephone'] = $oitem->telephone;
                            $oData['lang'] = $oitem->lang;
                            $oData['image_thumb'] = $oitem->image_thumb;
                            $old_image_filename = $oitem->image_thumb;
                            $oData['source_type'] = $oitem->source_type;
                            $oData['website'] = $oitem->website;
                            $oData['working_time'] = $oitem->working_time;
                            $oData['latitude'] = $oitem->latitude;
                            $oData['longitude'] = $oitem->longitude;
                            $oData['create_date'] = $oitem->create_date;
                            $oData['modify_date'] = $oitem->modify_date;
                            $oData['status'] = $oitem->status;
                            $oData['user_create'] = $oitem->user_create;
                            $oData['user_modify'] = $oitem->user_modify;
                        }*/
                        foreach ($this->data->itemTempData as $key => $tempItem) {
                            if ($tempItem->lang == 'th') {
                                $temp_id = $tempItem->id;
                                $data_Tempset = array(
                                        'parent_id'=>$tempItem->id,
                                        'title'=> $tempItem->title,
                                        'description'=> $tempItem->description,
                                        'category_id'=> $tempItem->category_id,
                                        'subcategory_id'=> $tempItem->subcategory_id,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $tempItem->address,
                                        'telephone'=> $tempItem->telephone,
                                        'website'=> $tempItem->website,
                                        'lang'=> $tempItem->lang,
                                        'image_thumb'=> $tempItem->image_thumb,
                                        'working_time'=>$tempItem->working_time,
                                        'source_type' => $tempItem->source_type,
                                        'latitude'=> $tempItem->latitude,
                                        'longitude'=> $tempItem->longitude,
                                        'create_date' =>$tempItem->create_date,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $tempItem->status,
                                        'user_create' => $tempItem->user_create,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                            }
                            if ($tempItem->lang == 'en') {
                                $temp_id2 = $tempItem->id;
                                $data_Tempset2 = array(
                                        'parent_id'=>$tempItem->id,
                                        'title'=> $tempItem->title,
                                        'description'=> $tempItem->description,
                                        'category_id'=> $tempItem->category_id,
                                        'subcategory_id'=> $tempItem->subcategory_id,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $tempItem->address,
                                        'telephone'=> $tempItem->telephone,
                                        'website'=> $tempItem->website,
                                        'lang'=> $tempItem->lang,
                                        'image_thumb'=> $tempItem->image_thumb,
                                        'working_time'=>$tempItem->working_time,
                                        'source_type' => $tempItem->source_type,
                                        'latitude'=> $tempItem->latitude,
                                        'longitude'=> $tempItem->longitude,
                                        'create_date' =>$tempItem->create_date,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $tempItem->status,
                                        'user_create' => $tempItem->user_create,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                            }
                            if ($tempItem->lang == 'cn') {
                                $temp_id3 = $tempItem->id;
                                $data_Tempset3 = array(
                                        'parent_id'=>$tempItem->id,
                                        'title'=> $tempItem->title,
                                        'description'=> $tempItem->description,
                                        'category_id'=> $tempItem->category_id,
                                        'subcategory_id'=> $tempItem->subcategory_id,
                                        'amphur_id'=> $ddamphur,
                                        'district_id'=> $dddistrict,
                                        'address'=> $tempItem->address,
                                        'telephone'=> $tempItem->telephone,
                                        'website'=> $tempItem->website,
                                        'lang'=> $tempItem->lang,
                                        'image_thumb'=> $tempItem->image_thumb,
                                        'working_time'=>$tempItem->working_time,
                                        'source_type' => $tempItem->source_type,
                                        'latitude'=> $tempItem->latitude,
                                        'longitude'=> $tempItem->longitude,
                                        'create_date' =>$tempItem->create_date,
                                        'modify_date'=> date('Y-m-d H:i:s'),
                                        'status'=> $tempItem->status,
                                        'user_create' => $tempItem->user_create,
                                        'user_modify' => $this->session->userdata('user_id'),
                                        );
                            }
                            
                            $temp_image = $tempItem->image_thumb;

                        }
                        $gallery_data1 = '';$gallery_data2 = '';
                        if ($this->data->galleryTemp1 != '') {
                            foreach ($this->data->galleryTemp1 as $key => $gvalue1) {
                                $gallery_data1[$key] = array(
                                                            'image_name'=>$gvalue1->image_name,
                                                            'item_id'=>$id,
                                                            'status'=>'1',
                                                            'data_date'=>''
                                                            );
                            }    
                        }

                        
                        
                        if ($this->items_model->updateItemRollbackData($data_Tempset,$temp_id)) {
                            $this->items_model->updateItemRollbackData($data_Tempset2,$temp_id2);
                            $this->items_model->updateItemRollbackData($data_Tempset3,$temp_id3);
                            if ($gallery_data1 != '') {
                                if ($this->items_model->updateGallery($gallery_data1,$id)) {
                                    
                                        
                                }    
                            }
                            $renameDB = explode('.', $temp_image);
                            if (unlink(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/'.$old_image_filename)) {
                                if (rename(FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/thumb_item'.$id.'_bk.'.$renameDB[1],FCPATH.URLPATH_UPLOAD_ITEMIMAGES.($id%10).'/'.$id.'/thumb_item'.$id.'.'.$renameDB[1])) {
                                    $thumb_data = array('image_thumb'=>'thumb_item'.$id.'.'.$renameDB[1]);
                                    $this->items_model->updateImageThumbName($thumb_data,$id);
                                }
                            }
                            $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                            # parse value msg to show error or succsess data for a while. 
                            $this->session->set_flashdata('msg',$data);
                            redirect('items','refresh');
                            exit;
                        
                        }else{
                            $this->session->set_flashdata('error_form',$error);
                            $this->session->set_flashdata('error_val',$error_val);
                            redirect('items/edit/'.$id,'refresh');
                            exit;
                        }
                     
                }
                
            
        }else if ($this->input->post('save')=='cancel') {
            redirect('items','refresh');
            exit;
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','items/edit_form',$this->data);
        $this->template->render(); 
    }
    private function upload_image($file,$type,$id,$width,$height){
            
            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('items/add','refresh');
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
    private function upload_imageEdit($file,$type,$id,$width,$height,$action,$oldFilename){
            
            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('items/add','refresh');
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
                $bk_file = explode(".", $oldFilename);
                
                if (file_exists(FCPATH.$file_path . 'thumb_image'.$id.'_bk.'.$bk_file[1])) {
                        if(unlink(FCPATH.$file_path . 'thumb_image'.$id.'_bk.'.$bk_file[1])){
                            if (move_uploaded_file($file['tmp_name'], $file_path . $filename)) {
                                if($display = $this->resizeImage($file_path.$filename,$width,$height)){
                                    return $filename;
                                }else{
                                    return $display;
                                }
                            }else{
                                return false;
                            }
                            
                        }
                }else{
                    
                    if(rename(FCPATH.$file_path .$oldFilename, FCPATH.$file_path . $bk_file[0].'_bk.'.$bk_file[1])){
        
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
                        echo 'rename false';exit;
                    }                        
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
            $filename = $rawfilename.strtolower($ext);
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
    public function delete(){
        $id = $this->input->post('item_id',TRUE);
        if ($id!='') {
            $this->load->model('items/items_model');
            if ($this->items_model->delete($id)) {
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
    public function get_Autocomplete(){
        $string = $this->input->get('keyword');
        $this->load->model('items/items_model');
        $rawdata = $this->items_model->getautocompleteItem($string);
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
        $this->load->model('items/items_model');
        $dataRaw = $this->items_model->getGalleryForTempByItemID($id, $main_id);
        $dataSet = [];
        foreach ($dataRaw as $key => $value) {
            $dataSet['id'] = $value->id;
            $dataSet['item_id'] = $value->item_id;
            $dataSet['image_name'] = $value->image_name;
            $dataSet['ordering'] = $value->ordering;
            $dataSet['status'] = $value->status;
            $dataSet['data_date'] = date('Y-m-d');
        }
        // echo json_encode($dataSet);
        if ($this->items_model->addGalleryTemp($dataSet)) {
            if ($this->items_model->delGallery($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
        exit;
    }
    public function get_subcaterys(){
        $cate_id = $this->input->post('cateID');
        $this->load->model('items/items_model');
        $data = $this->items_model->getSubcategorysByMID($cate_id);
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
        $this->load->model('items/items_model');
        $data = $this->items_model->getDistrictByAmphurID($id);
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
        
}
