<?php

namespace App\Infra\Doctrine\Repository\Interfaces;


use App\Entity\ImageCollection;
use App\Entity\Interfaces\ElementCollectionInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

interface ElementCollectionRepositoryInterface
{
    /**
     * ElementCollectionRepositoryInterface constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry);

    /**
     * @param ElementCollectionInterface $elementCollection
     */
    public function save(ElementCollectionInterface $elementCollection) : void;

    /**
     * @param $id
     *
     * @return mixed
     */
    public function findCollectionById($id);

    /**
     * @param ElementCollectionInterface $elementCollection
     *
     * @return mixed
     */
    public function edit(ElementCollectionInterface $elementCollection);

    /**
     * @param $elementCollection
     *
     * @return mixed
     */
    public function remove($elementCollection);

    /**
     * @param ImageCollection $imageCollection
     *
     * @return mixed
     */
    public function removeImage(ImageCollection $imageCollection);
}