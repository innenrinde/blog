<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 4/25/2017
 * Time: 4:10 PM
 */
class Pagination2
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

    /**
     * @return string
     */
    public function html()
    {
        $CI =& get_instance();
        return $CI->load->view('pagination', [
            'current_page' => $this->current_page,
            'per_page' => $this->per_page,
            'page_count' => ceil($this->total / $this->per_page),
            'url' => $this->url
        ], true);
    }

    /**
     * @return int
     */
    public function offset()
    {
        return ($this->current_page - 1)*$this->per_page;
    }

    /**
     * @return int
     */
    public function limit()
    {
        return $this->per_page;
    }
}