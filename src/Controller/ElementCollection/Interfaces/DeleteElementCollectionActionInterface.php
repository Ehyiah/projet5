<?php

namespace App\Controller\ElementCollection\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

interface DeleteElementCollectionActionInterface
{
    /**
     * DeleteElementCollectionActionInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     * @param Filesystem $fileSystem
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository,
        Filesystem $fileSystem
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