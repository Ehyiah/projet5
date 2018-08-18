<?php

namespace App\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    /**
     * FileUploaderInterface constructor.
     *
     * @param $targetDirectory
     */
    public function __construct($targetDirectory);

    /**
     * @param UploadedFile $file
     * @param string $fileName
     *
     * @return mixed
     */
    public function upload(UploadedFile $file, string $fileName);

    /**
     * @return mixed|string
     */
    public function getTargetDirectory();
}