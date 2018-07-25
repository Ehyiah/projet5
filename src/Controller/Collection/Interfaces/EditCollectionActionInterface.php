<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Form\Handler\Collection\EditCollectionHandler;
use App\UI\Responder\Collection\EditCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface EditCollectionActionInterface
{
    public function __invoke(
        Request $request,
        EditCollectionResponder $responder,
        EditCollectionHandler $handler
    );
}