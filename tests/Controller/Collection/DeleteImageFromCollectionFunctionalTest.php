<?php

namespace App\Tests\Controller\Collection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class DeleteImageFromCollectionFunctionalTest
 * @group Functional
 */
final class DeleteImageFromCollectionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository = null;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
        $this->imageRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface');
        $this->collectionRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface');
    }

    private function logIn()
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

    public function testDeleteImageGoodProcess()
    {
        $this->logIn();

        $id = $this->imageRepository->findOneBy([]);
        $this->client->request(
            'GET',
            '/deleteImageFromCollection/'.$id->getId()
        );

        //$this->client->followRedirect();



        static::assertSame(
            RedirectResponse::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
