<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\Collection;
use App\Entity\Interfaces\CollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class CollectionRepository extends ServiceEntityRepository implements CollectionRepositoryInterface
{
    /**
     * CollectionRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
     parent::__construct($registry, Collection::class);
    }

    public function save(CollectionInterface $collection): void
    {
        $this->_em->persist($collection);
        $this->_em->flush();
    }
}