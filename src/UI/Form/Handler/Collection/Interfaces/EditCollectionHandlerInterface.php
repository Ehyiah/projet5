<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface EditCollectionHandlerInterface
{
    public function __construct(CollectionRepositoryInterface $collectionRepository);

    public function handle(FormInterface $form, Collection $collection) : bool;
}