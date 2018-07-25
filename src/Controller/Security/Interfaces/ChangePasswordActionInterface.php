<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\ChangePasswordHandler;
use App\UI\Responder\Security\ChangePasswordResponder;
use Symfony\Component\HttpFoundation\Request;

interface ChangePasswordActionInterface
{
    public function __invoke(
        Request $request,
        ChangePasswordHandler $handler,
        ChangePasswordResponder $responder
    );
}