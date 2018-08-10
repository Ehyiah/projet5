<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\CategoryCollectionRepository;
use Symfony\Component\Form\FormInterface;

interface NewCategoryCollectionHandlerInterface
{
    public function __construct(CategoryCollectionRepository $categoryCollectionRepository);

    public function handle(FormInterface $form) : bool;
}