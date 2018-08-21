<?php

namespace App\Tests\Controller\Collection;


use App\Controller\Collection\DeleteCollectionAction;
use App\Domain\DTO\Category\AddCategoryDTO;
use App\Domain\DTO\Collection\AddCollectionDTO;
use App\Entity\CategoryCollection;
use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Class DeleteCollectionActionTest
 */
final class DeleteCollectionActionTest extends KernelTestCase
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var ElementCollectionRepositoryInterface
     */
    private $elementRepository;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    protected function setUp()
    {
        static::bootKernel();

        $this->collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $this->elementRepository = $this->createMock(ElementCollectionRepositoryInterface::class);
        $this->fileSystem = $this->createMock(Filesystem::class);
    }

    public function testConstruct()
    {
        $action = new DeleteCollectionAction(
            $this->collectionRepository,
            $this->elementRepository,
            $this->fileSystem
        );

        static::assertInstanceOf(
            DeleteCollectionAction::class,
            $action
        );
    }

    /**
     * @throws \Exception
     */
    public function testGoodDeleteCollection()
    {
        $categoryDTO = new AddCategoryDTO('categorie');
        $category = new CategoryCollection($categoryDTO);
        $collectionDTO = new AddCollectionDTO(
            'nom', 'tag', $category, true, null
        );
        $collection = new Collection($collectionDTO);
        $id = 'test';

        $action = new DeleteCollectionAction(
            $this->collectionRepository,
            $this->elementRepository,
            $this->fileSystem
        );

        $this->collectionRepository->method('findCollection')->willReturn($collection);

        $request = Request::create(
            '/delete',
            'POST'
        );

        $session = new Session(new MockArraySessionStorage());
        $request->setSession($session);
        $request->getSession()->getFlashBag()->add('success', 'La collection a bien été supprimée');

        $request->headers->set('referer', '/home');

        static::assertInstanceOf(
            RedirectResponse::class,
            $action($request, $id)
        );
    }
}
