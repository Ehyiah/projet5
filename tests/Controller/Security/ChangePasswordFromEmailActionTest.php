<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\ChangePasswordFromEmailAction;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordFromEmailHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangePasswordFromEmailResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ChangePasswordFromEmailActionTest
 * @group Action
 */
final class ChangePasswordFromEmailActionTest extends KernelTestCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ChangePasswordFromEmailHandlerInterface
     */
    private $handler;

    /**
     * @var ChangePasswordFromEmailResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();
        $this->userRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface');
        $this->security = $this->createMock(TokenStorageInterface::class);
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->handler = $this->createMock(ChangePasswordFromEmailHandlerInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Security\Interfaces\ChangePasswordFromEmailResponderInterface');
    }

    public function testConstruct()
    {
        $action = new ChangePasswordFromEmailAction(
            $this->userRepository,
            $this->security,
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(
            ChangePasswordFromEmailAction::class,
            $action
        );
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);
        $token = 'test';

        $action = new ChangePasswordFromEmailAction(
            $this->userRepository,
            $this->security,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/recoveryToken',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'Le mot de passe a bien été modifié');


        static::assertInstanceOf(
            RedirectResponse::class,
            $action ($request, $this->responder, $token)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);
        $token = 'test';

        $action = new ChangePasswordFromEmailAction(
            $this->userRepository,
            $this->security,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/recoveryToken',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action ($request, $this->responder, $token)
        );
    }
}
