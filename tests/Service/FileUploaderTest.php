<?php

namespace App\Tests\Service;


use App\Service\FileUploader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploaderTest
 * @group Service
 */
final class FileUploaderTest extends TestCase
{
    /**
     * @var string
     */
    private $targetDirectory;

    protected function setUp()
    {
        $this->targetDirectory = 'test';
    }

    public function testItImplements()
    {
        $fileUploader = new FileUploader($this->targetDirectory);

        static::assertInstanceOf(FileUploader::class, $fileUploader);
    }

    public function testItUploads()
    {
        $fileUploader = new FileUploader($this->targetDirectory);
        $fileMock = $this->createMock(UploadedFile::class);

        static::assertTrue(
            $fileUploader->upload($fileMock, 'test'));

    }
}
