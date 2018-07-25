<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use Symfony\Component\Form\FormInterface;

interface ChangePasswordHandlerInterface
{
    public function handle(FormInterface $form);
}