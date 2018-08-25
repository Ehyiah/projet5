<?php

namespace App\Tests\Infra\Doctrine\Repository;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ElementCollectionRepositoryTest
 * @group Repository
 */
final class ElementCollectionRepositoryTest extends KernelTestCase
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

    public function testFindCollectionById()
    {
        $elementMock = $this->createMock(ElementCollection::class);

        $elementRepositoryMock = $this->createMock(ElementCollectionRepositoryInterface::class);
        $elementRepositoryMock->method('findCollectionById')->willReturn($elementMock);

        static::assertInstanceOf(ElementCollection::class, $elementMock);
    }
}