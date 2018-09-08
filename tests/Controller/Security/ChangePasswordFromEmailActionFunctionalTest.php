<?php

namespace App\Tests\Controller\Security;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class ChangePasswordFromEmailActionFunctionalTest
 * @group Functional
 */
final class ChangePasswordFromEmailActionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
    }

    private function Login()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallContext = 'main';

        $getUser = $this->userRepository->findAll();
        $user = $getUser[0];

        $token = new PostAuthenticationGuardToken($user, 'main', ['ROLE_ADMIN']);

        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function testChangePasswordFromEmailStatusCode()
    {
        $this->Login();

        $this->client->request(
            'GET',
            '/recovery/1'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        static::assertContains(
            'Veuillez entrer votre nouveau mot de passe',
            $this->client->getResponse()->getContent()
        );
    }

    public function testChangePasswordFromEmailGoodProcess()
    {
        $this->Login();

        $crawler = $this->client->request(
            'GET',
            '/recovery/1'
        );

        $form = $crawler->selectButton('Confirmer')->form();
        $form['change_password_from_email[password]']->setValue('test0');

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'Le mot de passe a bien été modifié',
            $this->client->getResponse()->getContent()
        );
    }
}
