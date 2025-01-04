<?php

class Sort {
	
	protected $CI = NULL;
	protected $order_key = 'order';
	protected $direction_key = 'dir';
	protected $direction_allowed = array();
	
	public function __construct() {
		$this->CI =& get_instance();
		$this->direction_allowed = array('asc', 'desc');
	}
	
	public function by($key, $title) {
		$order_key = $this->CI->input->get($this->order_key);
		$dir = strtolower($this->CI->input->get($this->direction_key));
		
		if($dir == $this->direction_allowed[0]) {
			$dir = $this->direction_allowed[1];
			$icon = '<i class="fa fa-caret-down"></i>';
		}
		else {
			$dir = $this->direction_allowed[0];
			$icon = '<i class="fa fa-caret-up"></i>';
		}
		
		if($order_key != $key) {
			$icon = '';
		}
		
		$params = $this->buildGet(array($this->order_key => $key, $this->direction_key => $dir));
		
		return '<a href="?'.$params.'">'.$title.' '.$icon.'</a>';
	}
	
	public function get() {
		$key = $this->CI->input->get($this->order_key);
		$dir = strtolower($this->CI->input->get($this->direction_key));
		
		if(!in_array($dir, $this->direction_allowed)) {
			$dir = current($this->direction_allowed);
		}
		
		if(strlen($key) > 0) {
			return array($key => $dir);
		}
		
		return NULL;
	}
	
	protected function buildGet($extra = array()) {
		$get = $_GET;
		foreach($extra as $i => $v) {
			$get[$i] = $v;
		}
		$params = array();
		foreach($get as $i => $v) {
			$params[] = $i.'='.$v;
		}
		return implode('&', $params);
	}
}

?>