<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 5/2/2017
 * Time: 11:27 AM
 */
class Cauthor extends MY_Controller
{
    /**
     * Home constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
    }

    /**
     * List of articles by an author
     *
     * @param string $slug
     * @param int $page
     */
    public function index($slug = '', $page = 1)
    {
        $this->load->model('users_model');
        $data['author'] = $this->users_model->get_by_slug($slug);

        $criteria = array('n.id_user'=>$data['author']['id']);

        $total = $this->news_model->count($criteria);
        $this->pagination2->setTotal($total)->setCurrentPage($page)->setUrl(build_author_link($data['author']['slug']));

        $data['pagination'] = $this->pagination2->html();
        $data['news'] = $this->news_model->get_news($this->pagination2, $criteria);

        $this->load->view('header', $this->getHeader());
        $this->load->view('author/index', $data);
        $this->load->view('footer', $this->getFooter());
    }

    /**
     * @param string $slug
     * @param int $page
     */
    public function about($slug = '', $page = 1)
    {
        $this->load->model('users_model');
        $data['author'] = $this->users_model->get_by_slug($slug);

        $criteria = array('n.id_user'=>$data['author']['id']);

        $total = $this->news_model->count($criteria);
        $this->pagination2->setTotal($total)->setCurrentPage($page)->setUrl(build_author_link($data['author']['slug']));

        $data['pagination'] = $this->pagination2->html();
        $data['news'] = $this->news_model->get_news($this->pagination2, $criteria);

        $this->load->view('header', $this->getHeader());
        $this->load->view('author/about', $data);
        $this->load->view('footer', $this->getFooter());
    }

    /**
     * @param string $slug
     * @param int $page
     */
    public function rss($slug = '', $page = 1)
    {
        $this->load->model('users_model');
        $data['author'] = $this->users_model->get_by_slug($slug);

        $criteria = array('n.id_user'=>$data['author']['id']);

        $total = $this->news_model->count($criteria);
        $this->pagination2->setTotal($total)->setCurrentPage($page)->setUrl(build_author_link($data['author']['slug']));

        $data['pagination'] = $this->pagination2->html();
        $data['news'] = $this->news_model->get_news($this->pagination2, $criteria);

        print '<?xml version="1.0" encoding="UTF-8"?>
                <rss>
                    <channel>
                        <title>'.$this->lang->line('meta_title').'</title>
                        <description>'.$this->lang->line('meta_description').'</description>
                        <link>'.$this->config->item('live_path').'</link>
                        <language>en</language>
                        <copyright>Copyright chattoir.com</copyright>';

        foreach($data['news'] as $news) {
            print '<item>
                    <title>'.$news['title'].'</title>
                </item>';

        }

        print '</channel>
                </rss>';

    }
}