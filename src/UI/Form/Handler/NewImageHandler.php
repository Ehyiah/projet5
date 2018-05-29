<?php

namespace App\UI\Form\Handler;


use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewImageHandlerInterface;
use Symfony\Component\Form\FormInterface;

final class NewImageHandler implements NewImageHandlerInterface
{
    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;

    /**
     * NewImageHandler constructor.
     *
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function handle(FormInterface $form): bool
    {
         if ($form->isSubmitted() && $form->isValid()) {
            $image = new ImageCollection($form->getData());
            $this->imageRepository->save($image);

            return true;
        }

        return false;
    }
}