<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\CollectionInterface;

interface CollectionRepositoryInterface
{
    public function save(CollectionInterface $collection) : void;
}