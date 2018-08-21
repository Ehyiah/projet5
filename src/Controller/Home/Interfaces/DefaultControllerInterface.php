<?php

namespace App\Controller\Home\Interfaces;


use Symfony\Component\HttpFoundation\Response;

interface DefaultControllerInterface
{
    /**
     * @return Response
     */
    public function __invoke(): Response;
}