<?php

namespace App\Controller\Security\Interfaces;


use App\UI\Responder\MemberResponder;
use Symfony\Component\HttpFoundation\Request;

interface MemberActionInterface
{
    public function __invoke(
        Request $request,
        MemberResponder $responder
    );
}