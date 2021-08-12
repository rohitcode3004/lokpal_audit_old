<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
 	{
    function get_ip()
    {
    	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    		return $ip=$_SERVER['HTTP_CLIENT_IP'];
    	}
    	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    		return $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	else{
    		return $ip=$_SERVER['REMOTE_ADDR'];
    	}
    }

    function get_listing_count($complaint_no)
    {
        $CI =& get_instance();
        $CI->load->model('bench_model');
        $count_row =  $CI->bench_model->fetch_listing_count($complaint_no);
        return $count = $count_row->listing_count;
    }

    function get_agncode($roleid)
         {
            //echo $user_id;
            $CI =& get_instance();
            $CI->load->model('agency_model');
            $agency_row =  $CI->agency_model->get_agency_master($roleid);
            $where = array();
            foreach ($agency_row as $key => $value)
                array_push($where, $value->agency_code);
            
            //print_r($psdetail_row);die('hel');
            return $where;
         }

    function getAgencyCount($filing_no)
    {
        $CI =& get_instance();
        $CI->load->model('agency_model');
        $count_row =  $CI->agency_model->fetch_agency_count($filing_no);
        //print_r($count_row);die();
        if($count_row === 0)
            return 0;
        else
            return $count = $count_row->agency_counter;
    }

    function get_agname($code)
    {
        $CI =& get_instance();
        $CI->load->model('agency_model');
        $agn_row =  $CI->agency_model->fetch_agname($code);
        return $agn_row->agency_name;
    }

    function get_ordertype($code)
    {
        $CI =& get_instance();
        $CI->load->model('agency_model');
        $agn_row =  $CI->agency_model->fetch_ordertype($code);
        return $agn_row->ordertype_name;
    }

    function get_fullname($a, $b, $c, $d)
    {
        $CI =& get_instance();
        $CI->load->model('proceeding_model');
        $sal =  $CI->proceeding_model->fetch_sal($a);
        $sal =  $sal[0]->salutation_desc;
        $fname =  ($b != null || $b != "") ? ' '.$b : '';
        $mname =  ($c != null || $c != "") ? ' '.$c : '';
        $lname =  ($d != null || $d != "") ? ' '.$d : '';
        return $sal.$fname.$mname.$lname;
    }

    function get_listed_status($filing_no)
    {
        $CI =& get_instance();
        $CI->load->model('bench_model');
        $cd_row =  $CI->bench_model->fetch_listed_status($filing_no);
        return $cd_row->listed;
    }

    function decode($encoded) {
        $encoded = base64_decode($encoded);
        $decoded = "";
        for( $i = 0; $i < strlen($encoded); $i++ ) {
    $b = ord($encoded[$i]);
    $a = $b ^ 10; // 
    $decoded .= chr($a);
    }
    return base64_decode(base64_decode($decoded));
    }
}