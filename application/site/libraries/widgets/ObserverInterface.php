<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 7:55 PM
 */

interface ObserverInterface
{
    const VIEW_DIR  = 'widgets/';
    const CSS_DIR   = 'resources/site/widgets/';
    const JS_DIR    = 'resources/site/widgets/';

    /**
     * Update data from subject
     *
     * @param SubjectInterface $subject
     */
    function update(SubjectInterface $subject);

    /**
     * Run widged based on data notified
     */
    function run();

    /**
     * @return array
     */
    function getCss();

    /**
     * @return array
     */
    function getJs();
}