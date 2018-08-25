<?php

namespace App\Tests\Infra\Doctrine\Repository;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CollectionRepositoryTest
 * @group Repository
 */
final class CollectionRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }


    /**
     * @throws \Exception
     */
    public function testFindByOwnerAndCategory()
    {
        $collectionMock = $this->createMock(Collection::class);
        $collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $collectionRepository->method('findByOwnerAndCategory')->willReturn([$collectionMock, $collectionMock]);

        static::assertContainsOnlyInstancesOf(Collection::class, [$collectionMock, $collectionMock]);
    }

    public function testFindCollection()
    {
        $collectionMock = $this->createMock(Collection::class);
        $collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $collectionRepository->method('findCollection')->willReturn($collectionMock);

        static::assertInstanceOf(Collection::class, $collectionMock);
    }

    public function testFindCollectionAndImageById()
    {
        $collectionMock = $this->createMock(Collection::class);
        $collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $collectionRepository->method('findCollectionAndImageById')->willReturn($collectionMock);

        static::assertInstanceOf(Collection::class, $collectionMock);
    }

    public function testMenuFindByOwnerAndCategory()
    {
        $collectionMock = $this->createMock(Collection::class);
        $collectionRepository = $this->createMock(CollectionRepositoryInterface::class);
        $collectionRepository->method('findCollectionAndImageById')->willReturn([$collectionMock, $collectionMock]);

        static::assertContainsOnlyInstancesOf(Collection::class, [$collectionMock, $collectionMock]);

    }
}
