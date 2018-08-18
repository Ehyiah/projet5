<?php

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface LoginResponderInterface
{
    /**
     * LoginResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param bool $redirect
     * @param FormInterface|null $loginType
     *
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        FormInterface $loginType = null
    );
}
