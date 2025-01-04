<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 10:09 AM
 */

include_once __DIR__.'/../BaseWidgets.php';

class Gallery extends BaseWidgets
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

        $images = [];
        foreach($data as $image) {
            $images[] = [
                'file_name' => $image['image_name'],
                'size' => [
                    'original' => [
                        'w' => $image['original_size_width'],
                        'h' => $image['original_size_height']
                    ],
                    'mediu' => [
                        'w' => $image['mediu_size_width'],
                        'h' => $image['mediu_size_height']
                    ]
                ]
            ];
        }

        print $this->ci->load->view($this->getViewDir().'view.php', ['images' => $images], true);
    }

    /**
     * @return array
     */
    public function getCss()
    {
        return [
            $this->getCssDir().'dist/photoswipe.css?v=4.1.1-1.0.4',
            $this->getCssDir().'dist/default-skin/default-skin.css?v=4.1.1-1.0.4',
            $this->getCssDir().'style.css',
            $this->getCssDir().'responsive.css'
        ];
    }

    /**
     * @return array
     */
    public function getJs()
    {
        return [
            $this->getJsDir().'dist/photoswipe.min.js?v=4.1.1-1.0.4&',
            $this->getJsDir().'dist/photoswipe-ui-default.js?v=4.1.1-1.0.4',
            $this->getJsDir().'gallery.js'
        ];
    }
}