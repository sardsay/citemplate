<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorys extends MX_Controller {

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
        $this->load->model('categorys/categorys_model');
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการหมวดหมู่');
        $this->data->Header_title = 'จัดการหมวดหมู่หลัก';
        $this->data->title = 'รายการหมวดหมู่ทั้งหมด';
        # start add js for this page
        // $this->template->add_chart_js(URLPATH_JS.'morris/chart-data-morris.js');
       // $this->template->add_css(URLPATH_CSS.'plugins/dataTables/dataTables.bootstrap.css');
       // $this->template->add_js(URLPATH_JS.'plugins/dataTables/jquery.dataTables.js');
//        $this->template->add_js(URLPATH_JS.'plugins/dataTables/dataTables.bootstrap.js');
        # end add js for this page
        # query data 
        //load model (folder/model)
        // $total_rows = $this->categorys_model->getAllCategorys
        $page = $this->input->get('page');
        if($page==0)
        {
          $page=1;
        }
        // set pagination config
        $base_url = base_url().'categorys';
        $uri_segment =3;
        $per_page = 20;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->categorys_model->getAllCategorys(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allCategorys = $this->categorys_model->getAllCategorys(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        
//        
        // $this->data->allCategorys = $this->categorys_model->getAllCategorys();
        # set active menu
       $this->data->main_active = 'categorys';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','categorys/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการหมวดหมู่');
        $this->data->Header_title = 'เพิ่มหมวดหมู่หลัก';
        $this->data->title = 'รายการการหมวดหมู่ทั้งหมด';
        $this->data->main_active = 'categorys';
       /*$this->template->add_js(URLPATH_ADMIN_JS.'cropper.min.js');
       $this->template->add_css(URLPATH_ADMIN_CSS.'cropper.min.css');
       $this->template->add_css(URLPATH_ADMIN_CSS.'cropper.css');*/
        if ($this->input->post()) {
            $txtname = $this->input->post('txtname');
            $txtname_en = $this->input->post('txtname_en');
            $txtname_cn = $this->input->post('txtname_cn');
            $rdStatus = $this->input->post('rdStatus');
            $thumb = $_FILES['thumb_image'];
            // $pin_map = $_FILES['pin_map'];
            $error = '';$error_val = '';
            if ($txtname == '' || $txtname ==null){
                $error['txtname'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtname'] = $txtname;
            }
            // echo $txtname;exit;
            // print_r($error);exit;
            if ($txtname_en == '' || $txtname_en ==null){
                $error['txtname_en'] = 'กรุณากรอก ชื่อภาษาอังกฤษ'; 
            }else{
                  $error_val['val_txtname_en'] = $txtname_en;
            }
            if ($txtname_cn == '' || $txtname_cn ==null){
                $error['txtname_cn'] = 'กรุณากรอก ชื่อภาษาอังกฤษ'; 
            }else{
                  $error_val['val_txtname_cn'] = $txtname_cn;
            }

            if ($thumb['name'] == '') {
                $error['image_thumb'] = 'กรุณาเลือกไฟล์เพื่อทำการอัพโหลด'; 
            }
            // if ($pin_map['name'] == '') {
            //     $error['image_pin'] = 'กรุณาเลือกไฟล์เพื่อทำการอัพโหลด'; 
            // }
            // $error_val['val_rdshowmain'] = $rdshowmain;
            $error_val['val_rdstatus'] = $rdStatus;
            if ($error == '') {
                $data_set = array('name'=>$txtname,
                                'name_en'=>$txtname_en,
                                'name_cn'=>$txtname_cn,
                                // 'show_main'=>$rdshowmain,
                                'status'=>$rdStatus
                                );
                $this->load->model('categorys/categorys_model');

                if ($id = $this->categorys_model->addCateData($data_set)) {
                    if ($id != 0) {
                        if ($thumb_name = $this->upload_image($thumb,'cate',$id)) {
                            $thumb_data = array('image_thumb_vertical'=>$thumb_name);
                            $this->categorys_model->updateImageThumbName($thumb_data,$id);
                        }
                        // if ($pin_name = $this->upload_image($pin_map,'pincate',$id)) {
                        //     $thumb_data = array('pin_map'=>$pin_name);
                        //     $this->categorys_model->updateImageThumbName($thumb_data,$id);   
                        // }
                        
                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('categorys','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('categorys/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('categorys/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('categorys/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','categorys/add_form',$this->data);
        $this->template->render(); 
    }
    public function edit($cate_id=0){
        if ($cate_id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการหมวดหมู่');
        $this->data->Header_title = 'แก้ไขหมวดหมู่หลัก';
        $this->data->title = 'รายการหมวดหมู่ทั้งหมด';
        $this->load->model('categorys/categorys_model');
        $this->data->main_active = 'categorys';
        $this->data->catedata = $this->categorys_model->getCategoryByID($cate_id);
        if ($this->input->post()) {
            $txtname = $this->input->post('txtname');
            $txtname_en = $this->input->post('txtname_en');
            $txtname_cn = $this->input->post('txtname_cn');
            // $rdshowmain = $this->input->post('rdshowmain');
            $rdStatus = $this->input->post('rdStatus');
            $thumb = $_FILES['thumb_image'];
            // $pin_map = $_FILES['pin_map'];
            $error = '';$error_val = '';
            
            if ($txtname == '' || $txtname ==null){
                $error['txtname'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtname'] = $txtname;
            }
            
            if ($txtname_en == '' || $txtname_en ==null){
                $error['txtname_en'] = 'กรุณากรอก ชื่อภาษาอังกฤษ'; 
            }else{
                  $error_val['val_txtname_en'] = $txtname_en;
            }

            $error_val['val_rdshowmain'] = $rdshowmain;
            $error_val['val_rdstatus'] = $rdStatus;
            
            
            if ($error == '') {
                $data_set = array('name'=>$txtname,
                                'name_en'=>$txtname_en,
                                'name_cn'=>$txtname_cn,
                                // 'show_main'=>$rdshowmain,
                                'status'=>$rdStatus
                                );    

                if ($this->categorys_model->updateCateData($data_set,$cate_id)) {
                    if ($cate_id != 0) {
                        if ($thumb['name'] !='' && $thumb['name']!=null) {
                            if ($thumb_name = $this->upload_image($thumb,'cate',$cate_id)) {
                                $thumb_data = array('image_thumb_vertical'=>$thumb_name);
                                $this->categorys_model->updateImageThumbName($thumb_data,$cate_id);
                            }    
                        }
                        // if ($pin_map['name'] != '' && $pin_map['name'] != null) {
                        //     if ($pin_name = $this->upload_image($pin_map,'pincate',$cate_id)) {
                        //         $thumb_data = array('pin_map'=>$pin_name);
                        //         $this->categorys_model->updateImageThumbName($thumb_data,$cate_id);   
                        //     }    
                        // }
                        
                        
                        $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('categorys','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('categorys/edit/'.$cate_id,'refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('categorys/edit/'.$cate_id,'refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('categorys/edit/'.$cate_id,'refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','categorys/edit_form',$this->data);
        $this->template->render(); 
    }
    private function upload_image($file,$type,$id){

            
            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('categorys/add','refresh');
                exit;
            }
            
                
                if ($type == 'cate') {
                    $rawfilename = 'thumb_cate'.$id;
                }else if ($type == 'pincate') {
                    $rawfilename = 'pin-cate'.$id;
                }
            
            $file_path = URLPATH_UPLOAD_CATEIMAGES.$id.'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
                        
            }

            $arr_typefiles = array('.png','.jpg','.jpeg');
            $fileicon = $file['name'];
            $ext = strrchr($fileicon, '.');
            $filename = $rawfilename.$ext;
            if (in_array($ext, $arr_typefiles)) {

               if (move_uploaded_file($file['tmp_name'], $file_path . $filename)) {
                    if ($type=='pincate') {
                        $this->resizeImagePin($file_path . $filename,150,220,'xxhdpi');
                        $this->resizeImagePin($file_path . $filename,75,110,'xhdpi');
                        $this->resizeImagePin($file_path . $filename,50,73,'hdpi');
                        return $rawfilename;    
                    }else{
                        if($this->resizeImage($file_path . $filename,400,500)){
                            return $filename;
                        }else{
                            return false;
                        }
                            
                    }
                    
                }else{
                    return false;
                }

            }else{
                return false;
                $data = array('error_msg' => "กรุณาเลือกไฟล์นามสกุล png,jpg หรือ jpeg");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('categorys/add','refresh');
                exit;

            }
    }
    public function delete(){
        $id = $this->input->post('cate_id',TRUE);
        if ($id!='') {
            $this->load->model('categorys/categorys_model');
            if ($this->categorys_model->delete($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    public function pagination_page($base_usl,$uri_segment,$per_page,$total_rows)
    {
        
        $config['base_url'] = $base_usl;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page; 
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbers']  = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['prev_tag_open'] = $config['next_tag_open'] = '<li>';
        $config['prev_tag_close'] = $config['next_tag_close'] = '</li>'; 
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // $config['attributes']['rel'] = FALSE;
        $this->pagination->initialize($config); 
        return $this->pagination->create_links();
    }
    public function get_AutocompleteCate(){
        $string = $this->input->get('keyword');
        $this->load->model('categorys/categorys_model');
        $rawdata = $this->categorys_model->getautocompleteCate($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->name);
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
    public function resizeImagePin($urlpath,$width,$height,$size){
        $this->load->library('image_lib');
        $configpin['image_library'] = 'gd2';
        $configpin['source_image'] = $urlpath;
        $configpin['create_thumb'] = TRUE;
        $configpin['maintain_ratio'] = FALSE;
        $configpin['width']         = $width;
        $configpin['height']       = $height;
        $configpin['thumb_marker'] = '_'.$size;
        $configpin['overwrite'] = TRUE;
        $this->image_lib->clear();
        $this->image_lib->initialize($configpin);

        if (!$this->image_lib->resize()){
            echo  $this->image_lib->display_errors();exit;
        }else{
            return true;
        }
    }
    /*public function testIDN(){
        echo phpinfo();
        // echo "test";exit;
        echo idn_to_ascii("โพลาร์.com");exit;
        echo "<br>";
        echo idn_to_unicode("xn--v3ckf6c3d0c.com");
    }*/
    
        
}
