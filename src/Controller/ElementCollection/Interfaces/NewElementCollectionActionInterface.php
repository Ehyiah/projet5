<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\NewElementCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface NewElementCollectionActionInterface
{
    public function __invoke(
        Request $request,
        NewElementCollectionHandlerInterface $newElementCollectionHandler,
        NewElementCollectionResponder $responder
    );
}