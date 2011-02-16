<?php

namespace Neton\OlaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OlaControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/ola/Otávio');

        $this->assertTrue($crawler->filter('html:contains("Olá Otávio")')->count() > 0);
    }
}
