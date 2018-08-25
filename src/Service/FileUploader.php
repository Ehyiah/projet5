<?php

namespace App\Service;

use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 */
class FileUploader implements FileUploaderInterface
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * FileUploader constructor.
     *
     * {@inheritdoc}
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(UploadedFile $file, string $fileName)
    {
        $file->move($this->getTargetDirectory(), $fileName);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
