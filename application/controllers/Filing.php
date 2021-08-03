<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filing extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('filing_model');
		$this->load->model('common_model');		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->library('label');
		$this->load->library('Menus_lib');
		$this->load->library('File_upload');
		$this->load->helper("common_helper");
		$this->load->helper('file');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->load->model('login_model');
		$this->load->model('users_model');
		$this->load->helper("compno_helper");	
		$this->load->helper("parts_status_helper");
	}


	public function dashboard_new()
	{
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['user_comps'] = $this->filing_model->get_user_complaints($data['user']['id']);
			$this->load->view('templates/front/CE_Header.php',$data);
			// ysc change for dashboard $this->load->view('filing/dashboard.php',$data);
			$this->load->view('filing/dashboard.php',$data);					
			$this->load->view('templates/front/CE_Footer.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}

	}


	public function dashboard_completed_complaint()
	{
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['user_completed_comps'] = $this->filing_model->get_pub_user_completed_complaints($data['user']['id']);
			$this->load->view('templates/front/CE_Header.php',$data);
			// ysc change for dashboard $this->load->view('filing/dashboard.php',$data);
			$this->load->view('filing/dashboard_completed_complaints.php',$data);					
			$this->load->view('templates/front/CE_Footer.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}

	}



	public function dashboard()
	{	

		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);

			//echo "<pre>";
         // $user_id=$data['user']['id'];

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			//$data['user_comps'] = $this->filing_model->get_user_complaints($data['user']['id']);
			$data['re_edit_comp'] = $this->filing_model->get_re_entry_complaints_count($data['user']['id']);

			$data['pen_comps'] = $this->filing_model->get_pub_pen_count($data['user']['id']);

			$data['completed_comps'] = $this->filing_model->get_pub_completed_count($data['user']['id']);

			$this->load->view('templates/front/CE_Header.php',$data);
			// ysc change for dashboard $this->load->view('filing/dashboard.php',$data);
			$this->load->view('filing/dashboard_main_filing_public.php',$data);					
			$this->load->view('templates/front/CE_Footer.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}
		
	}	

	public function dashboard_main()
	{	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);

            //print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['total_log'] = $this->filing_model->get_total_filing($data['user']['id']);
			$data['pend_log'] = $this->filing_model->get_pend_filing($data['user']['id']);
			$data['scr_log'] = $this->filing_model->get_scr_filing($data['user']['id']);

	  		//print_r($data['total_log']);die('kk');
			$this->load->helper("compno_helper");
			$this->load->view('templates/front/header2.php',$data);

			$this->load->view('filing/dashboard_main_filing.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}
	}

	public function filing($dash_ref_no=NULL){	
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$data['user_profile'] = $this->users_model->get_user_profile_data($data['user']['id']);
			//print_r($data['user_profile']);die;

			$this->load->helper("date_helper");	
			
            // echo $id;
            // echo "<pre>";
             //print_r($data['user']['id']);die;

         	// $userid=$data['user']['id'];
            // print_r($data['user']['role']);die('here');
			// $data['identity_document_type'] = $this->common_model->getDocument_type();
			// echo "check the session value";
			// echo $this->session->userdata('ref_no');die('here');
			if($dash_ref_no == NULL ){
				$ref_no=$this->session->userdata('ref_no');
				//print_r($ref_no);die;
			}else{
		    	//$ref_no=$this->session->userdata('ref_no');
		    	//ref no coming from link url 
				$ref_no = $dash_ref_no;
			}

			$data['complainant_type'] = $this->common_model->getComplaint();
			$data['salution'] = $this->common_model->getSalution();
			$data['gender'] = $this->common_model->getGender();
			$data['nationality'] = $this->common_model->getNationality();
			$data['identityproof'] = $this->common_model->getIdentityproof();
			$data['residenceproof'] = $this->common_model->getResidence();
			$data['getcountry'] = $this->common_model->getCountry();
			$data['complaintmode'] = $this->common_model->getComplaintmode();
			$data['state'] = $this->common_model->getStateName();

			if($data['user']['role'] == 18){
				$data['mobilenopublic'] = $data['user']['mobile'];
			}else{
				$data['mobilenopublic'] = 0;
			}

			if($ref_no!=''){
				$data['farma'] = $this->common_model->getFormadata($ref_no);
			}

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['form_part'] = 'A';
			$ref_no = $this->session->set_userdata('ref_no',$ref_no);
			$data['ref_no'] = $ref_no;
	  //print_r($data['menus']->result());die('kk');
			$this->load->view('templates/front/CE_Header.php',$data);

			$this->load->view('filing/filing.php',$data);

			$this->load->view('templates/front/CE_Footer.php',$data);


		}
		else{
			redirect('admin/login'); 
		}

	}
	
	public function applet(){	
		$data['state'] = $this->common_model->getStateName();
	  //$data['district'] = $this->common_model->getStateName();
		$this->load->view('templates/front/CE_Header.php',$data);

		$this->load->view('filing/applet.php');

		$this->load->view('templates/front/CE_Footer.php',$data);

	}
	
	public function respondent(){	
		$data['state'] = $this->common_model->getStateName();
		$data['identity_document_type'] = $this->common_model->getDocument_type();

		$this->load->view('filing/respondent.php',$data);

	}
	
	
	public function validate_image($t,$parameter) {
		return $this->file_upload->validate_image($t,$parameter);
	}
	
/*
		public function re_validate_image() {
		$check = TRUE;
		if ((!isset($_FILES['a_affidavit_upload'])) || $_FILES['a_affidavit_upload']['size'] == 0) {

		$this->form_validation->set_message('re_validate_image', 'The Residence proof upload file size shoud not exceed 20MB!');
		$check = FALSE;
		}
		if(filesize($_FILES['a_affidavit_upload']['tmp_name']) > 20000000) {        	//echo "in size";die;
		$this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 20MB!');
		$check = FALSE;
		}
		if (isset($_FILES['a_affidavit_upload']) && $_FILES['a_affidavit_upload']['size'] != 0) {
		$allowedTypes = array('pdf', "PDF");
		$filename = $_FILES['a_affidavit_upload']['name'];
		$allowedExts = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($allowedExts, $allowedTypes)) {
		$this->form_validation->set_message('re_validate_image', 'Invalid Image Content!');
		$check = FALSE;
		}
		$extension = pathinfo($_FILES["a_affidavit_upload"]["name"], PATHINFO_EXTENSION);     
		$allowedExts = array("pdf", "PDF");      
		$detectedType = exif_imagetype($_FILES['a_affidavit_upload']['tmp_name']);    
		if(!in_array($extension, $allowedExts)) {     	
		$this->form_validation->set_message('re_validate_image', "Invalid file extension {$extension} only pdf allowed");
		$check = FALSE;
		}
		}
		return $check;
	}*/


	public function create()
	{
		$con = array( 
			'id' => $this->session->userdata('userId') 
		); 
		$data['user'] = $this->login_model->getRows($con);
		$userid=$data['user']['id']; 
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("common_helper");	
		$this->load->helper("parts_status_helper");	
		$data['state'] = $this->common_model->getStateName(); 
		$ref_no=$this->session->userdata('ref_no');


		if($ref_no !='')
		{


			//die('mod');
			
			$farmadata = $this->common_model->getFormadata($ref_no);
			$myArray=(array)$farmadata;


			
			if($ref_no!=''){
				$data['farma'] = $this->common_model->getFormadata($ref_no);
			}



			$ip = get_ip();
			$ip = $ip;

			$ts = date('Y-m-d H:i:s');
			$updated_at = $ts;
			$tsnew=date('Y-m-d');
			$t=date("H:i:s");         
			$new_name = time().'_'.$ref_no.'_'.$tsnew;

			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$userid=$data['user']['id'];
			$filename=$_FILES['identity_proof_upload']['name'];			
			$ext = substr($filename, -4, strrpos($filename, '.'));
			$filename = substr($filename, 0, strrpos($filename, '.'));
			$filename = str_replace(' ','',$filename);	
			$filename = str_replace('.','',$filename);	

			if(!empty($_FILES['identity_proof_upload']['name']))
			{        
				$config['upload_path']   = './cdn/identityforma/'; 
				$config['allowed_types'] = 'gif|jpg|pdf';      
				        //$config['max_size']      = 15000;
				$config['file_name'] = $new_name.$filename.$ext;
				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('identity_proof_upload'))
				{
					$error = array('error' => $this->upload->display_errors()); 

				}else
				{ 
					$uploadedImage = $this->upload->data();      
				} 
				$identity_url_parta='cdn/identityforma/'.$new_name.$filename.$ext;
			}      
			else
			{			    
				$identity_url_parta=$myArray[0]->identity_url_parta ?? '';
			} 

			$filename=$_FILES['a_affidavit_upload']['name'];
			$ext = substr($filename, -4, strrpos($filename, '.'));
			$filename = substr($filename, 0, strrpos($filename, '.'));
			$filename = str_replace(' ','',$filename);	
			$filename = str_replace('.','',$filename);
			if(!empty($_FILES['a_affidavit_upload']['name']))
			{        
				$config['upload_path']   = './cdn/residenceforma/'; 
				$config['allowed_types'] = 'gif|jpg|pdf';      
					        //$config['max_size']      = 15000;
				$config['file_name'] = $new_name.$filename;
				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('a_affidavit_upload'))
				{
					$error = array('error' => $this->upload->display_errors()); 

				}else
				{ 
					$uploadedImage = $this->upload->data();      
				} 
				$residence_url_parta='cdn/residenceforma/'.$new_name.$filename.$ext;
			}      
			else
			{ 						    
				$residence_url_parta=$myArray[0]->residence_url_parta ?? '';
			} 	



			$identity_proof_doi= ($this->input->post('identity_proof_doi'));
			if($identity_proof_doi !='')
			{
				$identity_proof_doi = get_entrydate($identity_proof_doi);
			}
			else
			{
				$identity_proof_doi = null;
			}			
			$idres_proof_doi= ($this->input->post('idres_proof_doi'));
			if($idres_proof_doi !='')
			{
				$idres_proof_doi = get_entrydate($idres_proof_doi);
			}
			else
			{
				$idres_proof_doi = null;
			}


			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('age_years', 'Age Years', 'required');
			$this->form_validation->set_rules('complaint_capacity_id', 'Complaint Type', 'required');
			$this->form_validation->set_rules('complaintmode_id', 'Complaint Mode', 'required');
			$this->form_validation->set_rules('gender_id', 'Gender', 'required');
			$this->form_validation->set_rules('nationality_id', 'Nationality', 'required');
			$this->form_validation->set_rules('identity_proof_id', 'Identity Proof', 'required');
			$this->form_validation->set_rules('p_state_id', 'Permanent State', 'required');
			$this->form_validation->set_rules('p_dist_id', 'Permanent District', 'required');
			$this->form_validation->set_rules('p_country_id', 'Permanent Country Name', 'required');
			$this->form_validation->set_rules('c_state_id', 'Correspondance State', 'required');
			$this->form_validation->set_rules('c_district_id', 'Correspondance District', 'required');
			$this->form_validation->set_rules('c_country_id', 'Correspondance Country Name', 'required');
			$this->form_validation->set_rules('idres_proof_id', 'Address Proof', 'required');
			$this->form_validation->set_rules('mob_no', 'Mobile No', 'required');
			$this->form_validation->set_rules('salutation_id', 'Mobile No', 'required');

			if(!empty($_FILES['a_affidavit_upload']['name']))
			{		
				$parameters = $_FILES['a_affidavit_upload']['name']."||".$_FILES['a_affidavit_upload']['size']."||".$_FILES['a_affidavit_upload']['tmp_name'];			
				$this->form_validation->set_rules('a_affidavit_upload', '', 'callback_validate_image['.$parameters.']');
			}
			
			if(!empty($_FILES['identity_proof_upload']['name']))
			{
				$parameters = $_FILES['identity_proof_upload']['name']."||".$_FILES['identity_proof_upload']['size']."||".$_FILES['identity_proof_upload']['tmp_name'];					
				$this->form_validation->set_rules('identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
			}

			if ($this->form_validation->run() == FALSE)
			{
				if($this->isUserLoggedIn) 
				{
					$con = array( 
						'id' => $this->session->userdata('userId') 
					); 
					$data['user'] = $this->login_model->getRows($con);
					$this->load->helper("date_helper");
					$data['complainant_type'] = $this->common_model->getComplaint();
					$data['salution'] = $this->common_model->getSalution();
					$data['gender'] = $this->common_model->getGender();
					$data['nationality'] = $this->common_model->getNationality();
					$data['identityproof'] = $this->common_model->getIdentityproof();
					$data['residenceproof'] = $this->common_model->getResidence();
					$data['getcountry'] = $this->common_model->getCountry();
					$data['complaintmode'] = $this->common_model->getComplaintmode();
					$data['state'] = $this->common_model->getStateName();
					if($data['user']['role'] == 18)
					{
						$data['mobilenopublic'] = $data['user']['mobile'];
					}
					else
					{
						$data['mobilenopublic'] = 0;
					}
					$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

					$data['form_part'] = 'A';
				 							//$this->load->view('templates/front/header2.php',$data);
					$this->load->view('templates/front/CE_Header.php',$data);
					$this->load->view('filing/filing.php',$data);
					$this->load->view('templates/front/CE_Footer.php',$data);
				}
				else
				{
					redirect('admin/login'); 
				}
			}
			else
			{

					     	//echo "here"; die;
				$curYear = date('Y');
				$cur_year=$curYear;			
				$ref_no=$ref_no;
				$user_id=$userid;
				$identity_url_parta=$identity_url_parta;
				$residence_url_parta=$residence_url_parta;
				$status='0';
				$complaint_capacity_id= ($this->input->post('complaint_capacity_id'));
				$complaintmode_id= ($this->input->post('complaintmode_id'));
				$salutation_id= ($this->input->post('salutation_id'));
				$sur_name= trim($this->input->post('sur_name'));
				$mid_name= trim($this->input->post('mid_name'));
				$first_name= trim($this->input->post('first_name'));
				$nationality_id=($this->input->post('nationality_id'));
				$gender_id= ($this->input->post('gender_id'));
				$age_years= trim($this->input->post('age_years'));
				$identity_proof_id= ($this->input->post('identity_proof_id'));
				$identity_proof_no= trim($this->input->post('identity_proof_no'));
				$identity_proof_doi=$identity_proof_doi;
				$identity_proof_vupto= trim($this->input->post('identity_proof_vupto'));	
				$identity_proof_iauth= trim($this->input->post('identity_proof_iauth'));
				$idres_proof_id= ($this->input->post('idres_proof_id'));
				$idres_proof_no= trim($this->input->post('idres_proof_no'));		
				$idres_proof_doi=$idres_proof_doi;
				$idres_proof_vupto= trim($this->input->post('idres_proof_vupto'));
				$idres_proof_iauth= trim($this->input->post('idres_proof_iauth'));
				$p_add1= trim($this->input->post('p_add1'));
				$p_hpnl= trim($this->input->post('p_hpnl'));
				$p_state_id= ($this->input->post('p_state_id'));
				$p_dist_id= ($this->input->post('p_dist_id'));
				$p_pin_code= trim($this->input->post('p_pin_code'));
				$p_country_id= ($this->input->post('p_country_id'));
				$c_add1= trim($this->input->post('c_add1'));
				$c_hpnl= trim($this->input->post('c_hpnl'));
				$c_state_id= ($this->input->post('c_state_id'));
				$c_district_id= ($this->input->post('c_district_id'));
				$c_pin_code= trim($this->input->post('c_pin_code'));
				$c_country_id= ($this->input->post('c_country_id'));
				$occu_desig_avo= trim($this->input->post('occu_desig_avo'));
				$tel_no= trim($this->input->post('tel_no'));
				$mob_no= trim($this->input->post('mob_no'));
				$email_id= trim($this->input->post('email_id'));
				$notory_affi_annex= ($this->input->post('notory_affi_annex')); 
				$complainant_victim= ($this->input->post('complainant_victim')); 
				$comp_f_place= trim($this->input->post('comp_f_place')); 
				$comp_f_date= ($this->input->post('comp_f_date'));
				$comp_f_date=get_entrydate($comp_f_date);
				$sys_date = date('Y-m-d');
			//if($comp_f_date!=$sys_date){
			//	die('date mismatch!');
			//}
				$fath_name= trim($this->input->post('fath_name'));
				$updated_at=$updated_at;

				$form_A_modify = array( 
					'filing_status'=>'0',	
					'complaint_capacity_id' => $complaint_capacity_id,
					'complaintmode_id' => $complaintmode_id,
					'salutation_id' => $salutation_id,
					'sur_name' => $sur_name,
					'mid_name' => $mid_name,
					'first_name' => $first_name,
					'nationality_id'=>$nationality_id,
					'gender_id' => $gender_id,
					'age_years' => $age_years,
					'identity_proof_id' => $identity_proof_id,
					'identity_proof_no' => $identity_proof_no,
					'identity_proof_doi' => $identity_proof_doi,
					'identity_proof_vupto' => $identity_proof_vupto,
					'identity_proof_iauth' => $identity_proof_iauth,
					'idres_proof_id' => $idres_proof_id,
					'idres_proof_no' => $idres_proof_no,
					'idres_proof_doi' => $idres_proof_doi,
					'idres_proof_vupto' => $idres_proof_vupto,
					'idres_proof_iauth' => $idres_proof_iauth,
					'p_add1' => $p_add1,
					'p_hpnl' => $p_hpnl,
					'p_state_id' => $p_state_id,
					'p_dist_id' => $p_dist_id,
					'p_pin_code' => $p_pin_code,
					'p_country_id' => $p_country_id,
					'c_add1' => $c_add1,
					'c_hpnl' => $c_hpnl,
					'c_state_id' => $c_state_id,
					'c_district_id' => $c_district_id,
					'c_pin_code' => $c_pin_code,
					'c_country_id' => $c_country_id,
					'occu_desig_avo' => $occu_desig_avo,
					'tel_no' => $tel_no,
					'mob_no' => $mob_no,
					'email_id' => $email_id,
					'notory_affi_annex' => $notory_affi_annex,
					'complainant_victim' => $complainant_victim,
					'comp_f_place' => $comp_f_place,
					'comp_f_date' => $comp_f_date,
					'ref_no'=>$ref_no,
					'fath_name'=>$fath_name,
					'cur_year'=>$curYear,
					'identity_url_parta'=>$identity_url_parta,
					'residence_url_parta'=>$residence_url_parta,
					'ip'=>$ip,
					'updated_at'=>$updated_at,
					'user_id'=>$userid,
				); 
				$data = $this->filing_model->insert_partA_his($ref_no);
				$data = $this->filing_model->modify_form_A_filing($form_A_modify, $user_id);
				if($complaint_capacity_id =='1')
				{
					redirect('/respondent/respondentfiling',$data);

				}
				else
				{
					redirect('/applet/appletfiling',$data);
				} 
			}
					     //die('modend');

		}
		else
		{

			/* code for first time entry */
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('age_years', 'Age Years', 'required');
			$this->form_validation->set_rules('complaint_capacity_id', 'Complaint Type', 'required');
			$this->form_validation->set_rules('complaintmode_id', 'Complaint Mode', 'required');
			$this->form_validation->set_rules('gender_id', 'Gender', 'required');
			$this->form_validation->set_rules('nationality_id', 'Nationality', 'required');
			$this->form_validation->set_rules('identity_proof_id', 'Identity Proof', 'required');
			$this->form_validation->set_rules('p_state_id', 'Permanent State', 'required');
			$this->form_validation->set_rules('p_dist_id', 'Permanent District', 'required');
			$this->form_validation->set_rules('p_country_id', 'Permanent Country Name', 'required');
			$this->form_validation->set_rules('c_state_id', 'Correspondance State', 'required');
			$this->form_validation->set_rules('c_district_id', 'Correspondance District', 'required');
			$this->form_validation->set_rules('c_country_id', 'Correspondance Country Name', 'required');
			$this->form_validation->set_rules('idres_proof_id', 'Address Proof', 'required');
			$this->form_validation->set_rules('mob_no', 'Mobile No', 'required');
			$this->form_validation->set_rules('salutation_id', 'Title', 'required');
			if(!empty($_FILES['a_affidavit_upload']['name']))
			{		
				$parameters = $_FILES['a_affidavit_upload']['name']."||".$_FILES['a_affidavit_upload']['size']."||".$_FILES['a_affidavit_upload']['tmp_name'];			
				$this->form_validation->set_rules('a_affidavit_upload', '', 'callback_validate_image['.$parameters.']');
			}

			if(!empty($_FILES['identity_proof_upload']['name']))
			{
				$parameters = $_FILES['identity_proof_upload']['name']."||".$_FILES['identity_proof_upload']['size']."||".$_FILES['identity_proof_upload']['tmp_name'];					
				$this->form_validation->set_rules('identity_proof_upload', '', 'callback_validate_image['.$parameters.']');
			}

			//array('required' => 'You must provide a %s.');
			if ($this->form_validation->run() == FALSE)
			{
				if($this->isUserLoggedIn) 
				{
					$con = array( 
						'id' => $this->session->userdata('userId') 
					); 
					$data['user'] = $this->login_model->getRows($con);

					$this->load->helper("date_helper");
					$data['complainant_type'] = $this->common_model->getComplaint();
					$data['salution'] = $this->common_model->getSalution();
					$data['gender'] = $this->common_model->getGender();
					$data['nationality'] = $this->common_model->getNationality();
					$data['identityproof'] = $this->common_model->getIdentityproof();
					$data['residenceproof'] = $this->common_model->getResidence();
					$data['getcountry'] = $this->common_model->getCountry();
					$data['complaintmode'] = $this->common_model->getComplaintmode();
					$data['state'] = $this->common_model->getStateName();

					if($data['user']['role'] == 18)
					{
						$data['mobilenopublic'] = $data['user']['mobile'];
					}
					else
					{
						$data['mobilenopublic'] = 0;
					}

					$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
					$data['form_part'] = 'A';
					$this->load->view('templates/front/CE_Header.php',$data);
					$this->load->view('filing/filing.php',$data);
					$this->load->view('templates/front/CE_Footer.php',$data);	
				}
				else
				{
					redirect('admin/login'); 
				}
			}
			else
			{
                	//die('succ');
                       // $this->load->view('formsuccess');



				$ref_no=$this->session->userdata('ref_no');	
				$ip = get_ip();
				$ip = $ip;
				$ts = date('Y-m-d H:i:s');
				$created_at = $ts;

				$tsnew=date('Y-m-d');
				$t=date("H:i:s");
				$new_name = time().'_'.$ref_no.'_'.$tsnew;
				$filename=$_FILES['identity_proof_upload']['name'];	

				$ext = substr($filename, -4, strrpos($filename, '.'));
				$filename = substr($filename, 0, strrpos($filename, '.'));
				$filename = str_replace(' ','',$filename);	
				$filename = str_replace('.','',$filename);			    
				if(!empty($_FILES['identity_proof_upload']['name']))
				{    	       
					$config['upload_path']   = './cdn/identityforma/'; 
					$config['allowed_types'] = 'gif|jpg|pdf';      
					        //$config['max_size']      = 15000;
					        // $config['file_name'] = $new_name;
					         $config['file_name'] = $new_name.$filename; //upload pdf name
					         $this->upload->initialize($config);
					         $this->load->library('upload', $config);
					         if ( ! $this->upload->do_upload('identity_proof_upload'))
					         {
					         	$error = array('error' => $this->upload->display_errors());          
					         }
					         else
					         { 
					         	$uploadedImage = $this->upload->data();      
					         } 
					         $identity_proof_upload='cdn/identityforma/'.$new_name.$filename.$ext;
					     }      
					     else
					     {
					     	$identity_proof_upload='';
					     } 

					      //echo $identity_proof_upload;die;
					     $filename=$_FILES['a_affidavit_upload']['name'];
					     $ext = substr($filename, -4, strrpos($filename, '.'));
					     $filename = substr($filename, 0, strrpos($filename, '.'));
					     $filename = str_replace(' ','',$filename);	
					     $filename = str_replace('.','',$filename);
					     if(!empty($_FILES['a_affidavit_upload']['name']))
					     {     

					     	$config['upload_path']   = './cdn/residenceforma/'; 
					     	$config['allowed_types'] = 'gif|jpg|pdf';      
					        //$config['max_size']      = 15000;
					     	$config['file_name'] = $new_name.$filename;
					     	$this->upload->initialize($config);
					     	$this->load->library('upload', $config);
					     	if ( ! $this->upload->do_upload('a_affidavit_upload'))
					     	{
					     		$error = array('error' => $this->upload->display_errors()); 

					     	}
					     	else
					     	{ 
					     		$uploadedImage = $this->upload->data();      
					     	} 
					     	$a_affidavit_upload='cdn/residenceforma/'.$new_name.$filename.$ext;
					     }      
					     else
					     {
					     	$a_affidavit_upload='';
					     } 

				           // $a_affidavit_upload;die;
					     $identity_proof_doi= ($this->input->post('identity_proof_doi'));
					     if($identity_proof_doi !='')
					     {
					     	$identity_proof_doi = get_entrydate($identity_proof_doi);
					     }
					     else
					     {
					     	$identity_proof_doi = null;
					     }

					     $idres_proof_doi= ($this->input->post('idres_proof_doi'));
					     if($idres_proof_doi !='')
					     {
					     	$idres_proof_doi = get_entrydate($idres_proof_doi);
					     }
					     else
					     {
					     	$idres_proof_doi = null;
					     }			

					     /*   code for ip  */

						//echo $nationality_id=($this->input->post('nationality_id'));die;

					     $curYear = date('Y');
					     $cur_year=$curYear;
					     $complaint_no=mt_rand();		
					     $ref_no=$complaint_no;						
					     $identity_url_parta=$identity_proof_upload;
					     $residence_url_parta=$a_affidavit_upload;
					     $status='0';
					     $complaint_capacity_id= ($this->input->post('complaint_capacity_id'));
					     $complaintmode_id= ($this->input->post('complaintmode_id'));
					     $salutation_id= ($this->input->post('salutation_id'));
					     $sur_name= trim($this->input->post('sur_name'));
					     $mid_name= trim($this->input->post('mid_name'));
					     $first_name= trim($this->input->post('first_name'));
					     $nationality_id=($this->input->post('nationality_id'));
					     $gender_id= ($this->input->post('gender_id'));
					     $age_years= trim($this->input->post('age_years'));
					     $identity_proof_id= ($this->input->post('identity_proof_id'));
					     $identity_proof_no= trim($this->input->post('identity_proof_no'));
					     $identity_proof_doi=$identity_proof_doi;
					     $identity_proof_vupto= trim($this->input->post('identity_proof_vupto'));	
					     $identity_proof_iauth= trim($this->input->post('identity_proof_iauth'));
					     $idres_proof_id= ($this->input->post('idres_proof_id'));
					     $idres_proof_no= trim($this->input->post('idres_proof_no'));			
					     $idres_proof_doi=$idres_proof_doi;
					     $idres_proof_vupto= trim($this->input->post('idres_proof_vupto'));	
					     $idres_proof_iauth= trim($this->input->post('idres_proof_iauth'));
					     $p_add1= trim($this->input->post('p_add1'));
					     $p_hpnl= trim($this->input->post('p_hpnl'));
					     $p_state_id= ($this->input->post('p_state_id'));
					     $p_dist_id= ($this->input->post('p_dist_id'));
					     $p_pin_code= trim($this->input->post('p_pin_code'));
					     $p_country_id= ($this->input->post('p_country_id'));
					     $c_add1= trim($this->input->post('c_add1'));
					     $c_hpnl= trim($this->input->post('c_hpnl'));
					     $c_state_id= ($this->input->post('c_state_id'));
					     $c_district_id= ($this->input->post('c_district_id'));
					     $c_pin_code= trim($this->input->post('c_pin_code'));
					     $c_country_id= ($this->input->post('c_country_id'));
					     $occu_desig_avo= trim($this->input->post('occu_desig_avo'));
					     $tel_no= trim($this->input->post('tel_no'));
					     $mob_no= trim($this->input->post('mob_no'));
					     $email_id= trim($this->input->post('email_id'));
					     $notory_affi_annex= ($this->input->post('notory_affi_annex')); 
					     $complainant_victim= ($this->input->post('complainant_victim')); 
					     $comp_f_place= trim($this->input->post('comp_f_place')); 
					     $comp_f_date= ($this->input->post('comp_f_date'));
					     $comp_f_date=get_entrydate($comp_f_date);
					     $sys_date = date('Y-m-d');
						//if($comp_f_date!=$sys_date){
							//die('date mismatch!');
						//}
					     $fath_name= trim($this->input->post('fath_name'));
					     $user_id=$userid;
					     $ip=$ip;
					     $created_at=$created_at;
					     $form_A_filing = array( 
					     	'filing_status'=>'0',	
					     	'complaint_capacity_id' => $complaint_capacity_id,
					     	'complaintmode_id' => $complaintmode_id,
					     	'salutation_id' => $salutation_id,
					     	'sur_name' => $sur_name,
					     	'mid_name' => $mid_name,
					     	'first_name' => $first_name,
					     	'nationality_id'=>$nationality_id,
					     	'gender_id' => $gender_id,
					     	'age_years' => $age_years,
					     	'identity_proof_id' => $identity_proof_id,
					     	'identity_proof_no' => $identity_proof_no,
					     	'identity_proof_doi' => $identity_proof_doi,
					     	'identity_proof_vupto' => $identity_proof_vupto,
					     	'identity_proof_iauth' => $identity_proof_iauth,
					     	'idres_proof_id' => $idres_proof_id,
					     	'idres_proof_no' => $idres_proof_no,
					     	'idres_proof_doi' => $idres_proof_doi,
					     	'idres_proof_vupto' => $idres_proof_vupto,
					     	'idres_proof_iauth' => $idres_proof_iauth,
					     	'p_add1' => $p_add1,
					     	'p_hpnl' => $p_hpnl,
					     	'p_state_id' => $p_state_id,
					     	'p_dist_id' => $p_dist_id,
					     	'p_pin_code' => $p_pin_code,
					     	'p_country_id' => $p_country_id,
					     	'c_add1' => $c_add1,
					     	'c_hpnl' => $c_hpnl,
					     	'c_state_id' => $c_state_id,
					     	'c_district_id' => $c_district_id,
					     	'c_pin_code' => $c_pin_code,
					     	'c_country_id' => $c_country_id,
					     	'occu_desig_avo' => $occu_desig_avo,
					     	'tel_no' => $tel_no,
					     	'mob_no' => $mob_no,
					     	'email_id' => $email_id,
					     	'notory_affi_annex' => $notory_affi_annex,
					     	'complainant_victim' => $complainant_victim,
					     	'comp_f_place' => $comp_f_place,
					     	'comp_f_date' => $comp_f_date,
					     	'ref_no'=>$ref_no,
					     	'fath_name'=>$fath_name,
					     	'cur_year'=>$curYear,
					     	'identity_url_parta'=>$identity_proof_upload,
					     	'residence_url_parta'=>$a_affidavit_upload,
					     	'user_id'=>$userid,
					     	'flag'=>'EF',
					     	'ip'=>$ip,
					     	'created_at'=>$created_at,						
					     );
					     $data = $this->filing_model->add_form_A_filing($form_A_filing);

//$datacomplaint= $this->filing_model->getComplaintno($ref_no);   //why
					     $this->session->set_userdata('ref_no',$ref_no);
					     $this->load->view('filing/filing');
					     if($complaint_capacity_id =='1')
					     {
					     	redirect('/respondent/respondentfiling',$data);

					     }
					     else
					     {
					     	redirect('/applet/appletfiling',$data);
					     } 

					 }
					}
				}



				public function getdistrict()
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

				public function destroy_filing_session()
				{
					$this->session->unset_userdata('ref_no');
					redirect('filing/filing');
				}


				public function check_pending_complaints()
				{
					if($this->isUserLoggedIn) 
					{
					$con = array( 
					'id' => $this->session->userdata('userId') 
					); 
					$data['user'] = $this->login_model->getRows($con);

						//echo $data['user']['id'];die;
					$is_pending = $this->filing_model->get_pub_pen_count($data['user']['id']);
					$this->session->unset_userdata('ref_no');
					echo json_encode(array('is_pending' => $is_pending));

					}



					else
					{
					redirect('user/login'); 
					}



				}


  /* ysc code for reentry 26072021 */

  public function dashboard_re_entry_complaint()
	{
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['user_comps'] = $this->filing_model->get_re_entry_complaints($data['user']['id']);
			$this->load->view('templates/front/CE_Header.php',$data);
			// ysc change for dashboard $this->load->view('filing/dashboard.php',$data);
			$this->load->view('filing/dashboard.php',$data);					
			$this->load->view('templates/front/CE_Footer.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}

	}


	public function dashboard_edit_complaint()
	{
		
		if($this->isUserLoggedIn) 
		{
			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['user_comps'] = $this->filing_model->get_user_complaints($data['user']['id']);
			$this->load->view('templates/front/CE_Header.php',$data);
			// ysc change for dashboard $this->load->view('filing/dashboard.php',$data);
			$this->load->view('filing/dashboard.php',$data);					
			$this->load->view('templates/front/CE_Footer.php',$data);
		}
		else
		{
			redirect('user/login'); 
		}

	}
}