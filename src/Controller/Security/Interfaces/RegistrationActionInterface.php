<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Interfaces\NewUserHandlerInterface;
use App\UI\Responder\RegistrationResponder;
use Symfony\Component\HttpFoundation\Request;

interface RegistrationActionInterface
{
    public function __invoke(
        Request $request,
        NewUserHandlerInterface $userHandler,
        RegistrationResponder $responder
    );
}