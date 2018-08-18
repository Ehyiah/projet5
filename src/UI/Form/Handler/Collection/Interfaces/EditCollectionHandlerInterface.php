<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface EditCollectionHandlerInterface
{
    /**
     * EditCollectionHandlerInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(CollectionRepositoryInterface $collectionRepository);

    /**
     * @param FormInterface $form
     * @param Collection $collection
     *
     * @return bool
     */
    public function handle(FormInterface $form, Collection $collection) : bool;
}
