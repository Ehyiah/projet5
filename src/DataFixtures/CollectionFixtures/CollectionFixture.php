<?php

namespace App\DataFixtures\CollectionFixtures;


use App\DataFixtures\CategoryCollectionFixture\CategoryFixture;
use App\DataFixtures\CollectionFixtures\Interfaces\CollectionFixtureInterface;
use App\DataFixtures\UserFixtures\UserFixture;
use App\Domain\DTO\Collection\AddCollectionDTO;
use App\Entity\Collection;
use App\Infra\Doctrine\Repository\Interfaces\CategoryCollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\CollectionRepositoryInterface;
use App\Infra\Doctrine\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CollectionFixture extends Fixture implements CollectionFixtureInterface, DependentFixtureInterface
{
    public const COLLECTION_REFERENCE = 'collection-reference';

    /**
     * @var CollectionRepositoryInterface
     */
    private $collectionRepository;

    /**
     * @var CategoryCollectionRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * CollectionFixture constructor.
     *
     * {@inheritdoc}
     */
    public function __construct(
        CollectionRepositoryInterface $collectionRepository,
        CategoryCollectionRepositoryInterface $categoryRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->collectionRepository = $collectionRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $category = $this->categoryRepository->findAll();
        $user = $this->userRepository->findAll();

        $collectionDTO = new AddCollectionDTO(
            'nomCollectionFixture', 'pasDeTag', $category[0], true, null
        );

        $collection = new Collection($collectionDTO);
        $collection->setOwner($user[0]);

        $manager->persist($collection);
        $manager->flush();

        $this->addReference(self::COLLECTION_REFERENCE, $collection);
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array(
            UserFixture::class,
            CategoryFixture::class
        );
    }
}
