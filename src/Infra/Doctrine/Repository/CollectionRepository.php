<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\Collection;
use App\Entity\Interfaces\CollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CollectionRepository extends ServiceEntityRepository implements CollectionRepositoryInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $security;

    /**
     * CollectionRepository constructor.
     *
     * @param ManagerRegistry $registry
     * @param TokenStorageInterface $security
     */
    public function __construct(
        ManagerRegistry $registry,
        TokenStorageInterface $security
    ) {
     parent::__construct($registry, Collection::class);
     $this->security = $security;
    }


    /**
     * @param CollectionInterface $collection
     */
    public function save(CollectionInterface $collection): void
    {
        $this->_em->persist($collection);
        $this->_em->flush();
    }


    /**
     * @param $user
     * @param $category
     * @return mixed
     */
    public function findByOwnerAndCategory($user, $category)
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->where('a.owner = :owner')
                ->setParameter('owner', $user)
            ->andWhere('a.category = :category')
                ->setParameter('category', $category)
            ->leftJoin('a.image', 'image')
                ->addSelect('image.title')
        ;

        return $qb
            ->getQuery()
            ->getResult();
    }
}