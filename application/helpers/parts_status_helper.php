<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
	{
	     function get_parts_status($reference_no=null, $user_id, $part)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->check_part_data($reference_no, $user_id, $part);
			//print_r($comp_row);die('hel');
			return $comp_row;
		 }

		 function get_parts_status_onid($user_id, $part)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->check_part_data_onid($user_id, $part);
			//print_r($comp_row);die('hel');
			return $comp_row;
		 }

		 function get_parta_comptype($reference_no=null, $user_id)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->check_parta_comp($reference_no, $user_id);
			//print_r($comp_row);die('hel');
			$comp_cap = $comp_row->complaint_capacity_id;
			return $comp_cap;
		 }

		 function get_parta_comptype_fn($fn=null)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->check_parta_comp_fn($fn);
			//print_r($comp_row);die('hel');
			$comp_cap = $comp_row->complaint_capacity_id;
			return $comp_cap;
		 }

		 function get_parta_comptype_compno($filing_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('scrutiny_model');
	 	 	$comp_row =  $CI->scrutiny_model->check_parta_comp($filing_no);
			//print_r($comp_row);die('hel');
			$comp_cap = $comp_row->complaint_capacity_id;
			return $comp_cap;
		 }
	}