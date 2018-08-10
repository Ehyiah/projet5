<?php

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\AddCollectionDTO;
use App\Entity\CategoryCollection;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

final class AddCollectionDTOTest extends TestCase
{
    /**
     * @param string $name
     * @param string $tag
     * @param CategoryCollection $collection
     * @param bool $visibility
     * @param ImageCollection|null $image
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(
        string $name,
        string $tag,
        CategoryCollection $collection,
        bool $visibility,
        ImageCollection $image = null
    ) {
        $dto = new AddCollectionDTO(
            $name,
            $tag,
            $collection,
            $visibility,
            $image
        );

        static::assertInstanceOf(AddCollectionDTO::class, $dto);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        $collection = $this->createMock(CategoryCollection::class);
        $image = $this->createMock(ImageCollection::class);

        yield array(
            'nom',
            'tag',
            $collection,
            true,
            $image
        );
        yield array(
            'nom0',
            'tag0',
            $collection,
            false,
            $image
        );
        yield array(
            'nom',
            'tag',
            $collection,
            true,
            null
        );
        yield array(
            'nom',
            'tag',
            $collection,
            false,
            null
        );
    }
}