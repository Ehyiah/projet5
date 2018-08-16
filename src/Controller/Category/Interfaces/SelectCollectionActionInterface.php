<?php

namespace App\Controller\Category\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use App\UI\Responder\Category\SelectCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface SelectCollectionActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryCollectionRepositoryInterface $categoryCollection
    );

    public function __invoke(
        Request $request,
        SelectCollectionHandler $collectionHandler,
        SelectCollectionResponder $responder
    );
}