<?php

namespace App\Tests\Domain\ValueObject;


use App\Domain\ValueObject\Picture;
use PHPUnit\Framework\TestCase;

/**
 * Class PictureTest
 */
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

        $newFileName = $picture->getFileName();

        static::assertInstanceOf(Picture::class, $picture);
        static::assertSame($picture->getNewFileName(), $newFileName);


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
