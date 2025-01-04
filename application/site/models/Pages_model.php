<?php
class Pages_model extends MY_Model {

	/**
	 * Pages_model constructor.
	 */
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * @param array $conditions
	 * @return mixed
	 */
	public function get_pages($conditions = array())
	{
		$this->db->select('p.id, p.url, pl.title, pl.content');
		$this->db->from('pages p');
		$this->db->join('pages_languages pl', 'p.id=pl.id_page', 'left');

		foreach($conditions as $i=>$v) {
			$this->db->where($i, $v);
		}

		$this->db->where('pl.id_language', $this->currentLanguage());
		$this->db->where('enabled', '1');
		$this->db->order_by('order', 'asc');

		return $this->db->get()->result_array();
	}

	/**
	 * @param $url
	 * @return mixed
	 */
	public function get_by_url($url)
	{
	    $res = $this->get_pages(array('url' => $url));
		return current($res);
	}

}