<?php

class UsersCategories extends MY_Controller {

	var $id_parents = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('userscategories_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Categorii de articole şi grafice';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/userscategories");
		$pagination['total_rows'] = $this->userscategories_model->count_categories();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$categories = $this->userscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);
		
		$html = '';
		$this->build_categories_tr($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;
		
        $this->load->view('templates/header', $data);
        $this->load->view('userscategories/index', $data);
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
		$data['item'] = $this->userscategories_model->init_category();
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['id_parent'] = $this->input->post('id_parent');
			$data['item']['url'] = $this->input->post('url');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['order'] = $this->input->post('order');
			
			$this->form_validation->set_rules('title', 'Denumire', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$this->userscategories_model->save_category($data['item']);
				redirect(base_url(array("admin.php", "userscategories")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre o categorie';
			$data['item'] = $this->userscategories_model->get_categories($id);
		}
		
		$data['categories'] = $this->userscategories_model->get_categories(false, 0, 0, array("a.id_parent"=>0, "a.id !="=>$id));
		
        $this->load->view('templates/header', $data);
        $this->load->view('userscategories/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_category');
		if($id > 0) {
			$this->userscategories_model->delete_category($id);
		}
	}
	
	public function order() {
		
		$data['title'] = 'Setează ordinea categoriilor';
		
		$categories = $this->userscategories_model->get_categories();
		$data['categories'] = array("id"=>0);
		$this->build_tree($data['categories'], $categories);
		
		$html = '';
		$this->build_categories_html($html, 0, $data['categories']['childs']);
		$data['categories'] = $html;
		
		$data['id_parents'] = $this->id_parents;
		
		$this->load->view('templates/header', $data);
        $this->load->view('userscategories/order', $data);
        $this->load->view('templates/footer');
	}
	
	// salveaza ordinea categoriilor
	public function save_order() {
		if ($this->input->is_ajax_request()) {
			$categories = $this->input->post("categories");
			if(is_array($categories) && sizeof($categories) > 0) {
				$order = 0;
				foreach($categories as $i=>$v) {
					$this->userscategories_model->save_order($v, $order);
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
				$html .= $this->load->view('userscategories/tr', $v, true);
				$level++;
				$this->build_categories_tr($html, $level, $v['childs']);
				$level--;
			}
		}
	}
}