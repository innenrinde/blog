<?php


class Users_model extends MY_Model {

	/**
	 * Users_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param array $conditions
	 * @return mixed
	 */
	public function get_users($conditions = array())
	{
		$this->db->select('u.id, u.first_name, u.last_name, u.slug, ul.description,
		ui.thumb_image_name AS author_image');
		$this->db->from('users u');
		$this->db->join('users_images ui', 'u.id=ui.id_user', 'left');
		$this->db->join('users_languages ul', 'ul.id_user=u.id AND ul.id_language='.$this->currentLanguage(), 'left');

		foreach($conditions as $i=>$v) {
			$this->db->where($i, $v);
		}

		$this->db->where('active', '1');

		return $this->db->get()->result_array();
	}

	/**
	 * @param $slug
	 * @return mixed
	 */
	public function get_by_slug($slug)
	{
		$res = $this->get_users(array('slug' => $slug));
		return current($res);
	}
}