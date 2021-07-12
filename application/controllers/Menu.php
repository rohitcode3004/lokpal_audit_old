<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('login_model');
		$this->load->library('form_validation');
		$this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
	}

	function index()
	{
		$data = $this->menu_model->fetch_all();
		echo json_encode($data->result_array());
	}

		function insert_menu()
	{
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
		$this->form_validation->set_rules('priority', 'Priority', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'menu_name' => $this->input->post('menu_name'),
				'priority' => $this->input->post('priority'),
				'display' => $this->input->post('display'),
			);

			$this->menu_model->insert_menu($data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'menu_name' => form_error('menu_name'),
				'priority' => form_error('priority'),
				'display' => form_error('display')
			);
		}
		echo json_encode($array);
	}

	function fetch_submenus()
	{
		//print_r($this->input->post('id'));die('kkk');
		if($this->input->post('menuid'))
		{
			//die('uuu');
			$data = $this->menu_model->fetch_submenus($this->input->post('menuid'));
			if(!empty($data))
		 {
		 foreach($data as $value)
		 {
		 echo '<option value="'.$value->id.'">'.$value->name.'</option>';
		 }		 
		 }
		}
	}

	function insert_submenu()
	{
		if($this->isUserLoggedIn) 
		{
		if($this->input->post('submitform')){ 
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
		$this->form_validation->set_rules('submenu_name', 'Submenu Name', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		//$this->form_validation->set_rules('priority', 'Priority', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'menu_id' => $this->input->post('menu_name'),
				'name' => $this->input->post('submenu_name'),
				'url' => $this->input->post('url'),
				'priority' => $this->input->post('priority'),
				'display' => $this->input->post('display'),
			);
			if($data['priority'] == ''){
				$data['priority'] = null;
			}

			$insert = $this->menu_model->insert_submenu($data);
			if($insert){
				$this->session->set_flashdata('success_msg', 'Submenu has been created.');
			    redirect('admin/view_menus'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
		}else{ 
            	//echo validation_errors();
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        }

        $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
        $data['menus'] = $this->menu_model->fetch_menus();
        $this->load->view('admin/dashboard/add_submenu', $data);
        }else{
			redirect('admin/login'); 
			}
	}

function view_roles()
	{
		$data = $this->menu_model->fetch_all_roles();
		echo json_encode($data->result_array());
	}

	function delete_role()
{
	if($this->input->post('id'))
	{
		if($this->menu_model->delete_role($this->input->post('id')))
		{
			$array = array(
				'success' => true
			);
		}else
		{
			$array = array(
				'error' => true
			);
		}
		echo json_encode($array);
	}
}

function view_permissions()
	{
		$data = $this->menu_model->fetch_all_perm();
		echo json_encode($data->result_array());
	}	

function insert_perm()
	{
		if($this->isUserLoggedIn) 
		{
		if($this->input->post('submitform')){ 
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
		$this->form_validation->set_rules('submenu_name', 'Submenu Name', 'required');
		$this->form_validation->set_rules('role_name', 'Role', 'required');
		//$this->form_validation->set_rules('priority', 'Priority', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'role_id' => $this->input->post('role_name'),
				'menu_id' => $this->input->post('menu_name'),
				'submenu_id' => $this->input->post('submenu_name'),
				'display' => $this->input->post('display'),
			);

			$insert = $this->menu_model->store_perm($data);
			if($insert){
				$this->session->set_flashdata('success_msg', 'Permission has been assigned.');
			    redirect('admin/view_permissions'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
		}else{
			$data['error_msg'] = 'Please fill all the mandatory fields.';
		}
			}
        $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->login_model->getRows($con);
        	$data['menus'] = $this->menu_model->fetch_menus();
        	$this->load->view('admin/dashboard/add_perm', $data);
		}else{
			redirect('admin/login'); 
			}
	}

function delete_perm()
{
	if($this->input->post('id'))
	{
		if($this->menu_model->delete_perm($this->input->post('id')))
		{
			$array = array(
				'success' => true
			);
		}else
		{
			$array = array(
				'error' => true
			);
		}
		echo json_encode($array);
	}
}

		function insert_role()
	{
		$this->form_validation->set_rules('role', 'Role', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'name' => $this->input->post('role'),
				'display' => $this->input->post('display'),
			);

			$this->menu_model->insert_role($data);
			$array = array(
				'success' => true 
				 );
		}else{
			$array = array(
				'error' => true,
				'role' => form_error('role'),
				'display' => form_error('display')
			);
		}
		echo json_encode($array);
	}
}
