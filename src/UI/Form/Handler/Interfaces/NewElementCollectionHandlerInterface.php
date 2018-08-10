<?php

namespace App\UI\Form\Handler\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface NewElementCollectionHandlerInterface
{
    public function __construct(ElementCollectionRepositoryInterface $collectionRepository);

    public function handle(FormInterface $form) : bool;
}