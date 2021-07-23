<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_label extends CI_Controller {

	public function __construct(){
		parent::__construct();	
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('Menus_lib');

		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
		$this->load->model('login_model');
	}

	function index()
	{
		if($this->isUserLoggedIn) 
		{
			$con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);

            //print_r($data['user']['id']);die;

	   		$data['menus'] = $this->menus_lib->get_menus($data['user']['role']);
		
			$this->load->view('label/label_view', $data);
		}else
		{
			redirect('admin/login'); 
		}
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');
			//print_r($_POST);die($data_action);

			if($data_action == 'edit')
			{
				//die('great');
			$api_url = base_url()."label/update";

			$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'display' => $this->input->post('display'),
					'description' => $this->input->post('description'),
					'id' => $this->input->post('element_id')
					 );
			$client = curl_init($api_url);
			curl_setopt($client, CURLOPT_POST, true);
			curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($client);
			curl_close($client);
			echo $response;
			}

			if($data_action == 'fetch_single')
			{
				$api_url = base_url()."label/fetch_single";

				$form_data = array(
					'id' => $this->input->post('element_id')
					 );

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}

			if($data_action == 'insert')
			{
				//die('great');
				$api_url = base_url()."label/insert";

			$form_data = array(
					'level' => $this->input->post('level'),				
					'long_name' => $this->input->post('longname'),
					'short_name' => $this->input->post('shortname'),
					'description' => $this->input->post('description'),
					'display' => $this->input->post('display')
					 );
			$client = curl_init($api_url);
			curl_setopt($client, CURLOPT_POST, true);
			curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($client);
			curl_close($client);
			echo $response;
			}

			if($data_action == 'fetch_all')
			{
				$api_url = base_url()."label";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				$output = '';
				$count = 0;
				if (count($result) > 0) {
					foreach ($result as $row) {
						$count ++;
						if($row->level_master_id == '1')
							$level = 'filing';
						elseif ($row->level_master_id == '2')
							$level = 'scrutiny';
						$output .='
						<tr>
						    <td>'.$count.'</td>
						    <td>'.$row->id.'</td>
							<td>'.$level.'</td>
							<td>'.$row->long_name.'</td>
							<td>'.$row->short_name.'</td>
							<td>'.$row->description.'</td>
							<td>'.$row->display.'</td>
							<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">EDIT</button>
							</td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">DELETE</button>
							</td>
						</tr>
						'; 
					}
				}else{
					$output .='
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}
				echo $output;
			}
		}
	}
}
