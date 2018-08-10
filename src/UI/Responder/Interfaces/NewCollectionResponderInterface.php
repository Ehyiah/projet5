<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface NewCollectionResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(
        $redirect = false,
        FormInterface $form =null
    );
}