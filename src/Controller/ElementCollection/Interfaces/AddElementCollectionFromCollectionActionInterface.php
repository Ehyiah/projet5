<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\AddElementCollectionHandler;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddElementCollectionFromCollectionActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        CollectionRepositoryInterface $collection
    );

    public function __invoke(
        Request $request,
        $id,
        AddElementCollectionHandler $handler,
        AddElementFromCollectionResponder $responder
    );
}