<?php

class Languages extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		//check_login($this->session);
		
		$this->load->model('languages_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Limbi';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/languages");
		$pagination['total_rows'] = $this->languages_model->count_languages();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['languages'] = $this->languages_model->get_languages(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('languages/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o limbă';
		$data['item'] = $this->languages_model->init_language();
		
		$array_extensions = array("gif", "png", "jpg", "jpeg");
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['short'] = $this->input->post('short');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['show_on_site'] = $this->input->post('show_on_site');
			
			$this->form_validation->set_rules('name', 'Denumire', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->languages_model->save_language($data['item']);
				
				/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->languages_model->delete_image_language($data['item']['id']);
				}
				
				/* save image */
				if(isset($_FILES['image']['tmp_name'])) {
					$array = explode(".", $_FILES['image']['name']);
					$extension = strtolower(end($array));
					if(in_array($extension, $array_extensions)) {
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/languages/".$_FILES['image']['name']);
						$this->languages_model->save_image($data['item']['id'], $_FILES['image']['name']);
					}
				}
				/* end save image */
				
				redirect(base_url(array("admin.php", "languages")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre limbă';
			$data['item'] = $this->languages_model->get_languages($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('languages/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_country');
		if($id > 0) {
			$this->countries_model->delete_country($id);
		}
	}
}