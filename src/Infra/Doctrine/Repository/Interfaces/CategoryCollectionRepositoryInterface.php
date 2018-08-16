<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface CategoryCollectionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry);

    public function save(CategoryCollectionInterface $categoryCollection) : void;

    public function remove(CategoryCollection $collection);
}