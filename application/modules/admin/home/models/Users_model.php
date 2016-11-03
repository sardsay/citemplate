<?php 
if(! defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH."libraries/PasswordHash.php");
class Users_model extends CI_Model 
{
	public $Query	= null;
   	public $Rows	= null;
	
    public function __construct() {
        parent::__construct();       
    }
    public function authen_user($data){
    	
    	$this->db->select('id,shopname,username,password');
    	$this->db->where('username',$data['username']);
    	$this->db->from('users');
    	$this->Query = $this->db->get();
    	$this->Rows	= $this->Query->result();
  //   	$str = $this->db->last_query(); 
		// echo $str;
		// exit;

		$this->Query->free_result();
    	$count = count($this->Rows);

		if ($count>0) {
			$phpass = new PasswordHash(10, true);
			$udata='';
			foreach ($this->Rows as $item) {
				$match = $phpass->CheckPassword($data['password'], $item->password);
				if ($match === true) {
					$udata['user_id'] = $item->id;
					$udata['role_id'] = 1;
					$udata['menu'] = '';
					$udata['username'] = $item->username;
					$udata['shopname'] = $item->shopname;
					$udata['erro_count'] = 0;
					$this->session->set_userdata($udata);
					return true;
					/*
					$this->db->select('u.group,u.userName,k2.menu_id');
					$this->db->from('ndh_k2_users as u');
					$this->db->where('u.userID',$item->id);
					$this->db->where('u.group !=',6);
					$this->db->join('ndh_k2_user_groups as k2','u.group=k2.id','left');
					$this->query = $this->db->get();
					$res = $this->query->result();
					// $str = $this->db->last_query(); 
					// echo $str;
					// exit;
					// $this->load->model('system_management/system_management_model');
					if ($res) {
						foreach ($res as $key => $value) {
							if (empty($value->menu_id)){
								$menu = array();
							}else{
								$menu = json_decode($value->menu_id);
							}

							$udata['role_id'] = $value->group;
							$udata['menu'] = $menu;
							$udata['name'] = $value->userName;
							$udata['erro_count'] = 0;
						}unset($value,$key,$res);
						$udata['user_data'] = $this->getUserDataByID($item->id);
						$this->session->set_userdata($udata);
						// print_r($this->session->userdata);
						// exit;
						return true;
					}else{
						return false;
					}*/
				}else{
					if ($this->session->userdata('err_count')!='' && $this->session->userdata('err_count')<3){
						$num = $this->session->userdata('err_count')+1;
						$this->session->set_userdata('err_count',$num);
					}else{
						$this->session->set_userdata('err_count',1);
					}
					return false;
				}
				
			}unset($item);
		}else{
			if ($this->session->userdata('err_count')!='' && $this->session->userdata('err_count')<3){
				$num = $this->session->userdata('err_count')+1;
				$this->session->set_userdata('err_count',$num);
			}else{
				$this->session->set_userdata('err_count',1);
			}
			return false;
		}
		// $str = $this->db->last_query(); 
		// echo $str;
		// exit;
		
    }
    public function getUserDataByID($id){
        $this->db->select('k2.reportor_name,k2.reportor_position,k2.reportor_work,k2.reportor_province,k2.reportor_district,k2.reportor_subdistrict,k2.reportor_email,k2.reportor_post,k2.reportor_fax,k2.reportor_phone');
        $this->db->from('ndh_k2_users as k2');
        $this->db->join('ndh_users as u','u.id=k2.userID');
        $this->db->where('userID',$id);
        $this->Query = $this->db->get();
        $this->Rows = $this->Query->result();
        return $this->Rows;
    }
    public function getAllData($count_rows=0,$st=0,$max=0){
    	
		$this->db->select('*');
		if($max!=0)
		$this->db->limit($max,$st);

		$this->Query	=	$this->db->get('mobile_servicepoint');
		if($count_rows==1){
			$this->Rows		=	$this->Query->result();	
			return count($this->Rows);
		}else{
			return $this->Rows		=	$this->Query->result();
		}
		$this->Query->free_result();

    }
	
}
/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */