<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\UI\Form\Handler\ElementCollection\EditElementCollectionHandler;
use App\UI\Form\Handler\ElementCollection\Interfaces\EditElementCollectionHandlerInterface;
use App\UI\Responder\ElementCollection\EditElementCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface EditElementCollectionActionInterface
{
    /**
     * EditElementCollectionActionInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param FormFactoryInterface $formFactory
     * @param EditElementCollectionHandlerInterface $handler
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        FormFactoryInterface $formFactory,
        EditElementCollectionHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param EditElementCollectionResponder $responder
     * @param $id
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        EditElementCollectionResponder $responder,
        $id
    );
}