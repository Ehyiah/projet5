<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\ImageCollectionInterface;

interface ImageRepositoryInterface
{
    public function save(ImageCollectionInterface $imageCollection) : void;
}