<?php

namespace App\Tests\Controller\ElementCollection;


use App\Controller\ElementCollection\DeleteElementCollectionAction;
use App\DataFixtures\ElementCollectionFixtures\ElementCollectionFixture;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class DeleteElementCollectionActionTest
 * @group Action
 */
final class DeleteElementCollectionActionTest extends KernelTestCase
{
    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var DoctrineBundle
     */
    private $doctrine;

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @throws \Exception
     */
    protected function setUp()
    {
        static::bootKernel();

        $this->elementRepository = self::$container->get('App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface');
        $this->fileSystem = $this->createMock(Filesystem::class);

        $this->collectionRepository = self::$container->get('App\Repository\CollectionRepository');

        $this->doctrine = self::$container->get('doctrine');
        $em = $this->doctrine->getManager();

        $fixture = new ElementCollectionFixture(
            $this->elementRepository,
            $this->collectionRepository
        );
        $fixture->load($em);
    }


    public function testConstruct()
    {
        $action = new DeleteElementCollectionAction(
            $this->elementRepository,
            $this->fileSystem
        );

        static::assertInstanceOf(DeleteElementCollectionAction::class, $action);
    }

    public function testGoodHandling()
    {
        $action = new DeleteElementCollectionAction(
            $this->elementRepository,
            $this->fileSystem
        );

        $request = Request::create(
            '/deleteElement',
            'POST',
            array(),
            array(),
            array(),
            array(
                'HTTP_REFERER' => 'testReferer'
            )
        );

        $element = $this->elementRepository->findAll();
        $id = $element[0]->getId();

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'L\'élément a bien été supprimé');


        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $id)
        );
    }
}
