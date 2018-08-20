<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Collection;
use App\Entity\ImageCollection;
use App\Entity\Interfaces\CollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface CollectionRepositoryInterface
{
    /**
     * CollectionRepositoryInterface constructor.
     *
     * @param ManagerRegistry $registry
     * @param TokenStorageInterface $security
     */
    public function __construct(
        ManagerRegistry $registry,
        TokenStorageInterface $security
    );

    /**
     * @param CollectionInterface $collection
     */
    public function save(CollectionInterface $collection) : void;

    /**
     * @param CollectionInterface $collection
     */
    public function edit(CollectionInterface $collection) : void;

    /**
     * @param $user
     * @param $category
     *
     * @return mixed
     */
    public function findByOwnerAndCategory($user, $category);

    /**
     * @param $id
     *
     * @return Collection|null
     */
    public function findCollection($id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findCollectionAndImageById($id);

    /**
     * @param $user
     *
     * @return mixed
     */
    public function menuFindByOwnerAndCategory($user);

    /**
     * @param CollectionInterface $collection
     *
     * @return mixed
     */
    public function remove(CollectionInterface $collection);

    /**
     * @param ImageCollection $imageCollection
     *
     * @return mixed
     */
    public function removeImage(ImageCollection $imageCollection);
}
