<?php

namespace App\Tests\Controller\Category;

use App\Domain\DTO\AddUserDTO;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class NewCategoryCollectionActionFunctionnalTest
 */
class NewCategoryCollectionActionFunctionnalTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @throws \Exception
     */
    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallContext = 'main';

        $userDTO = new AddUserDTO(
            'test',
            'test',
            'test@test.fr'
        );
        $user = new User($userDTO);


        //$user = $this->createMock(User::class);
        $token = new PostAuthenticationGuardToken($user, 'main', ['ROLE_ADMIN']);

        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();


        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    /**
     * @throws \Exception
     */
    public function testNewCategoryPageStatusCode()
    {
        $this->logIn();
        $this->client->request('GET', '/newCategory');

        static::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}