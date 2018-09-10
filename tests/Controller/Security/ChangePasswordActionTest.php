<?php

namespace App\Tests\Controller\Security;


use App\Controller\Security\ChangePasswordAction;
use App\UI\Form\Handler\Security\Interfaces\ChangePasswordHandlerInterface;
use App\UI\Responder\Security\Interfaces\ChangePasswordResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Twig\Environment;

/**
 * Class ChangePasswordActionTest
 */
final class ChangePasswordActionTest extends KernelTestCase
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Mauvais mot de passe Actuel"
     * )
     * @var string|null
     */
    protected $oldPassword = null;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var ChangePasswordHandlerInterface
     */
    private $handler;

    /**
     * @var ChangePasswordResponderInterface
     */
    private $responder;


    protected function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->handler = $this->createMock(ChangePasswordHandlerInterface::class);
        $this->responder = self::$container->get('App\UI\Responder\Security\Interfaces\ChangePasswordResponderInterface');
    }

    public function testConstruct()
    {
        $action = new ChangePasswordAction(
            $this->oldPassword,
            $this->formFactory,
            $this->twig,
            $this->urlGenerator,
            $this->handler
        );

        static::assertInstanceOf(ChangePasswordAction::class, $action);
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new ChangePasswordAction(
            $this->oldPassword,
            $this->formFactory,
            $this->twig,
            $this->urlGenerator,
            $this->handler
        );

        $request = Request::create(
            '/changePassword',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'Le mot de passe a bien été modifié');

        static::assertInstanceOf(RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new ChangePasswordAction(
            $this->oldPassword,
            $this->formFactory,
            $this->twig,
            $this->urlGenerator,
            $this->handler
        );

        $request = Request::create(
            '/changePassword',
            'POST'
        );

        static::assertInstanceOf(Response::class,
            $action($request, $this->responder)
        );
    }
}
