<?php
class Countries extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		check_login($this->session);
		
		$this->load->model('countries_model');
		$this->load->model('counties_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Ţări';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/countries");
		$pagination['total_rows'] = $this->countries_model->count_countries();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['countries'] = $this->countries_model->get_countries(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('countries/index', $data);
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
		
		$array_extensions = array("gif", "ppng", "jpg", "jpeg");
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['name'] = $this->input->post('name');
			$data['item']['code'] = $this->input->post('code');

                        $data['item']['description'] = $this->input->post('description');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			                        
			$data['item']['enabled'] = $this->input->post('enabled');
			
			$this->form_validation->set_rules('name', 'Nume', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->countries_model->save_country($data['item']);
			/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->countries_model->delete_image_country($data['item']['id']);
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
							imagejpeg(img_scaleaza2($img, 70), "files/countries/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 250), "files/countries/mediu/".$thumb_name);
						}
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/countries/original/".$name.".".$extension);
						$this->countries_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */
                                
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