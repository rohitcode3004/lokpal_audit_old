<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	Public function __construct() { 
		parent::__construct(); 
	} 

	Public function authenticate($data)
	{
		/*echo "<pre>";
		print_r($data);

		echo $data['username'];

		echo $data['password'];
		die;
*/

		$query = $this->db->get_where('users', array( 'username' => $data['username'],'password'=>($data['password'])))->row_array();

	//die('@@');
		// $query = $this->db->get_where('users', array( 'username' => $data['username']))->row_array();
		
		return $query;				
	}

	function chkstf($data)
	{
		$this->db->select('is_staff');
		//$this->db->from('users');
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		return $this->db->get('users')->row()->is_staff;				
	}
	
	//==== Function for check forgot email exist
	public function checkforgotemail()
	{		
		$userEmail 	= $this->db->query("SELECT * FROM company WHERE indv_email ='".trim($_POST['email'])."' OR comp_cp_email ='".trim($_POST['email'])."' OR username='".trim($_POST['email'])."'");	
		return $row = $userEmail->result();		
	}	
	
	function register($users=NULL){  
		$this->db->insert('users', $users);
		return $this->db->insert_id();      
	}

	function fetch_all()
	{
		$this->db->select('username, email, is_staff, role');
		$this->db->from('users');
		//$this->db->where('menus', 'menus.id = submenu.menu_id', 'right');
		return $this->db->get();
	}

	function get_roles()
	{
		$this->db->select('id, name');
		$this->db->from('roles');
		$this->db->where('display = TRUE');
		$query = $this->db->get();
		return $query->result();
	}

	function getRows($params = array()){ 
		$this->db->select('*'); 
		$this->db->from('users'); 

		if(array_key_exists("conditions", $params)){ 
			foreach($params['conditions'] as $key => $val){ 
				$this->db->where($key, $val); 
			} 
		} 

		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
			$result = $this->db->count_all_results(); 
		}else{ 
			if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
				if(!empty($params['id'])){ 
					$this->db->where('id', $params['id']); 
				} 
				$query = $this->db->get(); 
				$result = $query->row_array(); 
			}else{ 
				$this->db->order_by('id', 'desc'); 
				if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
					$this->db->limit($params['limit'],$params['start']); 
				}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
					$this->db->limit($params['limit']); 
				} 

				$query = $this->db->get(); 
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
			} 
		} 

        // Return fetched data 
		return $result; 
	}

	function checkUserExist($email){
		$this->db->where('mobile', $email);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	function checkUserExist_new($service_name, $service_id){
		if($service_name == 'email')
			$this->db->where('email', $service_id);
		elseif($service_name == 'mobile')
			$this->db->where('mobile', $service_id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	function check_otp_requests($service_name, $service_id){
		if($service_name == 'email')
			$this->db->where('service_name', 'E');
		elseif($service_name == 'mobile')
			$this->db->where('service_name', 'M');
		else
			die('invalid service');
		$this->db->where('service_id', $service_id);
		$query = $this->db->get('otp_validator');
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	function updateOtp($email, $otp){
		$data = array('otp' => $otp, 'login_status' => TRUE, 'sms_validate' => TRUE, 'updated_at' => date('Y-m-d H:i:s', time()), 'last_login' => date('Y-m-d H:i:s', time()), 'last_login_ip' => get_ip());
		$this->db->where('mobile', $email);
		return $this->db->update('users', $data);
	}

	function update_otp_validator($session_service_id, $otp, $service_name){
		if($service_name == 'email')
			$s_n = 'E';
		elseif($service_name == 'mobile')
			$s_n = 'M';
		else
			die('invalid service');
		$data = array('otp_validated' => 't');
		$this->db->where('service_name', $s_n);
		$this->db->where('service_id', $session_service_id);
		$this->db->where('otp_generated', $otp);
		return $this->db->update('otp_validator', $data);
	}

	function updateOtp2($email, $otp){
		$data = array('otp' => $otp, 'updated_at' => date('Y-m-d H:i:s', time()));
		$this->db->where('mobile', $email);
		return $this->db->update('users', $data);
	}

	function insert_email($email, $otp){
		$data = array('mobile' => $email, 'role' => 18,
			'otp' => $otp, 'ip' => get_ip(), 'create_date' => date('Y-m-d H:i:s', time()), 'display' => TRUE, 'last_login_remark' => 'User created for first time');
		return $this->db->insert('users', $data);
	}

	function insert_otp_new($service_name, $service_id, $otp){
		if($service_name == 'email')
			$s_n = 'E';
		elseif($service_name == 'mobile')
			$s_n = 'M';
		else
			die('invalid service');
		$data = array('service_name' => $s_n, 'service_id' => $service_id, 'otp_attempts' => 1,
			'otp_generated' => $otp, 'ip' => get_ip(), 'create_date' => date('Y-m-d H:i:s', time()));
		return $this->db->insert('otp_validator', $data);
	}

	function update_otp_new($service_name, $service_id, $otp){
		if($service_name == 'email')
			$s_n = 'E';
		elseif($service_name == 'mobile')
			$s_n = 'M';
		else
			die('invalid service');
		$data = array('otp_generated' => $otp, 'ip' => get_ip(), 'update_date' => date('Y-m-d H:i:s', time()));
		$this->db->where('service_id', $service_id);
		$this->db->where('service_name', $s_n);
		return $this->db->update('otp_validator', $data);
	}

	function varifyOtp($email, $otp){
		$this->db->where('mobile', $email);
		$this->db->where('otp', $otp);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	function varifyOtp_new($session_service_id, $otp, $service_name){
		if($service_name == 'email')
			$s_n = 'E';
		elseif($service_name == 'mobile')
			$s_n = 'M';
		else
			die('invalid service');
		$this->db->where('service_id', $session_service_id);
		$this->db->where('service_name', $s_n);
		$this->db->where('otp_generated', $otp);
		$query = $this->db->get('otp_validator');
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		}
	}

    function get_public_data($mobileno)
	{
		$this->db->where('mobile', $mobileno);
		return $query = $this->db->get('users')->row_array();			
	}

	function upd_pass($data, $id){
		$this->db->where('id', $id);
		 $this->db->update('users', $data);
		return ($this->db->affected_rows() != 1) ? false : true; 
	}

	function check_old_password($old_password, $id){
		$this->db->where('id', $id);
		$this->db->where('password', $old_password);
		$query = $this->db->get('users');
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			return 1;
		}else{
			return 0;
		} 
	}

	//----------------------------------------//

	function see_otp($mobile)
	{
		$this->db->select('otp');
		$this->db->from('users');
		$this->db->where('mobile', $mobile);
		$query = $this->db->get();
		return $query->result();
	}

	//---------------------------------------------//

	function loginlog_ins($data){ 	
			$this->db->insert('login_log', $data);
			return true;	    
		}
}