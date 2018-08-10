<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\ImageCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface ImageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry);

    public function save(ImageCollectionInterface $imageCollection) : void;
}