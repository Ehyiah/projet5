<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\ChangePasswordHandler;
use App\UI\Responder\Security\ChangePasswordResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ChangePasswordActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    public function __invoke(
        Request $request,
        ChangePasswordHandler $handler,
        ChangePasswordResponder $responder
    );
}