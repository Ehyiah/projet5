<?php

namespace App\UI\Form\Handler;


use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\Interfaces\FileUploaderInterface;
use App\UI\Form\Handler\Interfaces\NewImageHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class NewImageHandler
 */
final class NewImageHandler implements NewImageHandlerInterface
{
    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;


    /**
     * NewImageHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        FileUploaderInterface $fileUploader,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->fileUploader = $fileUploader;
        $this->imageRepository = $imageRepository;
    }

    /**
     * {@inheritdoc}
     */
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
