<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\Interfaces\FileUploaderInterface;
use Symfony\Component\Form\FormInterface;

interface NewImageHandlerInterface
{
    /**
     * NewImageHandlerInterface constructor.
     *
     * @param FileUploaderInterface $fileUploader
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(
        FileUploaderInterface $fileUploader,
        ImageRepositoryInterface $imageRepository
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
