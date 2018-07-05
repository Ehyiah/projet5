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

    /**
     * @param ElementCollectionInterface $elementCollection
     */
    public function save(ElementCollectionInterface $elementCollection): void
    {
        $this->_em->persist($elementCollection);
        $this->_em->flush();
    }

    /**
     * @param $elementCollection
     */
    public function edit($elementCollection)
    {
        $this->_em->flush();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCollectionById($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.collection_name = :collectionID')
                ->setParameter('collectionID', $id)
            ->leftJoin('c.images', 'images')
                ->addSelect('images')

            ->getQuery()
            ->getResult();
    }
}