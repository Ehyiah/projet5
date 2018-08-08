<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Form\Handler\LoginHandler;
use App\UI\Responder\LoginResponder;
use Symfony\Component\HttpFoundation\Request;

Interface LoginActionInterface
{
    public function __invoke(
        Request $request,
        LoginHandler $loginHandler,
        LoginResponder $responder
    );
}