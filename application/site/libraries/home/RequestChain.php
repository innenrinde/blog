<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 4/27/2017
 * Time: 5:39 PM
 */
class RequestChain
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var mixed
     */
    private $receiver;

    /**
     * RequestChain constructor.
     * @param $url
     * @param $receiver
     */
    public function __construct($url, $receiver)
    {
        $this->url = $url;
        $this->receiver = $receiver;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

}