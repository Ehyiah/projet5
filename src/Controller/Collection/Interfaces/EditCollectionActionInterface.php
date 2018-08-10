<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\EditCollectionHandler;
use App\UI\Responder\Collection\EditCollectionResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface EditCollectionActionInterface
{
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        FormFactoryInterface $formFactory
    );

    public function __invoke(
        Request $request,
        EditCollectionResponder $responder,
        EditCollectionHandler $handler
    );
}