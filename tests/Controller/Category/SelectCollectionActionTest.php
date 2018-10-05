<?php

namespace App\Tests\Controller\Category;


use App\Controller\Category\SelectCollectionAction;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use App\UI\Responder\Category\Interfaces\SelectCollectionResponderInterface;
use App\UI\Responder\Category\SelectCollectionResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class SelectCollectionActionTest
 * @group Action
 */
final class SelectCollectionActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryCollectionRepository;

    /**
     * @var SelectCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var SelectCollectionResponderInterface
     */
    private $responder;

    protected function setUp()
    {
        static::bootKernel();

        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->categoryCollectionRepository = $this->createMock(CategoryCollectionRepositoryInterface::class);
        $this->handler = $this->createMock(SelectCollectionHandlerInterface::class);
        $this->responder = new SelectCollectionResponder(
            $this->createMock(Environment::class),
            $this->createMock(UrlGeneratorInterface::class)
        );
    }

    public function testConstruct()
    {
        $action = new SelectCollectionAction(
            $this->formFactory,
            $this->categoryCollectionRepository,
            $this->handler
        );

        static::assertInstanceOf(SelectCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodFormHandling()
    {
        $this->handler->method('handle')->willReturn(true);

        $action = new SelectCollectionAction(
            $this->formFactory,
            $this->categoryCollectionRepository,
            $this->handler
        );

        $request = Request::create(
            '/select',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'La catégorie a bien été supprimée');

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
        $this->handler->method('handle')->willReturn(false);

        $action = new SelectCollectionAction(
            $this->formFactory,
            $this->categoryCollectionRepository,
            $this->handler
        );

        $request = Request::create(
            '/select',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder)
        );
    }
}
