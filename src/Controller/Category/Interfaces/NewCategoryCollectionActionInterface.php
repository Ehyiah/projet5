<?php

namespace App\Controller\Category\Interfaces;


use App\UI\Form\Handler\Interfaces\NewCategoryCollectionHandlerInterface;
use App\UI\Responder\NewImageCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface NewCategoryCollectionActionInterface
{
    /**
     * NewCategoryCollectionActionInterface constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param FormFactoryInterface $formFactory
     * @param NewCategoryCollectionHandlerInterface $formHandler
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        FormFactoryInterface $formFactory,
        NewCategoryCollectionHandlerInterface $formHandler
    );

    /**
     * @param Request $request
     * @param NewImageCollectionResponder $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        NewImageCollectionResponder $responder
    );
}