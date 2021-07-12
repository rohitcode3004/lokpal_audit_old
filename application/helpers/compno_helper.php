<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
	{
	     function get_filing_no($reference_no=null, $user_id=NULL)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->fetch_refno($reference_no, $user_id);
			//print_r($comp_row);die('hel');
			if(!empty($comp_row)){
			$array = array();
			if($comp_row[0]->filing_status == 't'){
					$array["status"] = $comp_row[0]->filing_status;
        			$array["complaint_no"] = $comp_row[0]->filing_no;
				}else{
					$array["status"] = 'f';
        			$array["complaint_no"] = '';
				}
			}else{
				$array["status"] = 'new';
        		$array["complaint_no"] = '';
			}
			return $array;
		 }

		 function get_refno_b($reference_no=null, $user_id=NULL)
		 {
		 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$comp_row =  $CI->filing_model->fetch_refno_b($reference_no, $user_id);
			//print_r($comp_row);die('hel');
			if(!empty($comp_row)){
				$refno_b = $comp_row[0]->ref_no;
			}else{
				$refno_b = null;
			}
			return $refno_b;
		 }

		 function get_against_name($filing_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('scrutiny_model');
	 	 	$row = $CI->scrutiny_model->get_row($filing_no);
	 	 	//print_r($row->ref_no);die('hel');
	 	 	$ref_no = $row->ref_no;
	 	 	$user_id = $row->user_id;
	 	 	$psdetail_row =  $CI->scrutiny_model->fetch_ps_detail($ref_no, $user_id);
			//print_r($psdetail_row);die('hel');
			$full_name_against = $psdetail_row->ps_first_name." ".$psdetail_row->ps_mid_name." ".$psdetail_row->ps_sur_name;
			return $full_name_against;
		 }

		 function get_comp_name($filing_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('scrutiny_model');
	 	 	$row = $CI->scrutiny_model->get_row($filing_no);
	 	 	//print_r($row->ref_no);die('hel');
	 	 	$ref_no = $row->ref_no;
	 	 	$user_id = $row->user_id;
	 	 	$psdetail_row =  $CI->scrutiny_model->fetch_ps_detail($ref_no, $user_id);
			//print_r($psdetail_row);die('hel');
			return $psdetail_row;
		 }

		 function get_ackno($ref_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$counterdetail_row =  $CI->filing_model->fetch_counter_detail($ref_no);
			//print_r($psdetail_row);die('hel');
			return $counterdetail_row;
		 }

		 function get_refno($filing_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('filing_model');
	 	 	$counterdetail_row =  $CI->filing_model->get_refno($filing_no);
			//print_r($psdetail_row);die('hel');
			return $counterdetail_row->ref_no;
		 }

		 function get_complaintno($filing_no)
	     {
	 	 	//echo $user_id;
	 	 	$CI =& get_instance();
	 	 	$CI->load->model('bench_model');
	 	 	$case_det_row =  $CI->bench_model->fetch_cn($filing_no);
			//print_r($psdetail_row);die('hel');
			if($case_det_row){
				$complaint_no = $case_det_row->complaint_no;
				$year = $case_det_row->complaint_year;
				if(strlen($complaint_no) == 1)
					return $complaintno_display="0".$complaint_no.'/'.$year;
				else
					return $complaintno_display=$complaint_no.'/'.$year;
		 	}else{
		 		return 'n/a';
		 	}
	}
}