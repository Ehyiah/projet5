<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewElementCollectionHandlerInterface;
use App\UI\Responder\NewElementCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface NewElementCollectionActionInterface
{
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory
    );

    public function __invoke(
        Request $request,
        NewElementCollectionHandlerInterface $newElementCollectionHandler,
        NewElementCollectionResponder $responder
    );
}