<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once __DIR__.'/../libraries/home/RequestChain.php';

class Home extends MY_Controller
{
	/**
	 * Current page for lists of items
	 *
	 * @var integer
	 */
	protected $page;

	/**
	 * Home constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('home/categoryChain');
		$this->load->library('home/newsChain');
		$this->load->library('home/pageChain');

		$this->categorychain->setModel($this->categories_model);
		$this->newschain->setModel($this->news_model);
		$this->pagechain->setModel($this->pages_model);

		$this->categorychain->setSuccessor($this->newschain)->setSuccessor($this->pagechain);
	}

	/**
	 * @param $url
	 * @param int $page
	 */
	public function index($url = null, $page = 1)
	{
		$this->page = $page;
		$this->categorychain->handleRequest(new RequestChain($url, $this));
	}

	/**
	 * Home page - all articles
	*/
	public function home()
	{
		$total = $this->news_model->count();
		$this->pagination2->setTotal($total)->setCurrentPage($this->page)->setUrl('page.html');

		$data = [
			'pagination' => $this->pagination2->html(),
			'news' => $this->news_model->get_news($this->pagination2, array(), array('n.date'=>"desc"), true)
		];

		$this->load->view('header', $this->getHeader());
		$this->load->view('home/index', $data);
		$this->load->view('footer', $this->getFooter());
	}

	/**
	 * List of articles for a specified category
	 *
	 * @param $obj array
	 */
	public function category($obj)
	{
		$data['category'] = $obj;

		$criteria = array('(n.id_news_category='.$data['category']['id'].')'=>NULL);
		$total = $this->news_model->count($criteria);
		$this->pagination2->setTotal($total)->setCurrentPage($this->page)->setUrl(build_news_category_link($data['category']));
		$data['pagination'] = $this->pagination2->html();

		$data['news'] = $this->news_model->get_news($this->pagination2, $criteria);

		$this->load->view('header', $this->getHeader());
		$this->load->view('category/index', $data);
		$this->load->view('footer', $this->getFooter());
	}

	/**
	 * View an article
	 *
	 * @param $obj array
	 */
	public function news($obj)
	{
		// retrieve data from db
		$data['news'] = $obj;
		$data['news_images'] = $this->news_model->get_news_images($data['news']['id']);

		// seo stuff
		$this->setHeader($data['news']['seo_title'] == '' ? $data['news']['title'] : $data['news']['seo_title'], 'meta_title');
		$this->setHeader($data['news']['seo_description'] == '' ? build_seo_meta($data['news']['content_short']) : $data['news']['seo_description'], 'meta_description');
		$this->setHeader($data['news']['seo_keywords'] == '' ? build_seo_keywords($data['news']['title']) : $data['news']['seo_keywords'], 'meta_keywords');

		$this->setHeader(
			[
				'url' => build_news_link($data['news']),
				'type' => 'website',
				'title' => $data['news']['title'],
				'description' => build_seo_meta($data['news']['content_short'].'. '.truncate($data['news']['content'], 300)),
				'image' => $this->config->item("live_path").'/files/news/mediu/'.$data['news']['thumb_image_name']
			],
			'og'
		);

		// set labels
		$data['labels'] = array();
		if(strlen(trim($data['news']['labels'])) > 0) {
			$data['labels'] = explode(",", trim($data['news']['labels']));
		}

		// get category for current news
		$data['category'] = $this->categories_model->get_by_id($data['news']['id_news_category']);

		// get other news from same category
		$this->pagination2->setTotal(10)->setCurrentPage(0);
		$data['category_same_news'] = $this->news_model->get_news($this->pagination2, array('n.id_news_category'=>$data['news']['id_news_category'], 'n.id<>'.$data['news']['id']=>NULL, 'n.content_short<>""'=>NULL), array(), false);

		// count visits
		$data_visit = array(
			'id_news' => $data['news']['id'],
			'log_ip' => $this->input->ip_address(),
			'when' => date("Y-m-d H:i:s")
		);
		$this->db->insert('news_visits', $data_visit);

		$this->load->view('header', $this->getHeader());
		$this->load->view('news/view', $data);
		$this->load->view('footer', $this->getFooter());
	}

	/**
	 * Display a static page
	 *
	 * @param $obj array
	 */
	public function viewp($obj)
	{
		$data['page'] = $obj;

		$this->load->view('header', $this->getHeader());
		$this->load->view('pages/view', $data);
		$this->load->view('footer', $this->getFooter());
	}
}