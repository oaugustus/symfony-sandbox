<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('ola', new Route('/ola/{name}', array(
    '_controller' => 'OlaBundle:Ola:index',
)));

return $collection;
