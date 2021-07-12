<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokpal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('common_model');	
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session'); 
        $this->load->helper('url'); 

        $this->load->model('login_model');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
	}
	
	public function about(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
		
			$this->load->view('front/home/aboutus', $data);

			}
		$this->load->view('front/home/aboutus');
		
	}
	
	public function jurisdiction(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
		
			$this->load->view('front/home/jurisdiction', $data);

		}
		$this->load->view('front/home/jurisdiction');
	}
	
	public function organization(){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
	
		
			$this->load->view('front/home/organization', $data);

			}
		$this->load->view('front/home/organization');
		
	}

	public function logo_moto(){		
		
			$this->load->view('front/home/logo_moto');
		
	}

	public function directory(){		
		
			$this->load->view('front/home/directory');
		
	}

	public function citizen_corner(){		
		
			$this->load->view('front/home/citizen_corner');
		
	}
public function download(){	
if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);	
		
			$this->load->view('front/home/download', $data);
		}else
		$this->load->view('front/home/download');
	}

	public function contact_us(){	
	if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);	
		
			$this->load->view('front/home/contact_us', $data);
		}

		$this->load->view('front/home/contact_us');
		
	}

	public function photo_gallery(){	
	if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);	
		
			$this->load->view('front/home/photo_gallery', $data);
		}
		$this->load->view('front/home/photo_gallery');
	}

	public function website_policy(){		
		
			$this->load->view('front/home/website_policy');
		
	}

	public function news(){		
		
			$this->load->view('front/home/news');
		
	}

	public function disclaimer(){		
		
			$this->load->view('front/home/disclaimer');
		
	}


	public function complaints_statistics(){	
	if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);	
		
			$this->load->view('front/home/complaints_statistics', $data);
		}
		$this->load->view('front/home/complaints_statistics');
		
	}

	public function nature_of_complaints(){	
	if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);	
		
			$this->load->view('front/home/nature_of_complaints', $data);
		}
		$this->load->view('front/home/nature_of_complaints');
	}

}