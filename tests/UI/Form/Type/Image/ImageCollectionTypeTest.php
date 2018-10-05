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
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Tests\Extension\Core\Type\FileTypeTest;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /**
     * @var ValidatorInterface
     */
    private $validator = null;

    protected function getExtensions()
    {
        $this->transformer = $this->createMock(ImageElementCollectionDataTransformer::class);
        $type = new ImageCollectionType($this->transformer);

        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->validator->method('validate')
            ->will($this->returnValue(new ConstraintViolationList()));
        $this->validator->method('getMetaDataFor')
            ->will($this->returnValue(new ClassMetadata(Form::class)));

        return [new ValidatorExtension($this->validator), new PreloadedExtension([$type], [])];
    }

    protected function getTypeExtensions()
    {
        return [new ImageTypeExtension('test')];
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
