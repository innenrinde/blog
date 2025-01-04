<?php
class Events_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_event() {
		return array("id"=>0,
						"title"=>"",
						"date"=>"",
						"id_country"=>"",
						"id_region"=>"",
						"id_locality"=>"",
						"description"=>"",
						"organizers"=>"",
						"taxevent"=>"",
						"image_name"=>"",
						"image_title"=>"",
						"image_file"=>"",
						"image_original_file"=>"",
						"seo_keywords"=>"",
						"seo_title"=>"",
						"seo_description"=>"",
						"type"=>"",
						"featured"=>"0",
						"enabled"=>"1",
						"subscribe_enabled"=>"0"
		);
	}
	
	public function get_events($id = FALSE, $current_page = 0, $per_page = 0, array $filters = array()) {
		if (!$id) {
			$this->db->select('a.*, c.name AS country');
			$this->db->from('events AS a');
			$this->add_filter($filters);
			$this->db->join('countries AS c', 'a.id_country=c.id', 'left');
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('events', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_event($event = array()) {
		$data = array(
			'title' => $event['title'],
			'date' => $event['date'],
			'id_country' => $event['id_country'],
			'id_region' => $event['id_region'],
			'id_locality' => $event['id_locality'],
			'description' => $event['description'],
			'organizers' => $event['organizers'],
			'taxevent' => $event['taxevent'],
			'image_name' => $event['image_name'],
			'image_title' => $event['image_title'],
			'seo_keywords' => $event['seo_keywords'],
			'seo_title' => $event['seo_title'],
			'seo_description' => $event['seo_description'],
			'type' => $event['type'],
			'featured' => $event['featured'],
			'enabled' => $event['enabled'],
			'subscribe_enabled' => $event['subscribe_enabled']
		);
		
		if($event['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $event['id']);
			$this->db->update('events', $data);
			
			return $event['id'];
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('events', $data);
			
			return $this->db->insert_id();
		}
		return;
	}
	
	public function save_image($id_event, $image_name, $thumb_image_name) {
		$this->delete_image_event($id_event);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id', $id_event);
		$this->db->update('events', $data);
	}
	
	public function delete_event($id_event) {
		$this->delete_image_event($id_event);
		$this->db->delete('events', array('id' => $id_event));
	}
	
	public function delete_image_event($id_event) {
		$query = $this->db->get_where('events', array('id' => $id_event));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/events/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/events/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/events/original/".$row['image_original_file']);
		}
		
		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id', $id_event);
		$this->db->update('events', $data);
	}
	
	public function count_events(array $filters = array()) {
		$this->add_filter($filters);
		return $this->db->count_all_results('events as a');
	}
	
	private function add_filter(array $filters = array()) {
		if (isset($filters['title']) && !empty($filters['title'])) {
			$this->db->like('a.title', $filters['title']);
		}
		if (isset($filters['country']) && !empty($filters['country'])) {
			$this->db->where('a.id_country', $filters['country']);
		}
		if (isset($filters['organizers']) && !empty($filters['organizers'])) {
			$this->db->like('a.organizers', $filters['organizers']);
		}
		if (isset($filters['type']) && !empty($filters['type'])) {
			$this->db->where('a.type', $filters['type']);
		}
		if (isset($filters['featured']) && is_numeric($filters['featured'])) {
			$this->db->where('a.featured', $filters['featured']);
		}
		if (isset($filters['enabled']) && is_numeric($filters['enabled'])) {
			$this->db->where('a.enabled', $filters['enabled']);
		}
	}
}