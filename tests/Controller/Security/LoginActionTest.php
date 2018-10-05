<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\LoginAction;
use App\UI\Form\Handler\Interfaces\LoginHandlerInterface;
use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginActionTest
 * @group Action
 */
final class LoginActionTest extends KernelTestCase
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var LoginHandlerInterface
     */
    private $handler;

    /**
     * @var LoginResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();
        $this->encoder = $this->createMock(EncoderFactoryInterface::class);
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->authenticationUtils = $this->createMock(AuthenticationUtils::class);
        $this->handler = $this->createMock(LoginHandlerInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Interfaces\LoginResponderInterface');
    }

    public function testConstruct()
    {
        $action = new LoginAction(
            $this->encoder,
            $this->formFactory,
            $this->authenticationUtils,
            $this->handler
        );

        static::assertInstanceOf(
            LoginAction::class,
            $action
        );
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new LoginAction(
            $this->encoder,
            $this->formFactory,
            $this->authenticationUtils,
            $this->handler
        );

        $request = Request::create(
            '/login',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new LoginAction(
            $this->encoder,
            $this->formFactory,
            $this->authenticationUtils,
            $this->handler
        );

        $request = Request::create(
            '/login',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
