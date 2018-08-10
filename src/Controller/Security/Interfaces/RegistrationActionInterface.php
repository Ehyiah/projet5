<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\RegistrationResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

interface RegistrationActionInterface
{
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator
    );

    public function __invoke(
        Request $request,
        NewUserHandlerInterface $userHandler,
        RegistrationResponder $responder
    );
}