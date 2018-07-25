<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use App\Entity\ElementCollection;
use Symfony\Component\Form\FormInterface;

interface EditElementCollectionHandlerInterface
{
    public function handle(FormInterface $form, ElementCollection $element) : bool;
}