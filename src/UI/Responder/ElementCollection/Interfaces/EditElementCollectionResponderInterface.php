<?php

namespace App\UI\Responder\ElementCollection\Interfaces;


use Symfony\Component\Form\FormInterface;

interface EditElementCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}