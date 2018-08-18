<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface NewCategoryCollectionHandlerInterface
{
    /**
     * NewCategoryCollectionHandlerInterface constructor.
     *
     * @param CategoryCollectionRepositoryInterface $categoryCollectionRepository
     */
    public function __construct(CategoryCollectionRepositoryInterface $categoryCollectionRepository);

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form) : bool;
}
