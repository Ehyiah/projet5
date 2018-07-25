<?php

namespace App\UI\Form\Handler\ElementCollection\Interfaces;


use Symfony\Component\Form\FormInterface;

interface AddElementCollectionHandlerInterface
{
    public function handle(FormInterface $form): bool;
}