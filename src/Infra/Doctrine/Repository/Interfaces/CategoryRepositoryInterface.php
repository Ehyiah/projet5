<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\CategoryCollectionInterface;

interface CategoryRepositoryInterface
{
    public function save(CategoryCollectionInterface $categoryCollection) : void;
}