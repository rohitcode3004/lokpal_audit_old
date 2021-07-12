<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_lokpal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url', 'form');
		$this->load->model('Api_lokpal_model');
		$this->load->library('form_validation');
		$this->load->helper("api_lok_helper");
		$this->load->helper("date_helper");
		$this->load->helper("compno_helper");
	}

	/*function index()
	{
		$data = $this->label_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function update()
	{
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('long_name', 'Long Name', 'required');
		$this->form_validation->set_rules('short_name', 'Short Name', 'required');
		$this->form_validation->set_rules('display', 'Display', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'level_master_id' => $this->input->post('level'),
				'long_name' => $this->input->post('long_name'),
				'short_name' => $this->input->post('short_name'),
				'description' => $this->input->post('description'),
				'display' => $this->input->post('display')
			);

			$this->label_model->update_element($this->input->post('id'), $data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'level' => form_error('level'),
				'long_name' => form_error('long_name'),
				'short_name' => form_error('short_name'),
				'display' => form_error('display'),
			);
		}
		echo json_encode($array);
	}

	function insert()
	{
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('long_name', 'Long Name', 'required');
		$this->form_validation->set_rules('short_name', 'Short Name', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'level_master_id' => $this->input->post('level'),
				'long_name' => $this->input->post('long_name'),
				'short_name' => $this->input->post('short_name'),
				'display' => $this->input->post('display'),
				'description' => $this->input->post('description')
			);

			$this->label_model->insert_element($data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'level' => form_error('level'),
				'long_name' => form_error('long_name'),
				'short_name' => form_error('short_name'),
				'display' => form_error('display')
			);
		}
		echo json_encode($array);
	}*/

	function fetch_single()
	{
		//print_r($this->input->post('id'));
		if($this->input->post('id'))
		{
			$row = $this->Api_lokpal_model->fetch_single_element($this->input->post('id'), 'A');
			//print_r($row);die;
			$row = $row[0];

			/*additional details*/
			$ref_no = get_refno($this->input->post('id'));
			$check_witnesses = $this->Api_lokpal_model->check_witness_details($ref_no);
			if($check_witnesses == 0)
				$witnesses_details = 'No';
			else
				$witnesses_details = 'Yes';

			$check_third_party_b = $this->Api_lokpal_model->check_third_details($ref_no, 'B');
			if($check_third_party_b == 0)
				$third_party_b_details = 'No';
			else
				$third_party_b_details = 'Yes';

			$check_ob_hod = $this->Api_lokpal_model->check_ob_hod_details($ref_no);
			if($check_ob_hod == 0)
				$ob_hod_details = 'No';
			else
				$ob_hod_details = 'Yes';

			//foreach ($data as $row)
			// {
			/*if($row['p_add1'] == '')
				die('1');
			elseif($row['p_add1'] == NULL)
				die('2');
			else
				die('3');*/

			$complainant_type_id = $row['complaint_capacity_id'];
			$affidavit_upd_path = $row['affidavit_upload'];
								$output['A'] = array("one" => get_complainant_type($row['complaint_capacity_id']),
									"two" => $row['first_name']." ".$row['mid_name']." ".$row['sur_name'],
									"three" => get_gender($row['gender_id']),
									"four" => $row['age_years'],
									"five" => get_nationality($row['nationality_id']),
									"six" => array("identity" => array("type" => get_identity_proof($row['identity_proof_id']),
										"no" => $row['identity_proof_no'],
										"from" => $row['identity_proof_doi'] != '' ? $row['identity_proof_doi'] : 'n/a',
										"upto" => $row['identity_proof_vupto'] != '' ? $row['identity_proof_vupto'] : 'n/a',
										"auth" => $row['identity_proof_iauth'],
										"upd_path" => $row['identity_url_parta']
									),
													"residence" => array("type" => get_residence_proof($row['idres_proof_id']),
										"no" => $row['idres_proof_no'],
										"from" => $row['idres_proof_doi'] != '' ? $row['idres_proof_doi'] : 'n/a',
										"upto" => $row['idres_proof_vupto'] != '' ? $row['idres_proof_vupto'] : 'n/a',
										"auth" => $row['idres_proof_iauth'],
										"upd_path" => $row['residence_url_parta']
 									)
									),
									"seven" => array("house" => $row['p_hpnl'] != '' ? $row['p_hpnl'] : 'n/a',
										"city" => $row['p_add1'] != '' ? $row['p_add1'] : 'n/a',
										"district" => get_district($row['p_dist_id'], $row['p_state_id']),
										"state" => get_state($row['p_state_id']),
										"pin" => $row['p_pin_code'],
										"country" => get_country($row['p_country_id'])
									),
									"eight" => array("house" => $row['c_hpnl'] != '' ? $row['c_hpnl'] : 'n/a',
										"city" =>  $row['c_add1'] != '' ? $row['c_add1'] : 'n/a',
										"district" => get_district($row['c_district_id'], $row['c_state_id']),
										"state" => get_state($row['c_state_id']),
										"pin" => $row['c_pin_code'],
										"country" => get_country($row['c_country_id'])
									),
									"nine" => $row['occu_desig_avo'],
									"ten" => $row['tel_no']." ".$row['mob_no'],
									"eleven" => $row['email_id'],
									"twelve" => get_complaint_mode($row['complaintmode_id']),
									"thirteen" => get_yes_no($row['notory_affi_annex']),
									"fourteen" => get_yes_no($row['complainant_victim']),
			);
			//}

/*  Getting data for part C    */

			$row = $this->Api_lokpal_model->fetch_single_element($this->input->post('id'), 'C');
			//print_r($row);die;
			$row = $row[0];
			//foreach ($data as $row)
			// {
								$output['C'] = array("one" => get_salutation($row['ps_salutation_id'])." ".$row['ps_first_name']." ".$row['ps_mid_name']." ".$row['ps_sur_name'],
									"two" => $row['present_ps_desig'],
									"three" => get_yes_no($row['ps_dsp_lp']),
									"four" => $row['ps_desig']." ".$row['ps_orgn'],
									"five" => array("category" => get_complainant_type($row['complaint_capacity_id']).", ".get_ps_designation($row['ps_id']),
										"other" => $row['ps_othcate']),
									"six" => array("fin_by_gov" => get_yes_no($row['tas_fingoi']),
										"ann_inc" => get_yes_no($row['anninc_onecr']),
										"foreign_source" => get_yes_no($row['dona_fs'])
									),
									"seven" => get_yes_no($row['pss_sbbca']),
									"eight" => $row['psc_postheld'],
									"nine" => array("period" => get_displaydate($row['periodf_coa'])." to ".get_displaydate($row['periodt_coa']),
										"pl_of_occ" => $row['ps_pl_occ'],
										"district" => get_district($row['ps_pl_dist_id'], $row['ps_pl_stateid']),
										"state" => get_state($row['ps_pl_stateid']),
									),
									"ten" => array("summary" => $row['sum_facalle'],
										"det_of_offences_act" => $row['det_offen'],
										"prov_violated" => $row['prov_viola'],
										"upd_path_facts" => $row['sum_fact_allegation_upload'],
										"upd_path_offence" => $row['detail_offence_upload']
									),
									"eleven" => $witnesses_details,
									"twelve" => array("relied_docs" => $row['relied_doc_list'],
										"upd_path" => $row['relevant_evidence_upload'] != '' ? $row['relevant_evidence_upload'] : ''
									),
									"thirteen" => $row['any_othInfo'],
									"fourteen" => get_yes_no($row['doc_copy_attached']),
									"fifteen" => get_yes_no($row['electronic_file']),
									"sixteen" => $affidavit_upd_path != '' ? $affidavit_upd_path : ''
			);

								if($complainant_type_id != 1){

/*  Getting data for part B    */

			$row = $this->Api_lokpal_model->fetch_single_element($this->input->post('id'), 'B');
			//print_r($row);die;
			$row = $row[0];
			//foreach ($data as $row)
			// {
								$output['B'] = array("one" => array("reffered" => get_yes_no($row['orgn_referred_india']),
										"certificate" => get_yes_no($row['cert_regInc_encl']),
										"competent_auth_name" => $row['auth_ireginc'],
										"address_corres" => $row['o_hpnl']." ".$row['o_vill_city']." ".get_state($row['o_state_id'])." ".get_district($row['o_dist_id'], $row['o_state_id'])." ".$row['o_pin_code']." ".get_country($row['o_country_id']),
										"tel_mob" => $row['o_tel_no']." ".$row['o_promob_no'],
										"e_mail" => $row['o_email_id']
									),
									"two" => $ob_hod_details,
									"three" => $row['h_first_name'],
									"four" => get_salutation($row['a_salutation_id'])." ".$row['a_sur_name']." ".$row['a_mid_name']." ".$row['a_first_name'],
									"five" => get_gender($row['a_gender_id']),
									"six" => $row['a_age_years'],
									"seven" => get_nationality($row['a_nationality_id']),
									"eight" => array("identity" => array("type" => get_identity_proof($row['aidentity_proof_id']),
										"no" => $row['aidentity_proof_no'],
										"from" => $row['aidentity_proof_doi'] != '' ? $row['aidentity_proof_doi'] : 'n/a',
										"upto" => $row['aidentity_proof_vupto'] != '' ? $row['aidentity_proof_vupto'] : 'n/a',
										"auth" => $row['aidentity_proof_iauth'],
										"upd_path" => $row['identity_url_partb']
									),
													"residence" => array("type" => get_residence_proof($row['aidres_proof_id']),
										"no" => $row['aidres_proof_no'],
										"from" => $row['aidres_proof_doi'] != '' ? $row['aidres_proof_doi'] : 'n/a',
										"upto" => $row['aidres_proof_vupto'] != '' ? $row['aidres_proof_vupto'] : 'n/a',
										"auth" => $row['aidres_proof_iauth'],
										"upd_path" => $row['residence_url_partb'],
 									)
									),
									"nine" => array("house" => $row['ap_hpnl'] != '' ? $row['ap_hpnl'] : 'n/a',
										"city" => $row['ap_vill_city'] != '' ? $row['ap_vill_city'] : 'n/a',
										"district" => get_district($row['ap_dist_id'], $row['ap_state_id']),
										"state" => get_state($row['ap_state_id']),
										"pin" => $row['ap_pin_code'],
										"country" => get_country($row['ap_country_id'])
									),
									"ten" => array("house" => $row['ac_hpnl'] != '' ? $row['ac_hpnl'] : 'n/a',
										"city" => $row['ac_vill_city'] != '' ? $row['ac_vill_city'] : 'n/a',
										"district" => get_district($row['ac_dist_id'], $row['ac_state_id']),
										"state" => get_state($row['ac_state_id']),
										"pin" => $row['ac_pin_code'],
										"country" => get_country($row['ac_country_id'])
									),
									"eleven" => $row['aoccu_desig_avo'],
									"twelve" => $row['atel_no']." ".$row['amob_no'],
									"thirteen" => $row['email_id'],
									"fourteen" => array("auth_doc" => get_yes_no($row['auth_doc_encl']),
										"upd_path" => $row['auth_doc_upload']
									),
									"fifteen" => $third_party_b_details
			);
							}
			echo json_encode($output);
		}
	}

	function fetch_single_witness($id)
	{
		if(isset($id))
		{
			$id = get_refno($id);
			$row = $this->Api_lokpal_model->fetch_witnesses($id);
			//print_r($row);die;
			$row = $row[0];
			//foreach ($data as $row)
			// {
			$affidavit_upd_path = $row['affidavit_upload'];
								$output['A'] = array("one" => get_complainant_type($row['complaint_capacity_id']),
									"two" => $row['first_name']." ".$row['mid_name']." ".$row['sur_name'],
									"three" => get_gender($row['gender_id']),
									"four" => $row['age_years'],
									"five" => get_nationality($row['nationality_id']),
									"six" => array("identity" => array("type" => get_identity_proof($row['identity_proof_id']),
										"no" => $row['identity_proof_no'],
										"from" => $row['identity_proof_doi'] != '' ? $row['identity_proof_doi'] : 'n/a',
										"upto" => $row['identity_proof_vupto'] != '' ? $row['identity_proof_vupto'] : 'n/a',
										"auth" => $row['identity_proof_iauth']
									),
													"residence" => array("type" => get_residence_proof($row['idres_proof_id']),
										"no" => $row['idres_proof_no'],
										"from" => $row['idres_proof_doi'] != '' ? $row['idres_proof_doi'] : 'n/a',
										"upto" => $row['idres_proof_vupto'] != '' ? $row['idres_proof_vupto'] : 'n/a',
										"auth" => $row['idres_proof_iauth']
 									)
									),
									"seven" => array("house" => $row['p_hpnl'] != '' ? $row['p_hpnl'] : 'n/a',
										"city" => $row['p_add1'] != '' ? $row['p_add1'] : 'n/a',
										"district" => get_district($row['p_dist_id'], $row['p_state_id']),
										"state" => get_state($row['p_state_id']),
										"pin" => $row['p_pin_code'],
										"country" => get_country($row['p_country_id'])
									),
									"eight" => array("house" => $row['c_hpnl'] != '' ? $row['c_hpnl'] : 'n/a',
										"city" =>  $row['c_add1'] != '' ? $row['c_add1'] : 'n/a',
										"district" => get_district($row['c_district_id'], $row['c_state_id']),
										"state" => get_state($row['c_state_id']),
										"pin" => $row['c_pin_code'],
										"country" => get_country($row['c_country_id'])
									),
									"nine" => $row['occu_desig_avo'],
									"ten" => $row['tel_no']." ".$row['mob_no'],
									"eleven" => $row['email_id'],
									"twelve" => get_complaint_mode($row['complaintmode_id']),
									"thirteen" => get_yes_no($row['notory_affi_annex']),
									"fourteen" => get_yes_no($row['complainant_victim']),
			);
			//}
							}
			echo json_encode($output);
		}
//client own function to view data at own end
	/*public function view($slug = NULL){
		$data['element'] = $this->label_model->get_element($slug);

		//if(empty($data)){
		//	show_404();
		//}

		//$this->load->view('templates/header');
		//$this->load->view('master/filing_view', $data);
		//$this->load->view('templates/footer');
	}*/
}
