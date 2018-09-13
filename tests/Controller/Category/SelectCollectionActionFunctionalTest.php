<?php

namespace App\Tests\Controller\Category;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class SelectCollectionActionFunctionalTest
 * @group Functional
 */
final class SelectCollectionActionFunctionalTest extends WebTestCase
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

    protected function setUp()
    {
        $this->client = static::createClient();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
        $this->categoryRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface');
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

    public function testSelectCollectionStatusCode()
    {
        $this->Login();
        $this->client->request(
            'GET',
            '/select'
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
            '/select'
        );
        $this->client->followRedirect();

        static::assertContains(
            'Connection',
            $this->client->getResponse()->getContent()
        );
    }

    public function testDeleteCategoryGoodProcess()
    {
        $this->Login();
        $crawler = $this->client->request(
            'GET',
            '/select'
        );

        static::assertEquals(
            1,
            $crawler->filter('h1:contains("bienvenue")')->count()
        );

        $category = $this->categoryRepository->findAll();

        $form = $crawler->selectButton('Oui')->form();
        dump($form);
        $form['select_collection[categoryCollection]']->setValue($category[1]->getId());

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'La catégorie a bien été supprimée',
            $this->client->getResponse()->getContent()
        );
    }
}
