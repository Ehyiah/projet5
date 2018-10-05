<?php

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\AddElementImageDTO;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class AddElementImageDTOTest
 * @group DTO
 */
final class AddElementImageDTOTest extends TestCase
{
    /**
     * @param ImageCollection $image
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(ImageCollection $image)
    {
        $dto = new AddElementImageDTO($image);

        static::assertInstanceOf(AddElementImageDTO::class, $dto);
        static::assertInstanceOf(ImageCollection::class, $dto->image);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        $image = $this->createMock(ImageCollection::class);

        yield array(
            $image
        );
    }
}
