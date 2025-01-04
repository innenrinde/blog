<?php
class Localitati_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function get_judete($id = FALSE, $current_page = 0, $per_page = 0) {
		
		if (!$id)
		{
			$query = $this->db->get('judete');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('judete', array('id_judet' => $id));
		return $query->row_array();
	}
	
	public function get_localitati($id_judet = 0, $id = 0, $current_page = 0, $per_page = 0) {
		
		if (!$id && $id_judet)
		{
			$query = $this->db->select("a.*, b.name AS region");
			$query = $this->db->from("localitati as a");
			$query = $this->db->join("regions as b", "a.id_region=b.id", "left");
			$query = $this->db->where("a.id_judet", $id_judet);
			$this->db->order_by("a.localitate", "asc");
			$query = $this->db->get();
			return $query->result_array();
		}
		
		$query = $this->db->get_where('localitati', array('id_localitate' => $id));
		return $query->row_array();
	}
	
	public function get_localitati_by_regiune_judet($id_region, $id_judet) {
		$query = $this->db->get_where('localitati', array('id_region' => $id_region, 'id_judet' => $id_judet));
		return $query->result_array();
	}
	
	public function get_localitati_by_regiune($id_region) {
		$query = $this->db->get_where('localitati', array('id_region' => $id_region));
		return $query->result_array();
	}
	
	public function get_localitati_by_judet($id_judet) {
		$query = $this->db->get_where('localitati', array('id_judet' => $id_judet));
		return $query->result_array();
	}
}