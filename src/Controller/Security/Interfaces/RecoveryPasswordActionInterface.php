<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\PasswordRecoverInputHandler;
use App\UI\Responder\Security\PasswordRecoverInputResponder;
use Symfony\Component\HttpFoundation\Request;

interface RecoveryPasswordActionInterface
{
    public function __invoke(
        Request $request,
        PasswordRecoverInputResponder $responder,
        PasswordRecoverInputHandler $handler
    );
}