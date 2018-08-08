<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\NewCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface NewCollectionActionInterface
{
    public function __invoke(
        Request $request,
        NewCollectionHandlerInterface $collectionHandler,
        NewCollectionResponder $responder
    );
}