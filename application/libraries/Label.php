<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label {
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('label_model');
	}

//client own function to view data at own end
	public function view($slug = NULL){
		return $data['element'] = $this->CI->label_model->get_element($slug);
	}

	public function get_short_name($all, $id){
		$key = array_search($id, array_column($all, 'id'));
			return $all[$key]['short_name'];
	}

	public function get_description($all, $id){
		$key = array_search($id, array_column($all, 'id'));
			return $all[$key]['description'];
	}

	public function get_long_name($all, $id){
		$key = array_search($id, array_column($all, 'id'));
			return $all[$key]['long_name'];
	}
}
