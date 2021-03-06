<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\CategoryCollection;
use App\Entity\Interfaces\CategoryCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryCollection[]    findAll()
 * @method CategoryCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class CategoryCollectionRepository extends ServiceEntityRepository implements CategoryCollectionRepositoryInterface
{
    /**
     * CategoryCollectionRepository constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryCollection::class);
    }

    /**
     * {@inheritdoc}
     */
    public function save(CategoryCollectionInterface $categoryCollection) : void
    {
        $this->_em->persist($categoryCollection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(CategoryCollection $collection)
    {
        $this->_em->remove($collection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCategory($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
                ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}
