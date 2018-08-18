<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Interfaces\LoginHandlerInterface;
use App\UI\Form\Handler\LoginHandler;
use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

Interface LoginActionInterface
{
    /**
     * LoginActionInterface constructor.
     *
     * @param EncoderFactoryInterface $encoder
     * @param FormFactoryInterface $formFactory
     * @param LoginHandler $loginHandler
     * @param AuthenticationUtils $authenticationUtils
     * @param LoginHandlerInterface $handler
     */
    public function __construct(
        EncoderFactoryInterface $encoder,
        FormFactoryInterface $formFactory,
        LoginHandler $loginHandler,
        AuthenticationUtils $authenticationUtils,
        LoginHandlerInterface $handler
    ) ;

    /**
     * @param Request $request
     * @param LoginResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        LoginResponderInterface $responder
    );
}