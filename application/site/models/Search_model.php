<?php

class Search_model extends MY_Model
{
	/**
	 * @var News_model
	 */
	protected $news_model;

	/**
	 * Search_model constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * @param News_model $news_model
	 */
	public function setNewsModel($news_model)
	{
		$this->news_model = $news_model;
	}

	/**
	 * @param string $key
	 * @param Pagination2 $pagination
	 * @return mixed
	 */
	public function search($key = "", $pagination)
	{
		return $this->news_model->get_news($pagination, $this->criteria($key));
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function count($key = '')
	{
		return $this->news_model->count(
			$this->criteria($key)
		);
	}

	/**
	 * @param $key
	 * @return array
	 */
	private function criteria($key)
	{
		$array = explode('-', $key);
		$criteria = [];
		foreach($array as $v) {
			if(strlen($v) > 2) {
				$criteria[$v] = ['n.title', 'n.subtitle', 'n.labels'];
			}
		}
		return $criteria;
	}

}