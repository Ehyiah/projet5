<?php

namespace App\Tests\Controller\Home;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultControllerFunctionalTest
 * @group Functional
 */
final class DefaultControllerFunctionalTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testDefaultControllerStatusCode()
    {
        $this->client->request(
            'GET',
            '/home'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testDefaultControlleGoodProcess()
    {
        $this->client->request(
            'GET',
            '/home'
        );

        static::assertContains(
            'Bienvenue',
            $this->client->getResponse()->getContent()
        );
    }
}
