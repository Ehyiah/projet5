<?php

namespace App\Controller\Collection\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface DeleteCollectionActionInterface
{
    public function __invoke(Request $request, $id);
}