<?php

namespace App\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    public function upload(UploadedFile $file, string $fileName);

    public function getTargetDirectory();
}