<?php

namespace App\UI\Form\Handler\Interfaces;


use Symfony\Component\Form\FormInterface;

interface NewUserHandlerInterface
{
    public function handle(FormInterface $form) : bool;
}