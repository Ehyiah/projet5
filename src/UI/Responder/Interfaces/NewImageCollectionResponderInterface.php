<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;

interface NewImageCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}