<?php

namespace App\UI\Responder\Category\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface SelectCollectionResponderInterface
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