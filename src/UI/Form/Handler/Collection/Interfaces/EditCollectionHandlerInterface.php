<?php

namespace App\UI\Form\Handler\Collection\Interfaces;


use App\Entity\Collection;
use Symfony\Component\Form\FormInterface;

interface EditCollectionHandlerInterface
{
    public function handle(FormInterface $form, Collection $collection) : bool;
}