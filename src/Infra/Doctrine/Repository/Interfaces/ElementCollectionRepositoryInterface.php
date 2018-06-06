<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\ElementCollectionInterface;

interface ElementCollectionRepositoryInterface
{
    public function save(ElementCollectionInterface $elementCollection) : void;
}