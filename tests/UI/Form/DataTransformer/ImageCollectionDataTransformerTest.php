<?php

namespace App\Tests\UI\Form\DataTransformer;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\ImageCollection;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\DataTransformer\ImageCollectionDataTransformer;
use PHPUnit\Framework\TestCase;

/**
 * Class ImageCollectionDataTransformerTest
 * @group DataTransformer
 */
final class ImageCollectionDataTransformerTest extends TestCase
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    protected function setUp()
    {
        $this->fileUploader = $this->createMock(FileUploaderInterface::class);
    }

    public function testItImplements()
    {
        $dt = new ImageCollectionDataTransformer($this->fileUploader);

        static::assertInstanceOf(ImageCollectionDataTransformer::class, $dt);
    }

    /**
     * @throws \Exception
     */
    public function testItReverseTransforms()
    {
        $dt = $this->createMock(ImageCollectionDataTransformer::class);

        $picture = $this->createMock(PictureInterface::class);
        $this->fileUploader->method('upload')->willReturn($picture->method('getFileName')->willReturn('test'));

        $image = new ImageCollection($picture);
        $dt->method('reverseTransform')->willReturn($image);

        static::assertInstanceOf(ImageCollection::class, $image);
    }
}
