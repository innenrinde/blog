<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 4/27/2017
 * Time: 5:30 PM
 */

include_once __DIR__.'/RequestChain.php';

abstract class Handler
{
    /**
     * @var Handler
     */
    protected $successor;

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param $request
     * @return RequestChain
     */
    abstract function handleRequest(RequestChain $request);

    /**
     * @param $successor
     * @return Handler
     */
    public function setSuccessor(Handler $successor)
    {
        $this->successor = $successor;
        return $successor;
    }

    /**
     * @param RequestChain $request
     */
    protected function goToSuccessor(RequestChain $request)
    {
        if(null !== $this->successor) {
            $this->successor->handleRequest($request);
        }
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}