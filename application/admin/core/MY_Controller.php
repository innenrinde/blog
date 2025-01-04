<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	/**
	 * @var array
	 */
	public $user = array();

	/**
	 * @var array
	 */
	public $languages = array();

	/**
	 * MY_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));

		$this->lang->load(array('global', 'menu', $this->router->fetch_class()));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		if (!$this->ion_auth->is_admin()) {
			$controller = $this->uri->segment(1);
			$method = $this->uri->segment(2);

			if($controller != "auth" && $method != "login") {
				redirect(base_url(array("admin.php", "auth", "login")));
			}
		}

		$this->user = $this->ion_auth->user()->row();

		$this->load->model('languages_model');
		$this->languages = $this->languages_model->get_languages(0, 0, 0, array('show_on_site' => 1));
	}
}