<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload {
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('menu_model');
	}

	public function validate_image($t,$parameter) {
		$CI =& get_instance();
		$CI->load->library('form_validation');

		$param_breakup = explode('||', $parameter);
		$name = $param_breakup[0];
		$size = $param_breakup[1];
		$temp_name = $param_breakup[2];
			//print_r($param_breakup);die('rt');
		$check = TRUE;
		if ($size == 0) {

		$CI->form_validation->set_message('validate_image', 'The file size shoud not exceed 20MB!');
		$check = FALSE;
		}
		if(filesize($temp_name) > 20000000) {        	//echo "in size";die;
		$CI->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 20MB!');
		$check = FALSE;
		}
		if ($size != 0) {
		$allowedTypes = array('pdf', "PDF");
		$filename = $name;
		$allowedExts = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($allowedExts, $allowedTypes)) {
		$CI->form_validation->set_message('validate_image', 'Invalid Image Content!');
		$check = FALSE;
		}
		$extension = pathinfo($name, PATHINFO_EXTENSION);     
		$allowedExts = array("pdf", "PDF");      
		$detectedType = exif_imagetype($temp_name);    
		if(!in_array($extension, $allowedExts)) {     	
		$CI->form_validation->set_message('validate_image', "Invalid file extension {$extension} only pdf allowed");
		$check = FALSE;
		}
	}
		return $check;
	}
}
