<?php

namespace App\UI\Form\Handler\Security\Interfaces;


use Symfony\Component\Form\FormInterface;

interface PasswordRecoverInputHandlerInterface
{
    public function handle(FormInterface $form);
}