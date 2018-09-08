<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface DeleteCollectionActionInterface
{
    /**
     * DeleteCollectionActionInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param Filesystem $fileSystem
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ElementCollectionRepositoryInterface $elementRepository,
        Filesystem $fileSystem
    );

    /**
     * @param Request $request
     * @param $id
     *
     * @return Response
     */
    public function __invoke(Request $request, $id): Response;
}
