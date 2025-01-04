<?php

class ProductsCategories extends MY_Controller {

	var $id_parents = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('productscategories_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Categorii de produse';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/productscategories");
		$pagination['total_rows'] = $this->productscategories_model->count_categories();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$categories = $this->productscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);
		
		$html = '';
		$this->build_categories_tr($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;
		
        $this->load->view('templates/header', $data);
        $this->load->view('productscategories/index', $data);
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
		$data['item'] = $this->productscategories_model->init_category();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['id_parent'] = $this->input->post('id_parent');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['order'] = $this->input->post('order');
			
			$this->form_validation->set_rules('name', 'Denumire', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->productscategories_model->save_category($data['item']);
				redirect(base_url(array("admin.php", "productscategories")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre o categorie';
			$data['item'] = $this->productscategories_model->get_categories($id);
		}
		
		$data['categories'] = $this->productscategories_model->get_categories(false, 0, 0, array("a.id_parent"=>0, "a.id !="=>$id));
		
        $this->load->view('templates/header', $data);
        $this->load->view('productscategories/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_category');
		if($id > 0) {
			$this->productscategories_model->delete_category($id);
		}
	}
	
	public function order() {
		
		$data['title'] = 'Setează ordinea categoriilor';
		
		$categories = $this->productscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);
		
		$html = '';
		$this->build_categories_html($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;
		
		$data['id_parents'] = $this->id_parents;
		
		$this->load->view('templates/header', $data);
        $this->load->view('productscategories/order', $data);
        $this->load->view('templates/footer');
	}
	
	// salveaza ordinea categoriilor
	public function save_order() {
		if ($this->input->is_ajax_request()) {
			$categories = $this->input->post("categories");
			if(is_array($categories) && sizeof($categories) > 0) {
				$order = 0;
				foreach($categories as $i=>$v) {
					$this->productscategories_model->save_order($v, $order);
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
				$html .= "<li id='".$v['id']."'><span><a href='javascript:;'>".($i+1).". ".$v['name']."</a></span>";
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
				$html .= $this->load->view('productscategories/tr', $v, true);
				$level++;
				$this->build_categories_tr($html, $level, $v['childs']);
				$level--;
			}
		}
	}
}