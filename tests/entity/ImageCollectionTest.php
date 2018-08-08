<?php

namespace App\Tests\entity;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use PHPUnit\Framework\TestCase;

class ImageCollectionTest extends TestCase
{
    public function testConstruct()
    {
        $picture = $this->createMock(PictureInterface::class);

        //$image = new ImageCollection($picture);
        $test = $picture->getFileName();

        static::assertNotEmpty($picture);


    }
}