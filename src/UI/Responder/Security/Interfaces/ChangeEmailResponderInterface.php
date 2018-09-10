<?php

namespace App\UI\Responder\Security\Interfaces;


use Symfony\Component\Form\FormInterface;
use Twig\Environment;

interface ChangeEmailResponderInterface
{
    /**
     * ChangeEmailResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param bool $redirect
     * @param FormInterface $form
     *
     * @return mixed
     */
    public function __invoke($redirect = false, FormInterface $form = null);
}
