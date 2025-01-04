<?php
class Counties_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_county() {
		return array(   "id_judet"=>0,
                                "judet"=>"",
                                "description"=>"",
                                "image_file"=>"",
                                "image_name"=>"",
                                "image_title"=>"",
                                "seo_keywords" => "",
                                "seo_title" => "",
                                "seo_description" => "");
	}
	
	public function get_counties($id = FALSE, $current_page = 0, $per_page = 0) {
		if (!$id) {
			$this->db->select('a.*, COUNT(b.id_localitate) AS nr_localitati');
			$this->db->from('judete AS a');
			$this->db->join('localitati AS b', 'b.id_judet=a.id_judet', 'left');
			$this->db->order_by("a.judet", "asc");
			$this->db->group_by("a.id_judet");
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('judete', array('id_judet' => $id));
		return $query->row_array();
	}
	
	public function save_county($county = array()) {
		$data = array(
			'judet' => $county['judet'],
                        'description' => $county['description'],
                        'image_name' => $county['image_name'],
			'image_title' => $county['image_title'],
			'seo_keywords' => $county['seo_keywords'],
			'seo_title' => $county['seo_title'],
			'seo_description' => $county['seo_description'],
		);
		
		if($county['id_judet'] > 0) {
			//$data['log_date2'] = date("Y-m-d H:i:s");
			//$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id_judet', $county['id_judet']);
			$this->db->update('judete', $data);
                        
			return $county['id_judet'];                        
		}
		else {
			//$data['log_date'] = date("Y-m-d H:i:s");
			//$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('judete', $data);
                        
                        return $this->db->insert_id();
		}
		return;
	}
        
        public function save_image($id_county, $image_name, $thumb_image_name) {
		$this->delete_image_county($id_county);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id_judet', $id_county);
		$this->db->update('judete', $data);
	}
	
	public function delete_county($id_county) {
                $this->delete_image_county($id_county);
		$this->db->delete('judete', array('id_judet' => $id_county));
	}
        
    	public function delete_image_county($id_county) {
		$query = $this->db->get_where('judete', array('id_judet' => $id_county));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
			unlink($this->config->item('server_path')."files/counties/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/counties/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/counties/original/".$row['image_original_file']);
		}
		
		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id_judet', $id_county);
		$this->db->update('judete', $data);
	}  
        
	public function count_counties() {
		return $this->db->count_all('judete');
	}
	
	public function get_counties_by_country($id_country) {
		$query = $this->db->get_where('judete', array('id_tara' => $id_country));
		return $query->result_array();
	}
}