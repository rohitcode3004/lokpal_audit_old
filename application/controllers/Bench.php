<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bench extends CI_Controller {

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

	public function dashboard()
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['chairperson_data'] = $this->bench_model->get_chairperson_data();

	  		//print_r($data['user_comps']);die('kk');
		$this->load->view('templates/front/header4.php',$data);

		$this->load->view('bench/dashboard.php',$data);
	}

	public function dashboard_main()
	{	

			$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['listot_comps'] = $this->bench_model->get_listing_tot_count();
			$data['lispen_comps'] = $this->bench_model->get_listing_pen_count();
			$data['lisdon_comps'] = $this->bench_model->get_listing_don_count();

			$data['fresh_comps'] = $this->bench_model->get_fresh_count();
			$data['pre_inq_comps'] = $this->bench_model->get_pre_inq_count();
			$data['inv_comps'] = $this->bench_model->get_inv_count();

			//ysc code start 
			$data['opportunity_ps_after_pi_receive'] = $this->bench_model->get_opportunity_ps_after_pi_receive_count();
			$data['opportunity_ps_after_inq_receive'] = $this->bench_model->get_opportunity_ps_after_inq_receive_count();
			$data['any_other_action_count'] = $this->bench_model->get_any_other_action_count_data();
			//ysc code end

			$data['total_no_benches'] = $this->bench_model->get_benches_count();

			$this->load->view('templates/front/dheader.php',$data);

			$this->load->view('bench/dashboard_main.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		
	}

	public function benchcomposition(){	
		//print_r($this->input->post());die;
		if($this->input->post('filing_no'))
			{
		$data['user'] = $this->login_model->getRows($this->con);	
			
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$filing_no = $this->input->post('filing_no');
		$data['filing_no'] = $filing_no;

		$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);

		$data['previous_complaint_description'] = $this->scrutiny_model->get_previous_complaint_description($filing_no);
				//print_r($last_remarks);die;
		if($last_remarks[0]->summary)
				$data['summary'] = $last_remarks[0]->summary;

		if($last_remarks[0]->remarks)
				$data['last_remarks'] = $last_remarks[0]->remarks;

		$last_remarkedby_name = $this->scrutiny_model->get_last_rem_name($last_remarks[0]->remarkd_by);
		if(!empty($last_remarkedby_name))
				$data['last_remarkedby'] = $last_remarkedby_name[0]->display_name;

		$remarks_history = $this->scrutiny_model->get_rem_his($filing_no);


		if(!empty($remarks_history)){
			if($remarks_history[0]->remarks)
				$data['remark_history'] = $this->scrutiny_model->get_rem_his($filing_no);
				//print_r($data['remark_ history']);die;
		}

		$data['bench_nature'] = $this->bench_model->getBenchNature();
		$data['judge_master'] = $this->bench_model->getJudge();
		$data['ad_judge_master'] = $this->bench_model->getAd_Judge();
		$data['ch_judge_master'] = $this->bench_model->getCh_Judge();
	  //print_r($data['menus']->result());die('kk');

		//getting bench histories
		$all_benches = get_coram_all($filing_no);
		//print("<pre>".print_r($all_benches,true)."</pre>");die;
		//$coram = get_coram($listing_date, $bench_no);
		$data['all_benches'] = $all_benches;

		$data['last_proceeding'] = $this->proceeding_model->get_last_proceeding($filing_no);
		$data['proceeding_his'] = $this->proceeding_model->get_proceeding_his($filing_no);
		$data['listed'] = get_listed_status($filing_no);

		$data['purpose_type'] = $this->bench_model->fetch_purpose_type();

		
		$this->load->view('templates/front/dheader.php',$data);

		$this->load->view('bench/complaint_allotment.php',$data);

		$this->load->view('templates/front/dfooter.php',$data);
		}else
			{
				redirect('/bench/dashboard');
			}	
	}

	public function getDatabycomp_no()
	{

		$data['user'] = $this->login_model->getRows($this->con);
		$userid=$data['user']['id'];
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
		$comp_no= ($this->input->post('comp_no'));
		$ref_no= $this->bench_model->getRefNo($comp_no);
		$myArray=(array)$ref_no;
		$ref_no=$myArray[0]->ref_no;
		$data['partcdata']= $this->bench_model->getPartc($ref_no);
		$data['bench_nature'] = $this->bench_model->getBenchNature();
		$data['judge_master'] = $this->bench_model->getJudge();
		$data['ad_judge_master'] = $this->bench_model->getAd_Judge();
		$data['ch_judge_master'] = $this->bench_model->getCh_Judge();
		//echo "<pre>";
		//print_r($data['bench_nature']);die;
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		$this->load->view('bench/complaint_allotment.php',$data);
		//redirect('/bench/benchcomposition',$data); 

	}

	

	public function benchcreation()
	{
		//print_r($_POST);die;
		$data['user'] = $this->login_model->getRows($this->con);
		$user_id=$data['user']['id'];

		if($this->input->post('filing_no') && $this->input->post('bench_choice'))
		{	
			//print_r($_POST);die('top');
			$filing_no = $this->input->post('filing_no');
			$remarks = trim($this->security->xss_clean($this->input->post('remarks')));
			if($this->input->post('bench_choice') == 'existing')
				$radio = $this->input->post('newbench');
			$radio = substr($radio,0,3);
			//die($radio);
			$ts = date('Y-m-d H:i:s', time());
			$entry_date = date('Y-m-d');

			if(!$radio == 'old')
			{
			//die('new');			
				//$from_list_date= ($this->input->post('from_list_date'));
				//$from_list_date = get_entrydate($from_list_date);

				//$bench_no = $this->bench_model->getmax_benchno($from_list_date);
				//$bench_no = $bench_no['max'];
				//if($bench_no == '' || $bench_no == null){
					//$bench_no = 1;
				//}else{
					//$bench_no = $bench_no + 1;
				//}

				//$court_no= ($this->input->post('court_no'));

				//$from_time = $this->bench_model->getmax_time($from_list_date, $court_no);
				//$from_time = $from_time['max'];
				/*if($from_time == '' || $from_time == null){
					$from_time = '10:00';
					$to_time = '11:00';
				}else{
					$from_time = explode(':', $from_time);
					if($from_time[0] == 12){
						$from_time = '14:00';
						$to_time = '15:00';
						//print_r($from_time);die();
					}elseif($from_time[0] <= 16 ){
						$from_time = $from_time[0] + 1;
						$to_time = $from_time+1;
						$from_time = $from_time.':00';
						$to_time = $to_time.':00';
						//print_r($from_time);die();
					}else{
						die('court is full');
					}
				}*/
				
				//$noofmem= ($this->input->post('noofmem'));
				$bench_id = explode('/', $this->input->post('newbench'));
				$bench_id = $bench_id[1];
				$m = 'member_namec'.$bench_id;
				$member_names= ($this->input->post($m));

				//$member_names= ($this->input->post('member_namec'));
				//print_r($member_names);die;
				$order_date= ($this->input->post('order_date'));
				//$bench_no= ($this->input->post('bench_no'));
				$prev_bno = $this->bench_model->get_max_bno();
				$new_bno = $prev_bno['max']+1;

				$order_date= get_entrydate($order_date);
				$presiding= $this->bench_model->get_presiding($member_names);
				//echo $presiding;die('p');

				/*start of code for checking bench exist or not*/
				$check_bench = $this->bench_model->search_bench($presiding);
				//print_r($check_bench);die('b');
				if($check_bench!=0){
					//die('g');
					$check_judges = $this->bench_model->search_judges($check_bench, $member_names);
					//print_r($check_judges);die('j');
					if($check_judges != 'notfound'){
						$count = $check_judges; 
						$exp = explode("/",$count);
						$count = $exp[0];
						$new_bno = $exp[1];
						//echo $count3;die;
					}
				}
				//echo $count;die('k'); 
				if($check_bench == 0 || $check_judges == 'notfound'){
									$bench_compose = array( 
					//'from_list_date'=>$from_list_date,
					'court_no'=>1,	
					//'bench_nature' => $bench_nature,
					'presiding' => $presiding,
					'user_id'=>$user_id,
					'entry_date'=>$entry_date,
					'order_date'=>$order_date,
					//'from_time'=>$from_time,
					//'to_time'=>$to_time,					
					//'to_list_date'=>$from_list_date,					
					'bench_no'=>$new_bno,					
					);
					$count = $this->bench_model->bench_composition($bench_compose);
					//print_r($count);die();

					$total = count($member_names);
					//print_r($total);die();
					for($i=0; $i<$total; $i++){
					$judge_compose = array( 
					'judge_code'=>$member_names[$i],
					//'from_list_date'=>$from_list_date,	
					//'from_time' => $from_time,
					//'to_time' => $to_time,
					//'to_list_date'=>$from_list_date,
					'entry_date'=>$entry_date,					
					//'bench_no'=>$bench_no,					
					'bench_id'=>$count,					
					//'court_no'=>$court_no,
					//'bench_nature' => $bench_nature,					
				);
					$count2 = $this->bench_model->judge_composition($judge_compose);
					}
				}
		
				$listing_data = array( 
					'filing_no'=>$filing_no,
					//'listing_date'=>$from_list_date,	
					'created_at' => $ts,
					'user_id' => $user_id,
					'bench_no'=>$new_bno,				
					'bench_id'=>$count,				
					'remarks'=>$remarks,				
					//'court_no'=>$court_no,	
					//'bench_nature' => $bench_nature,			
				);
				$count3 = $this->bench_model->complaint_listing($listing_data);
				$listing_count = get_listing_count($filing_no);
				$upd_data = array( 
					'listed'=>'t',
					'listing_count'=>$listing_count+1,	
					'updated_date' => $ts,				
				);
				$count4 = $this->bench_model->casedet_upd($upd_data, $filing_no);
				if ($count  && $count3 && $count4) {
					$this->session->set_flashdata('success_msg', 'Bench composition successfully done for complaint no. '.get_complaintno($filing_no));
					redirect('bench/dashboard_main');
				}else{
					die('model error');
				}
			}elseif($radio == 'old'){
				//die('exis');
				$bench_id = explode('/', $this->input->post('newbench'));
				$bench_id = $bench_id[1];
				//print_r($bench_id);die('k');
				//$entry_date = date('Y-m-d');	 	
				//$bench_id= ($this->input->post('bench_id'));
				$filing_no = $this->input->post('filing_no');

				$old_bench_data = $this->bench_model->get_old_bench($bench_id);
				//$from_list_date = $old_bench_data->from_list_date;
				$bench_no = $old_bench_data->bench_no;
				$court_no = $old_bench_data->court_no;
				
				$m = 'member_namec'.$bench_id;
				$member_names= ($this->input->post($m));
				//print_r($member_names);die('here');
				//$order_date= ($this->input->post('order_date'));
				//$bench_no= ($this->input->post('bench_no'));
				$prev_bno = $this->bench_model->get_max_bno();
				$new_bno = $prev_bno['max']+1;

				//$order_date= get_entrydate($order_date);
				$presiding= $this->bench_model->get_presiding($member_names);
				//echo $presiding;die('p');

				/*start of code for checking bench exist or not*/
				$check_bench = $this->bench_model->search_bench($presiding);
				//print_r($check_bench);die('b');
				if($check_bench!=0){
					//die('g');
					$check_judges = $this->bench_model->search_judges($check_bench, $member_names);
					//print_r($check_judges);die('j');
					if($check_judges != 'notfound'){
						$count = $check_judges; 
						$exp = explode("/",$count);
						$count = $exp[0];
						$new_bno = $exp[1];
						//echo $count3;die;
					}
				}

				if($user_id != 1303){
					$order_date= ($this->input->post('order_date_allocation'));
					$order_date= get_entrydate($order_date);
					$ts_file = time();
					$config['upload_path']   = './cdn/allocation_order/'; 
	        		$config['allowed_types'] = 'pdf'; 
	        		//$config['max_size']      = 2000; 
	        		$config['file_name'] = 'allocation_order_'.$filing_no.'_'.$ts_file.'.pdf';

	       	 		$this->upload->initialize($config);
	        		$this->load->library('upload', $config);

	        		if ( ! $this->upload->do_upload('order_upload')) {
	            		$error = array('error' => $this->upload->display_errors()); 
	            		//print_r($error['error']);die;
	            		$this->session->set_flashdata('upload_error', $error['error']);
	            		redirect('bench/dashboard_main');
	            		die; 
	         		}
				}
				//echo $count;die('k'); 
				if($check_bench == 0 || $check_judges == 'notfound'){
									$bench_compose = array( 
					//'from_list_date'=>$from_list_date,
					'court_no'=>1,	
					//'bench_nature' => $bench_nature,
					'presiding' => $presiding,
					'user_id'=>$user_id,
					'entry_date'=>$entry_date,
					'order_date'=>$entry_date,
					'updated_at '=>$ts,
					//'from_time'=>$from_time,
					//'to_time'=>$to_time,					
					//'to_list_date'=>$from_list_date,					
					'bench_no'=>$bench_no,					
					);
					$count = $this->bench_model->bench_composition($bench_compose);
					//print_r($count);die();

					$total = count($member_names);
					//print_r($total);die();
					for($i=0; $i<$total; $i++){
					$judge_compose = array( 
					'judge_code'=>$member_names[$i],
					//'from_list_date'=>$from_list_date,	
					//'from_time' => $from_time,
					//'to_time' => $to_time,
					//'to_list_date'=>$from_list_date,
					'entry_date'=>$entry_date,					
					//'bench_no'=>$bench_no,					
					'bench_id'=>$count,					
					//'court_no'=>$court_no,
					//'bench_nature' => $bench_nature,					
				);
					$count2 = $this->bench_model->judge_composition($judge_compose);
					}
				}
		
				$listing_data = array( 
					'filing_no'=>$filing_no,
					//'listing_date'=>$from_list_date,	
					'created_at' => $ts,
					'user_id' => $user_id,
					'bench_no'=>$new_bno,				
					'bench_id'=>$count,				
					'remarks'=>$remarks,				
					//'court_no'=>$court_no,	
					//'bench_nature' => $bench_nature,			
				);
				if($user_id != 1303){
						$listing_data['order_date'] = $order_date;
						$listing_data['order_upload'] = '/cdn/allocation_order/allocation_order_'.$filing_no.'_'.$ts_file.'.pdf';
					}

				$count3 = $this->bench_model->complaint_listing($listing_data);
				$listing_count = get_listing_count($filing_no);
				$upd_data = array( 
					'listed'=>'t',
					'listing_count'=>$listing_count+1,	
					'updated_date' => $ts,				
				);
				$count4 = $this->bench_model->casedet_upd($upd_data, $filing_no);
				if ($count  && $count3 && $count4) {
					$this->session->set_flashdata('success_msg', 'Bench composition successfully done for complaint no. '.get_complaintno($filing_no));
					redirect('bench/dashboard_main');
				}else{
					die('model error');
				}
			}else{
				die('no option selected');
			}
		}elseif($this->input->post('new_saparate') && $this->input->post('member_namec') && $this->input->post('order_date')){
			/*
			start
        */
			//print_r($_POST);die('here');
						//print_r($_POST);die;
			//die('new_saparate');
			$ts = date('Y-m-d H:i:s', time());
			$entry_date = date('Y-m-d');
				
				//$noofmem= ($this->input->post('noofmem'));

				$member_names= ($this->input->post('member_namec'));
				//print_r($member_names);die;
				//$bench_no= ($this->input->post('bench_no'));
				$prev_bno = $this->bench_model->get_max_bno();
				$new_bno = $prev_bno['max']+1;

				$order_date= ($this->input->post('order_date'));
				if($user_id != 1303){
					$config['upload_path']   = './cdn/bench_order/'; 
	        		$config['allowed_types'] = 'pdf'; 
	        		//$config['max_size']      = 2000; 
	        		$config['file_name'] = 'bench_order_'.$new_bno.'.pdf';

	       	 		$this->upload->initialize($config);
	        		$this->load->library('upload', $config);

	        		if ( ! $this->upload->do_upload('order_upload')) {
	            		$error = array('error' => $this->upload->display_errors()); 
	            		//print_r($error['error']);die;
	            		$this->session->set_flashdata('upload_error', $error['error']);
	            		redirect('bench/benchcomposition_separate');
	            		die; 
	         		}
				}

				$order_date= get_entrydate($order_date);
				//print_r($member_names);die;
				$presiding= $this->bench_model->get_presiding($member_names);
				//echo $presiding;die('p');

				/*start of code for checking bench exist or not*/
				$check_bench = $this->bench_model->search_bench($presiding);
				//print_r($check_bench);die('b');
				if($check_bench!=0){
					//die('g');
					$check_judges = $this->bench_model->search_judges($check_bench, $member_names);
					//print_r($check_judges);die('j');
					if($check_judges != 'notfound'){
						$count = $check_judges; 
					}
				}
				//echo $count;die('k'); 
				if($check_bench == 0 || $check_judges == 'notfound'){
					$bench_compose = array( 
						//'from_list_date'=>$from_list_date,
						'court_no'=>1,	
						//'bench_nature' => $bench_nature,
						'presiding' => $presiding,
						'user_id'=>$user_id,
						'entry_date'=>$entry_date,
						'order_date'=>$order_date,
						//'from_time'=>$from_time,
						//'to_time'=>$to_time,					
						//'to_list_date'=>$from_list_date,					
						'bench_no'=>$new_bno,					
					);
					if($user_id != 1303){
						$bench_compose['order_upload'] = '/cdn/bench_order/bench_order_'.$new_bno.'.pdf';
					}
					$count = $this->bench_model->bench_composition($bench_compose);
					//print_r($count);die();

					$total = count($member_names);
					//print_r($total);die();
					for($i=0; $i<$total; $i++){
						$judge_compose = array( 
						'judge_code'=>$member_names[$i],
						//'from_list_date'=>$from_list_date,	
						//'from_time' => $from_time,
						//'to_time' => $to_time,
						//'to_list_date'=>$from_list_date,
						'entry_date'=>$entry_date,					
						//'bench_no'=>$bench_no,					
						'bench_id'=>$count,					
						//'court_no'=>$court_no,
						//'bench_nature' => $bench_nature,					
					);
					$count2 = $this->bench_model->judge_composition($judge_compose);
					}
				}else{
					die('Already exists');
				}
				if ($count  && $count2) {
					$this->session->set_flashdata('success_msg', 'Bench constitution successfully done');
					redirect('bench/benchcomposition_separate');
				}else{
					die('model error');
				}

		}elseif($this->input->post('modification') && $this->input->post('noofmem') && $this->input->post('member_namec') && $this->input->post('order_date')&& $this->input->post('bench_id')){
			//die('modification');
			/*
			start
        */
			//print_r($_POST);die('here');
						//print_r($_POST);die;

			$ts = date('Y-m-d H:i:s', time());
			$entry_date = date('Y-m-d');
				
				$noofmem= ($this->input->post('noofmem'));

				$member_names= ($this->input->post('member_namec'));
				$order_date= ($this->input->post('order_date'));
				$bench_id= ($this->input->post('bench_id'));
				$bench_no= ($this->input->post('bench_no'));
				//echo $bench_no;die('kk');
				//$prev_bno = $this->bench_model->get_max_bno();
				//$new_bno = $prev_bno['max']+1;

				$order_date= get_entrydate($order_date);
				//print_r($member_names);die;
				$presiding= $this->bench_model->get_presiding($member_names);
				//echo $presiding;die('p');

				/*start of code for checking bench exist or not*/
				//$check_bench = $this->bench_model->search_bench($presiding);
				//print_r($check_bench);die('b');
				/*if($check_bench!=0){
					//die('g');
					$check_judges = $this->bench_model->search_judges($check_bench, $member_names);
					//print_r($check_judges);die('j');
					if($check_judges != 'notfound'){
						$count = $check_judges; 
						die('Bench already exist');
					}
				}*/
				//echo $count;die('k'); 
				if(TRUE){
					$upd_history = $this->bench_model->update_bench_his($bench_id);
					if($upd_history){
					$bench_compose = array( 
					//'from_list_date'=>$from_list_date,
					'court_no'=>1,	
					//'bench_nature' => $bench_nature,
					'presiding' => $presiding,
					'user_id'=>$user_id,
					'entry_date'=>$entry_date,
					'order_date'=>$order_date,
					'updated_at '=>$ts,
					//'from_time'=>$from_time,
					//'to_time'=>$to_time,					
					//'to_list_date'=>$from_list_date,					
					'bench_no'=>$bench_no,					
					);
					$count = $this->bench_model->bench_composition($bench_compose);
					//print_r($count);die();

					if($count){
						$upd_history_judge = $this->bench_model->update_judge_his($bench_id);
						//print_r($upd_history_judge);die('g');
						if($upd_history_judge){

							$update_display = $this->bench_model->update_display_bench($bench_id);

					$total = count($member_names);
					//print_r($total);die();
					for($i=0; $i<$total; $i++){
					$judge_compose = array( 
					'judge_code'=>$member_names[$i],
					//'from_list_date'=>$from_list_date,	
					//'from_time' => $from_time,
					//'to_time' => $to_time,
					//'to_list_date'=>$from_list_date,
					'entry_date'=>$entry_date,					
					'updated_at '=>$ts,					
					//'bench_no'=>$bench_no,					
					'bench_id'=>$count,					
					//'court_no'=>$court_no,
					//'bench_nature' => $bench_nature,					
				);
					$count2 = $this->bench_model->judge_composition($judge_compose);
					}
				}else{
					die('cannot update judge history');
				}
				}else{
					die('bench update not successful');
				}
				}else{
					die('bench history cannot be maintained');
				}
				}else{
					die('Already exists');
				}
				if ($count  && $count2) {
					$this->session->set_flashdata('success_msg', 'Bench modification successfully done');
					redirect('bench/benchcomposition_separate');
				}else{
					die('model error');
				}

		}else{
			die('some parameters missing');
		}
	}

	public function get_benches_listdate()
	{
		//$from_list_date= ($this->input->post('list_date'));
		//$from_list_date = get_entrydate($from_list_date);
		//die($from_list_date);
		$benches = $this->bench_model->get_benches();
		json_encode($benches->result_array());
		//die('here');
		$benches = $benches->result_array();

		//print("<pre>".print_r($data,true)."</pre>");die;
		$count_benches = count($benches);

		$judges_array = [];
		for($i=0;$i<$count_benches;$i++){
			//$bn = get_bench_nature($benches[$i]['bench_nature']);
			//$benches[$i]['bench_nature'] = $bn;
			$b_id = $benches[$i]['id'];
			$b_no = $benches[$i]['bench_no'];
			$all_bench_ids_with_same_bn = $this->bench_model->get_benche_ids($b_no);
			$all_bench_ids_with_same_bn = $all_bench_ids_with_same_bn->result_array();
			$all_bench_ids_with_same_bn = array_column($all_bench_ids_with_same_bn, 'id');
			//while($row = pg_fetch_assoc($all_bench_ids_with_same_bn)){
				//echo $row['id'];
			//}
			//die;
			//$all_bench_ids_with_same_bn = implode(',', $all_bench_ids_with_same_bn);
			//print_r($all_bench_ids_with_same_bn);die;

			$total_cases = 0;
			$total_cases = $this->bench_model->get_total_cases($all_bench_ids_with_same_bn);
			//echo $total_cases;die;
			$benches[$i]["total_cases"] = $total_cases;

			$judges = $this->bench_model->get_judges($b_id);
			$judges = $judges->result_array();
			//print("<pre>".print_r($judges,true)."</pre>");die;
			//$benches_array["benches"][] = $benches[$i];
			$count_judges = count($judges);
			for($j=0;$j<$count_judges;$j++){		
				//$benches_array["judges"][] = $judges[$j];
				$jrow = $this->bench_model->get_judge_name($judges[$j]['judge_code']);
				$jname = $jrow->judge_name;

				$judges_array[] = array("judge_name" => $jname,
				//"list_date" => $judges[$j]['from_list_date'],
				"court_no" => $judges[$j]['court_no'],
				"from_time" => $judges[$j]['from_time'],
				"bench_no" => $judges[$j]['bench_no'],
				"bench_id" => $judges[$j]['bench_id'],
				"judge_code" => $judges[$j]['judge_code'],
				"judge_desg" => get_member_type($judges[$j]['judge_code']),
			);
			}
		}
		$result_array['benches']=$benches;
		$result_array['judges']=$judges_array;
		$result_array['count']=$count_benches;
		//print("<pre>".print_r($result_array,true)."</pre>");die;
		echo json_encode($result_array);
	}

	public function get_benches_listdate_bn()
	{
		$from_list_date= ($this->input->post('list_date'));
		$from_list_date = get_entrydate($from_list_date);
		$bench_nature= ($this->input->post('bench_nature'));
		//die($from_list_date);
		$benches = $this->bench_model->get_benches($from_list_date, 'LB', $bench_nature);
		//echo json_encode($benches->result_array());
		$benches = $benches->result_array();
		//print("<pre>".print_r($benches,true)."</pre>");die;
		$count_benches = count($benches);

		$judges_array = [];
		for($i=0;$i<$count_benches;$i++){
			$bn = get_bench_nature($benches[$i]['bench_nature']);
			$benches[$i]['bench_nature'] = $bn;

			$judges = $this->bench_model->get_judges($benches[$i]['from_list_date'], $benches[$i]['bench_no']);
			$judges = $judges->result_array();
			//print("<pre>".print_r($judges,true)."</pre>");die;
			//$benches_array["benches"][] = $benches[$i];
			$count_judges = count($judges);
			for($j=0;$j<$count_judges;$j++){		
				//$benches_array["judges"][] = $judges[$j];
				$jrow = $this->bench_model->get_judge_name($judges[$j]['judge_code']);
				$jname = $jrow->judge_name;

				$judges_array[] = array("judge_name" => $jname,
				"list_date" => $judges[$j]['from_list_date'],
				"court_no" => $judges[$j]['court_no'],
				"from_time" => $judges[$j]['from_time'],
				"bench_no" => $judges[$j]['bench_no'],
				"bench_id" => $judges[$j]['bench_id'],
				"judge_code" => $judges[$j]['judge_code'],
				"judge_desg" => get_member_type($judges[$j]['judge_code']),
			);
			}
		}
		$result_array['benches']=$benches;
		$result_array['judges']=$judges_array;
		$result_array['count']=$count_benches;
		//print("<pre>".print_r($benches,true)."</pre>");die;
		echo json_encode($result_array);
	}

	public function get_members(){
		$judges = $this->bench_model->get_all_judges();
		$judges = $judges->result_array();

		foreach($judges as $key => $csm)
 		{
 			$nofcases_judge = $this->nofcases_judge($judges[$key]['judge_code']);
  			$judges[$key]['nofcases'] = $nofcases_judge;
 		}
		echo json_encode($judges);
		/*$result_array = array(
			array('judge_code' => 1, 'judge_name'=>'rohit bisht', 'judge_title'=>'hon', 'judge_type'=> 'C'),
			array('judge_code' => 2, 'judge_name'=>'mohit bisht', 'judge_title'=>'hon', 'judge_type'=> 'M'),
			array('judge_code' => 3, 'judge_name'=>'ankit bisht', 'judge_title'=>'hon', 'judge_type'=> 'J'),
		);
		echo json_encode($result_array);*/
	}

	public function benchcomposition_separate(){	
		$data['user'] = $this->login_model->getRows($this->con);	
			
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['judge_master'] = $this->bench_model->getJudge();
		$data['ad_judge_master'] = $this->bench_model->getAd_Judge();
		$data['ch_judge_master'] = $this->bench_model->getCh_Judge();
	  //print_r($data['menus']->result());die('kk');

		//print("<pre>".print_r($all_benches,true)."</pre>");die;
		//$coram = get_coram($listing_date, $bench_no);

		$this->load->view('templates/front/dheader.php',$data);

		$this->load->view('bench/bench_composition.php',$data);

		$this->load->view('templates/front/dfooter.php',$data);
	}

	public function get_bench_details(){
		$bn= ($this->input->post('bn')); 
		$benches = $this->bench_model->fetch_bench_details($bn);
		$benches = $benches->result_array();
		//echo $benches[0]['id'];
		//echo json_encode($benches);

		$judges = $this->bench_model->fetch_judges_details($benches[0]['id']);
		$judges = $judges->result_array();

		$result_array['benches']=$benches;
		$result_array['judges']=$judges;
		//echo json_encode($judges);
		echo json_encode($result_array);
		/*$result_array = array(
			array('judge_code' => 1, 'judge_name'=>'rohit bisht', 'judge_title'=>'hon', 'judge_type'=> 'C'),
			array('judge_code' => 2, 'judge_name'=>'mohit bisht', 'judge_title'=>'hon', 'judge_type'=> 'M'),
			array('judge_code' => 3, 'judge_name'=>'ankit bisht', 'judge_title'=>'hon', 'judge_type'=> 'J'),
		);
		echo json_encode($result_array);*/
	} 

	public function benches_all(){	
		$data['user'] = $this->login_model->getRows($this->con);	
			
		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		//print("<pre>".print_r($all_benches,true)."</pre>");die;
		//$coram = get_coram($listing_date, $bench_no);

		$this->load->view('templates/front/dheader.php',$data);

		$this->load->view('bench/bench_list.php',$data);

		$this->load->view('templates/front/dfooter.php',$data);
	}

	public function bench_mod()
	{
		//print_r($_POST);die;

		if($this->input->post('newbench'))
		{	
			//print_r($_POST);die;
			$data['user'] = $this->login_model->getRows($this->con);		
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$radio = $this->input->post('newbench');
			$radio = explode("/",$radio);
			$radio = $radio[2];
			//die($radio);
			$data['bno'] = $radio;

			$this->load->view('bench/bench_modification.php',$data);
		}else{
			die('No option selected');
		}
	}

	public function nofcases_judge($code){
		return $nofcases_judges = $this->bench_model->fetch_nofcases_judges($code);
	}

	public function case_history_report()
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['chairperson_data'] = $this->bench_model->get_chairperson_data();
		$data['ongoing_comp_data'] = $this->bench_model->get_report1_data();

	  		//print_r($data['user_comps']);die('kk');
		$this->load->view('templates/front/header2.php',$data);

		$this->load->view('bench/report1.php',$data);
	}

	public function get_listing_completed()
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['ongoing_comp_data'] = $this->bench_model->get_report1_data();

	  		//print_r($data['user_comps']);die('kk');
		$this->load->view('templates/front/header2.php',$data);

		$this->load->view('bench/listing_completed.php',$data);
	}

	public function get_complaints($flag=NULL)
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['chairperson_data'] = $this->bench_model->get_complaints_data($flag);
		$data['flag'] = $flag;

	  		//print_r($data['user_comps']);die('kk');
		$this->load->view('templates/front/dheader.php',$data);

		$this->load->view('bench/dashboard.php',$data);

		$this->load->view('templates/front/dfooter.php',$data);
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
if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}

$this->load->view('bench/search_case.php',$data);

$this->load->view('templates/front/dfooter.php',$data);

}




public function search_case_detail(){
$data['user'] = $this->login_model->getRows($this->con);
$this->load->helper("date_helper");
$this->load->helper("compno_helper");
$userid=$data['user']['id'];
if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}
$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
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
redirect('bench/search_case');


}
else
{
$data['case_detail_data']= $this->bench_model->case_status_data($case_no,$year);
$ct=count($data['case_detail_data']);
}


}

if($search_case=='1')
{
 $name_of_complainant= ($this->input->post('name_of_complainant'));
$data['case_detail_data']= $this->bench_model->case_search_by_complainant_data($name_of_complainant);
 $filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
$ct=count($data['case_detail_data']);
}

if($search_case=='2')
{
$name_of_public_servant= ($this->input->post('name_of_public_servant'));
$data['case_detail_data']= $this->bench_model->case_search_by_publicservant_data($name_of_public_servant);
 //$filing_no=$data['case_detail_data'][0]->filing_no ?? '';//die;
//print_r($data['case_detail_data']);die;
$ct=count($data['case_detail_data']);
}



for($i=0;$i<$ct;$i++){
  $filing_no=$data['case_detail_data'][$i]->filing_no ?? '';

$data['case_detail_chk']= $this->bench_model->case_status_filingno_data($filing_no);
//print_r($data);
$filing_no=$data['case_detail_chk'][0]->filing_no ?? '';
//$complaint_no=$data['case_detail_chk'][0]->complaint_no ?? '';
$complaint_year=$data['case_detail_chk'][0]->complaint_year ?? '';
$listing_date=$data['case_detail_chk'][0]->listing_date ?? '';
$ordertype_name=$data['case_detail_chk'][0]->ordertype_name ?? '';
$ordertype_code=$data['case_detail_chk'][0]->ordertype_code ?? NULL;
$remarks=$data['case_detail_chk'][0]->remarks ?? '';
$flag=$data['case_detail_chk'][0]->flag ?? '';
$scrutiny_status=$data['case_detail_chk'][0]->scrutiny_status ?? '';
$listed=$data['case_detail_chk'][0]->listed ?? '';
$case_status=$data['case_detail_chk'][0]->case_status ?? '';
$action=$data['case_detail_chk'][0]->action ?? '';  

$agency_name=$data['case_detail_chk'][0]->agency_name ?? ''; 
$bench_id=$data['case_detail_chk'][0]->bench_id ?? ''; 
$agency_code=$data['case_detail_chk'][0]->agency_code ?? NULL; 
$due_date=$data['case_detail_chk'][0]->due_date ?? ''; 

$data['case_detail'][$i] = array(
'filing_no'=> $filing_no,
//'complaint_no'=>$complaint_no,
'complaint_year' => $complaint_year,
'listing_date' => $listing_date,
//'ordertype_name' => $ordertype_name,
'remarks'=> $remarks,
'flag'=>$flag,
'scrutiny_status' => $scrutiny_status,
'listed' => $listed,
'case_status' => $case_status,
'action' => $action,
'ordertype_code' => $ordertype_code,
//'agency_name'=>$agency_name,
'bench_id'=>$bench_id,
'agency_code'=>$agency_code,
'due_date'=>$due_date,

);

}
//print_r($data);die;
if(isset($data['case_detail']))
{
echo "sucees";
}else
{
$data['error']= "";
}

$this->load->view('bench/search_case_action.php',$data);

$this->load->view('templates/front/dfooter.php',$data);

}

/*ysc code start */


public function get_complaints_ops($flag=NULL)
	{	
		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['chairperson_data'] = $this->bench_model->get_complaints_ops_data($flag);
		$data['flag'] = $flag;

	  		//print_r($data['user_comps']);die('kk');
		$this->load->view('templates/front/dheader.php',$data);

		$this->load->view('bench/dashboard_ops.php',$data);

		$this->load->view('templates/front/dfooter.php',$data);

	}


/*ysc code end */

}