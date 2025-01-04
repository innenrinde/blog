<?php

/**
 * Created by PhpStorm.
 * User: adrian.vlad
 * Date: 4/27/2017
 * Time: 5:33 PM
 */

include_once __DIR__.'/Handler.php';

class PageChain extends Handler
{
    /**
     * @param RequestChain $request
     * @return boolean
     */
    public function handleRequest(RequestChain $request)
    {
        $obj = $this->model->get_by_url($request->getUrl());
        if($obj) {
            $request->getReceiver()->viewp($obj);
        }
        else {
            $request->getReceiver()->home();
        }
    }

}