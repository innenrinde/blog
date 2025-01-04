<?php
class Types extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		check_login($this->session);
		
		$this->load->model('types_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Tipuri de unităţi de cazare';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/types");
		$pagination['total_rows'] = $this->types_model->count_types();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['types'] = $this->types_model->get_types(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('types/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o ţară';
		$data['item'] = $this->countries_model->init_country();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['code'] = $this->input->post('code');
			$data['item']['enabled'] = $this->input->post('enabled');
			
			$this->form_validation->set_rules('name', 'Nume', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->countries_model->save_country($data['item']);
				redirect(base_url(array("admin.php", "countries")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre ţară';
			$data['item'] = $this->countries_model->get_countries($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('countries/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_country');
		if($id > 0) {
			$this->countries_model->delete_country($id);
		}
	}
	
	public function counties() {
		$this->load->helper('functions');
		$id_country = $this->input->post('id_country');
		
		if($id_country > 0) {
			$counties = $this->counties_model->get_counties_by_country($id_country);
			print json_encode($counties);
		}
	}
}