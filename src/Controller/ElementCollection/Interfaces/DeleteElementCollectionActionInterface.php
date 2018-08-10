<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteElementCollectionActionInterface
{
    public function __construct(ElementCollectionRepositoryInterface $elementRepository);

    public function __invoke(
        Request $request,
        $id
    );
}