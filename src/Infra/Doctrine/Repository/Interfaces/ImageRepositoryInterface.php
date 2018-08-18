<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\Interfaces\ImageCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface ImageRepositoryInterface
{
    /**
     * ImageRepositoryInterface constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry);

    /**
     * @param ImageCollectionInterface $imageCollection
     */
    public function save(ImageCollectionInterface $imageCollection) : void;
}
