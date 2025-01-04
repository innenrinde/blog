<?php
class EventsCategories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		//check_login($this->session);
		
		$this->load->model('eventscategories_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Categorii de evenimente';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/eventscategories");
		$pagination['total_rows'] = $this->eventscategories_model->count_categories();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['categories'] = $this->eventscategories_model->get_categories(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('eventscategories/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o categorie';
		$data['item'] = $this->eventscategories_model->init_category();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			
			$this->form_validation->set_rules('title', 'Denumire', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->eventscategories_model->save_category($data['item']);
				redirect(base_url(array("admin.php", "eventscategories")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre o categorie';
			$data['item'] = $this->eventscategories_model->get_categories($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('eventscategories/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_category');
		if($id > 0) {
			$this->eventscategories_model->delete_category($id);
		}
	}
}