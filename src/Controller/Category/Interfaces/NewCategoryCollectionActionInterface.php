<?php

namespace App\Controller\Category\Interfaces;


use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Responder\NewImageCollectionResponder;
use Symfony\Component\HttpFoundation\Request;

interface NewCategoryCollectionActionInterface
{
    public function __invoke(
        Request $request,
        NewCategoryCollectionHandlerInterface $categoryCollectionHandler,
        NewImageCollectionResponder $responder
    );
}