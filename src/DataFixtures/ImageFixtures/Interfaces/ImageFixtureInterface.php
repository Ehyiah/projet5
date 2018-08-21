<?php

namespace App\DataFixtures\ImageFixtures\Interfaces;


use App\Infra\Doctrine\Repository\Interfaces\ElementCollectionRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;

interface ImageFixtureInterface
{
    /**
     * ImageFixtureInterface constructor.
     *
     * @param ElementCollectionRepositoryInterface $elementRepository
     */
    public function __construct(
        ElementCollectionRepositoryInterface $elementRepository
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
