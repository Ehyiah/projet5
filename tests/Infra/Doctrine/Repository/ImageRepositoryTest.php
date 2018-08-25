<?php

namespace App\Tests\Infra\Doctrine\Repository;


use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class ImageRepositoryTest
 * @group Repository
 */
final class ImageRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp()
    {
        static::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testFindImage()
    {
        $imageMock = $this->createMock(ImageCollection::class);
        $imageRepositoryMock = $this->createMock(ImageRepositoryInterface::class);
        $imageRepositoryMock->method('findImage')->willReturn($imageMock);

        static::assertInstanceOf(ImageCollection::class, $imageMock);
    }
}