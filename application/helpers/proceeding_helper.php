<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
 	{

 function get_order_type($code)
    {
        $CI =& get_instance();
        $CI->load->model('proceeding_model');
        $ordertype_row =  $CI->proceeding_model->fetch_ordertype_name($code);
        return $ordertype_row->ordertype_name;
    }

     function get_agn_name($code)
    {
        $CI =& get_instance();
        $CI->load->model('proceeding_model');
        $agn_row =  $CI->proceeding_model->fetch_agn_name($code);
        if(!empty($agn_row))
            return $agn_row->agency_name;
        else
            return 'n/a';
    }

    function get_current_proc_details($filing_no)
        {
            $CI =& get_instance();
            $CI->load->model('proceeding_model');
            $proc_row = $CI->proceeding_model->fetch_current_proc_details($filing_no);
            return $proc_row;
        }
}