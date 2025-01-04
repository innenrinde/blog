<?php
class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('functions');
		$this->load->helper('url');
		$this->load->model('users_model');

		$this->load->library('uploader',
			[
				'model' => $this->users_model,
				'folder' => 'files/users',
				'chunk' => 'files/tmp'
			]
		);
	}

	public function login()
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('session');

		$data = array();
		$data['title'] = "Autentificare administrator";

		$data['user'] = "";
		$data['password'] = "";

		if(sizeof($_POST)  > 0) {
			$data['user'] = $this->input->post('user');
			$data['password'] = $this->input->post('password');

			$user = $this->users_model->login($data['user'], $data['password']);

			if(sizeof($user) > 0) {
				$array = array(
						'name'  	=> $user['name'],
						'surname'  	=> $user['surname'],
						'username'  => $user['username'],
						'email'     => $user['email'],
						'logged_in' => TRUE
				   );
				$this->session->set_userdata($array);
				redirect(base_url(array("admin.php", "news")));
			}
		}

		$this->load->view('templates/header_simple', $data);
        $this->load->view('users/login', $data);
        $this->load->view('templates/footer');
	}

	public function logout()
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('session');

		$array = array(
					'name'  	=> "",
					'surname'  	=> "",
					'username'  => "",
					'email'     => "",
					'logged_in' => FALSE
               );
		$this->session->set_userdata($array);

		redirect(base_url(array("admin.php", "users", "login")));

	}

	/**
	 * @param int $pg
	 */
	public function index($pg = 0)
	{
		$this->load->helper('url');
		$this->load->helper('functions');
		$this->load->library('pagination');

		$data['title'] = 'Utilizatori';

		/* pagination */
		$pagination = $this->config->item("pagination");
		$pagination['base_url'] = base_url("admin.php/users");
		$pagination['total_rows'] = $this->users_model->count_users();
		$this->pagination->initialize($pagination);
		/* END pagination */

		$data['users'] = $this->users_model->get_users(0, $pg, $pagination['per_page']);
		$data['config_users'] = $this->config->item("users");

        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
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

		$data['title'] = 'Adaugă un utilizator';
		$data['item'] = $this->users_model->init_user();

		$type = $this->input->get('type');
		if($type == "agency") {
			$data['item']['type'] = "agency";
			$data['title'] = 'Adaugă o agenţie';
		}

		if(sizeof($_POST)  > 0) {
			$data['item']['id'] = $id;
			$data['item']['first_name'] = $this->input->post('first_name');
			$data['item']['last_name'] = $this->input->post('last_name');
			$data['item']['email'] = $this->input->post('email');
			$data['item']['username'] = $this->input->post('username');
			$data['item']['image_name'] = $this->input->post('image_name');
			$data['item']['image_title'] = $this->input->post('image_title');
			$data['item']['password'] = $this->input->post('password');
			$data['item']['slug'] = $this->input->post('slug');
			$data['item']['description'] = $this->input->post('description');

			$data['item']['active'] = $this->input->post('active');
			if($id == 1) { // super administrator
				$data['item']['active'] = 1;
			}

			$this->form_validation->set_rules('first_name', 'Nume', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');

			if ($this->form_validation->run() === TRUE) {
				$data['item']['id'] = $this->users_model->save_user($data['item']);

				/* save unsigned images to user */
				$this->users_model->assign_images($data['item']['id']);

				/* save main image */
				$this->users_model->save_main_image($this->input->post('main_image'), $data['item']['id']);

				redirect(base_url(array("admin.php", "users")));
			}
		}
		elseif($id > 0) {
			$data['title'] = 'Editează informaţiile depre utilizator';
			$data['item'] = $this->users_model->get_users($id);
		}

		$data['config_users'] = $this->config->item("users");

		// user images
		$data['user_images'] = $this->users_model->get_images($id);

		$data['lang'] = $this->languages;

        $this->load->view('templates/header', $data);
        $this->load->view('users/add', $data);
        $this->load->view('templates/footer');
	}

	/**
	 *
	 */
	public function delete()
	{
		$id = $this->input->post('id_user');
		if($id > 0) {
			$this->users_model->delete_user($id);
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
	 * Remove image form user
	 */
	public function delete_image()
	{
		$id = $this->input->post('id');
		if($id > 0) {
			$this->uploader->deleteImage($id);
		}
	}
}


