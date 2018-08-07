<?php

namespace App\Tests\entity;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\ImageCollection;
use PHPUnit\Framework\TestCase;

class ImageCollectionTest extends TestCase
{
    public function testConstruct()
    {
        $picture = $this->createMock(PictureInterface::class);

        $image = new ImageCollection($picture);


    }
}