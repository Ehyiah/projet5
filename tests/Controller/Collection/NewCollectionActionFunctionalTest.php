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
 * Class NewCollectionActionFunctionalTest
 * @group Functional
 */
final class NewCollectionActionFunctionalTest extends WebTestCase
{
    private $client = null;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository = null;

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
        $this->categoryRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface');
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
        $this->client->request(
            'GET',
            '/newCollection'
        );
        $this->client->followRedirect();

        static::assertContains(
            'Connection',
            $this->client->getResponse()->getContent()
        );
    }

    public function testNewCollectionStatusCode()
    {
        $this->Login();
        $this->client->request(
            'GET',
            '/newCollection'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testNewCollectionGoodProcess()
    {
        $this->Login();
        $crawler = $this->client->request(
            'GET',
            '/newCollection'
        );

        $category = $this->categoryRepository->findAll();

        static::assertContains(
            'Création de votre nouvelle Bibliothèque',
            $this->client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Ajouter une nouvelle collection')->form();

        $form['create_collection[name]']->setValue('NameTestFonctionnel');
        $form['create_collection[tag]']->setValue('TagTestFonctionnel');
        $form['create_collection[category]']->setValue($category[0]->getId());
        $form['create_collection[visibility]']->setValue(true);
        $form['create_collection[image]']->setValue(null);

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'La collection a bien été ajoutée',
            $this->client->getResponse()->getContent()
        );
    }
}
