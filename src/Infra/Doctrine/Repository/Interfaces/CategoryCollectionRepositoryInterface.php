<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface CategoryCollectionRepositoryInterface
{
    /**
     * CategoryCollectionRepositoryInterface constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry);

    /**
     * @param CategoryCollectionInterface $categoryCollection
     */
    public function save(CategoryCollectionInterface $categoryCollection) : void;

    /**
     * @param CategoryCollection $collection
     *
     * @return mixed
     */
    public function remove(CategoryCollection $collection);
}