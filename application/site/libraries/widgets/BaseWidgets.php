<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 8:06 PM
 */

include_once __DIR__.'/ObserverInterface.php';

abstract class BaseWidgets implements ObserverInterface
{
    /**
     * Widget name
     *
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $ci;

    /**
     * @var array
     */
    protected $data;

    /**
     * BaseWidgets constructor.
     */
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->name = strtolower(get_class($this));
    }

    /**
     * @return string
     */
    protected function getViewDir()
    {
        return self::VIEW_DIR.$this->name.'/';
    }

    /**
     * @return string
     */
    protected function getCssDir()
    {
        return self::CSS_DIR.$this->name.'/';
    }

    /**
     * @return string
     */
    protected function getJsDir()
    {
        return self::JS_DIR.$this->name.'/';
    }
}