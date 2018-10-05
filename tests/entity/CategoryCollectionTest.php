<?php

namespace App\Tests\entity;


use App\Domain\DTO\Category\AddCategoryDTO;
use App\Entity\CategoryCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class CategoryCollectionTest
 * @group Entity
 */
final class CategoryCollectionTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstruct()
    {
        $categoryCollectionDTO = $this->createMock(AddCategoryDTO::class);
            $categoryCollectionDTO->category_collection = 'testCategory';

        $categoryCollection = new CategoryCollection($categoryCollectionDTO);


        static::assertNotEmpty($categoryCollection);

        static::assertSame('testCategory', $categoryCollection->getCategoryCollection());
        static::assertNotEmpty($categoryCollection->getId());
    }
}