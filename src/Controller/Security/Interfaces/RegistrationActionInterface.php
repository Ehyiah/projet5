<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

interface RegistrationActionInterface
{
    /**
     * RegistrationActionInterface constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     * @param NewUserHandlerInterface $handler
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        Environment $twig,
        UrlGeneratorInterface $urlGenerator,
        NewUserHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param RegistrationResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        RegistrationResponderInterface $responder
    );
}
