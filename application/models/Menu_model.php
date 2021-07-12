<?php
class Menu_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function fetch_all()
	{
		$this->db->select('submenu.*, menus.*');
		$this->db->from('submenu');
		$this->db->join('menus', 'menus.id = submenu.menu_id', 'right');
		return $this->db->get();
	}

		function insert_menu($data)
	{
		$this->db->insert('menus', $data);
	}

	function fetch_menus()
	{
		$this->db->select('id, menu_name');
		$this->db->from('menus');
		$this->db->where('display = TRUE');
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_roles()
	{
		$this->db->select('id, name');
		$this->db->from('roles');
		$this->db->where('display = TRUE');
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_submenus($id)
	{
		$this->db->select('id, name');
		$this->db->from('submenu');
		$this->db->where('menu_id', $id);
		$this->db->where('display = TRUE');
		$query = $this->db->get();
		return $query->result();
	}

	function insert_submenu($data)
	{
		$this->db->insert('submenu', $data);
		return $this->db->insert_id();
	}

	function fetch_all_roles()
		{
			$this->db->select('*');
			$this->db->from('roles');
			return $this->db->get();
		}

	function insert_role($data)
		{
			$this->db->insert('roles', $data);
		}

	function fetch_menus_header($role_id)
		{
			//$this->db->distinct();
			//$this->db->select('menu_id');
			//$this->db->from('permissions');
			//$this->db->where('role_id', $role_id);
			//$this->db->where('display', 'TRUE');
			//return $this->db->get()->result();

			$this->db->distinct('permissions.menu_id');
			$this->db->select('menus.*, permissions.menu_id');
			$this->db->from('menus');
			$this->db->join('permissions', 'permissions.menu_id = menus.id');
			$this->db->where('permissions.role_id', $role_id);
			$this->db->where('permissions.display', 'TRUE');
			$this->db->order_by('menus.priority', 'ASC');
			return $this->db->get()->result();
		}
		
	function fetch_menu_name($id)
		{
			$this->db->select('menu_name');
			$this->db->from('menus');
			$this->db->where('id', $id);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
			return $this->db->get()->row();
		}

	function fetch_submenu_header($menu_id,$role_id)
		{
			$this->db->distinct();
			$this->db->select('submenu_id');
			$this->db->from('permissions');
			$this->db->where('menu_id', $menu_id);
			$this->db->where('role_id', $role_id);
			$this->db->where('display', 'TRUE');
			return $this->db->get()->result();
		}

	function fetch_submenu_name($id)
		{
			$this->db->select('name');
			$this->db->from('submenu');
			$this->db->where('id', $id);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
			return $this->db->get()->row();
		}

	function fetch_submenu_url($id)
		{
			$this->db->select('url');
			$this->db->from('submenu');
			$this->db->where('id', $id);
			$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
			return $this->db->get()->row();
		}

	function fetch_all_perm()
		{
			$this->db->select('*');
			$this->db->from('permissions');
			return $this->db->get();
		}

	function fetch_role_name($id)
		{
			$this->db->select('name');
			$this->db->from('roles');
			$this->db->where('id', $id);
			//$this->db->where('display', 'TRUE');
			//$this->db->order_by('priority asc');
			return $this->db->get()->row();
		}

	function store_perm($data)
		{
			$this->db->insert('permissions', $data);
			return $this->db->insert_id();
		}

	function delete_perm($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('permissions');
		}

	function delete_role($id)
		{
			$this->db->where('id', $id);
			return $this->db->delete('roles');
		}
}
?>