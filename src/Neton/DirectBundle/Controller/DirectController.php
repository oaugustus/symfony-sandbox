<?php

namespace Neton\DirectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Neton\DirectBundle\Api\Api;

class DirectController extends Controller
{
    /**
     * Generate the ExtDirect API.
     * 
     * @return Response 
     */
    public function getApiAction()
    {
        // instantiate the api object
        $api = new Api($this->container);

        // return the json api description
        return new Response("Ext.Direct.addProvider(".$api.");");
    }
}
