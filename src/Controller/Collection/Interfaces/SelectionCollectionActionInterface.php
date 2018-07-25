<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use App\UI\Responder\Collection\SelectCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface SelectionCollectionActionInterface
{
    public function __invoke(
        Request $request,
        SelectCollectionHandler $collectionHandler,
        SelectCollectionResponder $responder
    );
}