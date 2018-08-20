<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\AddElementCollectionFromCollectionAction;
use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\AddElementCollectionHandlerInterface;
use App\UI\Form\Type\ElementCollection\AddElementCollectionFromCollectionType;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use App\UI\Responder\ElementCollection\Interfaces\AddElementFromCollectionResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AddElementCollectionFromCollectionActionTest extends KernelTestCase
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

    public function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->collection = self::$container->get('App\Infra\Doctrine\Repository\CollectionRepository');
        $this->handler = $this->createMock(AddElementCollectionHandlerInterface::class);
        $this->responder = new AddElementFromCollectionResponder(
            $this->createMock(Environment::class),
            $this->createMock(UrlGeneratorInterface::class),
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

        $dto = new AddElementCollectionDTO(null, null, null, null, null, null, null, null, $collection[0]);

        $id = $collection[0]->getId();

        $form = $this->formFactory->create(AddElementCollectionFromCollectionType::class, $dto);

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
}