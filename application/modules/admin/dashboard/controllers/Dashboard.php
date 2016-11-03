<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

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
        $this->template->write('website_name', 'Amazing Chaiyaphum : Dashboard');
//        $this->data->header_title = 'ข้อมูลผู้ใช้งาน';
        # start add js for this page
        // $this->template->add_chart_js(URLPATH_JS.'morris/chart-data-morris.js');
//        $this->template->add_css(URLPATH_CSS.'plugins/dataTables/dataTables.bootstrap.css');
//        $this->template->add_js(URLPATH_JS.'plugins/dataTables/jquery.dataTables.js');
//        $this->template->add_js(URLPATH_JS.'plugins/dataTables/dataTables.bootstrap.js');
        # end add js for this page
        # query data 
        //load model (folder/model)
        $this->load->model('dashboard/dashboard_model');
        $this->data->cateAll = $this->dashboard_model->getCateAll();
        $this->data->eventAll = $this->dashboard_model->getEventAll();
        $this->data->itemAll = $this->dashboard_model->getItemAll();
        $this->data->newsAll = $this->dashboard_model->getNewsAll();

        $this->data->newsYes = $this->dashboard_model->getNewsByStatus(1);
        $this->data->newsNo = $this->dashboard_model->getNewsByStatus(0);

        $this->data->cateYes = $this->dashboard_model->getCategoryByStatus(1);
        $this->data->cateNo = $this->dashboard_model->getCategoryByStatus(0);

        $this->data->itemYes = $this->dashboard_model->getItemByStatus(1);
        $this->data->itemNo = $this->dashboard_model->getItemByStatus(0);

        $this->data->eventYes = $this->dashboard_model->getEventByStatus(1);
        $this->data->eventNo = $this->dashboard_model->getEventByStatus(0);
//        $this->load->model('system_management/system_management_model');
//        
//        $this->data->allusers = $this->system_management_model->getUserAll();
        
        # set active menu
       $this->data->main_active = 'dashboard';
//        $this->data->menu_active = 'system_management';
        # start write view to template
        $this->template->write_view('menu_top','menu',$this->data); 
        $this->template->write_view('fullpage','dashboard/page_main',$this->data);
        $this->template->render(); 
    }
}
