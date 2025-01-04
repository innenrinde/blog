<?php
class Pages extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');


		$this->load->model('pages_model');
	}

	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');

		$data['title'] = 'Pagini statice';

		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/pages");
		$pagination['total_rows'] = $this->pages_model->count();
		$this->pagination->initialize($pagination);
		/* END pagination */

		$data['pages'] = $this->pages_model->get(0, $pg, $pagination['per_page']);

        $this->load->view('templates/header', $data);
        $this->load->view('pages/index', $data);
        $this->load->view('templates/footer');
    }

    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');

		$id = (int)$id;

		$data['title'] = 'Adaugă pagină';
		$data['item'] = $this->pages_model->init_page();

		if($this->input->post()) {

			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['content'] = $this->input->post('content');

			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			$data['item']['order'] = $this->input->post('order');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');

			$this->form_validation->set_rules('url', 'URL', 'trim|required');

			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->pages_model->save($data['item']);

				redirect(base_url(array("admin.php", "pages")));
			}
		} elseif ($id > 0) {
			$data['title'] = 'Editează informaţiile depre pagina';
			$data['item'] = $this->pages_model->get($id);
		}

		$data['lang'] = $this->languages;

        $this->load->view('templates/header', $data);
        $this->load->view('pages/add', $data);
        $this->load->view('templates/footer');
	}

	public function delete()
	{
		$id = $this->input->post('id_page');
		if($id > 0) {
			$this->pages_model->delete($id);
		}
	}
}