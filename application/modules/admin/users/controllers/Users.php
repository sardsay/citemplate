<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH."libraries/PasswordHash.php");
class Users extends MX_Controller {

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
        $this->load->model('users/users_model');
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการผู้ใช้งาน');
        $this->data->Header_title = 'จัดการผู้ใช้งาน';
        $this->data->title = 'รายการผู้ใช้งานทั้งหมด';
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
        $base_url = base_url().'users';
        $uri_segment =3;
        $per_page = 20;
        $start = (($per_page*$page)-$per_page);
        $total_rows = $this->users_model->getAllUsers(1);
        $this->data->total_rows = number_format($total_rows);
        $this->data->per_page = $per_page;
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        $this->data->allUsers = $this->users_model->getAllUsers(0,$start,$per_page);
        $this->data->pagination = $this->pagination_page($base_url,$uri_segment,$per_page,$total_rows);
        # set active menu
       // $this->data->main_active = 'system';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','users/page_main',$this->data);
        $this->template->render(); 
    }
    public function add(){
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการผู้ใช้งาน');
        $this->data->Header_title = 'จัดการเพิ่มผู้ใช้งาน';
        $this->data->title = 'รายการผู้ใช้งานทั้งหมด';
        $this->load->model('users/users_model');
        $this->data->ddgroups = $this->users_model->getGroupList();
        
        if ($this->input->post()) {
            
            $txtname = $this->input->post('txtname');
            $txtrealname = $this->input->post('txtrealname');
            $txtusername = $this->input->post('txtusername');
            $txtpassword = $this->input->post('txtpassword');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txtphone = $this->input->post('txtphone');
            $txtemail = $this->input->post('txtemail');
            $ddgroups = $this->input->post('ddgroups');
            $rdstatus = $this->input->post('rdstatus');

            $error = '';$error_val = '';
            if ($ddgroups == '0'){
                $error['ddgroups'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddgroups'] = $ddgroups;
            }
            if ($txtname == '' || $txtname ==null){
                $error['txtname'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtname'] = $txtname;
            }
            if ($txtrealname == '' || $txtrealname ==null){
                $error['txtrealname'] = 'กรุณากรอก ชื่อ นามสกุล'; 
            }else{
                  $error_val['val_txtrealname'] = $txtrealname;
            }
            if ($txtusername == '' || $txtusername ==null){
                $error['txtusername'] = 'กรุณากรอก username'; 
            }else{
                  $error_val['val_txtusername'] = $txtusername;
            }
            if ($txtpassword == '' || $txtpassword ==null){
                $error['txtpassword'] = 'กรุณากรอก password'; 
            }else{
                  $error_val['val_txtpassword'] = '';
            }
            
            
            if ($error == '') {
                $phpass = new PasswordHash(10, true);
                $password = $phpass->HashPassword($txtpassword);
                $data_set = array('shopname'=>$txtname,
                                    'realname'=>$txtrealname,
                                    'username'=>$txtusername,
                                    'password'=>$password,
                                    'address'=>$txtareaaddress,
                                    'phone'=>$txtphone,
                                    'email'=>$txtemail,
                                    'create_date'=>date('Y-m-d H:i:s'),
                                    'group_id'=>$ddgroups,
                                    'status'=>$rdstatus,
                                    );    

                if ($id = $this->users_model->addUserData($data_set)) {
                    if ($id != 0) {
                        $data = array('success_msg' => "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('users','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('users/add','refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('users/add','refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('users/add','refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','users/add_form',$this->data);
        $this->template->render(); 
    }
    public function edit($id=0){
        if ($id == 0) {
            show_error('The user does not have permissions.',403);
            exit;
        }
        $this->template->write('website_name', 'Amazing Chaiyaphum : จัดการผู้ใช้งาน');
        $this->data->Header_title = 'จัดการแก้ไขผู้ใช้งาน';
        $this->data->title = 'รายการผู้ใช้งานทั้งหมด';
        $this->load->model('users/users_model');
        $this->data->userdata = $this->users_model->getUserByID($id);
        $this->data->ddgroups = $this->users_model->getGroupList();

        if ($this->input->post()) {
            $txtname = $this->input->post('txtname');
            $txtrealname = $this->input->post('txtrealname');
            $txtusername = $this->input->post('txtusername');
            $txtpassword = $this->input->post('txtpassword');
            $txtareaaddress = $this->input->post('txtareaaddress');
            $txtphone = $this->input->post('txtphone');
            $txtemail = $this->input->post('txtemail');
            $ddgroups = $this->input->post('ddgroups');
            $rdstatus = $this->input->post('rdstatus');

            /*$thumb = $_FILES['thumb_image'];
            $pin_map = $_FILES['pin_map'];*/
            $error = '';$error_val = '';
            if ($ddgroups == '0'){
                $error['ddgroups'] = 'กรุณาเลือกหมวดหมู่'; 
            }else{
                $error_val['val_ddgroups'] = $ddgroups;
            }
            if ($txtname == '' || $txtname ==null){
                $error['txtname'] = 'กรุณากรอก ชื่อ'; 
            }else{
                  $error_val['val_txtname'] = $txtname;
            }
            if ($txtrealname == '' || $txtrealname ==null){
                $error['txtrealname'] = 'กรุณากรอก ชื่อ นามสกุล'; 
            }else{
                  $error_val['val_txtrealname'] = $txtrealname;
            }
            if ($txtusername == '' || $txtusername ==null){
                $error['txtusername'] = 'กรุณากรอก username'; 
            }else{
                  $error_val['val_txtusername'] = $txtusername;
            }
            if ($txtpassword == '' || $txtpassword ==null){
                $error['txtpassword'] = 'กรุณากรอก password'; 
            }else{
                  $error_val['val_txtpassword'] = '';
            }
            $error_val['val_rdstatus'] = $rdstatus;
            
            if ($error == '') {
                
                $phpass = new PasswordHash(10, true);
                        $password = $phpass->HashPassword($txtpassword);
                        $data_set = array('shopname'=>$txtname,
                                            'realname'=>$txtrealname,
                                            'username'=>$txtusername,
                                            'password'=>$password,
                                            'address'=>$txtareaaddress,
                                            'phone'=>$txtphone,
                                            'email'=>$txtemail,
                                            'modify_date'=>date('Y-m-d H:i:s'),
                                            'group_id'=>$ddgroups,
                                            'status'=>$rdstatus,
                                            );  
                if ($this->users_model->updateUserData($data_set,$id)) {
                    if ($id != 0) {
                        
                        $data = array('success_msg' => "แก้ไขข้อมูลเรียบร้อยแล้ว");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('users','refresh');
                        exit;    
                    }else{
                        $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                        # parse value msg to show error or succsess data for a while. 
                        $this->session->set_flashdata('msg',$data);
                        redirect('users/edit/'.$id,'refresh');
                        exit;
                    }
                    
                }else{
                    $data = array('error_msg' => "ไม่สามารถแก้ไขข้อมูลได้ กรุณาติดต่อ ผู้ดูแลระบบ");
                    # parse value msg to show error or succsess data for a while. 
                    $this->session->set_flashdata('msg',$data);
                    redirect('users/edit/'.$id,'refresh');
                    exit;
                }
            }else{
                
                $this->session->set_flashdata('error_form',$error);
                $this->session->set_flashdata('error_val',$error_val);
                  redirect('users/edit/'.$id,'refresh');
                  exit;
            }
        }
     
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','users/edit_form',$this->data);
        $this->template->render(); 
    }
    private function upload_image($file,$type,$id){

            
            if ($file['name'] =='') {
                $data = array('error_msg' => "กรุณาเลือกไฟล์เพื่อทำการอัพโหลด");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('users/add','refresh');
                exit;
            }
            if ($type=='cate' || $type == 'pincate') {
                $file_path = URLPATH_UPLOAD_CATEIMAGES.$id.'/';
                if ($type == 'cate') {
                    $rawfilename = 'thumb_cate'.$id;
                }else if ($type == 'pincate') {
                    $rawfilename = 'pin-cate'.$id;
                }
            }
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
                        return $rawfilename;
                    }else{
                        return $filename;    
                    }
                    
                }else{
                    return false;
                }

            }else{
                return false;
                $data = array('error_msg' => "กรุณาเลือกไฟล์นามสกุล png,jpg หรือ jpeg");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('users/add','refresh');
                exit;

            }
    }
    public function delete(){
        $id = $this->input->post('id',TRUE);
        if ($id!='') {
            $this->load->model('users/users_model');
            if ($this->users_model->delete($id)) {
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
    public function get_Autocomplete(){
        $string = $this->input->get('keyword');
        $this->load->model('users/users_model');
        $rawdata = $this->users_model->getautocompleteUser($string);
        $source = array();
        foreach ($rawdata as $data) {
            $source[] = trim($data->title);
        }
        echo  json_encode($source);
        unset($term,$data,$source,$datac);
    }
    
        
}
