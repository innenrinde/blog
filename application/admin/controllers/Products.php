<?php

class Products extends MY_Controller {

    public $selected_categories = array();
    
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('products_model');
		$this->load->model('productscategories_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Produse';
		
		/* filters */
		$this->filters->set(array(
									'title' => array('type' => 'text', 'title' => 'Denumire produs', 'fields' => 'a.name')
								)
							);
		$data['filters'] = $this->filters->html();
		/* END filters */
		
		if($this->input->post('search')) {
			$params = $this->filters->get($this->input->post());
			redirect(base_url(array("admin.php", "products"))."?".$params);
		}
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/products");
		$pagination['total_rows'] = $this->products_model->count_products();
		$this->pagination->initialize($pagination);
		/* END pagination */
		$data['rows'] = $this->products_model->get_products(0, $pg, $pagination['per_page'], $this->filters->where(), $this->sort->get());
		
        $this->load->view('templates/header', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă un produs';
		$data['item'] = $this->products_model->init_product();
		
		$array_extensions = array("gif", "png", "jpg", "jpeg");
		$data['selected_categories'] = array();
		$data['array_news'] = array();
		
		if(sizeof($_POST)  > 0) {
			
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['promoted'] = $this->input->post('promoted');
			$data['item']['code'] = $this->input->post('code');
			$data['item']['price'] = $this->input->post('price');
			$data['item']['price_promo'] = $this->input->post('price_promo');
			$data['item']['tva'] = $this->input->post('tva');
			$data['item']['currency'] = $this->input->post('currency');
			$data['item']['properties'] = $this->input->post('properties');
			$data['item']['weight'] = $this->input->post('weight');
			$data['item']['weight_unit'] = $this->input->post('weight_unit');
			$data['item']['description'] = $this->input->post('description');
			$data['item']['terms_and_conditions'] = $this->input->post('terms_and_conditions');
			$data['item']['youtube'] = $this->input->post('youtube');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			$this->selected_categories = $this->input->post('category', array());
			$data['selected_properties'] = $this->input->post('property', array());
			$data['selected_labels'] = $this->input->post('label', array());
			
			$this->form_validation->set_rules('name', 'Denumire', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->products_model->save_product($data['item'], $data['selected_categories'], $data['selected_properties'], $data['selected_labels']);
				
				/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->products_model->delete_image_product($data['item']['id']);
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
							imagejpeg(img_scaleaza2($img, 200), "files/products/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 600), "files/products/mediu/".$thumb_name);
						}
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/products/original/".$name.".".$extension);
						$this->products_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */
				
				redirect(base_url(array("admin.php", "products")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre produs';
			$data['item'] = $this->products_model->get_products($id);
			$this->selected_categories = $this->products_model->get_product_categories($id);
			$data['selected_properties'] = $this->products_model->get_product_properties($id);
			$data['selected_labels'] = $this->products_model->get_product_labels($id);
		}
		
		$data['categories'] = $this->products_model->get_categories();
		$data['properties'] = $this->products_model->get_properties();
		$data['labels'] = $this->products_model->get_labels();
		
		$categories = $this->productscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->productscategories_model->build_tree($data['categories'], $categories);
		
		$html = '';
		$this->build_categories_tree($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;
		
        $this->load->view('templates/header', $data);
        $this->load->view('products/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_product');
		if($id > 0) {
			$this->products_model->delete_product($id);
		}
	}
	
	// build html categories table
	protected function build_categories_tree(&$html, $level, $categories) {
		if(sizeof($categories) > 0) {
			$current_category = current($categories);
			$id_parent = $current_category['id_parent'];
			foreach($categories as $i=>$v) {
				$v['level'] = $level;
				$v['selected_categories'] = $this->selected_categories;
				$html .= $this->load->view('products/category', $v, true);
				$level++;
				$this->build_categories_tree($html, $level, $v['childs']);
				$level--;
			}
		}
	}
}