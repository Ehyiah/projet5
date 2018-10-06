<?php

namespace App\Controller\Collection\Interfaces;


use App\UI\Form\Handler\Interfaces\NewCollectionHandlerInterface;
use App\UI\Responder\Interfaces\NewCollectionResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface NewCollectionActionInterface
{
    /**
     * NewCollectionActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param NewCollectionHandlerInterface $handler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        NewCollectionHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param NewCollectionResponderInterface $responder
     *
     * @return Response
     */
    public function __invoke(
        Request $request,
        NewCollectionResponderInterface $responder
    ): Response;
}
