<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface RegistrationResponderInterface
{
    /**
     * RegistrationResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param bool $redirect
     * @param FormInterface|null $registrationType
     *
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        FormInterface $registrationType = null
    );
}
