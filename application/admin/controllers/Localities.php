<?php
class Localities extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		check_login($this->session);
		
		$this->load->model('regions_model');
		$this->load->model('counties_model');
		$this->load->model('localities_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Localităţi';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/localities");
		$pagination['total_rows'] = $this->localities_model->count_localities();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['localities'] = $this->localities_model->get_localities(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('localities/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o localitate';
		$data['item'] = $this->localities_model->init_locality();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id_localitate'] = $id;
			$data['item']['id_region'] = $this->input->post('id_region');
			$data['item']['id_judet'] = $this->input->post('id_judet');
			$data['item']['localitate'] = $this->input->post('localitate');
			
			$this->form_validation->set_rules('localitate', 'Nume', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->localities_model->save_locality($data['item']);
				redirect(base_url(array("admin.php", "localities")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre localitate';
			$data['item'] = $this->localities_model->get_localities($id);
		}
		
		$data['regions'] = $this->regions_model->get_regions();
		$data['judete'] = $this->counties_model->get_counties();
		
        $this->load->view('templates/header', $data);
        $this->load->view('localities/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_locality');
		if($id > 0) {
			$this->localities_model->delete_locality($id);
		}
	}
}