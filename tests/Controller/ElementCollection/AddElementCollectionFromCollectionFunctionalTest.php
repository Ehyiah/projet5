<?php

namespace App\Tests\Controller\ElementCollection;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class AddElementCollectionFromCollectionFunctionalTest
 * @group Functional
 */
final class AddElementCollectionFromCollectionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
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

    public function testIfNotLogged()
    {
        $id = $this->collectionRepository->findOneBy([]);
        $this->client->request(
            'GET',
            '/addElement'.'/'.$id->getId()
        );
        $this->client->followRedirect();

        static::assertContains(
            'Connection',
            $this->client->getResponse()->getContent()
        );
    }

    public function testAddElementCollectionStatusCode()
    {
        $this->Login();
        $id = $this->collectionRepository->findOneBy([]);

        $this->client->request(
            'GET',
            '/addElement/'.$id->getId()
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAddElementCollectionGoodProcess()
    {
        $this->Login();

        $collection = $this->collectionRepository->findOneBy([]);
        $collectionID = $collection->getId()->__toString();

        $crawler = $this->client->request(
            'GET',
            '/addElement'.'/'.$collectionID,
            array(),
            array(),
            array(
                'idCollection' => $collectionID,
                'collectionName' => $collection->getCollectionName()
            )
        );

        $form = $crawler->selectButton('Ajouter')->form();
        $form['add_element_collection_from_collection[title]']->setValue('testAddElementFromCollection');

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertInstanceOf(
            RedirectResponse::class,
            $this->client->getResponse()
        );
    }
}
