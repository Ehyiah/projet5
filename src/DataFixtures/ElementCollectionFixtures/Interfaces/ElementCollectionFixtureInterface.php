<?php

namespace App\DataFixtures\ElementCollectionFixtures\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

interface ElementCollectionFixtureInterface
{
    /**
     * ElementCollectionFixtureInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementCollectionRepository
     * @param CollectionRepositoryInterface $collectionRepository
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementCollectionRepository,
        CollectionRepositoryInterface $collectionRepository
    );

    /**
     * @param ObjectManager $manager
     *
     * @return mixed
     */
    public function load(ObjectManager $manager);

    /**
     * @return mixed
     */
    public function getDependencies();
}
