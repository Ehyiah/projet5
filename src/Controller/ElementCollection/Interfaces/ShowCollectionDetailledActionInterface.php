<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\UI\Responder\Collection\ShowCollectionDetailledResponder;
use Symfony\Component\HttpFoundation\Request;

interface ShowCollectionDetailledActionInterface
{
    public function __invoke(
        Request $request,
        ShowCollectionDetailledResponder $responder,
        $idCollection
    );
}