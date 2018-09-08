<?php

namespace App\Tests\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class DeleteCollectionActionFunctionalTest
 * @group Functional
 */
final class DeleteCollectionActionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository = null;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
        $this->categoryRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface');
        $this->collectionRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface');
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


    public function testDeleteCollectionGoodProcess()
    {
        $this->Login();
        $collection = $this->collectionRepository->findOneBy([]);
        $collectionID = $collection->getId();

        $this->client->request(
            'GET',
            '/delete/collection/'.$collectionID,
            array(),
            array(),
            array(
                'HTTP_REFERER' => '/home'
            )
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
