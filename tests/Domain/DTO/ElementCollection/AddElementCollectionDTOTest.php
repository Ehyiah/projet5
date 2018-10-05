<?php

namespace App\Tests\Domain\DTO\ElementCollection;


use App\Domain\DTO\ElementCollection\AddElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class AddElementCollectionDTOTest
 * @group DTO
 */
final class AddElementCollectionDTOTest extends TestCase
{
    /**
     * @param string $title
     * @param string $region
     * @param string $author
     * @param string $publisher
     * @param string $etat
     * @param int $buy_price
     * @param string $support
     * @param int $player_number
     * @param float $value
     * @param Collection $collection
     * @param array|null $image
     *
     * @dataProvider provideData
     */
    public function testItImplements(
        string $title,
        string $region,
        string $author,
        string $publisher,
        string $etat,
        int $buy_price,
        string $support,
        int $player_number,
        float $value,
        Collection $collection,
        array $image =null
    ) {
        $dto = new AddElementCollectionDTO(
            $title,
            $region,
            $author,
            $publisher,
            $etat,
            $buy_price,
            $support,
            $player_number,
            $value,
            $collection,
            $image
        );

        static::assertInstanceOf(AddElementCollectionDTO::class, $dto);
        static::assertSame($title, $dto->title);
        static::assertSame($region, $dto->region);
        static::assertSame($publisher, $dto->publisher);
        static::assertSame($etat, $dto->etat);
        static::assertEquals($buy_price, $dto->buy_price);
        static::assertSame($support, $dto->support);
        static::assertEquals($player_number, $dto->player_number);
        static::assertEquals($value, $dto->value);
        static::assertInstanceOf(Collection::class, $dto->collection);
        static::assertCount(1, $dto->images);
    }

    /**
     * @return \Generator
     */
    public function provideData()
    {
        $collection = $this->createMock(Collection::class);
        $image = $this->createMock(ImageCollection::class);

        yield array(
            'title',
            'region',
            'author',
            'publisher',
            'etat',
            10,
            'support',
            3,
            10,
            $collection,
            [$image]
        );
    }
}
