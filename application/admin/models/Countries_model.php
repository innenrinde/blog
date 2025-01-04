<?php
class Countries_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_country() {
		return array(   "id"=>0,
                                "name"=>"",
                                "code"=>"",
                                "description"=>"",
                                "image_file"=>"",
                                "image_name"=>"",
                                "image_title"=>"",
                                "seo_keywords" => "",
                                "seo_title" => "",
                                "seo_description" => "",
                                "enabled"=>"1");
	}
	
	public function get_countries($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, COUNT(b.id_country) AS nr_regions');
			$this->db->from('countries AS a');
			$this->db->join('regions AS b', 'b.id_country=a.id', 'left');
			$this->db->order_by("a.name", "asc");
			$this->db->group_by("a.id");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('countries', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_country($country = array()) {
		$data = array(
			'name' => $country['name'],
			'code' => $country['code'],
                        'description' => $country['description'],
                        'image_name' => $country['image_name'],
			'image_title' => $country['image_title'],
			'seo_keywords' => $country['seo_keywords'],
			'seo_title' => $country['seo_title'],
			'seo_description' => $country['seo_description'],
			'enabled' => $country['enabled']
		);
		
		if($country['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $country['id']);
			$this->db->update('countries', $data);

			return $country['id'];                        
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('countries', $data);
                        
                        return $this->db->insert_id();
		}
		return;
	}

	public function save_image($id_country, $image_name, $thumb_image_name) {
		$this->delete_image_country($id_country);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id', $id_country);
		$this->db->update('countries', $data);
	}
        
	public function delete_country($id_country) {
                $this->delete_image_country($id_country);
		$this->db->delete('countries', array('id' => $id_country));
	}
	
    	public function delete_image_country($id_country) {
		$query = $this->db->get_where('countries', array('id' => $id_country));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/countries/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/countries/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/countries/original/".$row['image_original_file']);
		}
		
		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id', $id_country);
		$this->db->update('countries', $data);
	}    
        
	public function count_countries() {
		return $this->db->count_all('countries');
	}
}