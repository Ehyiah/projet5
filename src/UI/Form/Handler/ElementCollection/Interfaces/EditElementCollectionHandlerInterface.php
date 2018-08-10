<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use App\Entity\ElementCollection;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface EditElementCollectionHandlerInterface
{
    public function __construct(ElementCollectionRepositoryInterface $elementRepository);

    public function handle(FormInterface $form, ElementCollection $element) : bool;
}