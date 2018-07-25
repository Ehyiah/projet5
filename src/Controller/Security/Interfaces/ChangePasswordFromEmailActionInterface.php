<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\Security\ChangePasswordFromEmailHandler;
use App\UI\Responder\Security\ChangePasswordFromEmailResponder;
use Symfony\Component\HttpFoundation\Request;

interface ChangePasswordFromEmailActionInterface
{
    public function __invoke(
        Request $request,
        ChangePasswordFromEmailResponder $responder,
        ChangePasswordFromEmailHandler $handler,
        $token
    );
}