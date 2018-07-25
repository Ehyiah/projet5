<?php

namespace App\Controller\ElementCollection\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface DeleteElementCollectionActionInterface
{
    public function __invoke(
        Request $request,
        $id
    );
}