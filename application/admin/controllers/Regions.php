<?php
class Regions extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		check_login($this->session);
		
		$this->load->model('regions_model');
		$this->load->model('countries_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Regiuni';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/regions");
		$pagination['total_rows'] = $this->regions_model->count_regions();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['regions'] = $this->regions_model->get_regions(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('regions/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă o regiune';
		$data['item'] = $this->regions_model->init_region();
		
		$array_extensions = array("gif", "ppng", "jpg", "jpeg");
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['id_country'] = $this->input->post('id_country');
			$data['item']['name'] = $this->input->post('name');

                        $data['item']['description'] = $this->input->post('description');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			            			
                        $data['item']['enabled'] = $this->input->post('enabled');
			
			$this->form_validation->set_rules('name', 'Nume', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->regions_model->save_region($data['item']);
                                /* delete image */
				if(isset($_POST['delete_image'])) {
					$this->regions_model->delete_image_region($data['item']['id']);
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
							imagejpeg(img_scaleaza2($img, 70), "files/regions/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 250), "files/regions/mediu/".$thumb_name);
						}
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/regions/original/".$name.".".$extension);
						$this->regions_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */                                
                                
				redirect(base_url(array("admin.php", "regions")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre regiune';
			$data['item'] = $this->regions_model->get_regions($id);
		}
		
		$data['countries'] = $this->countries_model->get_countries();
		
        $this->load->view('templates/header', $data);
        $this->load->view('regions/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_region');
		if($id > 0) {
			$this->regions_model->delete_region($id);
		}
	}
}