<?php

class News extends MY_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->model('news_model');
		$this->load->model('newscategories_model');
		$this->load->model('users_model');

		$this->load->library('uploader',
			[
				'model' => $this->news_model,
				'folder' => 'files/news',
				'chunk' => 'files/tmp'
			]
		);
	}

	/**
	 * @param int $pg
	 */
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');

		$data['title'] = $this->lang->line('page_title');

		/* filters */
		$this->filters->set(array(
									'title' => array('type' => 'text', 'title' => $this->lang->line('title'), 'fields' => 'a.title'),
									'date' => array('type' => 'date', 'title' => $this->lang->line('data'), 'fields' => 'a.date')
								)
							);
		$data['filters'] = $this->filters->html();
		/* END filters */

		if($this->input->post('search')) {
			$params = $this->filters->get($this->input->post());
			redirect(base_url(array("admin.php", "news"))."?".$params);
		}

		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/news");
		$pagination['total_rows'] = $this->news_model->count_news($this->filters->where());
		$this->cpagination->initialize($pagination);
		/* END pagination */

		$data['news'] = $this->news_model->get_news(0, $pg, $pagination['per_page'], $this->filters->where(), $this->sort->get());

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

	/**
	 * @param null $id
	 */
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');

		$id = (int)$id;

		$data['title'] = 'Adaugă un articol';
		$data['item'] = $this->news_model->init_news();
		$data['item']['date'] = date("d.m.Y H:i");

		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['subtitle'] = $this->input->post('subtitle');
			$data['item']['content_short'] = $this->input->post('content_short');
			$data['item']['content'] = $this->input->post('content');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['seo'] = $this->input->post('seo');
			$data['item']['date'] = $this->input->post('date');
			$data['item']['id_news_category'] = $this->input->post('id_parent');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			$data['item']['enabled'] = $this->input->post('enabled'); 		// daca e vizibil sau nu
			$data['item']['slider'] = $this->input->post('slider');			// arata in slider pe prima pagina
			$data['item']['home_page'] = $this->input->post('home_page');	// arata pe prima pagina sub slider
			$data['item']['promoted'] = $this->input->post('promoted');		// arata langa slider, 2 articole promovate
			$data['item']['id_user'] = $this->input->post('id_user');
			$data['item']['labels'] = $this->input->post('labels');

			/* prepare date time */
			$array = explode(" ", $data['item']['date']);
			$data['item']['date'] = "";
			if(sizeof($array) == 2) {
				$array1 = explode(".", $array[0]);
				$array2 = explode(":", $array[1]);

				$data['item']['date'] = $array1[2]."-".$array1[1]."-".$array1[0]." ".$array[1].":00";
			}

			$this->form_validation->set_rules('url', 'Elemente SEO / URL', 'trim|required');

			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->news_model->save_news($data['item']);

				/* save unsigned images to the product */
				$this->news_model->assign_images($data['item']['id']);

				/* save main image */
				$this->news_model->save_main_image($this->input->post('main_image'), $data['item']['id']);

				/* save interview image */
				$this->news_model->save_interview_image($this->input->post('interview'), $data['item']['id']);

				redirect(base_url(array("admin.php", "news")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre articol';
			$data['item'] = $this->news_model->get_news($id);
			$data['item']['date'] = date("d.m.Y H:i", strtotime($data['item']['date']));
		}

		$categories = $this->newscategories_model->get_categories_tree(array('a.type' => 'news'));
		$data['categories'] = array();
		if(isset($categories['childs'])) {
			$data['categories'] = $categories['childs'];
		}

		$data['users'] = $this->users_model->get_users();

		// news images
		$data['news_images'] = $this->news_model->get_images($id);

		$data['lang'] = $this->languages;

        $this->load->view('templates/header', $data);
        $this->load->view('news/add', $data);
        $this->load->view('templates/footer');
	}

	/**
	 * News order for home page
	 */
	public function order()
	{
		$data['title'] = 'Setează ordinea articolelor care apar în lista de pe prima pagină';

		$data['news'] = $this->news_model->get_news(NULL, 0, 0, array("a.home_page"=>1), array("a.order"=>"asc"));

		$this->load->view('templates/header', $data);
        $this->load->view('news/order', $data);
        $this->load->view('templates/footer');
	}

	/**
	 * Save news order for home page
	 */
	public function save_order()
	{
	    if ($this->input->is_ajax_request()) {
			$news = $this->input->post("news");
			if(is_array($news) && sizeof($news) > 0) {
				$order = 0;
				foreach($news as $i=>$v) {
					$this->news_model->save_order($v, $order);
					$order ++;
				}
			}
		}
	}

	/**
	 * Delete news
	 */
	public function delete()
	{
		$id = $this->input->post('id_news');
		if($id > 0) {
			$this->news_model->delete_news($id);
			print json_encode(['status' => 'ok']);
		}
	}

	/**
	 * Remove news from home page
	 */
	public function remove_home_page() {
	    if ($this->input->is_ajax_request()) {
			$id_news = $this->input->post("id_news");
			$this->news_model->remove_home_page($id_news);
		}
	}

	/**
	 * Upload an image
	 */
	public function upload()
	{
		print json_encode(
			$this->uploader->upload($this->input->post())
		);
	}

	/**
	 * Remove image form news
	 */
	public function delete_image()
	{
		$id = $this->input->post('id');
		if($id > 0) {
			$this->uploader->deleteImage($id);
		}
	}
}