<?php

namespace App\UI\Form\Handler;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

class NewCollectionHandler implements NewCollectionHandlerInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collection;

    /**
     * NewCollectionHandler constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(CollectionRepositoryInterface $collectionRepository)
    {
        $this->collection = $collectionRepository;
    }

    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $newCollection = new Collection($form->getData());
            $this->collection->save($newCollection);

            return true;
        }

        return false;
    }
}