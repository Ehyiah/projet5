<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\AddElementCollectionHandler;
use App\UI\Form\Handler\ElementCollection\Interfaces\AddElementCollectionHandlerInterface;
use App\UI\Responder\ElementCollection\AddElementFromCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AddElementCollectionFromCollectionActionInterface
{
    /**
     * AddElementCollectionFromCollectionActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param CollectionRepositoryInterface $collection
     * @param AddElementCollectionHandlerInterface $handler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CollectionRepositoryInterface $collection,
        AddElementCollectionHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param $id
     * @param AddElementFromCollectionResponder $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        $id,
        AddElementFromCollectionResponder $responder
    );
}