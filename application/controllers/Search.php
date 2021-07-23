<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
	}

	

	public function case_status(){
		$data['user'] = $this->login_model->getRows($this->con);

		$this->load->helper("date_helper");	
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->view('bench/search_case_status.php',$data);
	}




	public function searchcase_status(){
		$data['user'] = $this->login_model->getRows($this->con); 
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->helper("date_helper");	
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
		$case_no_year= ($this->input->post('case_no_year'));
		$var = preg_split("#/#", $case_no_year); 
		$case_no=$var['0'];
		$year=$var['1'];
		$data['complaint_status']= $this->bench_model->getComplaintStatus($case_no,$year);
		if ($data['complaint_status'] == true){
			$filing_no=$data['complaint_status']['0']->filing_no;
			$data['partapartc_detail']= $this->bench_model->getpartapartc_detail($filing_no);

			$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);

			$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);
			$data['next_listing_date'] = $this->proceeding_model->get_next_listdate($filing_no);

			echo 'success';
		}else{
			$data['error'] = 'complaint no not generated';

		}

    // echo "<pre>";
    // print_r($data['complaint_status']);
	//echo	$filing_no=$data['complaint_status']['0']->filing_no;

    // die;
		$this->load->view('bench/searchcase_status_detail.php',$data);
	}

	public function search_case(){

		$data['user'] = $this->login_model->getRows($this->con);

		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$this->load->view('templates/front/SC_Header.php',$data);
		$this->load->view('search/search_case.php',$data);
		$this->load->view('templates/front/CE_Footer.php',$data);
	}



	public function search_case_detail(){
		$data['user'] = $this->login_model->getRows($this->con);
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
//$this->load->view('templates/front/header4.php',$data);
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->view('templates/front/header2.php',$data);

		$search_case= ($this->input->post('search_case'));
//echo "here";
//$complaint_number= ($this->input->post('complaint_number'));
		if($search_case=='3')
		{
			$complaint_number= ($this->input->post('complaint_number'));
			$var = preg_split("#/#", $complaint_number);
			$case_no=(int)$var['0'];
			$year=$var['1'];
			$data['case_detail_data']= $this->search_model->case_status($case_no,$year);
			$ct=count($data['case_detail_data']);

		}

		if($search_case=='1')
		{
			$name_of_complainant= ($this->input->post('name_of_complainant'));
			$data['case_detail_data']= $this->search_model->case_search_by_complainant($name_of_complainant);

// $filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
			$ct=count($data['case_detail_data']);
		}

		if($search_case=='2')
		{
			$name_of_public_servant= ($this->input->post('name_of_public_servant'));
			$data['case_detail_data']= $this->search_model->case_search_by_publicservant($name_of_public_servant);
 //$filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
			$ct=count($data['case_detail_data']);
		}


		if($search_case=='4')
		{
			$summary_fact_allegation= ($this->input->post('summary_fact_allegation'));
			$data['case_detail_data']= $this->search_model->case_search_by_summary($summary_fact_allegation);
 //$filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
			$ct=count($data['case_detail_data']);
		}

		if($search_case=='5')
		{
			$department_name= ($this->input->post('department_name'));
			$data['case_detail_data']= $this->search_model->case_search_by_department($department_name);
 //$filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
			$ct=count($data['case_detail_data']);
		}


		if($search_case=='6')
		{
			$dt_of_filing_from= ($this->input->post('dt_of_filing_from'));
			$dt_of_filing_to= ($this->input->post('dt_of_filing_to'));
			$data['case_detail_data']= $this->search_model->case_search_by_date($dt_of_filing_from,$dt_of_filing_to);
 //$filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
			$ct=count($data['case_detail_data']);
		}




		for($i=0;$i<$ct;$i++){
			$filing_no=$data['case_detail_data'][$i]->filing_no ?? '';

			$data['case_detail_chk']= $this->search_model->case_status_filingno($filing_no);
//print_r($data['case_detail_chk']);die;
			$filing_no=$data['case_detail_chk'][0]->filing_no ?? '';
//$complaint_no=$data['case_detail_chk'][0]->complaint_no ?? '';
			$complaint_year=$data['case_detail_chk'][0]->complaint_year ?? '';
			$listing_date=$data['case_detail_chk'][0]->listing_date ?? '';
			$ordertype_name=$data['case_detail_chk'][0]->ordertype_name ?? '';
			$ordertype_code=$data['case_detail_chk'][0]->ordertype_code ?? '';
			$remarks=$data['case_detail_chk'][0]->remarks ?? '';
			$flag=$data['case_detail_chk'][0]->flag ?? '';
			$scrutiny_status=$data['case_detail_chk'][0]->scrutiny_status ?? '';
			$listed=$data['case_detail_chk'][0]->listed ?? '';
			$case_status=$data['case_detail_chk'][0]->case_status ?? '';
			$action=$data['case_detail_chk'][0]->action ?? ''; 
			$first_name=$data['case_detail_chk'][0]->first_name ?? '';
			$sur_name=$data['case_detail_chk'][0]->sur_name ?? '';
			$mid_name=$data['case_detail_chk'][0]->mid_name ?? '';
			$ps_first_name=$data['case_detail_chk'][0]->ps_first_name ?? '';
			$ps_mid_name=$data['case_detail_chk'][0]->ps_mid_name ?? '';
			$ps_sur_name=$data['case_detail_chk'][0]->ps_sur_name ?? ''; 
			$dt_of_filing=$data['case_detail_chk'][0]->dt_of_filing ?? '';
			$ps_orgn=$data['case_detail_chk'][0]->ps_orgn ?? '';  

			$sum_facalle=$data['case_detail_chk'][0]->sum_facalle ?? ''; 



			$data_view['case_detail'][$i] = array(
				'filing_no'=> $filing_no,
//'complaint_no'=>$complaint_no,
				'complaint_year' => $complaint_year,
				'listing_date' => $listing_date,
				'ordertype_name' => $ordertype_name,
				'remarks'=> $remarks,
				'flag'=>$flag,
				'scrutiny_status' => $scrutiny_status,
				'listed' => $listed,
				'case_status' => $case_status,
				'action' => $action,
				'ordertype_code' => $ordertype_code,
				'first_name' => $first_name,
				'sur_name' => $sur_name,
				'mid_name' => $mid_name,
				'ps_first_name' => $ps_first_name,
				'ps_mid_name' => $ps_mid_name,
				'ps_sur_name' => $ps_sur_name,
				'dt_of_filing' => $dt_of_filing,
				'ps_orgn' => $ps_orgn,
				'sum_facalle' => $sum_facalle,

			);

		}

		if(isset($data_view['case_detail']))
		{
			echo "sucees";
		}else
		{
			$data_view['error']= "";
		}

		$this->load->view('search/search_case_action.php',$data_view);
	}



	public function search_case_detail_leg(){
		$data['user'] = $this->login_model->getRows($this->con);
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$userid=$data['user']['id'];
//$this->load->view('templates/front/header4.php',$data);
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		//$this->load->view('templates/front/header2.php',$data);
		$this->load->view('templates/front/SC_Header.php',$data);

		$search_case= ($this->input->post('search_case'));
//echo "here";
//$complaint_number= ($this->input->post('complaint_number'));
		if($search_case=='3')
		{


			$complaint_number= ($this->input->post('complaint_number'));
			$var = preg_split("#/#", $complaint_number);
			$case_no=(int)$var['0'];
			$year=$var['1'];


			if ($case_no =='' or $year =='')
			{  
				$this->session->set_flashdata('success_msg', '<div class="alert alert-danger text-center"><h4 class="m-0">Please Enter Complaint Number / Year</h2></div>');
				redirect('search/search_case');


			}
			else
			{
				$data['case_detail_data']= $this->search_model->case_status($case_no,$year);
				$ct=count($data['case_detail_data']);
			}
		}

		if($search_case=='1')
		{
			$name_of_complainant= ($this->input->post('name_of_complainant'));
			$data_view['case_detail']= $this->search_model->case_search_by_complainant_leg($name_of_complainant);

			//echo  "<pre>";
			//print_r($data_view['case_detail']);die;
		}


		if($search_case=='2')
		{
			$name_of_public_servant= ($this->input->post('name_of_public_servant'));
			$data_view['case_detail']= $this->search_model->case_search_by_publicservant_leg($name_of_public_servant);
		}


		if($search_case=='4')
		{
			$summary_fact_allegation= ($this->input->post('summary_fact_allegation'));
			$data_view['case_detail']= $this->search_model->case_search_by_summary_leg($summary_fact_allegation);

//$ct=count($data['case_detail_data']);
		}

		if($search_case=='5')
		{
			$department_name= ($this->input->post('department_name'));
			$data_view['case_detail']= $this->search_model->case_search_by_department_leg($department_name);
		}


		if($search_case=='6')
		{
			$dt_of_filing_from= ($this->input->post('dt_of_filing_from'));
			$dt_of_filing_to= ($this->input->post('dt_of_filing_to'));
			$data_view['case_detail']= $this->search_model->case_search_by_date_leg($dt_of_filing_from,$dt_of_filing_to);
 
		}
		if($search_case=='3')
		{
			$complaint_number= ($this->input->post('complaint_number'));
			$var = preg_split("#/#", $complaint_number);
			$case_no=(int)$var['0'];
			$year=$var['1'];
			$data['case_detail_data']= $this->search_model->case_status($case_no,$year);
			
 $filing_no=$data['case_detail_data'][0]->filing_no ?? '';
$data_view['case_detail']= $this->search_model->case_status_leg($filing_no);

//echo "<pre>";
//print_r($data_view['case_detail']);die;

}
if(isset($data_view['case_detail']))
{
	echo "sucees";
}else
{
	$data_view['error']= "";
}

$this->load->view('search/search_case_action.php',$data_view);
$this->load->view('templates/front/CE_Footer.php',$data);
}





}