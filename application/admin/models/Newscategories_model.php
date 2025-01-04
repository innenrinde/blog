<?php
class NewsCategories_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function init_category() {
		return [
			'id' => 0,
			'title' => $this->init_definitions(),
			'url' => '',
			'id_parent' => 0,
			'enabled' => 1,
			'order' => 0,
			'type' => 'news',
			'image_file' => '',
			'image_name' => '',
			'image_title' => '',
			'allow_comments' => 0
		];
	}

	public function get_categories($id = FALSE, $current_page = 0, $per_page = 0, $where = array()) {
		if (!$id) {
			$this->db->select('a.*, b.title AS title_parent');
			$this->db->from('news_categories AS a');
			$this->db->join('news_categories AS b', 'a.id_parent=b.id', 'left');
			/*$this->db->order_by('a.id_parent', 'asc');
			$this->db->order_by('a.title', 'asc');*/
			$this->db->order_by('a.order', 'asc');
			$this->db->limit($per_page, $current_page);

			if(!empty($where)) {
				foreach($where as $i=>$v) {
					$this->db->where($i, $v);
				}
			}

			$query = $this->db->get();
			return $query->result_array();
		}

		$query = $this->db->get_where('news_categories', array('id' => $id));
		return $this->get_definitions(
			$query->row_array(),
			'news_categories',
			['title'],
			'id_news_category');
	}

	public function get_categories_tree($where = array()) {
		$categories = $this->get_categories(false, 0, 0, $where);
		$tree = array('id' => 0, 'title' => 'root', 'childs' => array());
		$this->build($tree, 0, $categories);
		return $tree;
	}

	protected function build(&$tree, $id_parent, $categories) {
		foreach($categories as $i=>$v) {
			if($v['id_parent'] == $id_parent) {
				$this->build($v, $v['id'], $categories);
				$tree['childs'][] = $v;
			}
		}
	}

	/**
	 * @param array $category
	 */
	public function save_category($category = array())
	{
		$data = array(
			'title' => current($category['title']),
			'url' => $category['url'],
			'id_parent' => $category['id_parent'],
			'enabled' => $category['enabled'],
			'order' => $category['order'],
			'type' => $category['type'],
			'allow_comments' => $category['allow_comments']
		);

		if($category['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $category['id']);
			$this->db->update('news_categories', $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('news_categories', $data);
			$category['id'] = $this->db->insert_id();
		}
		$this->save_definitions('news_categories', $category, ['title'], 'id_news_category', $category['id']);
		return;
	}

	public function delete_category($id_category) {
		$this->delete_image_category($id_category);
		$this->delete_definitions('news_categories', 'id_news_category', $id_category);
		$this->db->delete('news_categories', array('id' => $id_category));
	}

	public function count_categories() {
		return $this->db->count_all('news_categories');
	}

	public function save_order($id_category, $order) {
		$data = array('order' => $order);
		$this->db->where('id', $id_category);
		$this->db->update('news_categories', $data);
	}

	public function save_image($id_category, $image_name, $thumb_image_name) {
		$this->delete_image_category($id_category);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id', $id_category);
		$this->db->update('news_categories', $data);
	}

	public function delete_image_category($id_category) {
		$query = $this->db->get_where('news_categories', array('id' => $id_category));
		$row = $query->row_array();

		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/categories/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/categories/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/categories/original/".$row['image_original_file']);
		}

		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id', $id_category);
		$this->db->update('news_categories', $data);
	}
}