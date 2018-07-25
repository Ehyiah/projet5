<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use Symfony\Component\Form\FormInterface;

interface SelectCollectionHandlerInterface
{
    public function handle(FormInterface $form);
}