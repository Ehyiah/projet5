<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\EditElementCollectionHandler;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface EditElementCollectionActionInterface
{
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        FormFactoryInterface $formFactory
    );

    public function __invoke(
        Request $request,
        EditElementCollectionResponder $responder,
        EditElementCollectionHandler $handler,
        $id
    );
}