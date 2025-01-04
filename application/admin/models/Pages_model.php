<?php
class Pages_model extends MY_Model {

	/**
	 * Pages_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @return array
	 */
	public function init_page()
	{
		return array(
			'id' => NULL,
			'title' => $this->init_definitions(),
			'content' => $this->init_definitions(),
			'seo_keywords' => '',
			'seo_title' => '',
			'seo_description' => '',
			'enabled' => 0,
			'order' => 0,
			'url' => ''
		);
	}

	/**
	 * @param bool $id
	 * @param int $current_page
	 * @param int $per_page
	 * @return mixed
	 */
	public function get($id = FALSE, $current_page = 0, $per_page = 0)
	{
		if (!$id) {
			$this->db->select('p.*');
			$this->db->from('pages AS p');
			$this->db->order_by("order", "ASC");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();

			return $query->result_array();
		}

		$query = $this->db->get_where('pages', array('id' => $id));
		return $this->get_definitions(
			$query->row_array(),
			'pages',
			['title', 'content'],
			'id_page');
	}

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function save($data = array())
	{
		$page = $this->init_page();
		foreach($page as $column => $value) {
			if(isset($data[$column])) {
				$page[$column] = is_array($data[$column]) ? current($data[$column]) : $data[$column];
			}
		}
		if($page['id'] > 0) {
			$page['log_date2'] = date("Y-m-d H:i:s");
			$page['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $page['id']);
			$this->db->update('pages', $page);
		} else {
			$page['log_date'] = date("Y-m-d H:i:s");
			$page['log_ip'] = $this->input->ip_address();
			$this->db->insert('pages', $page);
			$page['id'] = $this->db->insert_id();
		}

		$this->save_definitions('pages', $data, ['title', 'content'], 'id_page', $page['id']);
		return $page['id'];
	}

	public function count() {
		return $this->db->count_all('pages');
	}

	/**
	 * @param $id
	 */
	public function delete($id)
	{
		$this->delete_definitions('pages', 'id_page', $id);
		$this->db->delete('pages', array('id' => $id));
	}
}