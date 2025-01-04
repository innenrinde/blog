<?php

class NewsCategories extends MY_Controller {

	var $id_parents = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');

		$this->load->model('newscategories_model');
	}

	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');

		$data['title'] = 'Categorii de articole şi grafice';

		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/newscategories");
		$pagination['total_rows'] = $this->newscategories_model->count_categories();
		$this->pagination->initialize($pagination);
		/* END pagination */

		$categories = $this->newscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);

		$html = '';
		$this->build_categories_tr($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;

        $this->load->view('templates/header', $data);
        $this->load->view('newscategories/index', $data);
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
		$data['item'] = $this->newscategories_model->init_category();

		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['id_parent'] = $this->input->post('id_parent');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['type'] = $this->input->post('type');
			$data['item']['order'] = $this->input->post('order');
			$data['item']['allow_comments'] = $this->input->post('allow_comments');

//			$this->form_validation->set_rules('title', 'Denumire', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required');

			$array_extensions = array("gif", "png", "jpg", "jpeg");

			if ($this->form_validation->run() === TRUE) {
				$this->newscategories_model->save_category($data['item']);

				/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->newscategories_model->delete_image_category($data['item']['id']);
				}

				/* save image */
				if(isset($_FILES['image']['tmp_name'])) {
					$array = explode(".", $_FILES['image']['name']);
					$extension = strtolower(end($array));
					if(in_array($extension, $array_extensions)) {

						$image_name = current(explode(".", $_FILES['image']['name']));
						$name = current(explode(".", $_FILES['image']['name']))."-".uniqid();

						$name = build_seo($name);

						$thumb_name = "";
						if(in_array($extension, $array_extensions)) {
							$img = getimagesize($_FILES['image']['tmp_name']);
							switch ($img[2]) {
								case 1:
									$img = imagecreatefromgif($_FILES['image']['tmp_name']);
									break;
								case 2:
									$img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
									break;
								case 3:
									$img = imagecreatefrompng($_FILES['image']['tmp_name']);
									break;
							}
							$thumb_name = $name.".jpg";
							imagejpeg(img_scaleaza2($img, 200), "files/categories/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 600), "files/categories/mediu/".$thumb_name);
						}

						move_uploaded_file($_FILES['image']['tmp_name'], "files/categories/original/".$name.".".$extension);
						$this->newscategories_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */

				redirect(base_url(array("admin.php", "newscategories")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre o categorie';
			$data['item'] = $this->newscategories_model->get_categories($id);
		}

		$data['categories'] = $this->newscategories_model->get_categories(false, 0, 0, array("a.id_parent"=>0, "a.id !="=>$id));

		$data['lang'] = $this->languages;

        $this->load->view('templates/header', $data);
        $this->load->view('newscategories/add', $data);
        $this->load->view('templates/footer');
	}

	public function delete()
	{
		$id = $this->input->post('id_category');
		if($id > 0) {
			$this->newscategories_model->delete_category($id);
		}
	}

	public function order() {

		$data['title'] = 'Setează ordinea categoriilor';

		$categories = $this->newscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);

		$html = '';
		$this->build_categories_html($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;

		$data['id_parents'] = $this->id_parents;

		$this->load->view('templates/header', $data);
        $this->load->view('newscategories/order', $data);
        $this->load->view('templates/footer');
	}

	// salveaza ordinea categoriilor
	public function save_order() {
		if ($this->input->is_ajax_request()) {
			$categories = $this->input->post("categories");
			if(is_array($categories) && sizeof($categories) > 0) {
				$order = 0;
				foreach($categories as $i=>$v) {
					$this->newscategories_model->save_order($v, $order);
					$order ++;
				}
			}
		}
	}

	// build tree categories
	protected function build_tree(&$root, $categories) {
		foreach($categories as $v) {
			if($v['id_parent'] == $root['id']) {
				$v['childs'] = array();
				$this->build_tree($v, $categories);
				$root['childs'][] = $v;
			}
		}
	}

	// build html categories
	protected function build_categories_html(&$html, $level, $categories) {
		if(sizeof($categories) > 0) {
			$current_category = current($categories);
			$id_parent = $current_category['id_parent'];
			$this->id_parents[] = $id_parent;
			$html .= "<ul id='list".$id_parent."'>";
			foreach($categories as $i=>$v) {
				$html .= "<li id='".$v['id']."'><span><a href='javascript:;'>".($i+1).". ".$v['title']."</a></span>";
				$level++;
				$this->build_categories_html($html, $level, $v['childs']);
				$level--;
				$html .= "</li>";
			}
			$html .= "</ul>";
		}
	}

	// build html categories table
	protected function build_categories_tr(&$html, $level, $categories) {
		if(sizeof($categories) > 0) {
			$current_category = current($categories);
			$id_parent = $current_category['id_parent'];
			foreach($categories as $i=>$v) {
				$v['level'] = $level;
				$html .= $this->load->view('newscategories/tr', $v, true);
				$level++;
				$this->build_categories_tr($html, $level, $v['childs']);
				$level--;
			}
		}
	}
}