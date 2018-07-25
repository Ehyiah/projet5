<?php

namespace App\UI\Responder\Collection\Interfaces;


use Symfony\Component\Form\FormInterface;

interface EditCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}