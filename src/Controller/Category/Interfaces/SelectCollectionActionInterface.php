<?php

namespace App\Controller\Category\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
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
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryCollectionRepositoryInterface $categoryCollection
    );

    /**
     * @param Request $request
     * @param SelectCollectionHandler $collectionHandler
     * @param SelectCollectionResponder $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        SelectCollectionHandler $collectionHandler,
        SelectCollectionResponder $responder
    );
}