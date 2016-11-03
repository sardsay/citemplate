<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MX_Controller {

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
        $this->load->model('events/events_model');
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการกิจกรรม');
        $this->data->Header_title = 'จัดการกิจกรรม';
        $this->data->title = 'รายการกิจกรรมทั้งหมด';
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
        $base_url = base_url().'events?txtsearch='.$this->input->get('txtsearch').'&ddlang='.$this->input->get('ddlang');
        $uri_segment =3;
        $per_page = 20;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->events_model->getAllEvents(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allEvents = $this->events_model->getAllEvents(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
//        
        // $this->data->allCategorys = $this->events_model->getAllCategorys();
        # set active menu
       $this->data->main_active = 'events';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','events/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการกิจกรรม');
        $this->data->Header_title = 'จัดการกิจกรรม';
        $this->data->title = 'รายการกิจกรรมทั้งหมด';
        $this->load->model('events/events_model');
        $this->data->main_active = 'events';
        if ($this->input->post()) {
            $txtevent_name = $this->input->post('txtevent_name');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txttelephone = $this->input->post('txttelephone');
            $txtstartdate = $this->input->post('txtstartdate');
            $txtenddate = $this->input->post('txtenddate');
            $txtareadescription = $this->input->post('txtareadescription');
            $txtlatitude = $this->input->post('txtlatitude');
            $txtlongitude = $this->input->post('txtlongitude');
            $ddlang = $this->input->post('ddlang');
            $rdstatus = $this->input->post('rdstatus');
            $thumb = $_FILES['thumb_image'];
            $gallery = $_FILES['gallery'];

            $arr_startdate = $this->input->post('txtschedule_startdate');
            $arr_enddate = $this->input->post('txtschedule_enddate');
            $arr_starttime = $this->input->post('txtschedule_starttime');
            $arr_endtime = $this->input->post('txtschedule_endtime');
            $arr_detail = $this->input->post('areaschedule');
            
            $error = '';$error_val = '';
            
            if ($txtevent_name == '' || $txtevent_name ==null){
                $error['txtevent_name'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtevent_name'] = $txtevent_name;
            }
            if ($txtstartdate == '' || $txtstartdate ==null){
                $error['txtstartdate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtstartdate'] = $txtstartdate;
            }
            if ($txtenddate == '' || $txtenddate ==null){
                $error['txtenddate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtenddate'] = $txtenddate;
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
            $error_val['val_txtareaaddress'] = $txtareaaddress;
            $error_val['val_txtareadescription'] = $txtareadescription;
            // echo '<pre>';
            // print_r($error);
            // echo '</pre>';
            // exit;
            if ($error == '') {
                $data_set = array('event_name'=>$txtevent_name,
                                'event_detail'=>$txtareadescription,
                                'starttime'=>date('Y-m-d',strtotime($txtstartdate)),
                                'endtime'=>date('Y-m-d',strtotime($txtenddate)),
                                'address'=>$txtareaaddress,
                                'telephone'=>$txttelephone,
                                'lang'=>$ddlang,
                                'latitude'=>$txtlatitude,
                                'longitude'=>$txtlongitude,
                                'create_date'=>date('Y-m-d H:i:s'),
                                'status'=>$rdstatus
                                );

                if ($id = $this->events_model->addEventData($data_set)) {
                    if ($id != 0) {
                        if ($thumb_name = $this->upload_image($thumb,'thumb',$id,600,400)) {
                            $thumb_data = array('image_thumb'=>$thumb_name);
                            $this->events_model->updateImageThumbName($thumb_data,$id);
                        }
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'event_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->events_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('events/add','refresh');
                                        exit;
                                    }
                                }       
                            }
                        }
                        for ($j=0; $j < count($arr_startdate); $j++) { 
                            if ($arr_startdate[$j] != '' && $arr_enddate[$j] !='') {
                                $schedule_data[$j]['start_date']= date('Y-m-d',strtotime($arr_startdate[$j]));
                                $schedule_data[$j]['end_date']= date('Y-m-d',strtotime($arr_enddate[$j]));
                                $schedule_data[$j]['event_id']= $id;
                                $schedule_data[$j]['start_time']= $arr_starttime[$j];
                                $schedule_data[$j]['end_time']= $arr_endtime[$j];
                                $schedule_data[$j]['schedule_detail']= $arr_detail[$j];
                            }
                        }
                        // echo '<pre>';
                        // print_r($schedule_data);
                        // echo '</pre>';
                        // exit;
                        if ($this->events_model->addSchedule($schedule_data)) {
                            $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                            # parse value msg to show error or succsess data for a while. 
                            $this->session->set_flashdata('msg',$data);
                            redirect('events','refresh');
                            exit;    
                        }else{
                            $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                            # parse value msg to show error or succsess data for a while. 
                            $this->session->set_flashdata('msg',$data);
                            redirect('events/add','refresh');
                            exit;    
                        }
                        
                            
                    }else{
                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('events/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('events/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('events/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','events/add_form',$this->data);
        $this->template->render(); 
    }
    public function edit($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการกิจกรรม');
        $this->data->Header_title = 'จัดการกิจกรรม';
        $this->data->title = 'รายการกิจกรรมทั้งหมด';
        $this->load->model('events/events_model');
        $this->data->main_active = 'events';
        $this->data->eventdata = $this->events_model->getEventByID($id);
        $this->data->gallery1 = $this->events_model->getGalleryByID($id,0,5);
        $this->data->gallery2 = $this->events_model->getGalleryByID($id,5,5);
        $this->data->scheduleData = $this->events_model->getScheduleByID($id); 

        if ($this->input->post()) {
            $txtevent_name = $this->input->post('txtevent_name');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txttelephone = $this->input->post('txttelephone');
            $txtstartdate = $this->input->post('txtstartdate');
            $txtenddate = $this->input->post('txtenddate');
            $txtareadescription = $this->input->post('txtareadescription');
            $txtlatitude = $this->input->post('txtlatitude');
            $txtlongitude = $this->input->post('txtlongitude');
            $ddlang = $this->input->post('ddlang');
            $rdstatus = $this->input->post('rdstatus');
            $thumb = $_FILES['thumb_image'];
            $gallery = $_FILES['gallery'];

            $arr_startdate = $this->input->post('txtschedule_startdate');
            $arr_enddate = $this->input->post('txtschedule_enddate');
            $arr_starttime = $this->input->post('txtschedule_starttime');
            $arr_endtime = $this->input->post('txtschedule_endtime');
            $arr_detail = $this->input->post('areaschedule');

            /*$thumb = $_FILES['thumb_image'];
            $pin_map = $_FILES['pin_map'];*/
            $error = '';$error_val = '';
            
            if ($txtevent_name == '' || $txtevent_name ==null){
                $error['txtevent_name'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtevent_name'] = $txtevent_name;
            }
            if ($txtstartdate == '' || $txtstartdate ==null){
                $error['txtstartdate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtstartdate'] = $txtstartdate;
            }
            if ($txtenddate == '' || $txtenddate ==null){
                $error['txtenddate'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtenddate'] = $txtenddate;
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
            $error_val['val_txtareaaddress'] = $txtareaaddress;
            $error_val['val_txtareadescription'] = $txtareadescription;
            /*if ($thumb['name'] == '' || $pin_map['name']=='') {
                $error['image_thumb'] = 'กรุณาเลือกไฟล์เพื่อทำการอัพโหลด'; 
                
            }
            */
            
            
            if ($error == '') {
                $data_set = array('event_name'=>$txtevent_name,
                                'event_detail'=>$txtareadescription,
                                'starttime'=>date('Y-m-d',strtotime($txtstartdate)),
                                'endtime'=>date('Y-m-d',strtotime($txtenddate)),
                                'address'=>$txtareaaddress,
                                'telephone'=>$txttelephone,
                                'lang'=>$ddlang,
                                'latitude'=>$txtlatitude,
                                'longitude'=>$txtlongitude,
                                'modify_date'=>date('Y-m-d H:i:s'),
                                'status'=>$rdstatus
                                );    

                if ($this->events_model->updateEventData($data_set,$id)) {
                    if ($id != 0) {
                        if ($thumb['name'] !='' && $thumb['name']!=null) {
                            if ($thumb_name = $this->upload_image($thumb,'thumb',$id,600,400)) {
                                $thumb_data = array('image_thumb'=>$thumb_name);
                                $this->events_model->updateImageThumbName($thumb_data,$id);
                            }
                            // if ($thumb_name = $this->upload_image($thumb,'cate',$id)) {
                            //     $thumb_data = array('image_thumb_vertical'=>$thumb_name);
                            //     $this->events_model->updateImageThumbName($thumb_data,$id);
                            // }    
                        }
                        for ($i=0; $i <count($gallery['name']) ; $i++) { 
                            if ($gallery['name'][$i] != '') {
                                if ($gname = $this->upload_Gallery($gallery['name'][$i],$gallery['tmp_name'][$i],$id,600,400,$i)) {
                                    $thumb_data = array(
                                        'image_name'=>$gname,
                                        'event_id'=>$id,
                                        'status'=>'1'
                                        );
                                    if (!$this->events_model->addGallery($thumb_data)) {
                                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                        # parse value msg to show error or succsess data for a while. 
                                        $this->session->set_flashdata('msg',$data);
                                        redirect('events/add','refresh');
                                        exit;
                                    }
                                }       
                            }
                        }
                        $schedule_data = '';
                        for ($j=0; $j < count($arr_startdate); $j++) { 
                            if ($arr_startdate[$j] != '' && $arr_enddate[$j] !='') {
                                $schedule_data[$j]['start_date']= date('Y-m-d',strtotime($arr_startdate[$j]));
                                $schedule_data[$j]['end_date']= date('Y-m-d',strtotime($arr_enddate[$j]));
                                $schedule_data[$j]['event_id']= $id;
                                $schedule_data[$j]['start_time']= $arr_starttime[$j];
                                $schedule_data[$j]['end_time']= $arr_endtime[$j];
                                $schedule_data[$j]['schedule_detail']= $arr_detail[$j];
                            }
                        }
                        if ($schedule_data!='') {
                            if ($this->events_model->deleteScheduleByID($id)) {

                                if ($this->events_model->addSchedule($schedule_data)) {
                                    $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                                    # parse value msg to show error or succsess data for a while. 
                                    $this->session->set_flashdata('msg',$data);
                                    redirect('events','refresh');
                                    exit;    
                                }else{
                                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                    # parse value msg to show error or succsess data for a while. 
                                    $this->session->set_flashdata('msg',$data);
                                    redirect('events/add','refresh');
                                    exit;    
                                }
                            }else{
                                $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                                    # parse value msg to show error or succsess data for a while. 
                                    $this->session->set_flashdata('msg',$data);
                                    redirect('events/add','refresh');
                                    exit;
                            }
                        }
                        
                        $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('events','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('events/edit/'.$id,'refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('events/edit/'.$id,'refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('events/edit/'.$id,'refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','events/edit_form',$this->data);
        $this->template->render(); 
    }
    private function upload_image($file,$type,$id,$width,$height){

            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('events/add','refresh');
                exit;
            }
            $file_path = URLPATH_UPLOAD_EVENTIMAGES.($id%10).'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
                        
            }
            $file_path = URLPATH_UPLOAD_EVENTIMAGES.($id%10).'/'.$id.'/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
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
            
            $file_path = URLPATH_UPLOAD_EVENTIMAGES.($id%10).'/'.$id.'/';
            
            $rawfilename = 'event_'.$id.'_'.date('YmdHis').'_'.$no;
            
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
            }
            $file_path = URLPATH_UPLOAD_EVENTIMAGES.($id%10).'/'.$id.'/gallerys/';
            if (!is_dir($file_path)) {
                if (!mkdir($file_path, 0777)) {
                    echo "Error : mkdir ";
                    return false;
                }
            }
            
            $arr_typefiles = array('.png','.jpg','.jpeg');    
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
            $this->load->model('events/events_model');
            if ($this->events_model->delete($id)) {
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
        $this->load->model('events/events_model');
        $rawdata = $this->events_model->getautocompleteEvent($string);
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
        $this->load->model('events/events_model');
        $image_name = $this->events_model->getImageName($id);
        if(unlink($_SERVER['DOCUMENT_ROOT'].'/chaiyaphum/'.URLPATH_UPLOAD_EVENTIMAGES.($main_id%10).'/'.$main_id.'/gallerys/'.$image_name)){
            if ($this->events_model->delGallery($id)) {
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
