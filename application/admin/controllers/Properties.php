<?php

class Properties extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('properties_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Proprietăţi pentru produse';
		
		/* filters */
		$this->filters->set(array(
									'title' => array('type' => 'text', 'title' => 'Proprietate', 'fields' => 'a.name')
								)
							);
		$data['filters'] = $this->filters->html();
		/* END filters */
		
		if($this->input->post('search')) {
			$params = $this->filters->get($this->input->post());
			redirect(base_url(array("admin.php", "properties"))."?".$params);
		}
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/properties");
		$pagination['total_rows'] = $this->properties_model->count_properties($this->filters->where());
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['properties'] = $this->properties_model->get_properties(0, $pg, $pagination['per_page'], $this->filters->where(), $this->sort->get());
		
        $this->load->view('templates/header', $data);
        $this->load->view('properties/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o proprietate';
		$data['item'] = $this->properties_model->init_property();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['order'] = $this->input->post('order');
			
			$this->form_validation->set_rules('name', 'Denumire', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->properties_model->save_property($data['item']);
				redirect(base_url(array("admin.php", "properties")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre proprietate';
			$data['item'] = $this->properties_model->get_properties($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('properties/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_property');
		if($id > 0) {
			$this->properties_model->delete_property($id);
		}
	}
	
	public function order() {
		$data['title'] = 'Setează ordinea proprietăţilor de produse';
		
		$data['properties'] = $this->properties_model->get_properties(NULL, 0, 0, NULL, array("a.order"=>"asc"));
		
		$this->load->view('templates/header', $data);
        $this->load->view('properties/order', $data);
        $this->load->view('templates/footer');
	}
	
	// salveaza ordinea articolelor
	public function save_order() {
	    if ($this->input->is_ajax_request()) {
			$properties = $this->input->post("properties");
			if(is_array($properties) && sizeof($properties) > 0) {
				$order = 0;
				foreach($properties as $i=>$v) {
					$this->properties_model->save_order($v, $order);
					$order ++;
				}
			}
		}
	}
}