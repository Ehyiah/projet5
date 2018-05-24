<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 24/05/2018
 * Time: 18:08
 */

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