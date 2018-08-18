<?php

namespace App\UI\Responder\Collection\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ShowCollectionResponderInterface
{
    /**
     * ShowCollectionResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    /**
     * @param bool $redirect
     * @param null $collections
     *
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        $collections = null
    );
}
