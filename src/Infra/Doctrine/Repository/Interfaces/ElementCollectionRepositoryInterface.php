<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ElementCollectionInterface;

interface ElementCollectionRepositoryInterface
{
    public function save(ElementCollectionInterface $elementCollection) : void;

    public function findCollectionById($id);

    public function edit(ElementCollectionInterface $elementCollection);

    public function remove($elementCollection);

    public function removeImage(ImageCollection $imageCollection);
}