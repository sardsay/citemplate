<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

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
            // $this->load->model('home_model','home');
            $this->data  = (object)array(); 
            
    }
	public function index()
	{
      // $this->template->add_css(URLPATH_ADMIN_CSS.'plugins/dataTables/dataTables.bootstrap.css');
        if ($this->input->post()) {

            $this->load->model('home/users_model');

            $txtusername = $this->input->post('username');
            $txtpassword = $this->input->post('password');
            // $remember = $this->input->post('remember');

            if ($txtusername!='' && $txtpassword!='') {
                $data = array('username' =>$txtusername,'password'=>$txtpassword);
                $result = $this->users_model->authen_user($data);
                // print_r($result);
                if ($result) {
                  if ($this->session->userdata('role_id')==1) {
                      redirect('dashboard','refresh');
                      exit;
                  }else{
                      $this->load->model('home/home_model');
                      $default_menu = $this->home_model->getDefalutMenu();
                      // print_r($default_menu) ;exit;
                      redirect($default_menu,'refresh');
                      exit;
                  }
                    
                }else{
                    $this->data->error= array('error_msg' => "Username or Password Incorrect!!!");
                }

            }
            
        }
        $this->template->write('title', 'เข้าสู่ระบบ');
        
        $this->template->write_view('login','home/loginphet',$this->data);
        $this->template->render();

	}
    
    /*public function login(){

        if ($this->input->post()) {

            $this->load->model('home/users_model');

            $txtusername = $this->input->post('username');
            $txtpassword = $this->input->post('password');
            $remember = $this->input->post('remember');

            if ($txtusername!='' && $txtpassword!='') {
                $data = array('username' =>$txtusername,'password'=>$txtpassword);
                $result = $this->users_model->authen_user($data);
                // print_r($result);
                if ($result) {
                  if ($this->session->userdata('role_id')==1) {
                      redirect('menu_setting','refresh');
                      exit;
                  }else{
                      $this->load->model('home/home_model');
                      $default_menu = $this->home_model->getDefalutMenu();
                      // print_r($default_menu) ;exit;
                      redirect($default_menu,'refresh');
                      exit;
                  }
                    
                }else{
                    $this->data->error= array('error_msg' => "Username or Password Incorrect!!!");
                }

            }
            
        }
        $this->template->write('title', 'เข้าสู่ระบบ');
        
        $this->template->write_view('fullpage','home/login',$this->data);
        $this->template->render();

    }*/
    
    public function logout(){
        $array_items = array('user_id'=>'','name'=>'','menu'=>'','role_id'=>'','err_count'=>'','user_data'=>'');
        $this->session->unset_userdata($array_items);
        redirect('home','refresh');
        exit();
    }
    
    

}

/* End of file home.php */
/* Location: ./application/modules/home/controller/home.php */