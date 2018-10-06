<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\Interfaces\RegistrationResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface RegistrationActionInterface
{
    /**
     * RegistrationActionInterface constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     * @param NewUserHandlerInterface $handler
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        NewUserHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param RegistrationResponderInterface $responder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        RegistrationResponderInterface $responder
    ): Response;
}
