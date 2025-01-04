<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 5/27/2017
 * Time: 8:52 PM
 */
class Api extends MY_Controller
{
    /**
     * Api constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return last $limit news
     *
     * @param $limit
     */
    public function last_news($limit = 0)
    {
        $this->pagination2->setTotal($limit)->setCurrentPage(0);
        $return = $this->news_model->get_news($this->pagination2, array(), array('n.date'=>"desc"), true);

        $this->output->set_content_type('application/json');
        print json_encode($return);
    }
}