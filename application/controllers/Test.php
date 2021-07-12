<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	
	
	
	public function index()
	{
	//echo "in here";die;
		
		$this->load->view('front/home/index.php');
	}

	public function test()
	{
	echo "in here";die;
		
		$this->load->view('front/home/index.php');
	}

	
}