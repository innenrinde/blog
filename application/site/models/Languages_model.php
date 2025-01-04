<?php

class Languages_model extends MY_Model {

	/**
	 * Languages_model constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * @param array $conditions
	 * @return mixed
	 */
	public function get_languages($conditions = array())
	{
		$this->db->select('a.*');
		$this->db->from('languages AS a');

		foreach($conditions as $i=>$v) {
			$this->db->where($v, 1);
		}
		$this->db->where('show_on_site', 1);
		$this->db->order_by("a.name", "asc");

		return $this->db->get()->result_array();
	}
}