<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/26/2017
 * Time: 8:14 AM
 */

include_once __DIR__.'/../BaseWidgets.php';

class Searchform extends BaseWidgets
{
    /**
     * @param SubjectInterface $subject
     */
    public function update(SubjectInterface $subject)
    {
        $this->data = $subject->getData();
    }

    /**
     *
     */
    public function run()
    {
        $data = $this->data[$this->name];

        print $this->ci->load->view($this->getViewDir().'view.php', $data, true);
    }

    /**
     * @return array
     */
    public function getCss()
    {
        return [
            $this->getCssDir().'style.css',
            $this->getCssDir().'responsive.css',
        ];
    }

    /**
     * @return array
     */
    public function getJs()
    {
        return [
            $this->getJsDir().'search.js'
        ];
    }
}