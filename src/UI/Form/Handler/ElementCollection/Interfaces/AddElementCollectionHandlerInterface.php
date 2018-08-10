<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface AddElementCollectionHandlerInterface
{
    public function __construct(ElementCollectionRepositoryInterface $elementCollection);

    public function handle(FormInterface $form): bool;
}