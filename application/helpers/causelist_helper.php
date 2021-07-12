<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
 	{

 function get_causelist_cases($bi, $ld, $purpose_code, $venue)
    {
        $CI =& get_instance();
        $CI->load->model('causelist_model');
        $causelist_cases =  $CI->causelist_model->fetch_allocation_cases($bi, $ld, $purpose_code, $venue);
        return $causelist_cases;
    }

}