<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\EditElementCollectionAction;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\Interfaces\EditElementCollectionHandlerInterface;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use App\UI\Responder\ElementCollection\Interfaces\EditElementCollectionResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class EditElementCollectionActionTest
 * @group Action
 */
final class EditElementCollectionActionTest extends KernelTestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EditElementCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var EditElementCollectionResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();
        $this->elementRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface');
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->handler = $this->createMock(EditElementCollectionHandlerInterface::class);
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
        $this->collectionRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface');
        $this->responder = self::$container->get('App\UI\Responder\ElementCollection\Interfaces\EditElementCollectionResponderInterface');
    }

    public function testConstruct()
    {
        $action = new EditElementCollectionAction(
            $this->elementRepository,
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(EditElementCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodhandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $elementCollection = $this->elementRepository->findAll();

        $action = new EditElementCollectionAction(
            $this->elementRepository,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/editElementCollection',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        //$request->getSession()->set('idElement', $request->attributes->get('id'));
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été modifié');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder, $elementCollection[0]->getId())
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

        $elementCollection = $this->elementRepository->findAll();

        $action = new EditElementCollectionAction(
            $this->elementRepository,
            $this->formFactory,
            $this->handler
        );

        $request = Request::create(
            '/editElementCollection',
            'POST'
        );

        $responder = new EditElementCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été modifié');


        static::assertInstanceOf(
            Response::class,
            $action($request, $responder, $elementCollection[0]->getId())
        );
    }
}
