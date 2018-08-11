<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\CollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

interface CollectionRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        TokenStorageInterface $security
    );

    public function save(CollectionInterface $collection) : void;

    public function edit(CollectionInterface $collection) : void;

    public function findByOwnerAndCategory($user, $category);

    public function findCollection($id);

    public function findCollectionAndImageById($id);

    public function menuFindByOwnerAndCategory($user);

    public function remove(CollectionInterface $collection);

    public function removeImage(ImageCollection $imageCollection);
}