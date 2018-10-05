<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\AddElementCollectionFromCollectionAction;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\AddElementCollectionHandlerInterface;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use App\UI\Responder\ElementCollection\Interfaces\AddElementFromCollectionResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Twig\Environment;

/**
 * Class AddElementCollectionFromCollectionActionTest
 * @group Action
 */
final class AddElementCollectionFromCollectionActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var AddElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var AddElementFromCollectionResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->collection = self::$container->get('App\Infra\Doctrine\Repository\CollectionRepository');
        $this->handler = $this->createMock(AddElementCollectionHandlerInterface::class);
        $this->responder = new AddElementFromCollectionResponder(
            $this->createMock(Environment::class),
            $this->urlGenerator = self::$container->get('Symfony\Component\Routing\Generator\UrlGeneratorInterface'),
            $this->createMock(SessionInterface::class)
        );
    }

    public function testConstruct()
    {
        $action = new AddElementCollectionFromCollectionAction(
            $this->formFactory,
            $this->collection,
            $this->handler
        );

        static::assertInstanceOf(AddElementCollectionFromCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $collection = $this->collection->findAll();

        $id = $collection[0]->getId();

        $action = new AddElementCollectionFromCollectionAction(
            $this->formFactory,
            $this->collection,
            $this->handler
        );

        $request = Request::create(
            'addElement',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été ajoutée à la collection');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action ($request, $id, $this->responder)
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testBadHandling()
    {
        $this->handler->method('handle')->willReturn(false);

        $collection = $this->collection->findAll();

        $id = $collection[0]->getId();

        $action = new AddElementCollectionFromCollectionAction(
            $this->formFactory,
            $this->collection,
            $this->handler
        );

        $request = Request::create(
            'addElement',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été ajoutée à la collection');

        static::assertInstanceOf(
            Response::class,
            $action ($request, $id, $this->responder)
        );
    }
}
