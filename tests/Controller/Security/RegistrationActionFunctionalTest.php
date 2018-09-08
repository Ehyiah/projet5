<?php

namespace App\Tests\Controller\Security;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegistrationActionFunctionalTest
 * @group Functional
 */
final class RegistrationActionFunctionalTest extends WebTestCase
{
    private $client = null;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    public function testRegistrationStatusCode()
    {
        $this->client->request(
            'GET',
            '/register'
        );

        static::assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * @param string $username
     * @param string $firstPass
     * @param string $secondPass
     * @param string $email
     *
     * @dataProvider provideGoodData
     */
    public function testRegisterGoodProcess(string $username, string $firstPass, string $secondPass, string $email)
    {
        $crawler = $this->client->request(
            'GET',
            '/register'
        );

        $form = $crawler->selectButton('Créer nouvel utilisateur')->form();
        $form['user[username]']->setValue($username);
        $form['user[password][first]']->setValue($firstPass);
        $form['user[password][second]']->setValue($secondPass);
        $form['user[email]']->setValue($email);

        $this->client->submit($form);
        $this->client->followRedirect();

        static::assertContains(
            'Nouvel utilisateur enregistré',
            $this->client->getResponse()->getContent()
        );
    }

    /**
     * @param string $username
     * @param string $firstPass
     * @param string $secondPass
     * @param string $email
     *
     * @dataProvider provideBadData
     */
    public function testRegisterPasswordTooShort(string $username, string $firstPass, string $secondPass, string $email)
    {
        $crawler = $this->client->request(
            'GET',
            '/register'
        );

        $form = $crawler->selectButton('Créer nouvel utilisateur')->form();
        $form['user[username]']->setValue($username);
        $form['user[password][first]']->setValue($firstPass);
        $form['user[password][second]']->setValue($secondPass);
        $form['user[email]']->setValue($email);

        $this->client->submit($form);

        static::assertContains(
            'This value is too short',
            $this->client->getResponse()->getContent()
        );
    }


    /**
     * @return \Generator
     */
    public function provideGoodData()
    {
        yield array('FunctionalTest', 'testtest', 'testtest', 'Functional@test.fr');
        yield array('FunctionalTest0', 'testtest0', 'testtest0', 'Functional0@test.fr');
        yield array('FunctionalTest1', 'testtest1', 'testtest1', 'Functional1@test.fr');
    }

    /**
     * @return \Generator
     */
    public function provideBadData()
    {
        yield array('FunctionalShort', 'test', 'test', 'Short@email.fr');
        yield array('FunctionalShort0', 'test0', 'test0', 'Short0@email.fr');
        yield array('FunctionalShort1', 'test1', 'test1', 'Short1@email.fr');
    }
}
