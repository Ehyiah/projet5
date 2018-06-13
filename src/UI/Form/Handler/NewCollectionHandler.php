<?php

namespace App\UI\Form\Handler;


use App\Entity\Collection;
use App\Entity\ImageCollection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use App\Service\FileUploader;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewCollectionHandler implements NewCollectionHandlerInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * @var ImageRepositoryInterface
     */
    private $image;


    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @var ImageRepositoryInterface
     */
    private $imageRepository;


    /**
     * NewCollectionHandler constructor.
     *
     * @param CollectionRepositoryInterface $collection
     * @param ImageRepositoryInterface $image
     * @param FileUploader $fileUploader
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(
        CollectionRepositoryInterface $collection,
        ImageRepositoryInterface $image,
        FileUploader $fileUploader,
        ImageRepositoryInterface $imageRepository
    ) {
        $this->collection = $collection;
        $this->image = $image;
        $this->fileUploader = $fileUploader;
        $this->imageRepository = $imageRepository;
    }


    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {


            if ($form->getData()->image->image != null) {
                // traitement de l'image
                // et changement de title depuis formulaire
                $form->getData()->image->title = $this->fileUploader->upload($form->getData()->image->image);

                // instantion d'une nouvelle ImageCollection
                $imageData = new ImageCollection($form->getData()->image);

                // insertion des données de l'image dans le formulaire
                $form->getData()->image = $imageData;


                // instantiation d'une nouvelle Collection avec les bonnes data
                $newCollection = new Collection($form->getData());

                // insertion dans la BDD
                $this->collection->save($newCollection);
            }


            if ($form->getData()->image->image == null) {
                $form->getData()->image = null;

                // instantiation d'une nouvelle Collection avec les bonnes data
                $newCollection = new Collection($form->getData());

                // insertion dans la BDD
                $this->collection->save($newCollection);
            }
            return true;
        }

        return false;
    }
}