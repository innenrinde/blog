<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 4/21/2017
 * Time: 7:54 PM
 */

interface SubjectInterface
{
    /**
     * @param ObserverInterface $observer
     */
    function attach(ObserverInterface $observer);

    /**
     * @param ObserverInterface $observer
     */
    function detach(ObserverInterface $observer);

    /**
     * Notify an observer
     */
    function notify();

    /**
     * Get current data sended to widget
     *
     * @return array
     */
    function getData();
}