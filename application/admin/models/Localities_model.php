<?php
class Localities_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_locality() {
		return array("id_judet"=>0, "id_region"=>0, "localitate"=>"");
	}
	
	public function get_localities($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, b.judet, c.name AS region');
			$this->db->from('localitati AS a');
			$this->db->join('judete AS b', 'b.id_judet=a.id_judet', 'left');
			$this->db->join('regions AS c', 'c.id=a.id_region', 'left');
			$this->db->limit($per_page, $current_page);
			$this->db->order_by("localitate", "asc");
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('localitati', array('id_localitate' => $id));
		
		return $query->row_array();
	}
	
	public function save_locality($locality = array()) {
		$data = array(
			'id_region' => $locality['id_region'],
			'id_judet' => $locality['id_judet'],
			'localitate' => $locality['localitate']
		);
		
		if($locality['id_localitate'] > 0) {
			//$data['log_date2'] = date("Y-m-d H:i:s");
			//$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id_localitate', $locality['id_localitate']);
			$this->db->update('localitati', $data);
		}
		else {
			//$data['log_date'] = date("Y-m-d H:i:s");
			//$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('localitati', $data);
		}
		return;
	}
	
	public function delete_locality($id_locality) {
		$this->db->delete('localitati', array('id_localitate' => $id_locality));
	}
	
	public function count_localities() {
		return $this->db->count_all('localitati');
	}
	
	public function get_all_localities() {
		$query = $this->db->select("*");
		$query = $this->db->from("localitati as l");
		$this->db->order_by("l.localitate");
		$query = $this->db->get();
		return $query->result_array();
	}
}