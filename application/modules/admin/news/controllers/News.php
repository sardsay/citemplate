<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller {

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
        //exit;
        # set title and header
        $this->load->library('pagination');
        $this->load->model('news/news_model');
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการข่าว');
        $this->data->Header_title = 'จัดการข่าว';
        $this->data->title = 'รายการข่าวทั้งหมด';
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
        $base_url = base_url().'news?txtsearch='.$this->input->get('txtsearch').'&ddlang='.$this->input->get('ddlang');
        $uri_segment =3;
        $per_page = 20;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->news_model->getAllNews(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allNews = $this->news_model->getAllNews(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
//        
        // $this->data->allCategorys = $this->news_model->getAllCategorys();
        # set active menu
       $this->data->main_active = 'news';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','news/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการข่าว');
        $this->data->Header_title = 'จัดการข่าว';
        $this->data->title = 'รายการข่าวทั้งหมด';
        $this->load->model('news/news_model');
        $this->data->main_active = 'news';
        if ($this->input->post()) {
            $txttitle = $this->input->post('txttitle');
            $txtdatadate = $this->input->post('txtdatadate');
            $txtareadescription = $this->input->post('txtareadescription');
            $ddlang = $this->input->post('ddlang');
            $rdstatus = $this->input->post('rdstatus');
            $gallery = $_FILES['gallery'];
            
            $error = '';$error_val = '';
            
            if ($txttitle == '' || $txttitle ==null){
                $error['txttitle'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txttitle'] = $txttitle;
            }
            if ($txtdatadate == '' || $txtdatadate ==null){
                $error['txtdatadate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtdatadate'] = $txtdatadate;
            }
            if ($txtareadescription == '' || $txtareadescription ==null){
                $error['txtareadescription'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtareadescription'] = $txtareadescription;
            }
            
            if ($ddlang == '0'){
                $error['ddlang'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddlang'] = $ddlang;
            }
            for ($i=0; $i <count($gallery['name']) ; $i++) {
                if ($gallery['name'][$i] == '') {
                    $error['gallery'] = 'กรุณาใส่รูปอย่างน้อยหนึ่งรูป';
                }
            }
            
            if ($error == '') {
                $data_set = array('title'=>$txttitle,
                                'data_date'=>date('Y-m-d H:i:s',strtotime($txtdatadate)),
                                'description'=>$txtareadescription,
                                'lang'=>$ddlang,
                                'user_create' => $this->session->userdata('user_id'),
                                'create_date'=>date('Y-m-d H:i:s'),
                                'status'=>$rdstatus
                                );

                if ($id = $this->news_model->addNewsData($data_set)) {
                    if ($id != 0) {
                        
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'news_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->news_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มรูปได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('news/edit/'.$id,'refresh');
                                        exit;
                                    }else{
                                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('news','refresh');
                                        exit;    
                                    }
                                }else{
                                    
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มรูปได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('news/edit/'.$id,'refresh');
                                        exit;
                                    
                                }       
                            }
                        }
                      
                        
                            
                    }else{
                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('news/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('news/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('news/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','news/add_form',$this->data);
        $this->template->render(); 
    }
    public function edit($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการข่าว');
        $this->data->Header_title = 'จัดการข่าว';
        $this->data->title = 'รายการข่าวทั้งหมด';
        $this->load->model('news/news_model');
        $this->data->main_active = 'news';
        $this->data->newdata = $this->news_model->getNewsByID($id);
        $this->data->gallery1 = $this->news_model->getGalleryByID($id,0,5);
        // $this->data->gallery2 = $this->news_model->getGalleryByID($id,5,5);
        // $this->data->scheduleData = $this->news_model->getScheduleByID($id); 

        if ($this->input->post()) {
            $txttitle = $this->input->post('txttitle');
            $txtdatadate = $this->input->post('txtdatadate');
            $txtareadescription = $this->input->post('txtareadescription');
            $ddlang = $this->input->post('ddlang');
            $rdstatus = $this->input->post('rdstatus');
            $gallery = $_FILES['gallery'];

            $error = '';$error_val = '';
            
            if ($txttitle == '' || $txttitle ==null){
                $error['txttitle'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txttitle'] = $txttitle;
            }
            if ($txtdatadate == '' || $txtdatadate ==null){
                $error['txtdatadate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtdatadate'] = $txtdatadate;
            }
            if ($txtareadescription == '' || $txtareadescription ==null){
                $error['txtareadescription'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtareadescription'] = $txtareadescription;
            }
            
            if ($ddlang == '0'){
                $error['ddlang'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddlang'] = $ddlang;
            }
            for ($i=0; $i <count($gallery['name']) ; $i++) {
                if ($gallery['name'][$i] == '') {
                    $error['gallery'] = 'กรุณาใส่รูปอย่างน้อยหนึ่งรูป';
                }
            }
            if ($error == '') {
                $data_set = array('title'=>$txttitle,
                                'data_date'=>date('Y-m-d H:i:s',strtotime($txtdatadate)),
                                'description'=>$txtareadescription,
                                'lang'=>$ddlang,
                                'user_modify' => $this->session->userdata('user_id'),
                                'modify_date'=>date('Y-m-d H:i:s'),
                                'status'=>$rdstatus
                                ); 
                // echo '<pre>';
                // print_r($data_set);
                // echo '</pre>';
                // exit;
                if ($this->news_model->updateNewsData($data_set,$id)) {
                    if ($id != 0) {
                        
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'news_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->news_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ add gallery1");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('news/edit/'.$id,'refresh');
                                        exit;
                                    }else{
                                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('news','refresh');
                                        exit;
                                    }
                                }else{
                                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ update");
                                    # parse value msg to show error or succsess data for a while. 
                                    $this->session->set_flashdata('msg',$data);
                                    redirect('news/edit/'.$id,'refresh');
                                    exit;
                                }       
                            }
                        }
                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('news','refresh');
                        exit;
                         
                    }else{
                        $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('news/edit/'.$id,'refresh');
                        exit;
                    }

                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('news/edit/'.$id,'refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                redirect('news/edit/'.$id,'refresh');
                exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','news/edit_form',$this->data);
        $this->template->render(); 
    }
    private function upload_image($file,$type,$id,$width,$height){

            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('news/add','refresh');
                exit;
            }
            $file_path = URLPATH_UPLOAD_NEWSIMAGES.($id%10).'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir 1";
                    return false;
                }
                        
            }
            $file_path = URLPATH_UPLOAD_NEWSIMAGES.($id%10).'/'.$id.'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir 2";
                    return false;
                }
                        
            }
            if ($type == 'thumb') {
                $rawfilename = 'thumb_event'.$id;
            }else if ($type == 'gallery') {
                // $rawfilename = 'item_'.$id.'_'.$no;
            }
            /*if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
                        
            }*/
            if ($type== 'pincate') {
                $arr_typefiles = array('.png');
            }else{
                $arr_typefiles = array('.png','.jpg','.jpeg');    
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
            
            $file_path = URLPATH_UPLOAD_NEWSIMAGES.($id%10).'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir 3";
                    return false;
                }
            }
            $file_path = URLPATH_UPLOAD_NEWSIMAGES.($id%10).'/'.$id.'/';
            
            $rawfilename = 'news_'.$id.'_'.date('YmdHis').'_'.$no;
            
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir 4";
                    return false;
                }
            }
            $file_path = URLPATH_UPLOAD_NEWSIMAGES.($id%10).'/'.$id.'/gallerys/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir 5";
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
    public function delete(){
        $id = $this->input->post('event_id',TRUE);
        if ($id!='') {
            $this->load->model('news/news_model');
            if ($this->news_model->delete($id)) {
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
        $config['num_tag_open'] = $config['first_tag_open'] = $config['last_tag_open'] ='<li>';
        $config['num_tag_close'] = $config['first_tag_close'] = $config['last_tag_close'] ='</li>';
        // $config['attributes']['rel'] = FALSE;
        $this->pagination->initialize($config); 
        return $this->pagination->create_links();
    }
    public function get_Autocomplete(){
        $string = $this->input->get('keyword');
        $this->load->model('news/news_model');
        $rawdata = $this->news_model->getautocompleteNews($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->event_name);
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
        $this->load->model('news/news_model');
        $image_name = $this->news_model->getImageName($id);
        if(unlink($_SERVER['DOCUMENT_ROOT'].'/chaiyaphum/'.URLPATH_UPLOAD_NEWSIMAGES.($main_id%10).'/'.$main_id.'/gallerys/'.$image_name)){
            if ($this->news_model->delGallery($id)) {
                echo 1;
            }else{
                echo 0;
            }    
        }else{
            echo 0;
        }
        
        exit;
    }
    
        
}
