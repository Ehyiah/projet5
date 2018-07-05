<?php

namespace App\UI\Form\Handler\Collection;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class EditCollectionHandler
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * EditCollectionHandler constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(CollectionRepositoryInterface $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    public function handle(FormInterface $form, Collection $collection) : bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $collection->edit($data);

            $this->collectionRepository->edit($collection);

            return true;
        }

        return false;
    }
}