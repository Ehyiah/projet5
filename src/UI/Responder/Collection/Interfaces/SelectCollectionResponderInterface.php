<?php

namespace App\UI\Responder\Collection\Interfaces;


use Symfony\Component\Form\FormInterface;

interface SelectCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}