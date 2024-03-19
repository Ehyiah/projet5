<?php

namespace App\Tests\Controller\Collection;


use App\Controller\Collection\EditCollectionAction;
use App\Domain\DTO\Collection\AddCollectionDTO;
use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\EditCollectionHandlerInterface;
use App\UI\Responder\Collection\EditCollectionResponder;
use App\UI\Responder\Collection\Interfaces\EditCollectionResponderInterface;
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
 * Class EditCollectionActionTest
 * @group Action
 */
final class EditCollectionActionTest extends KernelTestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EditCollectionHandlerInterface
     */
    private $handler;

    /**
     * @var EditCollectionResponderInterface
     */
    private $responder;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository;

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

    protected function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->handler = $this->createMock(EditCollectionHandlerInterface::class);

        $this->responder = self::$container->get('App\UI\Responder\Collection\Interfaces\EditCollectionResponderInterface');
        $this->categoryRepository = self::$container->get('App\Repository\CategoryCollectionRepository');

        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
    }

    public function testConstruct()
    {
        $action = new EditCollectionAction(
            $this->collectionRepository,
            $this->formFactory,
            $this->handler
        );

        static::assertInstanceOf(EditCollectionAction::class, $action);
    }

    /**
     * @throws \Exception
     */
    public function testGoodEdit()
    {
        $category = $this->categoryRepository->findAll();

        $this->handler->method('handle')->willReturn(true);

        $collectionDTO = new AddCollectionDTO(
            'nom', 'tag', $category[0], true, null
        );
        $collection = new Collection($collectionDTO);

        $action = new EditCollectionAction(
            $this->collectionRepository,
            $this->formFactory,
            $this->handler
        );

        $this->collectionRepository->method('findCollection')->willReturn($collection);

        $request = Request::create(
            '/editCollection',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'La Collection a bien été modifiée');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder)
        );
    }

    /**
     * @throws \Exception
     */
    public function testBadEdit()
    {
        $this->handler->method('handle')->willReturn(false);

        $category = $this->categoryRepository->findAll();
        $collectionDTO = new AddCollectionDTO(
            'nom', 'tag', $category[0], true, null
        );
        $collection = new Collection($collectionDTO);

        $action = new EditCollectionAction(
            $this->collectionRepository,
            $this->formFactory,
            $this->handler
        );

        $this->collectionRepository->method('findCollection')->willReturn($collection);

        $request = Request::create(
            '/editCollection',
            'POST',
            array(),
            array(),
            array(),
            array(
                'HTTP_REFERER' => 'http://127.0.0.1:8000/home',
            )
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->set('idCollection', $request->attributes->get('id'));

        $responder = new EditCollectionResponder(
            $this->twig,
            $this->urlGenerator,
            $this->session
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $responder)
        );
    }
}
