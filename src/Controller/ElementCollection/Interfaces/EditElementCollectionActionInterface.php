<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\UI\Form\Handler\ElementCollection\EditElementCollectionHandler;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface EditElementCollectionActionInterface
{
    public function __invoke(
        Request $request,
        EditElementCollectionResponder $responder,
        EditElementCollectionHandler $handler,
        $id
    );
}