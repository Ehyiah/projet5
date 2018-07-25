<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;

interface NewCategoryCollectionResponderInterface
{
    public function __invoke(
        $redirect = false,
        FormInterface $form
    );
}