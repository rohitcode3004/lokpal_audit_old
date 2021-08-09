<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		if($this->isUserLoggedIn) 
		{
			$this->con = array( 
				'id' => $this->session->userdata('userId') 
			);
		}
		else{
			redirect('admin/login'); 
		}
		
		$this->load->library('Menus_lib');
		$this->load->model('login_model');
		$this->load->model('bench_model');
		$this->load->model('agency_model');
		$this->load->model('report_model');
		$this->load->model('proceeding_model');
		$this->load->model('filing_model');
		$this->load->model('search_model');
		$this->load->model('scrutiny_model');
		$this->load->helper("parts_status_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("common_helper");
		$this->load->library('html2pdf');
		$this->load->library('label');
		$this->load->helper("date_helper");
		$this->load->helper("bench_helper");
		$this->load->helper("report_helper");
		$this->load->helper("date_helper");
		$this->load->helper("proceeding_helper");
		$this->load->helper("reports_helper");
		$this->load->helper("scrutiny_helper");
		$this->load->model('order_report_model');
	}



	public function list_of_case(){
		$data['user'] = $this->login_model->getRows($this->con); 
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->helper("date_helper");	
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];		
		$this->load->view('templates/front/dheader.php',$data);
		$this->load->view('order_report/search_cases.php',$data);
		$this->load->view('templates/front/dfooter.php',$data);
	}

	public function search_case_action(){

		$data['user'] = $this->login_model->getRows($this->con);

		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);


		$search_case= ($this->input->post('search_case'));
		if($search_case=='1')
		{
		$dt_of_order_from= ($this->input->post('dt_of_order_from'));
		$dt_of_order_to= ($this->input->post('dt_of_order_to'));
		$data['case_list'] = $this->order_report_model->get_all_case($dt_of_order_from,$dt_of_order_to);
		}
		else
		{	$complaint_number= ($this->input->post('complaint_number'));
			$var = preg_split("#/#", $complaint_number);
			$case_no=(int)$var['0'];
			$year=$var['1'];
			if ($case_no =='' or $year =='')
			{  
			$this->session->set_flashdata('success_msg', '<div class="alert alert-danger text-center"><h4 class="m-0">Please Enter Complaint Number / Year</h2></div>');
			redirect('order_report/list_of_case');
			}
			else
			{
				$data['filing_no'] = $this->bench_model->case_status_data($case_no,$year);

				//echo "<pre>";
				//print_r($data['filing_no']);
			//	$part_a[0]->first_name ?? '';
				$filing_no=$data['filing_no']['0']->filing_no;
				
			$data['case_list'] = $this->order_report_model->get_all_case_report_comp_no($filing_no);
			}


			}
	
		$this->load->view('templates/front/dheader.php',$data);
		//$data['case_list'] = $this->order_report_model->get_all_case($dt_of_order_from,$dt_of_order_to);
		$this->load->view('order_report/list_of_cases.php',$data);
		$this->load->view('templates/front/dfooter.php',$data);
		
	}

	public function display_order_proc()
	{	$data['user'] = $this->login_model->getRows($this->con); 
	$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
	$this->load->helper("date_helper");	
	$this->load->helper("compno_helper");
	$userid=$data['user']['id'];
	$filing_no = $this->uri->segment(3);
	$this->load->view('templates/front/dheader.php',$data);
	$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
	$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);
	$this->load->view('templates/front/dfooter.php',$data);
	$this->load->view('order_report/proceeding_order.php',$data);
}


public function display_report_agency()
{	$data['user'] = $this->login_model->getRows($this->con); 
$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
$this->load->helper("date_helper");	
$this->load->helper("compno_helper");
$userid=$data['user']['id'];
$filing_no = $this->uri->segment(3);
$this->load->view('templates/front/dheader.php',$data);

$data['agencydata']= $this->agency_model->getAgencydata($filing_no);
$data['agencydatahis']= $this->agency_model->getAgencydata_his($filing_no);
$data['anyotheractiondata']= $this->agency_model->getAnyOtherData($filing_no);
$data['anyotheractiondata_report']= $this->agency_model->getAnyOtherData_report($filing_no);


		 //$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
		//$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);
$this->load->view('templates/front/dfooter.php',$data);
$this->load->view('order_report/agency_report.php',$data);
}


}