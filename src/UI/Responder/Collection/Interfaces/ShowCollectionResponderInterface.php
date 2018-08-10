<?php

namespace App\UI\Responder\Collection\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ShowCollectionResponderInterface
{
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    public function __invoke(
        $redirect = false,
        $collections = null
    );
}