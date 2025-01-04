<?php

class Languages_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_language() {
		return array("id"=>0, "name"=>"", "image_file" => "", "show_on_site"=>1, "enabled"=>"1");
	}
	
	public function get_languages($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*');
			$this->db->from('languages AS a');
			$this->db->order_by("a.name", "asc");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('languages', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_language($language = array()) {
		$data = array(
			'name' => $language['name'],
			'short' => $language['short'],
			'show_on_site' => $language['show_on_site'],
			'enabled' => $language['enabled']
		);
		
		if($language['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $language['id']);
			$this->db->update('languages', $data);
			
			return $language['id'];
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('languages', $data);
			
			return $this->db->insert_id();
		}
		return;
	}
	
	public function save_image($id_language, $image_file) {
		$this->delete_image_language($id_language);
		$data = array(
			'image_file' => $image_file
		);
		$this->db->where('id', $id_language);
		$this->db->update('languages', $data);
	}
	
	public function delete_image_language($id_language) {
		$query = $this->db->get_where('languages', array('id' => $id_language));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/languages/".$row['image_file']);
		}
		
		$data = array(
			'image_file' => ""
		);
		$this->db->where('id', $id_language);
		$this->db->update('languages', $data);
	}
	
	public function count_languages() {
		return $this->db->count_all('languages');
	}
}