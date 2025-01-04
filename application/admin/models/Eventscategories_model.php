<?php
class EventsCategories_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_category() {
		return array("id"=>0, "title"=>"", "url"=>"", "enabled"=>"1");
	}
	
	public function get_categories($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*');
			$this->db->from('events_categories AS a');
			$this->db->order_by("a.title", "asc");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			$categories = array();
			foreach ($query->result_array() as $row) {
				$categories[$row['id']] = $row;
			}
			return $categories;
		}
		
		$query = $this->db->get_where('events_categories', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_category($category = array()) {
		$data = array(
			'title' => $category['title'],
			'url' => $category['url'],
			'enabled' => $category['enabled']
		);
		
		if($category['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $category['id']);
			$this->db->update('events_categories', $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('events_categories', $data);
		}
		return;
	}
	
	public function delete_category($id_category) {
		$this->db->delete('events_categories', array('id' => $id_category));
	}
	
	public function count_categories() {
		return $this->db->count_all('events_categories');
	}
}