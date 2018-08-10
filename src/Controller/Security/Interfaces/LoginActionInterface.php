<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\LoginHandler;
use App\UI\Responder\LoginResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

Interface LoginActionInterface
{
    public function __construct(
        EncoderFactoryInterface $encoder,
        FormFactoryInterface $formFactory,
        LoginHandler $loginHandler,
        AuthenticationUtils $authenticationUtils
    );

    public function __invoke(
        Request $request,
        LoginHandler $loginHandler,
        LoginResponder $responder
    );
}