<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryRepositoryInterface;
use App\UI\Form\Handler\Collection\SelectCollectionHandler;
use App\UI\Responder\Collection\SelectCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface SelectionCollectionActionInterface
{
    public function __construct(
        FormFactoryInterface $formFactory,
        CategoryRepositoryInterface $categoryCollection
    );

    public function __invoke(
        Request $request,
        SelectCollectionHandler $collectionHandler,
        SelectCollectionResponder $responder
    );
}