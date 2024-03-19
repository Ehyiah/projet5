<?php

namespace App\Tests\Controller\Category;


use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class NewCategoryCollectionActionFunctionalTest
 * @group Functional
 */
final class NewCategoryCollectionActionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository = null;

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Repository\UserRepository');
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

    public function testNewCategoryPageStatusCode()
    {
        $this->logIn();
        $this->client->request(
            'GET',
            '/newCategory'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testIfNotLogged()
    {
        $this->client->request(
            'GET',
            '/newCategory'
        );
        $this->client->followRedirect();

        static::assertContains(
            'Connection',
            $this->client->getResponse()->getContent()
        );
    }

    /**
     * @param string $category
     *
     * @dataProvider dataProvider
     */
    public function testNewCategoryCollectionGoodProcess(string $category)
    {
        $this->logIn();
        $crawler = $this->client->request(
            'GET',
            '/newCategory'
        );

        static::assertContains(
            'Création de Catégories',
            $this->client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Créer une nouvelle Catégorie')->form();
        $form['category[category_collection]']->setValue($category);

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'Nouvelle catégorie créée',
            $this->client->getResponse()->getContent()
        );
    }

    /**
     * @return \Generator
     */
    public function dataProvider()
    {
        yield array('test');
        yield array('test0');
        yield array('test1');
    }
}
