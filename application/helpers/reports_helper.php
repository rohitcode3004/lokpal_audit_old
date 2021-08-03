    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('convertToBase64'))
    {

        function get_realtime_status($filing_no)
        {
            $CI =& get_instance();
            $CI->load->model('lok_report_model');
            $type_row =  $CI->lok_report_model->fetch_realtime_status($filing_no);
            return $type_row;
            $type = $type_row->judge_type;
            if($type == 'C')
                return "Hon'ble Chairperson";
            elseif($type == 'J')
                return "Hon'ble Judicial Member";
            elseif($type == 'M')
                return "Hon'ble Member";
            else
                return "";
        }

        function get_gadjet_report($filing_no)
        {
            $CI =& get_instance();
            $CI->load->model('scrutiny_model');
            $parta_row =  $CI->scrutiny_model->fetch_gadjet_report($filing_no);
            //return $parta_row;
            $url = $parta_row->gazzette_notification_url;
            return $url;
        }

        function get_previous_gadjet_report($ref_no)
        {
            $CI =& get_instance();
            $CI->load->model('scrutiny_model');
            $parta_row =  $CI->scrutiny_model->fetch_previous_gadjet_report($ref_no);
            return $parta_row;
        }

    }