<?php

namespace App\Tests\Domain\DTO\Collection;


use App\Domain\DTO\Collection\EditCollectionDTO;
use App\Entity\CategoryCollection;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

final class EditCollectionDTOTest extends TestCase
{
    /**
     * @param string $name
     * @param string $tag
     * @param CategoryCollection $category
     * @param bool $visibility
     * @param null $image
     *
     * @dataProvider provideData
     */
    public function testItImplements(
        string $name,
        string $tag,
        CategoryCollection $category,
        bool $visibility,
        $image = null
    ) {
        $dto = new EditCollectionDTO(
            $name,
            $tag,
            $category,
            $visibility,
            $image = null
        );

        static::assertInstanceOf(EditCollectionDTO::class, $dto);
        static::assertSame($name, $dto->name);
        static::assertSame($tag, $dto->tag);
        static::assertSame($category, $dto->category);
        static::assertSame($visibility, $dto->visibility);
        static::assertSame($image, $dto->image);

    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        $category = $this->createMock(CategoryCollection::class);
        $image = $this->createMock(ImageCollection::class);

        yield array(
            'Nom',
            'Tag',
            $category,
            true,
            $image
        );
        yield array(
            'Nom',
            'Tag',
            $category,
            true,
            $image
        );
    }
}
