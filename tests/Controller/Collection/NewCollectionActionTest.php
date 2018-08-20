<?php

namespace App\Tests\Controller\Collection;

use App\Controller\Collection\NewCollectionAction;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\Interfaces\NewCollectionResponderInterface;
use App\UI\Responder\NewCollectionResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Twig\Environment;

/**
 * Class NewCollectionActionTest
 */
final class NewCollectionActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var NewCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var NewCollectionResponderInterface
     */
    private $responder;

    public function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');

        $this->handler = $this->createMock(NewCollectionHandlerInterface::class);
        $this->responder = new NewCollectionResponder(
            $this->createMock(Environment::class)
        );
    }

    public function testConstruct()
    {
        $action = new NewCollectionAction(
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(NewCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodHandling()
    {
        $action = new NewCollectionAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/newCollection',
            'POST'
        );

        $this->handler->method('handle')->willReturn(true);

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'La collection a bien été ajoutée');

        static::assertInstanceOf(RedirectResponse::class, $action($request, $this->responder));
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testBadHandling()
    {
        $action = new NewCollectionAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/newCollection',
            'POST'
        );

        $this->handler->method('handle')->willReturn(false);

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}