<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\Interfaces\PasswordRecoverInputHandlerInterface;
use App\UI\Responder\Security\Interfaces\PasswordRecoverInputResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface RecoveryPasswordActionInterface
{
    /**
     * RecoveryPasswordActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param PasswordRecoverInputHandlerInterface $handler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        PasswordRecoverInputHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param PasswordRecoverInputResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        PasswordRecoverInputResponderInterface $responder
    );
}
