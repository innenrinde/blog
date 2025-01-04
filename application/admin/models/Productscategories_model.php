<?php
class ProductsCategories_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_category() {
		return array('id'=>0, 'name'=>'', 'url'=>'', 'id_parent'=>0, 'enabled'=>1, 'order'=>0, 'type'=>'news');
	}
	
	public function get_categories($id = FALSE, $current_page = 0, $per_page = 0, $where = array()) {
		if (!$id) {
			$this->db->select('a.*, b.name AS name_parent');
			$this->db->from('products_categories AS a');
			$this->db->join('products_categories AS b', 'a.id_parent=b.id', 'left');
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
		
		$query = $this->db->get_where('products_categories', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_categories_tree($where = array()) {
		$categories = $this->get_categories(false, 0, 0, $where);
		$tree = array('id' => 0, 'name' => 'root', 'childs' => array());
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
	
	public function save_category($category = array()) {
		$data = array(
			'name' => $category['name'],
			'url' => $category['url'],
			'id_parent' => $category['id_parent'],
			'enabled' => $category['enabled'],
			'order' => $category['order']
		);
		
		if($category['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $category['id']);
			$this->db->update('products_categories', $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('products_categories', $data);
		}
		return;
	}
	
	public function delete_category($id_category) {
		$this->db->delete('products_categories', array('id' => $id_category));
	}
	
	public function count_categories() {
		return $this->db->count_all('products_categories');
	}
	
	public function save_order($id_category, $order) {
		$data = array('order' => $order);
		$this->db->where('id', $id_category);
		$this->db->update('products_categories', $data);
	}
	
	// build tree categories
	public function build_tree(&$root, $categories) {
		foreach($categories as $v) {
			if($v['id_parent'] == $root['id']) {
				$v['childs'] = array();
				$this->build_tree($v, $categories);
				$root['childs'][] = $v;
			}
		}
	}
}