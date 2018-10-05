<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\NewElementCollectionAction;
use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\Interfaces\NewElementCollectionResponderInterface;
use App\UI\Responder\NewElementCollectionResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Twig\Environment;

/**
 * Class NewElementCollectionActionTest
 * @group Action
 */
final class NewElementCollectionActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var NewElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var NewElementCollectionResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->handler = $this->createMock(NewElementCollectionHandlerInterface::class);
        $this->responder = new NewElementCollectionResponder(
            $this->createMock(Environment::class)
        );
    }

    public function testConstruct()
    {
        $action = new NewElementCollectionAction(
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(
            NewElementCollectionAction::class,
            $action
        );
    }

    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new NewElementCollectionAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/newElement',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été créé');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $action = new NewElementCollectionAction(
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/newElement',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
