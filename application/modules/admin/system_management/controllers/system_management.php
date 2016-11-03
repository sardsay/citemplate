<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH."libraries/PasswordHash.php");
class System_Management extends MX_Controller {

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
	function __construct()
    {
            parent::__construct();
            $this->data  = (object)array(); 
            
    }
    public function index(){
        # set title and header
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลผู้ใช้งาน';
        # start add js for this page
        // $this->template->add_chart_js(URLPATH_JS.'morris/chart-data-morris.js');
        $this->template->add_css(URLPATH_CSS.'plugins/dataTables/dataTables.bootstrap.css');
        $this->template->add_js(URLPATH_JS.'plugins/dataTables/jquery.dataTables.js');
        $this->template->add_js(URLPATH_JS.'plugins/dataTables/dataTables.bootstrap.js');
        # end add js for this page
        # query data 
        //load model (folder/model)
        
        $this->load->model('system_management/system_management_model');
        
        $this->data->allusers = $this->system_management_model->getUserAll();
        
        # set active menu
        $this->data->main_active = 'system';
        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/page_main',$this->data);
        $this->template->render(); 
    }
    public function groups(){
        # set title and header
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลกลุ่ม';
        # start add js for this page
        // $this->template->add_chart_js(URLPATH_JS.'morris/chart-data-morris.js');
        $this->template->add_css(URLPATH_CSS.'plugins/dataTables/dataTables.bootstrap.css');
        $this->template->add_js(URLPATH_JS.'plugins/dataTables/jquery.dataTables.js');
        $this->template->add_js(URLPATH_JS.'plugins/dataTables/dataTables.bootstrap.js');
        # end add js for this page
        # query data 
        //load model (folder/model)
        
        $this->load->model('system_management/system_management_model');
        
        $this->data->allgroups = $this->system_management_model->getGroupNames();
        
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'groups';
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/groups',$this->data);
        $this->template->render(); 
    }
    /*************************************
    * Ajax delete data  
    * Create/Update::29-Jul-2014 By 2fellows
    *************************************/
    public function del(){
        $id = $this->input->post('did',TRUE);
        if ($id!='') {
            $this->load->model('system_management/system_management_model');
            if ($this->system_management_model->del($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    /*************************************
    * Ajax delete data  
    * Create/Update::29-Jul-2014 By 2fellows
    *************************************/
    public function delGroup(){
        $id = $this->input->post('did',TRUE);
        if ($id!='') {
            $this->load->model('system_management/system_management_model');
            if ($this->system_management_model->delGroup($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    /*************************************
    * Ajax delete data  
    * Create/Update::29-Jul-2014 By 2fellows
    *************************************/
    public function delUser(){
        $id = $this->input->post('did',TRUE);
        if ($id!='') {
            $this->load->model('system_management/system_management_model');
            if ($this->system_management_model->delUser($id)) {
                echo 1;
            }else{
                echo 0;
            }
        }
        exit;
    }
    public function addgroup_form()
    {
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลกลุ่ม';
        $this->data->title = 'เพิ่มกลุ่ม';
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'groups';
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/addgroup_form',$this->data);
        $this->template->render(); 
    }
    public function add_form()
    {
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'สถานะการประชุม';
        $this->data->title = 'เพิ่มข้อมูลสถานะการประชุม';
        # set active menu
        $this->data->main_active = 'system';
        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/add_form',$this->data);
        $this->template->render(); 
    }
    public function adduser_form()
    {
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลผู้ใช้งาน';
        $this->data->title = 'เพิ่มข้อมูลผู้ใช้งาน';
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'users';
        $this->load->model('system_management/system_management_model');
        $this->data->groupdatas = $this->system_management_model->getGroupnames();
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/adduser_form',$this->data);
        $this->template->render(); 
    }
    public function edituser_form()
    {
        $id = $this->uri->segment(3);
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลผู้ใช้งาน';
        $this->data->title = 'ข้อมูลผู้ใช้งาน';
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'users';
        $this->load->model('system_management/system_management_model');
        $this->data->user_data = $this->system_management_model->getUserDataByID($id);
        $this->data->groupdatas = $this->system_management_model->getGroupnames();
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/edituser_form',$this->data);
        $this->template->render(); 
    }
    public function editgroup_form()
    {
        $id = $this->uri->segment(3);
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลกลุ่ม';
        $this->data->title = 'แก้ไขข้อมูลกลุ่ม';
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'groups';
        $this->load->model('system_management/system_management_model');
        $this->data->group_data = $this->system_management_model->getGroupDataBuID($id);
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/editgroup_form',$this->data);
        $this->template->render(); 
    }
    public function edit_form()
    {
        $id = $this->uri->segment(3);
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'ข้อมูลผู้ใช้งาน';
        $this->data->title = 'ข้อมูลผู้ใช้งาน';
        # set active menu
        $this->data->main_active = 'system';
        $this->data->menu_active = 'system_management';
        $this->load->model('system_management/system_management_model');
        $this->data->recall_data = $this->system_management_model->getDataByID($id);
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/edit_form',$this->data);
        $this->template->render(); 
    }
    public function adduser(){
        // load model
        $this->load->model('system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
        $txtlastname = $this->input->post('txtlastname',TRUE);
        
        $txtposition = $this->input->post('txtposition',TRUE);
        $txtsubdistrict = $this->input->post('txtsubdistrict',TRUE);
        $txtdistrict = $this->input->post('txtdistrict',TRUE);
        $txtprovince = $this->input->post('txtprovince',TRUE);
        $txtpostcode = $this->input->post('txtpostcode',TRUE);
        $txttelephone = $this->input->post('txttelephone',TRUE);
        $txtfax = $this->input->post('txtfax',TRUE);
        $txtemail = $this->input->post('txtemail',TRUE);
        $txtusername = $this->input->post('txtusername',TRUE);
        $txtpassword = $this->input->post('txtpassword',TRUE);
        $ddgroup = $this->input->post('ddgroup',TRUE);
        $ddstatus = $this->input->post('ddstatus',TRUE);
 
        $error = '';$error_val = '';
        if ($txtusername == '' || $txtusername ==null){
            $error['txtusername'] = 'กรุณากรอกชื่อผู้เข้าใช !!'; 
        }else{
            $error_val['val_txtusername'] = $txtusername;
        }
        if ($txtpassword == '' || $txtpassword ==null){
            $error['txtpassword'] = 'กรุณากรอกรหัสผ่าน!!'; 
        }else{
            $error_val['val_txtpassword'] = $txtpassword;
        }
        if ($ddgroup == '' || $ddgroup ==null){
            $error['ddgroup'] = 'กรุณากลุ่ม !!'; 
        }else{
            $error_val['val_ddgroup'] = $ddgroup;
        }

        
        if ($error == '') {
            $phpass = new PasswordHash(10, true);
            $password = $phpass->HashPassword($txtpassword);

                $data_user = array(
                            'username' => $txtusername, 
                            'password' => $password,
                            'name'     => $txtname,
                            'lastname' => $txtlastname,
                            'group_id' => $ddgroup,
                            'position' => $txtposition,
                            'province' => $txtprovince,
                            'district' => $txtdistrict,
                            'subdistrict' => $txtsubdistrict,
                            'postcode' => $txtpostcode,
                            'email' => $txtemail,
                            'fax' => $txtfax,
                            'telephone' => $txttelephone,
                            'status' => $ddstatus
                );
                
            if($this->system_management_model->add($data_user,'users')):
                $data = array('success_msg' => "Add data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management','refresh');
                exit;
                
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/adduser_form','refresh');
                exit;
            endif;
        }else{
            
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/adduser_form','refresh');
            exit;
        }
        
    }
    public function addgroup(){
        // load model
        $this->load->model('system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
 
        $error = '';$error_val = '';
        if ($txtname == '' || $txtname ==null){
            $error['txtname'] = 'กรุณากรอกชื่อประเภทปัญหาหลัก !!'; 
        }else{
            $error_val['val_txtname'] = $txtname;
        }

        
        if ($error == '') {
            $data = array('name'=> $txtname);
            
            if($this->system_management_model->add($data,'ndh_k2_user_groups')):
                $data = array('success_msg' => "Add data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/groups','refresh');
                exit;
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/addgroup_form','refresh');
                exit;
            endif;
        }else{
            
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/addgroup_form','refresh');
            exit;
        }
        
    }
    function add(){
        // load model
        $this->load->model('system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
        $txtorder = $this->input->post('txtorder',TRUE);
        $ddstatus = $this->input->post('ddstatus',TRUE);
 
        $error = '';$error_val = '';
        if ($txtname == '' || $txtname ==null){
            $error['txtname'] = 'กรุณากรอกชื่อประเภทปัญหาหลัก !!'; 
        }else{
            $error_val['val_txtname'] = $txtname;
        }
        if ($txtorder == '' || $txtorder ==null){
            $error['txtorder'] = 'กรุณากรอกลำดับ !!'; 
        }else{
            $error_val['val_txtorder'] = 99;
        }
        if (!is_numeric($txtorder)){
            $error['txtorder_num'] = 'กรุณากรอกลำดับ เป็นตัวเลข !!'; 
        }else{
            $error_val['val_txtorder'] = $txtorder;
        }

        
        if ($error == '') {
            $data = array('name'=> $txtname,
                      'ordering'=> $txtorder,
                      'status'=>$ddstatus
                      );

            if($this->system_management_model->add($data)):
                $data = array('success_msg' => "Add data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management','refresh');
                exit;
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/add_form','refresh');
                exit;
            endif;
        }else{
            
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/add_form','refresh');
            exit;
        }
        
    }
    public function edituser(){
        $id = $this->input->post('id');

        if ($id=='') {
            show_404();
        }
        // load model
        $this->load->model('system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
        $txtlastname = $this->input->post('txtlastname',TRUE);
        
        $txtposition = $this->input->post('txtposition',TRUE);
        $txtsubdistrict = $this->input->post('txtsubdistrict',TRUE);
        $txtdistrict = $this->input->post('txtdistrict',TRUE);
        $txtprovince = $this->input->post('txtprovince',TRUE);
        $txtpostcode = $this->input->post('txtpostcode',TRUE);
        $txttelephone = $this->input->post('txttelephone',TRUE);
        $txtfax = $this->input->post('txtfax',TRUE);
        $txtemail = $this->input->post('txtemail',TRUE);
        $txtusername = $this->input->post('txtusername',TRUE);
        $txtpassword = $this->input->post('txtpassword',TRUE);
        $ddgroup = $this->input->post('ddgroup',TRUE);
        $ddstatus = $this->input->post('ddstatus',TRUE);
 
        $error = '';$error_val = '';
        if ($txtusername == '' || $txtusername ==null){
            $error['txtusername'] = 'กรุณากรอกชื่อผู้เข้าใช !!'; 
        }else{
            $error_val['val_txtusername'] = $txtusername;
        }
        if ($txtpassword == '' || $txtpassword ==null){
            $error['txtpassword'] = 'กรุณากรอกรหัสผ่าน!!'; 
        }else{
            $error_val['val_txtpassword'] = $txtpassword;
        }
        if ($ddgroup == '' || $ddgroup ==null){
            $error['ddgroup'] = 'กรุณากลุ่ม !!'; 
        }else{
            $error_val['val_ddgroup'] = $ddgroup;
        }

        if ($error == '') {
            $phpass = new PasswordHash(10, true);
            $password = $phpass->HashPassword($txtpassword);
            

            $data_user = array(
                            'username' => $txtusername, 
                            'password' => $password,
                            'name'     => $txtname,
                            'lastname' => $txtlastname,
                            'group_id' => $ddgroup,
                            'position' => $txtposition,
                            'province' => $txtprovince,
                            'district' => $txtdistrict,
                            'subdistrict' => $txtsubdistrict,
                            'postcode' => $txtpostcode,
                            'email' => $txtemail,
                            'fax' => $txtfax,
                            'telephone' => $txttelephone,
                            'status' => $ddstatus
                );
            if($this->system_management_model->update($data_user,$id,'users')):
                $data = array('success_msg' => "Update data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management','refresh');
                exit;
                
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/edituser_form/'.$id,'refresh');
                exit;
            endif;
        }else{
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/edituser_form/'.$id,'refresh');
            exit;
        }
        
    }
    public function editgroup(){
        // load model
        $this->load->model('system_management/system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
        $id = $this->input->post('id',TRUE);
 
        $error = '';$error_val = '';
        if ($txtname == '' || $txtname == null){
            $error_val['val_txtname'] = '';
            $error['txtname'] = 'กรุณากรอกชื่อประเภทปัญหาหลัก !!'; 
        }

        if ($error == '') {
            $data = array('name'=> $txtname
                      );

            if($this->system_management_model->updateGroup($data,$id)):
                $data = array('success_msg' => "Add data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/groups','refresh');
                exit;
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/editgroup_form/'.$id,'refresh');
                exit;
            endif;
        }else{
            
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/editgroup_form/'.$id,'refresh');
            exit;
        }
        
    }
    function edit(){
        // load model
        $this->load->model('system_management/system_management_model');
        // get input data for check error
        $txtname = $this->input->post('txtname',TRUE);
        $txtorder = $this->input->post('txtorder',TRUE);
        $ddstatus = $this->input->post('ddstatus',TRUE);
        $id = $this->input->post('id',TRUE);
 
        $error = '';$error_val = '';
        if ($txtname == '' || $txtname == null){
            $error_val['val_txtname'] = '';
            $error['txtname'] = 'กรุณากรอกชื่อประเภทปัญหาหลัก !!'; 
        }
        if ($txtorder == '' || $txtorder == null){
            $error_val['val_txtorder'] = '99';
            $error['txtorder'] = 'กรุณากรอกลำดับ !!'; 
        }
        if (!is_numeric($txtorder)){
            $error_val['val_txtorder'] = '99';
            $error['txtorder_num'] = 'กรุณากรอกลำดับ เป็นตัวเลข !!'; 
        }else{
            $error_val['val_txtorder'] = $txtorder;
        }

        if ($error == '') {
            $data = array('name'=> $txtname,
                      'ordering'=> $txtorder,
                      'status'=>$ddstatus
                      );

            if($this->system_management_model->update($data,$id)):
                $data = array('success_msg' => "Add data Complete.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management','refresh');
                exit;
            else:
                $data = array('error_msg' => "Please contact admin.");
                # parse value msg to show error or succsess data for a while. 
                $this->session->set_flashdata('msg',$data);
                redirect('system_management/edit_form/'.$id,'refresh');
                exit;
            endif;
        }else{
            
            $this->session->set_flashdata('error_form',$error);
            $this->session->set_flashdata('error_val',$error_val);
            redirect('system_management/edit_form/'.$id,'refresh');
            exit;
        }
        
    }

    public function menu_setting(){
        // $id = $this->uri->segment(3);
        $this->template->write('title', 'System Management');
        $this->data->header_title = 'Menu Setting';
        $this->data->title = 'กำหนดสิทธิ์การเข้าถึง';
        # set active menu
        $this->data->main_active = 'setting';
        $this->data->menu_active = 'menu';
        if ($this->input->post()) {
            # get id
            $admin_id = $this->input->post('admin_id',TRUE);
            $staff_id = $this->input->post('staff_id',TRUE);
            $protect_id = $this->input->post('protect_id',TRUE);
            $guest_id = $this->input->post('guest_id',TRUE);
            // $manager_id = $this->input->post('manager_id',TRUE);

            $admin = $this->input->post('admin',TRUE);
            $staff = $this->input->post('staff',TRUE);
            $protect = $this->input->post('protect',TRUE);
            $guest = $this->input->post('guest',TRUE);
            // $manager = $this->input->post('manager',TRUE);
            // print_r($staff);exit;
            #update menu_id
            $this->load->model('system_management/system_management_model');
            if (!empty($admin)) {
                $data_admin = array('menu_id' => json_encode($admin));
                $this->system_management_model->update($data_admin,$admin_id,'user_groups');
            }
            if (!empty($staff)) {
                $data_staff = array('menu_id' => json_encode($staff));
                $this->system_management_model->update($data_staff,$staff_id,'user_groups');
            }
            
            if (!empty($protect)) {
                $data_protect = array('menu_id' => json_encode($protect));
                $this->system_management_model->update($data_protect,$protect_id,'user_groups');
            }
            if (!empty($guest)) {
                $data_guest = array('menu_id' => json_encode($guest));
                $this->system_management_model->update($data_guest,$guest_id,'user_groups');
            }
            // if (!empty($manager)) {
            //     $data_manager = array('menu_id' => json_encode($manager));
            //     $this->system_management_model->update($data_manager,$manager_id,'user_groups');
            // }
            
            
            $data = array('success_msg' => "Add data Complete.");
            # parse value msg to show error or succsess data for a while. 
            $this->session->set_flashdata('msg',$data);
            redirect('menu_setting','refresh');
            exit;
        }

        $this->load->model('system_management/system_management_model');
        $this->data->role_data = $this->system_management_model->getRoles();
        // $this->data->menu_list = $this->system_management_model->getMenuLists();
        $menu_list = $this->system_management_model->getMenuLists();

        foreach ($menu_list as $key => $value) {

            if ($value->parent_of=='' && $value->level == 1) {
                $menu[$value->mid]['main']['id'] = $value->mid;
                $menu[$value->mid]['main']['menu'] = $value->menu;
                
            }else if ($value->level == 2) {
                $sub_id = $value->mid;
                $menu[$value->parent_of]['sub'][$value->mid]['id'] = $value->mid;
                $menu[$value->parent_of]['sub'][$value->mid]['menu'] = $value->menu;
            }else if ($value->parent_of == $sub_id && $value->level == 3) {
                $main_id = $this->system_management_model->getMainMenuId($value->parent_of);
                $menu[$main_id]['sub'][$value->parent_of]['insub'][$value->mid]['id'] = $value->mid;
                $menu[$main_id]['sub'][$value->parent_of]['insub'][$value->mid]['menu'] = $value->menu;
            }
        }

        $this->data->menu_list = $menu;
        // echo '<pre>';
        // print_r($menu);
        // echo '</pre>';
        // exit;
        # start write view to template
        $this->template->write_view('menu','main_menu',$this->data); 
        $this->template->write_view('content','system_management/menu_form',$this->data);
        $this->template->render(); 
    }
    // public function menu_setting(){
    //     // $id = $this->uri->segment(3);
    //     $this->template->write('title', 'System Management');
    //     $this->data->header_title = 'Menu Setting';
    //     $this->data->title = 'กำหนดสิทธิ์การเข้าถึง';
    //     # set active menu
    //     $this->data->main_active = 'setting';
    //     $this->data->menu_active = 'menu';

    //     $this->load->model('system_management/system_management_model');
    //     $this->data->role_data = $this->system_management_model->getRoles();
    //     if ($this->input->post()) {
    //         # get id
    //         $admin_id = $this->input->post('admin_id',TRUE);
    //         $staff_id = $this->input->post('staff_id',TRUE);
    //         $protect_id = $this->input->post('protect_id',TRUE);
    //         // $rapid_id = $this->input->post('rapid_id',TRUE);
    //         // $manager_id = $this->input->post('manager_id',TRUE);

    //         $role = $this->input->post('role');
    //         $staff = $this->input->post('staff',TRUE);
    //         $protect = $this->input->post('protect',TRUE);
    //         // $rapid = $this->input->post('rapid',TRUE);
    //         // $manager = $this->input->post('manager',TRUE);
    //         // echo '<pre>';
    //         // print_r($role);
    //         // echo '</pre>';
    //         // exit;
    //         // $role_group = $this->system_management_model->getRoles();
    //         // foreach ($role_group as $key => $value) {
    //         //     $index = 'role'.$value->id;
    //         //     $role_val = $role.$value->id;
    //         //     $role_val = $this->input->post($index);
    //         //     echo '<pre>';
    //         //     print_r($role_val);
    //         //     echo '</pre>';

    //         // }
    //         // exit;
    //         // foreach ($role as $key => $r) {
    //         //     if (!empty($r)) {
    //         //         $data = array('menu_id' => json_encode($r));
    //         //         $this->system_management_model->update($data,$key,'user_groups');
    //         //     }
                
    //         // }
    //         // exit;
    //         #update menu_id
            
    //         if (!empty($admin)) {
    //             $data_admin = array('menu_id' => json_encode($admin));
    //             $this->system_management_model->update($data_admin,$admin_id,'user_groups');
    //         }
    //         if (!empty($staff)) {
    //             $data_staff = array('menu_id' => json_encode($staff));
    //             $this->system_management_model->update($data_staff,$staff_id,'user_groups');
    //         }
            
    //         if (!empty($protect)) {
    //             $data_protect = array('menu_id' => json_encode($protect));
    //             $this->system_management_model->update($data_protect,$protect_id,'user_groups');
    //         }
    //         // if (!empty($rapid)) {
    //         //     $data_rapid = array('menu_id' => json_encode($rapid));
    //         //     $this->system_management_model->update($data_rapid,$rapid_id,'user_groups');
    //         // }
    //         // if (!empty($manager)) {
    //         //     $data_manager = array('menu_id' => json_encode($manager));
    //         //     $this->system_management_model->update($data_manager,$manager_id,'user_groups');
    //         // }
            
            
    //         $data = array('success_msg' => "Add data Complete.");
    //         # parse value msg to show error or succsess data for a while. 
    //         $this->session->set_flashdata('msg',$data);
    //         redirect('system_management/menu_setting','refresh');
    //         exit;
    //     }

        
        
    //     // $this->data->menu_list = $this->system_management_model->getMenuLists();
    //     $menu_list = $this->system_management_model->getMenuLists();

    //     foreach ($menu_list as $key => $value) {

    //         if ($value->parent_of=='' && $value->level == 1) {
    //             $menu[$value->mid]['main']['id'] = $value->mid;
    //             $menu[$value->mid]['main']['menu'] = $value->menu;
                
    //         }else if ($value->level == 2) {
    //             $sub_id = $value->mid;
    //             $menu[$value->parent_of]['sub'][$value->mid]['id'] = $value->mid;
    //             $menu[$value->parent_of]['sub'][$value->mid]['menu'] = $value->menu;
    //         }else if ($value->parent_of == $sub_id && $value->level == 3) {
    //             $main_id = $this->system_management_model->getMainMenuId($value->parent_of);
    //             $menu[$main_id]['sub'][$value->parent_of]['insub'][$value->mid]['id'] = $value->mid;
    //             $menu[$main_id]['sub'][$value->parent_of]['insub'][$value->mid]['menu'] = $value->menu;
    //         }
    //     }

    //     $this->data->menu_list = $menu;
    //     // echo '<pre>';
    //     // print_r($menu);
    //     // echo '</pre>';
    //     // exit;
    //     # start write view to template
    //     $this->template->write_view('menu','main_menu',$this->data); 
    //     $this->template->write_view('content','system_management/menu_form',$this->data);
    //     $this->template->render(); 
    // }
}

/* End of file home.php */
/* Location: ./application/modules/test/controller/home.php */