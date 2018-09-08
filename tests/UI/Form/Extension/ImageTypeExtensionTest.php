<?php

namespace App\Tests\UI\Form\Extension;


use App\UI\Form\Extension\ImageTypeExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Class ImageTypeExtensionTest
 */
final class ImageTypeExtensionTest extends TestCase
{
    public function testItImplements()
    {
        $imageType = new ImageTypeExtension();

        static::assertInstanceOf(
            ImageTypeExtension::class,
            $imageType
        );
    }

    public function testItReturns()
    {
        $imageType = new ImageTypeExtension();
        $return = $imageType->getExtendedType();

        static::assertSame(
            FileType::class,
            $return
        );
    }
}
