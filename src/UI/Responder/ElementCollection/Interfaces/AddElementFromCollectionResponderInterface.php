<?php

namespace App\UI\Responder\ElementCollection\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddElementFromCollectionResponderInterface
{
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    );

    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}