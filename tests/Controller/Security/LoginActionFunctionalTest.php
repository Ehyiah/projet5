<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 04/09/2018
 * Time: 10:23
 */

namespace App\Tests\Controller\Security;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginActionFunctionalTest
 * @group Functional
 */
final class LoginActionFunctionalTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLoginStatusCode()
    {
        $this->client->request(
            'GET',
            '/login'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testLoginGoodProcess()
    {
        $crawler = $this->client->request(
            'GET',
            '/login'
        );

        $form = $crawler->selectButton('Se connecter')->form();
        $form['login[username]']->setValue('test');
        $form['login[password]']->setValue('test');

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'Accès espace membre',
            $this->client->getResponse()->getContent()
        );
    }
}
