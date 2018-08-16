<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface SelectCollectionHandlerInterface
{
    public function __construct(CategoryCollectionRepositoryInterface $categoryRepository);

    public function handle(FormInterface $form);
}