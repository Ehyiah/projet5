<?php

namespace App\Tests\UI\Form\Handler;


use App\Domain\DTO\AddElementImageDTO;
use App\Domain\ValueObject\Interfaces\PictureInterface;
use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\Handler\NewImageHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class NewImageHandlerTest
 * @group Handler
 */
final class NewImageHandlerTest extends TestCase
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    protected function setUp()
    {
        $this->fileUploader = $this->createMock(FileUploaderInterface::class);
        $this->imageRepository = $this->createMock(ImageRepositoryInterface::class);
    }

    public function testItImplements()
    {
        $handler = new NewImageHandler(
            $this->fileUploader,
            $this->imageRepository
        );

        static::assertInstanceOf(NewImageHandler::class, $handler);
    }

}
