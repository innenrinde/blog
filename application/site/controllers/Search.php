<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/25/2017
 * Time: 9:45 PM
 */
class Search extends MY_Controller
{
    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Perform search based on a specific keyword and for a specified category
     *
     * @param string $key
     * @param int $page
     * @param string $category
     */
    public function index($key = "", $page = 1, $category = '')
    {
        $this->load->model('search_model');
        $this->search_model->setNewsModel($this->news_model);

        if($this->input->post('key')) {
            $key = $this->input->post("key");
            if(strlen($key) > 0) {
                $key = str_replace(' ', '-', trim($key));
                redirect(build_search_link($key));
            }
        }

        $total = $this->search_model->count($key);
        $this->pagination2->setTotal($total)->setCurrentPage($page)->setUrl(build_search_link($key));

        $data['pagination'] = $this->pagination2->html();
        $data['news'] = $this->search_model->search($key, $this->pagination2);

        $key = str_replace('-', ' ', trim($key));
        $data['key'] = $key;
        $this->setHeader($key, 'key');

        $this->load->view('header', $this->getHeader());
        $this->load->view('home/search', $data);
        $this->load->view('footer', $this->getFooter());
    }

}