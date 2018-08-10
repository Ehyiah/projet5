<?php

namespace App\Tests\Domain\ValueObject;


use App\Domain\ValueObject\Picture;
use PHPUnit\Framework\TestCase;

final class PictureTest extends TestCase
{
    /**
     * @param string $name
     * @param string $extension
     *
     * @dataProvider dataProvide
     */
    public function testItImplements(
        string $name,
        string $extension
    ) {
        $picture = new Picture(
            $name,
            $extension
        );

        static::assertInstanceOf(Picture::class, $picture);



    }

    /**
     * @return \Generator
     */
    public function dataProvide()
    {
        yield array(
            'fileName',
            'extension',
        );
    }
}