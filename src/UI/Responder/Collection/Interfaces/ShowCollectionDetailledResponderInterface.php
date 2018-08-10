<?php

namespace App\UI\Responder\Collection\Interfaces;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ShowCollectionDetailledResponderInterface
{
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    );

    public function __invoke(
        $redirect = false,
        $collection = null
    );
}