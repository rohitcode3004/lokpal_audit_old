<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scrutiny extends CI_Controller {
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
		$this->load->model('scrutiny_model');
		$this->load->helper("parts_status_helper");
		$this->load->helper("compno_helper");
		$this->load->helper("date_helper");
		$this->load->helper("common_helper");
		$this->load->helper("scrutiny_helper");
		$this->load->library('html2pdf');
		$this->load->model('common_model');
		$this->load->model('causelist_model');
		$this->load->model('report_model');
		$this->load->model('reports_model');
		$this->load->model('proceeding_model');	
			
			$this->load->model('bench_model');
			$this->load->model('agency_model');
			$this->load->model('case_detail_model');
			$this->load->helper("bench_helper");		
			$this->load->helper("report_helper");
			$this->load->helper("reports_helper");
			//$this->load->library('html2pdf');
			$this->load->library('label');	
			$this->load->helper("proceeding_helper");			
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');

		$data['user'] = $this->login_model->getRows($this->con);
		if(!($data['user']['role'] == 161 || $data['user']['role'] == 162 || $data['user']['role'] == 163 || $data['user']['role'] == 164 || $data['user']['role'] == 147))
			die('Access Denied!');
	}

	public function dashboard()
	{	

		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['role'] = $data['user']['role'];
			//print_r($data['role']);die;

		$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pen_complaints($data['user']['role']);
		$data['scrdef_comps'] = $this->scrutiny_model->get_scrutiny_def_complaints($data['user']['role']);
		$this->load->view('templates/front/SC_Header.php',$data);

		$this->load->view('scrutiny/dashboard.php',$data);

		$this->load->view('templates/front/CE_Footer.php',$data);
		
	}


	public function dashboard_def()
	{	

		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

		$data['role'] = $data['user']['role'];
			//print_r($data['role']);die;

		$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pen_complaints_def();
		$data['scrdef_comps'] = $this->scrutiny_model->get_scrutiny_def_complaints($data['user']['role']);

			//echo "<pre>";
	  		//print_r($data['scrpen_comps']);die('kk');

		//$this->load->view('templates/front/header2.php',$data);

		$this->load->view('templates/front/SC_Header.php',$data);

		$this->load->view('scrutiny/dashboard_defect.php',$data);

		$this->load->view('templates/front/CE_Footer.php',$data);
		
	}
	
	
	public function dashboard_main()
	{	

		$data['user'] = $this->login_model->getRows($this->con);

            //print_r($data['user']['id']);die;

		$data['menus'] = $this->menus_lib->get_menus(
			$data['user']['role']);

		$data['scrtot_comps'] = $this->scrutiny_model->get_scrutiny_tot_count();
		$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pen_count($data['user']['role']);
		$data['scrundef_comps'] = $this->scrutiny_model->get_scrutiny_undef_count();
		$data['scrdef_comps'] = $this->scrutiny_model->get_scrutiny_def_count();

			/* ysc code 25062021 */
		$data['inq_report_count'] = $this->scrutiny_model->get_inq_report_count();
		$data['inv_report_count'] = $this->scrutiny_model->get_inv_report_count();

		$data['oppertunity_ps_after_pi_count'] = $this->scrutiny_model->get_oppertunity_ps_after_pi_count();
		$data['oppertunity_ps_after_IR_count'] = $this->scrutiny_model->get_oppertunity_ps_after_IR_count();

		$data['any_other_action'] = $this->scrutiny_model->get_any_other_action();



       /*end ysc code */

	  		//print_r($data['user_comps']);die('kk');

		//$this->load->view('templates/front/header2.php',$data);
		$this->load->view('templates/front/SC_Header.php',$data);

		$this->load->view('scrutiny/dashboard_main_scrutiny.php',$data);

		$this->load->view('templates/front/CE_Footer.php',$data);
		
	}


	public function checklist()
	{	
		if($this->input->post('filing_no'))
		{
				//print_r($this->input->post('complaint_no'));die('here');
			$data['user'] = $this->login_model->getRows($this->con);

	            //print_r($data['user']['id']);die;

			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			$data['gender'] = $this->common_model->getGender();
			 $data['complainant_type'] = $this->common_model->getComplaint();

			$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;


			$data['toroles'] = $this->scrutiny_model->get_scr_roles($data['user']['role']);

			$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);
				//print_r($last_remarks);die;
			if($last_remarks[0]->summary)
				$data['summary'] = $last_remarks[0]->summary;

			if($last_remarks[0]->remarks)
				$data['last_remarks'] = $last_remarks[0]->remarks;

			$last_datetime = explode(" ", $last_remarks[0]->updated_date);
				//print_r($data['last_remarks']);die;

			$last_date = $last_datetime[0];
			$data['last_date'] = get_displaydate($last_date);
				//print_r($data['last_date']);die;

				//$last_time = $last_datetime[1];
			$last_time = isset($last_datetime[1]) ? $last_datetime[1] : '';
			$last_time = date('h:i:s A', strtotime($last_time));
			$data['last_time'] = $last_time;

				//$data['last_timestamp'] = $last_remarks[0]->updated_date;
				//if(!empty($data['last_remarks'])){
			$last_remarkedby_name = $this->scrutiny_model->get_last_rem_name($last_remarks[0]->remarkd_by);
			if(!empty($last_remarkedby_name))
				$data['last_remarkedby'] = $last_remarkedby_name[0]->display_name;
			    //}
			

			$remarks_history = $this->scrutiny_model->get_rem_his($filing_no);


			if(!empty($remarks_history)){
			if($remarks_history[0]->remarks)
				$data['remark_history'] = $this->scrutiny_model->get_rem_his($filing_no);
				//print_r($data['remark_ history']);die;
		}

		$previous_complaint_desc = $this->scrutiny_model->get_previous_complaint_remarks($filing_no);
			if(!empty($previous_complaint_desc))
				$data['previous_complaint_desc'] = $previous_complaint_desc[0]->previous_complaint_description;

			if($data['user']['role'] == 161 || $data['user']['role'] == 162){
				$comp_type = get_parta_comptype_compno($filing_no);
				if($comp_type == 1)
				{
					$comp_type = 1;
				}else
				{
					$comp_type = 2;
				}

				$check_objdet_exists = $this->scrutiny_model->chk_objdet_ent($filing_no);
				if($check_objdet_exists){
					//print_r($check_objdet_exists);die;
					$data['chklst'] = $this->scrutiny_model->get_objdet_ent($filing_no);
				}else{

					$data['chklst'] = $this->scrutiny_model->get_checklist($comp_type);
				}
				$data['comp_type'] = $comp_type;

		  		//print_r($data['user_comps']);die('kk');

				//$this->load->view('templates/front/header2.php',$data);

				$this->load->view('templates/front/SC_Header.php',$data);

				$this->load->view('scrutiny/checklist.php',$data);

				$this->load->view('templates/front/CE_Footer.php',$data);

			}elseif($data['user']['role'] == 163 || $data['user']['role'] == 164 || $data['user']['role'] == 147){


				//$this->load->view('templates/front/header2.php',$data);

				$this->load->view('templates/front/SC_Header.php',$data);

				$this->load->view('scrutiny/pdf_checklist.php',$data);

				$this->load->view('templates/front/CE_Footer.php',$data);
			}else{
				die('Unauthorized Access!');
			}
		}else
		{
			redirect('/scrutiny/dashboard');
		}
	}
	public function action()
	{
		//echo "<pre>";
		//print_r($_POST);die;
		if($this->input->post('filing_no') && $this->input->post('torole'))
		{
			//print_r($this->input->post());die();
			$data['user'] = $this->login_model->getRows($this->con);

	            //print_r($data['user']['id']);die;
			$remarks_by = $this->scrutiny_model->get_remarksby($data['user']['role']);
			$remarks_by = $remarks_by[0]->id;

			$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
			$scrutiny_def_url='cdn/scrutiny_df/'.$filing_no;
			$torole = trim($this->security->xss_clean($this->input->post('torole')));
			$ts = date('Y-m-d H:i:s', time());
			if($torole == 4){
				$chk_exist_case_det = $this->scrutiny_model->chk_exist_case_det($filing_no);

				if(!$chk_exist_case_det){
					//die('new');
					$comp_data = $this->generate_complaintno($filing_no);
					if($comp_data['chk_cou'] == '')
						{
						die('Counters do not matched. Contact Admin');
						}

				}else{
					//print_r($chk_exist_case_det);die;
					$comp_data['chk_cou'] =  'XXX';
					$comp_data['comp_no'] = $chk_exist_case_det['0']->complaint_no;
					$comp_data['year'] = $chk_exist_case_det['0']->complaint_year;
				}
			}elseif(trim($this->security->xss_clean($this->input->post('par1'))) == 1){
				$comp_no_pre_gen = $this->pre_gen_comp_no($this->input->post('filing_no'));
				//$comp_no_gen = $comp_no_pre_gen['comp_no'];
			}

			if($this->input->post('comp_type') == 1 || $this->input->post('comp_type') == 2)
			{
				//print_r($this->input->post());die();
				$objections = 'No';
				$def_array1 = array();
				$count = count($this->input->post('defects1'));
				for ($i=0; $i < $count; $i++) 
				{ 
					array_push($def_array1,trim($this->security->xss_clean($this->input->post('defects1')[$i])));

					$check_ent_exist = $this->scrutiny_model->chk_ent_exist($filing_no, $this->input->post('checklist_code1')[$i]);
					if($check_ent_exist){
					//print_r($check_objdet_exists);die;
						$ins_ent_exist_his = $this->scrutiny_model->ins_ent_exist_his($filing_no, $this->input->post('checklist_code1')[$i]);
						if($ins_ent_exist_his)
							$del_ent_exist = $this->scrutiny_model->del_ent_exist($filing_no, $this->input->post('checklist_code1')[$i]);
					}

					$insert_data = array(
						'defect_status' => trim($this->security->xss_clean($this->input->post('defects1')[$i])),
						'comments' => trim($this->security->xss_clean($this->input->post('comments1')[$i])),
						'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),
						'entry_date' => $ts,
						'user_id' => $this->con['id'],
						'checklist_code' => trim($this->security->xss_clean($this->input->post('checklist_code1')[$i])),
						'scrutiny_def_url'=>$scrutiny_def_url,
					);
					//print_r($insert_data);die;
					$query = $this->scrutiny_model->objections_insert($insert_data);
					if($query) 
					{
						continue; 
					} 
					else
					{
						die('something went wrong');
					}
				}
				$def_chk1 = in_array('N', $def_array1);
				if($def_chk1)
				{
					$objections = 'Yes';
				}
			}


			if($this->input->post('comp_type') == 2)
			{
				//print_r($this->input->post());die();
				$def_array2 = array();
				$count = count($this->input->post('defects2'));
				for ($i=0; $i < $count; $i++) 
				{ 
					array_push($def_array2,trim($this->security->xss_clean($this->input->post('defects2')[$i])));

					$check_ent_exist = $this->scrutiny_model->chk_ent_exist($filing_no, $this->input->post('checklist_code2')[$i]);
					if($check_ent_exist){
					//print_r($check_objdet_exists);die;
						$ins_ent_exist_his = $this->scrutiny_model->ins_ent_exist_his($filing_no, $this->input->post('checklist_code2')[$i]);
						if($ins_ent_exist_his)
							$del_ent_exist = $this->scrutiny_model->del_ent_exist($filing_no, $this->input->post('checklist_code2')[$i]);
					}

					$insert_data = array(
						'defect_status' => trim($this->security->xss_clean($this->input->post('defects2')[$i])),
						'comments' => trim($this->security->xss_clean($this->input->post('comments2')[$i])),
						'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),
						'entry_date' => $ts,
						'user_id' => $this->con['id'],
						'checklist_code' => trim($this->security->xss_clean($this->input->post('checklist_code2')[$i])),
						'scrutiny_def_url'=>$scrutiny_def_url,
					);
					//print_r($insert_data);die;
					$query = $this->scrutiny_model->objections_insert($insert_data);
					if($query) 
					{
						continue; 
					} 
					else
					{
						die('something went wrong');
					}
				}
				$def_chk2 = in_array('N', $def_array2);
				if($def_chk2)
				{
					$objections = 'Yes';
				}
			}

			//start of scrutiny	
			//echo $objctions;
			$is_first_time = $this->scrutiny_model->is_first_time($filing_no);
			if(!$is_first_time){
				$query_his = $this->scrutiny_model->scrutiny_his_ins($filing_no);
			}else
			$query_his = false;
			if($query_his || $is_first_time){
				if($torole == 4)
					$scr_stat = 't';
				else
					$scr_stat = 'f';

				if($remarks_by == 2 || $remarks_by == 3 || $remarks_by == 6 || $remarks_by == 7){            
					$scrutiny_upddata = array(
						'scrutiny_date' => date('Y-m-d'),
						'updated_date' => $ts,
						'user_id' => $this->con['id'],
						'scrutiny_status' => $scr_stat,
						'remarks' => trim($this->security->xss_clean($this->input->post('remarks'))),
						'summary' => trim($this->security->xss_clean($this->input->post('summary'))),
						'summary_ts' => $ts,
						'level' => $torole,
						'remarkd_by' => $remarks_by,
						//'any_previous_complaint' => trim($this->security->xss_clean($this->input->post('any_previous_complaint'))),
					);
					$query = $this->scrutiny_model->scrutiny_update($scrutiny_upddata, $filing_no);
				}elseif($remarks_by == 4 || $remarks_by == 5){
					$scrutiny_upddata = array(
						'scrutiny_date' => date('Y-m-d'),
						'updated_date' => $ts,
						'user_id' => $this->con['id'],
						'objections' => $objections,
						'scrutiny_status' => $scr_stat,
						'remarks' => trim($this->security->xss_clean($this->input->post('remarks'))),
						'summary' => trim($this->security->xss_clean($this->input->post('summary'))),
						'summary_ts' => $ts,
						'level' => $torole,
						'remarkd_by' => $remarks_by,
						'previous_complaint_description' => trim($this->security->xss_clean($this->input->post('previous_complaint_desc'))),
						//'any_previous_complaint' => trim($this->security->xss_clean($this->input->post('any_previous_complaint'))),
					);
					$query = $this->scrutiny_model->scrutiny_update($scrutiny_upddata, $filing_no);
				}else{
					die('You do not have permission to remark!');
				}
			}else{
				die('something went wrong. Unable to insert scrutiny_history');
			}

			$torole_name = $this->scrutiny_model->get_torolename($torole);
			$torole_name = $torole_name[0]->display_name;
			if($query) 
			{
				//if($objections == 'Yes')
				//{
				
				$res = $this->defectpdf($filing_no);
				$parta = $this->partapdf($filing_no);
				$partc = $this->partcpdf($filing_no);
				if($this->input->post('comp_type')=='2')
				{
				$partb = $this->partbpdf($filing_no);
			    }

					//echo "yogendra";die;
				if($res){
					if($torole == 1 || $torole == 2 || $torole == 3 || $torole == 5 || $torole == 6){
						if(trim($this->security->xss_clean($this->input->post('par1'))) == 1){
							$this->session->set_flashdata('error_msg', 'Scrutiny processed for Diary no. '.$filing_no.' and forwarded to '.$torole_name);
							$array = array(
          			'success' => true,
       						 );
						echo  json_encode($array);

						}else{
						$this->session->set_flashdata('error_msg', 'Scrutiny processed for Diary no. '.$filing_no.' and forwarded to '.$torole_name);
						redirect('scrutiny/dashboard');
					}
					}elseif($torole == 4){
						if($comp_data['chk_cou'] && $comp_data['comp_no'] && $comp_data['year'])
						{
							if(!$chk_exist_case_det){
							$case_det_insdata = array(
								'filing_no' => $filing_no,
								'complaint_no' => $comp_data['comp_no'],
								'ref_no' => get_refno($filing_no),
								'complaint_year' => $comp_data['year'],
								'entry_date' => date('Y-m-d H:i:s'),
							);
							$query2 = $this->scrutiny_model->case_det_ins($case_det_insdata);

										//set case_initialisation
							$upd_data = array(
								'complaint_counter' => $comp_data['counter']
							);
							$this->scrutiny_model->update_year_initialisation($comp_data['year'], $upd_data);

							$ts = date('Y-m-d H:i:s', time());
							$insert_data = array(
								'ref_no' => get_refno($filing_no),
								'user_id' => $this->con['id'],
								'filing_no' => $filing_no,
								'complaint_no' => $comp_data['comp_no'],
								'created_at' => $ts,
								'ip' => get_ip(),
							);
							$this->scrutiny_model->update_comp_his($insert_data);
						}

							$this->session->set_flashdata('success_msg', 'Scrutiny successfully completed for Diary no. '.$filing_no.' without defects and forwarded to chairperson .');
							redirect('scrutiny/dashboard');
						}else{
							die('Unable to generate complaint no. Contact Admin');
						}

					}
				}else{
					die('unable to generate pdf');
				}
				//}
				/*elseif($objections == 'No')
				{

					if($comp_data['chk_cou'] && $comp_data['comp_no'] && $comp_data['year'])
      				{

						$case_det_insdata = array(
							        'filing_no' => $filing_no,
							        'complaint_no' => $comp_data['comp_no'],
							        'ref_no' => get_refno($filing_no),
							        'complaint_year' => $comp_data['year'],
							        'entry_date' => date('Y-m-d H:i:s'),
							        );
						$query2 = $this->scrutiny_model->case_det_ins($case_det_insdata);

										//set case_initialisation
						$upd_data = array(
				          'complaint_counter' => $comp_data['counter']
				        );
				        $this->scrutiny_model->update_year_initialisation($comp_data['year'], $upd_data);

				        $ts = date('Y-m-d H:i:s', time());
				        $insert_data = array(
				          'ref_no' => get_refno($filing_no),
				          'user_id' => $this->con['id'],
				          'filing_no' => $filing_no,
				          'complaint_no' => $comp_data['comp_no'],
				          'created_at' => $ts,
				          'ip' => get_ip(),
				        );
				        $this->scrutiny_model->update_comp_his($insert_data);

						$this->session->set_flashdata('success_msg', 'Scrutiny successfully completed for Diary no. '.$filing_no.' without defects and forwarded to chairperson .');
						redirect('scrutiny/dashboard');
				}else{
						die('Unable to generate complaint no. Contact Admin');
				}
			}*/
		} 
		else
		{
			die('something went wrong. Unable to update scrutiny');
		}
	}else{
		die('parameters missing');
	}
}

public function partbpdf($filing_no)
	{
	$this->load->helper("date_helper");  
	$chkdate= date("l jS \of F Y");
	$ref_no = $this->causelist_model->getRefNo($filing_no);
    $refe_no=$ref_no[0]->ref_no;
    $farmadata = $this->common_model->getFormadata($refe_no);
    $myArray=(array)$farmadata;
 	$cp=$myArray[0]->complaint_capacity_id ?? '';
	 $complaint_capacity = $this->report_model->getComplaincapicity($cp);
	 $complaint_desc= $complaint_capacity['complaint_capacity_desc'];	
if($cp >1)
{

  $datapartb = $this->report_model->getPartbdata($refe_no);

  $orgn_referred_india=$datapartb['orgn_referred_india'] ?? '';

  if($orgn_referred_india ==1)
  {

    $orgn_referred_india='Yes';
  }
  else
  {
    $orgn_referred_india='No';
  }
  $cert_regInc_encl=$datapartb['cert_regInc_encl'] ?? '';
  if($cert_regInc_encl ==1)
  {
    $cert_regInc_encl='Yes';
  }
  else
  {
    $cert_regInc_encl='No';
  }
  $auth_ireginc=$datapartb['auth_ireginc'] ?? '';
  $o_add1=$datapartb['o_add1'] ?? '';
  $o_hpnl=$datapartb['o_hpnl'] ?? '';
  $o_vill_city=$datapartb['o_vill_city'] ?? '';

  $wstate_id =$datapartb['o_state_id'] ?? '';

  if($wstate_id !='')
  {
    $wstate = $this->report_model->getPstate($wstate_id);
    $wstatenamee=$wstate['name'];
  }
  else
  {
    $wstatenamee='';
  }
  $wdist_id =$datapartb['o_dist_id'] ?? '';

  if($wdist_id !='')
  {
    $wdist = $this->report_model->getPdistrict($wstate_id,$wdist_id);
    $wdistrictnamee=$wdist['name'];
  }
  else
  {
    $wdistrictnamee='';
  }
  $o_pin_code=$datapartb['o_pin_code'] ?? '';
  $o_tel_no=$datapartb['o_tel_no'] ?? '';
  $o_promob_no=$datapartb['o_promob_no'] ?? '';
  $o_email_id=$datapartb['o_email_id'] ?? '';
  $o_country_id=$datapartb['o_country_id'] ?? '';
  $wcountry_id =$datapartb['o_country_id'] ?? '';
  if($wcountry_id !='')
  {
    $wcountry = $this->report_model->getNationality($wcountry_id);
    $wcountrynamee=$wcountry['nationality_desc'];
  }
  else
  {
    $wcountrynamee='';
  }
  $h_sur_name=$datapartb['h_sur_name'] ?? '';
  $h_mid_name=$datapartb['h_mid_name'] ?? '';
  $h_first_name=$datapartb['h_first_name'] ?? '';
  $h_salutation_id=$datapartb['h_salutation_id'] ?? '';
  $org_psid=$datapartb['h_salutation_id'] ?? '';
  if($org_psid !='')
  {
    $pssalution = $this->report_model->getSalutation($org_psid);
    $orgtile_desc=$pssalution['salutation_desc'];
  }
  else
  {
   $orgtile_desc='';
 }
 $a_sur_name=$datapartb['a_sur_name'] ?? '';
 $a_mid_name=$datapartb['a_mid_name'] ?? '';
 $a_first_name=$datapartb['a_first_name'] ?? '';
 $a_age_years=$datapartb['a_age_years'] ?? '';
 $psid=$datapartb['a_salutation_id'] ?? '';
 if($psid !='')
 {
  $pssalution = $this->report_model->getSalutation($psid);
  $pstitile_desc=$pssalution['salutation_desc'];
}
else
{
 $pstitile_desc='';
}
$org_gid=$datapartb['a_gender_id'] ?? '';
if($org_gid !='')
{
  $wgender = $this->report_model->getGender($org_gid);
  $org_gen_desc=$wgender['gender_desc'];
}
else
{
  $org_gen_desc='';
}

$aidentity_proof_vupto=$datapartb['aidentity_proof_vupto'] ?? '';
$aidentity_proof_vupto=get_displaydate($aidentity_proof_vupto);
$aidentity_proof_iauth=$datapartb['aidentity_proof_iauth'] ?? '';
$aidentity_proof_doi=$datapartb['aidentity_proof_doi'] ?? '';
$aidentity_proof_doi=get_displaydate($aidentity_proof_doi);

$aidentity_proof_no=$datapartb['aidentity_proof_no'] ?? '';     
$org_id=$datapartb['aidentity_proof_id'] ?? '';    
if($org_id !='')
{
  $org_identity = $this->report_model->getIdentity($org_id);
  $org_identity=$org_identity['Identity_proof_desc'] ?? '';
}
else
{
  $org_identity='';
}
$org_id=$datapartb['a_nationality_id'] ?? '';
if($org_id !='')
{
  $wcountry = $this->report_model->getNationality($org_id);
  $org_countryname=$wcountry['nationality_desc'];
}
else
{
  $org_countryname='';
}

$aidres_proof_no=$datapartb['aidres_proof_no'] ?? '';
$aidres_proof_doi=$datapartb['aidres_proof_doi'] ?? '';
$aidres_proof_vupto=$datapartb['aidres_proof_vupto'] ?? '';
$aidres_proof_iauth=$datapartb['aidres_proof_iauth'] ?? ''; 
$wc_id =$datapartb['aidres_proof_id'] ?? '';
if($wc_id !='')
{
  $wcountry = $this->report_model->getResidence($wc_id);
  $wcountryname=$wcountry['idres_proof_desc'];
}
else
{
  $wcountryname='';
}

$ap_add1=$datapartb['ap_add1'] ?? '';
$ap_hpnl=$datapartb['ap_hpnl'] ?? '';
$ap_vill_city=$datapartb['ap_vill_city'] ?? '';
$ap_pin_code=$datapartb['ap_pin_code'] ?? '';  
$org_wstateid =$datapartb['ap_state_id'] ?? '';
if($org_wstateid !='')
{
  $wstate = $this->report_model->getPstate($org_wstateid);
  $org_wstatename=$wstate['name'];
}
else
{
  $org_wstatename='';
}
$org_wdistid =$datapartb['ap_dist_id'] ?? '';

if($org_wdistid !='')
{
  $org_wdist = $this->report_model->getPdistrict($org_wstateid,$org_wdistid);
  $org_wdist=$org_wdist['name'];
}
else
{
  $org_wdist='';
}

$org_wc_id=$datapartb['ap_country_id'] ?? '';
if($org_wc_id !='')
{
  $org_wcountry = $this->report_model->getNationality($org_wc_id);
  $org_wcountry=$org_wcountry['nationality_desc'];
}
else
{
  $org_wcountry='';
}

$ac_add1=$datapartb['ac_add1'] ?? '';
$ac_hpnl=$datapartb['ac_hpnl'] ?? '';
$ac_vill_city=$datapartb['ac_vill_city'] ?? '';
$ac_pin_code=$datapartb['ac_pin_code'] ?? '';  
$org_per_id =$datapartb['ac_state_id'] ?? '';
if($org_per_id !='')
{
  $wstate = $this->report_model->getPstate($org_per_id);
  $org_per_state_name=$wstate['name'];
}
else
{
  $org_per_state_name='';
}
$org_co_id =$datapartb['ac_dist_id']  ?? '';

if($org_co_id !='')
{
  $wdist = $this->report_model->getPdistrict($org_per_id,$org_co_id);
  $org_co_dist_name=$wdist['name'];
}
else
{
  $org_co_dist_name='';
}

$org_co_country_id=$datapartb['ac_country_id'] ?? '';
if($org_co_country_id !='')
{
  $wcountry = $this->report_model->getNationality($org_co_country_id);
  $org_co_countryname=$wcountry['nationality_desc'];
}
else
{
  $org_co_countryname='';
}

$aoccu_desig_avo=$datapartb['aoccu_desig_avo'] ?? '';
$atel_no=$datapartb['atel_no'] ?? '';
$amob_no=$datapartb['amob_no'] ?? '';
$email_id=$datapartb['email_id'] ?? '';
$auth_doc_encl=$datapartb['auth_doc_encl'] ?? '';
if($auth_doc_encl =='1')
{
  $auth_doc_encl='Yes';
}
else
{
  $auth_doc_encl='No';
}
$affect_3rdparty=$datapartb['affect_3rdparty'] ?? '';
if($affect_3rdparty =='f')
{
  $affect_3rdparty='Yes';
}
else
{
  $affect_3rdparty='No';
}
$affect_office_beared=$datapartb['affect_office_beared'] ?? '';
/*form b end here */

/* Office beare start here  if necessary then we implment it*/


$comp_no= get_complaintno($filing_no);
$officebeare = $this->report_model->getOfficebeare($refe_no);

$officebeareCount=count($officebeare);

$officebearsList ='';
$rowNo = 1;
if($officebeare){
  foreach ($officebeare as $key => $value) {
   $officebearsList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Office Bearer -  '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Name <br> </td>
   <td style="border: 1px solid black;">'.$value->ob_first_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->ob_age_years.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->ob_p_add1.'</td>
   </tr>

    <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Telephone Number(with std code) <br>

   </td><td style="border: 1px solid black;">'.$value->ob_tel_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Mobile Number <br>

   </td><td style="border: 1px solid black;">'.$value->ob_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">e-mail id: <br>
   </td><td style="border: 1px solid black;">'.$value->ob_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}


/*  additional party start here for part B  */

$addparty = $this->report_model->getAddparties($refe_no);

 $addpartyCount_b=count($addparty);


$additionalpartyList ='';
$rowNo = 1;
if($addparty){
  foreach ($addparty as $key => $value) {
   $additionalpartyList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Third Party - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(a)</td>
   <td style="border: 1px solid black;"> Name <br> </td>
   <td style="border: 1px solid black;">'.$value->affect_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;"> Gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(c)</td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->affect_ageyears.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(d)</td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->affect_hpnl.' , '.$value->affect_vill_city.'</td>
   </tr>

    <tr>
   <td style="border: 1px solid black;" align="center">(e)</td>
   <td style="border: 1px solid black;">Telephone Number(with std codes) <br>

   </td><td style="border: 1px solid black;">'.$value->affect_tel_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;">Mobile No <br>

   </td><td style="border: 1px solid black;">'.$value->affect_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(f)</td>
   <td style="border: 1px solid black;">e-mail Id <br>
   </td><td style="border: 1px solid black;">'.$value->affect_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}

}
 ini_set('set_time_limit', 0);
ini_set('memory_limit', '-1');
ini_set('xdebug.max_nesting_level', 2000);
$this->html2pdf->folder(''.FCPATH.'cdn/complainpdf/scrutiny_pdf/partb/');
$this->html2pdf->paper('A4', 'portrait', 'fr');	
$getallwidget =     
'
<div align="center"><b>ANNEXURE</b></div>
<div align="center">FORM OF COMPLAINT</div>
<br>
<div align="center">[See rule 3]</div>
<br>
 <div align="center"><b>PART B</b><br></div> 
<br>
<div>ADDITIONAL DETAILS TO BE FURNISHED BY THE SIGNATORY TO THE COMPLAINT IF THE <br>
  COMPLAINT IS BEING FILED ON BEHALF OF A BODY OR BOARD OR CORPORATION OR <br>
  AUTHORITY OR COMPANY, SOCIETY OR ASSOCIATION OF PERSONS OR TRUST OR LIMITED <br>
  LIABILITY PARTNERSHIP <br>
  </div><br>
<br><br>
<div align="left">Complaint Number : <b>'.$comp_no.' </b></div>
<div align="right">Diary Number : <b>'.$myArray[0]->filing_no.' </b></div>

<div align="left">Specify if the complaint is being made by : <b>'.$complaint_desc.' </b></div>

<br> <br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
  
  <tr>
  <td style="border: 1px solid black;" align="center">1.</td>
  <td style="border: 1px solid black;">In case the complaint is made by a body or board or <br> corporation or authority or company, society,assosiation of persons or trust or limited liability partnership,then please indicate:
  </td><td style="border: 1px solid black;"></td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(a)</td>
  <td style="border: 1px solid black;">Whether such organisation as referred to above is based in India ?
  </td><td style="border: 1px solid black;" align="center">'.$orgn_referred_india.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(b)</td>
  <td style="border: 1px solid black;">If the answer to (a) above is "YES" then whether the certificate <br> of registration/incorporation <br>
 <i> [ as issued by the authority competent to
issue such certificate in India or by
authority competent to issue such
certificate as per the regulating law of
the Foreign State, as the case may be],</i><br>
in respect of such organisation has been
enclosed?
  </td><td style="border: 1px solid black;" align="center">'.$cert_regInc_encl.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(c)</td>
  <td style="border: 1px solid black;">Indicate the name of the competent authority which has issue the certificate registration/incorporation of the organisation
  </td><td style="border: 1px solid black;">'.$auth_ireginc.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center">(d)</td>
  <td style="border: 1px solid black;">Address of correspondence with the organisation<br>                 
  </td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$o_hpnl.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$wdistrictnamee.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$wstatenamee.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$wcountrynamee.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">(f)</td>
  <td style="border: 1px solid black;">Telephone Number (with STD codes)<br>                 
  </td><td style="border: 1px solid black;">'.$o_tel_no.'</td></tr>               
  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Mobile Number                
  </td><td style="border: 1px solid black;">'.$o_promob_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">(g)</td>
  <td style="border: 1px solid black;">e-mail id              
  </td><td style="border: 1px solid black;">'.$o_email_id.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">2.</td>
  <td style="border: 1px solid black;">Personal details of office bearers <br>
  and head of the organisation                
  </td><td style="border: 1px solid black;">furnish details in respect of each Office Bearer and <br>
  Head of organisation in the format as contained in Part A of this form.<br>
  [please see section 47 of the Act] </td>         
  </tr>                    ';

  
  
  $getallwidget .='                    
  <tr>
  <td style="border: 1px solid black;" align="center"></td>
  <td style="border: 1px solid black;">Number of Office beare: <br>

  </td><td style="border: 1px solid black;">'.$officebeareCount.'</td>
  </tr>';

  $getallwidget .=$officebearsList;

  $getallwidget .='                            
  
  <tr>
  <td style="border: 1px solid black;" align="center">3.</td>
  <td style="border: 1px solid black;">Details of the person who has authorised the signatory<br>to file the complaint on 
  behalf of the organisation</td><td style="border: 1px solid black;">'.$h_first_name.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">4.</td>
  <td style="border: 1px solid black;">Name of the person authorising the signatory to file the complaint(in block letters)</td><td style="border: 1px solid black;"></td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Title<br>                 
  </td><td style="border: 1px solid black;">'.$pstitile_desc.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Sur Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_sur_name.'</td>
  </tr> 

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Mid Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_mid_name.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">First Name<br>                 
  </td><td style="border: 1px solid black;">'.$a_first_name.'</td>
  </tr> 
  <tr>
  <td style="border: 1px solid black;" align="center">5.</td>
  <td style="border: 1px solid black;">Gender</td><td style="border: 1px solid black;">'.$org_gen_desc.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;" align="center">6.</td>
  <td style="border: 1px solid black;">Age</td><td style="border: 1px solid black;">'.$a_age_years.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;" align="center">7.</td>
  <td style="border: 1px solid black;">Nationality</td><td style="border: 1px solid black;">'.$org_countryname.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">8.</td>
  <td style="border: 1px solid black;">Details of identity/residence proof of the person authorising the signatory enclosed with the complaint</td><td style="border: 1px solid black;"></td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Document attached<br>                 
  </td><td style="border: 1px solid black;">'.$org_identity.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(a)Number<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(b)Date of Issue<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_doi.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(c)Validity upto<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_vupto.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">(d)Issuing Authority<br>                 
  </td><td style="border: 1px solid black;">'.$aidentity_proof_iauth.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">9.</td>
  <td style="border: 1px solid black;">Permanent Address of person authorising the signatory</td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$ap_hpnl.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$org_wdist.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$org_wstatename.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$org_wcountry.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Pincode/Postal code or Zonal Code<br>                 
  </td><td style="border: 1px solid black;">'.$ap_pin_code.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">10.</td>
  <td style="border: 1px solid black;">Address for correspondence</td><td style="border: 1px solid black;"></td>
  </tr>

  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">House/Property Number/Locality<br>                 
  </td><td style="border: 1px solid black;">'.$ac_hpnl.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Village/District/City<br>                 
  </td><td style="border: 1px solid black;">'.$org_co_dist_name.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">State<br>                 
  </td><td style="border: 1px solid black;">'.$org_per_state_name.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Country<br>                 
  </td><td style="border: 1px solid black;">'.$org_co_countryname.'</td>
  </tr>
  <tr>
  <td style="border: 1px solid black;"></td>
  <td style="border: 1px solid black;">Pincode/Postal code or Zonal Code<br>                 
  </td><td style="border: 1px solid black;">'.$ac_pin_code.'</td>
  </tr>
  
  <tr>
  <td style="border: 1px solid black;" align="center">11.</td>
  <td style="border: 1px solid black;">Occupation/designation/avocation:</td><td style="border: 1px solid black;">
  '.$aoccu_desig_avo.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">12(a).</td>
  <td style="border: 1px solid black;">Telephone Number(with STD codes)</td><td style="border: 1px solid black;">
  '.$atel_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">12(b).</td>
  <td style="border: 1px solid black;">Mobile Number</td><td style="border: 1px solid black;">
  '.$amob_no.'</td>
  </tr>

  <tr>
  <td style="border: 1px solid black;" align="center">13.</td>
  <td style="border: 1px solid black;">Email id</td><td style="border: 1px solid black;">
  '.$email_id.'</td>
  </tr>
  
  <tr>
  <td style="border: 1px solid black;" align="center">14.</td>
  <td style="border: 1px solid black;">Whether an authorisation document has been enclosed ?</td><td style="border: 1px solid black;">
  '.$auth_doc_encl.'</td>
  </tr>';



  $getallwidget .='
  
  <tr>
  <td style="border: 1px solid black;" align="center">15.</td>
  <td style="border: 1px solid black;">Details of third party, if any, likely to be
affected by the complaint <br>

  </td><td style="border: 1px solid black;">'.$addpartyCount_b.'</td>
  </tr>

  <br><br><br>
<div align="right"><b>                                              Signature of the complaint/<br>
authorised signatory    </div></b> 
<div>   Place :  '.$myArray[0]->comp_f_place.'</div>
<div>Date  : '.$chkdate.'</div>



<br></br><br></br><br>
  ';

  $getallwidget .=  $additionalpartyList;

   $file                           =    'partb'.'_'.$filing_no;
	$filename                       =     $file;
	$html                       =     $getallwidget;
	$this->html2pdf->filename($filename.".pdf");
	$this->html2pdf->html($html);
	$partb = $this->html2pdf->create('save');
	return $partb;
    
    exit;

	}

public function partcpdf($filing_no)
{
	$this->load->helper("date_helper");  
	$chkdate= date("l jS \of F Y");
	$ref_no = $this->causelist_model->getRefNo($filing_no);
	$refe_no=$ref_no[0]->ref_no;
	$comp_no= get_complaintno($filing_no);
	$farmadata = $this->common_model->getFormadata($refe_no);
	$myArray=(array)$farmadata;
	$cp=$myArray[0]->complaint_capacity_id ?? '';
	$complaint_capacity = $this->report_model->getComplaincapicity($cp);
	$complaint_desc= $complaint_capacity['complaint_capacity_desc'];


	$datac = $this->report_model->getPartc($refe_no);
	$psid=$datac['ps_salutation_id'] ?? '';
	if($psid !='')
	{
	$pssalution = $this->report_model->getSalutation($psid);
	$pstitile_desc=$pssalution['salutation_desc'];
	}
  else
  {
   $pstitile_desc='';
 }
 $pssurname=$datac['ps_sur_name'] ?? '';
 $psmidname=$datac['ps_mid_name'] ?? '';
 $psfirstname=$datac['ps_first_name'] ?? '';

 $partcname=$psfirstname.' '.$psmidname.' '.$pssurname;
 $pssdsp=$datac['ps_dsp_lp'] ?? '';
 if($pssdsp=='1')
 {
  $pssdsp='Yes';
}
else
{
  $pssdsp='No';
}
$psdesig=$datac['ps_desig'] ?? '';
$psothcate=$datac['ps_othcate'] ?? '';
$psorgn=$datac['ps_orgn'] ?? '';
$psfingoi=$datac['tas_fingoi'] ?? '';
$present_ps_desig=$datac['present_ps_desig'] ?? '';


if($psfingoi =='1')
{
  $psfingoi='Yes';
}
elseif($psfingoi =='2')
{
  $psfingoi='No';
}
else
{
  $psfingoi='N/A';
}


$psonecr=$datac['anninc_onecr'] ?? '';
if($psonecr =='1')
{
  $psonecr='Yes';
}
elseif($psonecr =='2')
{
  $psonecr='No';
}
else
{
  $psonecr='N/A';
}
$psdonafs=$datac['dona_fs'] ?? '';
if($psdonafs =='1')
{
  $psdonafs='Yes';
}
elseif($psdonafs =='2')
{
  $psdonafs='No';
}
else
{
  $psdonafs ='N/A';
}


$ps_psssbbca=$datac['pss_sbbca'] ?? '';
if($ps_psssbbca ='1')
{
  $ps_psssbbca="Yes";

}
else
{
  $ps_psssbbca="No";

}

$postheld=$datac['psc_postheld'] ?? '';



/*
$psectorid =$datac['complaint_capacity_id'] ?? '';
if($psectorid !='')
{
  $pssalution = $this->report_model->getPublicsector($psectorid);
  $ccapacity=$pssalution['complaint_capacity_desc'];
}
else
{
 $ccapacity='';
}
 
$subcat =$datac['ps_id'] ?? '';
if($subcat !='')
{
  $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
  $subcat_desc=$pssubcat['ps_desc'] ;
}
else
{
  $subcat_desc='';
}*/

$getscrutinyCategory = $this->reports_model->getscrutinyCategory($filing_no);
 $sc_complaint_capacity_desc=$getscrutinyCategory[0]->complaint_capacity_desc ?? '';
 $sc_ps_desc=$getscrutinyCategory[0]->ps_desc ?? '';

if (!empty($sc_complaint_capacity_desc))
{
$ccapacity=$sc_complaint_capacity_desc;
$subcat_desc=$sc_ps_desc;
}
else
{
$psectorid =$datac['complaint_capacity_id'] ?? '';
$pssalution = $this->report_model->getPublicsector($psectorid);
 $ccapacity=$pssalution['complaint_capacity_desc'];
 $subcat =$datac['ps_id'] ?? '';
 $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
 $subcat_desc=$pssubcat['ps_desc'] ;
}

$cstateid =$datac['ps_pl_stateid'] ?? '';
if($cstateid !='')
{
  $cstate = $this->report_model->getPstate($cstateid);
  $c_statename=$cstate['name'];
}
else
{
  $c_statename='';
}
$cdistid =$datac['ps_pl_dist_id'] ?? '';
if($cdistid !='')
{
  $cdist = $this->report_model->getPdistrict($cstateid,$cdistid);
  $c_districtname=$cdist['name'];
}
else
{
  $c_districtname='';
}
$periodf_coa=$datac['periodf_coa'] ?? '';
$periodf_coa=get_displaydate($periodf_coa);
$periodt_coa=$datac['periodt_coa'] ?? '';
$periodt_coa=get_displaydate($periodt_coa);
$ps_pl_occ=$datac['ps_pl_occ'] ?? '';
$sum_facalle=$datac['sum_facalle'] ?? '';
$det_offen=$datac['det_offen'] ?? '';
$prov_viola=$datac['prov_viola'] ?? '';
$any_othInfo=$datac['any_othInfo'] ?? '';
$relied_doc_list=$datac['relied_doc_list'] ?? '';
$doc_copy_attached=$datac['doc_copy_attached'] ?? '';

$doc_copy_attached=$datac['doc_copy_attached'] ?? '';
if($doc_copy_attached =='1')
{
  $doc_copy_attached='Yes';
}
else
{
  $doc_copy_attached='No';
}

$electronic_file=$datac['electronic_file'] ?? '';

$electronic_file=$datac['electronic_file'] ?? '';
if($electronic_file =='1')
{
  $electronic_file='Yes';
}
else
{
  $electronic_file='No';
}


/*end partc part*/

/*    detail of category correction   */
/*
$getscrutinyCategory = $this->report_model->getscrutinyCategory($filing_no);
$sc_complaint_capacity_desc=$getscrutinyCategory[0]->complaint_capacity_desc ?? '';
$sc_ps_desc=$getscrutinyCategory[0]->ps_desc ?? '';
*/

$scCategory ='';
if(!empty($sc_complaint_capacity_desc)){


//echo "<pre>";
//print_r($datac);
 $psectorid =$datac['complaint_capacity_id'] ?? '';
$pssalution = $this->report_model->getPublicsector($psectorid);
 $ccapacity_h=$pssalution['complaint_capacity_desc'];
 $subcat =$datac['ps_id'] ?? '';
 $pssubcat = $this->report_model->getSubcategory($psectorid,$subcat);
 $subcat_desc_h=$pssubcat['ps_desc'] ;

$scCategory .= ' 
<td style="border: 1px solid black;">Category <br>
</td><td style="border: 1px solid black;">'.$ccapacity_h.'</td>
<td style="border: 1px solid black;">Sub Category <br>
</td><td style="border: 1px solid black;">'.$subcat_desc_h.'</td>
</tr>';
}
else
{
$scCategory .= '
<tr>
<td style="border: 1px solid black;" align="center">Nill</td>
</tr>';
}





/*  start part witness detail  */
$datawitness = $this->report_model->getPartc_Witness($refe_no);
$witnesscount=count($datawitness);

$witnessesList ='';
$rowNo = 1;
if($datawitness){
  foreach ($datawitness as $key => $value) {
  
   $witnessesList .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Witness - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(b) Name: <br> </td>
   <td style="border: 1px solid black;">'.$value->w_first_name.' '.$value->w_mid_name.' '.$value->w_sur_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(c) Gender: <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(d) Age: <br>

   </td><td style="border: 1px solid black;">'.$value->w_age_years.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(e) Full Address: <br>
   </td><td style="border: 1px solid black;">'.$value->w_hpnl.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(f) Mobile No: <br>

   </td><td style="border: 1px solid black;">'.$value->w_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">(g) E-mail Id: <br>
   </td><td style="border: 1px solid black;">'.$value->w_email_id.'</td>
   </tr>';
   $rowNo++;
 }
}

$addparty_partc = $this->report_model->getAddparties_partc($refe_no);

$addpartyCount=count($addparty_partc);


$additionalpartyList_PartC ='';
$rowNo = 1;
if($addparty_partc){
  foreach ($addparty_partc as $key => $value) {
   $additionalpartyList_PartC .= '
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">Third Party - '.$rowNo.'<br> </td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center">(a)</td>
   <td style="border: 1px solid black;"> Name <br> </td>
   <td style="border: 1px solid black;">'.$value->affect_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;"> Gender <br>

   </td><td style="border: 1px solid black;">'.$value->gender_desc.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(c)</td>
   <td style="border: 1px solid black;">Age <br>

   </td><td style="border: 1px solid black;">'.$value->affect_ageyears.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(d)</td>
   <td style="border: 1px solid black;">Full Address <br>
   </td><td style="border: 1px solid black;">'.$value->affect_hpnl.' , '.$value->affect_vill_city.'</td>
   </tr>

  <tr>
   <td style="border: 1px solid black;" align="center">(e)</td>
   <td style="border: 1px solid black;">Telephone Number(with std codes) <br>
   </td><td style="border: 1px solid black;">'.$value->affect_tel_no.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">(b)</td>
   <td style="border: 1px solid black;">Mobile Number <br>
   </td><td style="border: 1px solid black;">'.$value->affect_mob_no.'</td>
   </tr>
   <tr>
   <td style="border: 1px solid black;" align="center"></td>
   <td style="border: 1px solid black;">email Id <br>
   </td><td style="border: 1px solid black;">'.$value->affect_email_id.'</td>
   </tr>';
   $rowNo++;
 }

}
 else
 {
   $additionalpartyList_PartC .= '
  <tr>
   <td style="border: 1px solid black;" align="center">Nill</td>
   </tr>';
 }


//$datawitness = $this->report_model->getPartc_Witness($refe_no);
$public_servant_detail = $this->report_model->getPublic_servant_detail($refe_no);
/*
echo "<pre>";
print_r($public_servant_detail);
*/


$pscount=count($public_servant_detail);
$publicservantdetail_list ='';
$rowNo = 1;
if($public_servant_detail){
  foreach ($public_servant_detail as $key => $value) {

   //echo $value->ad_present_ps_desig;die;
      if($value->ad_ps_dsp_lp==1)
      {
        $value->ad_ps_dsp_lp='Yes';
      }
      else
      {
        $value->ad_ps_dsp_lp='No';
      }
      if($value->ad_tas_fingoi==1)
      {
        $value->ad_tas_fingoi='Yes';
      }
      else
      {
        $value->ad_tas_fingoi='No';
      }
      if($value->ad_anninc_onecr==1)
      {
        $value->ad_anninc_onecr='Yes';
      }
      else
      {
        $value->ad_anninc_onecr='No';
      }

       if($value->ad_dona_fs==1)
      {
        $value->ad_dona_fs='Yes';
      }
      else
      {
        $value->ad_dona_fs='No';
      }

       if($value->ad_pss_sbbca==1)
      {
        $value->ad_pss_sbbca='Yes';
      }
      else
      {
        $value->ad_pss_sbbca='No';
      }

       $value->ad_ps_pl_stateid;
     
       $value->ad_ps_pl_dist_id;

      $pdist_name = $this->report_model->getPdistrict($value->ad_ps_pl_stateid,$value->ad_ps_pl_dist_id);
     $p_districtname=$pdist_name['name'];


   $publicservantdetail_list .= '
    <tr>
   
   <td style="border: 1px solid black;"><b>Public Servant </b></td>
   <td style="border: 1px solid black;">'.$rowNo.'</td>
   <td style="border: 1px solid black;"></td>
   </tr>
   <tr>
  <td style="border: 1px solid black;" align="center">1.</td>
<td style="border: 1px solid black;">Name the public servent(s) against whome complaint is being made (in block letters)*:
</td>
   <td style="border: 1px solid black;">'.$value->ad_ps_first_name.' '.$value->ad_ps_mid_name.' '.$value->ad_ps_sur_name.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Present designation/status of the public servant(s) against whome complaint is being made:
</td>
   </td><td style="border: 1px solid black;">'.$value->ad_present_ps_desig.'</td>
   </tr>

   <tr>
   <td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Whether the complaint is against any
officer or employee or agency(including the Delhi Special Police Establishment), under or associated with the Lokpal ?
</td>
   </td>

   <td style="border: 1px solid black;">'.$value->ad_ps_dsp_lp.'</td>
   </tr>
       <tr>
<td style="border: 1px solid black;" align="center">4</td>
<td style="border: 1px solid black;">With respect to serial no. 2 above,indicate: </td><td style="border: 1px solid black;"></td>
</tr>

    <tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Designation of the officer/emplyee</td><td style="border: 1px solid black;">
'.$value->ad_ps_desig.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Organisation/Agency having administrative control over the said officer/employee</td>
<td style="border: 1px solid black;">
'.$value->ad_ps_orgn.'</td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">5(a).</td>
<td style="border: 1px solid black;">Category of the public servant against whome the complaint <br> is being made</td><td style="border: 1px solid black;">
'.$value->complaint_capacity_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Sub Category</td><td style="border: 1px solid black;">
'.$value->ps_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">5(b).</td>
<td style="border: 1px solid black;">In case the complaint is against any other category of public servant, specify
</td><td style="border: 1px solid black;">'.$value->ad_ps_othcate.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;">In case the complaint is against any Chairperson/Member <br>
Officer/Employee of or a trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">(a)</td>
<td style="border: 1px solid black;">Whether the organisation is wholly or partly financed by the <br>the Government      Officer/Employee of or a trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;">'.$value->ad_tas_fingoi.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(b)</td>
<td style="border: 1px solid black;">Whether the annual income of the organisation exceeds one crore rupees as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$value->ad_anninc_onecr.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(c)</td>
<td style="border: 1px solid black;">Whether the organisation is in receipt of any donation from any foreign source under the foreign contribution  income of the organisation exceeds one crore rupees <br>
as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$value->ad_dona_fs.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;">Please state, if aware, as to whether the public servant is presently serving the afair of the state or in any body or board or corruption or authority,etc establish by an act of the state legislature or wholly or partily financed by the State Government or controlled by it.
</td><td style="border: 1px solid black;">'.$value->ad_pss_sbbca.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;">Post held by the public servant at the time of commission of alleged offence under the Prevention of Corruption Act 1988.
</td><td style="border: 1px solid black;">'.$value->ad_psc_postheld.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;">Details of the Cause of Action/offence(under the Prevention of Corruption Act, 1988).
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(i) Period during which alleged misconduct was committed.
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">from
</td><td style="border: 1px solid black;">'.get_displaydate($value->ad_periodf_coa).'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">to
</td><td style="border: 1px solid black;">'.get_displaydate($value->ad_periodt_coa).'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(ii)Place of Occurrence:
</td><td style="border: 1px solid black;">'.$value->ad_ps_pl_occ.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iii) District:
</td><td style="border: 1px solid black;">'.$p_districtname.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iv) State:
</td><td style="border: 1px solid black;">'.$value->name.'</td>
</tr>';
   $rowNo++;
 }
}
else
 {
   $publicservantdetail_list .= '
  <tr>
   <td style="border: 1px solid black;" align="center">Nill</td>
   </tr>';
 }

 ini_set('set_time_limit', 0);
ini_set('memory_limit', '-1');
ini_set('xdebug.max_nesting_level', 2000);
$this->html2pdf->folder(''.FCPATH.'cdn/complainpdf/scrutiny_pdf/partc/');
$this->html2pdf->paper('A4', 'portrait', 'fr');	
$getallwidget =     
'
<div align="center"><b>ANNEXURE</b></div>
<div align="center">FORM OF COMPLAINT</div>
<br>
<div align="center">[See rule 3]</div>
<br>
<div align="center">PART C</div> 
<br>
<div>DETAILS TO BE FURNISHED BY THE COMPLAINT/SIGNATORY TO THE COMPLAINT</div>
<br><br>
<div align="left">Complaint Number : <b>'.$comp_no.' </b></div>
<div align="right">Diary Number : <b>'.$myArray[0]->filing_no.' </b></div>

<div align="left">Specify if the complaint is being made by : <b>'.$complaint_desc.' </b></div>

<br> <br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">

<tr>
<td style="border: 1px solid black;" align="center">1.</td>
<td style="border: 1px solid black;">Name the public servent(s) against whome complaint is being made (in block letters)*:
</td><td style="border: 1px solid black;">'.$partcname.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Present designation/status of the public servant(s) against whome complaint is being made
</td><td style="border: 1px solid black;">'.$present_ps_desig.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Whether the complaint is against any officer or employee or agency (including the Delhi special police establishment), under or associated with the lokpal ?
</td><td style="border: 1px solid black;">'.$pssdsp.'</td>
</tr> 

<tr>
<td style="border: 1px solid black;" align="center">4.</td>
<td style="border: 1px solid black;">With respect to serial no. 2 above,indicate</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Designation of the officer/employee</td><td style="border: 1px solid black;">'.$psdesig.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Organisation/Agency having administrative control over the said officer/employee</td><td style="border: 1px solid black;">'.$psorgn.'</td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">5(a).</td>
<td style="border: 1px solid black;">Category of the public servant against whome the complaint <br> is being made</td><td style="border: 1px solid black;">
'.$ccapacity.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Sub Category</td><td style="border: 1px solid black;">
'.$subcat_desc.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">5(b).</td>
<td style="border: 1px solid black;">In case the complaint is against any other category of public servant, specify
</td><td style="border: 1px solid black;">'.$psothcate.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;">In case the complaint is against any Chairperson/Member <br>
Officer/Employee of a Trust or an Association of Persons or Society,indicate:
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">(a)</td>
<td style="border: 1px solid black;">Whether the organisation is wholly or partly financed by the <br>the Government.
</td><td style="border: 1px solid black;">'.$psfingoi.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(b)</td>
<td style="border: 1px solid black;">Whether the annual income of the organisation exceeds one crore rupees as specified by the Central Government.
</td><td style="border: 1px solid black;">'.$psonecr.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">(c)</td>
<td style="border: 1px solid black;">Whether the organisation is in receipt of any donation from any <br> foreign source under the Foreign Contribution(Regulation) Act,2010
<br>in access of ten lakh rupees in a year ?<br>
</td><td style="border: 1px solid black;">'.$psdonafs.'</td>
</tr>                  
<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;">Please state, if aware, as to whether the public servant is presently serving the affairs of the State or in any body or Board or corporation or authority,etc. established by an Act of the State Legislature or wholly or partly financed by the State Government or controlled by it ?.
</td><td style="border: 1px solid black;">'.$ps_psssbbca.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;">Post held by the public servant at the time of commission of alleged offence under the Prevention of Corruption Act, 1988.
</td><td style="border: 1px solid black;">'.$postheld.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;">Details of the Cause of Action/Offence <br>(under the Prevention of Corruption Act,1988).
</td><td style="border: 1px solid black;"></td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(i)Period During which alleged misconduct was committed
</td><td style="border: 1px solid black;"></td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">From
</td><td style="border: 1px solid black;">'.$periodf_coa .'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">To
</td><td style="border: 1px solid black;">'.$periodt_coa.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(ii) Place of Occurrence:
</td><td style="border: 1px solid black;">'.$ps_pl_occ.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iii) District:
</td><td style="border: 1px solid black;">'.$c_districtname.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(iv) State:
</td><td style="border: 1px solid black;">'.$c_statename.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">10.</td>
<td style="border: 1px solid black;">Summary of facts/allegations of corruption:
</td><td style="border: 1px solid black;">Facts and Circumstances: '.$sum_facalle.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Details of the offence alleged  under the Prevention of corruption Act <br>(Briefly indicate the facts and
consequential allegations against the
public servant which constitute
offence(s) under the Prevention of
Corruption Act, 1988) <br>

</td><td style="border: 1px solid black;">'.$det_offen.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">Allegations: <br> if possible, indicate the statutory provision alleged to have
been violated by a particular act of commission or omission

</td><td style="border: 1px solid black;">'.$prov_viola.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">11.</td>
<td style="border: 1px solid black;">Name of Witness in support of the allegations,if any: <br>

</td><td style="border: 1px solid black;"></td>
</tr>

';                  

$getallwidget .='

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;">(a) Number of witnesses: <br>

</td><td style="border: 1px solid black;">'.$witnesscount.'</td>
</tr>';

$getallwidget .=  $witnessesList;

$getallwidget .='           

<tr>
<td style="border: 1px solid black;" align="center">12.</td>
<td style="border: 1px solid black;">Paticulars/List  of the documents relied upon by the <br>Complainant in support of the
allegation:
</td><td style="border: 1px solid black;">'.$relied_doc_list.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">13.</td>
<td style="border: 1px solid black;">Any other information, the complainant desires to furnish/disclose <bt>which may be
relevant  to inquiry/investigation into the allegation of corruption.
</td><td style="border: 1px solid black;">'.$any_othInfo.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">14.</td>
<td style="border: 1px solid black;">Whether copies of the documents and other material evidence <br>(including 
electronic evidence,if any) relied upon by the complainant and referred to in the complaint have been submitted ?

</td><td style="border: 1px solid black;">'.$doc_copy_attached.'</td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">15.</td>
<td style="border: 1px solid black;">If the complaint is being filed electronically whether pdf formats of the documents and other matrial relied upon has been attached to the electronic format of the complaint
</td><td style="border: 1px solid black;">'.$electronic_file.'</td>
</tr>

</table>
<br><br>
<div><b>Category correction history (if any)-</b>
</div><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $scCategory;

$getallwidget .='
</table> 

<br><br>


<div><b>Additional Public Servant if any-</b>
</div><br><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $publicservantdetail_list;

$getallwidget .='
</table> 


<br><br><br>

<div><b>Third Party List of Part C (Respondent) if any-</b>
</div><br><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $additionalpartyList_PartC;

$getallwidget .='
</table> 

<br><br>
<div align="right"><b>                                              Signature of the complaint/<br>
authorised person </div></b> 

<br><br>




<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">            

<tr>
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Place </td><td style="border: 1px solid black;">'.$myArray[0]->comp_f_place.'</td>
</tr>
<tr>
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Date </td><td style="border: 1px solid black;">'.$chkdate.'</td>
</tr>

</table> 




<br><br><br><br><br>
 <div>     </div><br>
 
'; 


    $file                           =    'partc'.'_'.$filing_no;
	$filename                       =     $file;
				     // $this->data['main_content']           =     'view_widget_report_pdf';
	$html                       =     $getallwidget;
	$this->html2pdf->filename($filename.".pdf");
	$this->html2pdf->html($html);
	$partc = $this->html2pdf->create('save');
	return $partc;
    
    exit;

}

public function partapdf($filing_no)
{
	
  $this->load->helper("date_helper"); 
  $chkdate= date("l jS \of F Y");
  $ts = date('Y-m-d H:i:s', time());
   $ref_no = $this->causelist_model->getRefNo($filing_no);
 $refe_no=$ref_no[0]->ref_no;
  $farmadata = $this->common_model->getFormadata($refe_no);
  $myArray=(array)$farmadata;
   $cp=$myArray[0]->complaint_capacity_id ?? '';
  $data['user'] = $this->login_model->getRows($this->con);  
   
	 $partapdf='cdn/complainpdf/scrutiny_pdf/parta/'.'parta_'.$filing_no.'.'.'pdf';
	 if($cp >'1')
	 {
	 	 $partbpdf='cdn/complainpdf/scrutiny_pdf/partb/'.'partb_'.$filing_no.'.'.'pdf';
	 }
	 else
	 {
	 	$partbpdf='';
	 }
	
	 $partcpdf='cdn/complainpdf/scrutiny_pdf/partc/'.'partc_'.$filing_no.'.'.'pdf';
  	 $data['user'] = $this->login_model->getRows($this->con);
	 $query = $this->reports_model->getfilingNo_pdf_abc($filing_no);      
		if (empty($query))
		{
		
				$insert_data = array(
				'filing_no' => $filing_no,				
				'partapdf' => ($partapdf != '') ? $partapdf : NULL,
				'partbpdf' => ($partbpdf != '') ? $partbpdf : NULL,	
				'partcpdf' => ($partcpdf != '') ? $partcpdf : NULL,				
				'user_id' => $this->con['id'],
				'created_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->reports_model->partabc_insert($insert_data);
			
		}
		else
		{

				$upd_data = array(				
				'filing_no' => $filing_no,
				'partapdf' => ($partapdf != '') ? $partapdf : NULL,
				'partbpdf' => ($partbpdf != '') ? $partbpdf : NULL,	
				'partcpdf' => ($partcpdf != '') ? $partcpdf : NULL,	
				'user_id' => $this->con['id'],
				'updated_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->reports_model->partabc_update($upd_data,$filing_no);
				
		}

	$scrutinyGender = $this->reports_model->getscrutinyGender($filing_no);
	$sc_gender_desc=$scrutinyGender[0]->gender_desc ?? '';
	$myArray[0]->first_name ?? '';
	$affidavit= $myArray[0]->affidavit_upload ?? '';
	if (!empty($sc_gender_desc))
	{	
	 $gender_desc=$sc_gender_desc;
	}
	else
	{	
	$gn=$myArray[0]->gender_id ?? '';
	$genderdata = $this->report_model->getGender($gn);
	$gender_desc=$genderdata['gender_desc'];
	}

	//die('here');
  $myArray[0]->age_years ?? '';
  $myArray[0]->fath_name ?? '';
  $myArray[0]->comp_f_place ?? '';
  $myArray[0]->comp_f_date ?? '';
  $cp=$myArray[0]->complaint_capacity_id ?? '';
  $cm=$myArray[0]->complaintmode_id ?? '';
  $st=$myArray[0]->salutation_id ?? '';
 
  $na=$myArray[0]->p_country_id ?? '';
  $cn=$myArray[0]->c_country_id ?? '';
  $ide=$myArray[0]->identity_proof_id ?? '';
  $rde=$myArray[0]->idres_proof_id ?? '';
  $pstate=$myArray[0]->p_state_id ?? '';
  $cstate=$myArray[0]->c_state_id ?? '';
  $pdistrict=$myArray[0]->p_dist_id ?? '';
  $cdistrict=$myArray[0]->c_district_id ?? '';
  $pc=$myArray[0]->p_country_id ?? ''; 

  $affidavit_upload=$myArray[0]->affidavit_upload ?? '';
   $affidavitupload=base_url().$affidavit_upload.'.'.'pdf';

  $ide_dateofissue=$myArray[0]->identity_proof_doi;
  $ide_dateofissue=get_displaydate($ide_dateofissue);

  $complaint_capacity = $this->report_model->getComplaincapicity($cp);
  $complaint_desc= $complaint_capacity['complaint_capacity_desc'];
  $complaint_mode = $this->report_model->getComplaintMode($cm);
  $complaint_mode_desc=$complaint_mode['complaintmode_desc'];
  $salutationdata = $this->report_model->getSalutation($st);
  $salutation_desc=$salutationdata['salutation_desc'];

  $nationaldata = $this->report_model->getNationality($na);
  $national_desc=$nationaldata['nationality_desc'];
  $identitydata = $this->report_model->getIdentity($ide);
  $ide_desc=$identitydata['Identity_proof_desc'];
  $residencedata = $this->report_model->getResidence($rde);
  $rde_desc=$residencedata['idres_proof_desc'];
  $pstatedata = $this->report_model->getPstate($pstate);
  $pstatename=$pstatedata['name'];
  $cstatedata = $this->report_model->getPstate($cstate);
  $cstatename=$cstatedata['name'];
  $pdistrict = $this->report_model->getPdistrict($pstate,$pdistrict);
  $pdistrictname=$pdistrict['name'];
  $cdistrict = $this->report_model->getPdistrict($cstate,$cdistrict);
  $cdistrictname=$cdistrict['name'];
  $pnationality=$this->report_model->getNationality($pc);
  $pnational_desc=$pnationality['nationality_desc'];
  $cnationality=$this->report_model->getNationality($cn);
  $cnational_desc=$cnationality['nationality_desc'];

  $notory_affi=$myArray[0]->notory_affi_annex ?? '';
  if($notory_affi==1)
  {

    $notory_affi='Yes';
  }
  else
  {
    $notory_affi='No';
  }

  $c_victim=$myArray[0]->complainant_victim ?? '';
  if($c_victim==1)
  {

    $c_victim='Yes';
  }
  else
  {
    $c_victim='No';
  }

 $comp_no= get_complaintno($filing_no);

$gn=$myArray[0]->gender_id ?? '';

$scGender ='';
if(!empty($sc_gender_desc)){

	$genderdata = $this->report_model->getGender($gn);
	 $gender_desc_original=$genderdata['gender_desc'];

   $scGender .= ' 
   <td style="border: 1px solid black;">Gender <br>
   </td><td style="border: 1px solid black;">'.$gender_desc_original.'</td>
   </tr>';
}
 else
 {
   $scGender .= '
  <tr>
   <td style="border: 1px solid black;" align="center">Nill</td>
   </tr>';
 }


ini_set('set_time_limit', 0);
ini_set('memory_limit', '-1');
ini_set('xdebug.max_nesting_level', 2000);
$this->html2pdf->folder(''.FCPATH.'cdn/complainpdf/scrutiny_pdf/parta/');
$this->html2pdf->paper('A4', 'portrait', 'fr');	
$getallwidget =     
'
<div align="center"><b>ANNEXURE</b></div>
<div align="center">FORM OF COMPLAINT</div>
<br>
<div align="center">[See rule 3]</div>
<br>
<div align="center">PART A</div> 
<br>

<div>DETAILS TO BE FURNISHED BY THE COMPLAINT/SIGNATORY TO THE COMPLAINT</div>
<br><br>

<div align="left">Complaint Number : <b>'.$comp_no.' </b></div>
<div align="right">Diary Number : <b>'.$myArray[0]->filing_no.' </b></div>

<div align="left">1.Specify if the complaint is being made by : <b>'.$complaint_desc.' </b></div>

<br> <br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">

<tr>
<td style="border: 1px solid black;" align="center">2.</td>
<td style="border: 1px solid black;">Name of the Complainant(in block letters):<br><br>@attached an identity proof.
<br><br> '.$ide_desc.' </td><td></td>
</tr> 



<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Title(Shri/Smt/kum./Dr.etc.)</td><td style="border: 1px solid black;">'.$salutation_desc.' </td></tr>


<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Sur Name</td><td style="border: 1px solid black;">'.$myArray[0]->sur_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">Middle Name</td><td style="border: 1px solid black;">'.$myArray[0]->mid_name.'</td></tr>

<tr>   
<td style="border: 1px solid black;"></td>
<td style="border: 1px solid black;">First Name</td><td style="border: 1px solid black;">'.$myArray[0]->first_name.'</td></tr>




<tr>
<td style="border: 1px solid black;" align="center">3.</td>
<td style="border: 1px solid black;">Gender</td><td style="border: 1px solid black;"> '.$gender_desc.' </td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center">4.</td>
<td style="border: 1px solid black;" align"center">Age <br>[In complete years]</td><td style="border: 1px solid black;"> '.$myArray[0]->age_years.' </td></tr>
<tr>
<td style="border: 1px solid black;" align="center">5.</td>
<td style="border: 1px solid black;" align"center">Nationality</td><td style="border: 1px solid black;">'.$national_desc.' </td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center">6.</td>
<td style="border: 1px solid black;" align"center">Detail identity/residence proof to be enclosed with the complaint</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Document Attached</td><td style="border: 1px solid black;">'.$ide_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(a) Number</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_no.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(b) Date of issue</td><td style="border: 1px solid black;">'.$ide_dateofissue.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(c) Validity upto</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_vupto.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">(d)Issuing Authority</td><td style="border: 1px solid black;">'.$myArray[0]->identity_proof_iauth.' </td>
</tr>


<tr>
<td style="border: 1px solid black;" align="center">7.</td>
<td style="border: 1px solid black;" align"center">Permanent Address</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">House/Property Number/Locality</td><td style="border: 1px solid black;">'.$myArray[0]->p_hpnl.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Village/District/City</td><td style="border: 1px solid black;">'.$pdistrictname.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">State</td><td style="border: 1px solid black;">'.$pstatename.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Country</td><td style="border: 1px solid black;">'.$pnational_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Pincode/Postal code or Zonal code</td><td style="border: 1px solid black;">'.$myArray[0]->p_pin_code.' </td>
</tr>



<tr>
<td style="border: 1px solid black;" align="center">8.</td>
<td style="border: 1px solid black;" align"center">Address for Correspondence</td><td hide="true"></td>
</tr> 
<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">House/Property Number/Locality</td><td style="border: 1px solid black;">'.$myArray[0]->c_hpnl.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Village/District/City</td><td style="border: 1px solid black;">'.$cdistrictname.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">State</td><td style="border: 1px solid black;">'.$cstatename.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Country</td><td style="border: 1px solid black;">'.$cnational_desc.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center"></td>
<td style="border: 1px solid black;" align"center">Pincode/Postal code or Zonal code</td><td style="border: 1px solid black;">'.$myArray[0]->c_pin_code.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">9.</td>
<td style="border: 1px solid black;" align"center">Occupation/designation/avocation</td><td style="border: 1px solid black;">'.$myArray[0]->occu_desig_avo.' </td>
</tr>

<tr>
<td style="border: 1px solid black;" align="center">10.</td>
<td style="border: 1px solid black;" align"center">(a)Telephone Number (with ISD/STD) codes</td>
<td style="border: 1px solid black;">'.$myArray[0]->tel_no.'</td></tr>
<tr>
<td></td>
<td style="border: 1px solid black;">(b)Mobile Number (with Country code) </td>
<td style="border: 1px solid black;">'.$myArray[0]->mob_no.'</td>
</tr>
<tr>
<td style="border: 1px solid black;" align="center">11.</td>
<td style="border: 1px solid black;" align"center">e-mail id</td>
<td style="border: 1px solid black;">'.$myArray[0]->email_id.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">12.</td>
<td style="border: 1px solid black;" align"center">Mode of presentation of the Complaint</td>
<td style="border: 1px solid black;">'.$complaint_mode_desc.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">13.</td>
<td style="border: 1px solid black;" align"center">Whether the duly notarized affidavit as annexed <br>to this form has been enclosed ?</td>
<td style="border: 1px solid black;">'.$notory_affi.'</td></tr>

<tr>
<td style="border: 1px solid black;" align="center">14.</td>
<td style="border: 1px solid black;" align"center">Whether the complaint is the victim ?</td>
<td style="border: 1px solid black;">'.$c_victim.'</td></tr>


</table>   
<br><br>
<div><b>Gender correction history (if any)-</b>
</div><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    

';

$getallwidget .=  $scGender;

$getallwidget .='
</table> 

<br><br>


<div> It is certified that to the best of my knowedge, belief and information :</div> <br>
<div>(i) the alleged Offence in respect of which present complaint is being made is within the period of seven <br>
years [<i>limitations as laid down under section 53 of the Lokpal and lokayuktas Act, 2013]</i>; </div><br>
<div>(ii) no matter or proceeding related to allegation of corruption under the Prevention of Corruption Act,
1988 being made under this complaint is pending before any court or committee of either House of <br> Parliament or before any other authority and the complaint is not barred from being made before the Lokpal <br>
by section 15 of the Lokpal and Lokayuktas Act,2013. </div>
<br><br>



<br>
<div align="right"><b>                                              Signature of the complaint/<br>
authorised signatory    </div></b> 
<div>   Place :  '.$myArray[0]->comp_f_place.'</div>
<div>Date  : '.$chkdate.'</div>
<br></br><br></br><br>
';

 
    $file                           =    'parta'.'_'.$filing_no;
	$filename                       =     $file;
				     // $this->data['main_content']           =     'view_widget_report_pdf';
	$html                       =     $getallwidget;
	$this->html2pdf->filename($filename.".pdf");
	$this->html2pdf->html($html);
	$parta = $this->html2pdf->create('save');
	return $parta;
    
    exit;




}
public function defectpdf($filing_no)
{  

$comp_type = get_parta_comptype_compno($filing_no);

if($comp_type == 1)
{
$comp_type = 1;
}else
{
$comp_type = 2;
}

  $comp_no= get_complaintno($filing_no);

/*
  $displayData ='';

  if($comp_no=='n/a')
  {
  $displayData.='
  <div align="left"><b>Complaint No -</b> '.$comp_no.'</div>
  ';
  }
  if($filing_no !='')
  {
  $displayData.='
  <div align="left"><b>Diary No -</b> '.$filing_no.'</div>
  ';
  }*/

$get_summary = $this->scrutiny_model->get_scrutiny_summary($filing_no);
$myArray=(array)$get_summary;
$summary= $myArray[0]['summary'] ?? '';
$remark= $myArray[0]['remarks'] ?? '';


$get_remarks_his = $this->scrutiny_model->get_scrutiny_rem_his($filing_no);
//echo "<pre>";
// print_r($get_remarks_his);

//die;



//$addparty = $this->report_model->getAddparties($refe_no);

 $addcountget_remarks_his=count($get_remarks_his);


$remarkListh ='';
$rowNo = 1;
if($get_remarks_his){
  foreach ($get_remarks_his as $key => $value) {
   $remarkListh .= '
 
   <tr>
   <td style="border: 1px solid black;">'.$rowNo.'</td>  
   <td style="border: 1px solid black;">'.$value->display_name.'</td>
   </td><td style="border: 1px solid black;">'.$value->remarks.'</td>
   </td><td style="border: 1px solid black;">'.get_remarkedby_his_datetime($value->updated_date,'D').' '.'at'.' '.get_remarkedby_his_datetime($value->updated_date, 'T').'</td>
   </tr>';
   $rowNo++;
 }
}

/*

$remarkListh ='';
$rowNo = 1;
if($get_remarks_his){
 foreach ($get_remarks_his as $key => $value) {  

 
  $remarkListh .= '
 
'.$value['remarks'].', ';
  $rowNo++;
 }

}*/





$get_obdetailsa = $this->scrutiny_model->getObjectionremark_display($filing_no);


//echo "<pre>";
//print_r($get_obdetailsa);die;

$remarkLista ='';
$rowNo = 1;
if($get_obdetailsa){
 foreach ($get_obdetailsa as $key => $value) {  
  $remarkLista .= '
 
'.$value->checklist_code.', ';
  $rowNo++;
 }

}

if($comp_type==2){

$get_obdetailsb = $this->scrutiny_model->getObjectionremark_displayb($filing_no);
//echo "<pre>";
//print_r($get_obdetailsb);
$remarkListb ='';
$rowNo = 1;
if($get_obdetailsb){
  foreach ($get_obdetailsb as $key => $value) {  
  if($value->heading_code == ''){
  $remarkListb.='
  '.$value->serial_no.',';
  }else{
  $sql="select serial_no from checklist_master where code='".$value->heading_code."' ORDER BY priority ASC";
  $query = $this->db->query($sql)->result();
  $remarkListb.='
  '.$query[0]->serial_no.$value->serial_no.',';
  }
 }
}
}
//die;







$get_obdetailsc = $this->scrutiny_model->getObjectionremark_displayc($filing_no);
//echo "<pre>";
//print_r($get_obdetailsc);
$remarkListc ='';
$rowNo = 1;
if($get_obdetailsc){
  foreach ($get_obdetailsc as $key => $value) {  
  if($value->heading_code == ''){
  $remarkListc.='
  '.$value->serial_no.',';
  }else{
  $sql="select serial_no from checklist_master where code='".$value->heading_code."'";
  $query = $this->db->query($sql)->result();
  $remarkListc.='
  '.$query[0]->serial_no.$value->serial_no.',';
  }
 }
}





$obdetails = $this->scrutiny_model->get_objdet_ent($filing_no);

$myArray=(array)$obdetails;  


$datafilingcounter=count($myArray);
if($comp_type == 1 || $comp_type == 2)
{
$ObjectionLista ='';
if($myArray){
foreach ($myArray as $key => $value) {

if($value->subcode == 1)
{
$ObjectionLista .= '
<tr>  
<td style="border: 1px solid black;" align="center">'.$value->serial_no.'<br> </td>  
<td style="border: 1px solid black;" align="center">'.$value->description.'</td>  
<td style="border: 1px solid black;" align="center">'.$value->defect_status.'</td>
<td style="border: 1px solid black;" align="center">'.$value->comments.'</td>  
</tr>


';

}
}
}
}




if($comp_type == 2)
{
//die('g');
$ObjectionListpartb ='';

if($myArray){
foreach ($myArray as $key => $value4) {

if($value4->subcode == 2 && $value4->isheading == 't'){

if($value4->subcode == 2)
{
  //print_r($value3->serial_no);die;
$ObjectionListpartb .= '


<tr>  
<td style="border: 1px solid black;" align="center">'.$value4->serial_no.'<br> </td>  
<td style="border: 1px solid black;" align="center">'.$value4->description.'</td>  
<td style="border: 1px solid black;" align="center">'.$value4->defect_status.'</td>
<td style="border: 1px solid black;" align="center">'.$value4->comments.'</td>  
</tr>

';
if($myArray){
foreach ($myArray as $key => $value5) {

if($value5->heading_code == $value4->code && $value5->isheading == 'f'){
  //die('gr');

$ObjectionListpartb .= '
<tr>  
<td style="border: 1px solid black;" align="center">'.$value5->serial_no.'<br> </td>  
<td style="border: 1px solid black;" align="center">'.$value5->description.'</td>  
<td style="border: 1px solid black;" align="center">'.$value5->defect_status.'</td>
<td style="border: 1px solid black;" align="center">'.$value5->comments.'</td>  
</tr>

';


}
}
}
}
}
}
}
}




if($comp_type == 1 || $comp_type == 2)
{
//die('g');
$ObjectionListpartc ='';


if($myArray){



foreach ($myArray as $key => $value3) {

if($value3->subcode == 3 && $value3->isheading == 't'){


if($value3->subcode == 3)
{
  //print_r($value3->serial_no);die;


$ObjectionListpartc .= '
<tr>  

<td style="border: 1px solid black;" align="center">'.$value3->serial_no.'<br> </td>  
<td style="border: 1px solid black;" align="center">'.$value3->description.'</td>  
<td style="border: 1px solid black;" align="center">'.$value3->defect_status.'</td>
<td style="border: 1px solid black;" align="center">'.$value3->comments.'</td>  
</tr>

';


if($myArray){
foreach ($myArray as $key => $value2) {

  //print_r($value2->heading_code);die('h');

if($value2->heading_code == $value3->code && $value2->isheading == 'f'){
  //die('gr');

$ObjectionListpartc .= '
<tr>  
<td style="border: 1px solid black;" align="center">'.$value2->serial_no.'<br> </td>  
<td style="border: 1px solid black;" align="center">'.$value2->description.'</td>  
<td style="border: 1px solid black;" align="center">'.$value2->defect_status.'</td>
<td style="border: 1px solid black;" align="center">'.$value2->comments.'</td>  
</tr>

';


}


}
}
}
}
}
}
}





ini_set('set_time_limit', 0);
ini_set('memory_limit', '-1');
ini_set('xdebug.max_nesting_level', 2000);
$curYear = date('Y');
$curMonth = date('m');
$curDay = date('d');
$cur_date = $curDay.'-'.$curMonth.'-'.$curYear;
                      //  $comp_f_date="$curYear-$curMonth-$curDay";
                       //  $cur_date="$curDay-$curMonth-$curYear";

$this->html2pdf->folder(''.FCPATH.'cdn/scrutiny_df/');
   //print_r(''.FCPATH.'cdn/scrutiny_df');die('k');
$this->html2pdf->paper('A4', 'portrait', 'fr');    
$getallwidget =     '

<div style="float:left; width:100%; margin:0 0 20px 0;">
<div style="float:left;"><b>Diary No -</b>'.$filing_no.'</div>
<div style="float:right; text-align:right;"><b>Complaint Number -</b>'.$comp_no.'</div>
</div>
<br>
<div style="text-align:right;"><b>Date -</b> '.$cur_date.'</div>

<div style="float:left; margin:50px 0 0 0; width:100%; text-align:center;"><b>PART A</b></div>
<div style="float:left; margin:30px 0 0 0; width:100%;">Details to be furnished by the complainant / signatory to the complainant</div>
<div style="clear:both;">
<table style="float:left; margin:15px 0 0 0; width: 100%; border:2px solid; border-collapse: collapse; padding: 0;">

<tr style="background:#CCC">
<th style="border: 1px solid black;" align="center">S.No.</th>
<th style="border: 1px solid black;" align="center">Information to be given as per <br> Complaint Form</th>
<th style="border: 1px solid black;" align="center">Status</th>
<th style="border: 1px solid black;" align="center">Remarks</th>          
</tr>
';
$getallwidget .=  $ObjectionLista;'


</table>

';  

if($comp_type == 2) {

$getallwidget .='

<div style="page-break-before: always; page-break-after: always;">

<div align="center"><b>PART B</b><br><br>
Additional details to be furnished by the signatory to the complainant if the complaint is being filed <br>on behalf of a body or board or corporation or authority or complany, society or assosication of <br>persons or trust or limited liability partnership. <br><br><br>

<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    
<tr style="background:#CCC">
<th style="border: 1px solid black;" align="center">S.No.</th>
<th style="border: 1px solid black;" align="center">Information to be given as per <br>complainant form</th>
<th style="border: 1px solid black;" align="center">Status</th>
<th style="border: 1px solid black;" align="center">Remarks</th>          
</tr>';

$getallwidget .=$ObjectionListpartb;'
</table>
</div>
</div>
';

}


$getallwidget .='

<div style="page-break-before: always; page-break-after: always;">

<div align="center"><b>PART C and PART D </b><br><br>
1.Details As Regards the Public Servant against Whome the Complaint Is Being Made. <br><br><br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">    
<tr style="background:#CCC">
<th style="border: 1px solid black;" align="center">S.No.</th>
<th style="border: 1px solid black;" align="center">Information to be given as per <br>complainant form</th>
<th style="border: 1px solid black;" align="center">Status</th>
<th style="border: 1px solid black;" align="center">Remarks</th>          
</tr>';

$getallwidget .=$ObjectionListpartc;'
</table>  

</div>
</div>';

$getallwidget .='
<div> <br>

<div align="left"><b>Summary of the Scrutiny of the application:</b>'.$summary.'</div><br>
<div align="left"><b>Remarks of the Scrutiny of the application:(Latest remarks)- </b>'.$remark.'</div><br>
<div align="center"><b>Remarks history</b></div><br>
<table style="width: 100%; border:2px solid; border-collapse: collapse; padding: 0; margin: 0;">
';

 $getallwidget .= '
 
  <tr>
   <td style="border: 1px solid black;" align="center">Serial No</td>
   <td style="border: 1px solid black;">Remarks By</td>
   <td style="border: 1px solid black;">Remarks</td>
    <td style="border: 1px solid black;">Date Time</td>
   </tr><br>

'.$remarkListh.'
</table>
 
   <div align="left"><b>Part A-</b>Filled up format with errors in columns';
$getallwidget .=$remarkLista." is enclosed.";'</div></div><br>';

if($comp_type == 2) {

$getallwidget .='
<div> <br>
   <div align="left"><b>Part B-</b>Filled up format with errors in columns ';
$getallwidget .=$remarkListb." is enclosed.";'
</div></div><br>';

}

$getallwidget .='
<div> <br>
   <div align="left"><b>Part C-</b>Filled up format with errors in columns ';
$getallwidget .=$remarkListc." is enclosed.";'
</div></div><br><br><br><br><br><br><br>';

$getallwidget .= '

<br><br><div align="right"><b>Signature with Name & Designation</b></div>

<div align="left"><b>Date-</b>'.$cur_date.'</div><br>
<br></br><br></br>';






                      //echo $getallwidget;die;

$file                           =    $filing_no;
$filename                       =     $file;
    // $this->data['main_content']           =     'view_widget_report_pdf';
$html                       =     $getallwidget;
$this->html2pdf->filename($filename.".pdf");
$this->html2pdf->html($html);
$res = $this->html2pdf->create('save');
return $res;      
  //$this->session->set_flashdata('error_msg', 'Scrutiny successfully completed for Diary no. '.$filing_no.' with defects.');
  //redirect('scrutiny/dashboard');
//exit;    
}



private function generate_complaintno($filing_no)
{
	$year = substr($filing_no,-4);
	$cur_year = date("Y");
	$counter = $this->scrutiny_model->get_complaint_counter($cur_year);
	$counter = $counter->complaint_counter;

	if($counter == 0)
	{
	      //$segment1 ='00001';
		$complaint_no = 1;
		$chk_cou = 1;
	}
	elseif($counter > 0)
	{

		$complaint_no = $counter+1;
	      //die($counter);
		$chk_cou = $this->varify_counter($counter, $cur_year);
	}else{
		die('Counter not set contact admin');
	}

	$array = array('comp_no' => $complaint_no, 'counter' => $complaint_no,'year' => $cur_year, 'chk_cou' => $chk_cou);
	    //print_r($array);die();
	return $array;

}

private function varify_counter($counter, $cur_year)
{
		//die($counter);
	$exist_compno = $this->scrutiny_model->get_max_compno($cur_year);
		//die($exist_compno['max']);
	if($counter == $exist_compno['max']){
		return true;
	}else{
		return false;
	}
}


public function scrutiny_report()
{
		
	$data['user'] = $this->login_model->getRows($this->con);
	$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
	$data['role'] = $data['user']['role'];
	$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pdf($data['user']['role']);	
	//$this->load->view('templates/front/header2.php',$data);
	$this->load->view('templates/front/SC_Header.php',$data);
	$this->load->view('scrutiny/scrutiny_report.php',$data);
	$this->load->view('templates/front/CE_Footer.php',$data);
	
}

function api_action()
{
	if($this->input->post('data_action'))
	{
		$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

		if($data_action == 'fetch_single')
		{
			$api_url = base_url()."api_lokpal/fetch_single";

			$form_data = array(
				'id' => $this->input->post('filing_no')
			);

			$client = curl_init($api_url);
			curl_setopt($client, CURLOPT_POST, true);
			curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($client);
			curl_close($client);
			echo $response;
		}
	}
}

function pre_gen_comp_no($filing_no){
	//$filing_no = $this->input->post('fn');
	//die($filing_no);
	$comp_data = $this->generate_complaintno($filing_no);
	if($comp_data['chk_cou'] == '')
		{
		die('Counters do not matched. Contact Admin');
		}

	if($comp_data['chk_cou'] && $comp_data['comp_no'] && $comp_data['year'])
		{

		$case_det_insdata = array(
			'filing_no' => $filing_no,
			'complaint_no' => $comp_data['comp_no'],
			'ref_no' => get_refno($filing_no),
			'complaint_year' => $comp_data['year'],
			'entry_date' => date('Y-m-d H:i:s'),
			);
			$query2 = $this->scrutiny_model->case_det_ins($case_det_insdata);

			//set case_initialisation
			$upd_data = array(
				'complaint_counter' => $comp_data['counter']
							);
				$this->scrutiny_model->update_year_initialisation($comp_data['year'], $upd_data);

				$ts = date('Y-m-d H:i:s', time());
				$insert_data = array(
					'ref_no' => get_refno($filing_no),
					'user_id' => $this->con['id'],
					'filing_no' => $filing_no,
					'complaint_no' => $comp_data['comp_no'],
					'created_at' => $ts,
					'ip' => get_ip(),
					);
				$this->scrutiny_model->update_comp_his($insert_data);
				 $array = array(
          			'success' => true,
          			//'comp_no' => '"Lok/".$comp_data['comp_no']."/".$comp_data['year']',
       			 );
				return $array;

				//$this->session->set_flashdata('success_msg', 'Complaint no. successfully generated for Diary no. '.$filing_no.'.');
				//redirect('scrutiny/dashboard');
				}else{
					die('Unable to generate complaint no. Contact Admin');
				}
}



function updategender()
{
	 $ts = date('Y-m-d H:i:s', time());
	 $filing_no = $this->input->post('filing_no');
	 $complaint_capacity_id = trim($this->security->xss_clean($this->input->post('complaint_capacity_id')));
	 $ps_id = trim($this->security->xss_clean($this->input->post('ps_id')));
	 $gender_id = trim($this->security->xss_clean($this->input->post('gender_id')));
	 $data['user'] = $this->login_model->getRows($this->con);
	 $query = $this->scrutiny_model->getfiling_no($filing_no);
          $flag = 0;
		if (empty($query))
		{

				$insert_data = array(						
				'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),
				'complaint_capacity_id' => ($complaint_capacity_id != '') ? $complaint_capacity_id : NULL,	
				'ps_id' => ($ps_id != '') ? $ps_id : NULL,	
				'gender_id' => ($gender_id != '') ? $gender_id : NULL,	
				'user_id' => $this->con['id'],
				'created_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->scrutiny_model->gender_insert($insert_data);
				$flag = 1;
		}
		else
		{

				$upd_data = array(						
				'gender_id' => isset($gender_id) ? $gender_id : NULL,
				'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),
				'user_id' => $this->con['id'],
				'updated_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->scrutiny_model->gender_update($upd_data,$filing_no);
				$flag = 1;
		}


			if($flag == 1)
			{

				//echo "first";die;
				echo json_encode(array('success' => 'success'));
			}
			else
			{
				echo "second";die;
				echo json_encode(array('data'=>'fail'));
			}
}


function updatecategory(){
	$ts = date('Y-m-d H:i:s', time());
	 $filing_no = $this->input->post('filing_no');
	 $complaint_capacity_id = trim($this->security->xss_clean($this->input->post('complaint_capacity_id')));
	 $ps_id = trim($this->security->xss_clean($this->input->post('ps_id')));
	 $gender_id = trim($this->security->xss_clean($this->input->post('gender_id')));
	 $data['user'] = $this->login_model->getRows($this->con);
	 $query = $this->scrutiny_model->getfiling_no($filing_no);	
       $flag = 0;
		if (empty($query))
		{
		
				$insert_data = array(
				'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),				
				'complaint_capacity_id' => ($complaint_capacity_id != '') ? $complaint_capacity_id : NULL,	
				'ps_id' => ($ps_id != '') ? $ps_id : NULL,	
				'gender_id' => ($gender_id != '') ? $gender_id : NULL,	
				'user_id' => $this->con['id'],
				'created_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->scrutiny_model->gender_insert($insert_data);
				$flag = 1;
		}
		else
		{

				$upd_data = array(				
				'filing_no' => trim($this->security->xss_clean($this->input->post('filing_no'))),
				'complaint_capacity_id' => ($complaint_capacity_id != '') ? $complaint_capacity_id : NULL,	
				'ps_id' => ($ps_id != '') ? $ps_id : NULL,
				'user_id' => $this->con['id'],
				'updated_at' => $ts,
				'ip' => get_ip(),
				);				
				$query = $this->scrutiny_model->gender_update($upd_data,$filing_no);
				$flag = 1;
		}

			if($flag == 1)
			{

				echo json_encode(array('success' => 'success'));
			}
			else
			{
				echo json_encode(array('data'=>'fail'));
			}	


}

 public function affidavit_detail_pre($dash_ref_no=NULL){	

   if($this->isUserLoggedIn) 
   {
    $con = array( 
      'id' => $this->session->userdata('userId') 
    ); 
    $data['user'] = $this->login_model->getRows($con);
    $data['menus'] = $this->menus_lib->get_menus($data['user']['role']);

   //$array=$this->session->userdata('ref_no');

    if($dash_ref_no == NULL ){
      $refe_no=$this->session->userdata('ref_no');
    }else{
          //$ref_no=$this->session->userdata('ref_no');
      $refe_no = $dash_ref_no;
      $this->session->set_userdata('ref_no',$refe_no);
    }
    
//$refe_no=$array['ref_no'];
//echo "here";	die;

    $data['salution'] = $this->common_model->getSalution();
    $data['gender'] = $this->common_model->getGender();
    $data['nationality'] = $this->common_model->getNationality();
    $data['identityproof'] = $this->common_model->getIdentityproof();
    $data['residenceproof'] = $this->common_model->getResidence();
    $data['getcountry'] = $this->common_model->getCountry();
    $data['complaintmode'] = $this->common_model->getComplaintmode();
    $data['identity_document_type'] = $this->common_model->getDocument_type();
    $data['applet'] = $this->common_model->getAppletName();
    $data['state'] = $this->common_model->getStateName();
    $data['public_servantc'] = $this->report_model->getPartc($refe_no);
    $data['witness_detail'] = $this->report_model->getPartc_Witness($refe_no);
    $data['public_servant_detail'] = $this->report_model->getPublic_servant_detail($refe_no);
    $data['farma'] = $this->common_model->getFormadata($refe_no);
    $data['farmb'] = $this->report_model->getFormadatb($refe_no);
    $data['officebeare'] = $this->report_model->getOfficebeare($refe_no);


    $data['addparty'] = $this->report_model->getAddparties($refe_no);
      $data['addpartyc'] = $this->report_model->getAddparties_partc($refe_no);
		//echo "<pre>";
		//print_r($data);die;
    $data['form_part'] = 'R';
    $this->load->view('templates/front/SC_Header.php',$data);
    $this->load->view('scrutiny/complain_preview.php',$data);
    $this->load->view('templates/front/CE_Footer.php',$data);
    
  }
  else{
    redirect('user/login'); 
  }

}




/*ysc code 25//06/2021 */

		public function agency_report_chk($flag=null)
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
			//if($flag == 'RI' or $flag == 'RV' or $flag=='OPI' or $flag=='OIR' or $flag=='AOA'){

				if($flag == 'RI' or $flag == 'RV'){
				//$bid_array = get_bench_ids_bybno($bench_no);
				$data['agency_data'] = $this->scrutiny_model->get_agency_data_bench($flag);

				$data['flag_case'] = $flag;
				//$data['bench_no'] = $bench_no;
				//$this->load->view('templates/front/header2.php',$data);
			  $this->load->view('templates/front/SC_Header.php',$data);

				$this->load->view('scrutiny/dashboard_report_check.php',$data);

					$this->load->view('templates/front/CE_Footer.php',$data);
			}else{
			$bid_array = get_bench_ids_bybno($bench_no);
			$data['allocated_data'] = $this->proceeding_model->get_allocated_data($bid_array, $flag);
			$data['scrpen_comps'] = $this->scrutiny_model->get_scrutiny_pen_complaints_bench($data['user']['role'], $data['user']['id']);

			$data['purpose_type'] = $this->bench_model->fetch_purpose_type();
			$data['venues'] = $this->bench_model->fetch_venues();
			$data['flag_case'] = $flag;
			$data['bench_no'] = $bench_no;

		  		//print_r($data['user_comps']);die('kk');
			//$this->load->view('templates/front/header2.php',$data);
			$this->load->view('templates/front/SC_Header.php',$data);

			$this->load->view('scrutiny/dashboard_main',$data);

				$this->load->view('templates/front/CE_Footer.php',$data);
			}
		}



		public function ps_report_chk($flag=null)
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
			if($flag=='OPI' or $flag=='OIR' or $flag=='AOA'){
				//$bid_array = get_bench_ids_bybno($bench_no);
			

				if($flag=='OPI')
				{
					//echo "first";die;
					$data['oppertunity_ps_priliminary_inq'] = $this->scrutiny_model->get_agency_data_OPI($flag);

				}

				if($flag=='OIR')
				{
					
					$data['oppertunity_ps_priliminary_inq'] = $this->scrutiny_model->get_agency_data_OIR($flag);
				}

				if($flag=='AOA')
				{
					 	 	 	 	
					$data['oppertunity_ps_priliminary_inq'] = $this->scrutiny_model->get_agency_data_AOA($flag);
				}
				$data['flag'] = $flag;

							$this->load->view('templates/front/SC_Header.php',$data);
							if($flag=='OPI' or $flag=='OIR'){
								$this->load->view('scrutiny/oppertunity_ps_check.php',$data);
							}
							else
							{
								$this->load->view('scrutiny/any_other_action.php',$data);
							}

								$this->load->view('templates/front/CE_Footer.php',$data);
							}

			
			else
			{

				die("you are not authorised");			
			}
		}


		public function reg_proceeding_form(){	
			//print_r($_POST);die;
			$details = (explode("||",$this->input->post('filing_no')));	

			//echo "<pre>";
			//print_r($details);


				$filing_no = $details[0];
				$listing_date = $details[1];
				$bench_id = $details[2];
				$flag = $details[3];
				 $recieved_from = $details[4]; 
			//	$recieved_from = $details[5];
			if($this->input->post('filing_no') && $filing_no!='' && $listing_date!='')
				{
				$details = (explode("||",$this->input->post('filing_no')));	
				$filing_no = $details[0];
				$listing_date = $details[1];
				//$bench_id = $details[2];
			$data['user'] = $this->login_model->getRows($this->con);	
				
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			//$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;
			//$listing_date = $this->input->post('listing_date');
			$data['listing_date'] = $listing_date;
			//$bench_no = $this->input->post('bench_no');
			//echo $bench_no;die;
		//	$data['bench_no'] = $bench_no;
			$data['flag'] = $flag;
			//$bench_id = $this->input->post('bench_id');
			//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
			//$data['bench_nature'] = $bench_nature;
					$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);
					//print_r($last_remarks);die;
			if(isset($last_remarks[0]->summary))
					$data['summary'] = $last_remarks[0]->summary;

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

			 $data['recieved_from'] = 'A';

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
			$this->load->view('templates/front/SC_Header.php',$data);
			$this->load->view('scrutiny/registar_proceeding.php',$data);
			$this->load->view('templates/front/CE_Footer.php',$data);
			}
			else
				{
					redirect('/scrutiny/dashboard/'.$bench_no.'/'.$flag);
				}	
		}



			public function ops_proceeding_form(){	

				//echo "here";die;
			//print_r($_POST);die;
			$details = (explode("||",$this->input->post('filing_no')));	


			//echo "<pre>";
			//print_r($details);

			 $filing_no = $details[0];	
			 $listing_date = $details[1];			
			 $bench_id = $details[2];				
			  $flag_case = $details[3];				
			 $ordertype_code = $details[4];				
			 $bench_no = $details[5];				
		
				//$bench_no = $details[3];
				//$flag = $details[4];
			//	$recieved_from = $details[5];
			if($this->input->post('filing_no') && $filing_no!='' && $listing_date!='')
				{
				$details = (explode("||",$this->input->post('filing_no')));	
				$filing_no = $details[0];
				$listing_date = $details[1];
				 $bench_id = $details[2];				
			  $flag = $details[3];				
			 $ordertype_code = $details[4];				
			 $bench_no = $details[5];	
				//$bench_id = $details[2];
			$data['user'] = $this->login_model->getRows($this->con);	
				
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			//$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;
			//$listing_date = $this->input->post('listing_date');
			$data['listing_date'] = $listing_date;
			$data['flag'] = $flag;
			$data['ordertype_code'] = $ordertype_code;
			$data['ordertype_code'] = $ordertype_code;
			$data['bench_no'] = $bench_no;
			//$bench_no = $this->input->post('bench_no');
			//echo $bench_no;die;
		//	$data['bench_no'] = $bench_no;
			//$data['flag'] = $flag;
			//$bench_id = $this->input->post('bench_id');
			//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
			//$data['bench_nature'] = $bench_nature;
					$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);
					//echo "<pre>";
					//print_r($last_remarks);die;
			if(isset($last_remarks[0]->summary))
					$data['summary'] = $last_remarks[0]->summary;

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

			// $data['recieved_from'] = 'A';

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
			$this->load->view('templates/front/SC_Header.php',$data);
			$this->load->view('scrutiny/ops_proceeding.php',$data);
			$this->load->view('templates/front/CE_Footer.php',$data);
			}



			else
				{
					redirect('/scrutiny/dashboard/'.$bench_no.'/'.$flag);
				}	
		}



		function ops_proceeding_action()
		{	//echo "hello";
			//print_r($_FILES);die;
			//print_r($_POST);die;
			$this->form_validation->set_rules('dt_submission', 'Date of Submission', 'required');			
			$dt_submission = trim($this->security->xss_clean($this->input->post('dt_submission')));
			$dt_submission = get_entrydate($dt_submission);
			//if($select_an_option == 2){
				$this->form_validation->set_rules('team_lead_nm', 'Name of submitted by', 'required');
				$team_lead_nm = trim($this->security->xss_clean($this->input->post('team_lead_nm')));
				//$order_date = get_entrydate($order_date);
				$this->form_validation->set_rules('contact_no', 'Contact Number', 'required');
				$this->form_validation->set_rules('email_id', 'Email Id', 'required');

				//$this->form_validation->set_rules('order_date', 'Order Date', 'required');
				if (empty($_FILES['report_upload']['name']))
					{
	    			$this->form_validation->set_rules('report_upload', 'Report', 'required');
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
				$this->load->view('scrutiny/ops_proceeding.php',$data);
			}
			else
				
			{
		 	    $ordertype_code = trim($this->security->xss_clean($this->input->post('ordertype_code')));
				$flag = trim($this->security->xss_clean($this->input->post('flag')));
				$dt_submission = trim($this->security->xss_clean($this->input->post('dt_submission')));
				$team_lead_nm = trim($this->security->xss_clean($this->input->post('team_lead_nm')));
				$email_id = trim($this->security->xss_clean($this->input->post('email_id')));
				$report_content = trim($this->security->xss_clean($this->input->post('report_content')));
				$contact_no = trim($this->security->xss_clean($this->input->post('contact_no')));				
				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$listing_date = trim($this->security->xss_clean($this->input->post('listing_date')));
				//print_r($listing_date);die;
				//$listing_date = get_entrydate($listing_date);
				$bench_no = trim($this->security->xss_clean($this->input->post('bench_no')));
				//$flag='RI';
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

				
				//if($select_an_option == 2){
				$proceeding_count_ps_data = $this->scrutiny_model->get_public_servant_data_count($filing_no);
				 $proceeding_count_ps_data=count($proceeding_count_ps_data);
			

				
				if($proceeding_count_ps_data == 0)
				{

				$proceeding_count_ps_data =1;
				}
				else
				{	
						//print_r($proceeding_count);die;
					$proceeding_count_ps_data = $proceeding_count_ps_data+1;
				}				

					//echo $proceeding_count;die;

			$config['upload_path']   = './cdn/public_servant_order/'; 
	        $config['allowed_types'] = 'pdf|doc|docx'; 
	        //$config['max_size']      = 2000; 	      
	        $config['file_name'] = 'ps_report_order_'.$filing_no.'_'.$proceeding_count_ps_data.'.pdf';

	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('report_upload')) {
	            $error = array('error' => $this->upload->display_errors()); 
	            //print_r($error['error']);die;
	            $this->session->set_flashdata('upload_error', $error['error']);
	            redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }
	   
	         	//check data exist or not

	   


	         		//die('send to chairperson');
	         		$query1 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
						$upd_data = array(
							'proceeded' => 't',
							'updated_at' => $ts,
						);
					if($query1){
						$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);
							$query3 = $this->agency_model->casedethis_insert($filing_no);
							if($query3){
								$upd_data2 = array(
									'listed' => 'f',
								'updated_date' => $ts,
							);
					$query4 = $this->agency_model->upd_casedet($filing_no, $upd_data2);
				
				
					if($query4){
							$ins_data4 = array(
									'filing_no' => $filing_no,
									'agency_counter'=>$proceeding_count,
									'listing_date' => $listing_date,
									'bench_id' => $bench_id,
									'email_id' => $email_id,
									'flag_case' => $flag,
									'ordertype_code' => $ordertype_code,
									'bench_no' => $bench_no,
									'dt_submission'=>$dt_submission,
									'team_lead_nm'=>$team_lead_nm,
									'contact_no'=>$contact_no,
									'report_content'=>$report_content,									 
								'report_upload' => 'cdn/public_servant_order/ps_report_order_'.$filing_no.'_'.$proceeding_count_ps_data.'.pdf',	
								'user_id' => $this->con['id'],						
								'created_at' => $ts,
								'ip' => $ip,

							);
						

					//$query6 = $this->agency_model->ins_orders_agency_report($ins_data4);
					$query6 = $this->scrutiny_model->ins_order_opertunity_to_ps_pi_report($ins_data4);

					if($query6)
				{ 
					$upd_data = array(
						'action' => 't',
						'updated_at' => $ts,
					);
					$query2 = $this->agency_model->upd_proce($filing_no, $upd_data);
					}	

						//echo $flag;die;
					if($query6){

						$this->session->set_flashdata('success_msg', 'Complaint no '.get_complaintno($filing_no).' forwarded to HCP');
						redirect('scrutiny/ps_report_chk/'.$flag);
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem inserting in orders_agency_report model');
						redirect('scrutiny/dashboard/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in agency model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in case detail model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in case detail history model');
								redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
							}
	         
		}
	}




			public function aoa_proceeding_form(){	

				//echo "here";die;
			//print_r($_POST);die;
			$details = (explode("||",$this->input->post('filing_no')));	


			//echo "<pre>";
			//print_r($details);

				$filing_no = $details[0];	
				$listing_date = $details[1];			
				$bench_id = $details[2];				
				$flag_case = $details[3];				
				$ordertype_code = $details[4];				
				$bench_no = $details[5];
				$status_report_department = $details[6];				
				$other_action_code = $details[7];				
				$additional_documents = $details[8];				
				$others_ordertype = $details[9];			
		
				//$bench_no = $details[3];
				//$flag = $details[4];
			//	$recieved_from = $details[5];
			if($this->input->post('filing_no') && $filing_no!='' && $listing_date!='')
				{
					$details = (explode("||",$this->input->post('filing_no')));	
					$filing_no = $details[0];
					$listing_date = $details[1];
					$bench_id = $details[2];				
					$flag = $details[3];				
					$ordertype_code = $details[4];				
					$bench_no = $details[5];
					$status_report_department = $details[6];				
					$other_action_code = $details[7];				
					$additional_documents = $details[8];				
					$others_ordertype = $details[9];		





				//$bench_id = $details[2];
			$data['user'] = $this->login_model->getRows($this->con);	
				
			$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
			//$filing_no = $this->input->post('filing_no');
			$data['filing_no'] = $filing_no;
			//$listing_date = $this->input->post('listing_date');
			$data['listing_date'] = $listing_date;
			$data['flag'] = $flag;
			$data['ordertype_code'] = $ordertype_code;		
			$data['bench_no'] = $bench_no;
			$data['status_report_department'] = $status_report_department;
			$data['other_action_code'] = $other_action_code;
			$data['additional_documents'] = $additional_documents;		
			$data['others_ordertype'] = $others_ordertype;		




			//$bench_no = $this->input->post('bench_no');
			//echo $bench_no;die;
		//	$data['bench_no'] = $bench_no;
			//$data['flag'] = $flag;
			//$bench_id = $this->input->post('bench_id');
			//$bench_nature = get_bench_nature_code($listing_date, $bench_no);
			//$data['bench_nature'] = $bench_nature;
					$last_remarks = $this->scrutiny_model->get_last_rem($filing_no);
					//echo "<pre>";
					//print_r($last_remarks);die;
			if(isset($last_remarks[0]->summary))
					$data['summary'] = $last_remarks[0]->summary;

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

			// $data['recieved_from'] = 'A';

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
			$this->load->view('templates/front/SC_Header.php',$data);
			$this->load->view('scrutiny/any_other_action_proceeding.php',$data);
			$this->load->view('templates/front/CE_Footer.php',$data);
			}



			else
				{
					redirect('/scrutiny/dashboard/'.$bench_no.'/'.$flag);
				}	
		}




		function any_other_action_proceeding()
		{	
			
			//print_r($_FILES);die;
			//print_r($_POST);die;
			$this->form_validation->set_rules('dt_submission', 'Date of Submission', 'required');			
			$dt_submission = trim($this->security->xss_clean($this->input->post('dt_submission')));
			$dt_submission = get_entrydate($dt_submission);
			//if($select_an_option == 2){
				$this->form_validation->set_rules('team_lead_nm', 'Name of submitted by', 'required');
				$team_lead_nm = trim($this->security->xss_clean($this->input->post('team_lead_nm')));
				//$order_date = get_entrydate($order_date);
				$this->form_validation->set_rules('contact_no', 'Contact Number', 'required');
				$this->form_validation->set_rules('email_id', 'Email Id', 'required');

				//$this->form_validation->set_rules('order_date', 'Order Date', 'required');
				if (empty($_FILES['report_upload']['name']))
					{
	    			$this->form_validation->set_rules('report_upload', 'Report', 'required');
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

				$status_report_department = $this->input->post('status_report_department');
				$data['status_report_department'] = $status_report_department;
				$other_action_code = $this->input->post('other_action_code');
				$data['other_action_code'] = $other_action_code;
				$additional_documents = $this->input->post('additional_documents');
				$data['additional_documents'] = $additional_documents;
				$others_ordertype = $this->input->post('others_ordertype');
				$data['others_ordertype'] = $others_ordertype;



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
				$this->load->view('scrutiny/ops_proceeding.php',$data);
			}
			else
				
			{
		 	    $ordertype_code = trim($this->security->xss_clean($this->input->post('ordertype_code')));
				$flag = trim($this->security->xss_clean($this->input->post('flag')));
				$dt_submission = trim($this->security->xss_clean($this->input->post('dt_submission')));
				$team_lead_nm = trim($this->security->xss_clean($this->input->post('team_lead_nm')));
				$email_id = trim($this->security->xss_clean($this->input->post('email_id')));
				$report_content = trim($this->security->xss_clean($this->input->post('report_content')));
				$contact_no = trim($this->security->xss_clean($this->input->post('contact_no')));				
				$filing_no = trim($this->security->xss_clean($this->input->post('filing_no')));
				$listing_date = trim($this->security->xss_clean($this->input->post('listing_date')));
				//print_r($listing_date);die;
				//$listing_date = get_entrydate($listing_date);
				$bench_no = trim($this->security->xss_clean($this->input->post('bench_no')));
				//$flag='RI';
			  $bench_id = trim($this->security->xss_clean($this->input->post('bench_id')));
				//$bench_nature = trim($this->security->xss_clean($this->input->post('bench_nature')));
				//$court_no = trim($this->security->xss_clean($this->input->post('court_no')));
				$complaint_no = trim($this->security->xss_clean($this->input->post('complaint_no')));

				$status_report_department = trim($this->security->xss_clean($this->input->post('status_report_department')));
				$other_action_code = trim($this->security->xss_clean($this->input->post('other_action_code')));
				if($other_action_code =='')
				{
					$other_action_code=null;
				}
				$additional_documents = trim($this->security->xss_clean($this->input->post('additional_documents')));
				$others_ordertype = trim($this->security->xss_clean($this->input->post('others_ordertype')));

				$data['user'] = $this->login_model->getRows($this->con);
			    $user_id=$data['user']['id'];
				//$purpose = ;
				$ts = date('Y-m-d H:i:s', time());
				$created_at = $ts;
				//$updated_at = ;
				$ip = get_ip();

				
				//if($select_an_option == 2){
				
				$proceeding_count_ps_data = $this->scrutiny_model->get_public_servant_data_count($filing_no);
				 $proceeding_count_ps_data=count($proceeding_count_ps_data);				
				if($proceeding_count_ps_data == 0)
				{

				$proceeding_count_ps_data =1;
				}
				else
				{	
						//print_r($proceeding_count);die;
					$proceeding_count_ps_data = $proceeding_count_ps_data+1;
				}	


					//echo $proceeding_count;die;

				$config['upload_path']   = './cdn/public_servant_order/'; 
	        $config['allowed_types'] = 'pdf'; 
	        //$config['max_size']      = 2000; 
	       $config['file_name'] = 'ps_report_order_'.$filing_no.'_'.$proceeding_count_ps_data.'.pdf';

	        $this->upload->initialize($config);
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('report_upload')) {

	        
	            $error = array('error' => $this->upload->display_errors()); 
	            //print_r($error['error']);die;
	            $this->session->set_flashdata('upload_error', $error['error']);
	            redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }
	   
	         	//check data exist or not

	   
	        

	         		//die('send to chairperson');
	         		$query1 = $this->proceeding_model->updhis_insert($filing_no, $listing_date, $bench_no);
						$upd_data = array(
							'proceeded' => 't',
							'updated_at' => $ts,
						);
					if($query1){
						$query2 = $this->proceeding_model->upd_alloc($filing_no, $listing_date, $bench_no, $upd_data);
							$query3 = $this->agency_model->casedethis_insert($filing_no);
							if($query3){
								$upd_data2 = array(
									'listed' => 'f',
								'updated_date' => $ts,
							);
					$query4 = $this->agency_model->upd_casedet($filing_no, $upd_data2);
				
				
					if($query4){
							$ins_data4 = array(
									'filing_no' => $filing_no,
									'agency_counter'=>$proceeding_count_ps_data,
									'listing_date' => $listing_date,
									'bench_id' => $bench_id,
									'email_id' => $email_id,
									'flag_case' => $flag,
									'ordertype_code' => $ordertype_code,
									'bench_no' => $bench_no,
									'dt_submission'=>$dt_submission,
									'team_lead_nm'=>$team_lead_nm,
									'contact_no'=>$contact_no,
									'report_content'=>$report_content,
								 'report_upload' => 'cdn/public_servant_order/ps_report_order_'.$filing_no.'_'.$proceeding_count_ps_data.'.pdf',
								'user_id' => $this->con['id'],						
								'created_at' => $ts,
								'ip' => $ip,
								'status_report_department' => $status_report_department,
									'other_action_code'=>$other_action_code,
									'additional_documents'=>$additional_documents,
									'others_ordertype'=>$others_ordertype,
							);


					//$query6 = $this->agency_model->ins_orders_agency_report($ins_data4);
					$query6 = $this->scrutiny_model->ins_any_other_action_data($ins_data4);

					if($query6)
				{ 
					$upd_data = array(
						'action' => 't',
						'updated_at' => $ts,
					);
					$query2 = $this->agency_model->upd_proce($filing_no, $upd_data);
					}	

						//echo $flag;die;
					if($query6){

						$this->session->set_flashdata('success_msg', 'Complaint no '.get_complaintno($filing_no).' forwarded to HCP');
						redirect('scrutiny/ps_report_chk/'.$flag);
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem inserting in orders_agency_report model');
						redirect('scrutiny/dashboard/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in agency model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in case detail model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in case detail history model');
								redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
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
				$this->load->view('scrutiny/registar_proceeding.php',$data);
			}
			else
				
			{
				//die('pass');
				$select_an_option = trim($this->security->xss_clean($this->input->post('select_an_option')));
				//$order_type = trim($this->security->xss_clean($this->input->post('order_type')));
				//$order_body = trim($this->security->xss_clean($this->input->post('order_body')));
				$remarks = trim($this->security->xss_clean($this->input->post('remarks')));
				
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
	            redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
	            die; 
	         }
	   
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
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem inserting in orders_agency_report model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in agency model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
					}else{
						$this->session->set_flashdata('error_msg', 'Some problem updating in case detail model');
						redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
					}
							}else{
								$this->session->set_flashdata('error_msg', 'Some problem inserting in case detail history model');
								redirect('scrutiny/dashboard/'.$bench_no.'/'.$flag);
							}
	         }else if($select_an_option == 2){
	         		die('agn');
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

	         	}
	        }
		}
	}

public function update_scrutiny_as_defective(){	
			//echo '<pre>';
	$value  = json_decode($_POST['allids']);
			//echo '<pre>';print_r($value);
	$flag = 0;
	for($i=0;$i<count($value);$i++){
		$data = explode(':::', $value[$i]);
		if(!empty($data[0])){
					//echo $data[0].' : '.$data[1];

			$id=$data[0];				
					// $listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					// $listing_date = get_entrydate($listing_date);

			$query1 = $this->scrutiny_model->upd_scrutiny_data_as_defective_his($id);

			$modifycounter = $this->scrutiny_model->upd_scrutiny_data_as_defective($id);  
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
/*ysc code 23072021 */

public function update_scrutiny_as_undefective(){	
			//echo '<pre>';
	$value  = json_decode($_POST['allids']);
			//echo '<pre>';print_r($value);
	$flag = 0;
	for($i=0;$i<count($value);$i++){
		$data = explode(':::', $value[$i]);
		if(!empty($data[0])){
					//echo $data[0].' : '.$data[1];

			 $id=$data[0];			
					// $listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					// $listing_date = get_entrydate($listing_date);

			$query1 = $this->scrutiny_model->upd_scrutiny_data_as_undefective_his($id);			
			$modifycounter = $this->scrutiny_model->upd_scrutiny_data_as_undefective($id);  
			
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


public function status_open_for_edit_complaint(){	
			//echo '<pre>';
	$value  = json_decode($_POST['allids']);
			//echo '<pre>';print_r($value);
	$flag = 0;
	for($i=0;$i<count($value);$i++){
		$data = explode(':::', $value[$i]);
		if(!empty($data[0])){
					//echo $data[0].' : '.$data[1];

			$id=$data[0];				
					// $listing_date=$data[1];			
					//echo $id." : ".$listing_date." ::: ";
					// $listing_date = get_entrydate($listing_date);
			$query1 = $this->scrutiny_model->status_edit_open_complaint_history($id, '1');	
			
			$modifycounter1 = $this->scrutiny_model->status_edit_open_complaint($id, '1'); 

			$comp_cap = get_parta_comptype_fn($id);
			 if($comp_cap != 1){

			$query2 = $this->scrutiny_model->status_edit_open_complaint_history($id, '2');	
			
			$modifycounter2 = $this->scrutiny_model->status_edit_open_complaint($id, '2');
		}else{
			$query2 = 1;
			$modifycounter2 = 1;
		}

			$query3 = $this->scrutiny_model->status_edit_open_complaint_history($id, '3');	
			
			$modifycounter3 = $this->scrutiny_model->status_edit_open_complaint($id, '3');

		}

	}
	if($query1 && $modifycounter1 && $query2 && $modifycounter2 && $query3 && $modifycounter3){
			//echo 'success';
		echo json_encode(array('success' => 'success'));
	}else{
		echo json_encode(array('data'=>'fail'));
	}


}




}













