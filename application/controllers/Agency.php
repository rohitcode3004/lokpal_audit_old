<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agency extends CI_Controller {
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
		$this->load->model('proceeding_model');
		$this->load->model('agency_model');
		$this->load->model('report_model');
		$this->load->model('filing_model');
		$this->load->helper("parts_status_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("common_helper");
		$this->load->helper("bench_helper");
		$this->load->library('html2pdf');
		$this->load->library('label');
		$this->load->helper("date_helper");
		$this->load->helper("proceeding_helper");
	}

	public function dashboard()
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['agency_data'] = $this->agency_model->get_agency_data($data['user']['role']);

	  		//print_r($data['user_comps']);die('kk');
		//$this->load->view('templates/front/header2.php',$data);
		$this->load->view('templates/front/AG_Header.php',$data);
		$this->load->view('agency/dashboard.php',$data);
		$this->load->view('templates/front/CE_Footer.php',$data);
	}

	public function dashboard_main()
	{	

		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['agntot_comps'] = $this->agency_model->get_agency_tot_count($data['user']['role']);
		$data['agnpen_comps'] = $this->agency_model->get_agency_pen_count($data['user']['role']);
		$data['agndon_comps'] = $this->agency_model->get_agency_don_count($data['user']['role']);

	  		//print_r($data['user_comps']);die('kk');

			//$this->load->view('templates/front/header2.php',$data);
		$this->load->view('templates/front/AG_Header.php',$data);
		$this->load->view('agency/dashboard_main.php',$data);
		$this->load->view('templates/front/CE_Footer.php',$data);
		
	}

	public function inquiry_investigation(){	

		if($this->input->post('filing_no'))
		{
			$data['user'] = $this->login_model->getRows($this->con);


			
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;
			$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
			$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);	

			$this->load->view('templates/front/AG_Header.php',$data);
			$this->load->view('agency/inquiry_agency.php',$data);
			$this->load->view('templates/front/CE_Footer.php',$data);
		}else
		{
			redirect('/agency/dashboard');
		}
		
	}

	public function agency_action(){
		$con = array( 
			'id' => $this->session->userdata('userId') 
		); 
		$data['user'] = $this->login_model->getRows($con);
		$userid=$data['user']['id']; 

		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("common_helper");	
		$this->load->helper("parts_status_helper");	
		$filing_no= ($this->input->post('filing_no'));

		$agencydata= $this->agency_model->getAgencydata($filing_no);
		$ct=count($agencydata);
		if($ct > 0)
		{
			//echo "second";die();
			$dataAgency=(array)$agencydata;
			$agency_counter=$dataAgency[0]->agency_counter;

			$agency_counter=$agency_counter+1;
			$flag=1;

			$query11 = $this->agency_model->insert_agency_data_his($filing_no);

			$query12 = $this->agency_model->delete_agencydata($filing_no);
       	//echo "<pre>";
       	//print_r($agencydata);


			$con = array( 
				'id' => $this->session->userdata('userId') 
			); 
			$data['user'] = $this->login_model->getRows($con);
			$userid=$data['user']['id'];

			$report_upload=$_FILES['report_upload']['name'];
			if(!empty($_FILES['report_upload']['name']))
			{ 

				$config['upload_path']   = './cdn/agencyupload/'; 
				$config['allowed_types'] = 'pdf';      
				//$config['max_size']      = 15000;
				$config['file_name'] = 'agency_order_'.$filing_no.'_'.$agency_counter.'.pdf';
				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('report_upload'))
				{
					$error = array('error' => $this->upload->display_errors()); 					
				}else
				{ 
					$uploadedImage = $this->upload->data();      
				} 
				$report_upload=$report_upload;
			}			
			else
			{
				$report_upload=$myArray[0]->report_upload ?? '';
			}


			$forwarding_letter_upload=$_FILES['forwarding_letter_upload']['name'];
			if(!empty($_FILES['forwarding_letter_upload']['name']))
			{ 

				$config['upload_path']   = './cdn/agency_forwarding_letter/'; 
				$config['allowed_types'] = 'pdf';      
				//$config['max_size']      = 15000;
				$config['file_name'] = 'agency_forwarding_letter_'.$filing_no.'_'.$agency_counter.'.pdf';
				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('forwarding_letter_upload'))
				{
					$error = array('error' => $this->upload->display_errors()); 					
				}else
				{ 
					$uploadedImage = $this->upload->data();      
				} 
				$forwarding_letter_upload=$forwarding_letter_upload;
			}			
			else
			{
				$forwarding_letter_upload=$myArray[0]->forwarding_letter_upload ?? '';
			}





			$dt_submission= ($this->input->post('dt_submission'));
			if($dt_submission !='')
			{
				$dt_submission = get_entrydate($dt_submission);
			}
			else
			{
				$dt_submission = null;
			} 

		  $dt_of_dispatched= ($this->input->post('dt_of_dispatched'));
			if($dt_of_dispatched !='')
			{
				$dt_of_dispatched = get_entrydate($dt_of_dispatched);
			}
			else
			{
				$dt_of_dispatched = null;
			} 



			$ip = get_ip();
			$ip = $ip;
			$ts = date('Y-m-d H:i:s');
			$updated_at = $ts;   			
			$agency_counter=$agency_counter;
			$dt_submission=$dt_submission;
			$filing_no= ($this->input->post('filing_no'));
			$bench_code= ($this->input->post('bench_code'));
			$listing_date= ($this->input->post('listing_date'));
			$bench_no= ($this->input->post('bench_no'));
			$court_no= ($this->input->post('court_no'));
			$ordertype_code= ($this->input->post('ordertype_code'));
			$agency_code= ($this->input->post('agency_code'));
			$team_lead_nm= ($this->input->post('team_lead_nm'));			
			$contact_no= ($this->input->post('contact_no'));			
			$email_id= ($this->input->post('email_id'));			
			$report_content= ($this->input->post('report_content'));
			$report_upload ='cdn/agencyupload/agency_order_'.$filing_no.'_'.$agency_counter.'.pdf';
			$forwarding_letter_upload ='cdn/agency_forwarding_letter/agency_order_'.$filing_no.'_'.$agency_counter.'.pdf';
			$user_id=$userid;
			$ip=$ip;
			$updated_at=$updated_at;			
			$flag=$flag;

			$bench_details = get_current_bench_details($listing_date, $filing_no, $bench_no);
			//print_r($bench_details[0]->bench_id);die;
			

			$agency_data_add = array(
				'agency_counter'=>$agency_counter,				
				'dt_submission'=>$dt_submission,
				'filing_no'=>$filing_no,
				'bench_code'=>$bench_code,
				'listing_date'=>$listing_date,
				'bench_no'=>$bench_no,
				'court_no'=>$court_no,
				'ordertype_code'=>$ordertype_code,
				'agency_code'=>$agency_code,
				'team_lead_nm'=>$team_lead_nm,
				'contact_no'=>$contact_no,
				'email_id'=>$email_id,
				'report_content'=>$report_content,
				'report_upload' => 'cdn/agencyupload/agency_order_'.$filing_no.'_'.$agency_counter.'.pdf',	
				'forwarding_letter_upload' => 'cdn/agency_forwarding_letter/agency_forwarding_letter_'.$filing_no.'_'.$agency_counter.'.pdf',				
				'user_id'=>$userid,
				'ip'=>$ip,
				'updated_at'=>$updated_at,				
				'flag'=>$flag,
				'dt_of_dispatched'=>$dt_of_dispatched,

			);

			//$data = $this->agency_model->modify_agency_data($agency_data_modify, $user_id,$filing_no);
			$agencydata = $this->agency_model->add_agency_data($agency_data_add);
			
			/*if($data)
				{ 
 					 $this->session->set_flashdata('success_msg', 'Agency data has been successfully modified.'); 
				} 
				redirect('/agency/inquiry_investigation',$data); */


				if($agencydata)
				{ 
					$upd_data = array(
						'action' => 't',
						'updated_at' => $ts,
					);
					$query2 = $this->agency_model->upd_proce($filing_no, $upd_data);

								//$query4 = $this->agency_model->casedethis_insert($filing_no);

								/*$upd_data2 = array(
									'listed' => 'f',
									'updated_date' => $ts,
								);*/
								//$query3 = $this->agency_model->upd_casedet($filing_no, $upd_data2);

								//new code
								//$listing_data = array( 
								//'filing_no'=>$filing_no,
								//'listing_date'=>$from_list_date,	
								//'created_at' => $ts,
								//'user_id' => $user_id,
								//'bench_no'=>$bench_details[0]->bench_no,				
								//'bench_id'=>$bench_details[0]->bench_id,
								//'recieved_from'=>'A', 					
								//'court_no'=>$court_no,	
								//'bench_nature' => $bench_nature,			
								//);
								//$query3 = $this->bench_model->complaint_listing($listing_data);

								if($query2){
									$this->session->set_flashdata('success_msg', 'Agency data has been successfully added.');
									redirect('agency/dashboard');
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem updating in proceeding model');
									redirect('agency/dashboard');
								}

							} 
							else{
								//die('problem inserting in proceeding model');
								$this->session->set_flashdata('error_msg', 'Some problem inserting in agency model');
								die('j');
								redirect('/agency/dashboard');
							}




						}

						else
						{
       	//echo "first";die();

							$report_upload=$_FILES['report_upload']['name'];
							$agency_counter=1;
							if(!empty($_FILES['report_upload']['name']))
							{       

								$config['upload_path']   = './cdn/agencyupload/';  
								$config['allowed_types'] = 'gif|jpg|png|pdf';      
				//$config['max_size']      = 15000;				
								$config['file_name'] = 'agency_order_'.$filing_no.'_'.$agency_counter.'.pdf';
								$this->upload->initialize($config);
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('report_upload'))
								{
									$error = array('error' => $this->upload->display_errors()); 

								}else
								{ 
									$uploadedImage = $this->upload->data();      
								} 
								$report_upload=$report_upload;
							}			
							else
							{
								$report_upload=$myArray[0]->report_upload ?? '';
							} 


							$forwarding_letter_upload=$_FILES['forwarding_letter_upload']['name'];
							$agency_counter=1;
							if(!empty($_FILES['forwarding_letter_upload']['name']))
							{       

								$config['upload_path']   = './cdn/agency_forwarding_letter/';  
								$config['allowed_types'] = 'gif|jpg|png|pdf';      
				//$config['max_size']      = 15000;				
								$config['file_name'] = 'agency_forwarding_letter_'.$filing_no.'_'.$agency_counter.'.pdf';
								$this->upload->initialize($config);
								$this->load->library('upload', $config);
								if ( ! $this->upload->do_upload('forwarding_letter_upload'))
								{
									$error = array('error' => $this->upload->display_errors()); 

								}else
								{ 
									$uploadedImage = $this->upload->data();      
								} 
								$forwarding_letter_upload=$forwarding_letter_upload;
							}			
							else
							{
								$forwarding_letter_upload=$myArray[0]->forwarding_letter_upload ?? '';
							}



							$dt_submission= ($this->input->post('dt_submission'));
							if($dt_submission !='')
							{
								$dt_submission = get_entrydate($dt_submission);
							}
							else
							{
								$dt_submission = null;
							}

							$dt_of_dispatched= ($this->input->post('dt_of_dispatched'));
							if($dt_of_dispatched !='')
							{
								$dt_of_dispatched = get_entrydate($dt_of_dispatched);
							}
							else
							{
								$dt_of_dispatched = null;
							}


							$ip = get_ip();
							$ip = $ip;
							$ts = date('Y-m-d H:i:s');
							$created_at = $ts;


							$flag=1;


							$dt_submission=$dt_submission;
							$filing_no= ($this->input->post('filing_no'));
							$bench_code= ($this->input->post('bench_code'));
							$listing_date= ($this->input->post('listing_date'));
							$bench_no= ($this->input->post('bench_no'));
							$court_no= ($this->input->post('court_no'));
							$ordertype_code= ($this->input->post('ordertype_code'));
							$agency_code= ($this->input->post('agency_code'));
							$team_lead_nm= ($this->input->post('team_lead_nm'));			
							$contact_no= ($this->input->post('contact_no'));			
							$email_id= ($this->input->post('email_id'));			
							$report_content= ($this->input->post('report_content'));
							$report_upload ='cdn/agencyupload/agency_order_'.$filing_no.'_'.$agency_counter.'.pdf';
							$forwarding_letter_upload ='cdn/agency_forwarding_letter/agency_forwarding_letter_'.$filing_no.'_'.$agency_counter.'.pdf';
							$user_id=$userid;
							$ip=$ip;
							$created_at=$created_at;
							$agency_counter=$agency_counter;
							$flag=$flag;
							$dt_of_dispatched=$dt_of_dispatched;


							$bench_details = get_current_bench_details($listing_date, $filing_no, $bench_no);
			//print_r($bench_details[0]->bench_id);die;

							$agency_data_add = array( 				
								'dt_submission'=>$dt_submission,
								'filing_no'=>$filing_no,
								'bench_code'=>$bench_code,
								'listing_date'=>$listing_date,
								'bench_no'=>$bench_no,
								'court_no'=>$court_no,
								'ordertype_code'=>$ordertype_code,
								'agency_code'=>$agency_code,
								'team_lead_nm'=>$team_lead_nm,
								'contact_no'=>$contact_no,
								'email_id'=>$email_id,
								'report_content'=>$report_content,				
								'report_upload' => 'cdn/agencyupload/agency_order_'.$filing_no.'_'.$agency_counter.'.pdf',	
								'forwarding_letter_upload' => 'cdn/agency_forwarding_letter/agency_forwarding_letter_'.$filing_no.'_'.$agency_counter.'.pdf',			
								'user_id'=>$userid,
								'ip'=>$ip,
								'created_at'=>$created_at,
								'agency_counter'=>$agency_counter,
								'flag'=>$flag,
								'dt_of_dispatched'=>$dt_of_dispatched,			
							);
							$agencydata = $this->agency_model->add_agency_data($agency_data_add);
							if($agencydata)
							{ 
								$upd_data = array(
									'action' => 't',
									'updated_at' => $ts,
								);
								$query2 = $this->agency_model->upd_proce($filing_no, $upd_data);

								//$query4 = $this->agency_model->casedethis_insert($filing_no);

								/*$upd_data2 = array(
									'listed' => 'f',
									'updated_date' => $ts,
								);*/
								//$query3 = $this->agency_model->upd_casedet($filing_no, $upd_data2);

								//$listing_data = array( 
								//'filing_no'=>$filing_no,
								//'listing_date'=>$from_list_date,	
								//'created_at' => $ts,
								//'user_id' => $user_id,
								//'bench_no'=>$bench_details[0]->bench_no,				
								//'bench_id'=>$bench_details[0]->bench_id,
								//'recieved_from'=>'A', 			
								//'court_no'=>$court_no,	
								//'bench_nature' => $bench_nature,			
								//);
								//$query3 = $this->bench_model->complaint_listing($listing_data);


								if($query2){
									$this->session->set_flashdata('success_msg', 'Agency data has been successfully added.');
									redirect('agency/dashboard');
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem updating in proceeding model');
									redirect('agency/dashboard');
								}

							} 
							else{
								//die('problem inserting in proceeding model');
								$this->session->set_flashdata('error_msg', 'Some problem inserting in agency model');
								die('j');
								redirect('/agency/dashboard');
							}
						}	

					}

				}