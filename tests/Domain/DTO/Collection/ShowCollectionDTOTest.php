<?php

namespace App\Tests\Domain\DTO\Collection;


use App\Domain\DTO\Collection\ShowCollectionDTO;
use App\Entity\CategoryCollection;
use PHPUnit\Framework\TestCase;

final class ShowCollectionDTOTest extends TestCase
{
    /**
     * @param CategoryCollection $collection
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(CategoryCollection $collection)
    {
        $dto = new ShowCollectionDTO($collection);

        static::assertInstanceOf(ShowCollectionDTO::class, $dto);
        static::assertSame($collection, $dto->categoryCollection);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        $category = $this->createMock(CategoryCollection::class);

        yield array($category);
    }
}
