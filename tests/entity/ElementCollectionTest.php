<?php

namespace App\Tests\entity;


use App\Domain\DTO\AddElementCollectionDTO;
use App\Entity\Collection;
use App\Entity\ElementCollection;
use App\Entity\ImageCollection;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ElementCollectionTest extends TestCase
{
    public function testConstruct()
    {
        $collection = $this->createMock(Collection::class);
        $image = $this->createMock(ImageCollection::class);

        $elementCollectionDTO = $this->createMock(AddElementCollectionDTO::class);
            $elementCollectionDTO->title = 'titre';
            $elementCollectionDTO->region = 'region';
            $elementCollectionDTO->publisher = 'publisher';
            $elementCollectionDTO->etat = 'etat';
            $elementCollectionDTO->buy_price = '20.0';
            $elementCollectionDTO->support = 'support';
            $elementCollectionDTO->player_number = '2';
            $elementCollectionDTO->value = '12';
            $elementCollectionDTO->collection = $collection;
            $elementCollectionDTO->images = new ArrayCollection();


        $elementCollection = new ElementCollection($elementCollectionDTO);
        $arrayCollection = new ArrayCollection();

        static::assertNotEmpty($elementCollection);

        static::assertSame('titre', $elementCollection->getTitle());
        static::assertSame('region', $elementCollection->getRegion());
        static::assertSame('publisher', $elementCollection->getPublisher());
        static::assertSame('etat', $elementCollection->getEtat());
        static::assertEquals('20.0', $elementCollection->getBuyPrice());
        static::assertSame('support', $elementCollection->getSupport());
        static::assertEquals('2', $elementCollection->getPlayerNumber());
        static::assertEquals('12', $elementCollection->getValue());
        static::assertSame($collection, $elementCollection->getCollectionName());
        static::assertSame($image, $elementCollection->getImages());
    }
}