<?php

namespace App\UI\Responder\ElementCollection\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface EditElementCollectionResponderInterface
{
    /**
     * EditElementCollectionResponderInterface constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     * @param SessionInterface $session
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        SessionInterface $session
    ) ;

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
