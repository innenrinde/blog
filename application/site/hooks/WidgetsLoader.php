<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 8:42 PM
 */
class WidgetsLoader
{
    /**
     * @var mixed
     */
    protected $ci;

    /**
     * @var array
     */
    protected $widgets = ['author', 'social', 'gallery', 'searchform'];

    /**
     * Initialize widgets
     */
    function initialize()
    {
        $this->ci =& get_instance();

        foreach($this->widgets as $widget) {
            $this->loadWidget($widget);
        }
    }

    /**
     * @param $name
     */
    protected function loadWidget($name)
    {
        $this->ci->load->library("widgets/{$name}/{$name}", []);
        $this->ci->widgets->attach($this->ci->{$name});
    }
}