<?php

namespace App\Tests\entity;


use App\Domain\DTO\AddElementCollectionDTO;
use App\Domain\DTO\AddElementImageDTO;
use App\Entity\Collection;
use App\Entity\ElementCollection;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

class ElementCollectionTest extends TestCase
{
    public function testConstruct()
    {
        $collection = $this->createMock(Collection::class);
        $image = $this->createMock(ImageCollection::class);
        $addElementImageDTO = new AddElementImageDTO($image);

        $elementCollectionDTO = new AddElementCollectionDTO(
            'titre', 'region', 'publisher', 'etat', '20.0', 'support', '2', '12', $collection, [$addElementImageDTO]
        );

        $elementCollection = new ElementCollection($elementCollectionDTO);

        static::assertSame('titre', $elementCollection->getTitle());
        static::assertSame('region', $elementCollection->getRegion());
        static::assertSame('publisher', $elementCollection->getPublisher());
        static::assertSame('etat', $elementCollection->getEtat());
        static::assertEquals('20.0', $elementCollection->getBuyPrice());
        static::assertSame('support', $elementCollection->getSupport());
        static::assertEquals('2', $elementCollection->getPlayerNumber());
        static::assertEquals('12', $elementCollection->getValue());
        static::assertCount(1, $elementCollection->getImages());
        static::assertInstanceOf(Collection::class, $elementCollection->getCollectionName());
    }
}