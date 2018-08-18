<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface NewElementCollectionHandlerInterface
{
    /**
     * NewElementCollectionHandlerInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $collectionRepository
     */
    public function __construct(ElementCollectionRepositoryInterface $collectionRepository);

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form) : bool;
}
