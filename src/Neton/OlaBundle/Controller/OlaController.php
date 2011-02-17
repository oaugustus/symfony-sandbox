<?php

namespace Neton\OlaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OlaController extends Controller
{
    /**
     * @remote
     * @param <type> $name
     * @return <type> 
     */
    public function indexAction($params)
    {
        return $params;

        // render a PHP template instead
        // return $this->render('HelloBundle:Hello:index.html.php', array('name' => $name));
    }

    /**
     * @remote
     * @form
     * @param array $params
     */
    public function testAction($params, $files)
    {
        return true;
    }
}
