<?php

namespace App\Tests\entity;


use App\Domain\DTO\AddCollectionDTO;
use App\Entity\CategoryCollection;
use App\Entity\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testConstruct()
    {
        $category = $this->createMock(CategoryCollection::class);

        $collectionDTO = $this->createMock(AddCollectionDTO::class);
            $collectionDTO->name = 'testNom';
            $collectionDTO->image = null;
            $collectionDTO->visibility = '0';
            $collectionDTO->tag = 'testTag';
            $collectionDTO->category = $category;

        $collection = new Collection($collectionDTO);

        static::assertNotEmpty($collection);

        static::assertSame('testNom', $collection->getCollectionName());
        static::assertSame(null, $collection->getImage());
        static::assertSame(0, $collection->getHidden());
        static::assertSame('testTag', $collection->getTag());
        static::assertSame($category, $collection->getCategory());

        static::assertNotEmpty($collection->getCreationDate());
        static::assertNotEmpty($collection->getId());

        static::assertEmpty($collection->getElementsCollection());

    }
}