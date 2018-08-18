<?php

namespace App\UI\Responder\Category\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface SelectCollectionResponderInterface
{
    /**
     * SelectCollectionResponderInterface constructor.
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
     * @param FormInterface|null $form
     *
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        FormInterface $form = null
    );
}
