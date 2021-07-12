<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('common_model');	
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session'); 
		$this->load->helper('url');
		$this->load->helper('common_helper');
		$this->load->helper('parts_status_helper');
		$this->load->helper("date_helper");
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
		$this->load->library('Menus_lib');
	}

	function index()
	{
		$data = $this->login_model->fetch_all();
		echo json_encode($data->result_array());
	}
	
	public function login(){ 
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
		if($this->input->post('userloginSubmit')){ 
			$this->form_validation->set_rules('username', 'Username', 'required'); 
			$this->form_validation->set_rules('password', 'password', 'required'); 

			if($this->form_validation->run() == true){ 
				$data['username'] = $this->input->post('username');
			    $data['password'] = md5($this->input->post('password'));
				//$data['password'] = $this->input->post('password');

				$checkLogin = $this->login_model->authenticate($data);
                //$checkStaff = $this->login_model->chkstf($data);
                //if($checkStaff){die('nn');}else{die('mm');}
                //print_r($checkLogin);die();
				if($checkLogin && $checkLogin['role'] == 18 && $checkLogin['display'] == 't'){
					$this->session->set_userdata('isUserLoggedIn', TRUE); 
					$this->session->set_userdata('userId', $checkLogin['id']); 
					$parta_status = get_parts_status_onid($checkLogin['id'], 'A');
					if($parta_status){
						redirect('/filing/dashboard_main'); 
					}else{
						redirect('/filing/filing'); 
					}
				}else{ 
					$data['error_msg'] = 'Wrong email or password, please try again.'; 
				} 
			}else{ 
				$data['error_msg'] = 'Please fill all the mandatory fields.'; 
			} 
		} 

        // Load view 
		$this->load->view('front/user/login.php', $data); 			
	} 

	/*public function register()
	{					
		$data['state'] = $this->common_model->getStateName();
		$this->load->view('front/user/register',$data);			
	}*/

	public function register()
	{					
		if($this->isUserLoggedIn){ 
			redirect('user/dashboard'); 
		}else{ 
			$this->load->view('front/user/register_new');
		} 			
	}

	public function getdistrict()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));	
		$output = '';	 
		if(!empty($query))
		{		 	
			foreach($query as $value)
			{
				$output .= '<option value="'.$value->district_code.'"'.set_select("p_dist_id", $value->district_code).'>'.$value->name.'</option>';
			}
			 
		}else{
			//echo "rrrrrrrrrrrrrrrrrrrr";
			foreach($query as $value)
			{
				$output .= '<option value="'.$value->district_code.'"'.set_select("p_dist_id", $value->district_code).'>'.$value->name.'</option>';
			}
		}	
		echo $output;	
	}


	public function getComplain()
	{
		$query = $this->common_model->getComplainByID($this->input->post('stateid'));		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				echo '<option value="'.$value->ps_id.'">'.$value->ps_desc.'</option>';


			}		 
		}		
	}


	public function getModifyWitness()
	{

		 	//echo $this->input->post('mod_party');
		 	//echo "in here";
		 	//echo $mod_party;die;
		$query = $this->common_model->getAddWitnessBycat($this->input->post('mod_party'));
		 //echo "<pre>";
		// print_r($query);die;
		//return json_encode($query);	 

		echo json_encode($query);	 

	}

/*changes forserver side
	public function getdistrict1()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				echo '<option value="'.$value->district_code.'">'.$value->name.'</option>';
			}		 
		}		
	}
*/

	public function getdistrict1()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));
			$output = '';		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				$output .= '<option value="'.$value->district_code.'"'.set_select("ps_pl_dist_id", $value->district_code).'>'.$value->name.'</option>';
			}		 
		}else{
			//echo "rrrrrrrrrrrrrrrrrrrr";
			foreach($query as $value)
			{
				$output .= '<option value="'.$value->district_code.'"'.set_select("ps_pl_dist_id", $value->district_code).'>'.$value->name.'</option>';
			}
		}	
		echo $output;	
	}




	public function getdistrict2()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				echo '<option value="'.$value->b_district_code.'">'.$value->name.'</option>';
			}		 
		}		
	}




	public function getdistrict3()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				echo '<option value="'.$value->district_code.'">'.$value->name.'</option>';
			}		 
		}		
	}

	public function getdistrict4()
	{
		$query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));		 
		if(!empty($query))
		{
			foreach($query as $value)
			{
				echo '<option value="'.$value->b_co_district_code.'">'.$value->name.'</option>';
			}		 
		}		
	}


	public function getModifyParty()
	{

		 	//echo $this->input->post('mod_party');
		 	//echo "in here";
		 	//echo $mod_party;die;
		$query = $this->common_model->getAddpartyBycat($this->input->post('mod_party'));
		 //echo "<pre>";
		// print_r($query);die;
		//return json_encode($query);	 

		echo json_encode($query);	 

	}

	public function getModifyParty_C()
	{

		 	//echo $this->input->post('mod_party');
		 	//echo "in here";
		 	//echo $mod_party;die;
		$query = $this->common_model->getAddpartyBycat_C($this->input->post('mod_party'));
		 //echo "<pre>";
		// print_r($query);die;
		//return json_encode($query);	 

		echo json_encode($query);	 

	}

	public function getModifyOfficeBear()
	{

		 	//echo $this->input->post('mod_party');
		 	//echo "in here";
		 	//echo $mod_party;die;
		$query = $this->common_model->getAddOfficeBycat($this->input->post('mod_party'));
		 //echo "<pre>";
		// print_r($query);die;
		//return json_encode($query);	 
		$query[0]->ob_identity_proof_doi = get_displaydate($query[0]->ob_identity_proof_doi);
		$query[0]->ob_identity_proof_vupto = get_displaydate($query[0]->ob_identity_proof_vupto);
		$query[0]->ob_idres_proof_doi = get_displaydate($query[0]->ob_idres_proof_doi);
		$query[0]->ob_idres_proof_vupto = get_displaydate($query[0]->ob_idres_proof_vupto);
		echo json_encode($query);	 

	}





	public function save(){
		$data['state'] = $this->common_model->getStateName();		
		$username= ($this->input->post('UserName'));
		$fname= ($this->input->post('firstName'));
		$lname= ($this->input->post('lastName'));
		$email= ($this->input->post('email'));
		$password= ($this->input->post('password'));
		$mobile= ($this->input->post('mobileNo'));
		$state= ($this->input->post('state_code'));
		$city= ($this->input->post('district_code'));
		$address= ($this->input->post('address'));
		$phone= ($this->input->post('phone_no'));		 
		$users = array(
			'username' => $username,
			'fname' => $fname,
			'lname' => $lname,
			'email' => $email,
			'password' => $password,
			'mobile' => $mobile,
			'address' => $address,
			'phone'=> $phone,
			'state'=>$state,
			'city'=>$city,	   
			'is_staff'=>FALSE,	   
			'role'=>18	   
		);		 
		$res_user = $this->login_model->register($users);
		if($res_user== true)
		{
			$this->session->set_flashdata('msg', 'User Successfully registered!');				
		  // $this->load->view('user/register','refresh');
			redirect('user/register', 'refresh');
		}
		

	}
	public function destroy()
	{
 			// print_r($this->session->userdata());
    	//echo "yogendra here";
         // echo "complain id: ". $this->session->userdata('a_complainant_id');die;

		$this->session->sess_destroy();
		$this->load->view('front/user/login.php');


	}
	/* ---------------------------OTP------------------------------------- */

	
	public function email_validation()
	{
		$this->form_validation->set_rules('email', 'Mobile no', 'required|trim|numeric');
		if($this->form_validation->run()){
			$this->send_otp();
		}else{
			$return_arr[] = array("val" => 'false',
				"error" => form_error('email'));

			echo json_encode($return_arr);
		}
	}

	private function send_otp()
	{
		$email = $this->input->post('email');
		
		$data = $this->login_model->checkUserExist($email);
		if($data == 1){
			$otp = rand(11111,99999);
			$_SESSION['email'] = $email;
			$result = $this->login_model->updateOtp2($email, $otp);
			if($result){
				$subject = "OTP for login";
				$html = "
				Hi <p>Visitor</p>
				<p>Your system generated otp for one time password login is".$otp."
				</p>
				<p>Thanks,</p>
				";
				//$sended = $this->send_mail($email,$subject,$html);
				$sended = 1;

				if($sended){
					$return_arr[] = array("val" => 'true');

					echo json_encode($return_arr);
				}else{
					echo show_error($this->email->print_debugger());
				}
			}else{
				die("unable to update otp to users");
			}
		}
		if ($data == 0) {
			$otp = rand(11111,99999);
			$_SESSION['email'] = $email;
			$result = $this->login_model->insert_email($email, $otp);
			if($result){
				$subject = "OTP for login";
				$html = "
				Hi <p>Visitor</p>
				<p>Your system generated otp for one time password login is".$otp."
				</p>
				<p>Thanks,</p>
				";
				//$sended = $this->send_mail($email,$subject,$html);
				$sended = 1;

				if($sended){
					$return_arr[] = array("val" => 'true');

					echo json_encode($return_arr);
				}else{
					echo show_error($this->email->print_debugger());
				}
			}else{
				die("unable to insert record to users");
			}
		}
	}

	public function otp_validation()
	{
		$this->form_validation->set_rules('otp', 'OTP', 'required|trim');
		if($this->form_validation->run()){
			$this->check_otp();
		}else{
			$return_arr[] = array("val" => 'false',
				"error" => form_error('otp'));

			echo json_encode($return_arr);
		}
	}

	public function check_otp()
	{
		$otp = $this->input->post('otp');
		$email = $_SESSION['email'];
		
		$data = $this->login_model->varifyOtp($email, $otp);
		if($data == 1){
			//$_SESSION['is_login'] = $email;
			$pub_data = $this->login_model->get_public_data($email);
			//print_r($pub_data['id']);die();

			$this->session->set_userdata('isUserLoggedIn', TRUE); 
			$this->session->set_userdata('userId', $pub_data['id']); 
			//redirect('admin/dashboard/'); 

        	$otp = '';  //successfully varified so empty otp
        	$result = $this->login_model->updateOtp($email, $otp);
        	if($result){
        		$return_arr[] = array("val" => 'true',
        			"msg" => 'success'
        		);

        		echo json_encode($return_arr);
        	}else{
        		die("unable to empty otp in users");
        	}
        }
        if ($data == 0) {
        	$return_arr[] = array("val" => 'true',
        		"msg" => 'fail'
        	);

        	echo json_encode($return_arr);
        }
    }

    public function update_user_pass()
    {					
    	if($this->isUserLoggedIn){ 
    		$con = array( 
    			'id' => $this->session->userdata('userId') 
    		); 
    		$data['user'] = $this->login_model->getRows($con);

            //print_r($data['user']['id']);die;

    		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
    		$this->load->view('templates/front/fheader.php',$data);
    		$this->load->view('front/user/upd_pass'); 
    		$this->load->view('templates/front/ffooter.php',$data); 
    	}else{ 
    		redirect('user/register');
    	} 			
    }

    public function submit_user_pass()
    {
    	$data = $userData = array(); 
		//print_r($_POST);die('k');

    	if($this->isUserLoggedIn) 
    	{

        // If registration request is submitted 
    		if($this->input->post('upd-pass-form')){ 
				//die('k');
    			$this->form_validation->set_rules('username', 'Username', 'required');
    			$this->form_validation->set_rules('password', 'password', 'required'); 
    			$this->form_validation->set_rules('password2', 'confirm password', 'required|matches[password]'); 

    			$ts = date('Y-m-d H:i:s', time());
    			$ip = $this->get_ip();
    			$userData = array( 
    				'username' => strip_tags($this->input->post('username')),
    				'password' => md5($this->input->post('password')),
    				'updated_at' => $ts,
    				'last_login_remark' => 'User Updated Password',
    			); 

    			if($this->form_validation->run() == true){ 
    				$id = $this->session->userdata('userId');
    				$update = $this->login_model->upd_pass($userData, $id); 
    				if($update){ 
    					$this->session->set_flashdata('success_msg', 'Username and password successfully submitted.'); 
    					redirect('user/update_user_pass'); 
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

    		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
    		$this->load->view('templates/front/fheader.php',$data);
    		$this->load->view('front/user/upd_pass'); 
    		$this->load->view('templates/front/ffooter.php',$data);
    	}else{
    		redirect('user/register'); 
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

    public function logout(){ 
		$this->session->unset_userdata('isUserLoggedIn'); 
		$this->session->unset_userdata('userId'); 
		$this->session->sess_destroy(); 
		redirect('user/login/'); 
	}

	//-----------------------------------------------------------------//

	public function otp_see()
	{
		$email = $this->input->post('email');
		
		if($email){
			$result = $this->login_model->see_otp($email);
			if($result){
					echo json_encode($result);
			}else{
				die("No otp found!");
			}
		}
	}

	//----------------------------------------------------------//

}