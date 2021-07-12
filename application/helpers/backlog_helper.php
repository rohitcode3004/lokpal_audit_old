    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('convertToBase64'))
    {

        function get_complaint_capacity_name($code)
        {
            $CI =& get_instance();
            $CI->load->model('backlog_model');
            $row =  $CI->backlog_model->fetch_complaint_capacity_name($code);
            return $row->category_name;
        }
    }