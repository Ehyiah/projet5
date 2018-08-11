<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

interface DeleteCollectionActionInterface
{
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ElementCollectionRepositoryInterface $elementRepository,
        Filesystem $fileSystem
    );

    public function __invoke(Request $request, $id);
}