<?php

namespace App\Tests\Controller\ElementCollection;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class DeleteElementCollectionActionFunctionalTest
 * @group Functional
 */
final class DeleteElementCollectionActionFunctionalTest extends WebTestCase
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

    public function testDeleteElementGoodProcess()
    {
        $this->Login();

        $id = $this->elementRepository->findOneBy([]);

        $this->client->request(
            'GET',
            'delete/element/'.$id->getId(),
            array(),
            array(),
            array(
                'HTTP_REFERER' => '/home'
            )
        );

        $this->client->followRedirect();

        static::assertSame(
            RedirectResponse::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
