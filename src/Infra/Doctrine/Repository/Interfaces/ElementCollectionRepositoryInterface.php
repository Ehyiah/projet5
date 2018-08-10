<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface ElementCollectionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry);

    public function save(ElementCollectionInterface $elementCollection) : void;

    public function findCollectionById($id);

    public function edit(ElementCollectionInterface $elementCollection);

    public function remove($elementCollection);

    public function removeImage(ImageCollection $imageCollection);
}