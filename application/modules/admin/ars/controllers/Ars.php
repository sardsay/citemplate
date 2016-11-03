<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ars extends MX_Controller {

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
    
    public function video(){
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','ars/view_video',$this->data);
        $this->template->render(); 
        echo 'video';
    }
    
    public function imageLeft(){
        echo 'imageLeft';
    }
    
    public function imageRight(){
        echo 'imageRight';
    }
    
    public function imageCenter(){
        echo 'imageCenter';
    }
    

    public function index(){
        //echo 1;exit;
        # set title and header
        $this->load->library('pagination');
        $this->load->model('ars/ars_model');
        $this->template->write('website_name', 'Amazing Chaiyaphum : AR Code');
        $this->data->Header_title = 'AR';
        $this->data->title = 'รายการเออาร์ทั้งหมด';

        $page = $this->input->get('page');
        if($page==0)
        {
          $page=1;
        }
        // set pagination config
        $base_url = base_url().'ars?txtsearch='.$this->input->get('txtsearch');
        $uri_segment =3;
        $per_page = 20;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->ars_model->getAllArs(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);//echo 1;exit;
        $this->data->allArs = $this->ars_model->getAllArs(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
//        
        // $this->data->allCategorys = $this->events_model->getAllCategorys();
        # set active menu
       $this->data->main_active = 'Ars';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','ars/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการเออาร์');
        $this->data->Header_title = 'จัดการเออาร์';
        $this->data->title = 'รายการเออาร์ทั้งหมด';
        $this->load->model('ars/ars_model');
        $this->data->main_active = 'ars';
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการเออาร์');
        $this->data->Header_title = 'จัดการเออาร์';
        $this->data->title = 'รายการเออาร์ทั้งหมด';
        $this->load->model('ars/ars_model');

        if ($this->input->post()) {
            
            $title = $this->input->post('txtar_name');
            $youtube = $this->input->post('txtyoutube');
            $status = $this->input->post('rdstatus');

            /*$thumb = $_FILES['thumb_image'];
            $pin_map = $_FILES['pin_map'];*/
            $error = '';$error_val = '';
            
            if ($title == '' || $title ==null){
                $error['txtar_name'] = 'กรุณากรอก ชื่อเออาร์'; 
            }else{
                  $error_val['val_txtar_name'] = $title;
            }
            if ($youtube == '' || $youtube ==null){
                $error['txtyoutube'] = 'กรุณาลิ้ง youtube'; 
            }else{
                  $error_val['val_txtyoutube'] = $youtube;
            }
            if ($status == '' || $status ==null){
                $error['rdstatus'] = 'กรุณาเลือก status'; 
            }else{
                  $error_val['val_rdstatus'] = $status;
            }
            
            
            if ($error == '') {
                $datenow = date("Y-m-d H:i:s");
                $data_set = array('title'=>$title,
                                'link'=>$youtube,
                                'create_date'=>$datenow,
                                'modify_date'=>$datenow,
                                'status'=>$status
                                );    
               
                if ($this->ars_model->addArData($data_set)) {
                        
                    $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('ars','refresh');
                    exit;    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('ars/add/','refresh');
                    exit;
                }
                    

            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                redirect('ars/add/','refresh');
                exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','ars/add_form',$this->data);
        $this->template->render(); 
    }
    
    public function edit($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการเออาร์');
        $this->data->Header_title = 'จัดการเออาร์';
        $this->data->title = 'รายการเออาร์ทั้งหมด';
        $this->load->model('ars/ars_model');
        $this->data->main_active = 'ars';
        
        $this->data->ardata = $this->ars_model->getArByID($id);

        if ($this->input->post()) {
            $title = $this->input->post('txtar_name');
            $youtube = $this->input->post('txtyoutube');
            $status = $this->input->post('rdstatus');

            /*$thumb = $_FILES['thumb_image'];
            $pin_map = $_FILES['pin_map'];*/
            $error = '';$error_val = '';
            
            if ($title == '' || $title ==null){
                $error['txtar_name'] = 'กรุณากรอก ชื่อเออาร์'; 
            }else{
                  $error_val['val_txtar_name'] = $title;
            }
            if ($youtube == '' || $youtube ==null){
                $error['txtyoutube'] = 'กรุณาลิ้ง youtube'; 
            }else{
                  $error_val['val_txtyoutube'] = $youtube;
            }
            if ($status == '' || $status ==null){
                $error['rdstatus'] = 'กรุณาเลือก status'; 
            }else{
                  $error_val['val_rdstatus'] = $status;
            }
            
            
            if ($error == '') {
                $datenow = date("Y-m-d H:i:s");
                $data_set = array('title'=>$title,
                                'link'=>$youtube,
                                //'create_date'=>$datenow,
                                'modify_date'=>$datenow,
                                'status'=>$status
                                );    

                if ($this->ars_model->updateArData($data_set,$id)) {
                        
                    $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('ars','refresh');
                    exit;    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('ars/edit/'.$id,'refresh');
                    exit;
                }
                    

            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('ars/edit/'.$id,'refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','ars/edit_form',$this->data);
        $this->template->render(); 
    }
    
    
    public function delete(){
        $id = $this->input->post('ar_id',TRUE);
        if ($id!='') {
            $this->load->model('ars/ars_model');
            if ($this->ars_model->delete($id)) {
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
        $this->load->model('ars/ars_model');
        $rawdata = $this->ars_model->getautocompleteAr($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->title);
        }
        echo  json_encode($source);
        unset($term,$data,$source,$datac);
    }
    
    
        
}
