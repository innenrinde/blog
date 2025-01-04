<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * @var array
	 */
	public $languages = ['en', 'ro'];

	/**
	 * @var int|string
	 */
	public $id_language = 0;

	/**
	 * @var string
	 */
	public $messages = "";

	/**
	 * @var array
	 */
	protected $header = [];

	/**
	 * @var array
	 */
	protected $footer = [];

	/**
	 * MY_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->getMessages();
//		$this->output->enable_profiler(TRUE);
	}

	/**
	 * Get messages from flash data ...
	 */
	public function getMessages()
	{
		$this->messages = array();

		if(strlen($this->session->flashdata('message')) > 0) {
			$this->messages[] = $this->session->flashdata('message');
		}

		if(sizeof($this->messages) > 0) {
			$this->messages = "<div class='messages'>".implode("<br/>", $this->messages)."</div>";
		}
		else {
			$this->messages = "";
		}
	}

	/**
	 * @return array
	 */
	public function getHeader()
	{
		$this->setHeader($this->staticdata->getCategories(), 'categories');
		$this->setHeader($this->widgets->getStyles(), 'css');
		return $this->header;
	}

	/**
	 * @param $header
	 * @param null $key
	 */
	public function setHeader($header, $key = null)
	{
		if($key) {
			$this->header[$key] = $header;
		}
		else {
			$this->header[] = $header;
		}
	}

	/**
	 * @return array
	 */
	public function getFooter()
	{
		$this->setFooter($this->staticdata->getPages(), 'pages');
		$this->setFooter($this->widgets->getJs(), 'js');
		$this->setFooter($this->staticdata->getLanguages(), 'languages');
		$this->setFooter($this->staticdata->getLanguage(), 'current_language');
		$this->setFooter($this->staticdata->getLastNews(), 'last_news');
		return $this->footer;
	}

	/**
	 * @param $footer
	 * @param null $key
	 */
	public function setFooter($footer, $key = null)
	{
		if($key) {
			$this->footer[$key] = $footer;
		}
		else {
			$this->footer[] = $footer;
		}
	}


}