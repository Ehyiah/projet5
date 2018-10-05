<?php

namespace App\Tests\Controller\Collection;

use App\Controller\Collection\ShowCollectionAction;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;


/**
 * Class ShowCollectionActionTest
 * @group Action
 */
final class ShowCollectionActionTest extends KernelTestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * @var ShowCollectionResponder
     */
    private $responder;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function setUp()
    {
        static::bootKernel();

        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->security = $this->createMock(TokenStorageInterface::class);

        $this->responder = new ShowCollectionResponder(
            $this->createMock(Environment::class),
            $this->createMock(UrlGeneratorInterface::class)
        );
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    }

    public function testConstruct()
    {
        $action = new ShowCollectionAction(
            $this->collectionRepository,
            $this->security
        );

        static::assertInstanceOf(ShowCollectionAction::class, $action);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGoodhandling()
    {
        $action = new ShowCollectionAction(
            $this->collectionRepository,
            $this->security
        );

        $request = Request::create(
            '/show',
            'POST'
        );

        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder, null)
        );
    }
}
