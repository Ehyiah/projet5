<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 24/05/2018
 * Time: 18:15
 */

namespace App\Infra\Doctrine\Repository;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ImageCollectionInterface;
use App\Infra\Doctrine\Repository\Interfaces\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class ImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
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