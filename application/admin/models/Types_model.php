<?php
class Types_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_type() {
		return array("id"=>0, "name"=>"", "enabled"=>"1");
	}
	
	public function get_types($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, COUNT(b.id) AS nr_hotels');
			$this->db->from('types AS a');
			$this->db->join('hotels AS b', 'b.id_type=a.id', 'left');
			$this->db->order_by("a.name", "asc");
			$this->db->group_by("a.id");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('types', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_type($type = array()) {
		$data = array(
			'name' => $type['name'],
			'enabled' => $country['enabled']
		);
		
		if($country['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $type['id']);
			$this->db->update('types', $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('types', $data);
		}
		return;
	}
	
	public function delete_type($id_type) {
		$this->db->delete('types', array('id' => $id_type));
	}
	
	public function count_types() {
		return $this->db->count_all('types');
	}
}