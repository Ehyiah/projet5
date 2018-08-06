<?php

namespace App\Service;

use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader implements FileUploaderInterface
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * FileUploader constructor.
     *
     * @param $targetDirectory
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @param string $fileName
     */
    public function upload(UploadedFile $file, string $fileName)
    {
        $file->move($this->getTargetDirectory(), $fileName);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}