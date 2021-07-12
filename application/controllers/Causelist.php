<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Causelist extends CI_Controller {

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
		$this->load->model('Causelist_model');
		$this->load->model('bench_model');
		$this->load->model('report_model');
		$this->load->model('filing_model');
		$this->load->helper("parts_status_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("causelist_helper");
		$this->load->helper("date_helper");	
		$this->load->helper("bench_helper");
		$this->load->library('html2pdf');
		$this->load->library('label');
	}

	public function dashboard()
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['user_comps'] = $this->filing_model->get_user_complaints($data['user']['id']);

	  		//print_r($data['user_comps']);die('kk');
		$this->load->helper("compno_helper");
		$this->load->view('templates/front/header2.php',$data);

		$this->load->view('filing/dashboard_counter.php',$data);
	}

	/*public function genratecauselist($dash_ref_no=NULL){	

		
		$data['user'] = $this->login_model->getRows($this->con);

		$this->load->helper("date_helper");	
		$this->load->helper("compno_helper");	
		if($dash_ref_no == NULL ){
			$ref_no=$this->session->userdata('ref_no');
		}else{
		    	//$ref_no=$this->session->userdata('ref_no');
			$ref_no = $dash_ref_no;
			$this->session->set_userdata('ref_no',$ref_no);
		}			
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['bench_nature'] = $this->bench_model->getBenchNature();
		
	 
		$this->load->view('causelist/causelist.php',$data);	
	}*/


	public function genratecauselist(){	

		
		$data['user'] = $this->login_model->getRows($this->con);

		
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['bench_nature'] = $this->bench_model->getBenchNature();

		$data['venues'] = $this->bench_model->fetch_venues();
		
	 	$this->load->view('templates/front/CM_Header.php',$data);

		$this->load->view('causelist/causelist.php',$data);	

		$this->load->view('templates/front/CE_Footer.php',$data);
		
	}


	public function getcauselistdata()
	{
		$data['user'] = $this->login_model->getRows($this->con);
		$userid=$data['user']['id'];
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		 $curYear = date('Y');
 		 $curMonth = date('m');
  		$curDay = date('d');
 		$entry_date = $curDay.'-'.$curMonth.'-'.$curYear;
 		$from_time='10:30';
		 $judge_code= ($this->input->post('judge'));
		 $data['bench_nature'] = $this->bench_model->getBenchNature();
		 $from_list_date= ($this->input->post('from_list_date'));
		 $from_list_date = get_entrydate($from_list_date);
		 //$court_no= ($this->input->post('court_no'));
		// $bench_nature= ($this->input->post('bench_nature'));
		 


		//$data['benchjudeg'] = $this->Causelist_model->getBenchJudge($from_list_date);
		$data['listingjudeg'] = $this->Causelist_model->getListingJudge($from_list_date);
		$data['caseallocationdata'] = $this->Causelist_model->getCaseAllocationData($from_list_date);
		 $listjudge=count($data['listingjudeg']);
		if($listjudge > 0)
		{
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->view('causelist/causelist.php',$data);
		}
		else
		{	
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$data['error_msg'] = 'No data found, please try again.';
		$this->load->view('causelist/causelist.php',$data);
	}
}

 public function view_causelist()
{

		if($this->input->post('from_list_date') && $this->input->post('venue') && $this->input->post('time')){
		$data['user'] = $this->login_model->getRows($this->con);
		//print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['listing_date'] = get_entrydate($this->input->post('from_list_date'));
		$data['venue'] = $this->input->post('venue');
		$data['time'] = $this->input->post('time');

		//$get_allocation_cases = $this->Causelist_model->fetch_allocation_cases($listing_date);
		//print "<pre>";
		//print_r($get_allocation_cases);
		//print "</pre>";
		//die;
		$data['get_all_benches'] = $this->Causelist_model->fetch_all_benches();
		//print "<pre>";
		//print_r($get_all_benches);
		//print "</pre>";
		//die;
		$data['purpose_type'] = $this->bench_model->fetch_purpose_type();
		//$this->load->view('templates/front/header2.php',$data);
		$this->load->view('templates/front/CM_Header.php',$data);
		$this->load->view('causelist/causelist_performa.php',$data);
		$this->load->view('templates/front/CE_Footer.php',$data);
		}else{
		$data['user'] = $this->login_model->getRows($this->con);

		$this->load->helper("date_helper");	
		
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['bench_nature'] = $this->bench_model->getBenchNature();

		$data['venues'] = $this->bench_model->fetch_venues();
		
	 
		$this->load->view('causelist/causelist.php',$data);	
		}
	}


}