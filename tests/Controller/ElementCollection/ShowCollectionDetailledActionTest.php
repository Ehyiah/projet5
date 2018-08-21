<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\ShowCollectionDetailledAction;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Responder\Collection\Interfaces\ShowCollectionDetailledResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class ShowCollectionDetailledActionTest
 */
final class ShowCollectionDetailledActionTest extends KernelTestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var ShowCollectionDetailledResponderInterface
     */
    private $responder;


    protected function setUp()
    {
        static::bootKernel();
        $this->elementRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface');
        $this->responder = self::$container->get('App\UI\Responder\Collection\Interfaces\ShowCollectionDetailledResponderInterface');
    }

    public function testConstruct()
    {
        $action = new ShowCollectionDetailledAction(
            $this->elementRepository
        );

        static::assertInstanceOf(
            ShowCollectionDetailledAction::class,
            $action
        );
    }

    public function testGoodhandling()
    {
        $elementCollection = $this->elementRepository->findAll();
        $idCollection = $elementCollection[0];

        $action = new ShowCollectionDetailledAction(
            $this->elementRepository
        );

        $request = Request::create(
            '/showDetailled',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->set('collectionName', $request->attributes->get('collectionName'));
        $request->getSession()->set('id', $request->attributes->get('idCollection'));


        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $this->responder, $idCollection)
        );
    }

    public function testbadHandling()
    {
        $elementCollection = $this->elementRepository->findAll();
        $idCollection = $elementCollection[0];

        $action = new ShowCollectionDetailledAction(
            $this->elementRepository
        );

        $request = Request::create(
            '/showDetailled',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->set('collectionName', $request->attributes->get('collectionName'));
        $request->getSession()->set('id', $request->attributes->get('idCollection'));


        static::assertInstanceOf(
            Response::class,
            $action($request, $this->responder, $idCollection)
        );
    }
}
