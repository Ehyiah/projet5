<?php

namespace App\Tests\UI\Form\DataTransformer;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\ImageCollection;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\DataTransformer\ImagesElementCollectionDataTransformerFromCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class ImagesElementCollectionDataTransformerFromCollectionTest
 * @group DataTransformer
 */
final class ImagesElementCollectionDataTransformerFromCollectionTest extends TestCase
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
        $dt = new ImagesElementCollectionDataTransformerFromCollection($this->fileUploader);

        static::assertInstanceOf(ImagesElementCollectionDataTransformerFromCollection::class, $dt);
    }

    /**
     * @throws \Exception
     */
    public function testItReverseTransforms()
    {
        $dt = $this->createMock(ImagesElementCollectionDataTransformerFromCollection::class);

        $picture = $this->createMock(PictureInterface::class);
        $this->fileUploader->method('upload')->willReturn('test');

        $image = new ImageCollection($picture);
        $data = [$image, $image];
        $dt->method('reverseTransform')->willReturn($data);

        static::assertContainsOnlyInstancesOf(ImageCollection::class, $data);
    }
}
