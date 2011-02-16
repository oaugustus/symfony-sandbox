<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it, or make something more sophisticated.
if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

// alterado de acordo com as sugestões feitas por Lukas Smith Kahwe
// em: http://fossplanet.com/f6/[symfony-devs]-[symfony2]-skip-bootstrap-php-app_dev-php-102154/
//require_once __DIR__.'/../app/bootstrap.php'; <-- linha comentada evita o bootstrap
require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once __DIR__.'/../app/autoload.php';
require_once __DIR__.'/../app/AppKernel.php';

use Symfony\Component\HttpFoundation\Request;

$kernel = new AppKernel('dev', true);
$kernel->handle(Request::createFromGlobals())->send();
