<?php
/**
 * This class will be called by the post_controller_constructor hook and act as ACL
 * 
 * @author ChristianGaertner
 */
class ACL {
    
    /**
     * Array to hold the rules
     * Keys are the role_id and values arrays
     * In this second level arrays the key is the controller and value an array with key method and value boolean
     * @var Array 
     */
    private static $perms;
    /**
     * The field name, which holds the role_id
     * @var string 
     */
    private static $role_field;
    /**
     * Contstruct in order to set rules
     * @author ChristianGaertner
     */
    public function __construct() {
        // $this->role_field = 'role_id';
        

        
        /*$this->perms[0]['home']['index']        = true;
        $this->perms[0]['home']['about']        = true;
        $this->perms[1]['user']['dashboard']    = true;
        $this->perms[1]['user']['edit']         = true;
        $this->perms[1]['user']['show']         = true;
        $this->perms[2]['admin']['dashboard']   = true;
        $this->perms[2]['admin']['settings']    = true;*/
    }
    /**
     * The main method, determines if the a user is allowed to view a site
     * @author ChristianGaertner
     * @return boolean
     */
    public function auth()
    {
        $CI =& get_instance();
        
        if (!isset($CI->session))
        { # Sessions are not loaded
            $CI->load->library('session');
        }
        
        if (!isset($CI->router))
        { # Router is not loaded
            $CI->load->library('router');
        }
        
        
        $class = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();
// echo $class.'-'.$method;exit;
        // Is rule defined?
        $is_ruled = false;
        
        if ($CI->session->userdata('user_id')==''&& $CI->session->userdata('user_id')==null) {

            if ($class != 'home' && $class != 'api') {
                if ($class != 'redirect_url' && $class != 'api2') {
                    redirect('home/index');
                    exit;
                }
                
            }
        }else{
            // $CI->load->model('home/home_model');
            // $menu_id = $CI->home_model->Access_Level($class,$method);
            // if (in_array($menu_id, $CI->session->userdata('menu'))) {
            //     return true
            // }else{

            // }
            
            return true;
        }

        

        
        
    }
}
