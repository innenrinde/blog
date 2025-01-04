<?php

/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 10:44 AM
 */
class Labels implements SplObserver
{
    /**
     * @var array
     */
    protected $labels = [];

    /**
     * Labels constructor.
     */
    public function __construct()
    {
    }

    public function update(SplSubject $subject)
    {
        $this->labels = explode(',', $subject->getLabels());
    }
}