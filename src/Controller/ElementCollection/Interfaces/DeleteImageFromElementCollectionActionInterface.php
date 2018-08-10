<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteImageFromElementCollectionActionInterface
{
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        ImageRepositoryInterface $imageRepository
    );

    public function __invoke(
        Request $request,
        $idElement,
        $id
    );
}