<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\CategoryCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry);

    public function save(CategoryCollectionInterface $categoryCollection) : void;
}