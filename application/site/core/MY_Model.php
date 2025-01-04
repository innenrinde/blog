<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	/**
	 * MY_Model constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return int
	 */
	protected function currentLanguage()
	{
		return $this->staticdata->getLanguage()['id'];
	}
}