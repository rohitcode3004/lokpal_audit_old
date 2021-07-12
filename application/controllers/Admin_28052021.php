<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		//$this->load->model('common_model');	
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session'); 
		$this->load->helper('url'); 
		$this->load->helper('common_helper'); 

		$this->load->library('Menus_lib');

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
	}
	
	public function login(){	
		if($this->isUserLoggedIn){ 
			redirect('admin/dashboard'); 
		}else{ 
			$this->load->view('admin/user/login'); 
		} 
	}
	
	public function authenticate(){				
		$data = array(); 

        // Get messages from the session 
		if($this->session->userdata('success_msg')){ 
			$data['success_msg'] = $this->session->userdata('success_msg'); 
			$this->session->unset_userdata('success_msg'); 
		} 
		if($this->session->userdata('error_msg')){ 
			$data['error_msg'] = $this->session->userdata('error_msg'); 
			$this->session->unset_userdata('error_msg'); 
		} 

        // If login request submitted 
		if($this->input->post('loginSubmit')){ 
			$this->form_validation->set_rules('username', 'Username', 'required'); 
			$this->form_validation->set_rules('password', 'password', 'required'); 

			if($this->form_validation->run() == true){ 
				$data['username'] = strip_tags($this->input->post('username'));
				$data['password'] = md5(strip_tags($this->input->post('password')));

				$checkLogin = $this->login_model->authenticate($data);
                //$checkStaff = $this->login_model->chkstf($data);
                //if($checkStaff){die('nn');}else{die('mm');}
				if($checkLogin && $checkLogin['is_staff'] == 't'){
					$log_data = array( 
					'user_id' => $checkLogin['id'], 
					'username' => strip_tags($this->input->post('username')),
					'form_type' => 'A',  
					//'lock' => strip_tags($this->input->post('mobile')), 
					//'failed' => $this->input->post('role'), 
					'ip' => get_ip(),
					'datetime' => date('Y-m-d H:i:s', time()),
				); 
					$insert_log = $this->login_model->loginlog_ins($log_data); 
					if($insert_log){
					$this->session->set_userdata('isUserLoggedIn', TRUE); 
					$this->session->set_userdata('userId', $checkLogin['id']); 
					redirect('admin/dashboard/'); 
				}else{
					die('Unable to maintain your log.Go back and try again.');
				}
				}else{ 
					$data['error_msg'] = 'Wrong email or password, please try again.'; 
				} 
			}else{ 
				$data['error_msg'] = 'Please fill all the mandatory fields.'; 
			} 
		} 

        // Load view 
		$this->load->view('admin/user/login', $data); 			
	}

	public function save(){
		$data = $userData = array(); 

		if($this->isUserLoggedIn) 
		{

        // If registration request is submitted 
			if($this->input->post('submitform')){ 
				$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]'); 
				$this->form_validation->set_rules('mobile', 'Mobile no', 'numeric');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]'); 
				$this->form_validation->set_rules('password', 'password', 'required'); 
				$this->form_validation->set_rules('passweord2', 'confirm password', 'required|matches[password]'); 
				$this->form_validation->set_rules('role', 'Role', 'integer|required');

				$ts = date('Y-m-d H:i:s', time());
				$ip = $this->get_ip();
				$userData = array( 
					'username' => strip_tags($this->input->post('username')), 
					'email' => strip_tags($this->input->post('email')), 
					'password' => md5($this->input->post('password')),  
					'mobile' => strip_tags($this->input->post('mobile')), 
					'role' => $this->input->post('role'), 
					'is_staff' => TRUE,
					'display' => TRUE,
					'create_date' => $ts,
					'ip' => $ip,
				); 

				if($this->form_validation->run() == true){ 
					$insert = $this->login_model->register($userData); 
					if($insert){ 
						$this->session->set_flashdata('success_msg', 'Account registration has been successful.'); 
						redirect('admin/add_user'); 
					}else{ 
						$data['error_msg'] = 'Some problems occured, please try again.'; 
					} 
				}else{ 
            	//echo validation_errors();
					$data['error_msg'] = 'Please fill all the mandatory fields.'; 
				} 
			} 

			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);

        // Posted data 
			$data['roles'] = $this->login_model->get_roles();
			//echo json_encode($data->result_array());
			$this->load->view('admin/user/add_user', $data);
		}else{
			redirect('admin/login'); 
		}
	}

	private function get_ip()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			return $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			return $ip=$_SERVER['REMOTE_ADDR'];
		}
	}


	public function dashboard(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');
			if($data['user']['id'] == 1255){
				$this->load->view('admin/templates/admin_header', $data);	
				$this->load->view('admin/dashboard/dashboard');	
			}elseif($data['user']['role'] == 18){
				redirect('filing/filing');
			}elseif($data['user']['role'] == 126){
				redirect('scrutiny/dashboard_main');
			}elseif($data['user']['role'] == 161 || $data['user']['role'] == 162 || $data['user']['role'] == 163 || $data['user']['role'] == 164){
				redirect('scrutiny/dashboard_main');
			}elseif($data['user']['role'] == 131){
				redirect('counter/counterfiling');
			}elseif($data['user']['role'] == 138){
				redirect('bench/dashboard_main');
			}elseif($data['user']['role'] == 143){
				redirect('counter/dashboard_registry');
			}elseif($data['user']['role'] == 147 || $data['user']['role'] == 178){
				redirect('proceeding/dashboard_main');
			}elseif($data['user']['role'] == 172){
				redirect('backlog');
			}elseif($data['user']['role'] == 173){
				redirect('backlog/legacy_pdf');
			}elseif($data['user']['role'] == 149 || $data['user']['role'] == 150 || $data['user']['role'] == 151 || $data['user']['role'] == 152 || $data['user']['role'] == 164){
				redirect('agency/dashboard_main');
			}else{
				redirect('home');
			}	
		}
		else{
			redirect('admin/login'); 
		}
	}

	public function dashboard2(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$this->load->view('templates/front/dashboard2.php',$data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	public function logout(){ 
		$this->session->unset_userdata('isUserLoggedIn'); 
		$this->session->unset_userdata('userId'); 
		$this->session->sess_destroy(); 
		redirect('admin/login/'); 
	}

	public function view_menus(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');	
			$this->load->view('admin/dashboard/menus_view', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	public function add_submenu(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$data['menus'] = $this->menu_model->fetch_menus();
			//echo json_encode($data->result_array());
			$this->load->view('admin/dashboard/add_submenu', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	public function add_perm(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$data['roles'] = $this->menu_model->fetch_roles();
			$data['menus'] = $this->menu_model->fetch_menus();
			//echo json_encode($data->result_array());
			$this->load->view('admin/dashboard/add_perm', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

			if($data_action == 'edit')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/label/update";

				$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'display' => $this->input->post('display'),
					'description' => $this->input->post('description'),
					'id' => $this->input->post('element_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'fetch_single')
			{
				$api_url = "http://localhost/lokpal_test/label/fetch_single";

				$form_data = array(
					'id' => $this->input->post('element_id')
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}

			if($data_action == 'insert_menu')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/menu/insert_menu";

				$form_data = array(
					'menu_name' => $this->input->post('menuname'),				
					'priority' => $this->input->post('priority'),
					'display' => $this->input->post('display')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'fetch_all')
			{
				$api_url = "http://localhost/lokpal_test/menu";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($client, CURLOPT_FOLLOWLOCATION, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				//print_r($result);die('k');
				$output = '';
				$count = 0;
				if (count($result) > 0) {
					foreach ($result as $row) {
						$count ++;
						/*if($row->level_master_id == '1')
							$level = 'filing';
						elseif ($row->level_master_id == '2')
						$level = 'scrutiny';*/
						$output .='
						<tr>
						<td>'.$count.'</td>
						<td>'.$row->menu_name.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->url.'</td>
						<td>'.$row->priority.'</td>
						<td>'.$row->display.'</td>
						<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">EDIT</button>
						</td>
						<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">DELETE</button>
						</td>
						</tr>
						'; 
					}
				}else{
					$output .='
					<tr>
					<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}
				echo $output;
			}

		}
	}

	public function view_users(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$this->load->view('admin/dashboard/users_view', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	function user_action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

			if($data_action == 'edit')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/label/update";

				$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'display' => $this->input->post('display'),
					'description' => $this->input->post('description'),
					'id' => $this->input->post('element_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'fetch_single')
			{
				$api_url = "http://localhost/lokpal_test/label/fetch_single";

				$form_data = array(
					'id' => $this->input->post('element_id')
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}


			if($data_action == 'fetch_all')
			{
				$api_url = "http://localhost/lokpal_test/user";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($client, CURLOPT_FOLLOWLOCATION, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				//print_r($result);die('k');
				$output = '';
				$count = 0;
				if (count($result) > 0) {
					foreach ($result as $row) {
						$count ++;
						/*if($row->level_master_id == '1')
							$level = 'filing';
						elseif ($row->level_master_id == '2')
						$level = 'scrutiny';*/
						$output .='
						<tr>
						<td>'.$count.'</td>
						<td>'.$row->username.'</td>
						<td>'.$row->email.'</td>
						<td>'.$row->is_staff.'</td>
						<td>'.$this->menus_lib->get_role_name($row->role).'</td>
						</tr>
						'; 
					}
				}else{
					$output .='
					<tr>
					<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}
				echo $output;
			}
		}
	}

	public function add_user(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$data['roles'] = $this->login_model->get_roles();
			//echo json_encode($data->result_array());
			$this->load->view('admin/user/add_user', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	public function view_roles(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$this->load->view('admin/dashboard/roles_view', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	function roles_action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

			if($data_action == 'edit')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/label/update";

				$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'display' => $this->input->post('display'),
					'description' => $this->input->post('description'),
					'id' => $this->input->post('element_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'fetch_single')
			{
				$api_url = "http://localhost/lokpal_test/label/fetch_single";

				$form_data = array(
					'id' => $this->input->post('element_id')
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}


			if($data_action == 'fetch_all')
			{
				$api_url = "http://localhost/lokpal_test/menu/view_roles";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($client, CURLOPT_FOLLOWLOCATION, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				//print_r($result);die('k');
				$output = '';
				$count = 0;
				if (count($result) > 0) {
					foreach ($result as $row) {
						$count ++;
						/*if($row->level_master_id == '1')
							$level = 'filing';
						elseif ($row->level_master_id == '2')
						$level = 'scrutiny';*/
						$output .='
						<tr>
						<td>'.$count.'</td>
						<td>'.$row->name.'</td>
						<td>'.$row->display.'</td>
						<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">EDIT</button>
						</td>
						<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">DELETE</button>
						</td>
						</tr>
						'; 
					}
				}else{
					$output .='
					<tr>
					<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == 'insert_role')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/menu/insert_role";

				$form_data = array(
					'role' => $this->input->post('role'),				
					'display' => $this->input->post('display')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'delete_role')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/menu/delete_role";

				$form_data = array(
					'id' => $this->input->post('role_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}
		}
	}

	public function view_permissions(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
            //print_r($data);die('o');

			$this->load->view('admin/dashboard/permissions_view', $data);
		}
		else{
			redirect('admin/login'); 
		}
	}

	function permission_action()
	{
		//print_r($this->input->post('menu_id'));die('here');
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

			if($data_action == 'edit')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/label/update";

				$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'display' => $this->input->post('display'),
					'description' => $this->input->post('description'),
					'id' => $this->input->post('element_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'fetch_single')
			{
				$api_url = "http://localhost/lokpal_test/label/fetch_single";

				$form_data = array(
					'id' => $this->input->post('element_id')
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}

			if($data_action == 'fetch_all')
			{
				$api_url = "http://localhost/lokpal_test/menu/view_permissions";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($client, CURLOPT_FOLLOWLOCATION, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				//print_r($result);die('k');
				$output = '';
				$count = 0;
				if (count($result) > 0) {
					foreach ($result as $row) {
						$count ++;
						$output .='
						<tr>
						<td>'.$count.'</td>
						<td>'.$this->menus_lib->get_role_name($row->role_id).'</td>
						<td>'.$this->menus_lib->get_menu_name($row->menu_id).'</td>
						<td>'.$this->menus_lib->get_submenu_name($row->submenu_id).'</td>
						<td>'.$row->display.'</td>
						<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">EDIT</button>
						</td>
						<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">DELETE</button>
						</td>
						</tr>
						'; 
					}
				}else{
					$output .='
					<tr>
					<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}
				echo $output;
			}

			if($data_action == 'insert_perm')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/menu/insert_perm";

				$form_data = array(
					'role' => $this->input->post('role'),				
					'menus' => $this->input->post('menus'),				
					'submenu' => $this->input->post('submenu'),				
					'display' => $this->input->post('display')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}

			if($data_action == 'delete_perm')
			{
				//die('great');
				$api_url = "http://localhost/lokpal_test/menu/delete_perm";

				$form_data = array(
					'id' => $this->input->post('perm_id')
				);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
			}
		}
	}
}