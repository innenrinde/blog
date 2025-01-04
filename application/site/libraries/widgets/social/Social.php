<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 10:09 AM
 */

include_once __DIR__.'/../BaseWidgets.php';

class Social extends BaseWidgets
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

        print $this->ci->load->view($this->getViewDir().'view.php', $data, true, false);
    }

    /**
     * @return array
     */
    public function getCss()
    {
        // TODO: Implement getCss() method.
        return [];
    }

    /**
     * @return array
     */
    public function getJs()
    {
        // TODO: Implement getJs() method.
        return [];
    }
}