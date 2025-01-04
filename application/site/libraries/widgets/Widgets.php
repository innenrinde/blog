<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 10:45 AM
 */

include_once __DIR__.'/SubjectInterface.php';

class Widgets implements SubjectInterface
{
    /**
     * @var array
     */
    protected $observers = [];

    /**
     * @var array
     */
    protected $data;

    /**
     * @param ObserverInterface $observer
     */
    public function attach(ObserverInterface $observer)
    {
        $key = $this->widgetKey($observer);
        $this->observers[$key] = $observer;
    }

    /**
     * @param ObserverInterface $observer
     */
    public function detach(ObserverInterface $observer)
    {
        $key = $this->widgetKey($observer);
        unset($this->observers[$key]);
    }

    /**
     * Update observers values
     */
    public function notify()
    {
        foreach($this->observers as $observer) {
            /** @var $observer ObserverInterface */
            $observer->update($this);
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $observer
     * @return string
     */
    private function widgetKey($observer)
    {
        if(is_object($observer)) {
            $observer = get_class($observer);
        }
        return strtolower($observer);
    }

    /**
     * @param $observer
     * @param $data
     */
    public function run($observer, $data)
    {
        $key = $this->widgetKey($observer);
        $this->data[$key] = $data;
        $this->notify();

        /** @var $observer ObserverInterface */
        $observer = $this->observers[$key];
        $observer->run();
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        $css = [];
        foreach($this->observers as $observer) {
            /** @var $observer ObserverInterface */
            $css = array_merge($css, $observer->getCss());
        }
        return $css;
    }

    /**
     * @return array
     */
    public function getJs()
    {
        $js = [];
        foreach($this->observers as $observer) {
            /** @var $observer ObserverInterface */
            $js = array_merge($js, $observer->getJs());
        }
        return $js;
    }
}