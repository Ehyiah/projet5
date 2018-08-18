<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface SelectCollectionHandlerInterface
{
    /**
     * SelectCollectionHandlerInterface constructor.
     *
     * @param CategoryCollectionRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryCollectionRepositoryInterface $categoryRepository);

    /**
     * @param FormInterface $form
     *
     * @return mixed
     */
    public function handle(FormInterface $form);
}