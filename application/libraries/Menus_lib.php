<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_lib {
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('menu_model');
	}

//client own function to view data at own end
	public function get_menus($role_id){
		return $this->CI->menu_model->fetch_menus_header($role_id);
	}

	public function get_menu_name($id){
		$menu_row =  $this->CI->menu_model->fetch_menu_name($id);
		//print_r($r->menu_name);die('lib');
		return $menu_row->menu_name;
	}

	public function get_submenus($menu_id, $role_id){
		return $this->CI->menu_model->fetch_submenu_header($menu_id, $role_id);
	}

	public function get_submenu_name($id){
		$submenu_row =  $this->CI->menu_model->fetch_submenu_name($id);
		//print_r($r->menu_name);die('lib');
		return $submenu_row->name;
	}

	public function get_submenu_url($id){
		$submenu_row =  $this->CI->menu_model->fetch_submenu_url($id);
		//print_r($r->menu_name);die('lib');
		return $submenu_row->url;
	}

	public function get_role_name($id){
		$role_row =  $this->CI->menu_model->fetch_role_name($id);
		//print_r($r->menu_name);die('lib');
		return $role_row->name;
	}
}
