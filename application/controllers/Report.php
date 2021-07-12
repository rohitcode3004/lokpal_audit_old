	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Report extends CI_Controller {

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
			$this->load->model('bench_model');
			//$this->load->model('agency_model');
			//$this->load->model('case_detail_model');
			//$this->load->model('scrutiny_model');
			$this->load->model('reports_model');
			//$this->load->model('filing_model');
			//$this->load->helper("parts_status_helper");
			$this->load->helper("compno_helper");
			$this->load->helper("bench_helper");
			$this->load->helper("common_helper");
			$this->load->helper("report_helper");
			//$this->load->library('html2pdf');
			$this->load->library('label');
			$this->load->helper("date_helper");
			//$this->load->helper("proceeding_helper");
			//$this->load->helper("scrutiny_helper");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
		}

		public function status_of_complaints()
		{	
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['under_prem_inq'] = $this->reports_model->get_prem_inq_count();
			$data['under_inves'] = $this->reports_model->get_inves_count();
			$data['pros_sanctioned'] = $this->reports_model->get_pros_sanctioned_count();
			$data['cons_lokpal'] = $this->reports_model->get_cons_lokpal_count();
			$data['ord_dep_proc'] = $this->reports_model->get_ord_dep_proc_count();
			$data['closed'] = $this->reports_model->get_closed_count();

			//$this->load->view('templates/front/header4.php',$data);

			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}

			$this->load->view('reports/status_of_complaints.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		}

		public function list_of_complaints($flag)
		{	
			//$flag='I';
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['list_data'] = $this->reports_model->get_list_data($flag);
			$data['flag'] = $flag;

			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}

			$this->load->view('reports/list_of_complaints.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		}

		public function list_of_complaints_2($flag, $bn)
		{	
			$flag =  $this->uri->segment(3);
  			$bn =  $this->uri->segment(4);
  			$bid_array = get_bench_ids_bybno($bn);
  			//print_r($bid_array);
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['list_data'] = $this->reports_model->get_list_data_2($flag, $bid_array);
			//print_r($data['list_data']);die('c');
			$data['bid_array'] = $bid_array;

			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
				$this->load->view('templates/front/CM_Header.php',$data);
			}

			$this->load->view('reports/list_of_complaints_2.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		}

		public function status_of_complaints_under_loi()
		{	
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['all_benches'] = $this->reports_model->fetch_all_benches();
			//print_r($data['all_benches']);die;
			//$data['under_inves'] = $this->reports_model->get_inves_count();
			//$data['pros_sanctioned'] = $this->reports_model->get_pros_sanctioned_count();
			//$data['cons_lokpal'] = $this->reports_model->get_cons_lokpal_count();
			//$data['ord_dep_proc'] = $this->reports_model->get_ord_dep_proc_count();
			//$data['closed'] = $this->reports_model->get_closed_count();

			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}

			$this->load->view('reports/status_of_complaints_loi.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		}

		public function list_of_complaints_under_loi($flag)
		{	
			//$flag='I';
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['list_data'] = $this->reports_model->get_list_data($flag);

			$this->load->view('templates/front/header4.php',$data);

			$this->load->view('reports/list_of_complaints.php',$data);
		}

		public function category_of_complaints()
		{	
			//echo "here";die;
			$data['user'] = $this->login_model->getRows($this->con);
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['member_of_parliyament'] = $this->reports_model->get_member_of_parliyament_count();			
			$data['officials_groupa_groupb'] = $this->reports_model->get_officials_count();
			$data['ex_group'] = $this->reports_model->get_ex_group_count();
			$data['cons_rest'] = $this->reports_model->get_rest_category_count();
			$data['others'] = $this->reports_model->get_others_count();
			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}
			$this->load->view('reports/category_of_complaints.php',$data);
			$this->load->view('templates/front/dfooter.php',$data);
		}
		
		public function list_of_categories($flag)
		{	
			//$flag='I';
			$data['user'] = $this->login_model->getRows($this->con);

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

			$data['list_data_cat'] = $this->reports_model->get_list_data_cat($flag);

			if($data['user']['role'] == 138){
				$this->load->view('templates/front/dheader.php',$data);
			}
			elseif($data['user']['role'] == 147 || $data['user']['role'] == 170){
			$this->load->view('templates/front/CM_Header.php',$data);
			}

			$this->load->view('reports/list_of_categories_complaints.php',$data);

			$this->load->view('templates/front/dfooter.php',$data);
		}


	}