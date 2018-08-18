<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

interface DeleteImageFromElementCollectionActionInterface
{
    /**
     * DeleteImageFromElementCollectionActionInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param ImageRepositoryInterface $imageRepository
     * @param Filesystem $filesystem
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        ImageRepositoryInterface $imageRepository,
        Filesystem $filesystem
    );

    /**
     * @param Request $request
     * @param $idElement
     * @param $id
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        $idElement,
        $id
    );
}