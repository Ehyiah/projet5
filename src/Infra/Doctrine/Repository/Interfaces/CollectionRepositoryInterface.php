<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\CollectionInterface;

interface CollectionRepositoryInterface
{
    public function save(CollectionInterface $collection) : void;

    public function edit(CollectionInterface $collection) : void;

    public function findByOwnerAndCategory($user, $category);

    public function findCollectionAndImageById($id);

    public function menuFindByOwnerAndCategory($user);

    public function remove(CollectionInterface $collection);
}