<?php

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface ChangePasswordResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}