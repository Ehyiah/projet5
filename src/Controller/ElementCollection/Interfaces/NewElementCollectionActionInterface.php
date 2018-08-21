<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\Interfaces\NewElementCollectionResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface NewElementCollectionActionInterface
{
    /**
     * NewElementCollectionActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param NewElementCollectionHandlerInterface $handler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        NewElementCollectionHandlerInterface $handler
    ) ;

    /**
     * @param Request $request
     * @param NewElementCollectionResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        NewElementCollectionResponderInterface $responder
    );
}