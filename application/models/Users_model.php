<?php 

class Users_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getUserGroup($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM user_group WHERE user_id = ?";
			$query = $this->db->query($sql, array($userId));
			$result = $query->row_array();

			$group_id = $result['group_id'];
			$g_sql = "SELECT * FROM `groups` WHERE id = ?";
			$g_query = $this->db->query($g_sql, array($group_id));
			$q_result = $g_query->row_array();
			return $q_result;
		}
	}

	public function check_username($username)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->where('username', $username);
	    $query = $this->db->get();
	    $result = $query->result_array();
	    return $result;
	}

	public function check_email($email)
	{
	    $this->db->select('*'); 
	    $this->db->from('users');
	    $this->db->where('email', $email);
	    $query = $this->db->get();
	    $result = $query->result_array();
	    return $result;
	}






	public function create($data = '', $group_id = null)
	{

		if($data && $group_id) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();

			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $group_id
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($create == true && $group_data) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $group_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if($group_id) {
			// user group
			$update_user_group = array('group_id' => $group_id);
			$this->db->where('user_id', $id);
			$user_group = $this->db->update('user_group', $update_user_group);
			return ($update == true && $user_group == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT * FROM users";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	function user_register($userData=NULL){  
		$this->db->insert('users', $userData);
	 	$this->db->insert_id();
 	 	$user_id=$this->db->insert_id();
	 	return  $user_id;
	}

	function user_parta_data_insert($partaData=NULL){  
		$this->db->insert('complainant_details_parta', $partaData);
		return $this->db->insert_id();      
	}

	function user_profile_insert($user_profile_data=NULL){  
		$this->db->insert('user_profile', $user_profile_data);
		//echo $this->db->last_query();die;
		return $this->db->insert_id();      
	}

	function get_user_profile_data($user_id)
	{
		$sql1 = "select * from user_profile UP inner join users U on UP.user_id = U.id where UP.user_id='".$user_id."'";
		//print_r($sql1);die;
		$query 	= $this->db->query($sql1)->result();
		//print_r($query);die;
		//$this->db->last_query();die;
		return $query;
	}
}
