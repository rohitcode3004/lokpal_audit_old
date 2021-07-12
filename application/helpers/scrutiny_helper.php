<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
 	{

 function get_remarkedby_name($id)
    {
        $CI =& get_instance();
        $CI->load->model('scrutiny_model');
        $scrutinyteam_row =  $CI->scrutiny_model->get_last_rem_name($id);
        return $scrutinyteam_row[0]->display_name;
    }

 function get_remarkedby_his_datetime($date_time, $flag)
    {
        $CI =& get_instance();
        $CI->load->model('scrutiny_model');
        $last_datetime = explode(" ", $date_time);
		$last_date = $last_datetime[0];
		$last_date = list($year2,$month2,$day2)=explode('-',$last_date);
		$last_date = $day2."-".$month2."-".$year2;

		$last_time = $last_datetime[1];
		$last_time = date('h:i:s A', strtotime($last_time));

        if($flag == 'D')
        	return $last_date;
        elseif($flag == 'T')
        	return $last_time;
        else return 'na';
    }

function get_last_rem_id($fn)
    {
        $CI =& get_instance();
        $CI->load->model('scrutiny_model');
        $last_rem_row =  $CI->scrutiny_model->get_last_rem($fn);
        if($last_rem_row[0]->remarkd_by)
                return $last_rem_row[0]->remarkd_by;
            else
                return 'na';
    }   

function get_rem_his_helper($fn)
    {
        $CI =& get_instance();
        $CI->load->model('scrutiny_model');
        $remarks_his =  $CI->scrutiny_model->get_rem_his($fn);
        return $remarks_his = json_decode(json_encode($remarks_his), true);
        //print_r($remarks_his);
    }  

}