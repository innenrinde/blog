<?php
class Regions_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_region() {
		return array(   "id"=>0,
                                "name"=>"",
                                "id_country"=>0,
                                "description"=>"",
                                "image_file"=>"",
                                "image_name"=>"",
                                "image_title"=>"",
                                "seo_keywords" => "",
                                "seo_title" => "",
                                "seo_description" => "",
                                "enabled"=>"1");
	}
	
	public function get_regions($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, c.name AS country, COUNT(b.id_localitate) AS nr_localitati');
			$this->db->from('regions AS a');
			$this->db->join('localitati AS b', 'b.id_region=a.id', 'left');
			$this->db->join('countries AS c', 'a.id_country=c.id', 'left');
			$this->db->order_by("a.name", "asc");
			$this->db->group_by("a.id");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('regions', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_regions_by_country($id) {
		$query = $this->db->get_where('regions', array('id_country' => $id));
		return $query->result_array();
	}
	
	public function save_region($region = array()) {
		$data = array(
			'name' => $region['name'],
			'id_country' => $region['id_country'],
                        'description' => $region['description'],
                        'image_name' => $region['image_name'],
			'image_title' => $region['image_title'],
			'seo_keywords' => $region['seo_keywords'],
			'seo_title' => $region['seo_title'],
			'seo_description' => $region['seo_description'],                    
			'enabled' => $region['enabled']
		);
		
		if($region['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $region['id']);
			$this->db->update('regions', $data);
                        
			return $region['id'];                        
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('regions', $data);
                        
                        return $this->db->insert_id();
		}
		return;
	}
        
	public function save_image($id_region, $image_name, $thumb_image_name) {
		$this->delete_image_region($id_region);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id', $id_region);
		$this->db->update('regions', $data);
	}
	
	public function delete_region($id_region) {
                $this->delete_image_region($id_region);
		$this->db->delete('regions', array('id' => $id_region));
	}

        public function delete_image_region($id_region) {
		$query = $this->db->get_where('regions', array('id' => $id_region));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/regions/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/regions/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/regions/original/".$row['image_original_file']);
		}
		
		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id', $id_region);
		$this->db->update('regions', $data);
	} 
        
	public function count_regions() {
		return $this->db->count_all('regions');
	}
	
	public function get_all_regions() {
		$this->db->select('a.*');
		$this->db->from('regions AS a');
		$this->db->order_by("a.name", "asc");
		$query = $this->db->get();
		
		return $query->result_array();
	}
}