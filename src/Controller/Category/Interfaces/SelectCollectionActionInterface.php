<?php

namespace App\Controller\Category\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\Interfaces\SelectCollectionHandlerInterface;
use App\UI\Responder\Category\SelectCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface SelectCollectionActionInterface
{
    /**
     * SelectCollectionActionInterface constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param CategoryCollectionRepositoryInterface $categoryCollection
     * @param SelectCollectionHandlerInterface $handler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryCollectionRepositoryInterface $categoryCollection,
        SelectCollectionHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param SelectCollectionResponder $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        SelectCollectionResponder $responder
    );
}
