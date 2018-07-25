<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;

interface RegistrationResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $registrationType = null
    );
}