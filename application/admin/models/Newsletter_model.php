<?php

class Newsletter_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_newsletter() {
		return array("id"=>0, "name"=>"", "email" => "", "date_registered"=>"", "date_confirmed"=>"", "confirmed"=>0);
	}
	
	public function get_newsletter($id = FALSE, $current_page = 0, $per_page = 0, $where = array(), $order = array()) {
		if (!$id) {
			$this->db->select('a.*');
			$this->db->from('newsletter AS a');
			
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
			    $this->db->order_by('a.date_registered', 'desc');
			}
			
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			//print $this->db->last_query();
			return $query->result_array();
		}
		
		$query = $this->db->get_where('newsletter', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_newsletter($newsletter = array()) {
		$data = array(
			'email' => $newsletter['email'],
			'confirmed' => $newsletter['confirmed']
		);
		
		if($newsletter['id'] > 0) {
			$data['log_date2'] = date("Y-m-d H:i:s");
			$data['log_ip2'] = $this->input->ip_address();
			$this->db->where('id', $newsletter['id']);
			$this->db->update('newsletter', $data);
			
			return $newsletter['id'];
		}
		else {
			$data['log_date'] = date("Y-m-d H:i:s");
			$data['log_ip'] = $this->input->ip_address();
			$this->db->insert('newsletter', $data);
			
			return $this->db->insert_id();
		}
		return;
	}
	
	public function count_newsletter($where = array()) {
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
		
		$this->db->from('newsletter AS a');
		$total = $this->db->count_all_results();
		return $total;
	}
	
	public function delete_newsletter($id) {
		$this->db->delete('newsletter', array('id' => $id));
	}
}