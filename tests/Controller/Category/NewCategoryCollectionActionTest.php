<?php

namespace App\Tests\Controller\Category;


use App\Controller\Category\NewCategoryCollectionAction;
use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Form\Handler\NewCategoryCollectionHandler;
use App\UI\Responder\NewImageCollectionResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

class NewCategoryCollectionActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface|null
     */
    private $formFactory;

    /**
     * @var EncoderFactoryInterface|null
     */
    private $encoderFactory;

    /**
     * @var NewCategoryCollectionHandlerInterface|null
     */
    private $formHandler;

    /**
     * @var NewImageCollectionResponder
     */
    private $responder;


    protected function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');

        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->formHandler = $this->createMock(NewCategoryCollectionHandler::class);
        $this->responder = new NewImageCollectionResponder(
            $this->createMock(Environment::class)
        );
    }

    public function testConstruct()
    {
        $action = new NewCategoryCollectionAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->formHandler
        );

        static::assertInstanceOf(NewCategoryCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodFormHandling()
    {
        $this->formHandler->method('handle')->willReturn(true);

        $action = new NewCategoryCollectionAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->formHandler
        );

        $request = Request::create(
            '/newCategory',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);

        $request->getSession()->getFlashBag()->add('success', 'Nouvelle catégorie créée');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testBadFormHandling()
    {
        $this->formHandler->method('handle')->willReturn(false);

        $action = new NewCategoryCollectionAction(
            $this->encoderFactory,
            $this->formFactory,
            $this->formHandler
        );

        $request = Request::create(
            '/newCategory',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);

        $request->getSession()->getFlashBag()->add('success', 'Nouvelle catégorie créée');

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}