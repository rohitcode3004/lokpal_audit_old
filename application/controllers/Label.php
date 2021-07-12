<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Label extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('label_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->label_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function update()
	{
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('long_name', 'Long Name', 'required');
		$this->form_validation->set_rules('short_name', 'Short Name', 'required');
		$this->form_validation->set_rules('display', 'Display', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'level_master_id' => $this->input->post('level'),
				'long_name' => $this->input->post('long_name'),
				'short_name' => $this->input->post('short_name'),
				'description' => $this->input->post('description'),
				'display' => $this->input->post('display')
			);

			$this->label_model->update_element($this->input->post('id'), $data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'level' => form_error('level'),
				'long_name' => form_error('long_name'),
				'short_name' => form_error('short_name'),
				'display' => form_error('display'),
			);
		}
		echo json_encode($array);
	}

	function insert()
	{
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('long_name', 'Long Name', 'required');
		$this->form_validation->set_rules('short_name', 'Short Name', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'level_master_id' => $this->input->post('level'),
				'long_name' => $this->input->post('long_name'),
				'short_name' => $this->input->post('short_name'),
				'display' => $this->input->post('display'),
				'description' => $this->input->post('description')
			);

			$this->label_model->insert_element($data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'level' => form_error('level'),
				'long_name' => form_error('long_name'),
				'short_name' => form_error('short_name'),
				'display' => form_error('display')
			);
		}
		echo json_encode($array);
	}

	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->label_model->fetch_single_element($this->input->post('id'));
			foreach ($data as $row)
			 {
				$output['level'] = $row['level_master_id'];
				$output['long_name'] = $row['long_name'];
				$output['short_name'] = $row['short_name'];
				$output['description'] = $row['description'];
				$output['display'] = $row['display'];
			}
			echo json_encode($output);
		}
	}


//client own function to view data at own end
	public function view($slug = NULL){
		$data['element'] = $this->label_model->get_element($slug);

		//if(empty($data)){
		//	show_404();
		//}

		//$this->load->view('templates/header');
		//$this->load->view('master/filing_view', $data);
		//$this->load->view('templates/footer');
	}
}
