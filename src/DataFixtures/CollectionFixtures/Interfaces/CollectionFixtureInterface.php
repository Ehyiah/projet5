<?php

namespace App\DataFixtures\CollectionFixtures\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

interface CollectionFixtureInterface
{
    /**
     * CollectionFixtureInterface constructor.
     *
     * @param CollectionRepositoryInterface $collectionRepository
     * @param CategoryCollectionRepositoryInterface $categoryRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        CategoryCollectionRepositoryInterface $categoryRepository,
        UserRepositoryInterface $userRepository
    );

    /**
     * @param ObjectManager $manager
     *
     * @return mixed
     */
    public function load(ObjectManager $manager);

    /**
     * @return array
     */
    public function getDependencies();
}
