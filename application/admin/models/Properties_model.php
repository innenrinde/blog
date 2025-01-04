<?php

class Properties_model extends CI_Model {

    protected $table_name = 'properties';
    
	public function __construct()
	{
		$this->load->database();
	}
	
	public function init_property() {
		return array("id"=>0, "name"=>"", "url"=>"", "enabled"=>"1", "order"=>"");
	}
	
	public function get_properties($id = FALSE, $current_page = 0, $per_page = 0, $where = array(), $order = array()) {
		if (!$id) {
			$this->db->select('a.*');
			$this->db->from($this->table_name.' AS a');
			$this->db->limit($per_page, $current_page);
			
			if(sizeof($where) > 0) {
			    foreach($where as $i=>$v) {
			    	if(is_array($v)) {
			    		foreach($v as $ii=>$vv) {
			    			$this->db->where($i.' LIKE ', '%'.$vv.'%');
			    		}
			    	}
			    	else {
			    		$this->db->where($i, $v);
			    	}
			    }
			}
			
			if(sizeof($order) > 0) {
			    foreach($order as $i=>$v) {
			        $this->db->order_by($i, $v);
			    }
			}
			else {
			    $this->db->order_by('a.order', 'asc');
			}
			
			$query = $this->db->get();
			return $query->result_array();
		}
		
		$query = $this->db->get_where($this->table_name, array('id' => $id));
		return $query->row_array();
	}
	
	public function save_property($property = array()) {
		$data = array(
			'name' => $property['name'],
			'url' => $property['url'],
			'enabled' => $property['enabled'],
			'order' => $property['order']
		);
		
		if($property['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $property['id']);
			$this->db->update($this->table_name, $data);
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert($this->table_name, $data);
		}
		return;
	}
	
	public function delete_property($id_property) {
		$this->db->delete($this->table_name, array('id' => $id_property));
	}
	
	public function count_properties($where = array()) {
	    if(sizeof($where) > 0) {
			foreach($where as $i=>$v) {
				if(is_array($v)) {
					foreach($v as $ii=>$vv) {
						$this->db->where($i.' LIKE ', '%'.$vv.'%');
					}
				}
				else {
					$this->db->where($i, $v);
				}
			}
		}
		
		$this->db->from($this->table_name.' AS a');
		$total = $this->db->count_all_results();
		return $total;
	}
	
	public function save_order($id_news, $order) {
		$data = array('order' => $order);
		$this->db->where('id', $id_news);
		$this->db->update($this->table_name, $data);
	}
}