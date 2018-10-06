<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\RegistrationAction;
use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use App\UI\Responder\RegistrationResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class RegistrationActionTest
 * @group Action
 */
final class RegistrationActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var NewUserHandlerInterface
     */
    private $handler;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var RegistrationResponderInterface
     */
    private $responder;


    protected function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->responder = new RegistrationResponder(
            $this->createMock(Environment::class)
        );

        $this->handler = $this->createMock(NewUserHandlerInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
    }

    public function testConstruct()
    {
        $action = new RegistrationAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(RegistrationAction::class, $action);
    }


    public function testGoodFormHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new RegistrationAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/register',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'Nouvel utilisateur enregistré');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    public function testBadFormHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new RegistrationAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/register',
            'POST'
        );
        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
