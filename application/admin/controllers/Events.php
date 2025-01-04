<?php
class Events extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		
		$this->load->model('events_model');
		$this->load->model('eventscategories_model');
		$this->load->model('countries_model');
		$this->load->model('regions_model');
		$this->load->model('localities_model');
		
		$this->output->enable_profiler(TRUE);
	}
	
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');
		
		$filters['title'] = $this->input->get('title');
		$filters['country'] = $this->input->get('country');
		$filters['organizers'] = $this->input->get('organizers');
		$filters['type'] = $this->input->get('type');
		$filters['featured'] = $this->input->get('featured');
		$filters['enabled'] = $this->input->get('enabled');
		
		$data['title'] = 'EVENIMENTE';
		
		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/events");
		$pagination['total_rows'] = $this->events_model->count_events($filters);
		$this->pagination->initialize($pagination);
		/* END pagination */
		
		$data['filters'] = $filters;
		$data['events'] = $this->events_model->get_events(0, $pg, $pagination['per_page'], $filters);
		$data['categories'] = $this->eventscategories_model->get_categories();
		$data['countries'] = $this->countries_model->get_countries();
		
        $this->load->view('templates/header', $data);
        $this->load->view('events/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add($id = NULL)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('functions');
		$this->load->library('form_validation');
		
		$id = (int)$id;
		
		$data['title'] = 'Adaugă un eveniment';
		$data['item'] = $this->events_model->init_event();
		
		$array_extensions = array("gif", "ppng", "jpg", "jpeg");
		
		if(sizeof($_POST)  > 0) {
			
			$data['item']['id'] = $id;
			$data['item']['title'] = $this->input->post('title');
			$data['item']['date'] = $this->input->post('date');
			$data['item']['id_country'] = $this->input->post('id_country');
			$data['item']['id_region'] = $this->input->post('id_region');
			$data['item']['id_locality'] = $this->input->post('id_locality');
			$data['item']['description'] = $this->input->post('description');
			$data['item']['organizers'] = $this->input->post('organizers');
			$data['item']['taxevent'] = $this->input->post('taxevent');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			
			$data['item']['seo_keywords'] = $this->input->post('seo_keywords');
			$data['item']['seo_title'] = $this->input->post('seo_title');
			$data['item']['seo_description'] = $this->input->post('seo_description');
			
			$data['item']['type'] = $this->input->post('type');
			$data['item']['featured'] = $this->input->post('featured');
			$data['item']['enabled'] = $this->input->post('enabled');
			$data['item']['subscribe_enabled'] = $this->input->post('subscribe_enabled');
			
			/* prepare date time */
			$array = explode(" ", $data['item']['date']);
			if(sizeof($array) == 2) {
				$array1 = explode(".", $array[0]);
				$array2 = explode(":", $array[1]);
				
				$data['item']['date'] = $array1[2]."-".$array1[1]."-".$array1[0]." ".$array[1].":00";
			}
			else {
				$data['item']['date'] = "";
			}
			
			$this->form_validation->set_rules('title', 'Titlu', 'trim|required');
			
			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->events_model->save_event($data['item']);
				
				/* delete image */
				if(isset($_POST['delete_image'])) {
					$this->events_model->delete_image_event($data['item']['id']);
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
							imagejpeg(img_scaleaza2($img, 70), "files/events/thumb/".$thumb_name);
							imagejpeg(img_scaleaza2($img, 250), "files/events/mediu/".$thumb_name);
						}
						
						move_uploaded_file($_FILES['image']['tmp_name'], "files/events/original/".$name.".".$extension);
						$this->events_model->save_image($data['item']['id'], $name.".".$extension, $thumb_name);
					}
				}
				/* end save image */
				
				redirect(base_url(array("admin.php", "events")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre eveniment';
			$data['item'] = $this->events_model->get_events($id);
			$data['item']['date'] = date("d.m.Y H:i", strtotime($data['item']['date']));
		}
		
		$data['categories'] = $this->eventscategories_model->get_categories();
		$data['countries'] = $this->countries_model->get_countries();
		$data['regions'] = $this->regions_model->get_all_regions();
		$data['localities'] = $this->localities_model->get_all_localities();
		
        $this->load->view('templates/header', $data);
        $this->load->view('events/add', $data);
        $this->load->view('templates/footer');
	}
	
	public function delete()
	{
		$id = $this->input->post('id_event');
		if($id > 0) {
			$this->events_model->delete_event($id);
		}
	}
}