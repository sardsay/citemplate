<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Api extends REST_Controller {
    public $PATH_CATE_IMAGE = null;
    public $PATH_SUBCATE_IMAGE = null;
    public $PATH_EVENT_IMAGE =  null;
    public $PATH_ITEM_IMAGE =  null;
    public $PATH_NEW_IMAGE = null;
    public $PATH_AVARTAR = null;
    public $PATH_UPLOAD_AVARTAR = null;
    public $PATH_UPLOAD_ITEM = null;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->PATH_CATE_IMAGE = base_url().URLPATH_UPLOAD_CATEIMAGES;
        $this->PATH_SUBCATE_IMAGE = base_url().URLPATH_UPLOAD_SUBCATEIMAGES;
        $this->PATH_EVENT_IMAGE = base_url().URLPATH_UPLOAD_EVENTIMAGES;
        $this->PATH_ITEM_IMAGE = base_url().URLPATH_UPLOAD_ITEMIMAGES;
        $this->PATH_NEW_IMAGE = base_url().URLPATH_UPLOAD_NEWSIMAGES;
        $this->PATH_AVARTAR = base_url().URLPATH_UPLOAD_AVATAR;
        $this->PATH_UPLOAD_AVARTAR = URLPATH_UPLOAD_AVATAR;
        $this->PATH_UPLOAD_ITEM = URLPATH_UPLOAD_ITEMIMAGES;
        // $this->PATH_UPLOAD_ITEM = URLPATH_UPLOAD_ITEMIMAGES_MOBILE;
    }
    /*-----------------------------------------------------------------
    * POST  Authentication
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function authentication_post(){
        $email = $this->post('email');
        $pass = $this->post('password');
        $this->load->model('api_model');
        $dbpwd = $this->api_model->getPWDByEmail($email);

        if (hash_equals($dbpwd,hash('sha256',$pass.SALT_2FELLOWS))) {
            $data = array('email' => $email,'pass' => hash('sha256',$pass.SALT_2FELLOWS));
            $new_data = $this->api_model->auThenUser($data);
            if ($new_data != null) {
                foreach ($new_data as $key => $value) {
                    $all_data['user_id'] = $value->user_id;
                    $all_data['username'] = $value->username;
                    $all_data['avatar'] = ($value->avatar!='')?$this->PATH_AVARTAR.($value->user_id%10).'/'.$value->user_id.'/'.$value->avatar:'';
                    $all_data['memtype'] = $value->memtype;
                    $all_data['shopname'] = $value->shopname;
                    $all_data['realname'] = $value->realname;
                    $all_data['email'] = $value->email;
                }    
                $result['status']   = 1;
                $result['data']     = $all_data;    
            }else{
                $result['status']   = 0;
                $result['msg'] = 'no data';
            }
            $this->response($result, REST_Controller::HTTP_OK);    
        }else{

            $result['status']   = 0;
            $result['msg'] = 'hash not equal';
            // $result['data']     = $all_data;
        }
        
        $this->response($result, REST_Controller::HTTP_OK);
        
    }
    /*-----------------------------------------------------------------
    * POST  Register
    * Create :: 04-November-2558 By :: Bow
    * Update :: 05-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function register_post(){
 
        $shopname = $this->post('shopname');
        $realname = $this->post('realname');
        $email = $this->post('email');
        $username = $this->post('username');
        $pass = $this->post('password');
        $memtype = $this->post('memtype');
        $info = strtolower($this->post('filetype'));
        $file_final = base64_decode($this->post('avatar_binary'));
        $this->load->model('api_model');
        if (!$this->api_model->checkEmailMember($email)) {
            $rawData = array(
                    'shopname' => $shopname,
                    'realname' => $realname,
                    'email' => $email,
                    'status' => 1,
                    'username' => $username,
                    'password' => hash('sha256',$pass.SALT_2FELLOWS),
                    'group_id' => $memtype, 
            );
            if ($user_id = $this->api_model->addMember($rawData)) {
                $dest_dir =  $this->PATH_UPLOAD_AVARTAR;
                $dest_dir_check = $dest_dir.'/'.($user_id%10).'/';
                $im = imagecreatefromstring($file_final);
                if (!is_dir($dest_dir_check)) {
                    if (!mkdir($dest_dir_check, 0777)) {
                        echo "Error : mkdir 2 ";exit;
                    }    
                }
                $dest_dir_check = $dest_dir.'/'.($user_id%10).'/'.$user_id.'/';
                if (!is_dir($dest_dir_check)) {
                    if (!mkdir($dest_dir_check, 0777)) {
                        echo "Error : mkdir 3";exit;
                    }    
                }
                $filepath =  $dest_dir_check.'/avatar_'.$user_id.'.'.$info;
                $fileName = 'avatar_'.$user_id.'.'.$info;
                imagealphablending($im, false); 
                imagesavealpha($im, true);
                if($info == 'png'){
                    $resp = imagepng($im, $filepath);
                }
                else if($info == 'jpg' || $info == 'jpeg'){
                    $resp = imagejpeg($im, $filepath);
                }
                else if($info == 'gif'){
                    $resp = imagegif($im, $filepath);
                }    
                imagedestroy($im);
                
                if ($resp != null) {
                    if ($this->api_model->updateAvatarByID($fileName,$user_id)) {
                        $result['status'] = 1;     
                    }else{
                        $result['status'] = 1;    
                        $result['status_code'] = 103;
                    }
                }else{
                    $result['status'] = 1;
                    $result['status_code'] = 102;
                }
            }else{
                $result['status'] = 0;
            }    
        }else{
            $result['status'] = 0;
            $result['status_code'] = 101;
        }
        $this->response($result, REST_Controller::HTTP_OK);
        
    }
    public function registerFacebook_post(){
        $this->load->model('api_model');
        $fid = $this->post('facebook_id');
        $realname = $this->post('name');
        if ($user_id = $this->api_model->checkFacebookID($fid)) {
            $result['status'] = 1;
            $result['user_id'] = $user_id;
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $rawData = array(
                    'shopname' => '',
                    'realname' => $realname,
                    'email' => '',
                    'status' => 1,
                    'username' => '',
                    'password' => '',
                    'group_id' => 3, 
                    'facebook_id'=> $fid
            );
            if ($user_id = $this->api_model->addMember($rawData)) {
                $result['status'] = 1;
                $result['user_id'] = $user_id;
            }else{
                $result['status'] = 0;
            }    
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
        
    }
    /*-----------------------------------------------------------------
    * POST  get All Category Main
    * Create :: 04-November-2558 By :: Bow
    * Update :: 05-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function allMainCategory_post(){
        $lang = $this->post('lang');
        // $cateID = $this->post('cateID');
        $this->load->model('api_model');
        $data = $this->api_model->getCategoryMain();
        if ($data != NULL) {
            foreach ($data as $key => $value) {
                $new_data[$key]['id'] = $value->id;
                if($lang == 'th'){
                    $new_data[$key]['name'] = $value->name;
                }
                else if($lang == 'en'){
                    $new_data[$key]['name'] = $value->name_en;
                }
                else{
                    $new_data[$key]['name'] = $value->name_cn;
                }
                $thumb_image = ($value->image_thumb_vertical!=NULL)?$this->PATH_CATE_IMAGE.($value->id%10).'/'.$value->image_thumb_vertical:'http://128.199.232.94/chaiyaphum/assets/admin/images/img_default_vertical.png';
                $new_data[$key]['image'] = $thumb_image;
                $new_data[$key]['subcate_status'] = $this->checkSubCateByMainCateID($value->id);
            }unset($data,$key,$value);
            $result['status'] = 1;
            $result['data'] = $new_data;
        }else{
            $result['status'] = 0;
        }
        $this->response($result, REST_Controller::HTTP_OK);
        
    }
    /*-----------------------------------------------------------------
    * POST  Check sub cate by main cate id
    * Create :: 05-November-2558 By :: Bow
    * Update :: 05-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    private function checkSubCateByMainCateID($id){
        $this->load->model('api_model');
        $data = $this->api_model->checkSubCateByCateID($id);
        return $data;
    }
    /*-----------------------------------------------------------------
    * POST  get Sub Category By main category id
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function subCategoryByMainCateID_post(){
        $lang = $this->post('lang');
        $cateID = $this->post('maincate_id');
        $this->load->model('api_model');
        $data = $this->api_model->getSubCategoryByMainID($cateID,$lang);

        if ($data != NULL) {
            foreach ($data as $key => $value) {
                $new_data[$key]['id'] = $value->id;
                $new_data[$key]['name'] = $value->name;
                
                $thumb_image = ($value->image_thumb_vertical!=NULL)?$this->PATH_SUBCATE_IMAGE.$value->id.'/'.$value->image_thumb_vertical:'http://128.199.232.94/chaiyaphum/assets/admin/images/img_default_vertical.png';
                $new_data[$key]['image'] = $thumb_image;
            }unset($data,$key,$value);
            $result['status'] = 1;
            $result['data'] = $new_data;
        }else{
            $result['status'] = 0;
        }
        $this->response($result, REST_Controller::HTTP_OK);
        
    }
    /*-----------------------------------------------------------------
    * POST get Item list by  Main category id.
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function itemListByMainCateID_post(){
        $id = $this->post('maincate_id');
        $page = $this->post('page');
        $lang = $this->post('lang');
        // $size = $this->post('size');
        $this->load->model('api_model');
        // $size_arr=array('hdpi','xhdpi','xxhdpi');

        // if (in_array($size, $size_arr) && $page != '') {
            $data = $this->api_model->getItemListByCateID($id,$lang,$page);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    // $new_data[$key]['description'] = $value->description;
                    // $new_data[$key]['address'] = $value->address;
                    // $new_data[$key]['website'] = $value->website;
                    // $new_data[$key]['telephone'] = $value->telephone;
                    // $new_data[$key]['working_time'] = $value->working_time;
                    $new_data[$key]['modify_date'] = $value->modify_date;
                    // $new_data[$key]['latitude'] = $value->latitude;
                    // $new_data[$key]['longitude'] = $value->longitude;
                    // $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    // $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    $image_thumb = ($value->image_thumb)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:"";
                    // $new_data[$key]['pin_image'] = $pin_image;
                    $new_data[$key]['image'] = $image_thumb;
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        // }else{
        //     $result['status'] = 0;
        //     $this->response($result, REST_Controller::HTTP_OK);
        // }
    }
    /*-----------------------------------------------------------------
    * POST get Item list by  sub category id.
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function itemListBySubCateID_post(){
        $id = $this->post('subcate_id');
        $lang = $this->post('lang');
        $page = $this->post('page');
        // $size = $this->post('size');
        $this->load->model('api_model');
        
            $data = $this->api_model->getItemListBySubCateID($id,$lang,$page);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $image_thumb = ($value->image_thumb)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:"";
                    // $new_data[$key]['pin_image'] = $pin_image;
                    $new_data[$key]['image'] = $image_thumb;
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        
    }
    /*-----------------------------------------------------------------
    * POST get Item detail by id
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    /*public function itemDetailByID_post(){
        $id = $this->post('item_id');
        $size = $this->post('size');
        $this->load->model('api_model');
        $size_arr=array('hdpi','xhdpi','xxhdpi');
        if (in_array($size, $size_arr)) {
            $data = $this->api_model->getItemDetailByID($id);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['description'] = $value->description;
                    $new_data[$key]['address'] = $value->address;
                    $new_data[$key]['telephone'] = $value->telephone;
                    $new_data[$key]['website'] = $value->website;
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    // $pin_image = ($value->pin_map !=null)?$this->PATH_CATE_IMAGE.$value->category_id.'/pin-cate'.$value->category_id.'_'.$size.'.png':$this->PATH_PIN_DEFAULT;
                    $new_data[$key]['pin_image'] = $pin_image;
                    $gallery = $this->api_model->getGalleryItemByID($value->id);
                        if ($gallery != NULL) {
                            foreach ($gallery as $gkey => $gitem) {
                                $new_gallery[$gkey]['id'] = $gitem->id;
                                $new_gallery[$gkey]['image_name'] = $this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                                
                            }unset($gallery,$gkey,$gitem);
                            $new_data[$key]['gallery'] = $new_gallery;
                        }else{
                            $new_data[$key]['gallery'] = array();
                        }
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }*/
    /*-----------------------------------------------------------------
    * POST  add place
    * Create :: 04-November-2558 By :: Bow
    * Update :: 08-Decenber-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function addPlace_post(){
        $this->load->model('api_model');
        $lang = $this->post('lang');
        $title = $this->post('title');
        
        $info = strtolower($this->post('image_type'));
        $file_final = base64_decode($this->post('thumb_binary'));

        $amphur_id = $this->post('amphur_id');
        $district_id = $this->post('district_id');
        $address = $this->post('address');
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');
        $telephone = $this->post('telephone');
        $website = $this->post('website');
        $working_time = $this->post('working_time');
        $description = $this->post('description');
        $source_type = $this->post('memtype');
        $category_id = $this->post('category_id');
        $subcategory_id = ($this->post('subcategory_id')!='')?$this->post('subcategory_id'):0;
        $create_date = date('Y-m-d H:i:s');
        $user_create = $this->post('user_id');
        $rawData = array(
                'title' => $title,
                'description' => $description,
                'address' => $address,
                'telephone' => $telephone,
                'website' => $website,
                'working_time' => $working_time,
                'lang' => $lang,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'source_type' => 2,
                'status' => 2,
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'district_id' => $district_id,
                'amphur_id' => $amphur_id,
                'create_date' => $create_date,
                'user_create' => $user_create
            );

        if ($item_id = $this->api_model->addItem($rawData)) {
            // upload thumb image
            $dest_dir =  $this->PATH_UPLOAD_ITEM;
            $dest_dir_check = $dest_dir.($item_id%10).'/';
            
            $im = imagecreatefromstring($file_final);
            if (!is_dir($dest_dir_check)) {
                if (!mkdir($dest_dir_check, 0777)) {
                    echo "Error : mkdir 2 ";exit;
                }    
            }
            $dest_dir_check = $dest_dir.($item_id%10).'/'.$item_id.'/';
                if (!is_dir($dest_dir_check)) {
                    if (!mkdir($dest_dir_check, 0777)) {
                        echo "Error : mkdir 3";exit;
                    }    
                }

            $fileName = 'thumb_item'.$item_id.'.'.$info;
            $filepath =  $dest_dir_check.$fileName;
            
            imagealphablending($im, false); 
            imagesavealpha($im, true);
            
            if($info == 'png'){
                $resp = imagepng($im, $filepath);
            }else if($info == 'jpg' || $info == 'jpeg'){
                $resp = imagejpeg($im, $filepath);
            }else if($info == 'gif'){
                $resp = imagegif($im, $filepath);
            }    

            imagedestroy($im);
            if ($resp != null) {
                $thumb_data = array('image_thumb'=>$fileName);
                $this->api_model->updateImageThumbName($thumb_data,$item_id);
                $result['status'] = 1;    
                $result['item_id'] = $item_id;
            }else{
                $result['status'] = 1;
                $result['item_id'] = $item_id;
                $result['msg'] = 'can not upload thumb';
            }
            
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
    }
    /*-----------------------------------------------------------------
    * POST  Upload place pic
    * Create :: 08-Decenber-2558 By :: Bow
    * Update :: 08-Decenber-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function uploadItemPic_post(){
        $item_id = $this->post('item_id');
        $info = strtolower($this->post('filetype'));
        $file_final = base64_decode($this->post('pic_binary'));
        $numberfile = $this->post('ordering');

        $dest_dir =  $this->PATH_UPLOAD_ITEM;
        $dest_dir_check = $dest_dir.($item_id%10).'/';
        $this->load->model('api_model');
        $im = imagecreatefromstring($file_final);
        if (!is_dir($dest_dir_check)) {
            if (!mkdir($dest_dir_check, 0777)) {
                echo "Error : mkdir mod ";exit;
            }    
        }
        $dest_dir_check = $dest_dir.($item_id%10).'/'.$item_id.'/';
            if (!is_dir($dest_dir_check)) {
                if (!mkdir($dest_dir_check, 0777)) {
                    echo "Error : mkdir item id";exit;
                }    
            }
        $dest_dir_check = $dest_dir.($item_id%10).'/'.$item_id.'/gallerys/';
            if (!is_dir($dest_dir_check)) {
                if (!mkdir($dest_dir_check, 0777)) {
                    echo "Error : mkdir gallery";exit;
                }    
            }
        $fileName = 'item_'.$item_id.'_'.date('YmdHis').'_'.$numberfile.'.'.$info;
        $filepath =  $dest_dir_check.$fileName;
        
        imagealphablending($im, false); 
        imagesavealpha($im, true);
        
        if($info == 'png'){
            $resp = imagepng($im, $filepath);
        }else if($info == 'jpg' || $info == 'jpeg'){
            $resp = imagejpeg($im, $filepath);
        }else if($info == 'gif'){
            $resp = imagegif($im, $filepath);
        }    

        imagedestroy($im);
        if ($resp != null) {
            $image_data = array(
                    'image_name'=>$fileName,
                    'item_id'=>$item_id,
                    'ordering'=>$numberfile,
                    'status'=>0
            );
            if ($this->api_model->addGallery($image_data)) {
                $result['status'] = 1;
            }else{
                $result['status'] = 0;    
            }
        }else{
            $result['status'] = 0;
            $result['status_code'] = 'cant create file image';
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  Upload place pic
    * Create :: 08-Decenber-2558 By :: Bow
    * Update :: 08-Decenber-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function uploadItemEditPic_post(){
        $item_id = $this->post('item_id');
        $info = strtolower($this->post('filetype'));
        $file_final = base64_decode($this->post('pic_binary'));
        $numberfile = $this->post('ordering');

        $dest_dir =  $this->PATH_UPLOAD_ITEM;
        $dest_dir_check = $dest_dir.($item_id%10).'/';
        $this->load->model('api_model');
        $im = imagecreatefromstring($file_final);
        if (!is_dir($dest_dir_check)) {
            if (!mkdir($dest_dir_check, 0777)) {
                echo "Error : mkdir mod ";exit;
            }    
        }
        $dest_dir_check = $dest_dir.($item_id%10).'/'.$item_id.'/';
            if (!is_dir($dest_dir_check)) {
                if (!mkdir($dest_dir_check, 0777)) {
                    echo "Error : mkdir item id";exit;
                }    
            }
        $dest_dir_check = $dest_dir.($item_id%10).'/'.$item_id.'/gallerys/';
            if (!is_dir($dest_dir_check)) {
                if (!mkdir($dest_dir_check, 0777)) {
                    echo "Error : mkdir gallery";exit;
                }    
            }
        $fileName = 'item_'.$item_id.'_'.date('YmdHis').'_'.$numberfile.'.'.$info;
        $filepath =  $dest_dir_check.$fileName;
        
        imagealphablending($im, false); 
        imagesavealpha($im, true);
        
        if($info == 'png'){
            $resp = imagepng($im, $filepath);
        }else if($info == 'jpg' || $info == 'jpeg'){
            $resp = imagejpeg($im, $filepath);
        }else if($info == 'gif'){
            $resp = imagegif($im, $filepath);
        }    

        imagedestroy($im);
        if ($resp != null) {
            $image_data = array(
                    'image_name'=>$fileName,
                    'item_id'=>$item_id,
                    'ordering'=>$numberfile,
                    'status'=>0
            );
            if ($this->api_model->addGalleryEdit($image_data)) {
                $result['status'] = 1;
            }else{
                $result['status'] = 0;    
            }
        }else{
            $result['status'] = 0;
            $result['status_code'] = 'cant create file image';
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  update place
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function updatePlaceByID_post(){
        
        $this->load->model('api_model');

        $placeid = $this->post('item_id');

        $lang = $this->post('lang');
        $title = $this->post('title');
        $amphur_id = $this->post('amphur_id');
        $district_id = $this->post('district_id');
        $address = $this->post('address');
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');
        $telephone = $this->post('telephone');
        $website = $this->post('website');
        $working_time = $this->post('working_time');
        $description = $this->post('description');
        $source_type = $this->post('memtype');
        $category_id = $this->post('category_id');
        $subcategory_id = ($this->post('subcategory_id')!='')?$this->post('subcategory_id'):0;
        $create_date = date('Y-m-d H:i:s');
        $user_create = $this->post('user_id');
        // if ($this->api_model->checkItemStatusByID($placeid)) {
        //     $rawData = array(
        //         'title' => $title,
        //         'description' => $description,
        //         'address' => $address,
        //         'telephone' => $telephone,
        //         'website' => $website,
        //         'working_time' => $working_time,
        //         'lang' => $lang,
        //         'latitude' => $latitude,
        //         'longitude' => $longitude,
        //         'source_type' => 2,
        //         'status' => 2,
        //         'category_id' => $category_id,
        //         'subcategory_id' => $subcategory_id,
        //         'district_id' => $district_id,
        //         'amphur_id' => $amphur_id,
        //         'modify_date' => $create_date,
        //         'user_modify' => $user_create
        //     );
        //     if ($this->api_model->updateItemMobileEdit($rawData,$placeid)) {
        //         $result['status'] = 1;
        //         $result['msg'] = 'update items_mobile';
        //     }else{
        //         $result['status'] = 0;
        //     }
        //     $this->response($result, REST_Controller::HTTP_OK);
        // }else{
        //     if ($this->api_model->checkMobileItemByID($placeid)) {
        //         $rawData = array(
        //             'title' => $title,
        //             'description' => $description,
        //             'address' => $address,
        //             'telephone' => $telephone,
        //             'website' => $website,
        //             'working_time' => $working_time,
        //             'lang' => $lang,
        //             'latitude' => $latitude,
        //             'longitude' => $longitude,
        //             'source_type' => 2,
        //             'status' => 2,
        //             'category_id' => $category_id,
        //             'subcategory_id' => $subcategory_id,
        //             'district_id' => $district_id,
        //             'amphur_id' => $amphur_id,
        //             'modify_date' => $create_date,
        //             'user_modify' => $user_create
        //         );
        //         if ($this->api_model->updateMobileItemEdit($rawData,$placeid)) {
        //             $result['status'] = 1;
        //             $result['msg'] = 'update mobile_items';
        //         }else{
        //             $result['status'] = 0;
        //         }
        //         $this->response($result, REST_Controller::HTTP_OK);
        //     }else{
        //         $rawData = array(
        //             'item_id' => $placeid,
        //             'title' => $title,
        //             'description' => $description,
        //             'address' => $address,
        //             'telephone' => $telephone,
        //             'website' => $website,
        //             'working_time' => $working_time,
        //             'lang' => $lang,
        //             'latitude' => $latitude,
        //             'longitude' => $longitude,
        //             'source_type' => 2,
        //             'status' => 2,
        //             'category_id' => $category_id,
        //             'subcategory_id' => $subcategory_id,
        //             'district_id' => $district_id,
        //             'amphur_id' => $amphur_id,
        //             'modify_date' => $create_date,
        //             'user_modify' => $user_create
        //         );
        //         if ($this->api_model->addMobileItemEdit($rawData)) {
        //             $result['status'] = 1;
        //             $result['msg'] = 'add mobile_items';
        //         }else{
        //             $result['status'] = 0;
        //         }    
        //         $this->response($result, REST_Controller::HTTP_OK);
        //     }
        // }
        
            if ($this->api_model->checkMobileItemByID($placeid)) {
                $rawData = array(
                    'title' => $title,
                    'description' => $description,
                    'address' => $address,
                    'telephone' => $telephone,
                    'website' => $website,
                    'working_time' => $working_time,
                    'lang' => $lang,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'source_type' => 2,
                    'status' => 2,
                    'category_id' => $category_id,
                    'subcategory_id' => $subcategory_id,
                    'district_id' => $district_id,
                    'amphur_id' => $amphur_id,
                    'modify_date' => $create_date,
                    // 'user_create' => $user_create,
                    'user_modify' => $user_create
                );
                if ($this->api_model->updateMobileItemEdit($rawData,$placeid)) {
                    $result['status'] = 1;
                    $result['msg'] = 'update items_mobile';
                }else{
                    $result['status'] = 0;
                }
                $this->response($result, REST_Controller::HTTP_OK);
            }else{
                $rawData = array(
                    'item_id' => $placeid,
                    'title' => $title,
                    'description' => $description,
                    'address' => $address,
                    'telephone' => $telephone,
                    'website' => $website,
                    'working_time' => $working_time,
                    'lang' => $lang,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'source_type' => 2,
                    'status' => 2,
                    'category_id' => $category_id,
                    'subcategory_id' => $subcategory_id,
                    'district_id' => $district_id,
                    'amphur_id' => $amphur_id,
                    'modify_date' => $create_date,
                    'user_modify' => $user_create
                );
                if ($this->api_model->addMobileItemEdit($rawData)) {
                    $result['status'] = 1;
                    $result['msg'] = 'add items_mobile';
                }else{
                    $result['status'] = 0;
                }    
                $this->response($result, REST_Controller::HTTP_OK);
            }
        
        
    }

    
    /*-----------------------------------------------------------------
    * POST  Upload place pic Edit
    * Create :: 12-Decenber-2558 By :: Bow
    * Update :: 12-Decenber-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function clearPicEdit_post(){
        $item_id = $this->post('item_id');
        $filename = $this->post('filename');
        $delete_status = $this->post('file_status');// 0 = delete
        $this->load->model('api_model');
        if ($delete_status == 0) {
            if($this->api_model->deleteEditPicMobile($item_id,$filename)){
                $result['status'] = 1;
            }else{
                $result['status'] = 0;
                $result['msg'] = 'can not delete pic. please contact admin.';
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $result['msg'] = 'file_status not correct.';
            $this->response($result, REST_Controller::HTTP_OK);
        }
        
    }
    /*-----------------------------------------------------------------
    * POST  AR
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function arByID_post(){
        $this->load->model('api_model');
        $lang = $this->post('lang');
        $size = $this->post('size');
        /*$size_arr=array('hdpi','xhdpi','xxhdpi');
        if (in_array($size, $size_arr)) {
            $data = $this->api_model->getEventList($lang);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['event_name'] = $value->event_name;
                    $new_data[$key]['event_detail'] = $value->event_detail;
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_EVENT_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                    $new_data[$key]['image'] = $thumb_image;
                    $new_data[$key]['pin_image'] = $this->PATH_EVENT_IMAGE.'pinevent_'.$size.'.png';
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }*/
    }
    /*-----------------------------------------------------------------
    * POST  get Event list 
    * Create :: 04-November-2558 By :: Bow
    * Update :: 17-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function eventList_post(){
        $this->load->model('api_model');
        $lang = $this->post('lang');
        $page = $this->post('page');
            $data = $this->api_model->getEventList($lang,$page);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['event_name'] = $value->event_name;
                    $new_data[$key]['event_detail'] = $value->event_detail;
                    $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_EVENT_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                    $new_data[$key]['image'] = $thumb_image;
                    
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
    }

    /*-----------------------------------------------------------------
    * POST  get Event by id
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function eventDetailByID_post(){
        $eid = $this->post('event_id');
        // $size = $this->post('size');
        $this->load->model('api_model');
        // $size_arr=array('hdpi','xhdpi','xxhdpi');
        if ($eid != '') {
            $data = $this->api_model->getEventByID($eid);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['event_name'] = $value->event_name;
                    $new_data[$key]['event_detail'] = $value->event_detail;
                    
                    $new_data[$key]['starttime'] = date_format(strtotime($value->starttime),'g:i A');
                    $new_data[$key]['endtime'] = date_format(strtotime($value->endtime),'g:i A');
                    $new_data[$key]['address'] = $value->address;
                    $new_data[$key]['telephone'] = $value->telephone;
                    $new_data[$key]['pin_image'] = $this->PATH_EVENT_IMAGE.'pinevent_'.$size.'.png';
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $gallery = $this->api_model->getGalleryEventByID($eid);
                    if ($gallery != NULL) {
                        foreach ($gallery as $gkey => $gitem) {
                            $new_gallery[$gkey]['id'] = $gitem->id;
                            $new_gallery[$gkey]['image_name'] = $this->PATH_EVENT_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                        }
                        $new_data[$key]['gallery'] = $new_gallery;
                    }else{
                        $new_data[$key]['gallery'] = array();
                    }
                    $schedule = $this->api_model->getScheduleByEventID($value->id);
                    if ($schedule != NULL) {
                        $k=0;
                        $l=0;
                        foreach ($schedule as $skey => $sitem) {
                            
                            if ($skey == 0) {
                                $start_date = $sitem->start_date;
                                $end_date = $sitem->end_date;
                                $new_schedule[$k]['id'] = $sitem->id;
                                $new_schedule[$k]['start_date'] = $sitem->start_date;
                                $new_schedule[$k]['end_date'] = $sitem->end_date;
                                $new_schedule[$k]['detail'][$l]['start_time'] = date('g:i A',strtotime($sitem->start_time));
                                $new_schedule[$k]['detail'][$l]['end_time'] = date('g:i A',strtotime($sitem->end_time));
                                $new_schedule[$k]['detail'][$l]['schedule_detail'] = $sitem->schedule_detail;
                                ++$l;
                            }else{
                                if ($start_date == $sitem->start_date && $end_date == $sitem->end_date) {
                                    // $new_schedule[$k]['id'] = $sitem->id;
                                    // $new_schedule[$k]['start_date'] = $sitem->start_date;
                                    // $new_schedule[$k]['end_date'] = $sitem->end_date;
                                    $new_schedule[$k]['detail'][$l]['start_time'] = date_format(strtotime($sitem->start_time),'g:i A');
                                    $new_schedule[$k]['detail'][$l]['end_time'] = date_format(strtotime($sitem->end_time),'g:i A');
                                    $new_schedule[$k]['detail'][$l]['schedule_detail'] = $sitem->schedule_detail;
                                    ++$l;
                                }else{
                                    ++$k;
                                    $l=0;
                                    $start_date = $sitem->start_date;
                                    $end_date = $sitem->end_date;
                                    $new_schedule[$k]['id'] = $sitem->id;
                                    $new_schedule[$k]['start_date'] = $sitem->start_date;
                                    $new_schedule[$k]['end_date'] = $sitem->end_date;
                                    $new_schedule[$k]['detail'][$l]['start_time'] = date('g:i A',strtotime($sitem->start_time));
                                    $new_schedule[$k]['detail'][$l]['end_time'] = date('g:i A',strtotime($sitem->end_time));
                                    $new_schedule[$k]['detail'][$l]['schedule_detail'] = $sitem->schedule_detail;
                                    ++$l;
                                }
                            }

                        }
                        $new_data[$key]['schedule'] = $new_schedule;
                    }else{
                        $new_data[$key]['schedule'] = array();
                    }
                    
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    /*-----------------------------------------------------------------
    * POST  Search  data 
    * Create :: 04-November-2558 By :: Bow
    * Update :: 17-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function searchData_post(){
        $keyword = $this->post('keyword');
        $lang = $this->post('lang');
        $category_id = $this->post('category_id');
        $subcategory_id = $this->post('subcategory_id');
        $amphur_id = $this->post('amphur_id');
        $page = $this->post('page');
        $this->load->model('api_model');
            $data = $this->api_model->searchItem($keyword,$lang,$category_id,$subcategory_id,$amphur_id,$page);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                    $new_data[$key]['image'] = $thumb_image;
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  get news list 
    * Create :: 17-November-2558 By :: Bow
    * Update :: 17-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function newsList_post(){
        $this->load->model('api_model');
        $lang = $this->post('lang');
        
        $page = $this->post('page');
            $data = $this->api_model->getNewsList($lang,$page);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['description'] = $value->description;
                    $gallery = $this->api_model->getGalleryNewsByID($value->id,1);
                    
                    if ($gallery != NULL) {
                        foreach ($gallery as $gkey => $gitem) {
                            $new_data[$key]['image'] = $this->PATH_NEW_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                        }
                        
                    }else{
                        $new_data[$key]['image'] = array();
                    }
                    
                    
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
    }

    /*-----------------------------------------------------------------
    * POST  Get near by item 
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    /*public function nearbyMe_post(){
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');
        $lang = $this->post('lang');
        $size = $this->post('size');
        $this->load->model('api_model');
        $size_arr=array('hdpi','xhdpi','xxhdpi');
        if (in_array($size, $size_arr)) {
            $data = $this->api_model->getNearBy($latitude,$longitude,$lang);
            
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                    $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    // $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map:array();
                    // $pin_image = ($value->pin_map !=null)?$this->PATH_CATE_IMAGE.$value->category_id.'/pin-cate'.$value->category_id.'_'.$size.'.png':$this->PATH_PIN_DEFAULT;
                    $new_data[$key]['pin_image'] = $pin_image;
                    $new_data[$key]['image'] = $thumb_image;
                    $new_data[$key]['distance'] = $value->distance;
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }

        
    }*/
    /*-----------------------------------------------------------------
    * POST  Get near by Cate id
    * Create :: 04-November-2558 By :: Bow
    * Update :: 04-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    /*public function nearbyMeByCateID_post(){
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');
        $lang = $this->post('lang');
        $size = $this->post('size');
        $this->load->model('api_model');
        $size_arr=array('hdpi','xhdpi','xxhdpi');
        if (in_array($size, $size_arr)) {
            $data = $this->api_model->getNearBy($latitude,$longitude,$lang);
            
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                    $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    // $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map:array();
                    // $pin_image = ($value->pin_map !=null)?$this->PATH_CATE_IMAGE.$value->category_id.'/pin-cate'.$value->category_id.'_'.$size.'.png':$this->PATH_PIN_DEFAULT;
                    $new_data[$key]['pin_image'] = $pin_image;
                    $new_data[$key]['image'] = $thumb_image;
                    $new_data[$key]['distance'] = $value->distance;
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }

        
    }*/

    /*-----------------------------------------------------------------
    * POST  getFave  data  item only
    * Create :: 04-November-2558 By :: Bow
    * Update :: 26-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function faveriteList_post(){
        
        $jsondata = $this->post('data');
        $lang = $this->post('lang');
        $pdata =  json_decode($jsondata);
        
        $this->load->model('api_model');
        
        if ($jsondata !='') {
            $event_id = "";$item_id = "";
            $new_data = array();
            // $new_data[0]['events'] = array();
            foreach ($pdata->data as $index => $rawItem) {
                $item_data = $this->api_model->getFavItemByID($rawItem->id);
                    if ($item_data != null) {
                        foreach ($item_data as $key => $value) {
                                $row = array();
                                $row['id'] = $value->id;
                                $row['title'] = $value->title;
                                $thumb_image = ($value->image_thumb!=NULL)?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
                                $row['image'] = $thumb_image;
                                $row['status'] = ($value->status==1) ? 1 : 0;
                                $new_data[] = $row;
                            
                        }unset($data,$key,$value);
                    }
            } // end foreach
            
            $result['status'] = 1;
            $result['data'] = $new_data;

            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }

        
    }
    /*-----------------------------------------------------------------
    * POST  getFave  data
    * Create :: 17-November-2558 By :: Bow
    * Update :: 17-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function itemDetailByID_post(){
        $id = $this->post('item_id');
        $lang = $this->post('lang');
        $this->load->model('api_model');
        if ($id != '') {
            $data = $this->api_model->getItemDetailByID($id);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['description'] = $value->description;
                    $new_data[$key]['address'] = $value->address;
                    $new_data[$key]['telephone'] = $value->telephone;
                    $new_data[$key]['website'] = $value->website;
                    $new_data[$key]['working_time'] = $value->working_time;
                    $new_data[$key]['category_id'] = $this->getCategoryMainNameByID($value->category_id,$value->lang);
                    $new_data[$key]['subcategory_id'] = $this->getSubCategoryNameByID($value->subcategory_id,$value->lang);
                    $new_data[$key]['user_create'] = $this->getUserNmaeByUserID($value->user_create);
                    $new_data[$key]['user_avatar'] = $value->user_create;
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    // $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    // $pin_image = ($value->pin_map !=null)?$this->PATH_CATE_IMAGE.$value->category_id.'/pin-cate'.$value->category_id.'_'.$size.'.png':$this->PATH_PIN_DEFAULT;
                    $new_data[$key]['thumb_image'] = $this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb;
                    $gallery = $this->api_model->getGalleryItemByID($value->id);
                        if ($gallery != NULL) {
                            foreach ($gallery as $gkey => $gitem) {
                                $new_gallery[$gkey]['id'] = $gitem->id;
                                $new_gallery[$gkey]['image_name'] = $this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                                
                            }unset($gallery,$gkey,$gitem);
                            $new_data[$key]['gallery'] = $new_gallery;
                        }else{
                            $new_data[$key]['gallery'] = array();
                        }
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    private function getCategoryMainNameByID($cate_id,$lang){
        $this->load->model('api_model');
        return $this->api_model->getCategoryMainNameByID($cate_id,$lang);
    }
    private function getSubCategoryNameByID($sub_id,$lang){
        $this->load->model('api_model');
        return $this->api_model->getSubCategoryNameByID($sub_id,$lang);
    }
    public function newsDetailByID_post(){
        $id = $this->post('news_id');
        $this->load->model('api_model');
        $data = $this->api_model->getNewsDetailByID($id);
        if ($data != NULL) {
            foreach ($data as $key => $value) {
                $new_data['id'] = $value->id;
                $new_data['title'] = $value->title;
                $new_data['description'] = $value->description;
                $new_data['data_date'] = $value->data_date;
                $new_data['lang'] = $value->lang;
                $new_data['create_date'] = $value->create_date;
                $new_data['modify_date'] = $value->id;
                $new_data['user_create'] = $value->user_create;
                
                $gallery = $this->api_model->getGalleryNewsByID($value->id);
                    if ($gallery != NULL) {
                        foreach ($gallery as $gkey => $gitem) {
                            $new_gallery[$gkey]['id'] = $gitem->id;
                            $new_gallery[$gkey]['image_name'] = $this->PATH_NEW_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                        }
                        $new_data['gallery'] = $new_gallery;
                    }else{
                        $new_data['gallery'] = array();
                    }
            }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
        }else{
            $result['status'] = 0;
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function dropdownDistrictList_post(){
        $lang = $this->post('lang');
        $amphur_id = $this->post('amphur_id');
        $this->load->model('api_model');
        $data = $this->api_model->getDistrictList($lang,$amphur_id);
        $result['status'] = 1;
        $result['data'] = $data;
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function dropdownAmphurList_post(){
        $lang = $this->post('lang');
        $this->load->model('api_model');
        $data = $this->api_model->getAmphurList($lang);
        $result['status'] = 1;
        $result['data'] = $data;
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function dropdownMainCateList_post(){
        $lang = $this->post('lang');
        $this->load->model('api_model');
        $data = $this->api_model->getMainCateList($lang);
        $result['status'] = 1;
        $result['data'] = $data;
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function dropdownSubCateList_post(){
        $lang = $this->post('lang');
        $main_id = $this->post('main_id');
        $this->load->model('api_model');
        $data = $this->api_model->getSubCateList($lang,$main_id);
        if ($data != null) {
            $result['status'] = 1;
            $result['data'] = $data;    
        }else{
            $result['status'] = 0;
        }
        
        $this->response($result, REST_Controller::HTTP_OK);
    }
    private function getUserNmaeByUserID($user_id){
        $this->load->model('api_model');
        return $this->api_model->getUserNmaeByUserID($user_id);
    }
    /*-----------------------------------------------------------------
    * POST  get count all add item by user
    * Create :: 26-November-2558 By :: Bow
    * Update :: 26-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function getCountItemByUserID_post(){
        $id = $this->post('user_id');
        if ($id != '' && $id != 0) {
            $this->load->model('api_model');
            $num = $this->api_model->getCountItemCreateByUserID($id);
            $result['status'] = 1;
            $result['data'] = $num;    
        }else{
            $result['status'] = 0;
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  update profile
    * Create :: 26-November-2558 By :: Bow
    * Update :: 26-November-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function updateProfile_post(){
        $user_id = $this->post('user_id');
        $shopname = $this->post('shopname');
        $realname = $this->post('realname');
        $email = $this->post('email');
        $username = $this->post('username');
        $pass = $this->post('password');
        $memtype = $this->post('memtype');
        $info = strtolower($this->post('filetype'));
        $file_final = '';
        if ($this->post('avatar_binary') !='') {
            $file_final = base64_decode($this->post('avatar_binary'));    
        }
        $this->load->model('api_model');
        $rawData = array(
                    'shopname' => $shopname,
                    'realname' => $realname,
                    'email' => $email,
                    'username' => $username,
                    'password' => hash('sha256',$pass.SALT_2FELLOWS),
                    'group_id' => $memtype, 
            );
        if ($this->api_model->checkEmailMemberEdit($email,$user_id)) {
            $this->updateUserData($rawData,$user_id,$file_final);

        }else{
            if (!$this->api_model->checkEmailMember($email)) {
                $this->updateUserData($rawData,$user_id,$file_final);
            }else{
                $result['status'] = 0;
                $result['message'] = 'email invalid';    
            }
            
        }
        
        
        $this->response($result, REST_Controller::HTTP_OK);
        
    }
    
    private function updateUserData($rawData,$user_id,$file_final){
        if ($this->api_model->updateMember($rawData,$user_id)) {
                if ($file_final != '') {
                   $dest_dir =  $this->PATH_UPLOAD_AVARTAR;
                    $dest_dir_check = $dest_dir.'/'.($user_id%10).'/';
                    $im = imagecreatefromstring($file_final);
                    if (!is_dir($dest_dir_check)) {
                        if (!mkdir($dest_dir_check, 0777)) {
                            echo "Error : mkdir 2 ";exit;
                        }    
                    }
                    $dest_dir_check = $dest_dir.'/'.($user_id%10).'/'.$user_id.'/';
                    if (!is_dir($dest_dir_check)) {
                        if (!mkdir($dest_dir_check, 0777)) {
                            echo "Error : mkdir 3";exit;
                        }    
                    }
                    $filepath =  $dest_dir_check.'/avatar_'.$user_id.'.'.$info;
                    $fileName = 'avatar_'.$user_id.'.'.$info;
                    imagealphablending($im, false); 
                    imagesavealpha($im, true);
                    if($info == 'png'){
                        $resp = imagepng($im, $filepath);
                    }
                    else if($info == 'jpg' || $info == 'jpeg'){
                        $resp = imagejpeg($im, $filepath);
                    }
                    else if($info == 'gif'){
                        $resp = imagegif($im, $filepath);
                    }    
                    imagedestroy($im);
                    
                    if ($resp != null) {
                        if ($this->api_model->updateAvatarByID($fileName,$user_id)) {
                            $result['status'] = 1;
                            $data = $this->api_model->getUserData($user_id);
                            foreach ($data as $key => $value) {
                                $all_data['user_id'] = $value->user_id;
                                $all_data['username'] = $value->username;
                                $all_data['avatar'] = ($value->avatar!='')?$this->PATH_AVARTAR.($value->user_id%10).'/'.$value->user_id.'/'.$value->avatar:'';
                                $all_data['memtype'] = $value->memtype;
                                $all_data['shopname'] = $value->shopname;
                                $all_data['realname'] = $value->realname;
                                $all_data['email'] = $value->email;
                            }
                            $result['data'] = $all_data;
                        }else{
                            $result['status'] = 1;   
                            $data = $this->api_model->getUserData($user_id);
                            foreach ($data as $key => $value) {
                                $all_data['user_id'] = $value->user_id;
                                $all_data['username'] = $value->username;
                                $all_data['avatar'] = ($value->avatar!='')?$this->PATH_AVARTAR.($value->user_id%10).'/'.$value->user_id.'/'.$value->avatar:'';
                                $all_data['memtype'] = $value->memtype;
                                $all_data['shopname'] = $value->shopname;
                                $all_data['realname'] = $value->realname;
                                $all_data['email'] = $value->email;
                            }
                            $result['data'] = $all_data; 
                            $result['message'] = 'no update filename';
                        }
                    }else{
                        $result['status'] = 1;
                        $data = $this->api_model->getUserData($user_id);
                            foreach ($data as $key => $value) {
                                $all_data['user_id'] = $value->user_id;
                                $all_data['username'] = $value->username;
                                $all_data['avatar'] = ($value->avatar!='')?$this->PATH_AVARTAR.($value->user_id%10).'/'.$value->user_id.'/'.$value->avatar:'';
                                $all_data['memtype'] = $value->memtype;
                                $all_data['shopname'] = $value->shopname;
                                $all_data['realname'] = $value->realname;
                                $all_data['email'] = $value->email;
                            }
                            $result['data'] = $all_data;
                        $result['message'] = 'can not upload file';
                    } 
                }else{
                    $result['status'] = 1;
                    $data = $this->api_model->getUserData($user_id);
                            foreach ($data as $key => $value) {
                                $all_data['user_id'] = $value->user_id;
                                $all_data['username'] = $value->username;
                                $all_data['avatar'] = ($value->avatar!='')?$this->PATH_AVARTAR.($value->user_id%10).'/'.$value->user_id.'/'.$value->avatar:'';
                                $all_data['memtype'] = $value->memtype;
                                $all_data['shopname'] = $value->shopname;
                                $all_data['realname'] = $value->realname;
                                $all_data['email'] = $value->email;
                            }
                            $result['data'] = $all_data;
                }
                
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  add place log by user id
    * Create :: 08-December-2558 By :: Bow
    * Update :: 08-December-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function placeLogByUserID_post(){
        $user_id = $this->post('user_id');
        $this->load->model('api_model');
        $rawdata = $this->api_model->getPlaceByUserID($user_id);
        foreach ($rawdata as $key => $value) {
            $data[$key]['item_id'] = $value->id;
            $data[$key]['title'] = $value->title;
            // $data[$key]['image'] = $value->image_thumb;
            $data[$key]['thumb_image'] = ($value->image_thumb!='')?$this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb:array();
            $data[$key]['create_date'] = $value->create_date;
            $data[$key]['modify_date'] = $value->modify_date;

            // item_status
            // 101 = ok
            // 102 = processing
            // 103 = denied
            // 104 = delete processing
            // 105 = delete complete

            $vstatus = $this->api_model->getItemStatusMobileTable($user_id,$value->id);
            // $showStatus = ($value->id%5);
            // $vstatus = $value->status;
            
            $showStatus = ($vstatus == null || $value->status == 5)?$value->status:$vstatus;
            
            switch ($showStatus) {
                case '2':
                    $data[$key]['item_status'] = 102;
                    break;
                case '1':
                    $data[$key]['item_status'] = 101;
                    break;
                case '3':
                    $data[$key]['item_status'] = 103;
                    break;
                case '4':
                    $data[$key]['item_status'] = 104;
                    break;
                default:
                    $data[$key]['item_status'] = 105;
                    break;
            }
            // if ($value->status == 0) {
            //     $data[$key]['item_status'] = 102;
            // }else if ($value->status == 1) {
            //     $data[$key]['item_status'] = 101;
            // }else if($value->status == 2){
            //     $data[$key]['item_status'] = 103;
            // }else if($value->status == 3){
            //     $data[$key]['item_status'] = 104;
            // }else{
            //     $data[$key]['item_status'] = 105;
            // }
            
            
        }
        $result['status'] = 1;
        $result['data'] = $data;
        $this->response($result, REST_Controller::HTTP_OK);
    }
    public function sendReportItem_post(){
        $this->load->model('api_model');
        $user_id = $this->post('user_id');
        $item_id = $this->post('item_id');
        if ($this->api_model->reportItem($user_id,$item_id)) {
            $result['status'] = 1;
        }else{
            $result['status'] = 0;
        }
        $this->response($result, REST_Controller::HTTP_OK);
    }
    /*-----------------------------------------------------------------
    * POST  get Item detail  data for edit
    * Create :: 12-December-2558 By :: Bow
    * Update :: 12-December-2558 By :: Bow
    *-----------------------------------------------------------------*/
    public function itemDetailForEditByID_post(){
        $id = $this->post('item_id');
        $lang = $this->post('lang');
        $this->load->model('api_model');
        if ($id != '') {
            $data = $this->api_model->getItemDetailForEditByID($id);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $new_data[$key]['id'] = $value->id;
                    $new_data[$key]['title'] = $value->title;
                    $new_data[$key]['description'] = $value->description;
                    $new_data[$key]['address'] = $value->address;
                    $new_data[$key]['telephone'] = $value->telephone;
                    $new_data[$key]['website'] = $value->website;
                    $new_data[$key]['lang'] = $value->lang;
                    $new_data[$key]['amphur_id'] = $value->amphur_id;
                    $new_data[$key]['district_id'] = $value->district_id;
                    $new_data[$key]['working_time'] = $value->working_time;
                    $new_data[$key]['category_id'] = $value->category_id;
                    $new_data[$key]['subcategory_id'] = $value->subcategory_id;
                    $new_data[$key]['user_create'] = $value->user_create;
                    $new_data[$key]['user_avatar'] = $this->getAvatarByUserID($value->user_create);
                    $new_data[$key]['latitude'] = $value->latitude;
                    $new_data[$key]['longitude'] = $value->longitude;
                    $pin_map = $this->api_model->getPinMapByCateID($value->category_id);
                    // $pin_image = ($pin_map!=NULL)?$this->PATH_CATE_IMAGE.$value->category_id.'/'.$pin_map.'_'.$size.'.png':array();
                    // $pin_image = ($value->pin_map !=null)?$this->PATH_CATE_IMAGE.$value->category_id.'/pin-cate'.$value->category_id.'_'.$size.'.png':$this->PATH_PIN_DEFAULT;
                    $new_data[$key]['thumb_image'] = $this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/'.$value->image_thumb;
                    $gallery = $this->api_model->getGalleryItemByID($value->id);
                        if ($gallery != NULL) {
                            foreach ($gallery as $gkey => $gitem) {
                                $new_gallery[$gkey]['id'] = $gitem->id;
                                $new_gallery[$gkey]['image_name'] = $this->PATH_ITEM_IMAGE.($value->id%10).'/'.$value->id.'/gallerys/'.$gitem->image_name;
                                
                            }unset($gallery,$gkey,$gitem);
                            $new_data[$key]['gallery'] = $new_gallery;
                        }else{
                            $new_data[$key]['gallery'] = array();
                        }
                }unset($data,$key,$value);
                $result['status'] = 1;
                $result['data'] = $new_data;
            }else{
                $result['status'] = 0;
            }
            $this->response($result, REST_Controller::HTTP_OK);
        }else{
            $result['status'] = 0;
            $this->response($result, REST_Controller::HTTP_OK);
        }
    }
    private function getAvatarByUserID($user_id){

        // return $user_id;exit;
        $this->load->model('api_model');
        $data = $this->api_model->getAvatarByUserID($user_id);
        // echo $data;exit;
        $avatar = ($data !='' && $data != null)?$this->PATH_AVARTAR.($user_id%10).'/'.$user_id.'/'.$data:'';
        return $avatar;
        // return ($data !='')?$this->PATH_AVARTAR.($user_id%10).'/'.$user_id.'/'.$data;
    }


}
