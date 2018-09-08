<?php

namespace App\Tests\Controller\Security;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RecoveryPasswordActionFunctionalTest
 * @group Functional
 */
final class RecoveryPasswordActionFunctionalTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testRecoveryPasswordStatusCode()
    {
        $this->client->request(
            'GET',
            '/recoverPassword'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testRecoverPasswordGoodProcess()
    {
        $crawler = $this->client->request(
            'GET',
            '/recoverPassword'
        );

        $form = $crawler->selectButton('Demander le changement de Mot de Passe')->form();
        $form['password_recover_input[name]']->setValue('test');

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'Un mail contenant un lien de réinitilisation',
            $this->client->getResponse()->getContent()
        );
    }
}
