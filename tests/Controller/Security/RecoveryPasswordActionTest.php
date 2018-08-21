<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\RecoveryPasswordAction;
use App\UI\Form\Handler\Security\Interfaces\PasswordRecoverInputHandlerInterface;
use App\UI\Responder\Security\Interfaces\PasswordRecoverInputResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class RecoveryPasswordActionTest
 */
final class RecoveryPasswordActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var PasswordRecoverInputHandlerInterface
     */
    private $handler;

    /**
     * @var PasswordRecoverInputResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->handler = $this->createMock(PasswordRecoverInputHandlerInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Security\Interfaces\PasswordRecoverInputResponderInterface');
    }

    public function testConstruct()
    {
        $action = new RecoveryPasswordAction(
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(RecoveryPasswordAction::class, $action);
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new RecoveryPasswordAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/recoverPassword',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'Un mail contenant un lien de réinitilisation vous a été envoyé à l\'adresse renseignée lors de la création du compte');


        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new RecoveryPasswordAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/recoverPassword',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'Un mail contenant un lien de réinitilisation vous a été envoyé à l\'adresse renseignée lors de la création du compte');


        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
