<?php

namespace App\Controller\ElementCollection\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface DeleteImageFromElementCollectionActionInterface
{
    public function __invoke(
        Request $request,
        $idElement,
        $id
    );
}