<?php

namespace App\Repository;


use App\Entity\ElementCollection;
use App\Entity\ImageCollection;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ElementCollectionRepository
 */
final class ElementCollectionRepository extends ServiceEntityRepository
{
    /**
     * ElementCollectionRepository constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementCollection::class);
    }

    /**
     * {@inheritdoc}
     */
    public function save(ElementCollectionInterface $elementCollection): void
    {
        $this->_em->persist($elementCollection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function edit(ElementCollectionInterface $elementCollection)
    {
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($elementCollection)
    {
        $this->_em->remove($elementCollection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageCollection $imageCollection)
    {
        $this->_em->remove($imageCollection);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
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
