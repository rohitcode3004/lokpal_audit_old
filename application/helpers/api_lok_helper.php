    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('convertToBase64'))
    {

        function get_complainant_type($code)
        {
            if($code != ''){
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $complainant_type_row =  $CI->api_lokpal_model->fetch_complainant_type($code);
            return $complainant_type_row->complaint_capacity_desc;
            }else{
                return;
            }
        }

        function get_gender($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $gender_row =  $CI->api_lokpal_model->fetch_gender($code);
            return $gender_row->gender_desc;
        }

        function get_nationality($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $nationality_row =  $CI->api_lokpal_model->fetch_nationality($code);
            return $nationality_row->nationality_desc;
        }

        function get_identity_proof($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $identity_proof_row =  $CI->api_lokpal_model->fetch_identity_proof($code);
            return $identity_proof_row->Identity_proof_desc;
        }

        function get_residence_proof($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $residence_proof_row =  $CI->api_lokpal_model->fetch_residence_proof($code);
            return $residence_proof_row->idres_proof_desc;
        }

        function get_state($code)
        {
            if($code != ''){
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $state_row =  $CI->api_lokpal_model->fetch_state($code);
            return $state_row->name;
            }else{
                return;
            }
        }

        function get_district($code, $scode)
        {
            if($code != ''){
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $district_row =  $CI->api_lokpal_model->fetch_district($code, $scode);
            return $district_row->name;
            }else{
                return;
            }
        }

        function get_country($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $country_row =  $CI->api_lokpal_model->fetch_country($code);
            return $country_row->country_desc;
        }

        function get_complaint_mode($code)
        {
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $complaint_mode_row =  $CI->api_lokpal_model->fetch_complaint_mode($code);
            return $complaint_mode_row->complaintmode_desc;
        }

        function get_yes_no($code)
        {
            if($code == 1)
                return 'Yes';
            elseif($code == 2)
                return 'No';
        }

        function get_salutation($code)
        {
            if($code != ''){
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $salutation_row =  $CI->api_lokpal_model->fetch_salutation($code);
            return $salutation_row->salutation_desc;
            }else{
                return;
            }
        }

        function get_ps_designation($code)
        {
            if($code != ''){
            $CI =& get_instance();
            $CI->load->model('api_lokpal_model');
            $ps_designation_row =  $CI->api_lokpal_model->fetch_ps_designation($code);
            return $ps_designation_row->ps_desc;
            }else{
                return;
            }
        }

    }