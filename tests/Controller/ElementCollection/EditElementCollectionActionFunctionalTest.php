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
 * Class EditElementCollectionActionFunctionalTest
 * @group Functional
 */
final class EditElementCollectionActionFunctionalTest extends WebTestCase
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

    public function testEditElementStatusCode()
    {
        $this->Login();

        $id = $this->elementRepository->findOneBy([]);

        $this->client->request(
            'GET',
            '/edit/'.$id->getId()
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testEditElementGoodProcess()
    {
        $this->Login();


        $id = $this->elementRepository->findOneBy([]);
        $crawler = $this->client->request(
            'GET',
            '/edit/'.$id->getId()
        );

        $session = new Session(new MockFileSessionStorage());
        $session->set('idElement', $id->getId());

        $form = $crawler->selectButton('Modifier')->form();
        $form['edit_element_collection[region]']->setValue('RegionFunctionalTest');

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'modifié',
            $this->client->getResponse()->getContent()
        );
    }
}
