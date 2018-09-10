<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\ChangeEmailAction;
use App\UI\Form\Handler\Security\Interfaces\ChangeEmailHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class ChangeEmailActionTest
 */
final class ChangeEmailActionTest extends KernelTestCase
{
    /**
     * @var ChangeEmailHandlerInterface
     */
    private $handler;

    /**
     * @var ChangeEmailResponderInterface
     */
    private $responder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    protected function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->handler = $this->createMock(ChangeEmailHandlerInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Security\Interfaces\ChangeEmailResponderInterface');
    }

    public function testConstruct()
    {
        $action = new ChangeEmailAction(
            $this->handler,
            $this->formFactory
        );

        static::assertInstanceOf(
            ChangeEmailAction::class,
            $action
        );
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new ChangeEmailAction(
            $this->handler,
            $this->formFactory
        );

        $request = Request::create(
            '/changeEmail',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'email a bien été modifié');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new ChangeEmailAction(
            $this->handler,
            $this->formFactory
        );

        $request = Request::create(
            '/changeEmail',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
