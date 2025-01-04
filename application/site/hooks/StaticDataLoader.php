<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 5/3/2017
 * Time: 3:01 PM
 */
class StaticDataLoader
{
    /** @var  object */
    protected $ci;

    /**
     * LanguageLoader constructor.
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Populate news categories from database
     */
    public function categories()
    {
        $this->ci->staticdata->selectCategories();
    }

    /**
     * populate pages from database
     */
    public function pages()
    {
        $this->ci->staticdata->selectPages();
    }
}