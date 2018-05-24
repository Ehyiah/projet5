<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     */
    private $target_directory;


    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->target_directory;
    }

    /**
     * @param string $target_directory
     */
    public function setTargetDirectory(string $target_directory): void
    {
        $this->target_directory = $target_directory;
    }




    /**
     * FileUploader constructor.
     *
     * @param string $target_directory
     */
    public function __construct(string $target_directory)
    {
        $this->target_directory = $target_directory;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }
}