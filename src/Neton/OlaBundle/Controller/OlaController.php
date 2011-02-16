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
    public function indexAction($name)
    {
        return $this->render('OlaBundle:Ola:index.html.twig', array('name' => $name));

        // render a PHP template instead
        // return $this->render('HelloBundle:Hello:index.html.php', array('name' => $name));
    }
}
