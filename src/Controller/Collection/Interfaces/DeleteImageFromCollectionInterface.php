<?php

namespace App\Controller\Collection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteImageFromCollectionInterface
{
    /**
     * DeleteImageFromCollectionInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        ImageRepositoryInterface $imageRepository
    );

    /**
     * @param Request $request
     * @param $id
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        $id
    );
}