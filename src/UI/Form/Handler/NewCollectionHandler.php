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
     * @param CollectionRepositoryInterface $collection
     */
    public function __construct(CollectionRepositoryInterface $collection)
    {
        $this->collection = $collection;
    }


    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            // instantiation d'une nouvelle Collection avec les bonnes data
            $newCollection = new Collection($form->getData());

            // insertion dans la BDD
            $this->collection->save($newCollection);

            return true;
        }

        return false;
    }
}