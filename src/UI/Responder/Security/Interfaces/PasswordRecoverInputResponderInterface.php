<?php

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface PasswordRecoverInputResponderInterface
{
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}