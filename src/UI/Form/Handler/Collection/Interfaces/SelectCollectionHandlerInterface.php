<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface SelectCollectionHandlerInterface
{
    public function __construct(CollectionRepositoryInterface $collections);

    public function handle(FormInterface $form);
}