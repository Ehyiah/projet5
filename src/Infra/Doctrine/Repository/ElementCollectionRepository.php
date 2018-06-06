<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\ElementCollection;
use App\Entity\Interfaces\ElementCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ElementCollectionRepository extends ServiceEntityRepository implements ElementCollectionRepositoryInterface
{
    /**
     * ElementCollectionRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementCollection::class);
    }

    public function save(ElementCollectionInterface $elementCollection): void
    {
        $this->_em->persist($elementCollection);
        $this->_em->flush();
    }
}