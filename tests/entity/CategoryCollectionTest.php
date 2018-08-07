<?php

namespace App\Tests\entity;


use App\Domain\DTO\AddCategoryDTO;
use App\Entity\CategoryCollection;
use PHPUnit\Framework\TestCase;

class CategoryCollectionTest extends TestCase
{
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