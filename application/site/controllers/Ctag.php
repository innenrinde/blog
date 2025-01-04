<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 5/2/2017
 * Time: 11:33 AM
 */

class Ctag extends MY_Controller
{
    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * List articles for a specified tag
     *
     * @param string $tag
     * @param int $page
     */
    public function index($tag = '', $page = 1)
    {
        $tag = get_tags($tag);
        $data['tag'] = $tag;

        $criteria = array("n.labels LIKE '%".$tag."%'" => NULL);

        $total = $this->news_model->count($criteria);
        $this->pagination2->setTotal($total)->setCurrentPage($page)->setUrl(build_news_tag_link($tag));

        $data['pagination'] = $this->pagination2->html();
        $data['news'] = $this->news_model->get_news($this->pagination2, $criteria);

        $this->load->view('header', $this->getHeader());
        $this->load->view('tags/index', $data);
        $this->load->view('footer', $this->getFooter());
    }
}