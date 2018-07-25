<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Responder\Collection\ShowCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface ShowCollectionActionInterface
{
    public function __invoke(
        Request $request,
        ShowCollectionResponder $responder,
        $id = null
    );
}