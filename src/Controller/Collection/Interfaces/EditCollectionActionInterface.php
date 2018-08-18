<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Form\Handler\Collection\EditCollectionHandler;
use App\UI\Form\Handler\Collection\Interfaces\EditCollectionHandlerInterface;
use App\UI\Responder\Collection\EditCollectionResponder;
use App\UI\Responder\Collection\Interfaces\EditCollectionResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface EditCollectionActionInterface
{
    /**
     * EditCollectionActionInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param FormFactoryInterface $formFactory
     * @param EditCollectionHandlerInterface $handler
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        FormFactoryInterface $formFactory,
        EditCollectionHandlerInterface $handler
    );

    /**
     * @param Request $request
     * @param EditCollectionResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        EditCollectionResponderInterface $responder
    );
}