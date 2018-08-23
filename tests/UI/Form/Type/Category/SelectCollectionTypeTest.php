<?php

namespace App\Tests\UI\Form\Type\Category;


use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Type\Category\SelectCollectionType;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class SelectCollectionTypeTest
 * @group Type
 */
final class SelectCollectionTypeTest extends TypeTestCase
{
    /**
     * @var CategoryCollectionRepositoryInterface|null
     */
    private $categoryRepository = null;

    /**
     * @var ObjectManager|null
     */
    private $em = null;

    protected function setUp()
    {
        $this->categoryRepository = $this->createMock(CategoryCollectionRepositoryInterface::class);
        $this->em = $this->createMock(ObjectManager::class);
        parent::setUp();
    }

    protected function getExtensions()
    {
        $classMetaDataMock = $this->createMock(ClassMetadata::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);
        $registryMock = $this->createMock(Registry::class);
        $categoryCollectionRepositoryMock = $this->createMock(CategoryCollectionRepositoryInterface::class);
        $repositoryFactoryMock = $this->createMock(RepositoryFactory::class);
        $queryBuilderMock = $this->createMock(QueryBuilder::class);
        $queryMock = $this->createMock(AbstractQuery::class);
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $categoryCollectionMock = $this->createMock(CategoryCollectionInterface::class);

        $queryMock->method('execute')->willReturn([0 => $categoryCollectionMock]);
        $queryBuilderMock->method('getQuery')->willReturn($queryMock);
        $classMetaDataMock->method('getIdentifierFieldNames')->willReturn([]);
        $entityManagerMock->method('getClassMetadata')->willReturn($classMetaDataMock);
        $entityRepositoryMock->method('createQueryBuilder')->willReturn($queryBuilderMock);
        $entityRepositoryMock->method('findAll')->willReturn([0 => $categoryCollectionMock]);
        $entityManagerMock->method('createQueryBuilder')->willReturn($queryBuilderMock);
        $entityManagerMock->method('getRepository')->willReturn($entityRepositoryMock);
        $registryMock->method('getManagerForClass')->willReturn($entityManagerMock);
        $entityType = new EntityType($registryMock);

        return [new PreloadedExtension([$entityType], [])];
    }

    public function testItImplements()
    {
        $type = new SelectCollectionType();

        static::assertInstanceOf(AbstractType::class, $type);
    }

    /**
    public function testItAcceptData()
    {
        $addCategoryDTO = new AddCategoryDTO('test');
        $category = new CategoryCollection($addCategoryDTO);

        $this->categoryRepository->expects($this->any())
            ->method('findCategory')
            ->willReturn($category)
        ;
        $this->em->expects($this->any())
            ->method('getRepository')
            ->willReturn($this->categoryRepository)
        ;

        $type = $this->factory->create(SelectCollectionType::class);


        $type->submit([
            'categoryCollection' => $category
        ]);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
    }

     * */
}
