<?php

namespace App\UI\Form\Handler\Collection;

use App\Entity\Collection;
use App\Repository\CollectionRepository;
use Symfony\Component\Form\FormInterface;

/**
 * Class EditCollectionHandler
 */
final class EditCollectionHandler
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;

    /**
     * EditCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * {@inheritdoc}
     */
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
