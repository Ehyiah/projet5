<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ImageCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ImageRepository
 */
final class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    /**
     * ImageRepository constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageCollection::class);
    }

    /**
     * {@inheritdoc}
     */
    public function save(ImageCollectionInterface $imageCollection) : void
    {
        $this->_em->persist($imageCollection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findImage($id)
    {
        return $this->createQueryBuilder('i')
            ->where('i.id = :id')
                ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}
