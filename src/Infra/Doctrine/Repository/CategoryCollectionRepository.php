<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryCollection[]    findAll()
 * @method CategoryCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryCollectionRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryCollection::class);
    }

    public function save(CategoryCollectionInterface $categoryCollection) : void
    {
        $this->_em->persist($categoryCollection);
        $this->_em->flush();
    }
}