<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 10:09 AM
 */

include_once __DIR__.'/../BaseWidgets.php';

class Author extends BaseWidgets
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
     * to do
     */
    public function getJs()
    {
        // TODO: Implement getJs() method.
        return [];
    }
}