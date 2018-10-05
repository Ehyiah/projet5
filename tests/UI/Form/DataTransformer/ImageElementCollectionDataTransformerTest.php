<?php

namespace App\Tests\UI\Form\DataTransformer;


use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\ImageCollection;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\DataTransformer\ImageElementCollectionDataTransformer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class ImageElementCollectionDataTransformerTest
 * @group DataTransformer
 */
final class ImageElementCollectionDataTransformerTest extends TestCase
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader = null;

    /**
     * @var SessionInterface
     */
    private $session = null;

    protected function setUp()
    {
        $this->fileUploader = $this->createMock(FileUploaderInterface::class);
        $this->session = $this->createMock(SessionInterface::class);
    }

    public function testItImplements()
    {
        $dt = new ImageElementCollectionDataTransformer($this->fileUploader, $this->session);

        static::assertInstanceOf(ImageElementCollectionDataTransformer::class, $dt);
    }

    /**
     * @throws \Exception
     */
    public function testItReverseTransforms()
    {
        $dt = $this->createMock(ImageElementCollectionDataTransformer::class);

        $picture = $this->createMock(PictureInterface::class);
        $this->fileUploader->method('upload')->willReturn('test');

        $image = new ImageCollection($picture);
        $dt->method('reverseTransform')->willReturn($image);

        static::assertInstanceOf(ImageCollection::class, $image);
    }
}
