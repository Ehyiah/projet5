<?php

namespace App\Tests\Controller\ElementCollection;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class ShowCollectionDetailledActionFunctionalTest
 * @group Functional
 */
final class ShowCollectionDetailledActionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
        $this->elementRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface');
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

    public function testShowCollectionStatusCode()
    {
        $this->Login();

        $element = $this->elementRepository->findOneBy([]);
        $id = $element->getId();
        $name = $element->getCollectionName()->getCollectionName();

        $this->client->request(
            'GET',
            '/show'.'/'.$id.'/'.$name
        );

        $session = new Session(new MockFileSessionStorage());
        $session->set('id', $id);

        $this->client->followRedirect();

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testShowCollectionGoodProcess()
    {
        $this->Login();

        $element = $this->elementRepository->findOneBy([]);
        $id = $element->getId();
        $name = $element->getCollectionName()->getCollectionName();

        $this->client->request(
            'GET',
            '/show'.'/'.$id.'/'.$name
        );

        $session = new Session(new MockFileSessionStorage());
        $session->set('id', $id);

        $this->client->followRedirect();

        static::assertContains(
            'Ajout',
            $this->client->getResponse()->getContent()
        );
    }
}
