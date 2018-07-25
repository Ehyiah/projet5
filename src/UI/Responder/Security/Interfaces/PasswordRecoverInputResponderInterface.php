<?php

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Form\FormInterface;

interface PasswordRecoverInputResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}