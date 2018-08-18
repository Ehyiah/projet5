<?php

namespace App\UI\Form\Handler\Collection;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\EditCollectionHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class EditCollectionHandler
 */
final class EditCollectionHandler implements EditCollectionHandlerInterface
{
    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * EditCollectionHandler constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(CollectionRepositoryInterface $collectionRepository)
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
