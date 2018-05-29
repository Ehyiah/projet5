<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ImageCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    /**
     * ImageRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageCollection::class);
    }

    public function save(ImageCollectionInterface $imageCollection) : void
    {
        $this->_em->persist($imageCollection);
        $this->_em->flush();
    }
}