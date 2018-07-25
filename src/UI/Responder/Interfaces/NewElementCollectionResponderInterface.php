<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;

interface NewElementCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}