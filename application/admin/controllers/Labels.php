<?php

class Labels extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('labels_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Etichete pentru produse';
		
		/* filters */
		$this->filters->set(array(
									'title' => array('type' => 'text', 'title' => 'Titlu', 'fields' => 'a.title')
								)
							);
		$data['filters'] = $this->filters->html();
		/* END filters */
		
		if($this->input->post('search')) {
			$params = $this->filters->get($this->input->post());
			redirect(base_url(array("admin.php", "labels"))."?".$params);
		}
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/labels");
		$pagination['total_rows'] = $this->labels_model->count_labels($this->filters->where());
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['labels'] = $this->labels_model->get_labels(0, $pg, $pagination['per_page'], $this->filters->where(), $this->sort->get());
		
        $this->load->view('templates/header', $data);
        $this->load->view('labels/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o etichetă';
		$data['item'] = $this->labels_model->init_label();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['color'] = $this->input->post('color');
			$data['item']['title'] = $this->input->post('title');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['order'] = $this->input->post('order');
			
			$this->form_validation->set_rules('title', 'Denumire', 'trim|required');
			//$this->form_validation->set_rules('url', 'Url', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->labels_model->save_label($data['item']);
				redirect(base_url(array("admin.php", "labels")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre etichetă';
			$data['item'] = $this->labels_model->get_labels($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('labels/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_label');
		if($id > 0) {
			$this->labels_model->delete_label($id);
		}
	}
	
	public function order() {
		$data['title'] = 'Setează ordinea etichetelor de produse';
		
		$data['labels'] = $this->labels_model->get_labels(NULL, 0, 0, NULL, array("a.order"=>"asc"));
		
		$this->load->view('templates/header', $data);
        $this->load->view('labels/order', $data);
        $this->load->view('templates/footer');
	}
	
	// salveaza ordinea articolelor
	public function save_order() {
	    if ($this->input->is_ajax_request()) {
			$labels = $this->input->post("labels");
			if(is_array($labels) && sizeof($labels) > 0) {
				$order = 0;
				foreach($labels as $i=>$v) {
					$this->labels_model->save_order($v, $order);
					$order ++;
				}
			}
		}
	}
}