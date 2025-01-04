<?php
class Counties extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		check_login($this->session);
		
		$this->load->model('counties_model');
		$this->load->model('localitati_model');
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$data['title'] = 'Judeţe';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/counties");
		$pagination['total_rows'] = $this->counties_model->count_counties();
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['counties'] = $this->counties_model->get_counties(0, $pg, $pagination['per_page']);
		
        $this->load->view('templates/header', $data);
        $this->load->view('counties/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă un judeţ';
		$data['item'] = $this->counties_model->init_county();
		
		$array_extensions = array("gif", "ppng", "jpg", "jpeg");
		
		if(sizeof($_POST)  > 0) {
			$data['item']['id_judet'] = $id;
			$data['item']['judet'] = $this->input->post('judet');
                        
                        $data['item']['description'] = $this->input->post('description');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			                                               
			
			$this->form_validation->set_rules('judet', 'Nume', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->counties_model->save_county($data['item']);
/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->counties_model->delete_image_county($data['item']['id']);
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
							imagejpeg(img_scaleaza2($img, 70), "files/counties/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 250), "files/counties/mediu/".$thumb_name);
						}
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/counties/original/".$name.".".$extension);
						$this->counties_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */
                                
				redirect(base_url(array("admin.php", "counties")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre judeţ';
			$data['item'] = $this->counties_model->get_counties($id);
		}
		
        $this->load->view('templates/header', $data);
        $this->load->view('counties/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_county');
		if($id > 0) {
			$this->counties_model->delete_county($id);
		}
	}
	
	public function localitati() {
		$this->load->helper('functions');
		$id_judet = $this->input->post('id_judet');
		
		if($id_judet > 0) {
			$localitati = $this->localitati_model->get_localitati_by_judet($id_judet);
			print json_encode($localitati);
		}
	}
}