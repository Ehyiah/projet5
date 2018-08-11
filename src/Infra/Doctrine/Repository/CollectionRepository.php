<?php

namespace App\Infra\Doctrine\Repository;


use App\Entity\Collection;
use App\Entity\ImageCollection;
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
     * @param CollectionInterface $collection
     */
    public function edit(CollectionInterface $collection) : void
    {
        $this->_em->flush();
    }

    /**
     * @param CollectionInterface $collection
     */
    public function remove(CollectionInterface $collection)
    {
        $this->_em->remove($collection);
        $this->_em->flush();
    }

    /**
     * @param ImageCollection $imageCollection
     */
    public function removeImage(ImageCollection $imageCollection)
    {
        $this->_em->remove($imageCollection);
        $this->_em->flush();
    }


    /**
     * @param $user
     * @param $category
     * @return mixed
     */
    public function findByOwnerAndCategory($user, $category)
    {
        return $this->createQueryBuilder('a')
            ->where('a.owner = :owner')
                ->setParameter('owner', $user)
            ->andWhere('a.category = :category')
                ->setParameter('category', $category)
            ->leftJoin('a.image', 'image')
                ->addSelect('image.title')
            ->leftJoin('a.elements_collection', 'elementsCollection')
                ->addSelect('elementsCollection')
        ->getQuery()
        ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCollection($id)
    {
        return $this->createQueryBuilder('a')
            ->where('a.id = :id')
                ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCollectionAndImageById($id)
    {
        return $this->createQueryBuilder('a')
            ->where('a.id = :id')
                ->setParameter('id', $id)
            ->leftJoin('a.image', 'image')
                ->addSelect('image.title')
        ->getQuery()
        ->getResult();
    }


    /**
     * @param $user
     * @return mixed
     */
    public function menuFindByOwnerAndCategory($user)
    {
        return $this->createQueryBuilder('c')
            ->where('c.owner = :owner')
                ->setParameter('owner', $user)
            ->leftJoin('c.category', 'category')
                ->addSelect('category')
            ->groupBy('category')

            ->getQuery()
            ->getResult();
    }

}