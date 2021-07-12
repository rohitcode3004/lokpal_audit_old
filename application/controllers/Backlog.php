	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backlog extends CI_Controller {

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
			//$this->load->model('proceeding_model');
			//$this->load->model('bench_model');
			//$this->load->model('agency_model');
			//$this->load->model('case_detail_model');
			//$this->load->model('scrutiny_model');
			$this->load->model('report_model');
			//$this->load->model('filing_model');
			$this->load->model('backlog_model');
			$this->load->model('common_model');
			//$this->load->helper("parts_status_helper");
			//$this->load->helper("compno_helper");
			//$this->load->helper("bench_helper");
			$this->load->helper("common_helper");
			//$this->load->helper("report_helper");
			$this->load->library('html2pdf');
			$this->load->library('label');
			$this->load->helper("date_helper");
			$this->load->helper("backlog_helper");
			//$this->load->helper("proceeding_helper");
			//$this->load->helper("scrutiny_helper");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
		}

		public function index()
		{	
			$data['user'] = $this->login_model->getRows($this->con);
			if(!($data['user']['role'] == 172))
				die('Access Denied!');
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['salution'] = $this->common_model->getSalution();
			$data['state'] = $this->common_model->getStateName();
			$data['getcountry'] = $this->common_model->getCountry();
			$data['ps_category_le'] = $this->backlog_model->get_ps_category_legacy();

			$this->load->view('templates/front/header2.php',$data);

			$this->load->view('backlog/index.php',$data);
		}

		function create()
		{
			$this->form_validation->set_rules('serial_no', 'Serial No.', 'required|is_unique[legacy_data.serial_no]|trim|alpha_numeric');
	        $this->form_validation->set_rules('salutation_id', 'Title', 'required',
	                        array('required' => 'You must provide a %s.')
	                );
	        $this->form_validation->set_rules('first_name', 'First Name', 'required');
	        //$this->form_validation->set_rules('ps_salutation_id', 'Title', 'required');
	        //$this->form_validation->set_rules('ps_first_name', 'First Name', 'required');
	        $this->form_validation->set_rules('dt_of_complaint', 'Date of Complaint', 'required');
	        $this->form_validation->set_rules('complaint_capacity_id', 'Category of Complaint', 'required');

	        if ($this->form_validation->run() == FALSE){
	        	$data['user'] = $this->login_model->getRows($this->con);
				$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
				$data['salution'] = $this->common_model->getSalution();
				$data['state'] = $this->common_model->getStateName();
				$data['getcountry'] = $this->common_model->getCountry();
				$data['ps_category_le'] = $this->backlog_model->get_ps_category_legacy();

				$this->load->view('templates/front/header2.php',$data);

				$this->load->view('backlog/index.php',$data);
	        }else{
	        	$data['user'] = $this->login_model->getRows($this->con);
			    $user_id=$data['user']['id'];
				//$purpose = ;
				$ts = date('Y-m-d H:i:s', time());
				$created_at = $ts;
				//$updated_at = ;
				$ip = get_ip();
	        	$serial_no = trim($this->security->xss_clean($this->input->post('serial_no')));
				//$order_date = get_entrydate($order_date);
				$c_title = trim($this->security->xss_clean($this->input->post('salutation_id')));
				$c_title = ($c_title!='') ? $c_title: NULL;
				$c_sur_name = trim($this->security->xss_clean($this->input->post('sur_name')));
				$c_mid_name = trim($this->security->xss_clean($this->input->post('mid_name')));
				$c_first_name = trim($this->security->xss_clean($this->input->post('first_name')));
				//$order_date = get_entrydate($order_date);
				$c_house = trim($this->security->xss_clean($this->input->post('p_hpnl')));
				$c_add1 = trim($this->security->xss_clean($this->input->post('p_add1')));
				$c_state = trim($this->security->xss_clean($this->input->post('p_state_id')));
				$c_state = ($c_state!='') ? $c_state: NULL;
				$c_dist = trim($this->security->xss_clean($this->input->post('p_dist_id')));
				$c_dist = ($c_dist!='') ? $c_dist: NULL;
				//$order_date = get_entrydate($order_date);
				$c_pin = trim($this->security->xss_clean($this->input->post('p_pin_code')));
				$c_country = trim($this->security->xss_clean($this->input->post('p_country_id')));
				$c_country = ($c_country!='') ? $c_country: NULL;
				$p_title = trim($this->security->xss_clean($this->input->post('ps_salutation_id')));
				$p_title = ($p_title!='') ? $p_title: NULL;
				$p_sur_name = trim($this->security->xss_clean($this->input->post('ps_sur_name')));
				$p_mid_name = trim($this->security->xss_clean($this->input->post('ps_mid_name')));
				$p_first_name = trim($this->security->xss_clean($this->input->post('ps_first_name')));
				//$order_date = get_entrydate($order_date);
				$p_desig = trim($this->security->xss_clean($this->input->post('ps_desig')));
				$p_orgn = trim($this->security->xss_clean($this->input->post('ps_orgn')));
				$complaint_capacity_id = trim($this->security->xss_clean($this->input->post('complaint_capacity_id')));
				$complaint_capacity_id = ($complaint_capacity_id!='') ? $complaint_capacity_id: NULL;
				$dt_of_complaint = get_entrydate(trim($this->security->xss_clean($this->input->post('dt_of_complaint'))));
				$summary = trim($this->security->xss_clean($this->input->post('summary')));
				$order_upload = trim($this->security->xss_clean($this->input->post('order_upload')));

				$config['upload_path']   = './cdn/backlog/legacy_order_upload/'; 
	        	$config['allowed_types'] = 'pdf'; 
	        	//$config['max_size']      = 2000; 
	        	$config['file_name'] = 'proc_order_'.$serial_no.'.pdf';

	        	$this->upload->initialize($config);
	       	 	$this->load->library('upload', $config);

	        	if ( ! $this->upload->do_upload('order_upload')) {
	            	$error = array('error' => $this->upload->display_errors()); 
	            	//print_r($error['error']);die;
	            	$this->session->set_flashdata('upload_error', $error['error']);
	            	redirect('backlog');
	            	die; 
	         }


				$insert_data = array(
						        'serial_no' => $serial_no,
						        'salutation_id' => $c_title,
						        'sur_name' => $c_sur_name,
						        'mid_name' => $c_mid_name,
						        //'bench_nature' => $bench_nature,
						        'first_name' => $c_first_name,
						        'p_hpnl' => $c_house,
						        //'court_no' => $court_no,
						        'p_add1' => $c_add1,
						        'p_state_id' => $c_state,
						        'p_dist_id' => $c_dist,
						        'p_pin_code' => $c_pin,
						        'p_country_id' => $c_country,
						        'ps_salutation_id' => $p_title,
						        'ps_sur_name' => $p_sur_name,
						        'ps_mid_name' => $p_mid_name,
						        'ps_first_name' => $p_first_name,
						        'ps_desig' => $p_desig,
						        //'bench_nature' => $bench_nature,
						        'ps_orgn' => $p_orgn,
						        'complaint_capacity_id' => $complaint_capacity_id,
						        //'court_no' => $court_no,
						        'dt_of_complaint' => $dt_of_complaint,
						        'summary' => $summary,
						        'order_upload' => 'cdn/backlog/legacy_order_upload/proc_order_'.$serial_no.'.pdf',
						        'user_id' => $user_id,
						        'created_at' => $created_at,
						        'ip_address' => $ip,
						        );
							//print_r($insert_data);die;
								$query = $this->backlog_model->insert($insert_data);

								if($query){
									$this->session->set_flashdata('success_msg', 'Successfully Submitted Data of Serial no. '.$serial_no.'.');
									redirect('backlog');
										}else{
											$this->session->set_flashdata('error_msg', 'Some problem inserting the data.Try again. ');
											redirect('backlog');
										}
	        }
	    }

	public function edit($id) {
        $data['user'] = $this->login_model->getRows($this->con);
		if(!($data['user']['role'] == 173))
				die('Access Denied!');
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$data['salution'] = $this->common_model->getSalution();
		$data['state'] = $this->common_model->getStateName();
		$data['getcountry'] = $this->common_model->getCountry();
		$data['ps_category_le'] = $this->backlog_model->get_ps_category_legacy();

		$data['legacy_data'] = $this->backlog_model->get_legacy_data_byId($id);

		$this->load->view('templates/front/header2.php',$data);

		$this->load->view('backlog/index.php',$data);
    }

    public function update($id=NULL) {
			//$this->form_validation->set_rules('serial_no', 'Serial No.', 'required|is_unique[legacy_data.serial_no]|trim|alpha_numeric');
	        $this->form_validation->set_rules('salutation_id', 'Title', 'required',
	                        array('required' => 'You must provide a %s.')
	                );
	        $this->form_validation->set_rules('first_name', 'First Name', 'required');
	        //$this->form_validation->set_rules('ps_salutation_id', 'Title', 'required');
	        //$this->form_validation->set_rules('ps_first_name', 'First Name', 'required');
	        $this->form_validation->set_rules('dt_of_complaint', 'Date of Complaint', 'required');
	        $this->form_validation->set_rules('complaint_capacity_id', 'Category of Complaint', 'required');

	        if ($this->form_validation->run() == FALSE){
	        	$data['user'] = $this->login_model->getRows($this->con);
				$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
				$data['salution'] = $this->common_model->getSalution();
				$data['state'] = $this->common_model->getStateName();
				$data['getcountry'] = $this->common_model->getCountry();
				$data['ps_category_le'] = $this->backlog_model->get_ps_category_legacy();

				$data['legacy_data'] = $this->backlog_model->get_legacy_data_byId($id);

				$this->load->view('templates/front/header2.php',$data);

				$this->load->view('backlog/index.php',$data);
	        }else{
	        	$id = trim($this->security->xss_clean($this->input->post('id')));
	        	//print_r($id);die;
	        	$data['user'] = $this->login_model->getRows($this->con);
			    $user_id=$data['user']['id'];
				//$purpose = ;
				$ts = date('Y-m-d H:i:s', time());
				$ts_file = date('m-d-Y_H:i:s');
				$created_at = $ts;
				//$updated_at = ;
				$ip = get_ip();
	        	$serial_no = trim($this->security->xss_clean($this->input->post('serial_no')));
				//$order_date = get_entrydate($order_date);
				$c_title = trim($this->security->xss_clean($this->input->post('salutation_id')));
				$c_title = ($c_title!='') ? $c_title: NULL;
				$c_sur_name = trim($this->security->xss_clean($this->input->post('sur_name')));
				$c_mid_name = trim($this->security->xss_clean($this->input->post('mid_name')));
				$c_first_name = trim($this->security->xss_clean($this->input->post('first_name')));
				//$order_date = get_entrydate($order_date);
				$c_house = trim($this->security->xss_clean($this->input->post('p_hpnl')));
				$c_add1 = trim($this->security->xss_clean($this->input->post('p_add1')));
				$c_state = trim($this->security->xss_clean($this->input->post('p_state_id')));
				$c_state = ($c_state!='') ? $c_state: NULL;
				$c_dist = trim($this->security->xss_clean($this->input->post('p_dist_id')));
				$c_dist = ($c_dist!='') ? $c_dist: NULL;
				//$order_date = get_entrydate($order_date);
				$c_pin = trim($this->security->xss_clean($this->input->post('p_pin_code')));
				$c_country = trim($this->security->xss_clean($this->input->post('p_country_id')));
				$c_country = ($c_country!='') ? $c_country: NULL;
				$p_title = trim($this->security->xss_clean($this->input->post('ps_salutation_id')));
				$p_title = ($p_title!='') ? $p_title: NULL;
				$p_sur_name = trim($this->security->xss_clean($this->input->post('ps_sur_name')));
				$p_mid_name = trim($this->security->xss_clean($this->input->post('ps_mid_name')));
				$p_first_name = trim($this->security->xss_clean($this->input->post('ps_first_name')));
				//$order_date = get_entrydate($order_date);
				$p_desig = trim($this->security->xss_clean($this->input->post('ps_desig')));
				$p_orgn = trim($this->security->xss_clean($this->input->post('ps_orgn')));
				$complaint_capacity_id = trim($this->security->xss_clean($this->input->post('complaint_capacity_id')));
				$complaint_capacity_id = ($complaint_capacity_id!='') ? $complaint_capacity_id: NULL;
				$dt_of_complaint = get_entrydate(trim($this->security->xss_clean($this->input->post('dt_of_complaint'))));
				$summary = trim($this->security->xss_clean($this->input->post('summary')));
				$order_upload = trim($this->security->xss_clean($this->input->post('order_upload')));
				//print_r($_FILES['order_upload']['name']);die;


	        	/*if ( ! $this->upload->do_upload('order_upload')) {
	            	$error = array('error' => $this->upload->display_errors()); 
	            	//print_r($error['error']);die;
	            	$this->session->set_flashdata('upload_error', $error['error']);
	            	redirect('backlog');
	            	die; 
	        		}*/
	        		
				$insert_data = array(
						        'salutation_id' => $c_title,
						        'sur_name' => $c_sur_name,
						        'mid_name' => $c_mid_name,
						        //'bench_nature' => $bench_nature,
						        'first_name' => $c_first_name,
						        'p_hpnl' => $c_house,
						        //'court_no' => $court_no,
						        'p_add1' => $c_add1,
						        'p_state_id' => $c_state,
						        'p_dist_id' => $c_dist,
						        'p_pin_code' => $c_pin,
						        'p_country_id' => $c_country,
						        'ps_salutation_id' => $p_title,
						        'ps_sur_name' => $p_sur_name,
						        'ps_mid_name' => $p_mid_name,
						        'ps_first_name' => $p_first_name,
						        'ps_desig' => $p_desig,
						        //'bench_nature' => $bench_nature,
						        'ps_orgn' => $p_orgn,
						        'complaint_capacity_id' => $complaint_capacity_id,
						        //'court_no' => $court_no,
						        'dt_of_complaint' => $dt_of_complaint,
						        'summary' => $summary,
						        'user_id' => $user_id,
						        'updated_at' => $created_at,
						        'ip_address' => $ip,
						        );

				if($_FILES['order_upload']['name']){
					$ts_file = time();
					$config['upload_path']   = './cdn/backlog/legacy_order_upload/'; 
	        		$config['allowed_types'] = 'pdf'; 
	        		//$config['max_size']      = 2000; 
	        		$config['file_name'] = 'proc_order_'.$serial_no.'_'.$ts_file.'.pdf';

	        		$this->upload->initialize($config);
	       	 		$this->load->library('upload', $config);

	       	 	if ( ! $this->upload->do_upload('order_upload')) {
	            	$error = array('error' => $this->upload->display_errors()); 
	            	//print_r($error['error']);die;
	            	$this->session->set_flashdata('upload_error', $error['error']);
	            	redirect('backlog/edit/'.$id);
	            	die; 
	         		}

					$insert_data['order_upload'] = 'cdn/backlog/legacy_order_upload/proc_order_'.$serial_no.'_'.$ts_file.'.pdf';
				}
							//print_r($insert_data);die;
								$query = $this->backlog_model->update($insert_data, $id);

								if($query){
									$this->session->set_flashdata('success_msg', 'Successfully Updated Data of Serial no. '.$serial_no.'.');
									redirect('backlog/legacy_pdf');
										}else{
											$this->session->set_flashdata('error_msg', 'Some problem updated the data.Try again. ');
											redirect('backlog/legacy_pdf');
										}
	        }
    }

	public function legacy_pdf()
		{
		$data['user'] = $this->login_model->getRows($this->con);
		if(!($data['user']['role'] == 173))
				die('Access Denied!');

		//print_r($data['user']['id']);die;
		$data['legacy_data']= $this->backlog_model->get_legacy_data();
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->view('templates/front/header2.php',$data);
		//echo "test here";die;

		$this->load->view('backlog/legacy_data.php',$data);

		}

	public function verify()
		{
		$data['user'] = $this->login_model->getRows($this->con);
		if(!($data['user']['role'] == 173))
				die('Access Denied!');

		//print_r($data['user']['id']);die;
		$id = trim($this->security->xss_clean($this->input->post('id')));	
		if(isset($id)){
		$data['legacy_data']= $this->backlog_model->get_legacy_data();
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$update_data = $this->backlog_model->upd_verify_status($id);
		if($update_data){
			$this->session->set_flashdata('success_msg', 'Successfully Verified!');
			redirect('backlog/legacy_pdf');
	}else{
		die('some problem updating pls go back');
	}
	    }else{
	    	die('no data selected pls go back');
	    }

		}


	public function printpdf($id)
	{
	//echo "in pdf";
	//echo $id; die;	
	
//$array=$this->session->userdata('ref_no');
  $this->load->helper("date_helper"); 
  $refe_no=$this->session->userdata('ref_no');

  $curYear = date('Y');
                        $curMonth = date('m');
                        $curDay = date('d');
                        $cur_date = $curDay.'/'.$curMonth.'/'.$curYear;
                        $cur_date12 = $curDay.'/'.$curMonth.'/'.$curYear;
                      //  $comp_f_date="$curYear-$curMonth-$curDay"; 
                         $chkdate="$curDay-$curMonth-$curYear";  

//$refe_no=$array['ref_no'];
  //$chkdate= date("l jS \of F Y");

  $legacy_data = $this->backlog_model->get_legacy_data_byId($id);

  //echo "<pre>";

  //print_r($legacy_data);die;


  $myArray=(array)$legacy_data;
    $serial_no=$myArray[0]->serial_no ?? '';
 
  $first_name=$myArray[0]->first_name ?? '';
  $sur_name=$myArray[0]->sur_name ?? '';
  $mid_name=$myArray[0]->mid_name ?? '';

   $ps_first_name=$myArray[0]->ps_first_name ?? '';
  $ps_mid_name=$myArray[0]->ps_mid_name ?? '';
  $ps_sur_name=$myArray[0]->ps_sur_name ?? '';

  $salutation_desc=$myArray[0]->salutation_desc ?? '';

  $p_add1=$myArray[0]->p_add1 ?? '';
  $p_hpnl=$myArray[0]->p_hpnl ?? '';

  $name=$myArray[0]->name ?? '';
   $p_state_id=$myArray[0]->p_state_id ?? '';
  $p_dist_id=$myArray[0]->p_dist_id ?? '';
  
  if($p_state_id!=NULL && $p_dist_id!=NULL){
  $pdistrict = $this->report_model->getPdistrict($p_state_id,$p_dist_id);
  $pdistrictname=$pdistrict['name'];
}else{
	$pdistrictname = '';
}

  $p_country_id=$myArray[0]->p_country_id ?? '';
 if($p_country_id!=NULL){
  $nationality=$this->report_model->getNationality($p_country_id);
   $national_desc=$nationality['nationality_desc'];
}else{
	$national_desc = '';
}
  $p_pin_code=$myArray[0]->p_pin_code ?? '';
  $ps_salutation_id=$myArray[0]->ps_salutation_id ?? '';
  if($ps_salutation_id!=NULL){
  $salutationdata = $this->report_model->getSalutation($ps_salutation_id);
  $salutation_descc=$salutationdata['salutation_desc'];
}else{
	$salutation_descc = '';
}

  $ps_desig=$myArray[0]->ps_desig ?? '';

   $ps_orgn=$myArray[0]->ps_orgn ?? '';

    $complaint_capacity_id=$myArray[0]->complaint_capacity_id ?? '';
    if($complaint_capacity_id!=''){
    	$complaint_capacity_name = get_complaint_capacity_name($complaint_capacity_id);
    }
    $summary=$myArray[0]->summary ?? '';
    $dt_of_complaint=$myArray[0]->dt_of_complaint ?? '';

    $dt_of_complaint=get_displaydate($dt_of_complaint);
 
ini_set('set_time_limit', 0);
ini_set('memory_limit', '-1');
ini_set('xdebug.max_nesting_level', 2000);
$this->html2pdf->folder('./cdn/backlog/legacy_data_report/');
$this->html2pdf->paper('A4', 'portrait', 'fr');
$elements = $this->label->view(1);
$elements['17']['long_name'];

$getallwidget =     
'

<div align="center"><b>Legacy Data Report</b></div>
<br>
<div align="right">Serial Number : <b>'.$serial_no.' </b></div>

<br><br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">

<tr>
<td style="border: 1px solid black;" align="center"><b>1.</b></td>
<td style="border: 1px solid black;" colspan="2"><b>Name of the complainant:</b></td>


</tr> 



<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Title(Shri/Smt/kum./Dr.etc.)</td><td style="border: 1px solid black;">'.$salutation_desc.' </td></tr>


<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">First Name</td><td style="border: 1px solid black;">'.$first_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Middle Name</td><td style="border: 1px solid black;">'.$mid_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Sur Name</td><td style="border: 1px solid black;">'.$sur_name.'</td></tr>
 

<tr>
<td style="border: 1px solid black;" align="center"><b>2.</b></td>
<td style="border: 1px solid black;" align"center" colspan="2"><b>Address of the complainant:</b></td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">House/Property Number/Locality</td><td style="border: 1px solid black;">'.$p_hpnl.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Name of the village/city</td><td style="border: 1px solid black;">'.$p_add1.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">State</td><td style="border: 1px solid black;">'.$name.' </td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">District</td><td style="border: 1px solid black;">'.$pdistrictname.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Pin Code</td><td style="border: 1px solid black;">'.$p_pin_code.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Country</td><td style="border: 1px solid black;">'.$national_desc.' </td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"><b>3.</b></td>
<td style="border: 1px solid black;" align"center" colspan="2"><b>Name of the public servant against whom the complaint is being made:</b></td>
</tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Title(Shri/Smt/kum./Dr.etc.)</td><td style="border: 1px solid black;">'.$salutation_descc.' </td></tr>


<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">First Name</td><td style="border: 1px solid black;">'.$ps_first_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Middle Name</td><td style="border: 1px solid black;">'.$ps_mid_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Sur Name</td><td style="border: 1px solid black;">'.$ps_sur_name.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"><b>4.</b></td>
<td style="border: 1px solid black;" align"center" colspan="2"><b>Details of public servant against whom complaint is being made:
</b></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Designation of the officer/employee</td><td style="border: 1px solid black;">'.$ps_desig.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Organisation/Agency having administrative control over the said officer/employee </td><td style="border: 1px solid black;">'.$ps_orgn.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Category of the public servant against whom the complaint is being made</td><td style="border: 1px solid black;">'.$complaint_capacity_name.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"><b>5.</b></td>
<td style="border: 1px solid black;" align"center" colspan="2"><b>Complaint Details:</b></td>

</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Summary</td><td style="border: 1px solid black;">'.$summary.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Date of complaint</td><td style="border: 1px solid black;">'.$dt_of_complaint.'</td>
</tr>


</table>                      
<br>
<div>Date  : '.$chkdate.'</div>

<br>
<div align="right"><b>                Authorised Signatory    </div></b> 

';                                                                          

$getallwidget .='
</table> 

'; 





$getallwidget .= '

   </div>    
    ';

                      // echo $getallwidget;die;
    
    $file                           =    $serial_no;
    $filename                       =     $file;
     // $this->data['main_content']           =     'view_widget_report_pdf';
    $html                       =     $getallwidget;

    $this->html2pdf->filename($filename.".pdf"); 
    $this->html2pdf->html($html);
    $this->html2pdf->create('save');
    $this->html2pdf->create('open');
     // $ref_no=$this->session->userdata('ref_no');
    $this->session->unset_userdata('ref_no');        
    $this->session->sess_destroy();
    //$path_to_legacy_report = '/cdn/backlog/legacy_data_report/'.$filename.'.pdf';
    //$save_path_query = $this->backlog_model->save_path_report($path_to_legacy_report, $id);
    redirect('backlog/legacy_pdf/');
    
    exit;

//$data['state'] = $this->common_model->getStateName();
}

	}