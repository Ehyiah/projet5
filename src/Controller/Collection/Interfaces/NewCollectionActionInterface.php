<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\NewCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface NewCollectionActionInterface
{
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory
    );

    public function __invoke(
        Request $request,
        NewCollectionHandlerInterface $collectionHandler,
        NewCollectionResponder $responder
    );
}