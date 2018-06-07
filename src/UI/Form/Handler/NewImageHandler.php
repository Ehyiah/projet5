<?php

namespace App\UI\Form\Handler;


use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\FileUploader;
use App\UI\Form\Handler\Interfaces\NewImageHandlerInterface;
use Symfony\Component\Form\FormInterface;

final class NewImageHandler implements NewImageHandlerInterface
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * NewImageHandler constructor.
     * @param FileUploader $fileUploader
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(FileUploader $fileUploader, ImageRepositoryInterface $imageRepository)
    {
        $this->fileUploader = $fileUploader;
        $this->imageRepository = $imageRepository;
    }


    public function handle(FormInterface $form): bool
    {
         if ($form->isSubmitted() && $form->isValid()) {
             $form->getData()->title = $this->fileUploader->upload($form->getData()->image);

             $image = new ImageCollection($form->getData());

             $this->imageRepository->save($image);

            return true;
        }

        return false;
    }
}