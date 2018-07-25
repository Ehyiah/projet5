<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;

interface LoginResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $loginType = null
    );
}