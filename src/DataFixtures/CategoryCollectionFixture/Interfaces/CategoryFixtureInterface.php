<?php

namespace App\DataFixtures\CategoryCollectionFixture\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

interface CategoryFixtureInterface
{
    /**
     * CategoryFixtureInterface constructor.
     *
     * @param CategoryCollectionRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryCollectionRepositoryInterface $categoryRepository);

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
