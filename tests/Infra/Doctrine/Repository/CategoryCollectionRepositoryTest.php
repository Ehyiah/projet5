<?php

namespace App\Tests\Infra\Doctrine\Repository;


use App\Entity\CategoryCollection;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CategoryCollectionRepositoryTest
 * @group Repository
 */
final class CategoryCollectionRepositoryTest extends KernelTestCase
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

        //parent::setUp();
    }

    public function testFindAll()
    {
        $category = $this->em
            ->getRepository('App:CategoryCollection')
            ->findAll()
        ;

        static::assertContainsOnlyInstancesOf(CategoryCollection::class, $category);
    }

    public function testFindCategory()
    {
        $cat = $this->createMock(CategoryCollection::class);

        $category = $this->createMock(CategoryCollectionRepositoryInterface::class);
        $category->method('findCategory')->willReturn($cat);

        static::assertInstanceOf(CategoryCollection::class, $cat);
    }
}
