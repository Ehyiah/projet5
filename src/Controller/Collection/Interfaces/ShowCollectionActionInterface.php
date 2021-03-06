<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\UI\Responder\Collection\ShowCollectionResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface ShowCollectionActionInterface
{
    /**
     * ShowCollectionActionInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param TokenStorageInterface $security
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        TokenStorageInterface $security
    );

    /**
     * @param Request $request
     * @param ShowCollectionResponder $responder
     * @param null $id
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        ShowCollectionResponder $responder,
        $id = null
    );
}