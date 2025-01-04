<?php
class Users_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function init_user() {
		return array(
			"id" => 0,
			"first_name" => "",
			"last_name" => "",
			"active" => "1",
			"email" => "",
			"username" => "",
			"slug" => "",
			"description" => $this->init_definitions()
		);
	}

	public function login($user, $password) {
		$this->load->library('session');

		$this->db->where('username', $user);
		$this->db->where('password', $password);
		$this->db->where('type', 'admin');
		$this->db->where('enabled', '1');
		$num_rows = $this->db->count_all_results('users');

		if($num_rows == 1) {
			$query = $this->db->get_where('users', array('username' => $user, 'password' => $password, 'type'=>'admin', 'enabled'=>'1'));
			$row = $query->row_array();

			return $row;
		}
		return array();
	}

	public function get_users($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, b.image_name, b.thumb_image_name');
			$this->db->from('users a');
			$this->db->join('users_images b', 'a.id=b.id_user AND b.main_image=1', 'left');
			$this->db->group_by('a.id');
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();

			return $query->result_array();
		}

		$query = $this->db->get_where('users', array('id' => $id));
		return $this->get_definitions(
			$query->row_array(),
			'users',
			['description'],
			'id_user');

	}

	public function save_user($user = array()) {
		$data = array(
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'username' => $user['username'],
			'active' => $user['active'],
			'slug' => $user['slug'],
			'description' => current($user['description'])
		);

		if($user['id'] > 0) {
			$this->db->where('id', $user['id']);
			$this->db->update('users', $data);
		}
		else {
			$this->db->insert('users', $data);
			$user['id'] = $this->db->insert_id();
			$this->db->insert('users_groups', ['user_id' => $user['id'], 'group_id' => 1]);
			$user['id'] = $this->db->insert_id();
		}

		if(strlen($user['password']) > 0) {
			$CI =& get_instance();
			$CI->load->model('ion_auth_model');
			$this->ion_auth_model->change_password($user['email'], null, $user['password']);
		}
		$this->save_definitions('users', $user, ['description'], 'id_user', $user['id']);
		return $user['id'];
	}

	public function delete_user($id_user) {
		$this->delete_user_images($id_user);
		$this->db->delete('users', array('id' => $id_user));
	}

	public function count_users() {
		return $this->db->count_all('users');
	}


	public function delete_user_images($id_user) {
		$query = $this->db->get_where('users_images', array('id_user' => $id_user));
		$res = $query->result_array();

		foreach($res as $image) {
			$this->delete_image($image['id']);
		}
	}


	/**
	 * @param $id_user
	 */
	public function assign_images($id_user)
	{
		$this->db->update('users_images', array('id_user' => $id_user), array('id_user' => 0));
	}

	/**
	 * @param $id_user
	 * @param $image_name
	 * @param $thumb_image_name
	 */
	public function insert_image($id_user, $image_name, $thumb_image_name)
	{
		$data = array(
			'id_user' => $id_user,
			'image_name' => $image_name,
			'thumb_image_name' => $thumb_image_name
		);
		$this->db->insert('users_images', $data);
	}

	/**
	 * @param $id_image
	 * @param $id_user
	 */
	public function save_main_image($id_image, $id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->update('users_images', array('main_image' => 0));

		if($id_image && is_array($id_image)) {
			$id_image = current($id_image);
			$this->db->where('id_user', $id_user);
			$this->db->where('id', $id_image);
			$this->db->update('users_images', array('main_image' => 1));
		}
		else {
			$image = $this->db->where('id_user', $id_user)->from('users_images')->limit(0, 1)->get()->row_array();
			if($image) {
				$this->db->update('users_images', array('main_image' => 1), array('id' => $image['id']));
			}
		}
	}

	/**
	 * @param $id_user
	 * @param null $id_image
	 * @return mixed
	 */
	public function get_images($id_user = NULL, $id_image = NULL)
	{
		if(!$id_user && !$id_image) {
			return array();
		}

		$this->db->from('users_images');
		if($id_user) {
			$this->db->where('id_user', $id_user);
		}
		if($id_image) {
			$this->db->where('id', $id_image);
		}
		return $this->db->get()->result_array();
	}

	/**
	 * @param $id
	 */
	public function delete_image($id)
	{
		$query = $this->db->get_where('users_images', array('id' => $id));
		$image = $query->row_array();

		if(strlen($image['image_name']) > 0) {
			unlink($this->config->item('server_path')."files/users/thumb/".$image['thumb_image_name']);
			unlink($this->config->item('server_path')."files/users/mediu/".$image['thumb_image_name']);
			unlink($this->config->item('server_path')."files/users/original/".$image['image_name']);
		}
		$this->db->delete('users_images', array('id' => $id));
	}

}