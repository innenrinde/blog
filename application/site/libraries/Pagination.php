<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 4/25/2017
 * Time: 4:10 PM
 */
class Pagination
{
    /**
     * @var integer
     */
    protected $per_page = SEARCH_RESULTS_PER_PAGE;

    /**
     * @var integer
     */
    protected $current_page;

    /**
     * @var integer
     */
    protected $total;

    /**
     * @var string
     */
    protected $url;

    /**
     * Pagination constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $current_page
     * @return $this
     */
    public function setCurrentPage($current_page)
    {
        $this->current_page = (int)$current_page < 1 ? 1 : (int)$current_page;
        return $this;
    }

    /**
     * @param $total
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


}