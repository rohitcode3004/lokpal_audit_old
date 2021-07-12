<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		
	}
	
	public function index()
	{
		if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
		
		    $this->load->view('front/home/index.php', $data);
		}else
		$this->load->view('front/home/index.php');
	}


	public function page(){
		$pagename = trim($this->uri->segment(3));
		if(empty($pagename)) $this->load->view('front/home/error.php');
		
		$query 	= $this->db->select('*')->from('cms_pages')->where('slug', $pagename)->where('status','2')->get();
		$pgcontent	= $query->result_array();
		
		if(empty($pgcontent)) $this->load->view('front/home/error.php');
		
		$this->data['meta_title'] = $pgcontent[0]['meta_title'];
		$this->data['meta_description'] = $pgcontent[0]['meta_desc'];
		$this->data['meta_keywords'] = $pgcontent[0]['meta_key'];
		$this->data['pgcontent'] = $pgcontent[0];
		$this->load->view('front/home/page.php',$this->data);
	}	
	
	public function contact(){ 
		
		//print_r($this->input->post()); 
		if(!empty($this->input->post())){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone No.', 'required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run()) {
				$data = array(
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'phone' => $this->input->post('phone'),
							'subject' => $this->input->post('subject'),
							'message' => $this->input->post('message')
					);
				//Transfering data to Model
				if($this->db->insert('contacts', $data)){
					echo json_encode(array('success',' Your contact request has been posted successfully. Please wait for admin to review.'));
				}else {	
					echo json_encode(array('error',' Some error occured, please try again.'));
				}
			}else{
				echo json_encode(array('error',' Data validation failed, please try again.'));
			}
						
				exit;
		}	
		$this->load->view('front/home/contact.php');
	}	
}