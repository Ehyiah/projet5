<?php

namespace App\Tests\UI\Form\Type\Image;


use App\Domain\DTO\AddElementImageDTO;
use App\Entity\ImageCollection;
use App\Entity\Interfaces\ImageCollectionInterface;
use App\Service\FileUploader;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\DataTransformer\ImageElementCollectionDataTransformer;
use App\UI\Form\Extension\ImageTypeExtension;
use App\UI\Form\Type\Image\ImageCollectionType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Tests\Extension\Core\Type\FileTypeTest;

/**
 * Class ImageCollectionTypeTest
 * @group Type
 */
final class ImageCollectionTypeTest extends TypeTestCase
{
    /**
     * @var DataTransformerInterface|null
     */
    private $transformer = null;

    protected function getExtensions()
    {
        $this->transformer = $this->createMock(ImageElementCollectionDataTransformer::class);
        $type = new ImageCollectionType($this->transformer);

        return [new PreloadedExtension([$type], [])];
    }

    protected function getTypeExtensions()
    {
        return [new ImageTypeExtension()];
    }

    public function testItImplements()
    {
        $elementTransformer = $this->createMock(ImageElementCollectionDataTransformer::class);
        $type = new ImageCollectionType($elementTransformer);

        static::assertInstanceOf(ImageCollectionType::class, $type);
    }


    public function testItAcceptData()
    {
        $type = $this->factory->create(ImageCollectionType::class);

        $imageCollectionMock = $this->createMock(ImageCollectionInterface::class);
        $image = $this->transformer->method('reverseTransform')->willReturn($imageCollectionMock);

        $type->submit([
           'image' => $image
        ]);

        static::assertTrue($type->isSubmitted());
        static::assertTrue($type->isValid());
        static::assertInstanceOf(AddElementImageDTO::class, $type->getData());
    }
}
