	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Proceeding extends CI_Controller {

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
			$this->load->model('proceeding_model');
			$this->load->model('bench_model');
			$this->load->model('agency_model');
			$this->load->model('case_detail_model');
			$this->load->model('scrutiny_model');
			//$this->load->model('report_model');
			//$this->load->model('filing_model');
			//$this->load->helper("parts_status_helper");
			$this->load->helper("compno_helper");
			$this->load->helper("bench_helper");
			$this->load->helper("common_helper");
			$this->load->helper("report_helper");
			//$this->load->library('html2pdf');
			$this->load->library('label');
			$this->load->helper("date_helper");
			$this->load->helper("proceeding_helper");
			$this->load->helper("scrutiny_helper");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
		}


		public function dashboard($bench_no=null, $flag=null)
		{	
			$data['user'] = $this->login_model->getRows($this->con);

	            //print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			if($data['user']['id'] != 1308 && $data['user']['role'] == 147) { //means its not a courtmaster but benchuser

				$data['logged_judge_code'] = get_logged_judge_code($data['user']['id']);
			//echo $logged_judge_code;die;
			}
			if($data['user']['role'] == 170){     //means its a pps
				$data['logged_judge_code'] = get_logged_judge_code_pps($data['user']['id']);
			}
			
			$bid_array = get_bench_ids_bybno($bench_no);
			$data['allocated_data'] = $this->proceeding_model->get_allocated_data($bid_array, $flag);
			$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pen_complaints_bench($data['user']['role'], $data['user']['id']);

			$data['purpose_type'] = $this->bench_model->fetch_purpose_type();
			$data['venues'] = $this->bench_model->fetch_venues();
			$data['flag_case'] = $flag;
			$data['bench_no'] = $bench_no;

		  		//print_r($data['user_comps']);die('kk');
			//$this->load->view('templates/front/header2.php',$data);
			$this->load->view('templates/front/CM_Header.php',$data);

			$this->load->view('proceeding/dashboard.php',$data);

			$this->load->view('templates/front/CE_Footer.php',$data);

		}

		public function dashboard_main()
		{	

			$data['user'] = $this->login_model->getRows($this->con);

			//print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			//$data['procetot_comps'] = $this->proceeding_model->get_proce_tot_count();
			//$data['procepen_comps'] = $this->proceeding_model->get_proce_pen_count();
			//$data['procedon_comps'] = $this->proceeding_model->get_proce_don_count();
			if($data['user']['id'] != 1308 && $data['user']['role'] == 147) { //means its not a courtmaster but benchuser

			$data['logged_judge_code'] = get_logged_judge_code($data['user']['id']);
			//echo $logged_judge_code;die;
			}
			if($data['user']['role'] == 170){     //means its a pps
				$data['logged_judge_code'] = get_logged_judge_code_pps($data['user']['id']);
			}

			$data['all_benches'] = $this->proceeding_model->get_all_benches();

			  //print_r($data['user_comps']);die('kk');

			//$this->load->view('templates/front/header2.php',$data);

			//$this->load->view('proceeding/dashboard_benchno.php',$data);

			$this->load->view('templates/front/CM_Header.php',$data);

			$this->load->view('proceeding/dashboard_main.php',$data);

			$this->load->view('templates/front/CE_Footer.php',$data);
			
		}

		public function dashboard_main_level2($bench_no=null)
		{	

			$data['user'] = $this->login_model->getRows($this->con);

			//print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$bid_array = get_bench_ids_bybno($bench_no);
			$data['allocated_data_count'] = $this->proceeding_model->get_allocated_data_count($bid_array);
			$data['inq_data_count'] = $this->proceeding_model->get_inq_data_count($bid_array);
			$data['inv_data_count'] = $this->proceeding_model->get_inv_data_count($bid_array);

			//$data['scrpen_comps_count'] = $this->scrutiny_model->get_scrutiny_pen_complaints_bench_count($data['user']['role'], $data['user']['id']);
			$data['agency_data_count'] = $this->agency_model->get_agency_data_bench_count();

			$data['inq_report_count'] = $this->proceeding_model->get_inq_report_count($bid_array);
			$data['inv_report_count'] = $this->proceeding_model->get_inv_report_count($bid_array);

			/*ysc code start 8july */

			$data['ops_inq_report_count'] = $this->proceeding_model->get_ops_inq_report_count($bid_array);
			$data['ops_inv_report_count'] = $this->proceeding_model->get_ops_inv_report_count($bid_array);
			$data['aoa_report_count'] = $this->proceeding_model->get_aoa_report_count($bid_array);

			/*ysc code end 8jul */


			$data['bench_no'] = $bench_no;

			  //print_r($data['user_comps']);die('kk');

			//$this->load->view('templates/front/header2.php',$data);

			//$this->load->view('proceeding/dashboard_main.php',$data);

			$this->load->view('templates/front/CM_Header.php',$data);

			$this->load->view('proceeding/dashboard_main_level2.php',$data);

			$this->load->view('templates/front/CE_Footer.php',$data);
			
		}

		public function proceeding_form(){	
			//print_r($_POST);die;
			$details = (explode("||",$this->input->post('filing_no')));	
				$filing_no = $details[0];
				$listing_date = $details[1];
				$bench_id = $details[2];
				$bench_no = $details[3];
				$flag = $details[4];
				$recieved_from = $details[5];
			if($this->input->post('filing_no') && $filing_no!='' && $listing_date!='' && $bench_id!='')
				{
				$details = (explode("||",$this->input->post('filing_no')));	
				$filing_no = $details[0];
				$listing_date = $details[1];
				$bench_id = $details[2];
			$data['user'] = $this->login_model->getRows($this->con);	
				
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			//$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;
			//$listing_date = $this->input->post('listing_date');
			$data['listing_date'] = $listing_date;
			//$bench_no = $this->input->post('bench_no');
			//echo $bench_no;die;
			$data['bench_no'] = $bench_no;
			$data['flag'] = $flag;
			//$bench_id = $this->input->post('bench_id');
			//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
			//$data['bench_nature'] = $bench_nature;
					$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);
					//print_r($last_remarks);die;
			if(isset($last_remarks[0]->summary))
					$data['summary'] = $last_remarks[0]->summary;
			$data['previous_complaint_description'] = $this->scrutiny_model->get_previous_complaint_description($filing_no);
			if(isset($last_remarks[0]->remarks))
					$data['last_remarks'] = $last_remarks[0]->remarks;
			
			if(isset($last_remarks[0]->remarkd_by))
				$last_remarkedby_name = $this->scrutiny_model->get_last_rem_name($last_remarks[0]->remarkd_by);

			if(!empty($last_remarkedby_name))
					$data['last_remarkedby'] = $last_remarkedby_name[0]->display_name;

			$remarks_history = $this->scrutiny_model->get_rem_his($filing_no);


			if(!empty($remarks_history)){
				if($remarks_history[0]->remarks)
					$data['remark_history'] = $this->scrutiny_model->get_rem_his($filing_no);
					//print_r($data['remark_ history']);die;
			}

			//print_r($listing_date);
			//print_r($filing_no);
			//print_r($bench_no);
			$bench_details = get_current_bench_details($listing_date, $filing_no, $bench_id);
			if($recieved_from != null){
				$data['recieved_from'] = $recieved_from;
			}else{
				$data['recieved_from'] = $bench_details[0]->recieved_from;
			}

			$coram = get_coram($bench_id);
			$data['coram'] = $coram;
			//print_r($bench_nature);
			//print("<pre>".print_r($coram,true)."</pre>");die;
					//getting bench histories
			$all_benches = get_coram_all($filing_no);
			//print("<pre>".print_r($all_benches,true)."</pre>");die;
			//$coram = get_coram($listing_date, $bench_no);
			$data['all_benches'] = $all_benches;

			$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
			$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);

			$ot_array = array();
			$previous_ot = $this->proceeding_model->get_proc_count($filing_no);
			$previous_ot_his = $this->proceeding_model->get_proceeding_his($filing_no);
			//print_r($previous_ot_his);die;
			if($previous_ot_his != 0){
			foreach($previous_ot_his as $row):
				array_push($ot_array,$row->ordertype_code);
			endforeach;
			}
			//echo $filing_no.'\n';
			//print_r($ot_array);die;

			if($previous_ot != 0){
				$previous_ot = $previous_ot[0]->ordertype_code;
				array_push($ot_array,$previous_ot);
			}

			if(in_array(2, $ot_array) && (!in_array(1, $ot_array)))
				array_push($ot_array, 1);

			$data['order_type'] = $this->proceeding_model->fetch_order_type($ot_array);
			$data['other_action'] = $this->proceeding_model->fetch_other_action($ot_array);
			$this->load->view('templates/front/CM_Header.php',$data);
			$this->load->view('proceeding/proceeding.php',$data);
			$this->load->view('templates/front/CE_Footer.php',$data);
			}else
				{
					redirect('/proceeding/dashboard/'.$bench_no.'/'.$flag);
				}	
		}

		function get_concer_agency()
		{
			if($this->input->post('order_type')){
				$ot = $this->input->post('order_type');
				//print_r($ot);die();
				$concer_agency = $this->proceeding_model->fetch_concer_agency($ot);
				echo json_encode($concer_agency);
			}else{
				die('no post value found');
			}
		}

		function get_ps_data()
		{
			if($this->input->post('filing_no')){
				$fn = $this->input->post('filing_no');
				//print_r($fn);die;
				$ps_details = $this->proceeding_model->fetch_psdet($fn);
				//print_r($ps_details[0]->ps_salutation_id);die();
				$fullname = get_fullname($ps_details[0]->ps_salutation_id, $ps_details[0]->ps_first_name, $ps_details[0]->ps_mid_name , $ps_details[0]->ps_sur_name);
				//print_r($fullname);die;
				$result_array['fullname']=$fullname;
			    $result_array['desg']=$ps_details[0]->ps_desig;
			    $result_array['org']=$ps_details[0]->ps_orgn;
				echo json_encode($result_array);
			}else{
				die('no post value found');
			}
		}

		function action()
		{
			$this->form_validation->set_rules('order_date', 'Order Date', 'required');
	        $this->form_validation->set_rules('order_type', 'Order Type', 'required',
	                        array('required' => 'You must provide a %s.')
	                );
	        //$this->form_validation->set_rules('conce_agency', 'Concern Agency', 'required');
	        //$this->form_validation->set_rules('order_body', 'Order Body', 'required');

			if ($this->form_validation->run() == FALSE){
				$data['user'] = $this->login_model->getRows($this->con);	
					
				$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$data['filing_no'] = $filing_no;
				$listing_date = $this->input->post('listing_date');
				$data['listing_date'] = $listing_date;
				$bench_no = $this->input->post('bench_no');
				$data['bench_no'] = $bench_no;
				$flag = $this->input->post('flag');
				$bench_id = $this->input->post('bench_id');
				//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
				//$data['bench_nature'] = $bench_nature;

				$coram = get_coram($bench_id);
				$data['coram'] = $coram;
				//print_r($bench_nature);
				//print("<pre>".print_r($coram,true)."</pre>");die;

				$data['order_type'] = $this->proceeding_model->fetch_order_type();
				$this->load->view('proceeding/proceeding.php',$data);
			}
			else
			{
				$order_date = trim($this->security->xss_clean($this->input->post('order_date')));
				$order_date = get_entrydate($order_date);
				$order_type = trim($this->security->xss_clean($this->input->post('order_type')));
				$order_body = trim($this->security->xss_clean($this->input->post('order_body')));
				$remarks = trim($this->security->xss_clean($this->input->post('remarks')));
				$due_date = trim($this->security->xss_clean($this->input->post('duedate')));
				if($due_date != '')
					$due_date = get_entrydate($due_date);
				else
					$due_date = NULL;
					$conce_agency = NULL;
					$other_agn = NULL;
					$closure_sec = NULL;
					$others_ordertype = NUll;
					$other_action = NULL;
					$additional_documents = NULL;
					$status_rep_dept = NULL;

				if($order_type == 1 || $order_type == 2)
					$conce_agency = trim($this->security->xss_clean($this->input->post('conce_agency')));

				if($order_type == 5 || $order_type == 8 || $order_type == 9)
					$closure_sec = trim($this->security->xss_clean($this->input->post('closure_type')));

				if($closure_sec == 'yes')
					$closure_sec = 46;

				if($conce_agency == 4 || $conce_agency == 8)
					$other_agn = trim($this->security->xss_clean($this->input->post('other_agency_name')));

				if($order_type == 14){
					$other_action = trim($this->security->xss_clean($this->input->post('other_action')));
					if($other_action == 6)
						$others_ordertype = trim($this->security->xss_clean($this->input->post('others_ordertype')));
					if($other_action == 13)
						$additional_documents = trim($this->security->xss_clean($this->input->post('additional_doc')));
					if($other_action == 12)
						$status_rep_dept = trim($this->security->xss_clean($this->input->post('status_rep_dept')));
				}
				$flag='F';
				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$listing_date = trim($this->security->xss_clean($this->input->post('listing_date')));
				//print_r($listing_date);die;
				//$listing_date = get_entrydate($listing_date);
				$bench_no = trim($this->security->xss_clean($this->input->post('bench_no')));
				//echo $bench_no;die;
				$bench_id = trim($this->security->xss_clean($this->input->post('bench_id')));
				//$bench_nature = trim($this->security->xss_clean($this->input->post('bench_nature')));
				//$court_no = trim($this->security->xss_clean($this->input->post('court_no')));
				$complaint_no = trim($this->security->xss_clean($this->input->post('complaint_no')));

				$data['user'] = $this->login_model->getRows($this->con);
			    $user_id=$data['user']['id'];
				//$purpose = ;
				$ts = date('Y-m-d H:i:s', time());
				$created_at = $ts;
				//$updated_at = ;
				$ip = get_ip();

				if($order_type == 4){
				$proceeding_count = $this->proceeding_model->get_proc_count($filing_no);
				//print_r($proceeding_count);die;
				$proceeding_count = $proceeding_count[0]->proceeding_count;
				//die($proceeding_count);
				if($proceeding_count == '')
					$proceeding_count = 1;
				else
					$proceeding_count = $proceeding_count+1;
					//echo $proceeding_count;die;

			$config['upload_path']   = './cdn/proceeding_order/'; 
	        $config['allowed_types'] = 'pdf'; 
	        //$config['max_size']      = 2000; 
	        $config['file_name'] = 'proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf';

	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('order_upload')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            //print_r($error['error']);die;
	            $this->session->set_flashdata('upload_error', $error['error']);
	            redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }

							$next_date = trim($this->security->xss_clean($this->input->post('adj_date')));
							$next_date = get_entrydate($next_date);
							$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
							if($query3){
								$upd_data = array(
								//'listing_date' => $next_date,
								'last_list_date ' => $next_date,    //for now we have set last_list_date to $next_date, but it should be next_list_date.
								'updated_at' => $ts,
								'user_id ' => $user_id,
								'ip' => $ip,
								'proceeded' => 't',
									);
								$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);

									         	//check data exist or not
	         	$proc_exist = $this->proceeding_model->proceeding_exists($filing_no);
	         	if($proc_exist)
	         	{
	         		//die('proc_exist');

	         		$query4 = $this->proceeding_model->proceeding_history_insert($filing_no);
	         		if($query4){  			
	         		$query5 = $this->proceeding_model->delete_proceeding($filing_no);
									if($query5){
					
					$insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $order_type,
						        'agency_code' => $conce_agency,
						        'oth_agency_name' => $other_agn,
						        'closure_sec' => $closure_sec,
						        'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf',
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proceeding_count,
						        'action' => 'f',
						        'other_action_code' => $other_action,
						        );
							//print_r($insert_data);die;
								$query6 = $this->proceeding_model->proceeding_insert($insert_data);
							}
						}
					}else{
								            $data = array('upload_data' => $this->upload->data()); 
		            //print_r($listing_date);die;
		            $insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $order_type,
						        'agency_code' => $conce_agency,
						        'oth_agency_name' => $other_agn,
						        'closure_sec' => $closure_sec,
						        'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf',
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proceeding_count,
						        'action' => 'f',
						        'other_action_code' => $other_action,
						        );
							//print_r($insert_data);die;
								$query6 = $this->proceeding_model->proceeding_insert($insert_data);
					}




								$listing_data = array( 
								'filing_no'=>$filing_no,
								'listing_date'=>$next_date,	
								'created_at' => $ts,
								'user_id' => $user_id,
								'bench_no'=>$bench_no,				
								'bench_id'=>$bench_id,
								'recieved_from'=>'N', 			
								//'court_no'=>$court_no,	
								//'bench_nature' => $bench_nature,			
								);
								$query7 = $this->bench_model->complaint_listing($listing_data);



								if($query2 && $query6 && $query7){
									$next_date = get_displaydate($next_date);								
									$this->session->set_flashdata('success_msg', 'Successfully adjourned complaint no. '.$complaint_no.' for next hearing dated: '.$next_date.'.');
									redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);								
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem updating in allocation model complaint no. '.$complaint_no.'.');
									redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
									}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in allocation history model complaint no. '.$complaint_no.'.');
								redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}
								die();
					}

				$proceeding_count = $this->proceeding_model->get_proc_count($filing_no);
				//print_r($proceeding_count);die;
				$proceeding_count = $proceeding_count[0]->proceeding_count;
				//die($proceeding_count);
				if($proceeding_count == '')
					$proceeding_count = 1;
				else
					$proceeding_count = $proceeding_count+1;
					//echo $proceeding_count;die;

			$config['upload_path']   = './cdn/proceeding_order/'; 
	        $config['allowed_types'] = 'pdf'; 
	        //$config['max_size']      = 2000; 
	        $config['file_name'] = 'proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf';

	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('order_upload')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            //print_r($error['error']);die;
	            $this->session->set_flashdata('upload_error', $error['error']);
	            redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }
				
	         else { 

	         	if(($order_type == 5 || $order_type == 8 || $order_type == 9) && $closure_sec == 'no'){
					$cdetailhis = $this->agency_model->casedethis_insert($filing_no);

					$upd_data2 = array(
										'case_status' => 'D',
										'updated_date' => $ts,
									);
					$cdetail = $this->agency_model->upd_casedet($filing_no, $upd_data2);	
					if(!($cdetailhis || $cdetail)){
						$this->session->set_flashdata('error_msg', 'Unable to Dispose case!');
	            		redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
	            		die; 
					}
					$closure_sec=NULL;
				}

	         	//check data exist or not
	         	$proc_exist = $this->proceeding_model->proceeding_exists($filing_no);
	         	if($proc_exist)
	         	{
	         		//die('proc_exist');

	         		$query4 = $this->proceeding_model->proceeding_history_insert($filing_no);
	         		if($query4){  			
	         		$query5 = $this->proceeding_model->delete_proceeding($filing_no);
									if($query5){
					
					$insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $order_type,
						        'agency_code' => $conce_agency,
						        'oth_agency_name' => $other_agn,
						        'others_ordertype' => $others_ordertype,
						        'closure_sec' => $closure_sec,
						        'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf',
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proceeding_count,
						        'action' => 'f',
						        'due_date' => $due_date,
						        'other_action_code' => $other_action,
						        'additional_documents' => $additional_documents,
						        'status_report_department' => $status_rep_dept,
						        );
							//print_r($insert_data);die;
								$query = $this->proceeding_model->proceeding_insert($insert_data);

								if($query){
									$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
									if($query3){
									$upd_data = array(
										'proceeded' => 't',
										'updated_at' => $ts,
									);
									$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);

									if($query2){
										if($order_type == 5 || $order_type == 8 || $order_type == 9){
											$this->session->set_flashdata('success_msg', 'Successfully disposed complaint no. '.$complaint_no.'.');
											redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}else{
										$this->session->set_flashdata('success_msg', 'Successfully proceeded complaint no. '.$complaint_no.' and forwarded.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}
									}else{
										$this->session->set_flashdata('error_msg', 'Some problem updating in allocation model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
									}
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem inserting in allocation history model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}
								}else{
									//die('problem inserting in proceeding model');
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}

									}else{
										$this->session->set_flashdata('error_msg', 'Some problem deleting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
									}
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding history model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}

	         	}else
	         	{
	         		//$proceeding_count = 1;

		            $data = array('upload_data' => $this->upload->data()); 
		            //print_r($listing_date);die;
		            $insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $order_type,
						        'agency_code' => $conce_agency,
						        'oth_agency_name' => $other_agn,
						        'others_ordertype' => $others_ordertype,
						        'closure_sec' => $closure_sec,
						        'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf',
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proceeding_count,
						        'action' => 'f',
						        'due_date' => $due_date,
						        'other_action_code' => $other_action,
						        'additional_documents' => $additional_documents,
						        'status_report_department' => $status_rep_dept,
						        );
							//print_r($insert_data);die;
								$query = $this->proceeding_model->proceeding_insert($insert_data);

								if($query){
									$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
									if($query3){
									$upd_data = array(
										'proceeded' => 't',
										'updated_at' => $ts,
									);
									$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);

									if($query2){
											if($order_type == 5 || $order_type == 8 || $order_type == 9){
											$this->session->set_flashdata('success_msg', 'Successfully disposed complaint no. '.$complaint_no.'.');
											redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}else{
										$this->session->set_flashdata('success_msg', 'Successfully proceeded complaint no. '.$complaint_no.' and forwarded.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}
									}else{
										$this->session->set_flashdata('error_msg', 'Some problem updating in allocation model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
									}
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem inserting in allocation history model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}
								}else{
									//die('problem inserting in proceeding model');
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}

	            }
	         } 
	     }
		}

			function action2()
		{
			//print_r($_FILES);die;
			//print_r($_POST);die;
			$this->form_validation->set_rules('select_an_option', 'Select an option', 'required');
			//$this->form_validation->set_rules('order_upload', 'Order Upload', 'required');
			$select_an_option = trim($this->security->xss_clean($this->input->post('select_an_option')));

			//if($select_an_option == 2){
				$order_date = trim($this->security->xss_clean($this->input->post('order_date')));
				$order_date = get_entrydate($order_date);

				$this->form_validation->set_rules('order_date', 'Order Date', 'required');
				if (empty($_FILES['order_upload']['name']))
					{
	    			$this->form_validation->set_rules('order_upload', 'Document', 'required');
					}
			//}
	        //$this->form_validation->set_rules('order_type', 'Order Type', 'required',
	                        //array('required' => 'You must provide a %s.')
	                //);
	        //$this->form_validation->set_rules('conce_agency', 'Concern Agency', 'required');
	        //$this->form_validation->set_rules('order_body', 'Order Body', 'required');

			if ($this->form_validation->run() == FALSE){
				$data['user'] = $this->login_model->getRows($this->con);	
					
				$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$data['filing_no'] = $filing_no;
				$listing_date = $this->input->post('listing_date');
				$data['listing_date'] = $listing_date;
				$bench_no = $this->input->post('bench_no');
				$data['bench_no'] = $bench_no;
				$bench_id = $this->input->post('bench_id');
				//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
				//$data['bench_nature'] = $bench_nature;

				$coram = get_coram($bench_id);
				$data['coram'] = $coram;

				$all_benches = get_coram_all($filing_no);
				//print("<pre>".print_r($all_benches,true)."</pre>");die;
				//$coram = get_coram($listing_date, $bench_no);
				$data['all_benches'] = $all_benches;

				$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
				$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);

				$bench_details = get_current_bench_details($listing_date, $filing_no, $bench_no);
				$data['recieved_from'] = $bench_details[0]->recieved_from;
				//print_r($bench_nature);
				//print("<pre>".print_r($coram,true)."</pre>");die;

				//$data['order_type'] = $this->proceeding_model->fetch_order_type();
				$this->load->view('proceeding/proceeding.php',$data);
			}
			else
				
			{
				//die('pass');
				$select_an_option = trim($this->security->xss_clean($this->input->post('select_an_option')));
				//$order_type = trim($this->security->xss_clean($this->input->post('order_type')));
				//$order_body = trim($this->security->xss_clean($this->input->post('order_body')));
				$remarks = trim($this->security->xss_clean($this->input->post('remarks')));
				//$conce_agency = NULL;
				//$other_agn = NULL;
				//$closure_sec = NULL;

				//if($order_type == 1 || $order_type == 2)
					//$conce_agency = trim($this->security->xss_clean($this->input->post('conce_agency')));

				//if($order_type == 5)
					//$closure_sec = trim($this->security->xss_clean($this->input->post('closure_type')));

				//if($closure_sec == 'yes')
					//$closure_sec = 46;

				//if($conce_agency == 4 || $conce_agency == 8)
					//$other_agn = trim($this->security->xss_clean($this->input->post('other_agency_name')));


				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$listing_date = trim($this->security->xss_clean($this->input->post('listing_date')));
				//print_r($listing_date);die;
				//$listing_date = get_entrydate($listing_date);
				$bench_no = trim($this->security->xss_clean($this->input->post('bench_no')));
				$flag='RI';
				$bench_id = trim($this->security->xss_clean($this->input->post('bench_id')));
				//$bench_nature = trim($this->security->xss_clean($this->input->post('bench_nature')));
				//$court_no = trim($this->security->xss_clean($this->input->post('court_no')));
				$complaint_no = trim($this->security->xss_clean($this->input->post('complaint_no')));

				$data['user'] = $this->login_model->getRows($this->con);
			    $user_id=$data['user']['id'];
				//$purpose = ;
				$ts = date('Y-m-d H:i:s', time());
				$created_at = $ts;
				//$updated_at = ;
				$ip = get_ip();

				/*if($order_type == 4){
							$rand = mt_rand(10,100);
							$config['upload_path']   = './cdn/adj_order/'; 
	        				$config['allowed_types'] = 'pdf|doc|docx'; 
	        				$config['max_size']      = 2000; 
	        				$config['file_name'] = 'adj_order_'.$filing_no.'_'.$rand;

	        				$this->upload->initialize($config);
	        				$this->load->library('upload', $config);

	        				if ( ! $this->upload->do_upload('order_upload')) {
	            				$error = array('error' => $this->upload->display_errors()); 
	            				//print_r($error['error']);die;
	            				$this->session->set_flashdata('upload_error', $error['error']);
	            				redirect('proceeding/dashboard');
	            				die; 
	         				}

							$next_date = trim($this->security->xss_clean($this->input->post('adj_date')));
							$next_date = get_entrydate($next_date);
							$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
							if($query3){
								$upd_data = array(
								'listing_date' => $next_date,
								'last_list_date ' => $listing_date,
								'updated_at' => $ts,
								'user_id ' => $user_id,
								'ip' => $ip,
									);
								$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);

								if($query2){
									$next_date = get_displaydate($next_date);								
									$this->session->set_flashdata('success_msg', 'Successfully adjourned complaint no. '.$complaint_no.' for next hearing dated: '.$next_date.'.');
									redirect('proceeding/dashboard');								
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem updating in allocation model complaint no. '.$complaint_no.'.');
									redirect('proceeding/dashboard');
									}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in allocation history model complaint no. '.$complaint_no.'.');
								redirect('proceeding/dashboard');
								}
								die();
					}*/
				//if($select_an_option == 2){
				$proceeding_count = $this->proceeding_model->get_proc_count($filing_no);
				if($proceeding_count != 0)
				$proceeding_count = $proceeding_count[0]->proceeding_count;
				//print_r($proceeding_count);die;
				$proceeding_count = $proceeding_count+1;
					//echo $proceeding_count;die;

			$config['upload_path']   = './cdn/proceeding_order/'; 
	        $config['allowed_types'] = 'pdf|doc|docx'; 
	        //$config['max_size']      = 2000; 
	        $config['file_name'] = 'agency_report_order_'.$filing_no.'.pdf';

	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('order_upload')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            //print_r($error['error']);die;
	            $this->session->set_flashdata('upload_error', $error['error']);
	            redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }
	     //}		
	       	/*if($order_type == 5 && $closure_sec == 'no'){
					$cdetailhis = $this->agency_model->casedethis_insert($filing_no);

					$upd_data2 = array(
										'case_status' => 'D',
										'updated_date' => $ts,
									);
					$cdetail = $this->agency_model->upd_casedet($filing_no, $upd_data2);	
					if(!($cdetailhis || $cdetail)){
						$this->session->set_flashdata('error_msg', 'Unable to Dispose case!');
	            		redirect('proceeding/dashboard');
	            		die; 
					}
					$closure_sec=NULL;
				}*/

	         	//check data exist or not

	         	if($select_an_option == 1){
	         		//die('send to chairperson');
	         		//$query1 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
						//$upd_data = array(
							//'proceeded' => 't',
							//'updated_at' => $ts,
						//);
					//if($query1){
						//$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);
							$query3 = $this->agency_model->casedethis_insert($filing_no);
							if($query3){
								$upd_data2 = array(
									'listed' => 'f',
								'updated_date' => $ts,
							);
					$query4 = $this->agency_model->upd_casedet($filing_no, $upd_data2);
					if($query4){
										 $upd_data3 = array(
									'flag' => 0,
								'updated_at' => $ts,
							);
					$query5 = $this->agency_model->upd_agency_data($filing_no, $upd_data3);
					if($query5){
							 $ins_data4 = array(
									'filing_no' => $filing_no,
								'order_path' => 'cdn/proceeding_order/agency_report_order_'.$filing_no.'.pdf',
								'type' => 1,
								'created_at' => $ts,
								'ip' => $ip,
							);
					$query6 = $this->agency_model->ins_orders_agency_report($ins_data4);
					if($query6){

						$this->session->set_flashdata('success_msg', 'Complaint no '.get_complaintno($filing_no).' forwarded to HCP');
						redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem inserting in orders_agency_report model');
						redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in agency model');
						redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in case detail model');
						redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
					}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in case detail history model');
								redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
							}
	         }else if($select_an_option == 2){
	         		//die('agn');
	         		$proc_details = get_current_proc_details($filing_no);

	         		$proc_exist = $this->proceeding_model->proceeding_exists($filing_no);
	         		if($proc_exist)
	         			{
	         		//die('proc_exist');

	         			$query4 = $this->proceeding_model->proceeding_history_insert($filing_no);
	         			if($query4){  			
	         				$query5 = $this->proceeding_model->delete_proceeding($filing_no);
	         				$proceeding_count = $proc_details[0]->proceeding_count+1;
							if($query5){
					
								$insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $proc_details[0]->ordertype_code,
						        'agency_code' => $proc_details[0]->agency_code,
						        'oth_agency_name' => $proc_details[0]->oth_agency_name,
						        'closure_sec' => $proc_details[0]->closure_sec,
						        //'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count.'.pdf',
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proc_details[0]->proceeding_count,
						        'action' => 'f',
						        );
							//print_r($insert_data);die;
								$query = $this->proceeding_model->proceeding_insert($insert_data);

								if($query){
									//$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
									//if($query3){
									//$upd_data = array(
										//'proceeded' => 't',
										//'updated_at' => $ts,
									//);
									//$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);
										if($order_type == 5){
											$this->session->set_flashdata('success_msg', 'Successfully disposed complaint no. '.$complaint_no.'.');
											redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}else{
										$this->session->set_flashdata('success_msg', 'Successfully proceeded complaint no. '.$complaint_no.' and forwarded.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
										}

								}else{
									//die('problem inserting in proceeding model');
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}

									}else{
										$this->session->set_flashdata('error_msg', 'Some problem deleting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
									}
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding history model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard/'.$bench_no.'/'.$flag);
								}

	         	}/*else
	         	{
	         		//$proceeding_count = 1;

		            $data = array('upload_data' => $this->upload->data()); 
		            //print_r($listing_date);die;
		            $insert_data = array(
						        'filing_no' => $filing_no,
						        'listing_date' => $listing_date,
						        'bench_no' => $bench_no,
						        'bench_id' => $bench_id,
						        //'bench_nature' => $bench_nature,
						        'user_id' => $user_id,
						        'remarks' => $remarks,
						        //'court_no' => $court_no,
						        'order_date' => $order_date,
						        'ordertype_code' => $order_type,
						        'agency_code' => $conce_agency,
						        'oth_agency_name' => $other_agn,
						        'closure_sec' => $closure_sec,
						        'order_content' => $order_body,
						        'order_upload' => 'cdn/proceeding_order/proc_order_'.$filing_no.'_'.$proceeding_count,
						        'created_at' => $created_at,
						        'ip' => $ip,
						        'proceeding_count' => $proceeding_count,
						        'action' => 'f',
						        );
							//print_r($insert_data);die;
								$query = $this->proceeding_model->proceeding_insert($insert_data);

								if($query){
									$query3 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
									if($query3){
									$upd_data = array(
										'proceeded' => 't',
										'updated_at' => $ts,
									);
									$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);

									if($query2){
											if($order_type == 5){
											$this->session->set_flashdata('success_msg', 'Successfully disposed complaint no. '.$complaint_no.'.');
											redirect('proceeding/dashboard');
										}else{
										$this->session->set_flashdata('success_msg', 'Successfully proceeded complaint no. '.$complaint_no.' and forwarded.');
										redirect('proceeding/dashboard');
										}
									}else{
										$this->session->set_flashdata('error_msg', 'Some problem updating in allocation model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard');
									}
								}else{
									$this->session->set_flashdata('error_msg', 'Some problem inserting in allocation history model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard');
								}
								}else{
									//die('problem inserting in proceeding model');
									$this->session->set_flashdata('error_msg', 'Some problem inserting in proceeding model complaint no. '.$complaint_no.'.');
										redirect('proceeding/dashboard');
								}

	            }*/
	        }
		}
	}

	public function update_hearing(){		
			
			//echo '<pre>';
			$value  = json_decode($_POST['alldata']);
			//echo '<pre>';print_r($value);
	 $flag = 0;

			for($i=0;$i<count($value);$i++){
				$data = explode(':::', $value[$i]);
				if(!empty($data[1])){
					//echo $data[0].' : '.$data[1];

					 $id=$data[0];				
					 $listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					 $listing_date = get_entrydate($listing_date);
		$modifylisting = $this->proceeding_model->upd_allocation_listing($id,$listing_date);  
		$flag = 1;
	   	}
				
		}
		if($flag == 1){
			//echo 'success';
			echo json_encode(array('success' => 'success'));
		}else{
			echo json_encode(array('data'=>'fail'));
		}
		

	}

	public function update_purposes(){		
			//echo "yummy";die;
			//echo '<pre>';
		//print_r($_POST);die;
			$value  = json_decode($_POST['allids']);
			$purpose_code = $_POST['purpose_code'];
			//echo '<pre>';print_r($purpose_code);die;
			if($purpose_code == 5){
				$other_pur_name = $_POST['other_purpose_name'];
				if($other_pur_name == '')
					die('Please go back and select other purpose name!');
				$max_priority = $this->proceeding_model->get_max_priority();
				$max_priority = $max_priority['max'];
				$priority = $max_priority+1;
				$insert_array = array('name' => $other_pur_name,
					'description' => '',
					'priority' => $priority,
					'display' => TRUE,
				);
				$purpose_code = $this->proceeding_model->insert_new_purpose($insert_array);
			}
	 		$flag = 0;

			for($i=0;$i<count($value);$i++){
				//$data = explode(':::', $value[$i]);
				if(!empty($value[$i])){
					//echo $data[0].' : '.$data[1];

					 $id=$value[$i];				
					 //$listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					 //$listing_date = get_entrydate($listing_date);
		$modifylisting = $this->proceeding_model->upd_allocation_purpose($id,$purpose_code);  
		$flag = 1;
	   	}
				
		}
		if($flag == 1){
			//echo 'success';
			echo json_encode(array('success' => 'success'));
		}else{
			echo json_encode(array('data'=>'fail'));
		}
		

	}


    public function update_venues(){		
			//echo "yummy";die;
			//echo '<pre>';
		//print_r($_POST);die;
			$value  = json_decode($_POST['allids']);
			$venue_code = $_POST['venue_code'];
			//echo '<pre>';print_r($purpose_code);die;
	 		$flag = 0;

			for($i=0;$i<count($value);$i++){
				//$data = explode(':::', $value[$i]);
				if(!empty($value[$i])){
					//echo $data[0].' : '.$data[1];

					 $id=$value[$i];				
					 //$listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					 //$listing_date = get_entrydate($listing_date);
		$modifylisting = $this->proceeding_model->upd_allocation_venue($id,$venue_code);  
		$flag = 1;
	   	}
				
		}
		if($flag == 1){
			//echo 'success';
			echo json_encode(array('success' => 'success'));
		}else{
			echo json_encode(array('data'=>'fail'));
		}
		

	}

	public function update_hearing_details(){		
		//echo "yummy";die;
		//echo '<pre>';
	//print_r($_POST);die;
		$value  = json_decode($_POST['allids']);
		$venue_code = $_POST['venue_code'];
		//echo '<pre>';print_r($purpose_code);die;

		$purpose_code = $_POST['purpose_code'];

		$listing_date = $_POST['hearing_date'];
		$listing_date = get_entrydate($listing_date);
		//print_r($listing_date);

		if($purpose_code == 5){
			$other_pur_name = $_POST['other_purpose_name'];
			if($other_pur_name == '')
				die('Please go back and select other purpose name!');
			$max_priority = $this->proceeding_model->get_max_priority();
			$max_priority = $max_priority['max'];
			$priority = $max_priority+1;
			$insert_array = array('name' => $other_pur_name,
				'description' => '',
				'priority' => $priority,
				'display' => TRUE,
			);
			$purpose_code = $this->proceeding_model->insert_new_purpose($insert_array);
		}

		 $flag = 0;

		for($i=0;$i<count($value);$i++){
			//$data = explode(':::', $value[$i]);
			if(!empty($value[$i])){
				//echo $data[0].' : '.$data[1];

				 $id=$value[$i];				
				 //$listing_date=$data[1];			
				//echo $id." : ".$listing_date." ::: ";
				 //$listing_date = get_entrydate($listing_date);
	$modifylisting = $this->proceeding_model->upd_hearing_details($id, $venue_code, $purpose_code, $listing_date);  
	$flag = 1;
	   }
			
	}
	if($flag == 1){
		//echo 'success';
		echo json_encode(array('success' => 'success'));
	}else{
		echo json_encode(array('data'=>'fail'));
	}
	

}
	}