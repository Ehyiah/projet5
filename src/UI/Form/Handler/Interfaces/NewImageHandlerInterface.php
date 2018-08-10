<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\FileUploader;
use Symfony\Component\Form\FormInterface;

interface NewImageHandlerInterface
{
    public function __construct(
        FileUploader $fileUploader,
        ImageRepositoryInterface $imageRepository
    );

    public function handle(FormInterface $form): bool;
}