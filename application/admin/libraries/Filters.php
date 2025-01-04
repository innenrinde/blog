<?php

class Filters {

	protected $filters;
	protected $views_path = 'libraries/filters/';

	public function __construct() {
	}

	public function set($filters) {
		$this->filters = $filters;
	}

	public function get($array = array()) {
		$params = array();
		foreach($this->filters as $i=>$v) {
			$key = 'f'.$i;
			$key1 = 'f'.$i.'start';
			$key2 = 'f'.$i.'end';
			if(isset($array[$key]) && strlen($array[$key]) > 0) {
			    $params[] = $key.'='.urlencode($array[$key]);
			}
			if(isset($array[$key1]) && strlen($array[$key1]) > 0) {
			    $params[] = $key1.'='.urlencode($array[$key1]);
			}
			if(isset($array[$key2]) && strlen($array[$key2]) > 0) {
			    $params[] = $key2.'='.urlencode($array[$key2]);
			}
		}
		return implode("&", $params);
	}

	public function where() {
		$where = array();
		foreach($this->filters as $i=>$v) {
			switch($v['type']) {
				case 'text':
						$value = $this->input_get('f'.$i);
						if(strlen($value) > 0) {
							$where[$v['fields']] = explode(" ", $value);
						}
						break;
				case 'select':
						$value = $this->input_get('f'.$i);
						if(!is_null($value)) {
							$where[$v['fields']] = $value;
						}
						break;
				case 'date':
						$value = $this->input_get('f'.$i.'start');
						if(!is_null($value)) {

							$where[$v['fields'].' >='] = $this->date_format($value);
						}
						$value = $this->input_get('f'.$i.'end');
						if(!is_null($value)) {
							$where[$v['fields'].' <='] = $this->date_format($value);
						}
						break;
			}
		}
		return $where;
	}

	public function html() {
		$CI =& get_instance();

		$html_elements = array();
		foreach($this->filters as $i=>$v) {
			switch($v['type']) {
				case 'text':
						$value = $this->input_get('f'.$i);
						$data = array(
										'name' => 'f'.$i,
										'value' => $value,
										'placeholder' => $v['title']
									);
						$html_elements[] = $CI->load->view($this->views_path.'input', $data, true);
						break;

				case 'select':
						$value = $this->input_get('f'.$i);
						$values = $v['values'];
						$data = array(
										'name' => 'f'.$i,
										'title' => $v['title'],
										'value' => $value,
										'values' => $values
									);
						$html_elements[] = $CI->load->view($this->views_path.'enum', $data, true);
						break;

				case 'date':
						$value1 = $this->input_get('f'.$i.'start');
						$value2 = $this->input_get('f'.$i.'end');
						$data = array(
										'name' => $i,
										'value1' => $value1,
										'value2' => $value2,
									);
						$html_elements[] = $CI->load->view($this->views_path.'date', $data, true);
						break;
			}
		}
		$html_elements[] = $CI->load->view($this->views_path.'submit', array(), true);

		$data = array('elements' => $html_elements);
		$html = $CI->load->view($this->views_path.'form', $data, true);

		return $html;
	}

	protected function input_get($key) {
		return isset($_GET[$key]) ? $_GET[$key] : NULL;
	}

	protected function date_format($value) {
	    $array = explode('.', current(explode(' ', $value)));
	    return $array[2].'-'.$array[1].'-'.$array[0];
	}
}

?>