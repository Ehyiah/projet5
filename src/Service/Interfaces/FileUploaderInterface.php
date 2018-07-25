<?php

namespace App\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    public function upload(UploadedFile $file);

    public function getTargetDirectory();
}