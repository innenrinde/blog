<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 5/3/2017
 * Time: 2:57 PM
 */
class StaticData
{
    /**
     * @var object
     */
    protected $ci;

    /**
     * Current selected language
     *
     * @var array
     */
    protected $language;

    /**
     * List of available languages
     *
     * @var array
     */
    protected $languages = [];

    /**
     * @var array
     */
    protected $categories;

    /**
     * @var array
     */
    protected $pages;

    /**
     * StaticData constructor.
     */
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Retrieve news categories from database
     */
    public function selectCategories()
    {
        $this->categories = array();

        $categories = $this->ci->categories_model->get_categories();
        foreach($categories as $i=>$v) {
            if($v['id_parent'] == 0) {
                $v['childs'] = array();
                $this->categories[$v['id']] = $v;
            }
            else {
                $this->categories[$v['id_parent']]['childs'][] = $v;
            }
        }
    }

    /**
     * Retrieve static pages from database
     */
    public function selectPages()
    {
        $this->pages = $this->ci->pages_model->get_pages();
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * !!! This function must be transformed into a widget
     */
    public function getLastNews()
    {
        return $this->ci->news_model->get_news(null, array(), array('n.date'=>"desc"), false);
    }
}