<?php

namespace App\Tests\Domain\DTO\ElementCollection;


use App\Domain\DTO\ElementCollection\EditElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class EditElementCollectionDTOTest
 * @group DTO
 */
final class EditElementCollectionDTOTest extends TestCase
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
     * @param array $images
     *
     * @dataProvider dataProvide
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
        array $images = []
    ) {
        $dto = new EditElementCollectionDTO(
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
            $images
        );

        static::assertInstanceOf(EditElementCollectionDTO::class, $dto);

        static::assertSame($title, $dto->title);
        static::assertSame($region, $dto->region);
        static::assertSame($publisher, $dto->publisher);
        static::assertSame($etat, $dto->etat);
        static::assertEquals($buy_price, $dto->buy_price);
        static::assertSame($support, $dto->support);
        static::assertSame($player_number, $dto->player_number);
        static::assertSame($value, $dto->value);
        static::assertInstanceOf(Collection::class, $collection);
        static::assertCount(1, $dto->images);
    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        $collection = $this->createMock(Collection::class);
        $image = $this->createMock(ImageCollection::class);

        yield array(
            'titre',
            'region',
            'author',
            'publisher',
            'etat',
            10,
            'support',
            2,
            10,
            $collection,
            [$image]
        );
        yield array(
            'titre',
            'region',
            'author',
            'publisher',
            'etat',
            10,
            'support',
            2,
            10,
            $collection,
            [$image]
        );
    }
}