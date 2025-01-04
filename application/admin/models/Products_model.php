<?php
class Products_model extends CI_Model {

	public function __construct()
	{
			$this->load->database();
	}
	
	public function init_product() {
		return array("id"=>0,
						"name"=>"",
						"link"=>"",
						"price"=>"",
						"price_promo"=>"",
						"tva"=>"",
						"currency"=>"Lei",
						"enabled"=>"1",
						"properties"=>"",
						"weight"=>"",
						"weight_unit"=>"",
						"description"=>"",
						"terms_and_conditions"=>"",
						"promoted"=>0,
						"code"=>"",
						"youtube"=>"",
						"seo_keywords" => "",
						"seo_title" => "",
						"seo_description" => "",
						"url" => "",
						"image_name" => "",
						"image_title" => ""
					);
	}
	
	public function get_products($id = FALSE, $current_page = 0, $per_page = 0, $where = array(), $order = array()) {
		if (!$id) {
			$this->db->select('a.*, GROUP_CONCAT(DISTINCT c.name SEPARATOR "<br>") AS categories, GROUP_CONCAT(DISTINCT e.color SEPARATOR ",") AS labels, GROUP_CONCAT(DISTINCT e.title SEPARATOR ",") AS labels_title');
			$this->db->from('products AS a');
			$this->db->join('product_categories AS b', 'a.id=b.id_product', 'left');
			$this->db->join('products_categories AS c', 'c.id=b.id_category', 'left');
			$this->db->join('product_labels AS d', 'a.id=d.id_product', 'left');
			$this->db->join('labels AS e', 'e.id=d.id_label', 'left');
			$this->db->group_by('a.id');
			
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
			    $this->db->order_by('a.id', 'asc');
			}
			
			$this->db->limit($per_page, $current_page);
			$query = $this->db->get();
			
			return $query->result_array();
		}
		
		$query = $this->db->get_where('products', array('id' => $id));
		return $query->row_array();
	}
	
	public function save_product($product = array(), $categories = array(), $properties = array(), $labels = array()) {
		$data = array(
			'name' => $product['name'],
			'enabled' => $product['enabled'],
			'properties' => $product['properties'],
			'weight'=> $product['weight'],
			'weight_unit' => $product['weight_unit'],
			'description' => $product['description'],
			'terms_and_conditions' => $product['terms_and_conditions'],
			'promoted' => $product['promoted'],
			'code' => $product['code'],
			'youtube' => $product['youtube'],
			'price' => $product['price'],
			'price_promo' => $product['price_promo'],
			'tva'=> $product['tva'],
			'currency' => $product['currency'],
			'url' => $product['url'],
			'seo_keywords' => $product['seo_keywords'],
			'seo_title' => $product['seo_title'],
			'seo_description' => $product['seo_description'],
			'image_name' => $product['image_name'],
            'image_title' => $product['image_title']
		);
		
		if($product['id'] > 0) {
			$this->db->where('id', $product['id']);
			$this->db->update('products', $data);
			
			$this->save_categories($product['id'], $categories);
			$this->save_properties($product['id'], $properties);
			$this->save_labels($product['id'], $labels);
			
			return $product['id'];
		}
		else {
			$this->db->insert('products', $data);
			$product['id'] = $this->db->insert_id();
			
			$this->save_categories($product['id'], $categories);
			$this->save_properties($product['id'], $properties);
			$this->save_labels($product['id'], $labels);
			
			return $product['id'];
		}
		return;
	}
	
	public function save_image($id_product, $image_name, $thumb_image_name) {
		$this->delete_image_product($id_product);
		$data = array(
			'image_file' => $thumb_image_name,
			'image_original_file' => $image_name
		);
		$this->db->where('id', $id_product);
		$this->db->update('products', $data);
	}
	
	public function delete_product($id_product) {
		$this->delete_image_product($id_product);
		$this->delete_categories_product($id_product);
		$this->delete_properties_product($id_product);
		$this->delete_labels_product($id_product);
		$this->db->delete('products', array('id' => $id_product));
	}
	
	public function delete_image_product($id_product) {
		$query = $this->db->get_where('products', array('id' => $id_product));
		$row = $query->row_array();
		
		if(strlen($row['image_file']) > 0) {
		    unlink($this->config->item('server_path')."files/products/thumb/".$row['image_file']);
			unlink($this->config->item('server_path')."files/products/mediu/".$row['image_file']);
			unlink($this->config->item('server_path')."files/products/original/".$row['image_original_file']);
		}
		
		$data = array(
			'image_file' => "",
			'image_original_file' => ""
		);
		$this->db->where('id', $id_product);
		$this->db->update('products', $data);
	}
	
	public function count_products() {
		return $this->db->count_all('products');
	}
	
	public function get_categories() {
		return $this->db->from("products_categories")->get()->result_array();
	}
	
	public function get_properties() {
		return $this->db->from("properties")->order_by('order', 'asc')->get()->result_array();
	}
	
	public function get_labels() {
		return $this->db->from("labels")->order_by('order', 'asc')->get()->result_array();
	}
	
	public function get_product_categories($id) {
		$res = $this->db->where("id_product", $id)->from("product_categories")->get()->result_array();
		$array = array();
		foreach($res as $i=>$v) {
			$array[] = $v['id_category'];
		}
		return $array;
	}
	
	public function get_product_properties($id) {
		$res = $this->db->where("id_product", $id)->from("product_properties")->get()->result_array();
		$array = array();
		foreach($res as $i=>$v) {
			$array[] = $v['id_property'];
		}
		return $array;
	}
	
	public function get_product_labels($id) {
		$res = $this->db->where("id_product", $id)->from("product_labels")->get()->result_array();
		$array = array();
		foreach($res as $i=>$v) {
			$array[] = $v['id_label'];
		}
		return $array;
	}
	
	public function save_categories($id, $categories) {
		$this->db->where("id_product", $id)->delete("product_categories");
		
		if(is_array($categories)) {
			$data = array();
			foreach($categories as $v) {
				$data[] = array(
				   'id_product' => $id,
				   'id_category' => $v
				);
			}
			if(sizeof($data) > 0) {
				$this->db->insert_batch('product_categories', $data);
			}
		}
	}
	
	public function save_properties($id, $properties) {
		$this->db->where("id_product", $id)->delete("product_properties");
		
		if(is_array($properties)) {
			$data = array();
			foreach($properties as $v) {
				$data[] = array(
				   'id_product' => $id,
				   'id_property' => $v
				);
			}
			if(sizeof($data) > 0) {
				$this->db->insert_batch('product_properties', $data);
			}
		}
	}
	
	public function save_labels($id, $labels) {
		$this->db->where("id_product", $id)->delete("product_labels");
		
		if(is_array($labels)) {
			$data = array();
			foreach($labels as $v) {
				$data[] = array(
				   'id_product' => $id,
				   'id_label' => $v
				);
			}
			if(sizeof($data) > 0) {
				$this->db->insert_batch('product_labels', $data);
			}
		}
	}
	
	protected function delete_categories_product($id_products) {
	    $this->db->delete('product_categories', array('id_product' => $id_product));
	}
	
	protected function delete_properties_product($id_products) {
	    $this->db->delete('product_properties', array('id_product' => $id_product));
	}
	
	protected function delete_labels_product($id_products) {
	    $this->db->delete('product_labels', array('id_product' => $id_product));
	}
}